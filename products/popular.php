<?php
require_once '../includes/products_data.php';
require_once '../includes/cookie_helper.php';

$popular_products = get_popular_products(5); // Get top 5 most viewed products
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Most Popular Products - TechFlow</title>
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
        .page-header { text-align: center; padding: 3rem 0; background: linear-gradient(135deg, #764ba2 0%, #667eea 100%); color: white; margin-bottom: 2rem; }
        
        /* Products List */
        .products-list { display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 2rem; padding: 2rem 0; }
        .product-card { background: white; border-radius: 10px; overflow: hidden; box-shadow: 0 5px 15px rgba(0,0,0,0.1); position: relative; }
        .product-card::before { content: attr(data-rank); position: absolute; top: -10px; left: -10px; background: #e74c3c; color: white; width: 40px; height: 40px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: bold; box-shadow: 0 3px 10px rgba(0,0,0,0.2); }
        .product-img { height: 200px; background: #eee; display: flex; align-items: center; justify-content: center; }
        .product-img img { max-width: 100%; height: auto; }
        .product-content { padding: 1.5rem; }
        .product-title { color: #2c3e50; font-size: 1.25rem; margin-bottom: 0.5rem; }
        .product-price { color: #e74c3c; font-weight: bold; margin-bottom: 1rem; }
        .product-summary { color: #666; margin-bottom: 1rem; }
        .view-btn { display: inline-block; background: #3498db; color: white; padding: 0.5rem 1rem; text-decoration: none; border-radius: 5px; }
        .view-btn:hover { background: #2980b9; }
        .views-count { position: absolute; top: 10px; right: 10px; background: rgba(0,0,0,0.7); color: white; padding: 0.3rem 0.6rem; border-radius: 15px; font-size: 0.9rem; }
        
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
            <h1>Most Popular Products</h1>
            <p>Our top 5 most viewed products and services</p>
        </div>
    </header>

    <!-- Products List -->
    <main class="container">
        <?php if (empty($popular_products)): ?>
            <div class="empty-state">
                <h2>No Product Views Yet</h2>
                <p>Be the first to explore our amazing products and services!</p>
                <a href="../products.php" class="browse-btn">Browse Products</a>
            </div>
        <?php else: ?>
            <div class="products-list">
                <?php 
                $rank = 1;
                foreach ($popular_products as $product_id => $views): 
                    $product = get_product($product_id);
                    if (!$product) continue;
                ?>
                    <article class="product-card" data-rank="#<?php echo $rank; ?>">
                        <div class="views-count"><?php echo htmlspecialchars($views); ?> views</div>
                        <div class="product-img">
                            <img src="../images/products/<?php echo htmlspecialchars($product['image']); ?>" 
                                 alt="<?php echo htmlspecialchars($product['title']); ?>"
                                 onerror="this.onerror=null; this.src='../images/placeholder.jpg';">
                        </div>
                        <div class="product-content">
                            <h2 class="product-title"><?php echo htmlspecialchars($product['title']); ?></h2>
                            <div class="product-price"><?php echo htmlspecialchars($product['price']); ?></div>
                            <p class="product-summary"><?php echo htmlspecialchars($product['summary']); ?></p>
                            <a href="view.php?id=<?php echo urlencode($product_id); ?>" class="view-btn">View Details</a>
                        </div>
                    </article>
                <?php 
                    $rank++;
                endforeach; 
                ?>
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