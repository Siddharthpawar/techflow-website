<?php
/**
 * Migration script to add review column to product_ratings table
 * Run this script to update existing database: php migrate_add_review.php
 */

require_once 'config/db.php';

$host = 'localhost';
$dbname = 'techflow_db';
$username = 'root';
$password = 'Hannohinrich@12';

echo "Migrating database to add review column...\n\n";

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Check if column already exists
    $checkStmt = $pdo->query("SHOW COLUMNS FROM product_ratings LIKE 'review'");
    if ($checkStmt->rowCount() > 0) {
        echo "✓ Column 'review' already exists in product_ratings table\n";
    } else {
        // Add review column
        echo "Adding 'review' column to product_ratings table...\n";
        $pdo->exec("
            ALTER TABLE product_ratings 
            ADD COLUMN review TEXT AFTER rating
        ");
        echo "✓ Column 'review' added successfully\n";
    }
    
    echo "\n========================================\n";
    echo "Migration completed successfully!\n";
    echo "========================================\n";
    
} catch(PDOException $e) {
    echo "\n❌ Error: " . $e->getMessage() . "\n";
    exit(1);
}
?>

