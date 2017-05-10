-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 10, 2017 at 05:02 PM
-- Server version: 5.6.28
-- PHP Version: 5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `logistics.system`
--

-- --------------------------------------------------------

--
-- Table structure for table `users_position`
--

CREATE TABLE `users_position` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `permissions` varchar(255) DEFAULT NULL,
  `active` tinyint(4) NOT NULL DEFAULT '1',
  `fixed` tinyint(4) NOT NULL DEFAULT '0' COMMENT '1 - Cố định , 0 - Thay đổi',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users_position`
--

INSERT INTO `users_position` (`id`, `name`, `permissions`, `active`, `fixed`, `created_at`, `updated_at`) VALUES
(1, 'Nhân viên Bán hàng', '["1","7","57","58","15","29","59","60","61","43","44","45","69"]', 1, 1, '2017-04-03 06:45:08', '2017-04-03 04:41:46'),
(2, 'Nhân viên quản lý kho', '["3","5","4","6","21","22","23","24","25","26","27","28","29","30","31","32","33","34","35","36","59","60","61"]', 1, 1, '2017-04-03 06:45:25', '2017-04-03 03:55:13'),
(3, 'Nhân viên Telesale', '["1","7","57","58","15","29","59","60","61","43","44","45","69"]', 1, 1, '2017-05-10 04:01:54', '2017-04-03 04:42:46'),
(4, 'Cộng tác viên Affiliate', NULL, 1, 1, '2017-05-10 04:08:02', '2017-05-09 17:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users_position`
--
ALTER TABLE `users_position`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users_position`
--
ALTER TABLE `users_position`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
