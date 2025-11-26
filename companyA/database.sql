CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL,
    email VARCHAR(100) NOT NULL,
    company VARCHAR(50) DEFAULT 'Company A',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Sample data for Company A
INSERT INTO users (username, email) VALUES
('user1_a', 'user1@companya.com'),
('user2_a', 'user2@companya.com'),
('user3_a', 'user3@companya.com');