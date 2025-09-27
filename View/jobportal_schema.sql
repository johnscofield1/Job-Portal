-- Database: jobportal
CREATE DATABASE IF NOT EXISTS jobportal;
USE jobportal;

-- Users table
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    role ENUM('admin','employer','jobseeker') NOT NULL
);

-- Preloaded admin account
INSERT INTO users (username, email, password, role) VALUES
('admin', 'admin@example.com', '$2y$10$E1n3EhdY1t0lBwTP14zVwuPuZpH0HDTz6OwyR7Bq9lRtUfcy7XZZ6', 'admin');
