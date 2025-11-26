<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us - TechFlow Solutions</title>
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
        
        /* Contact Section */
        .contact-section {
            padding: 4rem 0;
        }
        
        .contact-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 3rem;
            margin-top: 3rem;
        }
        
        .contact-info {
            background: #f8f9fa;
            padding: 2rem;
            border-radius: 15px;
        }
        
        .contact-info h3 {
            color: #2c3e50;
            margin-bottom: 2rem;
            font-size: 1.5rem;
        }
        
        .contact-item {
            display: flex;
            align-items: center;
            margin-bottom: 1.5rem;
            padding: 1rem;
            background: white;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        
        .contact-icon {
            font-size: 2rem;
            margin-right: 1rem;
            color: #e74c3c;
        }
        
        .contact-details h4 {
            color: #2c3e50;
            margin-bottom: 0.3rem;
        }
        
        .contact-details p {
            color: #666;
        }
        
        .contact-form {
            background: white;
            padding: 2rem;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        }
        
        .contact-form h3 {
            color: #2c3e50;
            margin-bottom: 2rem;
            font-size: 1.5rem;
        }
        
        .form-group {
            margin-bottom: 1.5rem;
        }
        
        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            color: #2c3e50;
            font-weight: bold;
        }
        
        .form-group input,
        .form-group textarea {
            width: 100%;
            padding: 1rem;
            border: 2px solid #e9ecef;
            border-radius: 5px;
            font-size: 1rem;
            transition: border-color 0.3s;
        }
        
        .form-group input:focus,
        .form-group textarea:focus {
            outline: none;
            border-color: #e74c3c;
        }
        
        .form-group textarea {
            height: 120px;
            resize: vertical;
        }
        
        .submit-btn {
            background: #e74c3c;
            color: white;
            padding: 1rem 2rem;
            border: none;
            border-radius: 5px;
            font-size: 1rem;
            font-weight: bold;
            cursor: pointer;
            transition: background 0.3s;
        }
        
        .submit-btn:hover {
            background: #c0392b;
        }
        
        /* Team Section */
        .team-section {
            background: #f8f9fa;
            padding: 4rem 0;
        }
        
        .team-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 2rem;
            margin-top: 3rem;
        }
        
        .team-member {
            background: white;
            padding: 2rem;
            border-radius: 15px;
            text-align: center;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }
        
        .team-avatar {
            width: 100px;
            height: 100px;
            background: linear-gradient(45deg, #667eea, #764ba2);
            border-radius: 50%;
            margin: 0 auto 1rem;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2rem;
            color: white;
        }
        
        .team-member h4 {
            color: #2c3e50;
            margin-bottom: 0.5rem;
        }
        
        .team-member p {
            color: #e74c3c;
            font-weight: bold;
            margin-bottom: 0.5rem;
        }
        
        .team-member .bio {
            color: #666;
            font-size: 0.9rem;
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
            .contact-grid {
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
                <li><a href="contacts.php" class="active">Contacts</a></li>
                <li><a href="login.php">Secure</a></li>
                <li><a href="graphic.php">Graphic</a></li>
            </ul>
        </div>
    </nav>

    <!-- Page Header -->
    <section class="page-header">
        <div class="container">
            <h1>Contact Us</h1>
            <p>Get in touch with our team - we're here to help with your technology needs</p>
        </div>
    </section>

    <!-- Contact Section -->
    <section class="contact-section">
        <div class="container">
            <div class="contact-grid">
                <!-- Contact Information (PHP File Reading) -->
                <div class="contact-info">
                    <h3>Get In Touch</h3>
                    
                    <?php
                    // Read contact information from text file
                    $contactFile = 'contact_info.txt';
                    
                    // If file doesn't exist, create it with default data
                    if (!file_exists($contactFile)) {
                        $defaultContacts = "TechFlow Solutions Headquarters\n";
                        $defaultContacts .= "123 Innovation Drive, Suite 500\n";
                        $defaultContacts .= "San Francisco, CA 94105\n";
                        $defaultContacts .= "Phone: +1 (555) 123-4567\n";
                        $defaultContacts .= "Email: info@techflowsolutions.com\n";
                        $defaultContacts .= "Website: www.techflowsolutions.com\n\n";
                        $defaultContacts .= "London Office\n";
                        $defaultContacts .= "45 Tech Street, Floor 3\n";
                        $defaultContacts .= "London, UK EC1A 4HD\n";
                        $defaultContacts .= "Phone: +44 20 7123 4567\n";
                        $defaultContacts .= "Email: london@techflowsolutions.com\n\n";
                        $defaultContacts .= "Support Team\n";
                        $defaultContacts .= "Email: support@techflowsolutions.com\n";
                        $defaultContacts .= "Phone: +1 (555) 987-6543\n";
                        $defaultContacts .= "Hours: 24/7 Support Available\n";
                        
                        file_put_contents($contactFile, $defaultContacts);
                    }
                    
                    // Read and display contact information
                    $contacts = file_get_contents($contactFile);
                    $contactLines = explode("\n", $contacts);
                    
                    $currentSection = "";
                    foreach ($contactLines as $line) {
                        $line = trim($line);
                        if (empty($line)) continue;
                        
                        // Check if this is a section header
                        if (strpos($line, 'Office') !== false || strpos($line, 'Team') !== false) {
                            if ($currentSection !== "") {
                                echo '</div>';
                            }
                            echo '<div class="contact-section-group">';
                            echo '<h4 style="color: #2c3e50; margin-bottom: 1rem; font-size: 1.2rem;">' . $line . '</h4>';
                            $currentSection = $line;
                        } else {
                            // Determine icon based on content
                            $icon = "📍";
                            if (strpos($line, 'Phone') !== false) $icon = "📞";
                            elseif (strpos($line, 'Email') !== false) $icon = "✉️";
                            elseif (strpos($line, 'Website') !== false) $icon = "🌐";
                            elseif (strpos($line, 'Hours') !== false) $icon = "🕒";
                            
                            echo '<div class="contact-item">';
                            echo '<div class="contact-icon">' . $icon . '</div>';
                            echo '<div class="contact-details">';
                            echo '<p>' . htmlspecialchars($line) . '</p>';
                            echo '</div>';
                            echo '</div>';
                        }
                    }
                    if ($currentSection !== "") {
                        echo '</div>';
                    }
                    ?>
                </div>

                <!-- Contact Form -->
                <div class="contact-form">
                    <h3>Send Us a Message</h3>
                    <form method="POST" action="">
                        <div class="form-group">
                            <label for="name">Full Name *</label>
                            <input type="text" id="name" name="name" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="email">Email Address *</label>
                            <input type="email" id="email" name="email" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="company">Company</label>
                            <input type="text" id="company" name="company">
                        </div>
                        
                        <div class="form-group">
                            <label for="subject">Subject *</label>
                            <input type="text" id="subject" name="subject" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="message">Message *</label>
                            <textarea id="message" name="message" required></textarea>
                        </div>
                        
                        <button type="submit" class="submit-btn">Send Message</button>
                    </form>
                    
                    <?php
                    // Handle form submission
                    if ($_POST) {
                        $name = htmlspecialchars($_POST['name']);
                        $email = htmlspecialchars($_POST['email']);
                        $company = htmlspecialchars($_POST['company']);
                        $subject = htmlspecialchars($_POST['subject']);
                        $message = htmlspecialchars($_POST['message']);
                        
                        // Save to file
                        $submission = date('Y-m-d H:i:s') . "\n";
                        $submission .= "Name: $name\n";
                        $submission .= "Email: $email\n";
                        $submission .= "Company: $company\n";
                        $submission .= "Subject: $subject\n";
                        $submission .= "Message: $message\n";
                        $submission .= "---\n\n";
                        
                        file_put_contents('contact_submissions.txt', $submission, FILE_APPEND);
                        
                        echo '<div style="background: #d4edda; color: #155724; padding: 1rem; border-radius: 5px; margin-top: 1rem;">';
                        echo '<strong>Thank you!</strong> Your message has been received. We\'ll get back to you within 24 hours.';
                        echo '</div>';
                    }
                    ?>
                </div>
            </div>
        </div>
    </section>

    <!-- Team Section -->
    <section class="team-section">
        <div class="container">
            <h2 style="text-align: center; margin-bottom: 2rem; color: #2c3e50; font-size: 2.5rem;">Meet Our Team</h2>
            <div class="team-grid">
                <div class="team-member">
                    <div class="team-avatar">👨‍💼</div>
                    <h4>John Smith</h4>
                    <p>CEO & Founder</p>
                    <div class="bio">Visionary leader with 15+ years in software development and business strategy.</div>
                </div>
                
                <div class="team-member">
                    <div class="team-avatar">👩‍💻</div>
                    <h4>Sarah Johnson</h4>
                    <p>CTO</p>
                    <div class="bio">Technical expert specializing in cloud architecture and scalable systems.</div>
                </div>
                
                <div class="team-member">
                    <div class="team-avatar">👨‍🎨</div>
                    <h4>Mike Chen</h4>
                    <p>Lead Designer</p>
                    <div class="bio">Creative designer focused on user experience and modern interface design.</div>
                </div>
                
                <div class="team-member">
                    <div class="team-avatar">👩‍🔧</div>
                    <h4>Emily Davis</h4>
                    <p>Senior Developer</p>
                    <div class="bio">Full-stack developer with expertise in React, Node.js, and mobile development.</div>
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
