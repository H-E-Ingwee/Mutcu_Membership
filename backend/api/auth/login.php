<?php
/**
 * User Login Endpoint
 * POST /api/auth/login
 */

require_once __DIR__ . '/../../config/Config.php';
require_once __DIR__ . '/../../config/Database.php';
require_once __DIR__ . '/../../utils/Response.php';
require_once __DIR__ . '/../../utils/Validator.php';
require_once __DIR__ . '/../../utils/Auth.php';

// Handle request
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    Response::error('Method not allowed', 405);
}

// Get input
$input = Validator::getJSONInput();

// Validate required fields
if (!isset($input['email']) || empty($input['email'])) {
    Response::validationError(['email' => 'Email is required']);
}

if (!isset($input['password']) || empty($input['password'])) {
    Response::validationError(['password' => 'Password is required']);
}

$email = Validator::sanitizeEmail($input['email']);
$password = $input['password'];

try {
    $db = Database::getInstance();

    // Find user by email
    $user = $db->fetchOne(
        'SELECT u.id, u.first_name, u.last_name, u.email, u.password_hash, u.member_status_id, 
                u.registration_number, u.course_of_study, ms.status_name,
                CASE 
                    WHEN umr.leadership_role_id IS NOT NULL THEN lr.role_code
                    ELSE "General Member"
                END as role
         FROM users u
         LEFT JOIN member_status ms ON u.member_status_id = ms.id
         LEFT JOIN user_ministry_roles umr ON u.id = umr.user_id AND umr.is_active = TRUE 
         LEFT JOIN leadership_roles lr ON umr.leadership_role_id = lr.id
         WHERE u.email = ? LIMIT 1',
        [$email]
    );

    if (!$user) {
        Response::error('Invalid email or password', 401);
    }

    // Verify password
    if (!Auth::verifyPassword($password, $user['password_hash'])) {
        Response::error('Invalid email or password', 401);
    }

    // Check if user is active (not pending)
    if ($user['status_name'] === 'Pending') {
        Response::error('Your account is pending administrator approval', 403);
    }

    if ($user['status_name'] === 'Inactive') {
        Response::error('Your account has been deactivated', 403);
    }

    // Determine user role for token
    $role = 'General Member';
    if (strpos($user['role'], 'CHAIRPERSON') !== false || strpos($user['role'], 'COORDINATOR') !== false || strpos($user['role'], 'SECRETARY') !== false || strpos($user['role'], 'TREASURER') !== false) {
        $role = 'Administrator';
    }

    // Generate JWT token
    $token = Auth::generateToken($user['id'], $user['email'], $role);

    // Update last login
    $db->update('users', ['last_login' => date('Y-m-d H:i:s')], ['id' => $user['id']]);

    // Log action
    $db->insert('audit_logs', [
        'action_type' => 'LOGIN',
        'entity_type' => 'User',
        'entity_id' => $user['id'],
        'performed_by_user_id' => $user['id']
    ]);

    // Return response
    Response::success([
        'token' => $token,
        'user' => [
            'id' => $user['id'],
            'firstName' => $user['first_name'],
            'lastName' => $user['last_name'],
            'email' => $user['email'],
            'registrationNumber' => $user['registration_number'],
            'role' => $role,
            'status' => $user['status_name']
        ]
    ], 'Login successful');

} catch (Exception $e) {
    Response::serverError('Login failed: ' . $e->getMessage());
}

?>
