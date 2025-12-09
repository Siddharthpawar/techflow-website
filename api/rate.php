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
        'status' => 'error',
        'message' => 'Method not allowed. Use POST.'
    ]);
    exit();
}

// Get JSON input
$input = json_decode(file_get_contents('php://input'), true);

// Validate input
if (!isset($input['product_id']) || !isset($input['rating'])) {
    http_response_code(400);
    echo json_encode([
        'status' => 'error',
        'message' => 'Missing required fields: product_id and rating'
    ]);
    exit();
}

$product_id = trim($input['product_id']);
$rating = (int) $input['rating'];

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

// Validate rating (1-5)
if ($rating < 1 || $rating > 5) {
    http_response_code(400);
    echo json_encode([
        'status' => 'error',
        'message' => 'Rating must be between 1 and 5'
    ]);
    exit();
}

// Save rating to database
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
    
    $stmt = $pdo->prepare("
        INSERT INTO product_ratings (product_id, rating, user_ip, user_agent) 
        VALUES (:product_id, :rating, :user_ip, :user_agent)
    ");
    
    $stmt->execute([
        ':product_id' => $product_id,
        ':rating' => $rating,
        ':user_ip' => $user_ip,
        ':user_agent' => $user_agent
    ]);
    
    // Get average rating for the product
    $avgStmt = $pdo->prepare("
        SELECT AVG(rating) as avg_rating, COUNT(*) as total_ratings 
        FROM product_ratings 
        WHERE product_id = :product_id
    ");
    $avgStmt->execute([':product_id' => $product_id]);
    $avgResult = $avgStmt->fetch(PDO::FETCH_ASSOC);
    
    echo json_encode([
        'status' => 'success',
        'message' => 'Rating submitted successfully',
        'data' => [
            'product_id' => $product_id,
            'rating' => $rating,
            'average_rating' => round((float)$avgResult['avg_rating'], 2),
            'total_ratings' => (int)$avgResult['total_ratings']
        ]
    ]);
    
} catch(PDOException $e) {
    http_response_code(500);
    echo json_encode([
        'status' => 'error',
        'message' => 'Failed to save rating: ' . $e->getMessage()
    ]);
}
?>

