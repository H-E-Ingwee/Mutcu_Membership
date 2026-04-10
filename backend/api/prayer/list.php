<?php
// ========================================
// PRAYER REQUESTS - LIST, CREATE, & INTERCEDE
// GET /api/prayer/list - List prayer requests
// POST /api/prayer/create - Create prayer request
// POST /api/prayer/intercede - Add intercession
// GET /api/prayer/answer - Mark prayer as answered
// ========================================

require_once '../../config/Config.php';
require_once '../../config/Database.php';
require_once '../../utils/Response.php';
require_once '../../utils/Validator.php';
require_once '../../utils/Auth.php';
require_once '../../middleware/CORS.php';
require_once '../../middleware/CheckAuth.php';

$method = $_SERVER['REQUEST_METHOD'];
$action = isset($_GET['action']) ? $_GET['action'] : 'list';
$db = Database::getInstance();
$validator = new Validator();

if ($method === 'GET' && $action === 'list') {
    // LIST PRAYER REQUESTS
    
    $page = isset($_GET['page']) ? max(1, intval($_GET['page'])) : 1;
    $perPage = isset($_GET['perPage']) ? min(100, intval($_GET['perPage'])) : 15;
    $category = isset($_GET['category']) ? $_GET['category'] : null;
    $status = isset($_GET['status']) ? $_GET['status'] : 'open';
    
    $offset = ($page - 1) * $perPage;
    $where = "is_public = true";
    $params = [];
    
    if ($status === 'open') {
        $where .= " AND status = 'open'";
    } else if ($status === 'answered') {
        $where .= " AND status = 'answered'";
    }
    
    if ($category && in_array($category, ['personal', 'family', 'academic', 'health', 'work', 'spiritual', 'other'])) {
        $where .= " AND category = ?";
        $params[] = $category;
    }
    
    // Get total count
    $total = $db->fetchOne("SELECT COUNT(*) as count FROM prayer_requests WHERE $where", $params);
    $totalCount = $total['count'];
    
    // Get prayer requests
    $sql = "SELECT 
        pr.id, pr.title, pr.description, pr.category, pr.status,
        CASE WHEN pr.is_anonymous THEN 'Anonymous' ELSE CONCAT(u.first_name, ' ', u.last_name) END as requester,
        COUNT(pi.id) as prayer_count,
        pr.created_at, pr.answered_at
    FROM prayer_requests pr
    LEFT JOIN users u ON pr.user_id = u.id
    LEFT JOIN prayer_intercessions pi ON pr.id = pi.prayer_request_id
    WHERE $where
    GROUP BY pr.id, pr.title, pr.description, pr.category, pr.status, pr.is_anonymous, u.first_name, u.last_name, pr.created_at, pr.answered_at
    ORDER BY prayer_count DESC, pr.created_at DESC
    LIMIT ? OFFSET ?";
    
    $params[] = $perPage;
    $params[] = $offset;
    
    $prayers = $db->fetchAll($sql, $params);
    
    Response::paginated($prayers, $page, $perPage, $totalCount);
    
} else if ($method === 'POST' && $action === 'create') {
    // CREATE PRAYER REQUEST
    
    CheckAuth::required();
    $user = Auth::getCurrentUser();
    
    $input = $validator->getJSONInput();
    
    $title = $input['title'] ?? null;
    $description = $input['description'] ?? null;
    $category = $input['category'] ?? 'other';
    $isAnonymous = $input['is_anonymous'] ?? false;
    
    if (!$title || !$description) {
        Response::validationError('Title and description are required');
        exit;
    }
    
    if (!in_array($category, ['personal', 'family', 'academic', 'health', 'work', 'spiritual', 'other'])) {
        Response::validationError('Invalid category');
        exit;
    }
    
    try {
        $prayerId = $db->insert('prayer_requests', [
            'user_id' => $user['id'],
            'title' => $validator->sanitizeString($title),
            'description' => $validator->sanitizeString($description),
            'category' => $category,
            'is_anonymous' => $isAnonymous ? 1 : 0,
            'is_public' => 1,
            'status' => 'open'
        ]);
        
        // Log action
        $db->insert('audit_logs', [
            'user_id' => $user['id'],
            'action' => 'prayer_request_created',
            'description' => "Prayer request created: {$title}"
        ]);
        
        Response::created(['id' => $prayerId], 'Prayer request posted successfully');
        
    } catch (Exception $e) {
        Response::serverError('Failed to create prayer request: ' . $e->getMessage());
    }
    
} else if ($method === 'POST' && $action === 'intercede') {
    // ADD INTERCESSION (PRAYER)
    
    CheckAuth::required();
    $user = Auth::getCurrentUser();
    
    $input = $validator->getJSONInput();
    $prayerId = $input['prayer_id'] ?? null;
    
    if (!$prayerId) {
        Response::validationError('Prayer ID is required');
        exit;
    }
    
    // Check if prayer exists
    $prayer = $db->fetchOne("SELECT id, title FROM prayer_requests WHERE id = ?", [$prayerId]);
    
    if (!$prayer) {
        Response::notFound('Prayer request not found');
        exit;
    }
    
    // Check if already prayed
    $existing = $db->fetchOne(
        "SELECT id FROM prayer_intercessions WHERE prayer_request_id = ? AND user_id = ?",
        [$prayerId, $user['id']]
    );
    
    if ($existing) {
        Response::error('You have already interceded for this prayer', null, 400);
        exit;
    }
    
    try {
        $db->beginTransaction();
        
        // Add intercession
        $db->insert('prayer_intercessions', [
            'prayer_request_id' => $prayerId,
            'user_id' => $user['id']
        ]);
        
        // Update prayer count
        $count = $db->fetchOne(
            "SELECT COUNT(*) as count FROM prayer_intercessions WHERE prayer_request_id = ?",
            [$prayerId]
        );
        
        $db->update('prayer_requests',
            ['prayer_count' => $count['count']],
            ['id' => $prayerId]
        );
        
        $db->commit();
        
        Response::success('Thanks for interceding! You are lifting this prayer request to God', [
            'prayer_count' => $count['count']
        ]);
        
    } catch (Exception $e) {
        $db->rollback();
        Response::serverError('Failed to intercede: ' . $e->getMessage());
    }
    
} else if ($method === 'GET' && $action === 'answer') {
    // MARK PRAYER AS ANSWERED
    
    CheckAuth::required();
    $user = Auth::getCurrentUser();
    
    $prayerId = isset($_GET['prayer_id']) ? intval($_GET['prayer_id']) : null;
    
    if (!$prayerId) {
        Response::validationError('Prayer ID is required');
        exit;
    }
    
    // Check if user owns this prayer
    $prayer = $db->fetchOne("SELECT user_id FROM prayer_requests WHERE id = ?", [$prayerId]);
    
    if (!$prayer || $prayer['user_id'] !== $user['id']) {
        Response::forbidden('You can only mark your own prayers as answered');
        exit;
    }
    
    try {
        $db->update('prayer_requests',
            ['status' => 'answered', 'answered_at' => date('Y-m-d H:i:s')],
            ['id' => $prayerId]
        );
        
        // Log action
        $db->insert('audit_logs', [
            'user_id' => $user['id'],
            'action' => 'prayer_answered',
            'description' => "Prayer request marked as answered: ID {$prayerId}"
        ]);
        
        Response::success('Prayer marked as answered! Praise God!');
        
    } catch (Exception $e) {
        Response::serverError('Failed to update prayer: ' . $e->getMessage());
    }
    
} else {
    Response::error('Invalid action', null, 400);
}
