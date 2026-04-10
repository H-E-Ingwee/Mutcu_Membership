<?php
/**
 * Get Member List Endpoint
 * GET /api/members/list
 * Admin only
 */

require_once __DIR__ . '/../../config/Config.php';
require_once __DIR__ . '/../../config/Database.php';
require_once __DIR__ . '/../../utils/Response.php';
require_once __DIR__ . '/../../utils/Auth.php';
require_once __DIR__ . '/../../middleware/CheckAuth.php';

// Verify authentication
CheckAuth::required();

// Only admins can view all members
$user = Auth::getCurrentUser();
if ($user['role'] !== 'Administrator') {
    Response::forbidden('Only administrators can view member lists');
}

// Get pagination params
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$perPage = isset($_GET['perPage']) ? (int)$_GET['perPage'] : 20;
$search = isset($_GET['search']) ? $_GET['search'] : '';
$status = isset($_GET['status']) ? $_GET['status'] : '';

$offset = ($page - 1) * $perPage;

try {
    $db = Database::getInstance();

    // Build query
    $whereClauses = [];
    $params = [];

    if (!empty($search)) {
        $whereClauses[] = "(u.first_name LIKE ? OR u.last_name LIKE ? OR u.email LIKE ? OR u.registration_number LIKE ?)";
        $searchTerm = '%' . $search . '%';
        $params = array_merge($params, [$searchTerm, $searchTerm, $searchTerm, $searchTerm]);
    }

    if (!empty($status)) {
        $whereClauses[] = "ms.status_name = ?";
        $params[] = $status;
    }

    $whereSQL = !empty($whereClauses) ? 'WHERE ' . implode(' AND ', $whereClauses) : '';

    // Count total
    $countQuery = "SELECT COUNT(*) as total FROM users u LEFT JOIN member_status ms ON u.member_status_id = ms.id $whereSQL";
    $countResult = $db->fetchOne($countQuery, $params);
    $total = $countResult['total'];

    // Get members
    $sql = "SELECT u.id, u.first_name, u.last_name, u.email, u.phone, u.registration_number, 
                   u.course_of_study, yos.display_name as year_of_study, ms.status_name as status,
                   mt.name as membership_type, u.created_at
            FROM users u
            LEFT JOIN year_of_study yos ON u.year_of_study_id = yos.id
            LEFT JOIN member_status ms ON u.member_status_id = ms.id
            LEFT JOIN membership_types mt ON u.membership_type_id = mt.id
            $whereSQL
            ORDER BY u.created_at DESC
            LIMIT ? OFFSET ?";

    $params[] = $perPage;
    $params[] = $offset;

    $members = $db->fetchAll($sql, $params);

    Response::paginated($members, $total, $page, $perPage, 'Members retrieved successfully');

} catch (Exception $e) {
    Response::serverError('Error retrieving members: ' . $e->getMessage());
}

?>
