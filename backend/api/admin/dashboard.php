<?php
/**
 * Admin Dashboard Analytics
 * GET /api/admin/dashboard
 * Admin only
 */

require_once __DIR__ . '/../../config/Config.php';
require_once __DIR__ . '/../../config/Database.php';
require_once __DIR__ . '/../../utils/Response.php';
require_once __DIR__ . '/../../utils/Auth.php';
require_once __DIR__ . '/../../middleware/CheckAuth.php';

// Verify admin authentication
CheckAuth::requireAdmin();

try {
    $db = Database::getInstance();

    // Total members
    $totalMembers = $db->fetchOne(
        'SELECT COUNT(*) as count FROM users'
    );

    // Active members
    $activeMembers = $db->fetchOne(
        'SELECT COUNT(*) as count FROM users u 
         JOIN member_status ms ON u.member_status_id = ms.id
         WHERE ms.status_name = "Active"'
    );

    // Pending approvals
    $pendingMembers = $db->fetchOne(
        'SELECT COUNT(*) as count FROM users u
         JOIN member_status ms ON u.member_status_id = ms.id
         WHERE ms.status_name = "Pending"'
    );

    // First year students
    $firstYearStudents = $db->fetchOne(
        'SELECT COUNT(*) as count FROM users u
         JOIN year_of_study yos ON u.year_of_study_id = yos.id
         WHERE yos.year_code = "1"'
    );

    // Members by ministry
    $membersByMinistry = $db->fetchAll(
        'SELECT m.name, COUNT(umr.user_id) as count
         FROM ministries m
         LEFT JOIN user_ministry_roles umr ON m.id = umr.ministry_id AND umr.is_active = TRUE
         GROUP BY m.id, m.name
         ORDER BY count DESC'
    );

    // Members by year
    $membersByYear = $db->fetchAll(
        'SELECT yos.display_name, COUNT(u.id) as count
         FROM year_of_study yos
         LEFT JOIN users u ON yos.id = u.year_of_study_id
         GROUP BY yos.id, yos.display_name
         ORDER BY yos.year_code ASC'
    );

    // Pending registrations (detail)
    $pendingRegistrations = $db->fetchAll(
        'SELECT u.id, u.first_name, u.last_name, u.email, u.registration_number, u.created_at
         FROM users u
         JOIN member_status ms ON u.member_status_id = ms.id
         WHERE ms.status_name = "Pending"
         ORDER BY u.created_at DESC
         LIMIT 10'
    );

    $dashboard = [
        'statistics' => [
            'totalMembers' => (int)$totalMembers['count'],
            'activeMembers' => (int)$activeMembers['count'],
            'pendingApprovals' => (int)$pendingMembers['count'],
            'firstYearStudents' => (int)$firstYearStudents['count']
        ],
        'membersByMinistry' => $membersByMinistry,
        'membersByYear' => $membersByYear,
        'pendingRegistrations' => $pendingRegistrations
    ];

    Response::success($dashboard, 'Dashboard data retrieved successfully');

} catch (Exception $e) {
    Response::serverError('Error retrieving dashboard: ' . $e->getMessage());
}

?>
