<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET');
header('Access-Control-Allow-Headers: Content-Type');

require_once '../config/db.php';

// Get product_id from query parameter
$product_id = isset($_GET['product_id']) ? trim($_GET['product_id']) : null;

if (empty($product_id)) {
    http_response_code(400);
    echo json_encode([
        'success' => false,
        'message' => 'product_id is required'
    ]);
    exit();
}

// Get ratings from database
if ($pdo === null) {
    http_response_code(500);
    echo json_encode([
        'success' => false,
        'message' => 'Database connection failed'
    ]);
    exit();
}

try {
    // Get all ratings for the product
    $stmt = $pdo->prepare("
        SELECT 
            id,
            rating,
            comment,
            user,
            email,
            created_at
        FROM product_ratings 
        WHERE product_id = :product_id
        ORDER BY created_at DESC
    ");
    $stmt->execute([':product_id' => $product_id]);
    $ratings = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    // Get average rating and count
    $avgStmt = $pdo->prepare("
        SELECT 
            AVG(rating) as avg_rating,
            COUNT(*) as total_ratings
        FROM product_ratings 
        WHERE product_id = :product_id
    ");
    $avgStmt->execute([':product_id' => $product_id]);
    $stats = $avgStmt->fetch(PDO::FETCH_ASSOC);
    
    echo json_encode([
        'success' => true,
        'product_id' => $product_id,
        'average_rating' => round((float)$stats['avg_rating'], 2),
        'total_ratings' => (int)$stats['total_ratings'],
        'ratings' => $ratings
    ]);
    
} catch(PDOException $e) {
    http_response_code(500);
    echo json_encode([
        'success' => false,
        'message' => 'Failed to retrieve ratings: ' . $e->getMessage()
    ]);
}
?>


