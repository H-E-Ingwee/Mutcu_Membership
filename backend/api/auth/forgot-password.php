<?php
// ========================================
// PASSWORD RESET - REQUEST ENDPOINT
// POST /api/auth/forgot-password
// ========================================

require_once '../../config/Config.php';
require_once '../../config/Database.php';
require_once '../../utils/Response.php';
require_once '../../utils/Validator.php';
require_once '../../middleware/CORS.php';

$validator = new Validator();

// Get input
$input = $validator->getJSONInput();
$email = $input['email'] ?? null;

// Validate email
if (!$email || !$validator->validateEmail($email)) {
    Response::validationError('Please provide a valid email address');
    exit;
}

$db = Database::getInstance();

// Check if user exists
$user = $db->fetchOne(
    "SELECT id, first_name, last_name, email FROM users WHERE email = ?",
    [$email]
);

if (!$user) {
    // For security, don't reveal if email exists
    Response::success('If an account with that email exists, you will receive a password reset link');
    exit;
}

// Generate reset token
$token = bin2hex(random_bytes(32));
$expiresAt = date('Y-m-d H:i:s', time() + (24 * 60 * 60)); // 24 hours

// Store reset token in database
try {
    $db->insert('password_reset_tokens', [
        'user_id' => $user['id'],
        'token' => hash('sha256', $token),
        'expires_at' => $expiresAt
    ]);
    
    // Log this action
    $db->insert('audit_logs', [
        'user_id' => $user['id'],
        'action' => 'password_reset_requested',
        'description' => 'Password reset requested for email: ' . $email
    ]);
    
    // TODO: Send email with reset link
    // Email would contain: http://yoursite.com/reset-password?token={$token}
    // For now, we'll return the token in development  
    if (APP_ENV === 'development') {
        Response::success('Password reset link sent', [
            'reset_token' => $token,
            'note' => 'In production, this would be sent via email'
        ]);
    } else {
        Response::success('If an account with that email exists, you will receive a password reset link');
    }
    
} catch (Exception $e) {
    Response::serverError('Failed to initiate password reset: ' . $e->getMessage());
}
