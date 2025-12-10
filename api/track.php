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

// Get form data (application/x-www-form-urlencoded)
if ($method === 'POST') {
    $product_id = isset($_POST['product_id']) ? trim($_POST['product_id']) : null;
    $user = isset($_POST['user']) ? trim($_POST['user']) : null;
} else {
    $product_id = isset($_GET['product_id']) ? trim($_GET['product_id']) : null;
    $user = isset($_GET['user']) ? trim($_GET['user']) : null;
}

// Validate product_id
if (empty($product_id)) {
    http_response_code(400);
    echo json_encode([
        'success' => false,
        'message' => 'product_id is required'
    ]);
    exit();
}

// Validate user (required for tracking)
if (empty($user)) {
    http_response_code(400);
    echo json_encode([
        'success' => false,
        'message' => 'user is required'
    ]);
    exit();
}

// Validate product exists
$products = get_product_data();
if (!isset($products[$product_id])) {
    http_response_code(404);
    echo json_encode([
        'success' => false,
        'message' => 'Product not found'
    ]);
    exit();
}

// Save tracking data to database
if ($pdo === null) {
    http_response_code(500);
    echo json_encode([
        'success' => false,
        'message' => 'Database connection failed'
    ]);
    exit();
}

try {
    $user_ip = $_SERVER['REMOTE_ADDR'] ?? null;
    $user_agent = $_SERVER['HTTP_USER_AGENT'] ?? null;
    $referer = $_SERVER['HTTP_REFERER'] ?? null;
    $page_url = $_SERVER['REQUEST_URI'] ?? null;
    
    $stmt = $pdo->prepare("
        INSERT INTO visit_tracking (product_id, user_id, page_url, user_ip, user_agent, referer) 
        VALUES (:product_id, :user_id, :page_url, :user_ip, :user_agent, :referer)
    ");
    
    $stmt->execute([
        ':product_id' => $product_id,
        ':user_id' => $user,
        ':page_url' => $page_url,
        ':user_ip' => $user_ip,
        ':user_agent' => $user_agent,
        ':referer' => $referer
    ]);
    
    // Also update cookie-based tracking (for backward compatibility)
    track_product_view($product_id);
    
    echo json_encode([
        'success' => true,
        'message' => 'Visit tracked',
        'product_id' => $product_id
    ]);
    
} catch(PDOException $e) {
    http_response_code(500);
    echo json_encode([
        'success' => false,
        'message' => 'Failed to track visit: ' . $e->getMessage()
    ]);
}
?>
