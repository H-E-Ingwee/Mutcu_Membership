<?php
/**
 * Get Ministries List
 * GET /api/ministries/list
 */

require_once __DIR__ . '/../../config/Config.php';
require_once __DIR__ . '/../../config/Database.php';
require_once __DIR__ . '/../../utils/Response.php';

try {
    $db = Database::getInstance();

    $ministries = $db->fetchAll(
        'SELECT m.id, m.name, m.description, u.first_name, u.last_name, u.email,
                COUNT(umr.user_id) as member_count
         FROM ministries m
         LEFT JOIN users u ON m.coordinator_user_id = u.id
         LEFT JOIN user_ministry_roles umr ON m.id = umr.ministry_id AND umr.is_active = TRUE
         WHERE m.is_active = TRUE
         GROUP BY m.id, m.name, m.description, u.first_name, u.last_name, u.email
         ORDER BY m.name ASC'
    );

    Response::success($ministries, 'Ministries retrieved successfully');

} catch (Exception $e) {
    Response::serverError('Error retrieving ministries: ' . $e->getMessage());
}

?>
