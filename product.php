<?php
require_once 'cookie_tracker.php';

$product_id = isset($_GET['id']) ? $_GET['id'] : '';
$product = get_product_data($product_id);

if (!$product) {
    header('Location: products.php');
    exit;
}

// Track this view in cookies
track_product_view($product_id);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($product['title']); ?> - TechFlow Solutions</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: #333;
            background: #f8f9fa;
        }
        
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }
        
        /* Navigation */
        nav {
            background: #2c3e50;
            padding: 1rem 0;
            position: sticky;
            top: 0;
            z-index: 100;
        }
        
        nav ul {
            list-style: none;
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
        }
        
        nav ul li {
            margin: 0 1rem;
        }
        
        nav ul li a {
            color: white;
            text-decoration: none;
            padding: 0.5rem 1rem;
            border-radius: 5px;
            transition: background 0.3s;
        }
        
        nav ul li a:hover {
            background: #34495e;
        }
        
        /* Product Details */
        .product-section {
            padding: 4rem 0;
        }
        
        .product-container {
            background: white;
            border-radius: 20px;
            padding: 3rem;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            margin-top: 2rem;
        }
        
        .product-header {
            text-align: center;
            margin-bottom: 3rem;
        }
        
        .product-icon {
            font-size: 6rem;
            margin-bottom: 1rem;
            display: block;
        }
        
        .product-title {
            font-size: 2.5rem;
            color: #2c3e50;
            margin-bottom: 1rem;
        }
        
        .product-price {
            font-size: 1.5rem;
            color: #e74c3c;
            font-weight: bold;
            margin-bottom: 2rem;
        }
        
        .product-description {
            font-size: 1.2rem;
            color: #666;
            max-width: 800px;
            margin: 0 auto 3rem;
            text-align: center;
        }
        
        .product-features {
            background: #f8f9fa;
            padding: 2rem;
            border-radius: 15px;
            margin-bottom: 2rem;
        }
        
        .features-title {
            color: #2c3e50;
            font-size: 1.5rem;
            margin-bottom: 1.5rem;
            text-align: center;
        }
        
        .features-list {
            list-style: none;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1.5rem;
        }
        
        .features-list li {
            padding: 1rem;
            background: white;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.05);
        }
        
        .features-list li:before {
            content: "✓";
            color: #27ae60;
            font-weight: bold;
            margin-right: 0.5rem;
        }
        
        .actions {
            text-align: center;
            margin-top: 3rem;
        }
        
        .cta-button {
            display: inline-block;
            background: #e74c3c;
            color: white;
            padding: 1rem 2rem;
            text-decoration: none;
            border-radius: 50px;
            font-weight: bold;
            transition: transform 0.3s, background 0.3s;
            margin: 0 0.5rem;
        }
        
        .cta-button:hover {
            background: #c0392b;
            transform: translateY(-2px);
        }
        
        .back-link {
            display: inline-block;
            color: #666;
            text-decoration: none;
            margin-top: 1rem;
        }
        
        .back-link:hover {
            color: #333;
            text-decoration: underline;
        }
        
        /* Footer */
        footer {
            background: #2c3e50;
            color: white;
            text-align: center;
            padding: 2rem 0;
            margin-top: 4rem;
        }
        
        /* Responsive */
        @media (max-width: 768px) {
            .product-container {
                padding: 2rem;
            }
            
            .product-title {
                font-size: 2rem;
            }
            
            .features-list {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <!-- Navigation -->
    <nav>
        <div class="container">
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="about.php">About</a></li>
                <li><a href="products.php">Products/Services</a></li>
                <li><a href="news.php">News</a></li>
                <li><a href="contacts.php">Contacts</a></li>
                <li><a href="login.php">Secure</a></li>
                <li><a href="graphic.php">Graphic</a></li>
            </ul>
        </div>
    </nav>

    <!-- Product Details -->
    <section class="product-section">
        <div class="container">
            <div class="product-container">
                <div class="product-header">
                    <span class="product-icon"><?php echo $product['image']; ?></span>
                    <h1 class="product-title"><?php echo htmlspecialchars($product['title']); ?></h1>
                    <div class="product-price"><?php echo htmlspecialchars($product['price']); ?></div>
                    <p class="product-description"><?php echo htmlspecialchars($product['description']); ?></p>
                </div>

                <div class="product-features">
                    <h2 class="features-title">Key Features & Benefits</h2>
                    <ul class="features-list">
                        <?php foreach ($product['features'] as $feature): ?>
                            <li><?php echo htmlspecialchars($feature); ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>

                <div class="actions">
                    <a href="contacts.php" class="cta-button">Get Started</a>
                    <a href="contacts.php" class="cta-button">Request Quote</a>
                    <br>
                    <a href="products.php" class="back-link">← Back to All Products</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <div class="container">
            <p>&copy; 2024 TechFlow Solutions. All rights reserved. | <a href="contacts.php" style="color: #3498db;">Contact Us</a></p>
        </div>
    </footer>
</body>
</html>