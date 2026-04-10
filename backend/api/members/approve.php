<?php
/**
 * Approve Member Registration
 * POST /api/members/approve
 * Admin only
 */

require_once __DIR__ . '/../../config/Config.php';
require_once __DIR__ . '/../../config/Database.php';
require_once __DIR__ . '/../../utils/Response.php';
require_once __DIR__ . '/../../utils/Validator.php';
require_once __DIR__ . '/../../utils/Auth.php';
require_once __DIR__ . '/../../middleware/CheckAuth.php';

// Verify admin authentication
CheckAuth::requireAdmin();

// Get input
$input = Validator::getJSONInput();

if (!isset($input['member_id']) || empty($input['member_id'])) {
    Response::validationError(['member_id' => 'Member ID is required']);
}

$memberId = (int)$input['member_id'];
$user = Auth::getCurrentUser();

try {
    $db = Database::getInstance();

    // Check if member exists
    $member = $db->fetchOne('SELECT id, member_status_id FROM users WHERE id = ?', [$memberId]);
    
    if (!$member) {
        Response::notFound('Member not found');
    }

    // Update status to Active (id = 1)
    $db->update('users', ['member_status_id' => 1], ['id' => $memberId]);

    // Log action
    $db->insert('audit_logs', [
        'action_type' => 'UPDATE',
        'entity_type' => 'User',
        'entity_id' => $memberId,
        'performed_by_user_id' => $user['userId'],
        'details' => json_encode(['action' => 'Member approved', 'new_status' => 'Active'])
    ]);

    Response::success(['id' => $memberId, 'status' => 'Active'], 'Member approved successfully');

} catch (Exception $e) {
    Response::serverError('Error approving member: ' . $e->getMessage());
}

?>
