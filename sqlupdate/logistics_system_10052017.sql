-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 10, 2017 at 05:01 PM
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
-- Table structure for table `affiliate_group`
--

CREATE TABLE `affiliate_group` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `active` tinyint(4) NOT NULL DEFAULT '1',
  `admin_id` int(11) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `affiliate_group_user`
--

CREATE TABLE `affiliate_group_user` (
  `id` int(11) NOT NULL,
  `affiliate_group_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `leader` tinyint(4) NOT NULL DEFAULT '0',
  `active` tinyint(4) NOT NULL DEFAULT '1',
  `admin_id` int(11) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `affiliate_product`
--

CREATE TABLE `affiliate_product` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `profit` int(11) NOT NULL,
  `admin_id` int(11) NOT NULL DEFAULT '1',
  `active` tinyint(4) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `affiliate_user_order_logs`
--

CREATE TABLE `affiliate_user_order_logs` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `affiliate_user_product`
--

CREATE TABLE `affiliate_user_product` (
  `id` int(11) NOT NULL,
  `affiliate_product_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `active` int(11) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `affiliate_user_product_logs`
--

CREATE TABLE `affiliate_user_product_logs` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `affiliate_user_order_logs_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_quantity` int(11) NOT NULL,
  `current_price` decimal(10,0) NOT NULL,
  `current_profit` int(11) NOT NULL,
  `profit_price` decimal(10,0) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `affiliate_group`
--
ALTER TABLE `affiliate_group`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `affiliate_group_user`
--
ALTER TABLE `affiliate_group_user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `affiliate_product`
--
ALTER TABLE `affiliate_product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `affiliate_user_order_logs`
--
ALTER TABLE `affiliate_user_order_logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `affiliate_user_product`
--
ALTER TABLE `affiliate_user_product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `affiliate_user_product_logs`
--
ALTER TABLE `affiliate_user_product_logs`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `affiliate_group`
--
ALTER TABLE `affiliate_group`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `affiliate_group_user`
--
ALTER TABLE `affiliate_group_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `affiliate_product`
--
ALTER TABLE `affiliate_product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `affiliate_user_order_logs`
--
ALTER TABLE `affiliate_user_order_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `affiliate_user_product`
--
ALTER TABLE `affiliate_user_product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `affiliate_user_product_logs`
--
ALTER TABLE `affiliate_user_product_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
