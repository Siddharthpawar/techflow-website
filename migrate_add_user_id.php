<?php
/**
 * Migration script to add user_id column to visit_tracking table
 * Run this script to update existing database: php migrate_add_user_id.php
 */

require_once 'config/db.php';

$host = 'localhost';
$dbname = 'techflow_db';
$username = 'root';
$password = 'Hannohinrich@12';

echo "Migrating database to add user_id column...\n\n";

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Check if column already exists
    $checkStmt = $pdo->query("SHOW COLUMNS FROM visit_tracking LIKE 'user_id'");
    if ($checkStmt->rowCount() > 0) {
        echo "✓ Column 'user_id' already exists in visit_tracking table\n";
    } else {
        // Add user_id column
        echo "Adding 'user_id' column to visit_tracking table...\n";
        $pdo->exec("
            ALTER TABLE visit_tracking 
            ADD COLUMN user_id VARCHAR(100) AFTER product_id,
            ADD INDEX idx_user_id (user_id)
        ");
        echo "✓ Column 'user_id' added successfully\n";
    }
    
    echo "\n========================================\n";
    echo "Migration completed successfully!\n";
    echo "========================================\n";
    
} catch(PDOException $e) {
    echo "\n❌ Error: " . $e->getMessage() . "\n";
    exit(1);
}
?>

