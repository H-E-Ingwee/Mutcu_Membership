<?php
/**
 * Update Member Profile
 * PUT/POST /api/members/update
 */

require_once __DIR__ . '/../../config/Config.php';
require_once __DIR__ . '/../../config/Database.php';
require_once __DIR__ . '/../../utils/Response.php';
require_once __DIR__ . '/../../utils/Validator.php';
require_once __DIR__ . '/../../utils/Auth.php';
require_once __DIR__ . '/../../middleware/CheckAuth.php';

// Verify authentication
CheckAuth::required();

// Get input
$input = Validator::getJSONInput();

if (!isset($input['id'])) {
    Response::validationError(['id' => 'Member ID is required']);
}

$memberId = (int)$input['id'];
$user = Auth::getCurrentUser();

// Check ownership
CheckAuth::checkOwnership($memberId);

try {
    $db = Database::getInstance();

    // Build update data
    $updateData = [];
    $validator = new Validator();

    if (isset($input['phone'])) {
        $phone = Validator::sanitizeString($input['phone']);
        $validator->validatePhoneNumber($phone);
        $updateData['phone'] = $phone;
    }

    if (isset($input['course'])) {
        $updateData['course_of_study'] = Validator::sanitizeString($input['course']);
    }

    if (isset($input['year_of_study'])) {
        $validator->validateYearOfStudy($input['year_of_study']);
        $yearRecord = $db->fetchOne('SELECT id FROM year_of_study WHERE year_code = ?', [$input['year_of_study']]);
        $updateData['year_of_study_id'] = $yearRecord['id'];
    }

    if (!$validator->passes()) {
        Response::validationError($validator->getErrors());
    }

    if (empty($updateData)) {
        Response::error('No fields to update', 400);
    }

    // Update member
    $db->update('users', $updateData, ['id' => $memberId]);

    // Log action
    $db->insert('audit_logs', [
        'action_type' => 'UPDATE',
        'entity_type' => 'User',
        'entity_id' => $memberId,
        'performed_by_user_id' => $user['userId'],
        'details' => json_encode(['fields_updated' => array_keys($updateData)])
    ]);

    Response::success(['id' => $memberId], 'Profile updated successfully');

} catch (Exception $e) {
    Response::serverError('Error updating profile: ' . $e->getMessage());
}

?>
