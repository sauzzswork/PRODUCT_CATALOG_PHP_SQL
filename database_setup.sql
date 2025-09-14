CREATE DATABASE product_catalog;
USE product_catalog;
CREATE TABLE products (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    price DECIMAL(10, 2) NOT NULL,
    category VARCHAR(100) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
INSERT INTO products (name, price, category) VALUES
('iPhone 15 Pro', 999.99, 'Electronics'),
('Samsung Galaxy Book', 899.99, 'Electronics'),
('Nike Air Max 270', 149.99, 'Footwear'),
('Adidas Ultraboost 22', 179.99, 'Footwear'),
('Levi\'s 501 Jeans', 59.99, 'Clothing'),
('Sony WH-1000XM4 Headphones', 349.99, 'Electronics'),
('New Balance 574', 79.99, 'Footwear'),
('H&M Cotton T-Shirt', 12.99, 'Clothing');