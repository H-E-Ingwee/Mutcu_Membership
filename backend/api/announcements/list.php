<?php
// ========================================
// ANNOUNCEMENTS - LIST & CREATE
// GET /api/announcements/list - List announcements
// POST /api/announcements/create - Create announcement (admin)
// ========================================

require_once '../../config/Config.php';
require_once '../../config/Database.php';
require_once '../../utils/Response.php';
require_once '../../utils/Validator.php';
require_once '../../utils/Auth.php';
require_once '../../middleware/CORS.php';
require_once '../../middleware/CheckAuth.php';

$method = $_SERVER['REQUEST_METHOD'];
$db = Database::getInstance();
$validator = new Validator();

if ($method === 'GET') {
    // LIST ANNOUNCEMENTS
    
    $page = isset($_GET['page']) ? max(1, intval($_GET['page'])) : 1;
    $perPage = isset($_GET['perPage']) ? min(100, intval($_GET['perPage'])) : 10;
    $category = isset($_GET['category']) ? $_GET['category'] : null;
    
    $offset = ($page - 1) * $perPage;
    $where = "is_published = true AND (expires_at IS NULL OR expires_at > NOW())";
    $params = [];
    
    if ($category && in_array($category, ['general', 'leadership', 'ministry', 'ministry_event', 'emergency', 'celebration'])) {
        $where .= " AND category = ?";
        $params[] = $category;
    }
    
    // Get total count
    $total = $db->fetchOne("SELECT COUNT(*) as count FROM announcements WHERE $where", $params);
    $totalCount = $total['count'];
    
    // Get announcements
    $sql = "SELECT 
        a.id, a.title, a.content, a.category, a.featured_image_url,
        CONCAT(u.first_name, ' ', u.last_name) as posted_by,
        a.published_at, a.created_at
    FROM announcements a
    LEFT JOIN users u ON a.created_by = u.id
    WHERE $where
    ORDER BY a.published_at DESC, a.created_at DESC
    LIMIT ? OFFSET ?";
    
    $params[] = $perPage;
    $params[] = $offset;
    
    $announcements = $db->fetchAll($sql, $params);
    
    Response::paginated($announcements, $page, $perPage, $totalCount);
    
} else if ($method === 'POST') {
    // CREATE ANNOUNCEMENT (ADMIN ONLY)
    
    CheckAuth::requireAdmin();
    $user = Auth::getCurrentUser();
    
    $input = $validator->getJSONInput();
    
    $title = $input['title'] ?? null;
    $content = $input['content'] ?? null;
    $category = $input['category'] ?? 'general';
    
    if (!$title || !$content) {
        Response::validationError('Title and content are required');
        exit;
    }
    
    if (!in_array($category, ['general', 'leadership', 'ministry', 'ministry_event', 'emergency', 'celebration'])) {
        Response::validationError('Invalid category');
        exit;
    }
    
    try {
        $db->beginTransaction();
        
        $announcementId = $db->insert('announcements', [
            'title' => $validator->sanitizeString($title),
            'content' => $validator->sanitizeString($content),
            'category' => $category,
            'created_by' => $user['id'],
            'is_published' => true,
            'published_at' => date('Y-m-d H:i:s')
        ]);
        
        // Log action
        $db->insert('audit_logs', [
            'user_id' => $user['id'],
            'action' => 'announcement_created',
            'description' => "Announcement created: {$title}"
        ]);
        
        // Create notifications for all active users
        if ($category === 'emergency') {
            $users = $db->fetchAll("SELECT id FROM users WHERE member_status_id = 1");
            foreach ($users as $u) {
                $db->insert('notifications', [
                    'user_id' => $u['id'],
                    'notification_type' => 'announcement',
                    'title' => 'URGENT: ' . $title,
                    'message' => substr($content, 0, 100) . '...',
                    'related_id' => $announcementId,
                    'related_type' => 'announcement'
                ]);
            }
        }
        
        $db->commit();
        
        Response::created(['id' => $announcementId], 'Announcement published successfully');
        
    } catch (Exception $e) {
        $db->rollback();
        Response::serverError('Failed to create announcement: ' . $e->getMessage());
    }
    
} else {
    Response::error('Method not allowed', null, 405);
}
