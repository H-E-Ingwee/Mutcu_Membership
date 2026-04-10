<?php
// ========================================
// EVENTS - REGISTER & UNREGISTER
// POST /api/events/register - Register for event
// POST /api/events/unregister - Cancel registration
// ========================================

require_once '../../config/Config.php';
require_once '../../config/Database.php';
require_once '../../utils/Response.php';
require_once '../../utils/Auth.php';
require_once '../../middleware/CORS.php';
require_once '../../middleware/CheckAuth.php';

$action = isset($_GET['action']) ? $_GET['action'] : 'register';
$db = Database::getInstance();

CheckAuth::required();
$user = Auth::getCurrentUser();

if ($action === 'register') {
    // REGISTER FOR EVENT
    
    $eventId = isset($_POST['event_id']) ? intval($_POST['event_id']) : (isset($_GET['event_id']) ? intval($_GET['event_id']) : null);
    
    if (!$eventId) {
        // Try JSON input
        $input = json_decode(file_get_contents('php://input'), true);
        $eventId = $input['event_id'] ?? null;
    }
    
    if (!$eventId) {
        Response::validationError('Event ID is required');
        exit;
    }
    
    // Check if event exists
    $event = $db->fetchOne("SELECT id, max_attendees, title FROM events WHERE id = ?", [$eventId]);
    
    if (!$event) {
        Response::notFound('Event not found');
        exit;
    }
    
    // Check if already registered
    $existing = $db->fetchOne(
        "SELECT id FROM event_attendees WHERE event_id = ? AND user_id = ? AND status != 'cancelled'",
        [$eventId, $user['id']]
    );
    
    if ($existing) {
        Response::error('Already registered for this event', null, 400);
        exit;
    }
    
    // Check capacity
    if ($event['max_attendees']) {
        $count = $db->fetchOne(
            "SELECT COUNT(*) as attendee_count FROM event_attendees WHERE event_id = ? AND status = 'registered'",
            [$eventId]
        );
        
        if ($count['attendee_count'] >= $event['max_attendees']) {
            Response::error('Event is full', null, 400);
            exit;
        }
    }
    
    try {
        $db->beginTransaction();
        
        // Register user
        $db->insert('event_attendees', [
            'event_id' => $eventId,
            'user_id' => $user['id'],
            'status' => 'registered'
        ]);
        
        // Log action
        $db->insert('audit_logs', [
            'user_id' => $user['id'],
            'action' => 'event_registered',
            'description' => "Registered for event: {$event['title']}"
        ]);
        
        // Create notification
        $db->insert('notifications', [
            'user_id' => $user['id'],
            'notification_type' => 'event_reminder',
            'title' => 'Event Registration Confirmed',
            'message' => "You have registered for {$event['title']}",
            'related_id' => $eventId,
            'related_type' => 'event'
        ]);
        
        $db->commit();
        
        Response::created([], 'Successfully registered for event');
        
    } catch (Exception $e) {
        $db->rollback();
        Response::serverError('Failed to register for event: ' . $e->getMessage());
    }
    
} else if ($action === 'unregister') {
    // UNREGISTER FROM EVENT
    
    $eventId = isset($_POST['event_id']) ? intval($_POST['event_id']) : (isset($_GET['event_id']) ? intval($_GET['event_id']) : null);
    
    if (!$eventId) {
        // Try JSON input
        $input = json_decode(file_get_contents('php://input'), true);
        $eventId = $input['event_id'] ?? null;
    }
    
    if (!$eventId) {
        Response::validationError('Event ID is required');
        exit;
    }
    
    // Check if registered
    $registration = $db->fetchOne(
        "SELECT id, event_id FROM event_attendees WHERE event_id = ? AND user_id = ? AND status = 'registered'",
        [$eventId, $user['id']]
    );
    
    if (!$registration) {
        Response::notFound('No registration found for this event');
        exit;
    }
    
    try {
        $db->beginTransaction();
        
        // Cancel registration
        $db->update('event_attendees',
            ['status' => 'cancelled'],
            ['id' => $registration['id']]
        );
        
        // Log action
        $db->insert('audit_logs', [
            'user_id' => $user['id'],
            'action' => 'event_unregistered',
            'description' => "Cancelled registration for event ID: {$eventId}"
        ]);
        
        $db->commit();
        
        Response::success('Successfully cancelled event registration');
        
    } catch (Exception $e) {
        $db->rollback();
        Response::serverError('Failed to cancel registration: ' . $e->getMessage());
    }
    
} else {
    Response::error('Invalid action', null, 400);
}
