# View Database Contents on EC2

## Quick View Script

Run this on your EC2 instance:

```bash
php view_database.php
```

This will show:
- All tables in the database
- Product ratings with details
- Visit tracking data
- Statistics by product

## Manual MySQL Commands

If you prefer to use MySQL directly:

```bash
# Connect to MySQL
mysql -u root -p'Hannohinrich@12' techflow_db

# Then run these SQL commands:

# Show all tables
SHOW TABLES;

# View product_ratings table
SELECT * FROM product_ratings;

# Count ratings
SELECT COUNT(*) as total_ratings FROM product_ratings;

# Ratings by product
SELECT 
    product_id,
    COUNT(*) as count,
    AVG(rating) as avg_rating
FROM product_ratings
GROUP BY product_id;

# View visit_tracking table
SELECT * FROM visit_tracking;

# Count visits
SELECT COUNT(*) as total_visits FROM visit_tracking;

# Visits by product
SELECT 
    product_id,
    COUNT(*) as count,
    COUNT(DISTINCT user_id) as unique_users
FROM visit_tracking
GROUP BY product_id;

# Exit MySQL
EXIT;
```

## Quick One-Liners

```bash
# View all ratings
mysql -u root -p'Hannohinrich@12' techflow_db -e "SELECT * FROM product_ratings;"

# View all visits
mysql -u root -p'Hannohinrich@12' techflow_db -e "SELECT * FROM visit_tracking;"

# Count ratings
mysql -u root -p'Hannohinrich@12' techflow_db -e "SELECT COUNT(*) as total FROM product_ratings;"

# Count visits
mysql -u root -p'Hannohinrich@12' techflow_db -e "SELECT COUNT(*) as total FROM visit_tracking;"
```

