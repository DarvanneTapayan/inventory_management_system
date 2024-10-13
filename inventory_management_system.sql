-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Oct 13, 2024 at 09:46 PM
-- Server version: 8.3.0
-- PHP Version: 8.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `inventory_management_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `description` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `description`) VALUES
(4, 'Beverage', 'mga im no non lang dari'),
(5, 'Cakes', 'mga lami nga makaon\r\n');

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

DROP TABLE IF EXISTS `contacts`;
CREATE TABLE IF NOT EXISTS `contacts` (
  `id` int NOT NULL AUTO_INCREMENT,
  `store_image_url` varchar(255) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `facebook_url` varchar(255) DEFAULT NULL,
  `store_name` varchar(100) DEFAULT NULL,
  `address` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `contacts`
--

INSERT INTO `contacts` (`id`, `store_image_url`, `email`, `phone`, `facebook_url`, `store_name`, `address`) VALUES
(1, 'images/store.jpg', 'contact@cakestore.com', '+1234567890', 'https://facebook.com/cakestore', 'Cake Bake Shop', '123 Main St, Townsville');

-- --------------------------------------------------------

--
-- Table structure for table `inventory`
--

DROP TABLE IF EXISTS `inventory`;
CREATE TABLE IF NOT EXISTS `inventory` (
  `id` int NOT NULL AUTO_INCREMENT,
  `product_id` int NOT NULL,
  `quantity_in_stock` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `idx_inventory_product` (`product_id`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `inventory`
--

INSERT INTO `inventory` (`id`, `product_id`, `quantity_in_stock`) VALUES
(6, 15, 0),
(5, 14, 0),
(4, 13, 100),
(7, 26, 5156),
(8, 27, 4),
(9, 28, 106),
(10, 29, 1),
(11, 30, 0),
(12, 31, 0),
(13, 32, 0);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
CREATE TABLE IF NOT EXISTS `orders` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `status` enum('pending','processing','delivering','delivered','canceled') NOT NULL DEFAULT 'pending',
  `total_amount` decimal(10,2) NOT NULL,
  `payment_method` varchar(50) NOT NULL,
  `order_type` enum('pickup','delivery') NOT NULL,
  `reservation_date` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `address` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `idx_order_status` (`status`)
) ENGINE=MyISAM AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `status`, `total_amount`, `payment_method`, `order_type`, `reservation_date`, `created_at`, `address`) VALUES
(2, 3, 'pending', 40.00, 'credit_card', 'pickup', '2024-10-13', '2024-10-13 14:05:57', 'Zone 2, Barangay Agusan, CDOC'),
(3, 3, 'pending', 40.00, 'credit_card', 'pickup', '2024-10-17', '2024-10-13 14:08:18', 'Zone 2, Barangay Agusan, CDOC'),
(4, 3, 'pending', 132.00, 'credit_card', 'delivery', '2024-10-17', '2024-10-13 14:09:48', 'Zone 2, Barangay Agusan, CDOC'),
(5, 3, 'pending', 92.00, 'credit_card', 'delivery', '2024-10-31', '2024-10-13 14:16:16', 'Zone 2, Barangay Agusan, CDOC'),
(6, 3, 'pending', 40.00, 'credit_card', 'pickup', '2024-10-17', '2024-10-13 14:20:29', 'BARAG123122323232323'),
(7, 3, 'pending', 172.00, 'credit_card', 'pickup', '2024-10-15', '2024-10-13 14:23:49', 'BARAG'),
(8, 3, 'pending', 92.00, 'credit_card', 'pickup', '2024-10-16', '2024-10-13 14:24:04', '123'),
(9, 3, 'pending', 40.00, 'credit_card', 'pickup', '2024-10-23', '2024-10-13 14:33:20', '1232323232'),
(10, 3, 'pending', 40.00, 'credit_card', 'pickup', '2024-10-19', '2024-10-13 14:36:14', 'BARAG'),
(11, 3, 'canceled', 254460.00, 'credit_card', 'pickup', '2024-10-19', '2024-10-13 14:36:39', '12312c3123c2'),
(12, 3, 'delivered', 80.00, 'credit_card', 'delivery', '2024-10-17', '2024-10-13 15:28:07', 'BARAG123122323232323'),
(13, 3, 'pending', 80.00, 'paypal', 'delivery', '2024-10-19', '2024-10-13 15:28:30', 'BARAG123122323232323'),
(14, 3, 'pending', 40.00, 'paypal', 'delivery', '2024-10-30', '2024-10-13 15:29:55', 'BARAG123122323232323'),
(15, 3, 'pending', 40.00, 'paypal', 'delivery', '2024-10-30', '2024-10-13 15:30:25', 'BARAG123122323232323'),
(16, 3, 'pending', 90.00, 'credit_card', 'pickup', '2024-10-23', '2024-10-13 15:39:49', 'BARAG'),
(17, 3, 'pending', 126.00, 'credit_card', 'pickup', '2024-10-19', '2024-10-13 15:40:25', 'BARAG'),
(18, 2, 'processing', 40.00, 'credit_card', 'pickup', '2024-10-24', '2024-10-13 16:06:22', 'BARAG123122323232323'),
(19, 3, 'canceled', 40.00, 'credit_card', 'pickup', '2024-10-23', '2024-10-13 16:18:48', '1232323232'),
(20, 2, 'pending', 40.00, 'credit_card', 'pickup', '2024-10-24', '2024-10-13 16:21:18', '1232323232'),
(21, 2, 'pending', 4000.00, 'credit_card', 'pickup', '2024-10-17', '2024-10-13 16:24:05', '12312c3123c2'),
(22, 2, 'pending', 137690.00, 'credit_card', 'pickup', '2024-10-18', '2024-10-13 16:25:53', 'qwe'),
(23, 3, 'canceled', 100000.00, 'credit_card', 'pickup', '2024-10-24', '2024-10-13 16:51:43', 'BARAG123122323232323'),
(24, 4, 'canceled', 80.00, 'credit_card', 'delivery', '2024-10-31', '2024-10-13 17:00:13', 'BARAG'),
(25, 4, 'canceled', 42.00, 'credit_card', 'pickup', '2024-10-24', '2024-10-13 17:32:27', 'BARAG123122323232323'),
(26, 4, 'processing', 10.00, 'credit_card', 'pickup', '2024-10-31', '2024-10-13 19:29:51', 'BARAG123122323232323'),
(27, 4, 'pending', 40.00, 'cash_on_delivery', 'pickup', '2024-10-25', '2024-10-13 19:36:14', 'Zone 2, Agusan, CDOC');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

DROP TABLE IF EXISTS `order_items`;
CREATE TABLE IF NOT EXISTS `order_items` (
  `id` int NOT NULL AUTO_INCREMENT,
  `order_id` int NOT NULL,
  `product_id` int NOT NULL,
  `quantity` int NOT NULL,
  `price` decimal(10,2) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `order_id` (`order_id`),
  KEY `product_id` (`product_id`)
) ENGINE=MyISAM AUTO_INCREMENT=36 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `product_id`, `quantity`, `price`) VALUES
(2, 2, 28, 1, 40.00),
(3, 3, 28, 1, 40.00),
(4, 4, 28, 2, 40.00),
(5, 4, 29, 1, 10.00),
(6, 4, 27, 1, 42.00),
(7, 5, 28, 1, 40.00),
(8, 5, 29, 1, 10.00),
(9, 5, 27, 1, 42.00),
(10, 6, 28, 1, 40.00),
(11, 7, 28, 3, 40.00),
(12, 7, 29, 1, 10.00),
(13, 7, 27, 1, 42.00),
(14, 8, 28, 1, 40.00),
(15, 8, 29, 1, 10.00),
(16, 8, 27, 1, 42.00),
(17, 9, 28, 1, 40.00),
(18, 10, 28, 1, 40.00),
(19, 11, 29, 25446, 10.00),
(20, 12, 28, 2, 40.00),
(21, 13, 28, 2, 40.00),
(22, 14, 28, 1, 40.00),
(23, 15, 28, 1, 40.00),
(24, 16, 28, 1, 40.00),
(25, 17, 27, 3, 42.00),
(26, 18, 28, 1, 40.00),
(27, 19, 28, 1, 40.00),
(28, 20, 28, 1, 40.00),
(29, 21, 28, 100, 40.00),
(30, 22, 29, 13769, 10.00),
(31, 23, 29, 10000, 10.00),
(32, 24, 28, 2, 40.00),
(33, 25, 27, 1, 42.00),
(34, 26, 29, 1, 10.00),
(35, 27, 28, 1, 40.00);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
CREATE TABLE IF NOT EXISTS `products` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `description` text,
  `price` decimal(10,2) NOT NULL,
  `category_id` int DEFAULT NULL,
  `image_url` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `idx_product_category` (`category_id`)
) ENGINE=MyISAM AUTO_INCREMENT=33 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `price`, `category_id`, `image_url`, `created_at`) VALUES
(28, 'Chocolate Cake', 'none', 40.00, 5, 'https://media.istockphoto.com/id/2176481922/photo/fresh-baked-chocolate-brownies.jpg?s=612x612&w=is&k=20&c=SkIt4OLjQvLeNaisG6Nu6_q7itxBWSvrRyFp119ILdo=', '2024-10-13 08:50:57'),
(29, 'Coca-Cola', 'none', 10.00, 4, 'https://media.istockphoto.com/id/533575209/photo/soft-drink-being-poured-into-glass.jpg?s=612x612&w=is&k=20&c=je_nuNm9MQUT7x9ktBjNf9lZlQxquUBrgr3rKEFCrQ4=', '2024-10-13 08:51:40'),
(30, 'Pine Apple Cake', 'none', 50.00, 5, 'https://media.istockphoto.com/id/1481084496/photo/delicious-pineapple-cake-pastry-in-a-plate-on-wooden-table-background-with-tea.jpg?s=2048x2048&w=is&k=20&c=_xAz-pGRl1IA70A3td_Cp5K5agsd3AzNcXtL_5PLOiw=', '2024-10-13 17:06:30'),
(31, 'Red Berry Cake', 'none', 98.00, 5, 'https://media.istockphoto.com/id/1392254528/photo/latin-desert-with-ice-cream-and-meringue.jpg?s=2048x2048&w=is&k=20&c=NyXoFxVR5AYbOJXGzB5f3bY6LxEvunX0-KOyordeGHo=', '2024-10-13 17:07:15'),
(32, 'Orange Juice', 'none', 10.00, 4, 'https://media.istockphoto.com/id/164326518/photo/orange-juice-bottle-isolated-on-black-background.jpg?s=2048x2048&w=is&k=20&c=nfTsa0mOi6_dWwlVKN3a6RXXEwkY0Enjfp3eC5RxPmU=', '2024-10-13 17:07:58'),
(27, 'Strawberry Cake', 'none', 42.00, 5, 'https://media.istockphoto.com/id/861539268/photo/slice-of-strawberry-cheesecake.jpg?s=612x612&w=is&k=20&c=8IICMCZnfyOwgMjI81nceTdLWSQmX_hK2ul12ntz3-Q=', '2024-10-13 08:50:16');

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

DROP TABLE IF EXISTS `sales`;
CREATE TABLE IF NOT EXISTS `sales` (
  `id` int NOT NULL AUTO_INCREMENT,
  `order_id` int NOT NULL,
  `product_id` int NOT NULL,
  `quantity` int NOT NULL,
  `sale_amount` decimal(10,2) NOT NULL,
  `sale_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `order_id` (`order_id`),
  KEY `product_id` (`product_id`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `sales`
--

INSERT INTO `sales` (`id`, `order_id`, `product_id`, `quantity`, `sale_amount`, `sale_date`) VALUES
(2, 16, 28, 1, 40.00, '2024-10-13 07:39:49'),
(3, 17, 27, 3, 126.00, '2024-10-13 07:40:25'),
(4, 18, 28, 1, 40.00, '2024-10-13 08:06:22'),
(5, 19, 28, 1, 40.00, '2024-10-13 08:18:48'),
(6, 20, 28, 1, 40.00, '2024-10-13 08:21:18'),
(7, 21, 28, 100, 4000.00, '2024-10-13 08:24:05'),
(8, 22, 29, 13769, 137690.00, '2024-10-13 08:25:53'),
(9, 23, 29, 10000, 100000.00, '2024-10-13 08:51:43'),
(10, 24, 28, 2, 80.00, '2024-10-13 09:00:14'),
(11, 25, 27, 1, 42.00, '2024-10-13 09:32:27'),
(12, 26, 29, 1, 10.00, '2024-10-13 11:29:51'),
(13, 27, 28, 1, 40.00, '2024-10-13 11:36:14');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `role` enum('admin','user') NOT NULL DEFAULT 'user',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  KEY `idx_user_role` (`role`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `phone`, `role`, `created_at`) VALUES
(1, 'admin', '0192023a7bbd73250516f069df18b500', 'admin@example.com', NULL, 'admin', '2024-10-11 11:07:12'),
(2, 'admin123', '$2y$10$Hr0sXpvn63slef5LptWXaOBI9Cu0uYO3Vf.cnD6z30YWKCFLh9RZC', 'admin123@gmail.com', '12345678910', 'admin', '2024-10-11 13:23:06'),
(3, 'user123', '$2y$10$vGe/FpjdG5gVmZRg5idO.eCKBIPFNxNM70LI0KUEteErr3GDbIBjm', 'user123@gmail.com', '123-456-7890', '', '2024-10-11 14:08:09'),
(4, 'user2', '$2y$10$ZL4NYkFkAnoKy.vOE5/L.upsJjcPESufw6hkp3TNbf3UIvaunuO6K', 'user2@gmail.com', '09876543211', 'user', '2024-10-13 16:57:25');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
