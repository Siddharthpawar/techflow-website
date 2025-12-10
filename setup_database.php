<?php
/**
 * Database Setup Script
 * Run this script to create the database and tables for the API endpoints
 * Usage: php setup_database.php
 */

require_once 'config/db.php';

// Read database credentials from config
$host = 'localhost';
$dbname = 'techflow_db';
$username = 'root';
$password = 'Hannohinrich@12';

echo "Setting up database...\n\n";

try {
    // Connect to MySQL without selecting a database first
    $pdo = new PDO("mysql:host=$host", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Create database
    echo "Creating database '$dbname'...\n";
    $pdo->exec("CREATE DATABASE IF NOT EXISTS `$dbname`");
    echo "✓ Database created successfully\n\n";
    
    // Select the database
    $pdo->exec("USE `$dbname`");
    
    // Create product_ratings table
    echo "Creating table 'product_ratings'...\n";
    $pdo->exec("
        CREATE TABLE IF NOT EXISTS product_ratings (
            id INT AUTO_INCREMENT PRIMARY KEY,
            product_id VARCHAR(100) NOT NULL,
            rating INT NOT NULL,
            comment TEXT,
            user VARCHAR(255),
            email VARCHAR(255),
            user_ip VARCHAR(45),
            user_agent TEXT,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            INDEX idx_product_id (product_id),
            INDEX idx_created_at (created_at)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4
    ");
    echo "✓ Table 'product_ratings' created successfully\n\n";
    
    // Add check constraint for rating (MySQL 8.0.16+)
    try {
        $pdo->exec("ALTER TABLE product_ratings ADD CONSTRAINT chk_rating CHECK (rating >= 1 AND rating <= 5)");
        echo "✓ Rating constraint added\n\n";
    } catch(PDOException $e) {
        // Constraint might already exist or MySQL version doesn't support it
        echo "  (Rating constraint skipped - may already exist or not supported)\n\n";
    }
    
    // Create visit_tracking table
    echo "Creating table 'visit_tracking'...\n";
    $pdo->exec("
        CREATE TABLE IF NOT EXISTS visit_tracking (
            id INT AUTO_INCREMENT PRIMARY KEY,
            product_id VARCHAR(100) NOT NULL,
            user_id VARCHAR(100),
            page_url VARCHAR(500),
            user_ip VARCHAR(45),
            user_agent TEXT,
            referer VARCHAR(500),
            visited_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            INDEX idx_product_id (product_id),
            INDEX idx_user_id (user_id),
            INDEX idx_visited_at (visited_at)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4
    ");
    echo "✓ Table 'visit_tracking' created successfully\n\n";
    
    echo "========================================\n";
    echo "Database setup completed successfully!\n";
    echo "========================================\n";
    echo "\nYou can now use the API endpoints:\n";
    echo "  - GET  /api/products.php\n";
    echo "  - POST /api/rate.php\n";
    echo "  - POST /api/track.php\n";
    echo "  - GET  /api/top-products.php\n";
    
} catch(PDOException $e) {
    echo "\n❌ Error: " . $e->getMessage() . "\n";
    echo "\nPlease check:\n";
    echo "  1. MySQL server is running\n";
    echo "  2. Database credentials in config/db.php are correct\n";
    echo "  3. User has permission to create databases\n";
    exit(1);
}
?>

