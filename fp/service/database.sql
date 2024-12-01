-- Create the database
CREATE DATABASE IF NOT EXISTS bus_booking;

-- Use the bus_booking database
USE bus_booking;

-- Create users table
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Create bookings table
CREATE TABLE IF NOT EXISTS bookings (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    bus_name VARCHAR(255) NOT NULL,
    route VARCHAR(255) NOT NULL,
    date DATE NOT NULL,
    seats INT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

-- Sample insert data for users
INSERT INTO users (username, password) VALUES 
('user1', '$2y$10$3d3QvM6.gFf3qa7t3w2ZWeO1zjJ/3mWwBGfU1fXQm5.kJeIFxVm/K'),  -- Password: 12345
('user2', '$2y$10$XbR/a9VQ0Rg6LjJ5A0ZIXX4aIz3mb6ccvUqACcdRjt1KPynlhjOYSz');  -- Password: password

