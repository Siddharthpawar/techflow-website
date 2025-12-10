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

// Only allow POST requests for rating
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode([
        'success' => false,
        'message' => 'Method not allowed. Use POST.'
    ]);
    exit();
}

// Get form data (application/x-www-form-urlencoded)
$product_id = isset($_POST['product_id']) ? trim($_POST['product_id']) : null;
$rating = isset($_POST['rating']) ? (int)$_POST['rating'] : null;
$comment = isset($_POST['comment']) ? trim($_POST['comment']) : null;
$user = isset($_POST['user']) ? trim($_POST['user']) : null;
$email = isset($_POST['email']) ? trim($_POST['email']) : null;

// Validate required fields
if (empty($product_id) || $rating === null) {
    http_response_code(400);
    echo json_encode([
        'success' => false,
        'message' => 'Missing required fields: product_id and rating'
    ]);
    exit();
}

// Validate rating (1-5)
if ($rating < 1 || $rating > 5) {
    http_response_code(400);
    echo json_encode([
        'success' => false,
        'message' => 'Rating must be between 1 and 5'
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

// Save rating to database
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
    
    $stmt = $pdo->prepare("
        INSERT INTO product_ratings (product_id, rating, comment, user, email, user_ip, user_agent) 
        VALUES (:product_id, :rating, :comment, :user, :email, :user_ip, :user_agent)
    ");
    
    $stmt->execute([
        ':product_id' => $product_id,
        ':rating' => $rating,
        ':comment' => $comment ?: null,
        ':user' => $user ?: null,
        ':email' => $email ?: null,
        ':user_ip' => $user_ip,
        ':user_agent' => $user_agent
    ]);
    
    // Get average rating and count for the product
    $avgStmt = $pdo->prepare("
        SELECT AVG(rating) as avg_rating, COUNT(*) as total_ratings 
        FROM product_ratings 
        WHERE product_id = :product_id
    ");
    $avgStmt->execute([':product_id' => $product_id]);
    $avgResult = $avgStmt->fetch(PDO::FETCH_ASSOC);
    
    echo json_encode([
        'success' => true,
        'message' => 'Rating stored',
        'product_id' => $product_id,
        'ratingAverage' => round((float)$avgResult['avg_rating'], 2),
        'ratingCount' => (int)$avgResult['total_ratings']
    ]);
    
} catch(PDOException $e) {
    http_response_code(500);
    echo json_encode([
        'success' => false,
        'message' => 'Failed to save rating: ' . $e->getMessage()
    ]);
}
?>
