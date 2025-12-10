<?php
/**
 * Migration script to update product_ratings table format
 * Changes: review -> comment, adds user and email columns
 * Run this script to update existing database: php migrate_update_rating_format.php
 */

require_once 'config/db.php';

$host = 'localhost';
$dbname = 'techflow_db';
$username = 'root';
$password = 'Hannohinrich@12';

echo "Migrating database to update rating format...\n\n";

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Check if review column exists and rename to comment
    $checkReview = $pdo->query("SHOW COLUMNS FROM product_ratings LIKE 'review'");
    if ($checkReview->rowCount() > 0) {
        echo "Renaming 'review' column to 'comment'...\n";
        $pdo->exec("ALTER TABLE product_ratings CHANGE COLUMN review comment TEXT");
        echo "✓ Column renamed successfully\n\n";
    } else {
        // Check if comment column exists
        $checkComment = $pdo->query("SHOW COLUMNS FROM product_ratings LIKE 'comment'");
        if ($checkComment->rowCount() == 0) {
            echo "Adding 'comment' column...\n";
            $pdo->exec("ALTER TABLE product_ratings ADD COLUMN comment TEXT AFTER rating");
            echo "✓ Column 'comment' added successfully\n\n";
        } else {
            echo "✓ Column 'comment' already exists\n\n";
        }
    }
    
    // Check if user column exists
    $checkUser = $pdo->query("SHOW COLUMNS FROM product_ratings LIKE 'user'");
    if ($checkUser->rowCount() == 0) {
        echo "Adding 'user' column...\n";
        $pdo->exec("ALTER TABLE product_ratings ADD COLUMN user VARCHAR(255) AFTER comment");
        echo "✓ Column 'user' added successfully\n\n";
    } else {
        echo "✓ Column 'user' already exists\n\n";
    }
    
    // Check if email column exists
    $checkEmail = $pdo->query("SHOW COLUMNS FROM product_ratings LIKE 'email'");
    if ($checkEmail->rowCount() == 0) {
        echo "Adding 'email' column...\n";
        $pdo->exec("ALTER TABLE product_ratings ADD COLUMN email VARCHAR(255) AFTER user");
        echo "✓ Column 'email' added successfully\n\n";
    } else {
        echo "✓ Column 'email' already exists\n\n";
    }
    
    echo "========================================\n";
    echo "Migration completed successfully!\n";
    echo "========================================\n";
    
} catch(PDOException $e) {
    echo "\n❌ Error: " . $e->getMessage() . "\n";
    exit(1);
}
?>


