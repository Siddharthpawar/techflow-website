<?php
require_once 'cookie_tracker.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products & Services - TechFlow Solutions</title>
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
        
        nav ul li a:hover, nav ul li a.active {
            background: #34495e;
        }

        /* Product History */
        .product-history {
            background: #34495e;
            color: white;
            padding: 1rem 0;
            text-align: center;
        }
        .product-history a {
            color: #3498db;
            margin: 0 1rem;
            text-decoration: none;
        }
        .product-history a:hover {
            text-decoration: underline;
        }
        
        /* Page Header */
        .page-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 3rem 0;
            text-align: center;
        }
        
        .page-header h1 {
            font-size: 2.5rem;
            margin-bottom: 1rem;
        }
        
        /* Products Grid */
        .products-section {
            padding: 4rem 0;
        }
        
        .products-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
            margin-top: 3rem;
        }
        
        .product-card {
            background: white;
            border-radius: 15px;
            padding: 2rem;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            transition: transform 0.3s, box-shadow 0.3s;
            border: 1px solid #e9ecef;
            text-decoration: none;
            color: inherit;
            display: block;
        }
        
        .product-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 40px rgba(0,0,0,0.15);
        }
        
        .product-icon {
            font-size: 3rem;
            margin-bottom: 1rem;
            text-align: center;
            display: block;
        }
        
        .product-card h3 {
            color: #2c3e50;
            margin-bottom: 1rem;
            font-size: 1.5rem;
            text-align: center;
        }
        
        .product-card p {
            margin-bottom: 1.5rem;
            color: #666;
        }
        
        .product-features {
            list-style: none;
            margin-bottom: 1.5rem;
        }
        
        .product-features li {
            padding: 0.3rem 0;
            color: #555;
        }
        
        .product-features li:before {
            content: "✓ ";
            color: #27ae60;
            font-weight: bold;
        }
        
        .price {
            font-size: 1.2rem;
            font-weight: bold;
            color: #e74c3c;
            text-align: center;
            margin-top: 1rem;
        }
        
        /* Footer */
        footer {
            background: #2c3e50;
            color: white;
            text-align: center;
            padding: 2rem 0;
        }
        
        /* Responsive */
        @media (max-width: 768px) {
            .products-grid {
                grid-template-columns: 1fr;
            }
            
            .product-history a {
                display: block;
                margin: 0.5rem 0;
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
                <li><a href="products.php" class="active">Products/Services</a></li>
                <li><a href="news.php">News</a></li>
                <li><a href="contacts.php">Contacts</a></li>
                <li><a href="login.php">Secure</a></li>
                <li><a href="graphic.php">Graphic</a></li>
            </ul>
        </div>
    </nav>

    <!-- Product History -->
    <div class="product-history">
        <div class="container">
            <a href="products/recent.php">Recently Viewed Products</a>
            |
            <a href="products/popular.php">Most Popular Products</a>
        </div>
    </div>

    <!-- Page Header -->
    <section class="page-header">
        <div class="container">
            <h1>Our Products & Services</h1>
            <p>Comprehensive technology solutions for your business needs</p>
        </div>
    </section>

    <!-- Products Grid -->
    <section class="products-section">
        <div class="container">
            <div class="products-grid">
                <?php
                $products = get_product_data();
                foreach ($products as $id => $product):
                ?>
                <a href="product.php?id=<?php echo htmlspecialchars($id); ?>" class="product-card">
                    <span class="product-icon"><?php echo $product['image']; ?></span>
                    <h3><?php echo htmlspecialchars($product['title']); ?></h3>
                    <p><?php echo htmlspecialchars($product['description']); ?></p>
                    <ul class="product-features">
                        <?php foreach ($product['features'] as $feature): ?>
                            <li><?php echo htmlspecialchars($feature); ?></li>
                        <?php endforeach; ?>
                    </ul>
                    <div class="price"><?php echo htmlspecialchars($product['price']); ?></div>
                </a>
                <?php endforeach; ?>
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
