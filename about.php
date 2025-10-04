<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us - TechFlow Solutions</title>
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
        
        /* Content Sections */
        .content-section {
            padding: 3rem 0;
        }
        
        .content-section:nth-child(even) {
            background: #f8f9fa;
        }
        
        .section-content {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 3rem;
            align-items: center;
        }
        
        .section-content.reverse {
            grid-template-columns: 1fr 1fr;
        }
        
        .section-content.reverse .text-content {
            order: 2;
        }
        
        .section-content.reverse .image-content {
            order: 1;
        }
        
        .text-content h2 {
            color: #2c3e50;
            margin-bottom: 1rem;
            font-size: 2rem;
        }
        
        .text-content p {
            margin-bottom: 1rem;
            font-size: 1.1rem;
        }
        
        .image-content {
            text-align: center;
            font-size: 8rem;
        }
        
        .stats {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 2rem;
            margin: 2rem 0;
        }
        
        .stat-item {
            text-align: center;
            padding: 1.5rem;
            background: white;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }
        
        .stat-number {
            font-size: 2.5rem;
            font-weight: bold;
            color: #e74c3c;
        }
        
        .stat-label {
            color: #7f8c8d;
            margin-top: 0.5rem;
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
            .section-content {
                grid-template-columns: 1fr;
                gap: 2rem;
            }
            
            .page-header h1 {
                font-size: 2rem;
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
                <li><a href="about.php" class="active">About</a></li>
                <li><a href="products.php">Products/Services</a></li>
                <li><a href="news.php">News</a></li>
                <li><a href="contacts.php">Contacts</a></li>
            </ul>
        </div>
    </nav>

    <!-- Page Header -->
    <section class="page-header">
        <div class="container">
            <h1>About TechFlow Solutions</h1>
            <p>Empowering businesses through innovative technology solutions</p>
        </div>
    </section>

    <!-- Our Story -->
    <section class="content-section">
        <div class="container">
            <div class="section-content">
                <div class="text-content">
                    <h2>Our Story</h2>
                    <p>Founded in 2018, TechFlow Solutions began as a small team of passionate developers with a vision to bridge the gap between complex technology and business needs. What started as a garage startup has grown into a leading software development company serving clients across the globe.</p>
                    <p>We believe that technology should be accessible, intuitive, and powerful. Our journey has been marked by continuous learning, innovation, and an unwavering commitment to delivering exceptional results for our clients.</p>
                </div>
                <div class="image-content">
                    🏢
                </div>
            </div>
        </div>
    </section>

    <!-- Our Mission -->
    <section class="content-section">
        <div class="container">
            <div class="section-content reverse">
                <div class="text-content">
                    <h2>Our Mission</h2>
                    <p>To transform businesses through cutting-edge software solutions that are scalable, secure, and user-friendly. We strive to be the technology partner that helps our clients achieve their digital transformation goals.</p>
                    <p>Our mission is driven by three core principles: Innovation, Quality, and Partnership. We don't just build software; we build relationships and create lasting value for our clients.</p>
                </div>
                <div class="image-content">
                    🎯
                </div>
            </div>
        </div>
    </section>

    <!-- Our Values -->
    <section class="content-section">
        <div class="container">
            <div class="section-content">
                <div class="text-content">
                    <h2>Our Values</h2>
                    <p><strong>Innovation:</strong> We stay ahead of technology trends and continuously explore new ways to solve complex problems.</p>
                    <p><strong>Quality:</strong> Every line of code is written with precision and every project is delivered with excellence.</p>
                    <p><strong>Transparency:</strong> We maintain open communication and provide regular updates throughout the development process.</p>
                    <p><strong>Partnership:</strong> We work closely with our clients as an extension of their team, not just as a vendor.</p>
                </div>
                <div class="image-content">
                    💎
                </div>
            </div>
        </div>
    </section>

    <!-- Company Stats -->
    <section class="content-section">
        <div class="container">
            <h2 style="text-align: center; margin-bottom: 2rem; color: #2c3e50;">Our Impact</h2>
            <div class="stats">
                <div class="stat-item">
                    <div class="stat-number">150+</div>
                    <div class="stat-label">Projects Completed</div>
                </div>
                <div class="stat-item">
                    <div class="stat-number">50+</div>
                    <div class="stat-label">Happy Clients</div>
                </div>
                <div class="stat-item">
                    <div class="stat-number">6</div>
                    <div class="stat-label">Years Experience</div>
                </div>
                <div class="stat-item">
                    <div class="stat-number">99.9%</div>
                    <div class="stat-label">Uptime Guarantee</div>
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
