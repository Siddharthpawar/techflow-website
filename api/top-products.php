<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET');
header('Access-Control-Allow-Headers: Content-Type');

require_once '../config/db.php';
require_once '../cookie_tracker.php';

// Get top 5 products based on visit count and ratings
if ($pdo === null) {
    // Fallback to cookie-based tracking if database is not available
    $popular = get_most_visited();
    arsort($popular);
    $top5 = array_slice($popular, 0, 5, true);
    
    $products = get_product_data();
    $items = [];
    
    foreach ($top5 as $product_id => $visits) {
        if (isset($products[$product_id])) {
            $product = $products[$product_id];
            $priceStr = $product['price'];
            $price = 0;
            if (preg_match('/[\d,]+/', $priceStr, $matches)) {
                $price = (int) str_replace(',', '', $matches[0]);
            }
            
            $thumbnail = 'https://images.unsplash.com/photo-1467269204594-9661b134dd2b?q=80&w=1400&auto=format&fit=crop';
            if (isset($product['image']) && filter_var($product['image'], FILTER_VALIDATE_URL)) {
                $thumbnail = $product['image'];
            }
            
            $category = 'service';
            if (stripos($product_id, 'web') !== false || stripos($product_id, 'mobile') !== false) {
                $category = 'development';
            } elseif (stripos($product_id, 'cloud') !== false || stripos($product_id, 'devops') !== false) {
                $category = 'infrastructure';
            } elseif (stripos($product_id, 'ai') !== false || stripos($product_id, 'data') !== false) {
                $category = 'analytics';
            }
            
            $items[] = [
                'id' => $product_id,
                'name' => $product['title'],
                'price' => $price,
                'company' => 'NovaTrail',
                'category' => $category,
                'thumbnail' => $thumbnail,
                'description' => $product['description'],
                'visit_count' => $visits
            ];
        }
    }
    
    echo json_encode([
        'company' => 'NovaTrail',
        'items' => $items
    ], JSON_PRETTY_PRINT);
    exit();
}

try {
    // Get top 5 products based on visit count and average rating
    $stmt = $pdo->query("
        SELECT 
            vt.product_id,
            COUNT(vt.id) as visit_count,
            COALESCE(AVG(pr.rating), 0) as avg_rating,
            COUNT(pr.id) as rating_count
        FROM visit_tracking vt
        LEFT JOIN product_ratings pr ON vt.product_id = pr.product_id
        GROUP BY vt.product_id
        ORDER BY visit_count DESC, avg_rating DESC
        LIMIT 5
    ");
    
    $topProducts = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    $products = get_product_data();
    $items = [];
    
    foreach ($topProducts as $row) {
        $product_id = $row['product_id'];
        if (isset($products[$product_id])) {
            $product = $products[$product_id];
            $priceStr = $product['price'];
            $price = 0;
            if (preg_match('/[\d,]+/', $priceStr, $matches)) {
                $price = (int) str_replace(',', '', $matches[0]);
            }
            
            $thumbnail = 'https://images.unsplash.com/photo-1467269204594-9661b134dd2b?q=80&w=1400&auto=format&fit=crop';
            if (isset($product['image']) && filter_var($product['image'], FILTER_VALIDATE_URL)) {
                $thumbnail = $product['image'];
            }
            
            $category = 'service';
            if (stripos($product_id, 'web') !== false || stripos($product_id, 'mobile') !== false) {
                $category = 'development';
            } elseif (stripos($product_id, 'cloud') !== false || stripos($product_id, 'devops') !== false) {
                $category = 'infrastructure';
            } elseif (stripos($product_id, 'ai') !== false || stripos($product_id, 'data') !== false) {
                $category = 'analytics';
            } elseif (stripos($product_id, 'security') !== false || stripos($product_id, 'cyber') !== false) {
                $category = 'security';
            } elseif (stripos($product_id, 'consulting') !== false) {
                $category = 'consulting';
            }
            
            $items[] = [
                'id' => $product_id,
                'name' => $product['title'],
                'price' => $price,
                'company' => 'NovaTrail',
                'category' => $category,
                'thumbnail' => $thumbnail,
                'description' => $product['description'],
                'visit_count' => (int)$row['visit_count'],
                'average_rating' => round((float)$row['avg_rating'], 2),
                'rating_count' => (int)$row['rating_count']
            ];
        }
    }
    
    // If no database results, fallback to cookie-based tracking
    if (empty($items)) {
        $popular = get_most_visited();
        arsort($popular);
        $top5 = array_slice($popular, 0, 5, true);
        
        foreach ($top5 as $product_id => $visits) {
            if (isset($products[$product_id])) {
                $product = $products[$product_id];
                $priceStr = $product['price'];
                $price = 0;
                if (preg_match('/[\d,]+/', $priceStr, $matches)) {
                    $price = (int) str_replace(',', '', $matches[0]);
                }
                
                $thumbnail = 'https://images.unsplash.com/photo-1467269204594-9661b134dd2b?q=80&w=1400&auto=format&fit=crop';
                if (isset($product['image']) && filter_var($product['image'], FILTER_VALIDATE_URL)) {
                    $thumbnail = $product['image'];
                }
                
                $category = 'service';
                if (stripos($product_id, 'web') !== false || stripos($product_id, 'mobile') !== false) {
                    $category = 'development';
                } elseif (stripos($product_id, 'cloud') !== false || stripos($product_id, 'devops') !== false) {
                    $category = 'infrastructure';
                } elseif (stripos($product_id, 'ai') !== false || stripos($product_id, 'data') !== false) {
                    $category = 'analytics';
                }
                
                $items[] = [
                    'id' => $product_id,
                    'name' => $product['title'],
                    'price' => $price,
                    'company' => 'NovaTrail',
                    'category' => $category,
                    'thumbnail' => $thumbnail,
                    'description' => $product['description'],
                    'visit_count' => $visits
                ];
            }
        }
    }
    
    echo json_encode([
        'company' => 'NovaTrail',
        'items' => $items
    ], JSON_PRETTY_PRINT);
    
} catch(PDOException $e) {
    http_response_code(500);
    echo json_encode([
        'status' => 'error',
        'message' => 'Failed to retrieve top products: ' . $e->getMessage()
    ]);
}
?>

