<?php
// ========================================
// EVENTS - LIST & CREATE
// GET /api/events/list - List upcoming events
// POST /api/events/create - Create new event (admin)
// ========================================

require_once '../../config/Config.php';
require_once '../../config/Database.php';
require_once '../../utils/Response.php';
require_once '../../utils/Validator.php';
require_once '../../middleware/CORS.php';
require_once '../../middleware/CheckAuth.php';

$method = $_SERVER['REQUEST_METHOD'];
$db = Database::getInstance();
$validator = new Validator();

if ($method === 'GET') {
    // LIST EVENTS
    
    $page = isset($_GET['page']) ? max(1, intval($_GET['page'])) : 1;
    $perPage = isset($_GET['perPage']) ? min(100, intval($_GET['perPage'])) : 20;
    $type = isset($_GET['type']) ? $_GET['type'] : null;
    $search = isset($_GET['search']) ? $_GET['search'] : null;
    
    $offset = ($page - 1) * $perPage;
    $where = "is_published = true AND start_date > NOW()";
    $params = [];
    
    if ($type && in_array($type, ['prayer_meeting', 'conference', 'training', 'service', 'social'])) {
        $where .= " AND event_type = ?";
        $params[] = $type;
    }
    
    if ($search) {
        $where .= " AND (title LIKE ? OR description LIKE ?)";
        $params[] = "%$search%";
        $params[] = "%$search%";
    }
    
    // Get total count
    $total = $db->fetchOne("SELECT COUNT(*) as count FROM events WHERE $where", $params);
    $totalCount = $total['count'];
    
    // Get events
    $sql = "SELECT 
        e.id, e.title, e.description, e.event_type, e.location,
        e.start_date, e.end_date, e.featured_image_url,
        CONCAT(u.first_name, ' ', u.last_name) as organizer,
        COUNT(ea.id) as attendee_count,
        CASE WHEN e.max_attendees IS NULL THEN -1 
             WHEN COUNT(ea.id) >= e.max_attendees THEN 0
             ELSE (e.max_attendees - COUNT(ea.id)) END as spots_available
    FROM events e
    LEFT JOIN users u ON e.created_by = u.id
    LEFT JOIN event_attendees ea ON e.id = ea.event_id AND ea.status = 'registered'
    WHERE $where
    GROUP BY e.id, e.title, e.description, e.event_type, e.location, 
             e.start_date, e.end_date, e.featured_image_url, u.first_name, u.last_name, e.max_attendees
    ORDER BY e.start_date ASC
    LIMIT ? OFFSET ?";
    
    $params[] = $perPage;
    $params[] = $offset;
    
    $events = $db->fetchAll($sql, $params);
    
    Response::paginated($events, $page, $perPage, $totalCount);
    
} else if ($method === 'POST') {
    // CREATE EVENT (ADMIN ONLY)
    
    CheckAuth::requireAdmin();
    $user = Auth::getCurrentUser();
    
    $input = $validator->getJSONInput();
    
    // Validate inputs
    $title = $input['title'] ?? null;
    $description = $input['description'] ?? null;
    $event_type = $input['event_type'] ?? null;
    $location = $input['location'] ?? null;
    $start_date = $input['start_date'] ?? null;
    $end_date = $input['end_date'] ?? null;
    $max_attendees = $input['max_attendees'] ?? null;
    
    if (!$title || !$description || !$event_type || !$location || !$start_date || !$end_date) {
        Response::validationError('Missing required fields: title, description, event_type, location, start_date, end_date');
        exit;
    }
    
    if (!in_array($event_type, ['prayer_meeting', 'conference', 'training', 'service', 'social', 'other'])) {
        Response::validationError('Invalid event type');
        exit;
    }
    
    // Verify dates
    $startDateTime = strtotime($start_date);
    $endDateTime = strtotime($end_date);
    
    if (!$startDateTime || !$endDateTime || $endDateTime <= $startDateTime) {
        Response::validationError('Invalid dates: end_date must be after start_date');
        exit;
    }
    
    try {
        $db->beginTransaction();
        
        $eventId = $db->insert('events', [
            'title' => $validator->sanitizeString($title),
            'description' => $validator->sanitizeString($description),
            'event_type' => $event_type,
            'location' => $validator->sanitizeString($location),
            'start_date' => $start_date,
            'end_date' => $end_date,
            'max_attendees' => $max_attendees,
            'created_by' => $user['id'],
            'is_published' => true
        ]);
        
        // Log action
        $db->insert('audit_logs', [
            'user_id' => $user['id'],
            'action' => 'event_created',
            'description' => "Event created: {$title}"
        ]);
        
        $db->commit();
        
        Response::created(['id' => $eventId], 'Event created successfully');
        
    } catch (Exception $e) {
        $db->rollback();
        Response::serverError('Failed to create event: ' . $e->getMessage());
    }
    
} else {
    Response::error('Method not allowed', null, 405);
}
