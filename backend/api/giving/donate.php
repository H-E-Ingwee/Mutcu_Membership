<?php
// ========================================
// GIVING/DONATIONS - CREATE & TRACK
// POST /api/giving/donate - Submit donation
// GET /api/giving/history - Get donation history (auth)
// GET /api/giving/summary - Get giving summary (admin)
// ========================================

require_once '../../config/Config.php';
require_once '../../config/Database.php';
require_once '../../utils/Response.php';
require_once '../../utils/Validator.php';
require_once '../../utils/Auth.php';
require_once '../../middleware/CORS.php';
require_once '../../middleware/CheckAuth.php';

$method = $_SERVER['REQUEST_METHOD'];
$action = isset($_GET['action']) ? $_GET['action'] : 'donate';
$db = Database::getInstance();
$validator = new Validator();

if ($method === 'POST' && $action === 'donate') {
    // SUBMIT DONATION
    
    CheckAuth::required();
    $user = Auth::getCurrentUser();
    
    $input = $validator->getJSONInput();
    
    $amount = $input['amount'] ?? null;
    $giving_type = $input['giving_type'] ?? 'offering';
    $payment_method = $input['payment_method'] ?? 'mpesa';
    $reference_number = $input['reference_number'] ?? null;
    $description = $input['description'] ?? null;
    $ministry_id = $input['ministry_id'] ?? null;
    
    // Validate amount
    if (!$amount || !is_numeric($amount) || $amount <= 0) {
        Response::validationError('Amount must be a positive number');
        exit;
    }
    
    if (!in_array($giving_type, ['tithe', 'offering', 'project', 'welfare', 'special'])) {
        Response::validationError('Invalid giving type');
        exit;
    }
    
    if (!in_array($payment_method, ['mpesa', 'bank_transfer', 'card', 'cash', 'cheque'])) {
        Response::validationError('Invalid payment method');
        exit;
    }
    
    // Verify ministry if provided
    if ($ministry_id) {
        $ministry = $db->fetchOne("SELECT id FROM ministries WHERE id = ?", [$ministry_id]);
        if (!$ministry) {
            Response::notFound('Ministry not found');
            exit;
        }
    }
    
    try {
        $db->beginTransaction();
        
        $transactionId = $db->insert('giving_transactions', [
            'user_id' => $user['id'],
            'amount' => round($amount, 2),
            'currency' => 'KES',
            'giving_type' => $giving_type,
            'payment_method' => $payment_method,
            'reference_number' => $reference_number,
            'description' => $validator->sanitizeString($description),
            'ministry_id' => $ministry_id,
            'status' => 'pending'
        ]);
        
        // Log action
        $db->insert('audit_logs', [
            'user_id' => $user['id'],
            'action' => 'giving_submitted',
            'description' => "Donation submitted: {$giving_type} - KES {$amount}"
        ]);
        
        // Create notification
        $db->insert('notifications', [
            'user_id' => $user['id'],
            'notification_type' => 'giving_confirmation',
            'title' => 'Donation Received',
            'message' => "Thank you for your {$giving_type} of KES {$amount}",
            'related_id' => $transactionId,
            'related_type' => 'giving'
        ]);
        
        $db->commit();
        
        Response::created([
            'id' => $transactionId,
            'status' => 'pending'
        ], 'Donation received. Awaiting confirmation.');
        
    } catch (Exception $e) {
        $db->rollback();
        Response::serverError('Failed to process donation: ' . $e->getMessage());
    }
    
} else if ($method === 'GET' && $action === 'history') {
    // GET DONATION HISTORY (PERSONAL)
    
    CheckAuth::required();
    $user = Auth::getCurrentUser();
    
    $page = isset($_GET['page']) ? max(1, intval($_GET['page'])) : 1;
    $perPage = isset($_GET['perPage']) ? min(100, intval($_GET['perPage'])) : 10;
    
    $offset = ($page - 1) * $perPage;
    
    // Get total count
    $total = $db->fetchOne(
        "SELECT COUNT(*) as count FROM giving_transactions WHERE user_id = ?",
        [$user['id']]
    );
    
    $sql = "SELECT 
        id, amount, currency, giving_type, status,
        payment_method, reference_number, description,
        created_at, confirmed_at
    FROM giving_transactions
    WHERE user_id = ?
    ORDER BY created_at DESC
    LIMIT ? OFFSET ?";
    
    $transactions = $db->fetchAll($sql, [$user['id'], $perPage, $offset]);
    
    // Calculate statistics
    $stats = $db->fetchOne(
        "SELECT 
            COUNT(*) as total_transactions,
            SUM(CASE WHEN status = 'confirmed' THEN amount ELSE 0 END) as total_confirmed,
            COUNT(DISTINCT MONTH(created_at)) as months_involved
        FROM giving_transactions WHERE user_id = ? AND YEAR(created_at) = YEAR(NOW())",
        [$user['id']]
    );
    
    Response::paginated($transactions, $page, $perPage, $total['count'], [
        'statistics' => $stats
    ]);
    
} else if ($method === 'GET' && $action === 'summary') {
    // GET GIVING SUMMARY (ADMIN ONLY)
    
    CheckAuth::requireAdmin();
    
    $sql = "SELECT 
        DATE_TRUNC(created_at, MONTH) as month,
        giving_type,
        COUNT(*) as transaction_count,
        SUM(amount) as total_amount,
        AVG(amount) as average_amount,
        COUNT(CASE WHEN status = 'confirmed' THEN 1 END) as confirmed_count
    FROM giving_transactions
    GROUP BY DATE_TRUNC(created_at, MONTH), giving_type
    ORDER BY month DESC";
    
    $summary = $db->fetchAll($sql);
    
    // Total giving this year
    $total = $db->fetchOne(
        "SELECT 
            SUM(CASE WHEN status = 'confirmed' THEN amount ELSE 0 END) as confirmed_total,
            COUNT(*) as total_transactions
        FROM giving_transactions
        WHERE YEAR(created_at) = YEAR(NOW())"
    );
    
    Response::success('Giving summary', [
        'summary' => $summary,
        'year_summary' => $total
    ]);
    
} else {
    Response::error('Invalid action', null, 400);
}
