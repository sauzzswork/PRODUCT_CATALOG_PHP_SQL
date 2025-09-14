-- Product Catalog Database Dump
-- Generated for submission

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";

-- Database: `product_catalog`
CREATE DATABASE IF NOT EXISTS `product_catalog` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `product_catalog`;

-- --------------------------------------------------------

-- Table structure for table `products`
CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `category` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Dumping data for table `products`
INSERT INTO `products` (`id`, `name`, `price`, `category`, `created_at`) VALUES
(1, 'iPhone 15 Pro', '999.99', 'Electronics', '2025-09-10 12:00:00'),
(2, 'Samsung Galaxy Book', '899.99', 'Electronics', '2025-09-10 12:00:00'),
(3, 'Nike Air Max 270', '149.99', 'Footwear', '2025-09-10 12:00:00'),
(4, 'Adidas Ultraboost 22', '179.99', 'Footwear', '2025-09-10 12:00:00'),
(5, 'Levi\'s 501 Jeans', '59.99', 'Clothing', '2025-09-10 12:00:00'),
(6, 'Sony WH-1000XM4 Headphones', '349.99', 'Electronics', '2025-09-10 12:00:00'),
(7, 'New Balance 574', '79.99', 'Footwear', '2025-09-10 12:00:00'),
(8, 'H&M Cotton T-Shirt', '12.99', 'Clothing', '2025-09-10 12:00:00');

-- Indexes for table `products`
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_category` (`category`);

-- AUTO_INCREMENT for table `products`
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

COMMIT;