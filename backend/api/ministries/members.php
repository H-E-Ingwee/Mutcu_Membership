<?php
/**
 * Get Ministry Members
 * GET /api/ministries/members?id={ministryId}
 */

require_once __DIR__ . '/../../config/Config.php';
require_once __DIR__ . '/../../config/Database.php';
require_once __DIR__ . '/../../utils/Response.php';

// Get ministry ID
$ministryId = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if ($ministryId <= 0) {
    Response::error('Ministry ID is required', 400);
}

try {
    $db = Database::getInstance();

    // Get ministry details
    $ministry = $db->fetchOne(
        'SELECT id, name, description FROM ministries WHERE id = ?',
        [$ministryId]
    );

    if (!$ministry) {
        Response::notFound('Ministry not found');
    }

    // Get ministry members
    $members = $db->fetchAll(
        'SELECT u.id, u.first_name, u.last_name, u.email, u.registration_number,
                lr.role_name, umr.is_primary_ministry, yos.display_name as year_of_study
         FROM user_ministry_roles umr
         JOIN users u ON umr.user_id = u.id
         JOIN leadership_roles lr ON umr.leadership_role_id = lr.id
         LEFT JOIN year_of_study yos ON u.year_of_study_id = yos.id
         WHERE umr.ministry_id = ? AND umr.is_active = TRUE
         ORDER BY is_primary_ministry DESC, u.first_name ASC',
        [$ministryId]
    );

    $ministry['members'] = $members;
    $ministry['member_count'] = count($members);

    Response::success($ministry, 'Ministry members retrieved successfully');

} catch (Exception $e) {
    Response::serverError('Error retrieving ministry members: ' . $e->getMessage());
}

?>
