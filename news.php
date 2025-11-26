<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Latest News - TechFlow Solutions</title>
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
        
        /* News Section */
        .news-section {
            padding: 4rem 0;
        }
        
        .news-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
            gap: 2rem;
            margin-top: 3rem;
        }
        
        .news-card {
            background: white;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            transition: transform 0.3s, box-shadow 0.3s;
        }
        
        .news-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 40px rgba(0,0,0,0.15);
        }
        
        .news-image {
            height: 200px;
            background: linear-gradient(45deg, #667eea, #764ba2);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 4rem;
            color: white;
        }
        
        .news-content {
            padding: 2rem;
        }
        
        .news-date {
            color: #7f8c8d;
            font-size: 0.9rem;
            margin-bottom: 0.5rem;
        }
        
        .news-card h3 {
            color: #2c3e50;
            margin-bottom: 1rem;
            font-size: 1.3rem;
        }
        
        .news-card p {
            color: #666;
            margin-bottom: 1rem;
        }
        
        .news-tag {
            display: inline-block;
            background: #e74c3c;
            color: white;
            padding: 0.3rem 0.8rem;
            border-radius: 20px;
            font-size: 0.8rem;
            margin-right: 0.5rem;
        }
        
        /* Featured News */
        .featured-news {
            background: #f8f9fa;
            padding: 4rem 0;
        }
        
        .featured-card {
            background: white;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 0;
        }
        
        .featured-image {
            background: linear-gradient(45deg, #e74c3c, #f39c12);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 6rem;
            color: white;
        }
        
        .featured-content {
            padding: 3rem;
        }
        
        .featured-content h2 {
            color: #2c3e50;
            margin-bottom: 1rem;
            font-size: 2rem;
        }
        
        .featured-content p {
            color: #666;
            margin-bottom: 1.5rem;
            font-size: 1.1rem;
        }
        
        /* Newsletter Section */
        .newsletter-section {
            background: #2c3e50;
            color: white;
            padding: 3rem 0;
            text-align: center;
        }
        
        .newsletter-section h2 {
            margin-bottom: 1rem;
        }
        
        .newsletter-form {
            max-width: 500px;
            margin: 2rem auto;
            display: flex;
            gap: 1rem;
        }
        
        .newsletter-form input {
            flex: 1;
            padding: 1rem;
            border: none;
            border-radius: 5px;
            font-size: 1rem;
        }
        
        .newsletter-form button {
            background: #e74c3c;
            color: white;
            border: none;
            padding: 1rem 2rem;
            border-radius: 5px;
            cursor: pointer;
            font-weight: bold;
        }
        
        .newsletter-form button:hover {
            background: #c0392b;
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
            .featured-card {
                grid-template-columns: 1fr;
            }
            
            .newsletter-form {
                flex-direction: column;
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
                <li><a href="news.php" class="active">News</a></li>
                <li><a href="contacts.php">Contacts</a></li>
                <li><a href="login.php">Secure</a></li>
                <li><a href="graphic.php">Graphic</a></li>
            </ul>
        </div>
    </nav>

    <!-- Page Header -->
    <section class="page-header">
        <div class="container">
            <h1>Latest News & Updates</h1>
            <p>Stay informed about our latest projects, achievements, and industry insights</p>
        </div>
    </section>

    <!-- Featured News -->
    <section class="featured-news">
        <div class="container">
            <div class="featured-card">
                <div class="featured-image">
                    🚀
                </div>
                <div class="featured-content">
                    <div class="news-date">December 15, 2024</div>
                    <h2>TechFlow Solutions Wins "Best Software Company 2024" Award</h2>
                    <p>We're thrilled to announce that TechFlow Solutions has been recognized as the "Best Software Company 2024" by the International Technology Awards. This prestigious award reflects our commitment to innovation, quality, and client satisfaction.</p>
                    <p>Our team's dedication to delivering cutting-edge solutions and exceptional service has earned us this recognition. We want to thank all our clients and partners for their trust and support.</p>
                    <span class="news-tag">Award</span>
                    <span class="news-tag">Achievement</span>
                </div>
            </div>
        </div>
    </section>

    <!-- News Grid -->
    <section class="news-section">
        <div class="container">
            <h2 style="text-align: center; margin-bottom: 2rem; color: #2c3e50; font-size: 2.5rem;">Recent Updates</h2>
            <div class="news-grid">
                <div class="news-card">
                    <div class="news-image">💻</div>
                    <div class="news-content">
                        <div class="news-date">December 10, 2024</div>
                        <h3>New AI-Powered Analytics Dashboard Launched</h3>
                        <p>We've successfully launched our latest AI-powered analytics dashboard for enterprise clients. The new platform provides real-time insights and predictive analytics to help businesses make data-driven decisions.</p>
                        <span class="news-tag">Product Launch</span>
                    </div>
                </div>

                <div class="news-card">
                    <div class="news-image">🌍</div>
                    <div class="news-content">
                        <div class="news-date">December 5, 2024</div>
                        <h3>Expanding Our Global Presence</h3>
                        <p>TechFlow Solutions is excited to announce the opening of our new office in London, UK. This expansion allows us to better serve our European clients and continue our global growth strategy.</p>
                        <span class="news-tag">Expansion</span>
                    </div>
                </div>

                <div class="news-card">
                    <div class="news-image">🔒</div>
                    <div class="news-content">
                        <div class="news-date">November 28, 2024</div>
                        <h3>Enhanced Security Measures Implemented</h3>
                        <p>We've upgraded our security infrastructure with the latest encryption technologies and multi-factor authentication systems to ensure maximum protection for our clients' data.</p>
                        <span class="news-tag">Security</span>
                    </div>
                </div>

                <div class="news-card">
                    <div class="news-image">👥</div>
                    <div class="news-content">
                        <div class="news-date">November 20, 2024</div>
                        <h3>Team Expansion: Welcome Our New Developers</h3>
                        <p>We're proud to welcome 5 new talented developers to our team. Their expertise in React, Node.js, and cloud technologies will help us deliver even better solutions to our clients.</p>
                        <span class="news-tag">Team</span>
                    </div>
                </div>

                <div class="news-card">
                    <div class="news-image">📱</div>
                    <div class="news-content">
                        <div class="news-date">November 15, 2024</div>
                        <h3>Mobile App Development Services Enhanced</h3>
                        <p>We've expanded our mobile development capabilities with new React Native and Flutter expertise, enabling us to create even more powerful cross-platform applications.</p>
                        <span class="news-tag">Services</span>
                    </div>
                </div>

                <div class="news-card">
                    <div class="news-image">🎓</div>
                    <div class="news-content">
                        <div class="news-date">November 8, 2024</div>
                        <h3>TechFlow Academy: Free Coding Workshops</h3>
                        <p>We're launching TechFlow Academy, a series of free coding workshops for aspiring developers. Join us every Saturday for hands-on learning sessions covering web development, mobile apps, and more.</p>
                        <span class="news-tag">Education</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Newsletter Section -->
    <section class="newsletter-section">
        <div class="container">
            <h2>Stay Updated</h2>
            <p>Subscribe to our newsletter for the latest news, updates, and industry insights</p>
            <form class="newsletter-form">
                <input type="email" placeholder="Enter your email address" required>
                <button type="submit">Subscribe</button>
            </form>
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
