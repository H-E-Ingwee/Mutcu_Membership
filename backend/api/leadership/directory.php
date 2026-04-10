<?php
/**
 * Leadership Directory
 * GET /api/leadership/directory
 * Public endpoint
 */

require_once __DIR__ . '/../../config/Config.php';
require_once __DIR__ . '/../../config/Database.php';
require_once __DIR__ . '/../../utils/Response.php';

try {
    $db = Database::getInstance();

    // Get executive council members
    $executiveCouncil = $db->fetchAll(
        'SELECT u.first_name, u.last_name, u.email, u.phone, lr.role_name, m.name as ministry
         FROM user_ministry_roles umr
         JOIN users u ON umr.user_id = u.id
         JOIN leadership_roles lr ON umr.leadership_role_id = lr.id
         LEFT JOIN ministries m ON umr.ministry_id = m.id
         WHERE lr.role_type = "Executive Council" AND umr.is_active = TRUE
         ORDER BY FIELD(lr.role_code, "CHAIRPERSON", "FIRST_VICE_CHAIR", "SECOND_VICE_CHAIR", "SECRETARY", "VICE_SECRETARY", "TREASURER")'
    );

    // Get ministry coordinators
    $ministryCoordinators = $db->fetchAll(
        'SELECT u.first_name, u.last_name, u.email, u.phone, lr.role_name, m.name as ministry
         FROM user_ministry_roles umr
         JOIN users u ON umr.user_id = u.id
         JOIN leadership_roles lr ON umr.leadership_role_id = lr.id
         JOIN ministries m ON umr.ministry_id = m.id
         WHERE lr.role_type = "Ministry Coordinator" AND umr.is_active = TRUE
         ORDER BY m.name ASC'
    );

    $directory = [
        'executiveCouncil' => $executiveCouncil,
        'ministryCoordinators' => $ministryCoordinators
    ];

    Response::success($directory, 'Leadership directory retrieved successfully');

} catch (Exception $e) {
    Response::serverError('Error retrieving leadership directory: ' . $e->getMessage());
}

?>
