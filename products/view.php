<?php
require_once '../includes/products_data.php';
require_once '../includes/cookie_helper.php';

$id = isset($_GET['id']) ? $_GET['id'] : '';
$product = get_product($id);

if (!$product) {
    header('Location: ../products.php');
    exit;
}

// Track this view
track_product_view($id);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($product['title']); ?> - TechFlow</title>
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
        
        /* Product Detail */
        .product-detail { background: white; border-radius: 15px; margin: 3rem 0; padding: 2rem; box-shadow: 0 5px 15px rgba(0,0,0,0.1); }
        .product-header { text-align: center; margin-bottom: 2rem; }
        .product-img { max-width: 600px; margin: 0 auto 2rem; }
        .product-img img { width: 100%; height: auto; border-radius: 10px; }
        .product-title { color: #2c3e50; font-size: 2rem; margin-bottom: 0.5rem; }
        .product-price { color: #e74c3c; font-size: 1.5rem; font-weight: bold; margin-bottom: 1rem; }
        .product-description { color: #666; font-size: 1.1rem; margin-bottom: 2rem; }
        
        /* Features */
        .features-section { background: #f1f4f6; padding: 2rem; border-radius: 10px; margin-bottom: 2rem; }
        .features-title { color: #2c3e50; font-size: 1.5rem; margin-bottom: 1rem; }
        .features-list { list-style: none; display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 1rem; }
        .features-list li { background: white; padding: 1rem; border-radius: 5px; box-shadow: 0 2px 5px rgba(0,0,0,0.05); }
        .features-list li:before { content: "✓"; color: #27ae60; margin-right: 0.5rem; }
        
        /* Technologies */
        .tech-section { background: #2c3e50; color: white; padding: 2rem; border-radius: 10px; margin-bottom: 2rem; }
        .tech-title { font-size: 1.5rem; margin-bottom: 1rem; }
        
        /* Actions */
        .actions { text-align: center; margin-top: 2rem; }
        .cta-btn { display: inline-block; background: #e74c3c; color: white; padding: 1rem 2rem; text-decoration: none; border-radius: 5px; margin: 0 0.5rem; }
        .cta-btn:hover { background: #c0392b; }
        .back-link { display: inline-block; color: #666; text-decoration: none; margin-top: 1rem; }
        .back-link:hover { color: #333; }
        
        /* Footer */
        footer { background: #2c3e50; color: white; text-align: center; padding: 2rem 0; margin-top: 2rem; }
        footer a { color: #3498db; text-decoration: none; }
        
        /* Responsive */
        @media (max-width: 768px) {
            .features-list { grid-template-columns: 1fr; }
            .actions .cta-btn { display: block; margin: 0.5rem auto; max-width: 200px; }
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

    <!-- Product Detail -->
    <main class="container">
        <article class="product-detail">
            <header class="product-header">
                <div class="product-img">
                    <img src="../images/products/<?php echo htmlspecialchars($product['image']); ?>" 
                         alt="<?php echo htmlspecialchars($product['title']); ?>"
                         onerror="this.onerror=null; this.src='../images/placeholder.jpg';">
                </div>
                <h1 class="product-title"><?php echo htmlspecialchars($product['title']); ?></h1>
                <div class="product-price"><?php echo htmlspecialchars($product['price']); ?></div>
                <p class="product-description"><?php echo htmlspecialchars($product['description']); ?></p>
            </header>

            <section class="features-section">
                <h2 class="features-title">Key Features</h2>
                <ul class="features-list">
                    <?php foreach ($product['features'] as $feature): ?>
                        <li><?php echo htmlspecialchars($feature); ?></li>
                    <?php endforeach; ?>
                </ul>
            </section>

            <section class="tech-section">
                <h2 class="tech-title">Technologies Used</h2>
                <p><?php echo htmlspecialchars($product['technologies']); ?></p>
            </section>

            <div class="actions">
                <a href="../contacts.php" class="cta-btn">Request Quote</a>
                <a href="../contacts.php" class="cta-btn">Contact Sales</a>
                <br>
                <a href="../products.php" class="back-link">← Back to All Products</a>
            </div>
        </article>
    </main>

    <!-- Footer -->
    <footer>
        <div class="container">
            <p>&copy; 2024 TechFlow Solutions. All rights reserved. | <a href="../contacts.php">Contact Us</a></p>
        </div>
    </footer>
</body>
</html>