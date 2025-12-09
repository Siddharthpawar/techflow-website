-- Database schema for TechFlow application
CREATE DATABASE IF NOT EXISTS techflow_db;
USE techflow_db;

-- Table for product ratings
CREATE TABLE IF NOT EXISTS product_ratings (
    id INT AUTO_INCREMENT PRIMARY KEY,
    product_id VARCHAR(100) NOT NULL,
    rating INT NOT NULL CHECK (rating >= 1 AND rating <= 5),
    user_ip VARCHAR(45),
    user_agent TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    INDEX idx_product_id (product_id),
    INDEX idx_created_at (created_at)
);

-- Table for tracking user visits
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
);

