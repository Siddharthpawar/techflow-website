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
        
        /* Ratings Section */
        .ratings-section {
            margin-top: 3rem;
            padding-top: 3rem;
            border-top: 2px solid #e9ecef;
        }
        
        .ratings-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
            flex-wrap: wrap;
        }
        
        .ratings-title {
            font-size: 1.8rem;
            color: #2c3e50;
        }
        
        .average-rating {
            display: flex;
            align-items: center;
            gap: 1rem;
        }
        
        .average-rating-value {
            font-size: 2rem;
            font-weight: bold;
            color: #e74c3c;
        }
        
        .star-rating {
            display: flex;
            gap: 0.2rem;
            font-size: 1.5rem;
        }
        
        .star {
            color: #ddd;
            cursor: pointer;
            transition: color 0.2s;
        }
        
        .star.filled {
            color: #ffc107;
        }
        
        .rating-form {
            background: #f8f9fa;
            padding: 2rem;
            border-radius: 15px;
            margin-bottom: 2rem;
        }
        
        .form-group {
            margin-bottom: 1.5rem;
        }
        
        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            color: #2c3e50;
            font-weight: 600;
        }
        
        .form-group input,
        .form-group textarea {
            width: 100%;
            padding: 0.8rem;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-size: 1rem;
            font-family: inherit;
        }
        
        .form-group textarea {
            resize: vertical;
            min-height: 100px;
        }
        
        .rating-stars-input {
            display: flex;
            gap: 0.5rem;
            font-size: 2rem;
            margin-top: 0.5rem;
        }
        
        .rating-stars-input .star {
            cursor: pointer;
        }
        
        .submit-rating-btn {
            background: #e74c3c;
            color: white;
            padding: 1rem 2rem;
            border: none;
            border-radius: 8px;
            font-size: 1rem;
            font-weight: bold;
            cursor: pointer;
            transition: background 0.3s;
        }
        
        .submit-rating-btn:hover {
            background: #c0392b;
        }
        
        .submit-rating-btn:disabled {
            background: #ccc;
            cursor: not-allowed;
        }
        
        .ratings-list {
            margin-top: 2rem;
        }
        
        .rating-item {
            background: white;
            padding: 1.5rem;
            border-radius: 10px;
            margin-bottom: 1rem;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        }
        
        .rating-item-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 0.5rem;
        }
        
        .rating-user {
            font-weight: bold;
            color: #2c3e50;
        }
        
        .rating-date {
            color: #999;
            font-size: 0.9rem;
        }
        
        .rating-comment {
            color: #666;
            margin-top: 0.5rem;
            line-height: 1.6;
        }
        
        .message {
            padding: 1rem;
            border-radius: 8px;
            margin-bottom: 1rem;
        }
        
        .message.success {
            background: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }
        
        .message.error {
            background: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
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

                <!-- Ratings Section -->
                <div class="ratings-section">
                    <div class="ratings-header">
                        <h2 class="ratings-title">Customer Reviews</h2>
                        <div class="average-rating" id="averageRating">
                            <span class="average-rating-value" id="avgRatingValue">0.0</span>
                            <div class="star-rating" id="avgStarRating"></div>
                            <span id="ratingCount">(0 reviews)</span>
                        </div>
                    </div>

                    <!-- Rating Form -->
                    <div class="rating-form">
                        <h3 style="margin-bottom: 1.5rem; color: #2c3e50;">Write a Review</h3>
                        <div id="ratingMessage"></div>
                        <form id="ratingForm">
                            <div class="form-group">
                                <label for="ratingUser">Your Name *</label>
                                <input type="text" id="ratingUser" name="user" required>
                            </div>
                            <div class="form-group">
                                <label for="ratingEmail">Your Email *</label>
                                <input type="email" id="ratingEmail" name="email" required>
                            </div>
                            <div class="form-group">
                                <label>Rating *</label>
                                <div class="rating-stars-input" id="ratingStarsInput">
                                    <span class="star" data-rating="1">☆</span>
                                    <span class="star" data-rating="2">☆</span>
                                    <span class="star" data-rating="3">☆</span>
                                    <span class="star" data-rating="4">☆</span>
                                    <span class="star" data-rating="5">☆</span>
                                </div>
                                <input type="hidden" id="ratingValue" name="rating" required>
                            </div>
                            <div class="form-group">
                                <label for="ratingComment">Your Review</label>
                                <textarea id="ratingComment" name="comment" placeholder="Share your experience..."></textarea>
                            </div>
                            <button type="submit" class="submit-rating-btn" id="submitRatingBtn">Submit Review</button>
                        </form>
                    </div>

                    <!-- Ratings List -->
                    <div class="ratings-list" id="ratingsList">
                        <p style="text-align: center; color: #999;">Loading reviews...</p>
                    </div>
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

    <script>
        const productId = '<?php echo htmlspecialchars($product_id, ENT_QUOTES); ?>';
        let selectedRating = 0;

        // Initialize star rating input
        const starsInput = document.querySelectorAll('#ratingStarsInput .star');
        starsInput.forEach((star, index) => {
            star.addEventListener('click', () => {
                selectedRating = index + 1;
                document.getElementById('ratingValue').value = selectedRating;
                updateStarDisplay(starsInput, selectedRating);
            });
            star.addEventListener('mouseenter', () => {
                updateStarDisplay(starsInput, index + 1);
            });
        });

        document.getElementById('ratingStarsInput').addEventListener('mouseleave', () => {
            updateStarDisplay(starsInput, selectedRating);
        });

        function updateStarDisplay(stars, rating) {
            stars.forEach((star, index) => {
                if (index < rating) {
                    star.textContent = '★';
                    star.classList.add('filled');
                } else {
                    star.textContent = '☆';
                    star.classList.remove('filled');
                }
            });
        }

        // Load ratings
        function loadRatings() {
            fetch(`api/get-ratings.php?product_id=${encodeURIComponent(productId)}`)
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        displayRatings(data);
                    } else {
                        document.getElementById('ratingsList').innerHTML = 
                            '<p style="text-align: center; color: #999;">No reviews yet. Be the first to review!</p>';
                    }
                })
                .catch(error => {
                    console.error('Error loading ratings:', error);
                    document.getElementById('ratingsList').innerHTML = 
                        '<p style="text-align: center; color: #999;">Error loading reviews.</p>';
                });
        }

        function displayRatings(data) {
            // Update average rating
            const avgRating = data.average_rating || 0;
            const totalRatings = data.total_ratings || 0;
            
            document.getElementById('avgRatingValue').textContent = avgRating.toFixed(1);
            document.getElementById('ratingCount').textContent = `(${totalRatings} ${totalRatings === 1 ? 'review' : 'reviews'})`;
            
            // Display average stars
            const avgStars = document.getElementById('avgStarRating');
            avgStars.innerHTML = '';
            for (let i = 1; i <= 5; i++) {
                const star = document.createElement('span');
                star.textContent = i <= Math.round(avgRating) ? '★' : '☆';
                star.style.color = i <= Math.round(avgRating) ? '#ffc107' : '#ddd';
                avgStars.appendChild(star);
            }

            // Display ratings list
            const ratingsList = document.getElementById('ratingsList');
            if (data.ratings && data.ratings.length > 0) {
                ratingsList.innerHTML = data.ratings.map(rating => {
                    const date = new Date(rating.created_at).toLocaleDateString();
                    const stars = '★'.repeat(rating.rating) + '☆'.repeat(5 - rating.rating);
                    return `
                        <div class="rating-item">
                            <div class="rating-item-header">
                                <div>
                                    <span class="rating-user">${escapeHtml(rating.user || 'Anonymous')}</span>
                                    <div class="star-rating" style="font-size: 1rem; margin-top: 0.25rem;">
                                        ${stars.split('').map(s => `<span style="color: ${s === '★' ? '#ffc107' : '#ddd'}">${s}</span>`).join('')}
                                    </div>
                                </div>
                                <span class="rating-date">${date}</span>
                            </div>
                            ${rating.comment ? `<div class="rating-comment">${escapeHtml(rating.comment)}</div>` : ''}
                        </div>
                    `;
                }).join('');
            } else {
                ratingsList.innerHTML = '<p style="text-align: center; color: #999;">No reviews yet. Be the first to review!</p>';
            }
        }

        function escapeHtml(text) {
            const div = document.createElement('div');
            div.textContent = text;
            return div.innerHTML;
        }

        // Handle form submission
        document.getElementById('ratingForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const formData = new FormData(this);
            formData.append('product_id', productId);
            
            const submitBtn = document.getElementById('submitRatingBtn');
            submitBtn.disabled = true;
            submitBtn.textContent = 'Submitting...';

            fetch('api/rate.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                const messageDiv = document.getElementById('ratingMessage');
                if (data.success) {
                    messageDiv.innerHTML = '<div class="message success">Thank you for your review!</div>';
                    this.reset();
                    selectedRating = 0;
                    updateStarDisplay(starsInput, 0);
                    loadRatings(); // Reload ratings
                } else {
                    messageDiv.innerHTML = `<div class="message error">${escapeHtml(data.message || 'Error submitting review')}</div>`;
                }
                submitBtn.disabled = false;
                submitBtn.textContent = 'Submit Review';
                
                // Scroll to message
                messageDiv.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
            })
            .catch(error => {
                console.error('Error:', error);
                document.getElementById('ratingMessage').innerHTML = 
                    '<div class="message error">Error submitting review. Please try again.</div>';
                submitBtn.disabled = false;
                submitBtn.textContent = 'Submit Review';
            });
        });

        // Load ratings on page load
        loadRatings();
    </script>
</body>
</html>