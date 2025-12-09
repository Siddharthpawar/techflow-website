<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, GET');
header('Access-Control-Allow-Headers: Content-Type');

require_once '../config/db.php';
require_once '../cookie_tracker.php';

// Handle preflight OPTIONS request
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit();
}

// Allow both GET and POST for tracking
$method = $_SERVER['REQUEST_METHOD'];

// Start session to get user_id if available
session_start();

// Get tracking data
if ($method === 'POST') {
    $input = json_decode(file_get_contents('php://input'), true);
    $product_id = $input['product_id'] ?? $_POST['product_id'] ?? null;
    $user_id = $input['user_id'] ?? $_POST['user_id'] ?? $_SESSION['user_id'] ?? $_SESSION['userid'] ?? null;
    $page_url = $input['page_url'] ?? $_POST['page_url'] ?? $_SERVER['REQUEST_URI'] ?? null;
} else {
    $product_id = $_GET['product_id'] ?? null;
    $user_id = $_GET['user_id'] ?? $_SESSION['user_id'] ?? $_SESSION['userid'] ?? null;
    $page_url = $_GET['page_url'] ?? $_SERVER['REQUEST_URI'] ?? null;
}

// Validate product_id
if (empty($product_id)) {
    http_response_code(400);
    echo json_encode([
        'status' => 'error',
        'message' => 'product_id is required'
    ]);
    exit();
}

// Validate user_id (required for tracking)
if (empty($user_id)) {
    http_response_code(400);
    echo json_encode([
        'status' => 'error',
        'message' => 'user_id is required. Please provide user_id in request or ensure user is logged in.'
    ]);
    exit();
}

// Validate product exists
$products = get_product_data();
if (!isset($products[$product_id])) {
    http_response_code(404);
    echo json_encode([
        'status' => 'error',
        'message' => 'Product not found'
    ]);
    exit();
}

// Save tracking data to database
if ($pdo === null) {
    http_response_code(500);
    echo json_encode([
        'status' => 'error',
        'message' => 'Database connection failed'
    ]);
    exit();
}

try {
    $user_ip = $_SERVER['REMOTE_ADDR'] ?? null;
    $user_agent = $_SERVER['HTTP_USER_AGENT'] ?? null;
    $referer = $_SERVER['HTTP_REFERER'] ?? null;
    
    $stmt = $pdo->prepare("
        INSERT INTO visit_tracking (product_id, user_id, page_url, user_ip, user_agent, referer) 
        VALUES (:product_id, :user_id, :page_url, :user_ip, :user_agent, :referer)
    ");
    
    $stmt->execute([
        ':product_id' => $product_id,
        ':user_id' => $user_id,
        ':page_url' => $page_url,
        ':user_ip' => $user_ip,
        ':user_agent' => $user_agent,
        ':referer' => $referer
    ]);
    
    // Also update cookie-based tracking (for backward compatibility)
    track_product_view($product_id);
    
    // Get visit statistics for this product
    $statsStmt = $pdo->prepare("
        SELECT COUNT(*) as total_visits 
        FROM visit_tracking 
        WHERE product_id = :product_id
    ");
    $statsStmt->execute([':product_id' => $product_id]);
    $stats = $statsStmt->fetch(PDO::FETCH_ASSOC);
    
    // Get user-specific visit count for this product
    $userStatsStmt = $pdo->prepare("
        SELECT COUNT(*) as user_visits 
        FROM visit_tracking 
        WHERE product_id = :product_id AND user_id = :user_id
    ");
    $userStatsStmt->execute([
        ':product_id' => $product_id,
        ':user_id' => $user_id
    ]);
    $userStats = $userStatsStmt->fetch(PDO::FETCH_ASSOC);
    
    echo json_encode([
        'status' => 'success',
        'message' => 'Visit tracked successfully',
        'data' => [
            'product_id' => $product_id,
            'user_id' => $user_id,
            'page_url' => $page_url,
            'total_visits' => (int)$stats['total_visits'],
            'user_visits' => (int)$userStats['user_visits']
        ]
    ]);
    
} catch(PDOException $e) {
    http_response_code(500);
    echo json_encode([
        'status' => 'error',
        'message' => 'Failed to track visit: ' . $e->getMessage()
    ]);
}
?>

