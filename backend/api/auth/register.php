<?php
/**
 * User Registration Endpoint
 * POST /api/auth/register
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
$validator = new Validator();
$required_fields = ['first_name', 'last_name', 'registration_number', 'email', 'phone', 'course', 'year_of_study', 'password'];

foreach ($required_fields as $field) {
    if (!isset($input[$field]) || empty($input[$field])) {
        $validator->errors[$field] = ucfirst(str_replace('_', ' ', $field)) . ' is required';
    }
}

if (!$validator->passes()) {
    Response::validationError($validator->getErrors(), 'Validation failed');
}

// Validate specific fields
$validator->validateEmail($input['email']);
$validator->validatePassword($input['password']);
$validator->validateRegistrationNumber($input['registration_number']);
$validator->validatePhoneNumber($input['phone']);
$validator->validateYearOfStudy($input['year_of_study']);

if (!$validator->passes()) {
    Response::validationError($validator->getErrors());
}

// Sanitize inputs
$firstName = Validator::sanitizeString($input['first_name']);
$lastName = Validator::sanitizeString($input['last_name']);
$email = Validator::sanitizeEmail($input['email']);
$regNo = strtoupper(Validator::sanitizeString($input['registration_number']));
$phone = Validator::sanitizeString($input['phone']);
$course = Validator::sanitizeString($input['course']);
$yearOfStudy = $input['year_of_study'];

// Check if user already exists
$db = Database::getInstance();

try {
    // Check email exists
    $existing = $db->fetchOne('SELECT id FROM users WHERE email = ?', [$email]);
    if ($existing) {
        Response::error('Email already registered', 400);
    }

    // Check registration number exists
    $existing = $db->fetchOne('SELECT id FROM users WHERE registration_number = ?', [$regNo]);
    if ($existing) {
        Response::error('Registration number already in system', 400);
    }

    // Get year of study ID
    $yearRecord = $db->fetchOne('SELECT id FROM year_of_study WHERE year_code = ?', [$yearOfStudy]);
    if (!$yearRecord) {
        Response::error('Invalid year of study', 400);
    }

    // Hash password
    $passwordHash = Auth::hashPassword($input['password']);

    // Create user (status: Pending, membership_type: Full by default)
    $userId = $db->insert('users', [
        'first_name' => $firstName,
        'last_name' => $lastName,
        'email' => $email,
        'phone' => $phone,
        'registration_number' => $regNo,
        'course_of_study' => $course,
        'year_of_study_id' => $yearRecord['id'],
        'password_hash' => $passwordHash,
        'membership_type_id' => 1, // Full membership
        'member_status_id' => 2 // Pending
    ]);

    // Get newly created user (excluding password)
    $user = $db->fetchOne(
        'SELECT id, first_name, last_name, email, registration_number, course_of_study, 
                year_of_study_id, member_status_id FROM users WHERE id = ?',
        [$userId]
    );

    // Log action
    $db->insert('audit_logs', [
        'action_type' => 'CREATE',
        'entity_type' => 'User',
        'entity_id' => $userId,
        'details' => json_encode(['action' => 'User self-registered'])
    ]);

    Response::created($user, 'Registration successful. Awaiting admin approval.');

} catch (Exception $e) {
    Response::serverError('Registration failed: ' . $e->getMessage());
}

?>
