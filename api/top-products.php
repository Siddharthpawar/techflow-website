<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET');
header('Access-Control-Allow-Headers: Content-Type');

require_once '../config/db.php';
require_once '../cookie_tracker.php';

// Thumbnail mapping for different products
function getProductThumbnail($productId) {
    $thumbnailMap = [
        'web-dev' => 'https://images.unsplash.com/photo-1461749280684-dccba630e2f6?q=80&w=1400&auto=format&fit=crop',
        'mobile-dev' => 'https://images.unsplash.com/photo-1512941937669-90a1b58e7e9c?q=80&w=1400&auto=format&fit=crop',
        'cloud-services' => 'https://images.unsplash.com/photo-1451187580459-43490279c0fa?q=80&w=1400&auto=format&fit=crop',
        'ai-ml' => 'https://images.unsplash.com/photo-1485827404703-89b55fcc595e?q=80&w=1400&auto=format&fit=crop',
        'cybersecurity' => 'https://images.unsplash.com/photo-1563013544-824ae1b704d3?q=80&w=1400&auto=format&fit=crop',
        'devops' => 'https://images.unsplash.com/photo-1558494949-ef010cbdcc31?q=80&w=1400&auto=format&fit=crop',
        'data-analytics' => 'https://images.unsplash.com/photo-1551288049-bebda4e38f71?q=80&w=1400&auto=format&fit=crop',
        'blockchain' => 'https://images.unsplash.com/photo-1639762681485-074b7f938ba0?q=80&w=1400&auto=format&fit=crop',
        'iot-solutions' => 'https://images.unsplash.com/photo-1518770660439-4636190af475?q=80&w=1400&auto=format&fit=crop',
        'consulting' => 'https://images.unsplash.com/photo-1521737604893-d14cc237f11d?q=80&w=1400&auto=format&fit=crop'
    ];
    
    return $thumbnailMap[$productId] ?? 'https://images.unsplash.com/photo-1467269204594-9661b134dd2b?q=80&w=1400&auto=format&fit=crop';
}

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
            
            $thumbnail = getProductThumbnail($product_id);
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
            
            $thumbnail = getProductThumbnail($product_id);
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
                
            $thumbnail = getProductThumbnail($product_id);
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

