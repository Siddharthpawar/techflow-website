<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET');
header('Access-Control-Allow-Headers: Content-Type');

require_once '../cookie_tracker.php';

// Get all products
$products = get_product_data();

// Transform products to match the requested JSON format
$items = [];
foreach ($products as $id => $product) {
    // Extract numeric price from price string (e.g., "$2,500+" -> 2500)
    $priceStr = $product['price'];
    $price = 0;
    if (preg_match('/[\d,]+/', $priceStr, $matches)) {
        $price = (int) str_replace(',', '', $matches[0]);
    }
    
    // Get thumbnail - use a placeholder or extract from image if available
    $thumbnail = 'https://images.unsplash.com/photo-1467269204594-9661b134dd2b?q=80&w=1400&auto=format&fit=crop';
    if (isset($product['image']) && filter_var($product['image'], FILTER_VALIDATE_URL)) {
        $thumbnail = $product['image'];
    }
    
    // Determine category from product ID or title
    $category = 'service';
    if (stripos($id, 'web') !== false || stripos($id, 'mobile') !== false) {
        $category = 'development';
    } elseif (stripos($id, 'cloud') !== false || stripos($id, 'devops') !== false) {
        $category = 'infrastructure';
    } elseif (stripos($id, 'ai') !== false || stripos($id, 'data') !== false) {
        $category = 'analytics';
    } elseif (stripos($id, 'security') !== false || stripos($id, 'cyber') !== false) {
        $category = 'security';
    } elseif (stripos($id, 'consulting') !== false) {
        $category = 'consulting';
    }
    
    $items[] = [
        'id' => $id,
        'name' => $product['title'],
        'price' => $price,
        'company' => 'NovaTrail',
        'category' => $category,
        'thumbnail' => $thumbnail,
        'description' => $product['description']
    ];
}

// Return JSON response
echo json_encode([
    'company' => 'NovaTrail',
    'items' => $items
], JSON_PRETTY_PRINT);
?>

