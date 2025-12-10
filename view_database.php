<?php
/**
 * Script to view database contents
 * Run this on EC2: php view_database.php
 */

require_once 'config/db.php';

if ($pdo === null) {
    echo "❌ Database connection failed!\n";
    echo "Please check config/db.php and ensure MySQL is running.\n";
    exit(1);
}

echo "========================================\n";
echo "Database Contents - techflow_db\n";
echo "========================================\n\n";

try {
    // Show all tables
    echo "📊 Tables in database:\n";
    $tables = $pdo->query("SHOW TABLES")->fetchAll(PDO::FETCH_COLUMN);
    foreach ($tables as $table) {
        echo "  - $table\n";
    }
    echo "\n";

    // Show product_ratings data
    if (in_array('product_ratings', $tables)) {
        echo "⭐ Product Ratings:\n";
        echo str_repeat("-", 80) . "\n";
        $stmt = $pdo->query("SELECT COUNT(*) as count FROM product_ratings");
        $count = $stmt->fetch(PDO::FETCH_ASSOC)['count'];
        echo "Total Ratings: $count\n\n";
        
        if ($count > 0) {
            $stmt = $pdo->query("
                SELECT 
                    id,
                    product_id,
                    rating,
                    comment,
                    user,
                    email,
                    created_at
                FROM product_ratings 
                ORDER BY created_at DESC
                LIMIT 20
            ");
            $ratings = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
            foreach ($ratings as $rating) {
                echo "ID: {$rating['id']}\n";
                echo "  Product: {$rating['product_id']}\n";
                echo "  Rating: {$rating['rating']}/5 ⭐\n";
                echo "  User: " . ($rating['user'] ?: 'Anonymous') . "\n";
                echo "  Email: " . ($rating['email'] ?: 'N/A') . "\n";
                echo "  Comment: " . ($rating['comment'] ?: 'No comment') . "\n";
                echo "  Date: {$rating['created_at']}\n";
                echo str_repeat("-", 80) . "\n";
            }
            
            // Show statistics by product
            echo "\n📈 Ratings by Product:\n";
            $stmt = $pdo->query("
                SELECT 
                    product_id,
                    COUNT(*) as count,
                    AVG(rating) as avg_rating,
                    MIN(rating) as min_rating,
                    MAX(rating) as max_rating
                FROM product_ratings
                GROUP BY product_id
                ORDER BY count DESC
            ");
            $stats = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ($stats as $stat) {
                echo "  {$stat['product_id']}: {$stat['count']} ratings, Avg: " . 
                     round($stat['avg_rating'], 2) . 
                     " (Min: {$stat['min_rating']}, Max: {$stat['max_rating']})\n";
            }
        }
        echo "\n";
    }

    // Show visit_tracking data
    if (in_array('visit_tracking', $tables)) {
        echo "👁️  Visit Tracking:\n";
        echo str_repeat("-", 80) . "\n";
        $stmt = $pdo->query("SELECT COUNT(*) as count FROM visit_tracking");
        $count = $stmt->fetch(PDO::FETCH_ASSOC)['count'];
        echo "Total Visits: $count\n\n";
        
        if ($count > 0) {
            $stmt = $pdo->query("
                SELECT 
                    id,
                    product_id,
                    user_id,
                    page_url,
                    user_ip,
                    visited_at
                FROM visit_tracking 
                ORDER BY visited_at DESC
                LIMIT 20
            ");
            $visits = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
            foreach ($visits as $visit) {
                echo "ID: {$visit['id']}\n";
                echo "  Product: {$visit['product_id']}\n";
                echo "  User: " . ($visit['user_id'] ?: 'N/A') . "\n";
                echo "  IP: " . ($visit['user_ip'] ?: 'N/A') . "\n";
                echo "  Date: {$visit['visited_at']}\n";
                echo str_repeat("-", 80) . "\n";
            }
            
            // Show statistics by product
            echo "\n📈 Visits by Product:\n";
            $stmt = $pdo->query("
                SELECT 
                    product_id,
                    COUNT(*) as count,
                    COUNT(DISTINCT user_id) as unique_users
                FROM visit_tracking
                GROUP BY product_id
                ORDER BY count DESC
            ");
            $stats = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ($stats as $stat) {
                echo "  {$stat['product_id']}: {$stat['count']} visits ({$stat['unique_users']} unique users)\n";
            }
        }
        echo "\n";
    }

    echo "========================================\n";
    echo "Done!\n";
    echo "========================================\n";

} catch(PDOException $e) {
    echo "❌ Error: " . $e->getMessage() . "\n";
    exit(1);
}
?>

