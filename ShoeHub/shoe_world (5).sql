-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 23, 2025 at 06:15 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `shoe_world`
--

-- --------------------------------------------------------

--
-- Table structure for table `contact_messages`
--

CREATE TABLE `contact_messages` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contact_messages`
--

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `address` text NOT NULL,
  `city` varchar(50) NOT NULL,
  `state` varchar(50) NOT NULL,
  `zip` varchar(10) NOT NULL,
  `card_name` varchar(100) NOT NULL,
  `card_number` varchar(20) NOT NULL,
  `expiry` varchar(7) NOT NULL,
  `cvv` varchar(4) NOT NULL,
  `subtotal` decimal(10,2) NOT NULL,
  `shipping` decimal(10,2) NOT NULL DEFAULT 5.00,
  `total` decimal(10,2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `subtotal` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `product_name`, `quantity`, `price`, `subtotal`) VALUES
(12, 11, 'Wallabee', 52, 12000.00, 624000.00),
(13, 11, 'Ultraboost 22', 1, 17999.00, 17999.00),
(14, 12, 'Ultraboost 22', 2, 17999.00, 35998.00);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `brand` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `material` varchar(100) NOT NULL,
  `size_available` varchar(100) NOT NULL,
  `color` varchar(50) NOT NULL,
  `gender` enum('Men','Women','Unisex') NOT NULL,
  `stock` int(11) NOT NULL DEFAULT 0,
  `price` decimal(10,2) NOT NULL,
  `ratings` decimal(2,1) NOT NULL DEFAULT 4.5,
  `reviews` int(11) NOT NULL DEFAULT 0,
  `image_url` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `brand`, `description`, `material`, `size_available`, `color`, `gender`, `stock`, `price`, `ratings`, `reviews`, `image_url`, `created_at`) VALUES
(1, 'Air Max 270', 'Nike', 'Stylish running shoes with air cushioning.', 'Mesh & Rubber', '7, 8, 9, 10, 11', 'Black & Red', 'Men', 50, 13995.00, 4.7, 180, 'images/Air Max 270 (Nike).avif', '2025-02-21 08:21:16'),
(2, 'Ultraboost 22', 'Adidas', 'Comfortable and high-performance running shoes.', 'Primeknit & Foam', '6, 7, 8, 9, 10', 'White & Blue', 'Unisex', 40, 17999.00, 4.8, 220, 'images/Ultraboost 22 (Adidas).jpg', '2025-02-21 08:21:16'),
(3, 'Wallabee', 'Clarks', 'Classic leather casual shoes.', 'Suede Leather', '7, 8, 9, 10', 'Brown', 'Men', 30, 12000.00, 4.6, 95, 'images/Wallabee (Clarks).png', '2025-02-21 08:21:16'),
(4, 'Chuck Taylor All Star', 'Converse', 'Iconic high-top sneakers.', 'Canvas & Rubber', '6, 7, 8, 9, 10', 'White', 'Unisex', 60, 5000.00, 4.5, 300, 'images/Chuck Taylor All Star (Converse).webp', '2025-02-21 08:21:16'),
(5, 'Stan Smith', 'Adidas', 'Minimalistic tennis shoes with great comfort.', 'Synthetic Leather', '5, 6, 7, 8, 9', 'Green & White', 'Unisex', 45, 8999.00, 4.7, 250, 'images/Stan Smith (Adidas).avif', '2025-02-21 08:21:16'),
(6, 'Air Force 1', 'Nike', 'Classic basketball shoes with a modern touch.', 'Leather', '7, 8, 9, 10, 11', 'Black', 'Men', 55, 11000.00, 4.8, 320, 'images/Air Force 1 (Nike).jpg', '2025-02-21 08:21:16'),
(7, 'Old Skool', 'Vans', 'Skateboarding sneakers with timeless design.', 'Suede & Canvas', '6, 7, 8, 9', 'Black & White', 'Unisex', 70, 6000.00, 4.6, 200, 'images/Old Skool (Vans).webp', '2025-02-21 08:21:16'),
(8, 'Gel-Kayano 28', 'ASICS', 'Stable and cushioned running shoes.', 'Mesh & Gel', '6, 7, 8, 9, 10', 'Blue & Yellow', 'Men', 35, 17000.00, 4.7, 140, 'images/Gel-Kayano 28 (ASICS).jpg', '2025-02-21 08:21:16'),
(9, 'Classic Clog', 'Crocs', 'Lightweight and comfortable clogs.', 'EVA Foam', '5, 6, 7, 8, 9', 'Navy Blue', 'Unisex', 80, 3000.00, 4.4, 500, 'images/Classic Clog (Crocs).jpg', '2025-02-21 08:21:16'),
(10, 'Puma RS-X', 'Puma', 'Chunky sneakers with retro styling.', 'Mesh & Suede', '7, 8, 9, 10', 'Red & White', 'Men', 45, 10000.00, 4.5, 130, 'images/Puma RS-X (Puma).webp', '2025-02-21 08:21:16'),
(11, 'Pegasus 39', 'Nike', 'Everyday running shoes with excellent responsiveness.', 'Flyknit & Foam', '6, 7, 8, 9, 10', 'Gray & Black', 'Unisex', 50, 13000.00, 4.6, 210, 'images/Pegasus 39 (Nike).avif', '2025-02-21 08:21:16'),
(12, 'Yeezy Boost 350 V2', 'Adidas', 'Trendy sneakers designed by Kanye West.', 'Primeknit & Boost', '7, 8, 9, 10', 'Zebra', 'Unisex', 20, 25000.00, 4.9, 400, 'images/Yeezy Boost 350 V2 (Adidas).avif', '2025-02-21 08:21:16'),
(13, 'Dr. Martens 1460', 'Dr. Martens', 'Iconic combat boots with great durability.', 'Leather', '6, 7, 8, 9, 10', 'Black', 'Unisex', 25, 18000.00, 4.8, 310, 'images/Dr. Martens 1460 (Dr. Martens).jpg', '2025-02-21 08:21:16'),
(14, 'Reebok Club C 85', 'Reebok', 'Classic tennis sneakers with a vintage feel.', 'Leather', '6, 7, 8, 9', 'White & Green', 'Unisex', 60, 7000.00, 4.5, 180, 'images/Reebok Club C 85 (Reebok).avif', '2025-02-21 08:21:16'),
(15, 'New Balance 574', 'New Balance', 'Stylish retro running shoes.', 'Suede & Mesh', '7, 8, 9, 10', 'Gray & White', 'Unisex', 55, 6500.00, 4.6, 230, 'images/New Balance 574 (New Balance).jpg', '2025-02-21 08:21:16');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password_hash`, `created_at`) VALUES
(1, 'john_doe', 'john@example.com', '$2y$10$TKh8H1.PORrs/DZ1EPtUIORvG2zfj12wLFGFtqEEdWZPOaA9lj/bW', '2025-01-06 16:25:50'),
(2, 'jane_smith', 'jane@example.com', '$2y$10$DxWRqQrz43cnJFPmfP0jXeXkRLJGyXZOVOFZxpQonvW6Nz1zHnhbS', '2025-01-06 16:25:50'),
--
-- Indexes for dumped tables
--

--
-- Indexes for table `contact_messages`
--
ALTER TABLE `contact_messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `contact_messages`
--
ALTER TABLE `contact_messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
