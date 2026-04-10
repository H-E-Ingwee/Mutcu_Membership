<?php
// ========================================
// DOCUMENT LIBRARY - LIST & DOWNLOAD
// GET /api/documents/list - List documents
// GET /api/documents/download - Download document
// POST /api/documents/upload - Upload document (admin)
// ========================================

require_once '../../config/Config.php';
require_once '../../config/Database.php';
require_once '../../utils/Response.php';
require_once '../../utils/Validator.php';
require_once '../../utils/Auth.php';
require_once '../../middleware/CORS.php';
require_once '../../middleware/CheckAuth.php';

$method = $_SERVER['REQUEST_METHOD'];
$action = isset($_GET['action']) ? $_GET['action'] : 'list';
$db = Database::getInstance();
$validator = new Validator();

if ($method === 'GET' && $action === 'list') {
    // LIST DOCUMENTS
    
    $page = isset($_GET['page']) ? max(1, intval($_GET['page'])) : 1;
    $perPage = isset($_GET['perPage']) ? min(100, intval($_GET['perPage'])) : 20;
    $category = isset($_GET['category']) ? $_GET['category'] : null;
    
    $offset = ($page - 1) * $perPage;
    
    // Check if user is authenticated
    $isAuthenticated = false;
    $user = null;
    
    try {
        $user = Auth::getCurrentUser();
        $isAuthenticated = true;
    } catch (Exception $e) {
        // Not authenticated
    }
    
    // Build visibility filter
    $where = "1=1";
    $params = [];
    
    if (!$isAuthenticated) {
        // Public only
        $where .= " AND visibility = 'public'";
    } else if ($user['role'] !== 'admin') {
        // Members only or public
        $where .= " AND (visibility = 'public' OR visibility = 'members_only')";
    }
    
    if ($category && in_array($category, ['constitution', 'leadership_manual', 'policy', 'procedures', 'report', 'form', 'other'])) {
        $where .= " AND category = ?";
        $params[] = $category;
    }
    
    // Get total count
    $total = $db->fetchOne("SELECT COUNT(*) as count FROM documents WHERE $where", $params);
    
    // Get documents
    $sql = "SELECT 
        id, title, description, category, file_type,
        file_size, version, download_count,
        CONCAT(u.first_name, ' ', u.last_name) as uploaded_by,
        DATE_FORMAT(updated_at, '%Y-%m-%d') as last_updated
    FROM documents d
    LEFT JOIN users u ON d.uploaded_by = u.id
    WHERE $where
    ORDER BY updated_at DESC
    LIMIT ? OFFSET ?";
    
    $params[] = $perPage;
    $params[] = $offset;
    
    $documents = $db->fetchAll($sql, $params);
    
    // Format file sizes
    foreach ($documents as &$doc) {
        $doc['file_size_display'] = formatBytes($doc['file_size']);
    }
    
    Response::paginated($documents, $page, $perPage, $total['count']);
    
} else if ($method === 'GET' && $action === 'download') {
    // DOWNLOAD DOCUMENT
    
    $docId = isset($_GET['id']) ? intval($_GET['id']) : null;
    
    if (!$docId) {
        Response::validationError('Document ID is required');
        exit;
    }
    
    // Check if user can access
    $isAuthenticated = false;
    $user = null;
    
    try {
        $user = Auth::getCurrentUser();
        $isAuthenticated = true;
    } catch (Exception $e) {
        // Not authenticated
    }
    
    $doc = $db->fetchOne("SELECT * FROM documents WHERE id = ?", [$docId]);
    
    if (!$doc) {
        Response::notFound('Document not found');
        exit;
    }
    
    // Check visibility
    if ($doc['visibility'] === 'members_only' && !$isAuthenticated) {
        Response::unauthorized('Authentication required to access this document');
        exit;
    }
    
    if ($doc['visibility'] === 'leadership_only' && (!$isAuthenticated || $user['role'] !== 'admin')) {
        Response::forbidden('You do not have permission to access this document');
        exit;
    }
    
    // Update download count
    $db->update('documents',
        ['download_count' => $doc['download_count'] + 1],
        ['id' => $docId]
    );
    
    // Log action if authenticated
    if ($isAuthenticated) {
        $db->insert('audit_logs', [
            'user_id' => $user['id'],
            'action' => 'document_downloaded',
            'description' => "Downloaded: {$doc['title']}"
        ]);
    }
    
    // Return download URL or file path
    Response::success('Document ready for download', [
        'id' => $doc['id'],
        'title' => $doc['title'],
        'file_path' => $doc['file_path'],
        'download_count' => $doc['download_count'] + 1
    ]);
    
} else if ($method === 'POST' && $action === 'upload') {
    // UPLOAD DOCUMENT (ADMIN ONLY)
    
    CheckAuth::requireAdmin();
    $user = Auth::getCurrentUser();
    
    $title = $_POST['title'] ?? null;
    $description = $_POST['description'] ?? null;
    $category = $_POST['category'] ?? 'other';
    $version = $_POST['version'] ?? '1.0';
    $visibility = $_POST['visibility'] ?? 'members_only';
    
    if (!$title) {
        Response::validationError('Title is required');
        exit;
    }
    
    if (!isset($_FILES['file']) || $_FILES['file']['error'] !== UPLOAD_ERR_OK) {
        Response::validationError('File upload failed');
        exit;
    }
    
    $file = $_FILES['file'];
    $allowedTypes = ['application/pdf', 'application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document'];
    $maxSize = 50 * 1024 * 1024; // 50MB
    
    if (!in_array($file['type'], $allowedTypes)) {
        Response::validationError('Only PDF and Word documents are allowed');
        exit;
    }
    
    if ($file['size'] > $maxSize) {
        Response::validationError('File size exceeds maximum of 50MB');
        exit;
    }
    
    try {
        $db->beginTransaction();
        
        // Create uploads directory if needed
        $uploadDir = '../../uploads/documents/';
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0755, true);
        }
        
        // Generate unique filename
        $filename = uniqid() . '_' . basename($file['name']);
        $filepath = $uploadDir . $filename;
        
        // Move uploaded file
        if (!move_uploaded_file($file['tmp_name'], $filepath)) {
            throw new Exception('Failed to save file');
        }
        
        // Store in database
        $docId = $db->insert('documents', [
            'title' => $validator->sanitizeString($title),
            'description' => $validator->sanitizeString($description),
            'category' => $category,
            'file_path' => $filename,
            'file_type' => pathinfo($file['name'], PATHINFO_EXTENSION),
            'file_size' => $file['size'],
            'version' => $version,
            'uploaded_by' => $user['id'],
            'visibility' => $visibility
        ]);
        
        // Log action
        $db->insert('audit_logs', [
            'user_id' => $user['id'],
            'action' => 'document_uploaded',
            'description' => "Document uploaded: {$title}"
        ]);
        
        $db->commit();
        
        Response::created(['id' => $docId], 'Document uploaded successfully');
        
    } catch (Exception $e) {
        $db->rollback();
        Response::serverError('Failed to upload document: ' . $e->getMessage());
    }
    
} else {
    Response::error('Invalid action', null, 400);
}

// Helper function to format bytes
function formatBytes($bytes, $precision = 2) {
    $units = ['B', 'KB', 'MB', 'GB'];
    $bytes = max($bytes, 0);
    $pow = floor(($bytes ? log($bytes) : 0) / log(1024));
    $pow = min($pow, count($units) - 1);
    $bytes /= (1 << (10 * $pow));
    return round($bytes, $precision) . ' ' . $units[$pow];
}
