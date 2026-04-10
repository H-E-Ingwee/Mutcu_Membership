<?php
/**
 * System Content Management
 * GET/POST /api/admin/content
 */

require_once __DIR__ . '/../../config/Config.php';
require_once __DIR__ . '/../../config/Database.php';
require_once __DIR__ . '/../../utils/Response.php';
require_once __DIR__ . '/../../utils/Validator.php';
require_once __DIR__ . '/../../utils/Auth.php';
require_once __DIR__ . '/../../middleware/CheckAuth.php';

// Verify admin authentication
CheckAuth::requireAdmin();

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // Get all content
    try {
        $db = Database::getInstance();
        
        $content = $db->fetchAll(
            'SELECT id, content_key, content_title, content_text, is_published, updated_at
             FROM system_content
             ORDER BY content_key ASC'
        );

        Response::success($content, 'Content retrieved successfully');
    } catch (Exception $e) {
        Response::serverError('Error retrieving content: ' . $e->getMessage());
    }

} elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Update content
    $input = Validator::getJSONInput();

    if (!isset($input['content_key']) || empty($input['content_key'])) {
        Response::validationError(['content_key' => 'Content key is required']);
    }

    if (!isset($input['content_text']) || empty($input['content_text'])) {
        Response::validationError(['content_text' => 'Content text is required']);
    }

    try {
        $db = Database::getInstance();
        $user = Auth::getCurrentUser();

        $contentKey = Validator::sanitizeString($input['content_key']);
        $contentTitle = isset($input['content_title']) ? Validator::sanitizeString($input['content_title']) : '';
        $contentText = $input['content_text']; // Allow HTML
        $isPublished = isset($input['is_published']) ? (bool)$input['is_published'] : true;

        // Check if content exists
        $existing = $db->fetchOne(
            'SELECT id FROM system_content WHERE content_key = ?',
            [$contentKey]
        );

        if ($existing) {
            // Update existing
            $db->update('system_content', [
                'content_title' => $contentTitle,
                'content_text' => $contentText,
                'is_published' => $isPublished ? 1 : 0,
                'last_edited_by_user_id' => $user['userId']
            ], ['content_key' => $contentKey]);

            $db->insert('audit_logs', [
                'action_type' => 'UPDATE',
                'entity_type' => 'SystemContent',
                'entity_id' => $existing['id'],
                'performed_by_user_id' => $user['userId'],
                'details' => json_encode(['content_key' => $contentKey])
            ]);
        } else {
            // Create new
            $id = $db->insert('system_content', [
                'content_key' => $contentKey,
                'content_title' => $contentTitle,
                'content_text' => $contentText,
                'is_published' => $isPublished ? 1 : 0,
                'last_edited_by_user_id' => $user['userId']
            ]);

            $db->insert('audit_logs', [
                'action_type' => 'CREATE',
                'entity_type' => 'SystemContent',
                'entity_id' => $id,
                'performed_by_user_id' => $user['userId'],
                'details' => json_encode(['content_key' => $contentKey])
            ]);
        }

        Response::success(['content_key' => $contentKey], 'Content updated successfully');

    } catch (Exception $e) {
        Response::serverError('Error updating content: ' . $e->getMessage());
    }

} else {
    Response::error('Method not allowed', 405);
}

?>
