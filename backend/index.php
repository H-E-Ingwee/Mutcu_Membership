<?php
/**
 * MUTCU Digital Membership System - API Router
 * Main entry point for all API requests
 */

header('Content-Type: application/json; charset=utf-8');

// Load configuration
require_once __DIR__ . '/config/Config.php';
require_once __DIR__ . '/middleware/CORS.php';

// Handle CORS
CORS::handle();

// Parse request
$requestMethod = $_SERVER['REQUEST_METHOD'];
$requestPath = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

// Remove base path
$basePath = '/backend/api';
if (strpos($requestPath, $basePath) === 0) {
    $requestPath = substr($requestPath, strlen($basePath));
}

// Remove leading/trailing slashes
$requestPath = trim($requestPath, '/');

// Route requests
$segments = explode('/', $requestPath);

if (empty($requestPath)) {
    http_response_code(404);
    echo json_encode(['success' => false, 'message' => 'API endpoint not found']);
    exit;
}

// Route to appropriate handler
$controller = $segments[0] ?? '';
$action = $segments[1] ?? '';

$routeFile = null;

// Route mapping
switch ($controller) {
    case 'auth':
        switch ($action) {
            case 'login':
                $routeFile = __DIR__ . '/api/auth/login.php';
                break;
            case 'register':
                $routeFile = __DIR__ . '/api/auth/register.php';
                break;
            case 'logout':
                $routeFile = __DIR__ . '/api/auth/logout.php';
                break;
        }
        break;

    case 'members':
        switch ($action) {
            case 'list':
                $routeFile = __DIR__ . '/api/members/list.php';
                break;
            case 'get':
                $routeFile = __DIR__ . '/api/members/get.php';
                break;
            case 'create':
                $routeFile = __DIR__ . '/api/members/create.php';
                break;
            case 'update':
                $routeFile = __DIR__ . '/api/members/update.php';
                break;
            case 'delete':
                $routeFile = __DIR__ . '/api/members/delete.php';
                break;
            case 'approve':
                $routeFile = __DIR__ . '/api/members/approve.php';
                break;
        }
        break;

    case 'admin':
        switch ($action) {
            case 'dashboard':
                $routeFile = __DIR__ . '/api/admin/dashboard.php';
                break;
            case 'directory':
                $routeFile = __DIR__ . '/api/admin/directory.php';
                break;
            case 'content':
                $routeFile = __DIR__ . '/api/admin/content.php';
                break;
        }
        break;

    case 'leadership':
        switch ($action) {
            case 'directory':
                $routeFile = __DIR__ . '/api/leadership/directory.php';
                break;
        }
        break;

    case 'ministries':
        switch ($action) {
            case 'list':
                $routeFile = __DIR__ . '/api/ministries/list.php';
                break;
            case 'members':
                $routeFile = __DIR__ . '/api/ministries/members.php';
                break;
        }
        break;
}

// Handle request
if ($routeFile && file_exists($routeFile)) {
    require_once $routeFile;
} else {
    http_response_code(404);
    echo json_encode([
        'success' => false,
        'message' => 'API endpoint not found',
        'path' => $requestPath
    ]);
}

?>
