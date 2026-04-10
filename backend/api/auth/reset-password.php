<?php
// ========================================
// PASSWORD RESET - VALIDATE AND RESET
// POST /api/auth/reset-password
// ========================================

require_once '../../config/Config.php';
require_once '../../config/Database.php';
require_once '../../utils/Response.php';
require_once '../../utils/Validator.php';
require_once '../../utils/Auth.php';
require_once '../../middleware/CORS.php';

$validator = new Validator();

// Get input
$input = $validator->getJSONInput();
$token = $input['token'] ?? null;
$password = $input['password'] ?? null;
$passwordConfirm = $input['password_confirm'] ?? null;

// Validate inputs
if (!$token) {
    Response::validationError('Reset token is required');
    exit;
}

if (!$password || !$validator->validatePassword($password)) {
    Response::validationError('Password must be at least 8 characters with uppercase, lowercase, and numbers');
    exit;
}

if ($password !== $passwordConfirm) {
    Response::validationError('Passwords do not match');
    exit;
}

$db = Database::getInstance();

// Find and verify reset token
$hashedToken = hash('sha256', $token);
$resetRecord = $db->fetchOne(
    "SELECT user_id FROM password_reset_tokens 
     WHERE token = ? AND expires_at > NOW() AND used_at IS NULL",
    [$hashedToken]
);

if (!$resetRecord) {
    Response::error('Reset token is invalid or expired', null, 400);
    exit;
}

try {
    // Start transaction
    $db->beginTransaction();
    
    // Update password
    $hashedPassword = Auth::hashPassword($password);
    $db->update('users', 
        ['password' => $hashedPassword],
        ['id' => $resetRecord['user_id']]
    );
    
    // Mark token as used
    $db->update('password_reset_tokens',
        ['used_at' => date('Y-m-d H:i:s')],
        ['token' => $hashedToken]
    );
    
    // Invalidate all other reset tokens for this user
    $db->delete('password_reset_tokens', 
        ['user_id' => $resetRecord['user_id'], 'used_at' => null]
    );
    
    // Log action
    $db->insert('audit_logs', [
        'user_id' => $resetRecord['user_id'],
        'action' => 'password_reset',
        'description' => 'Password successfully reset'
    ]);
    
    $db->commit();
    
    Response::success('Password reset successfully. You can now login with your new password');
    
} catch (Exception $e) {
    $db->rollback();
    Response::serverError('Failed to reset password: ' . $e->getMessage());
}
