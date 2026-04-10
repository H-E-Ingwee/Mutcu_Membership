<?php
/**
 * Get Single Member Endpoint
 * GET /api/members/get?id={userId}
 */

require_once __DIR__ . '/../../config/Config.php';
require_once __DIR__ . '/../../config/Database.php';
require_once __DIR__ . '/../../utils/Response.php';
require_once __DIR__ . '/../../utils/Auth.php';
require_once __DIR__ . '/../../middleware/CheckAuth.php';

// Verify authentication
CheckAuth::required();

// Get member ID
$memberId = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if ($memberId <= 0) {
    Response::error('Member ID is required', 400);
}

try {
    $db = Database::getInstance();
    $user = Auth::getCurrentUser();

    // Check ownership or admin
    CheckAuth::checkOwnership($memberId);

    // Get member details
    $member = $db->fetchOne(
        'SELECT u.id, u.first_name, u.last_name, u.email, u.phone, u.registration_number,
                u.course_of_study, yos.display_name as year_of_study, ms.status_name as status,
                mt.name as membership_type, u.avatar_url, u.gender, u.created_at
         FROM users u
         LEFT JOIN year_of_study yos ON u.year_of_study_id = yos.id
         LEFT JOIN member_status ms ON u.member_status_id = ms.id
         LEFT JOIN membership_types mt ON u.membership_type_id = mt.id
         WHERE u.id = ?',
        [$memberId]
    );

    if (!$member) {
        Response::notFound('Member not found');
    }

    // Get member's ministries
    $ministries = $db->fetchAll(
        'SELECT m.id, m.name, lr.role_name, umr.is_primary_ministry
         FROM user_ministry_roles umr
         JOIN ministries m ON umr.ministry_id = m.id
         JOIN leadership_roles lr ON umr.leadership_role_id = lr.id
         WHERE umr.user_id = ? AND umr.is_active = TRUE',
        [$memberId]
    );

    $member['ministries'] = $ministries;

    Response::success($member, 'Member details retrieved successfully');

} catch (Exception $e) {
    Response::serverError('Error retrieving member: ' . $e->getMessage());
}

?>
