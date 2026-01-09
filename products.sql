-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 09, 2026 at 08:43 AM
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
-- Database: `db_belajar_laravel`
--

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `code` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` decimal(20,2) NOT NULL,
  `stock` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `code`, `name`, `price`, `stock`, `created_at`, `updated_at`) VALUES
(2, 'MN002', 'Monitor LG 24 inch', 15.00, 1850000, '2026-01-08 00:02:59', '2026-01-08 00:05:51'),
(3, 'KB003', 'Keyboard Mechanical Keychron', 12.00, 1200000, '2026-01-08 00:05:32', '2026-01-08 00:05:32'),
(4, 'MS004', 'Mouse Logitech G Pro', 20.00, 1550000, '2026-01-08 00:13:26', '2026-01-08 00:13:26'),
(5, 'HS005', 'Headset SteelSeries Arctis', 10.00, 2100000, '2026-01-08 00:14:06', '2026-01-08 00:14:06'),
(6, 'ST006', 'SSD Samsung 980 Pro 1TB', 25.00, 1750000, '2026-01-08 00:14:43', '2026-01-08 00:14:43'),
(7, 'RM007', 'RAM Corsair Vengeance 16GB', 18.00, 950000, '2026-01-08 00:17:48', '2026-01-08 00:17:48'),
(8, 'MB008', 'Motherboard MSI B550', 5.00, 2450000, '2026-01-08 00:18:19', '2026-01-08 00:18:19'),
(9, 'VG009', 'VGA NVIDIA RTX 3060', 4.00, 4800000, '2026-01-08 00:19:11', '2026-01-08 00:19:11'),
(10, 'PS010', 'PSU Seasonic 650W Gold', 7.00, 1350000, '2026-01-08 00:19:40', '2026-01-08 00:19:40'),
(11, 'LP001', 'Laptop ASUS ROG Strix', 8.00, 16500000, '2026-01-08 00:21:02', '2026-01-08 00:21:02');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `products_code_unique` (`code`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
