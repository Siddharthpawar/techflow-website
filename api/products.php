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
    
    // Get thumbnail - use different images for different products
    $thumbnailMap = [
        'web-dev' => 'https://images.unsplash.com/photo-1461749280684-dccba630e2f6?q=80&w=1400&auto=format&fit=crop', // Web development
        'mobile-dev' => 'https://images.unsplash.com/photo-1512941937669-90a1b58e7e9c?q=80&w=1400&auto=format&fit=crop', // Mobile app
        'cloud-services' => 'https://images.unsplash.com/photo-1451187580459-43490279c0fa?q=80&w=1400&auto=format&fit=crop', // Cloud
        'ai-ml' => 'https://images.unsplash.com/photo-1485827404703-89b55fcc595e?q=80&w=1400&auto=format&fit=crop', // AI/ML
        'cybersecurity' => 'https://images.unsplash.com/photo-1563013544-824ae1b704d3?q=80&w=1400&auto=format&fit=crop', // Security
        'devops' => 'https://images.unsplash.com/photo-1558494949-ef010cbdcc31?q=80&w=1400&auto=format&fit=crop', // DevOps
        'data-analytics' => 'https://images.unsplash.com/photo-1551288049-bebda4e38f71?q=80&w=1400&auto=format&fit=crop', // Data analytics
        'blockchain' => 'https://images.unsplash.com/photo-1639762681485-074b7f938ba0?q=80&w=1400&auto=format&fit=crop', // Blockchain
        'iot-solutions' => 'https://images.unsplash.com/photo-1518770660439-4636190af475?q=80&w=1400&auto=format&fit=crop', // IoT
        'consulting' => 'https://images.unsplash.com/photo-1521737604893-d14cc237f11d?q=80&w=1400&auto=format&fit=crop' // Consulting
    ];
    
    $thumbnail = $thumbnailMap[$id] ?? 'https://images.unsplash.com/photo-1467269204594-9661b134dd2b?q=80&w=1400&auto=format&fit=crop';
    
    // Override if product has a valid URL image
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

