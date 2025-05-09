-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 09 مايو 2025 الساعة 01:55
-- إصدار الخادم: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `online_store`
--

-- --------------------------------------------------------

--
-- بنية الجدول `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `price` int(11) UNSIGNED NOT NULL,
  `description` text NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `favorite_product` tinyint(4) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- إرجاع أو استيراد بيانات الجدول `products`
--

INSERT INTO `products` (`id`, `product_name`, `price`, `description`, `image`, `favorite_product`, `created_at`, `updated_at`) VALUES
(1, 'this is a new product', 250, 'description 2025 Alkher Update Data In a MySQL Table Using MySQLi and PDO\nThe UPDATE statement is used to update existing records in a table rights reserved 2025 Alkher, Inc. All rights reserved 2025 eserved 2025 A', 'download.jpeg', 1, '2025-05-07 12:21:39', '2025-05-08 11:34:52'),
(2, 'new', 250, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quae unde officia voluptatum, excepturi eligendi esse eveniet error quia reiciendis, illum numquam, fugiat aliquam quas ad. Dolor magni maiores tempora pariatur?', 'download (1).jpeg', 1, '2025-05-07 12:21:39', '2025-05-08 09:41:24'),
(4, 'default', 250, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quae unde officia voluptatum, excepturi eligendi esse eveniet error quia reiciendis, illum numquam, fugiat aliquam quas ad. Dolor magni maiores tempora pariatur?', 'default.png', 0, '2025-05-07 12:21:39', '2025-05-08 22:17:03');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
