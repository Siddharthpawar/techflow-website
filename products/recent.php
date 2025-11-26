<?php
require_once '../includes/products_data.php';
require_once '../includes/cookie_helper.php';

$recent_ids = get_recent_products();
$recent_products = array();
foreach ($recent_ids as $id) {
    if ($product = get_product($id)) {
        $recent_products[$id] = $product;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recently Viewed Products - TechFlow</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Segoe UI', sans-serif; line-height: 1.6; background: #f8f9fa; }
        .container { max-width: 1200px; margin: 0 auto; padding: 0 20px; }
        
        /* Header & Navigation */
        nav { background: #2c3e50; padding: 1rem 0; position: sticky; top: 0; z-index: 100; }
        nav ul { list-style: none; display: flex; justify-content: center; flex-wrap: wrap; }
        nav ul li { margin: 0 1rem; }
        nav ul li a { color: white; text-decoration: none; padding: 0.5rem 1rem; border-radius: 5px; }
        nav ul li a:hover { background: #34495e; }
        
        /* Page Header */
        .page-header { text-align: center; padding: 3rem 0; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; margin-bottom: 2rem; }
        
        /* Products List */
        .products-list { display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 2rem; padding: 2rem 0; }
        .product-card { background: white; border-radius: 10px; overflow: hidden; box-shadow: 0 5px 15px rgba(0,0,0,0.1); }
        .product-img { height: 200px; background: #eee; display: flex; align-items: center; justify-content: center; }
        .product-img img { max-width: 100%; height: auto; }
        .product-content { padding: 1.5rem; }
        .product-title { color: #2c3e50; font-size: 1.25rem; margin-bottom: 0.5rem; }
        .product-price { color: #e74c3c; font-weight: bold; margin-bottom: 1rem; }
        .product-summary { color: #666; margin-bottom: 1rem; }
        .view-btn { display: inline-block; background: #3498db; color: white; padding: 0.5rem 1rem; text-decoration: none; border-radius: 5px; }
        .view-btn:hover { background: #2980b9; }
        
        /* Empty State */
        .empty-state { text-align: center; padding: 3rem; background: white; border-radius: 10px; box-shadow: 0 5px 15px rgba(0,0,0,0.1); }
        .empty-state h2 { color: #2c3e50; margin-bottom: 1rem; }
        .empty-state p { color: #666; margin-bottom: 1.5rem; }
        .browse-btn { display: inline-block; background: #3498db; color: white; padding: 0.8rem 1.5rem; text-decoration: none; border-radius: 5px; }
        .browse-btn:hover { background: #2980b9; }
        
        /* Footer */
        footer { background: #2c3e50; color: white; text-align: center; padding: 2rem 0; margin-top: 2rem; }
        footer a { color: #3498db; text-decoration: none; }
        
        /* Responsive */
        @media (max-width: 768px) {
            .products-list { grid-template-columns: 1fr; }
        }
    </style>
</head>
<body>
    <!-- Navigation -->
    <nav>
        <div class="container">
            <ul>
                <li><a href="../index.php">Home</a></li>
                <li><a href="../about.php">About</a></li>
                <li><a href="../products.php">Products/Services</a></li>
                <li><a href="../news.php">News</a></li>
                <li><a href="../contacts.php">Contacts</a></li>
                <li><a href="../login.php">Secure</a></li>
                <li><a href="../graphic.php">Graphic</a></li>
            </ul>
        </div>
    </nav>

    <!-- Page Header -->
    <header class="page-header">
        <div class="container">
            <h1>Recently Viewed Products</h1>
            <p>Your last 5 viewed products and services</p>
        </div>
    </header>

    <!-- Products List -->
    <main class="container">
        <?php if (empty($recent_products)): ?>
            <div class="empty-state">
                <h2>No Recently Viewed Products</h2>
                <p>Start exploring our products to build your viewing history.</p>
                <a href="../products.php" class="browse-btn">Browse Products</a>
            </div>
        <?php else: ?>
            <div class="products-list">
                <?php foreach ($recent_products as $id => $product): ?>
                    <article class="product-card">
                        <div class="product-img">
                            <img src="../images/products/<?php echo htmlspecialchars($product['image']); ?>" 
                                 alt="<?php echo htmlspecialchars($product['title']); ?>"
                                 onerror="this.onerror=null; this.src='../images/placeholder.jpg';">
                        </div>
                        <div class="product-content">
                            <h2 class="product-title"><?php echo htmlspecialchars($product['title']); ?></h2>
                            <div class="product-price"><?php echo htmlspecialchars($product['price']); ?></div>
                            <p class="product-summary"><?php echo htmlspecialchars($product['summary']); ?></p>
                            <a href="view.php?id=<?php echo urlencode($id); ?>" class="view-btn">View Details</a>
                        </div>
                    </article>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </main>

    <!-- Footer -->
    <footer>
        <div class="container">
            <p>&copy; 2024 TechFlow Solutions. All rights reserved. | <a href="../contacts.php">Contact Us</a></p>
        </div>
    </footer>
</body>
</html>