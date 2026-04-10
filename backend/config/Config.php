<?php
/**
 * MUTCU Digital Membership System
 * Configuration File
 * Version 1.0
 */

// Enable error reporting for development (disable in production)
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Database Configuration
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'mutcu_membership');
define('DB_CHARSET', 'utf8mb4');

// Application Settings
define('APP_NAME', 'MUTCU Digital Membership System');
define('APP_VERSION', '1.0.0');
define('APP_ENV', 'development'); // development or production

// Session Configuration
define('SESSION_TIMEOUT', 3600); // 1 hour in seconds
define('SESSION_NAME', 'mutcu_session');

// Security Settings
define('PASSWORD_HASH_ALGO', PASSWORD_BCRYPT);
define('PASSWORD_HASH_OPTIONS', ['cost' => 11]);
define('JWT_SECRET', 'mutcu_secret_key_2025_change_in_production');

// CORS Configuration
define('ALLOWED_ORIGINS', [
    'http://localhost:3000',
    'http://localhost:5173',
    'http://localhost',
    'http://127.0.0.1'
]);

// File Upload Settings
define('MAX_UPLOAD_SIZE', 5242880); // 5MB
define('ALLOWED_UPLOAD_TYPES', ['image/jpeg', 'image/png', 'image/gif']);
define('UPLOAD_DIR', __DIR__ . '/../uploads/');

// Email Configuration (for password reset, notifications)
define('SMTP_HOST', 'smtp.gmail.com');
define('SMTP_PORT', 587);
define('SMTP_USER', 'mutcu@example.com');
define('SMTP_PASS', 'your_app_password');
define('EMAIL_FROM', 'noreply@mutcu.org');
define('EMAIL_FROM_NAME', 'MUTCU Digital Hub');

// Set timezone
date_default_timezone_set('Africa/Nairobi');

// Initialize PHP settings
header('Content-Type: application/json; charset=utf-8');
header('X-Content-Type-Options: nosniff');
header('X-Frame-Options: DENY');
header('X-XSS-Protection: 1; mode=block');

?>
