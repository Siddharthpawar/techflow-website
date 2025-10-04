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
        
        /* Services Section */
        .services-section {
            padding: 4rem 0;
        }
        
        .services-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
            gap: 2rem;
            margin-top: 3rem;
        }
        
        .service-card {
            background: white;
            border-radius: 15px;
            padding: 2rem;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            transition: transform 0.3s, box-shadow 0.3s;
            border: 1px solid #e9ecef;
        }
        
        .service-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 40px rgba(0,0,0,0.15);
        }
        
        .service-icon {
            font-size: 3rem;
            margin-bottom: 1rem;
            text-align: center;
        }
        
        .service-card h3 {
            color: #2c3e50;
            margin-bottom: 1rem;
            font-size: 1.5rem;
        }
        
        .service-card p {
            margin-bottom: 1.5rem;
            color: #666;
        }
        
        .service-features {
            list-style: none;
            margin-bottom: 1.5rem;
        }
        
        .service-features li {
            padding: 0.3rem 0;
            color: #555;
        }
        
        .service-features li:before {
            content: "✓ ";
            color: #27ae60;
            font-weight: bold;
        }
        
        .price {
            font-size: 1.2rem;
            font-weight: bold;
            color: #e74c3c;
            text-align: center;
        }
        
        /* Pricing Section */
        .pricing-section {
            background: #f8f9fa;
            padding: 4rem 0;
        }
        
        .pricing-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
            margin-top: 3rem;
        }
        
        .pricing-card {
            background: white;
            border-radius: 15px;
            padding: 2rem;
            text-align: center;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            position: relative;
        }
        
        .pricing-card.featured {
            border: 3px solid #e74c3c;
            transform: scale(1.05);
        }
        
        .pricing-card.featured:before {
            content: "Most Popular";
            position: absolute;
            top: -15px;
            left: 50%;
            transform: translateX(-50%);
            background: #e74c3c;
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 20px;
            font-size: 0.9rem;
        }
        
        .pricing-card h3 {
            color: #2c3e50;
            margin-bottom: 1rem;
        }
        
        .pricing-card .price {
            font-size: 2.5rem;
            color: #e74c3c;
            margin-bottom: 1rem;
        }
        
        .pricing-features {
            list-style: none;
            margin: 2rem 0;
        }
        
        .pricing-features li {
            padding: 0.5rem 0;
            border-bottom: 1px solid #eee;
        }
        
        .cta-button {
            display: inline-block;
            background: #e74c3c;
            color: white;
            padding: 1rem 2rem;
            text-decoration: none;
            border-radius: 50px;
            font-weight: bold;
            transition: background 0.3s;
            margin-top: 1rem;
        }
        
        .cta-button:hover {
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
            .pricing-card.featured {
                transform: none;
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
            </ul>
        </div>
    </nav>

    <!-- Page Header -->
    <section class="page-header">
        <div class="container">
            <h1>Our Products & Services</h1>
            <p>Comprehensive technology solutions for your business needs</p>
        </div>
    </section>

    <!-- Services Section -->
    <section class="services-section">
        <div class="container">
            <h2 style="text-align: center; margin-bottom: 2rem; color: #2c3e50; font-size: 2.5rem;">What We Offer</h2>
            <div class="services-grid">
                <div class="service-card">
                    <div class="service-icon">🌐</div>
                    <h3>Web Development</h3>
                    <p>Custom web applications built with modern frameworks and technologies.</p>
                    <ul class="service-features">
                        <li>Responsive Design</li>
                        <li>E-commerce Solutions</li>
                        <li>Content Management Systems</li>
                        <li>API Development</li>
                        <li>Progressive Web Apps</li>
                    </ul>
                    <div class="price">Starting at $2,500</div>
                </div>

                <div class="service-card">
                    <div class="service-icon">📱</div>
                    <h3>Mobile App Development</h3>
                    <p>Native and cross-platform mobile applications for iOS and Android.</p>
                    <ul class="service-features">
                        <li>iOS & Android Apps</li>
                        <li>React Native Development</li>
                        <li>Flutter Applications</li>
                        <li>App Store Optimization</li>
                        <li>Push Notifications</li>
                    </ul>
                    <div class="price">Starting at $5,000</div>
                </div>

                <div class="service-card">
                    <div class="service-icon">☁️</div>
                    <h3>Cloud Solutions</h3>
                    <p>Scalable cloud infrastructure and migration services.</p>
                    <ul class="service-features">
                        <li>AWS/Azure/GCP Setup</li>
                        <li>Cloud Migration</li>
                        <li>DevOps Implementation</li>
                        <li>Container Orchestration</li>
                        <li>Auto-scaling Solutions</li>
                    </ul>
                    <div class="price">Starting at $3,000</div>
                </div>

                <div class="service-card">
                    <div class="service-icon">🔒</div>
                    <h3>Cybersecurity</h3>
                    <p>Comprehensive security solutions to protect your digital assets.</p>
                    <ul class="service-features">
                        <li>Security Audits</li>
                        <li>Penetration Testing</li>
                        <li>SSL Certificates</li>
                        <li>Firewall Configuration</li>
                        <li>Security Training</li>
                    </ul>
                    <div class="price">Starting at $1,500</div>
                </div>

                <div class="service-card">
                    <div class="service-icon">🤖</div>
                    <h3>AI & Machine Learning</h3>
                    <p>Intelligent solutions powered by artificial intelligence.</p>
                    <ul class="service-features">
                        <li>Chatbot Development</li>
                        <li>Predictive Analytics</li>
                        <li>Image Recognition</li>
                        <li>Natural Language Processing</li>
                        <li>Recommendation Systems</li>
                    </ul>
                    <div class="price">Starting at $4,000</div>
                </div>

                <div class="service-card">
                    <div class="service-icon">🛠️</div>
                    <h3>Consulting & Support</h3>
                    <p>Expert guidance and ongoing support for your technology needs.</p>
                    <ul class="service-features">
                        <li>Technology Consulting</li>
                        <li>Code Reviews</li>
                        <li>Performance Optimization</li>
                        <li>24/7 Technical Support</li>
                        <li>Training & Workshops</li>
                    </ul>
                    <div class="price">$150/hour</div>
                </div>
            </div>
        </div>
    </section>

    <!-- Pricing Section -->
    <section class="pricing-section">
        <div class="container">
            <h2 style="text-align: center; margin-bottom: 2rem; color: #2c3e50; font-size: 2.5rem;">Service Packages</h2>
            <div class="pricing-grid">
                <div class="pricing-card">
                    <h3>Starter Package</h3>
                    <div class="price">$2,500</div>
                    <ul class="pricing-features">
                        <li>Basic Website (5 pages)</li>
                        <li>Responsive Design</li>
                        <li>Contact Form</li>
                        <li>SEO Optimization</li>
                        <li>1 Month Support</li>
                    </ul>
                    <a href="contacts.php" class="cta-button">Get Started</a>
                </div>

                <div class="pricing-card featured">
                    <h3>Professional Package</h3>
                    <div class="price">$7,500</div>
                    <ul class="pricing-features">
                        <li>Custom Web Application</li>
                        <li>Database Integration</li>
                        <li>User Authentication</li>
                        <li>Admin Dashboard</li>
                        <li>3 Months Support</li>
                        <li>Mobile Optimization</li>
                    </ul>
                    <a href="contacts.php" class="cta-button">Get Started</a>
                </div>

                <div class="pricing-card">
                    <h3>Enterprise Package</h3>
                    <div class="price">$15,000+</div>
                    <ul class="pricing-features">
                        <li>Complex Web Application</li>
                        <li>API Development</li>
                        <li>Cloud Deployment</li>
                        <li>Security Implementation</li>
                        <li>6 Months Support</li>
                        <li>Performance Monitoring</li>
                        <li>Custom Integrations</li>
                    </ul>
                    <a href="contacts.php" class="cta-button">Contact Us</a>
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
