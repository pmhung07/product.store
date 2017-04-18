-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 18, 2017 at 01:19 PM
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
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(10) UNSIGNED NOT NULL,
  `regency` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `profile_picture` varchar(255) NOT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `remember_token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `regency`, `email`, `password`, `full_name`, `profile_picture`, `status`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Administrator', 'pmhung07@gmail.com', '$2y$10$6Xx1y9Se3Q6Pp.OG7l0nfeMmxOh.f1bbWgeTaILlYhr2F6dOLRuXy', 'Phạm Hùng', '', NULL, 'gotc23WROqgTs7FjrZwFeoQgIvsBKMLAmV4YtIvFe1kes5oBvgjXO1y0epDy', '2016-11-28 17:00:00', '2016-11-29 21:01:33');

-- --------------------------------------------------------

--
-- Table structure for table `channel`
--

CREATE TABLE `channel` (
  `id` int(10) NOT NULL,
  `name` varchar(255) NOT NULL,
  `link` varchar(255) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `channel`
--

INSERT INTO `channel` (`id`, `name`, `link`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Bán hàng qua Facebook', 'https://www.facebook.com/', 1, '2017-01-06 03:24:49', '2017-01-06 03:37:42'),
(4, 'Bán hàng tại quầy 35 Nguyễn Tuân', '', 1, '2017-02-10 07:13:40', '2017-02-10 07:13:40');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` int(11) NOT NULL,
  `province_id` int(11) DEFAULT '0',
  `district_id` int(11) DEFAULT '0',
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `address` text,
  `birthdate` timestamp NULL DEFAULT NULL,
  `gender` tinyint(4) DEFAULT NULL,
  `active` int(11) DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `province_id`, `district_id`, `name`, `email`, `phone`, `address`, `birthdate`, `gender`, `active`, `created_at`, `updated_at`) VALUES
(1, 24, 238, 'Phạm Mạnh Hùng', '', '01678481197', '35 Nguyễn Tuân', NULL, 1, 1, '2017-03-23 05:50:31', '2017-03-25 02:49:59'),
(2, 24, 238, 'Hoàng Thụ', '', '0986727272', '30 Nguyễn Công Trứ', NULL, 1, 1, '2017-03-24 10:15:31', '2017-03-24 10:15:31');

-- --------------------------------------------------------

--
-- Table structure for table `data`
--

CREATE TABLE `data` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `type` varchar(255) NOT NULL COMMENT 'image - video..',
  `active` tinyint(4) NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `districts`
--

CREATE TABLE `districts` (
  `id` int(11) NOT NULL,
  `province_id` int(11) DEFAULT NULL,
  `name` varchar(45) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `order_number` int(11) DEFAULT NULL,
  `active` tinyint(1) DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='Quan/Huyen';

--
-- Dumping data for table `districts`
--

INSERT INTO `districts` (`id`, `province_id`, `name`, `order_number`, `active`, `created_at`, `updated_at`) VALUES
(1, 1, 'Thành phố trực thuộc (Long Xuyên)', 2, 1, NULL, NULL),
(2, 1, 'Thị xã Châu Đốc', 3, 1, NULL, NULL),
(3, 1, 'Thị xã Tân Châu', 4, 1, NULL, NULL),
(4, 1, 'Huyện An Phú', 5, 1, NULL, NULL),
(5, 1, 'Huyện Châu Phú', 6, 1, NULL, NULL),
(6, 1, 'Huyện Châu Thành', 7, 1, NULL, NULL),
(7, 1, 'Huyện Chợ Mới', 8, 1, NULL, NULL),
(8, 1, 'Huyện Phú Tân', 9, 1, NULL, NULL),
(9, 1, 'Huyện Thoại Sơn', 10, 1, NULL, NULL),
(10, 1, 'Huyện Tịnh Biên', 11, 1, NULL, NULL),
(11, 1, 'Huyện Tri Tôn', 12, 1, NULL, NULL),
(12, 2, 'Thành phố Vũng Tàu', 13, 1, NULL, NULL),
(13, 2, 'Thị xã Bà Rịa', 14, 1, NULL, NULL),
(14, 2, 'Huyện Long Điền', 15, 1, NULL, NULL),
(15, 2, 'Huyện Đất Đỏ', 16, 1, NULL, NULL),
(16, 2, 'Huyện Tân Thành', 17, 1, NULL, NULL),
(17, 2, 'Huyện Châu Đức', 18, 1, NULL, NULL),
(18, 2, 'Huyện Xuyên Mộc', 19, 1, NULL, NULL),
(19, 2, 'Huyện Côn Đảo', 20, 1, NULL, NULL),
(20, 3, 'Huyện Hiệp Hòa', 21, 1, NULL, NULL),
(21, 3, 'Huyện Lạng Giang', 22, 1, NULL, NULL),
(22, 3, 'Huyện Lục Nam', 23, 1, NULL, NULL),
(23, 3, 'Huyện Lục Ngạn', 24, 1, NULL, NULL),
(24, 3, 'Huyện Sơn Đông', 25, 1, NULL, NULL),
(25, 3, 'Huyện Tân Yên', 26, 1, NULL, NULL),
(26, 4, 'Thị xã Bắc Kạn', 27, 1, NULL, NULL),
(27, 4, 'Huyện Ba Bể', 28, 1, NULL, NULL),
(28, 4, 'Huyện Bạch Thông', 29, 1, NULL, NULL),
(29, 4, 'Huyện Chợ Đồn', 30, 1, NULL, NULL),
(30, 4, 'Huyện Chợ Mới', 31, 1, NULL, NULL),
(31, 4, 'Huyện Na Rì', 32, 1, NULL, NULL),
(32, 4, 'Huyện Ngân Sơn', 33, 1, NULL, NULL),
(33, 4, 'Huyện Pác Nặm', 34, 1, NULL, NULL),
(34, 5, 'Thành phố Bắc Giang', 35, 1, NULL, NULL),
(35, 5, 'Huyện Hiệp Hoà', 36, 1, NULL, NULL),
(36, 5, 'Huyện Lạng Giang', 37, 1, NULL, NULL),
(37, 5, 'Huyện Lục Nam', 38, 1, NULL, NULL),
(38, 5, 'Huyện Lục Ngạn', 39, 1, NULL, NULL),
(39, 5, 'Huyện Sơn Động', 40, 1, NULL, NULL),
(40, 5, 'Huyện Tân Yên', 41, 1, NULL, NULL),
(41, 5, 'Huyện Việt Yên', 42, 1, NULL, NULL),
(42, 5, 'Huyện Yên Dũng', 43, 1, NULL, NULL),
(43, 5, 'Huyện Yên Thế', 44, 1, NULL, NULL),
(44, 6, 'Thành phố Bắc Ninh', 45, 1, NULL, NULL),
(45, 6, 'Thị xã Từ Sơn', 46, 1, NULL, NULL),
(46, 6, 'Huyện Gia Bình', 47, 1, NULL, NULL),
(47, 6, 'Huyện Lương Tài', 48, 1, NULL, NULL),
(48, 6, 'Huyện Quế Võ', 49, 1, NULL, NULL),
(49, 6, 'Huyện Thuận Thành', 50, 1, NULL, NULL),
(50, 6, 'Huyện Tiên Du', 51, 1, NULL, NULL),
(51, 6, 'Huyện Yên Phong', 52, 1, NULL, NULL),
(52, 7, 'Thành phố Bến Tre', 53, 1, NULL, NULL),
(53, 7, 'Huyện Ba Tri', 54, 1, NULL, NULL),
(54, 7, 'Huyện Bình Đại', 55, 1, NULL, NULL),
(55, 7, 'Huyện Châu Thành', 56, 1, NULL, NULL),
(56, 7, 'Huyện Chợ Lách', 57, 1, NULL, NULL),
(57, 7, 'Huyện Giồng Trôm', 58, 1, NULL, NULL),
(58, 7, 'Huyện Mỏ Cày Bắc', 59, 1, NULL, NULL),
(59, 7, 'Huyện Mỏ Cày Nam', 60, 1, NULL, NULL),
(60, 7, 'Huyện Thạnh Phú', 61, 1, NULL, NULL),
(61, 8, 'Thành phố Quy Nhơn', 62, 1, NULL, NULL),
(62, 8, ' Huyện An Lão', 63, 1, NULL, NULL),
(63, 8, ' Huyện Hoài Nhơn', 64, 1, NULL, NULL),
(64, 8, 'Huyện Hoài Ân', 65, 1, NULL, NULL),
(65, 8, 'Huyện Phù Mỹ', 66, 1, NULL, NULL),
(66, 8, 'Huyện Vĩnh Thạnh', 67, 1, NULL, NULL),
(67, 8, 'Huyện Tây Sơn', 68, 1, NULL, NULL),
(68, 9, 'Huyện Thuận An', 69, 1, NULL, NULL),
(69, 9, 'Huyện Dĩ An', 70, 1, NULL, NULL),
(70, 9, 'Huyện Dầu Tiếng', 71, 1, NULL, NULL),
(71, 9, 'Huyện Phú Giáo', 72, 1, NULL, NULL),
(72, 9, 'Huyện Tân Uyên', 73, 1, NULL, NULL),
(73, 9, 'Huyện Bến Cát', 74, 1, NULL, NULL),
(74, 9, 'Thị xã Thủ Dầu Một', 75, 1, NULL, NULL),
(691, 3, 'TP Bắc GIang', 30, 1, NULL, NULL),
(690, 3, 'Huyện Yên Thế', 29, 1, NULL, NULL),
(689, 3, 'Huyện Yên Dũng', 28, 1, NULL, NULL),
(79, 10, 'Thị xã Đồng Xoài', 80, 1, NULL, NULL),
(80, 10, 'Thị xã Bình Long', 81, 1, NULL, NULL),
(81, 10, 'Thị xã Phước Long', 82, 1, NULL, NULL),
(82, 10, 'Huyện Bù Đăng', 83, 1, NULL, NULL),
(83, 10, 'Huyện Bù Đốp', 84, 1, NULL, NULL),
(84, 10, 'Huyện Bù Gia Mập', 85, 1, NULL, NULL),
(85, 10, 'Huyện Chơn Thành', 86, 1, NULL, NULL),
(86, 10, 'Huyện Đồng Phú', 87, 1, NULL, NULL),
(87, 10, 'Huyện Hớn Quản', 88, 1, NULL, NULL),
(88, 10, 'Huyện Lộc Ninh', 89, 1, NULL, NULL),
(89, 11, 'Thành phố Phan Thiết', 90, 1, NULL, NULL),
(90, 11, 'Thị xã La Gi', 91, 1, NULL, NULL),
(91, 11, 'Huyện Tuy Phong', 92, 1, NULL, NULL),
(92, 11, 'Huyện Bắc Bình', 93, 1, NULL, NULL),
(93, 11, 'Huyện Hàm Thuận Bắc', 94, 1, NULL, NULL),
(94, 11, 'Huyện Hàm Thuận Nam', 95, 1, NULL, NULL),
(95, 11, 'Huyện Tánh Linh', 96, 1, NULL, NULL),
(96, 11, 'Huyện Hàm Tân', 97, 1, NULL, NULL),
(97, 11, 'Huyện Đức Linh', 98, 1, NULL, NULL),
(98, 11, 'Huyện đảo Phú Quý', 99, 1, NULL, NULL),
(99, 12, 'Thành phố Cà Mau', 100, 1, NULL, NULL),
(100, 12, 'Huyện Đầm Dơi', 101, 1, NULL, NULL),
(101, 12, 'Huyện Ngọc Hiển', 102, 1, NULL, NULL),
(102, 12, 'Huyện Cái Nước', 103, 1, NULL, NULL),
(103, 12, 'Huyện Trần Văn Thời', 104, 1, NULL, NULL),
(104, 12, 'Huyện U Minh', 105, 1, NULL, NULL),
(105, 12, 'Huyện Thới Bình', 106, 1, NULL, NULL),
(106, 12, 'Huyện Năm Căn', 107, 1, NULL, NULL),
(107, 12, 'Huyện Phú Tân', 108, 1, NULL, NULL),
(108, 13, 'Quận Bình Thủy', 109, 1, NULL, NULL),
(109, 13, 'Quận Cái Răng', 110, 1, NULL, NULL),
(110, 13, 'Huyện Cờ Đỏ', 111, 1, NULL, NULL),
(111, 13, 'Huyện Phong Điền', 112, 1, NULL, NULL),
(112, 13, 'Huyện Thới Lai', 113, 1, NULL, NULL),
(113, 13, 'Huyện Vĩnh Thạnh', 114, 1, NULL, NULL),
(114, 13, 'Quận Ninh Kiều', 115, 1, NULL, NULL),
(115, 13, 'Quận Ô Môn', 116, 1, NULL, NULL),
(116, 13, 'Quận Thốt Nốt', 117, 1, NULL, NULL),
(688, 3, 'Huyện Việt Yên', 27, 1, NULL, NULL),
(121, 14, 'Quận Ninh Kiều', 122, 1, NULL, NULL),
(122, 14, 'Quận Bình Thủy', 123, 1, NULL, NULL),
(123, 14, 'Quận Cái Răng', 124, 1, NULL, NULL),
(124, 14, 'Quận Ô Môn', 125, 1, NULL, NULL),
(125, 14, 'Quận Thốt Nốt', 126, 1, NULL, NULL),
(126, 14, 'Quận Hưng Phú', 127, 1, NULL, NULL),
(127, 14, 'Huyện Phong Điền', 128, 1, NULL, NULL),
(128, 14, 'Huyện Cờ Đỏ', 129, 1, NULL, NULL),
(129, 14, 'Huyện Thới Lai', 130, 1, NULL, NULL),
(130, 14, 'Huyện Vĩnh Thạnh', 131, 1, NULL, NULL),
(131, 15, 'Quận Hải Châu', 132, 1, NULL, NULL),
(132, 15, 'Quận Thanh Khê', 133, 1, NULL, NULL),
(133, 15, 'Quận Sơn Trà', 134, 1, NULL, NULL),
(134, 15, 'Quận Ngũ Hành Sơn', 135, 1, NULL, NULL),
(135, 15, 'Quận Liên Chiểu', 136, 1, NULL, NULL),
(136, 15, 'Quận Cẩm Lệ', 137, 1, NULL, NULL),
(137, 15, 'Huyện Hòa Vang', 138, 1, NULL, NULL),
(138, 15, 'Huyện đảo Hoàng Sa', 139, 1, NULL, NULL),
(139, 16, 'Thành phố Buôn Ma Thuột', 140, 1, NULL, NULL),
(140, 16, 'Thị xã Buôn Hồ', 141, 1, NULL, NULL),
(141, 16, 'Huyện Buôn Đôn', 142, 1, NULL, NULL),
(142, 16, 'Huyện Cư Kuin', 143, 1, NULL, NULL),
(143, 16, 'Huyện Cư M\'gar', 144, 1, NULL, NULL),
(144, 16, 'Huyện Ea H\'leo', 145, 1, NULL, NULL),
(145, 16, 'Huyện Ea Kar', 146, 1, NULL, NULL),
(146, 16, 'Huyện Ea Súp', 147, 1, NULL, NULL),
(147, 16, 'Huyện Krông Bông', 148, 1, NULL, NULL),
(148, 16, 'Huyện Krông Buk', 149, 1, NULL, NULL),
(149, 16, 'Huyện Krông Pak', 150, 1, NULL, NULL),
(150, 16, 'Huyện Lắk', 151, 1, NULL, NULL),
(151, 16, 'Huyện M\'Drăk', 152, 1, NULL, NULL),
(152, 16, 'Huyện Krông Ana', 153, 1, NULL, NULL),
(153, 16, 'Huyện Krông Năng', 154, 1, NULL, NULL),
(154, 17, 'Thị xã Gia Nghĩa', 155, 1, NULL, NULL),
(155, 17, 'Huyện Cư Jút', 156, 1, NULL, NULL),
(156, 17, 'Huyện Đắk Glong', 157, 1, NULL, NULL),
(157, 17, 'Huyện Đắk Mil', 158, 1, NULL, NULL),
(158, 17, 'Huyện Đắk R\'Lấp', 159, 1, NULL, NULL),
(159, 17, 'Huyện Đắk Song', 160, 1, NULL, NULL),
(160, 17, 'Huyện Krông Nô', 161, 1, NULL, NULL),
(161, 17, 'Huyện Tuy Đức', 162, 1, NULL, NULL),
(162, 18, 'Thành phố Điện Biên Phủ', 163, 1, NULL, NULL),
(163, 18, 'Thị xã Mường Lay', 164, 1, NULL, NULL),
(164, 18, 'Huyện Điện Biên', 165, 1, NULL, NULL),
(165, 18, 'Huyện Điện Biên Đông', 166, 1, NULL, NULL),
(166, 18, 'Huyện Mường Ảng', 167, 1, NULL, NULL),
(167, 18, 'Huyện Mường Chà', 168, 1, NULL, NULL),
(168, 18, 'Huyện Mường Nhé', 169, 1, NULL, NULL),
(169, 18, 'Huyện Tủa Chùa', 170, 1, NULL, NULL),
(170, 18, 'Huyện Tuần Giáo', 171, 1, NULL, NULL),
(171, 19, 'Thành phố Biên Hoà', 172, 1, NULL, NULL),
(172, 19, 'Thị xã Long Khánh', 173, 1, NULL, NULL),
(173, 19, 'Huyện Định Quán', 174, 1, NULL, NULL),
(174, 19, 'Huyện Long Thành', 175, 1, NULL, NULL),
(175, 19, 'Huyện Nhơn Trạch', 176, 1, NULL, NULL),
(176, 19, 'Huyện Tân Phú', 177, 1, NULL, NULL),
(177, 19, 'Huyện Thống Nhất', 178, 1, NULL, NULL),
(178, 19, 'Huyện Vĩnh Cửu', 179, 1, NULL, NULL),
(179, 19, 'Huyện Xuân Lộc', 180, 1, NULL, NULL),
(180, 19, 'Huyện Cẩm Mỹ', 181, 1, NULL, NULL),
(181, 19, 'Huyện Trảng Bom', 182, 1, NULL, NULL),
(182, 20, 'Thành phố Cao Lãnh', 183, 1, NULL, NULL),
(183, 20, 'Thị xã Sa Đéc', 184, 1, NULL, NULL),
(184, 20, 'Thị xã Hồng Ngự', 185, 1, NULL, NULL),
(185, 20, 'Huyện Cao Lãnh', 186, 1, NULL, NULL),
(186, 20, 'Huyện Châu Thành', 187, 1, NULL, NULL),
(187, 20, 'Huyện Hồng Ngự', 188, 1, NULL, NULL),
(188, 20, 'Huyện Lai Vung', 189, 1, NULL, NULL),
(189, 20, 'Huyện Lấp Vò', 190, 1, NULL, NULL),
(190, 20, 'Huyện Tam Nông', 191, 1, NULL, NULL),
(191, 20, 'Huyện Tân Hồng', 192, 1, NULL, NULL),
(192, 20, 'Huyện Thanh Bình', 193, 1, NULL, NULL),
(193, 20, 'Huyện Tháp Mười', 194, 1, NULL, NULL),
(194, 21, 'Thành phố Pleiku', 195, 1, NULL, NULL),
(195, 21, 'Thị xã An Khê', 196, 1, NULL, NULL),
(196, 21, 'Thị xã Ayun Pa', 197, 1, NULL, NULL),
(197, 21, 'Huyện Chư Păh', 198, 1, NULL, NULL),
(198, 21, 'Huyện Chư Prông', 199, 1, NULL, NULL),
(199, 21, 'Huyện Chư Sê', 200, 1, NULL, NULL),
(200, 21, 'Huyện Đắk Đoa', 201, 1, NULL, NULL),
(201, 21, 'Huyện Đak Pơ', 202, 1, NULL, NULL),
(202, 21, 'Huyện Đức Cơ', 203, 1, NULL, NULL),
(203, 21, 'Huyện Ia Grai', 204, 1, NULL, NULL),
(204, 21, 'Huyện Ia Pa', 205, 1, NULL, NULL),
(205, 21, 'Huyện K\'Bang', 206, 1, NULL, NULL),
(206, 21, 'Huyện Kông Chro', 207, 1, NULL, NULL),
(207, 21, 'Huyện Krông Pa', 208, 1, NULL, NULL),
(208, 21, 'Huyện Mang Yang', 209, 1, NULL, NULL),
(209, 21, 'Huyện Phú Thiện', 210, 1, NULL, NULL),
(210, 21, 'Huyện Chư Pưh', 211, 1, NULL, NULL),
(211, 22, 'Thị xã Hà Giang', 212, 1, NULL, NULL),
(212, 22, 'Huyện Bắc Mê', 213, 1, NULL, NULL),
(213, 22, 'Huyện Bắc Quang', 214, 1, NULL, NULL),
(214, 22, 'Huyện Đồng Văn', 215, 1, NULL, NULL),
(215, 22, 'Huyện Hoàng Su Phì', 216, 1, NULL, NULL),
(216, 22, 'Huyện Mèo Vạc', 217, 1, NULL, NULL),
(217, 22, 'Huyện Quản Bạ', 218, 1, NULL, NULL),
(218, 22, 'Huyện Quang Bình', 219, 1, NULL, NULL),
(219, 22, 'Huyện Vị Xuyên', 220, 1, NULL, NULL),
(220, 22, 'Huyện Xín Mần', 221, 1, NULL, NULL),
(221, 22, 'Huyện Yên Minh', 222, 1, NULL, NULL),
(222, 23, 'Thành phố Phủ Lý', 223, 1, NULL, NULL),
(223, 23, 'Huyện Bình Lục', 224, 1, NULL, NULL),
(224, 23, 'Huyện Duy Tiên', 225, 1, NULL, NULL),
(225, 23, 'Huyện Kim Bảng', 226, 1, NULL, NULL),
(226, 23, 'Huyện Lý Nhân', 227, 1, NULL, NULL),
(227, 23, 'Huyện Thanh Liêm', 228, 1, NULL, NULL),
(228, 24, 'Thị xã Sơn Tây', 229, 1, NULL, NULL),
(229, 24, 'Quận Ba Đình', 230, 1, NULL, NULL),
(230, 24, 'Quận Cầu Giấy', 231, 1, NULL, NULL),
(231, 24, 'Quận Đống Đa', 232, 1, NULL, NULL),
(232, 24, 'Quận Hà Đông', 233, 1, NULL, NULL),
(233, 24, 'Quận Hai Bà Trưng', 234, 1, NULL, NULL),
(234, 24, 'Quận Hoàn Kiếm', 235, 1, NULL, NULL),
(235, 24, 'Quận Hoàng Mai', 236, 1, NULL, NULL),
(236, 24, 'Quận Long Biên', 237, 1, NULL, NULL),
(237, 24, 'Quận Tây Hồ', 238, 1, NULL, NULL),
(238, 24, 'Quận Thanh Xuân', 239, 1, NULL, NULL),
(239, 24, 'Huyện Ba Vì', 240, 1, NULL, NULL),
(240, 24, 'Huyện Chương Mỹ', 241, 1, NULL, NULL),
(241, 24, 'Huyện Đan Phượng', 242, 1, NULL, NULL),
(242, 24, 'Huyện Đông Anh', 243, 1, NULL, NULL),
(243, 24, 'Huyện Gia Lâm', 244, 1, NULL, NULL),
(244, 24, 'Huyện Hoài Đức', 245, 1, NULL, NULL),
(245, 24, 'Huyện Mê Linh', 246, 1, NULL, NULL),
(246, 24, 'Huyện Mỹ Đức', 247, 1, NULL, NULL),
(247, 24, 'Huyện Phú Xuyên', 248, 1, NULL, NULL),
(248, 24, 'Huyện Phúc Thọ', 249, 1, NULL, NULL),
(249, 24, 'Huyện Quốc Oai', 250, 1, NULL, NULL),
(250, 24, 'Huyện Sóc Sơn', 251, 1, NULL, NULL),
(251, 24, 'Huyện Thạch Thất', 252, 1, NULL, NULL),
(252, 24, 'Huyện Thanh Oai', 253, 1, NULL, NULL),
(253, 24, 'Huyện Thanh Trì', 254, 1, NULL, NULL),
(254, 24, 'Huyện Thường Tín', 255, 1, NULL, NULL),
(255, 24, 'Huyện Từ Liêm', 256, 1, NULL, NULL),
(256, 24, 'Huyện Ứng Hòa', 257, 1, NULL, NULL),
(257, 25, 'Thành phố Hà Tĩnh', 258, 1, NULL, NULL),
(258, 25, 'Thị xã Hồng Lĩnh', 259, 1, NULL, NULL),
(259, 25, 'Huyện Cẩm Xuyên', 260, 1, NULL, NULL),
(260, 25, 'Huyện Can Lộc', 261, 1, NULL, NULL),
(261, 25, 'Huyện Đức Thọ', 262, 1, NULL, NULL),
(262, 25, 'Huyện Hương Khê', 263, 1, NULL, NULL),
(263, 25, 'Huyện Hương Sơn', 264, 1, NULL, NULL),
(264, 25, 'Huyện Kỳ Anh', 265, 1, NULL, NULL),
(265, 25, 'Huyện Nghi Xuân', 266, 1, NULL, NULL),
(266, 25, 'Huyện Thạch Hà', 267, 1, NULL, NULL),
(267, 25, 'Huyện Vũ Quang', 268, 1, NULL, NULL),
(268, 25, 'Huyện Lộc Hà', 269, 1, NULL, NULL),
(269, 26, 'Thành phố Hải Dương', 270, 1, NULL, NULL),
(270, 26, 'Thị xã Chí Linh', 271, 1, NULL, NULL),
(271, 26, 'Huyện Bình Giang', 272, 1, NULL, NULL),
(272, 26, 'Huyện Cẩm Giàng', 273, 1, NULL, NULL),
(273, 26, 'Huyện Gia Lộc', 274, 1, NULL, NULL),
(274, 26, 'Huyện Kim Thành', 275, 1, NULL, NULL),
(275, 26, 'Huyện Kinh Môn', 276, 1, NULL, NULL),
(276, 26, 'Huyện Nam Sách', 277, 1, NULL, NULL),
(277, 26, 'Huyện Ninh Giang', 278, 1, NULL, NULL),
(278, 26, 'Huyện Thanh Hà', 279, 1, NULL, NULL),
(279, 26, 'Huyện Thanh Miện', 280, 1, NULL, NULL),
(280, 26, 'Huyện Tứ Kỳ', 281, 1, NULL, NULL),
(281, 27, 'Quận Dương Kinh', 282, 1, NULL, NULL),
(282, 27, 'Quận Đồ Sơn', 283, 1, NULL, NULL),
(283, 27, 'Quận Hải An', 284, 1, NULL, NULL),
(284, 27, 'Quận Kiến An', 285, 1, NULL, NULL),
(285, 27, 'Quận Hồng Bàng', 286, 1, NULL, NULL),
(286, 27, 'Quận Ngô Quyền', 287, 1, NULL, NULL),
(287, 27, 'Quận Lê Chân', 288, 1, NULL, NULL),
(288, 27, 'Huyện An Dương', 289, 1, NULL, NULL),
(289, 27, 'Huyện An Lão', 290, 1, NULL, NULL),
(290, 27, 'Huyện đảo Bạch Long Vĩ', 291, 1, NULL, NULL),
(291, 27, 'Huyện đảo Cát Hải', 292, 1, NULL, NULL),
(292, 27, 'Huyện Kiến Thụy', 293, 1, NULL, NULL),
(293, 27, 'Huyện Tiên Lãng', 294, 1, NULL, NULL),
(294, 27, 'Huyện Vĩnh Bảo', 295, 1, NULL, NULL),
(295, 27, 'Huyện Thủy Nguyên', 296, 1, NULL, NULL),
(296, 28, 'Thị xã Vị Thanh', 297, 1, NULL, NULL),
(297, 28, 'Thị xã Ngã Bảy', 298, 1, NULL, NULL),
(298, 28, 'Huyện Châu Thành', 299, 1, NULL, NULL),
(299, 28, 'Huyện Châu Thành A', 300, 1, NULL, NULL),
(300, 28, 'Huyện Long Mỹ', 301, 1, NULL, NULL),
(301, 28, 'Huyện Phụng Hiệp', 302, 1, NULL, NULL),
(302, 28, 'Huyện Vị Thủy', 303, 1, NULL, NULL),
(303, 29, 'Thành phố Hòa Bình', 304, 1, NULL, NULL),
(304, 29, 'Huyện Lương Sơn', 305, 1, NULL, NULL),
(305, 29, 'Huyện Cao Phong', 306, 1, NULL, NULL),
(306, 29, 'Huyện Đà Bắc', 307, 1, NULL, NULL),
(307, 29, 'Huyện Kim Bôi', 308, 1, NULL, NULL),
(308, 29, 'Huyện Kỳ Sơn', 309, 1, NULL, NULL),
(309, 29, 'Huyện Lạc Sơn', 310, 1, NULL, NULL),
(310, 29, 'Huyện Lạc Thủy', 311, 1, NULL, NULL),
(311, 29, 'Huyện Mai Châu', 312, 1, NULL, NULL),
(312, 29, 'Huyện Tân Lạc', 313, 1, NULL, NULL),
(313, 29, 'Huyện Yên Thủy', 314, 1, NULL, NULL),
(314, 30, 'Thành phố Hưng Yên', 315, 1, NULL, NULL),
(315, 30, 'Huyện Ân Thi', 316, 1, NULL, NULL),
(316, 30, 'Huyện Khoái Châu', 317, 1, NULL, NULL),
(317, 30, 'Huyện Kim Động', 318, 1, NULL, NULL),
(318, 30, 'Huyện Mỹ Hào', 319, 1, NULL, NULL),
(319, 30, 'Huyện Phù Cừ', 320, 1, NULL, NULL),
(320, 30, 'Huyện Tiên Lữ', 321, 1, NULL, NULL),
(321, 30, 'Huyện Văn Giang', 322, 1, NULL, NULL),
(322, 30, 'Huyện Văn Lâm', 323, 1, NULL, NULL),
(323, 30, 'Huyện Yên Mỹ', 324, 1, NULL, NULL),
(324, 31, 'Thành phố Nha Trang', 325, 1, NULL, NULL),
(325, 31, 'Thị xã Cam Ranh', 326, 1, NULL, NULL),
(326, 31, 'Huyện Vạn Ninh', 327, 1, NULL, NULL),
(327, 31, 'Huyện Ninh Hòa', 328, 1, NULL, NULL),
(328, 31, 'Huyện Diên Khánh', 329, 1, NULL, NULL),
(329, 31, 'Huyện Khánh Vĩnh', 330, 1, NULL, NULL),
(330, 31, 'Huyện Khánh Sơn', 331, 1, NULL, NULL),
(331, 31, 'Huyện Cam Lâm', 332, 1, NULL, NULL),
(332, 31, 'Huyện đảo Trường Sa', 333, 1, NULL, NULL),
(333, 32, 'Thành phố Rạch Giá', 334, 1, NULL, NULL),
(334, 32, 'Thị xã Hà Tiên', 335, 1, NULL, NULL),
(335, 32, 'Huyện An Biên', 336, 1, NULL, NULL),
(336, 32, 'Huyện An Minh', 337, 1, NULL, NULL),
(337, 32, 'Huyện Châu Thành', 338, 1, NULL, NULL),
(338, 32, 'Huyện Giồng Riềng', 339, 1, NULL, NULL),
(339, 32, 'Huyện Gò Quao', 340, 1, NULL, NULL),
(340, 32, 'Huyện Hòn Đất', 341, 1, NULL, NULL),
(341, 32, 'Huyện Kiên Hải', 342, 1, NULL, NULL),
(342, 32, 'Huyện Kiên Lương', 343, 1, NULL, NULL),
(343, 32, 'Huyện Phú Quốc', 344, 1, NULL, NULL),
(344, 32, 'Huyện Tân Hiệp', 345, 1, NULL, NULL),
(345, 32, 'Huyện Vĩnh Thuận', 346, 1, NULL, NULL),
(346, 32, 'Huyện U Minh Thượng', 347, 1, NULL, NULL),
(347, 32, 'Huyện Giang Thành', 348, 1, NULL, NULL),
(348, 33, 'Thành phố Kon Tum', 349, 1, NULL, NULL),
(349, 33, 'Huyện Đắk Glei', 350, 1, NULL, NULL),
(350, 33, 'Huyện Đắk Hà', 351, 1, NULL, NULL),
(351, 33, 'Huyện Đắk Tô', 352, 1, NULL, NULL),
(352, 33, 'Huyện Kon Plông', 353, 1, NULL, NULL),
(353, 33, 'Huyện Kon Rẫy', 354, 1, NULL, NULL),
(354, 33, 'Huyện Ngọc Hồi', 355, 1, NULL, NULL),
(355, 33, 'Huyện Sa Thầy', 356, 1, NULL, NULL),
(356, 33, 'Huyện Tu Mơ Rông', 357, 1, NULL, NULL),
(357, 34, 'Thị xã Lai Châu', 358, 1, NULL, NULL),
(358, 34, 'Huyện Mường Tè', 359, 1, NULL, NULL),
(359, 34, 'Huyện Phong Thổ', 360, 1, NULL, NULL),
(360, 34, 'Huyện Sìn Hồ', 361, 1, NULL, NULL),
(361, 34, 'Huyện Tam Đường', 362, 1, NULL, NULL),
(362, 34, 'Huyện Than Uyên', 363, 1, NULL, NULL),
(363, 34, 'Huyện Tân Uyên', 364, 1, NULL, NULL),
(364, 36, 'Thành phố Lạng Sơn', 365, 1, NULL, NULL),
(365, 36, 'Huyện Tràng Định', 366, 1, NULL, NULL),
(366, 36, 'Huyện Văn Lãng', 367, 1, NULL, NULL),
(367, 36, 'Huyện Văn Quan', 368, 1, NULL, NULL),
(368, 36, 'Huyện Bình Gia', 369, 1, NULL, NULL),
(369, 36, 'Huyện Bắc Sơn', 370, 1, NULL, NULL),
(370, 36, 'Huyện Hữu Lũng', 371, 1, NULL, NULL),
(371, 36, 'Huyện Chi Lăng', 372, 1, NULL, NULL),
(372, 36, 'Huyện Cao Lộc', 373, 1, NULL, NULL),
(373, 36, 'Huyện Lộc Bình', 374, 1, NULL, NULL),
(374, 36, 'Huyện Đình Lập', 375, 1, NULL, NULL),
(375, 37, 'Thành phố Lào Cai', 376, 1, NULL, NULL),
(376, 37, 'Huyện Bảo Thắng', 377, 1, NULL, NULL),
(377, 37, 'Huyện Bảo Yên', 378, 1, NULL, NULL),
(378, 37, 'Huyện Bát Xát', 379, 1, NULL, NULL),
(379, 37, 'Huyện Bắc Hà', 380, 1, NULL, NULL),
(380, 37, 'Huyện Mường Khương', 381, 1, NULL, NULL),
(381, 37, 'Huyện Sa Pa', 382, 1, NULL, NULL),
(382, 37, 'Huyện Si Ma Cai', 383, 1, NULL, NULL),
(383, 37, 'Huyện Văn Bàn', 384, 1, NULL, NULL),
(384, 35, 'Thành phố Đà Lạt', 385, 1, NULL, NULL),
(385, 35, 'Thành phố Bảo Lộc', 386, 1, NULL, NULL),
(386, 35, 'Huyện Bảo Lâm', 387, 1, NULL, NULL),
(387, 35, 'Huyện Cát Tiên', 388, 1, NULL, NULL),
(388, 35, 'Huyện Di Linh', 389, 1, NULL, NULL),
(389, 35, 'Huyện Đam Rông', 390, 1, NULL, NULL),
(390, 35, 'Huyện Đạ Huoai', 391, 1, NULL, NULL),
(391, 35, 'Huyện Đạ Tẻh', 392, 1, NULL, NULL),
(392, 35, 'Huyện Đơn Dương', 393, 1, NULL, NULL),
(393, 35, 'Huyện Lạc Dương', 394, 1, NULL, NULL),
(394, 35, 'Huyện Lâm Hà', 395, 1, NULL, NULL),
(395, 35, 'Huyện Đức Trọng', 396, 1, NULL, NULL),
(396, 38, 'Thành phố Tân An', 397, 1, NULL, NULL),
(397, 38, 'Huyện Bến Lức', 398, 1, NULL, NULL),
(398, 38, 'Huyện Cần Đước', 399, 1, NULL, NULL),
(399, 38, 'Huyện Cần Giuộc', 400, 1, NULL, NULL),
(400, 38, 'Huyện Châu Thành', 401, 1, NULL, NULL),
(401, 38, 'Huyện Đức Hòa', 402, 1, NULL, NULL),
(402, 38, 'Huyện Đức Huệ', 403, 1, NULL, NULL),
(403, 38, 'Huyện Mộc Hóa', 404, 1, NULL, NULL),
(404, 38, 'Huyện Tân Hưng', 405, 1, NULL, NULL),
(405, 38, 'Huyện Tân Thạnh', 406, 1, NULL, NULL),
(406, 38, 'Huyện Tân Trụ', 407, 1, NULL, NULL),
(407, 38, 'Huyện Thạnh Hóa', 408, 1, NULL, NULL),
(408, 38, 'Huyện Thủ Thừa', 409, 1, NULL, NULL),
(409, 38, 'Huyện Vĩnh Hưng', 410, 1, NULL, NULL),
(410, 39, 'Thành phố Nam Định', 411, 1, NULL, NULL),
(411, 39, 'Huyện Giao Thủy', 412, 1, NULL, NULL),
(412, 39, 'Huyện Hải Hậu', 413, 1, NULL, NULL),
(413, 39, 'Huyện Mỹ Lộc', 414, 1, NULL, NULL),
(414, 39, 'Huyện Nam Trực', 415, 1, NULL, NULL),
(415, 39, 'Huyện Nghĩa Hưng', 416, 1, NULL, NULL),
(416, 39, 'Huyện Trực Ninh', 417, 1, NULL, NULL),
(417, 39, 'Huyện Vụ Bản', 418, 1, NULL, NULL),
(418, 39, 'Huyện Xuân Trường', 419, 1, NULL, NULL),
(419, 39, 'Huyện Ý Yên', 420, 1, NULL, NULL),
(420, 40, 'Thành phố Vinh', 421, 1, NULL, NULL),
(421, 40, 'Thị xã Cửa Lò', 422, 1, NULL, NULL),
(422, 40, 'Thị xã Thái Hòa', 423, 1, NULL, NULL),
(423, 40, 'Huyện Anh Sơn', 424, 1, NULL, NULL),
(424, 40, 'Huyện Con Cuông', 425, 1, NULL, NULL),
(425, 40, 'Huyện Diễn Châu', 426, 1, NULL, NULL),
(426, 40, 'Huyện Đô Lương', 427, 1, NULL, NULL),
(427, 40, 'Huyện Hưng Nguyên', 428, 1, NULL, NULL),
(428, 40, 'Huyện Quỳ Châu', 429, 1, NULL, NULL),
(429, 40, 'Huyện Kỳ Sơn', 430, 1, NULL, NULL),
(430, 41, 'Thành phố Ninh Bình', 431, 1, NULL, NULL),
(431, 41, 'Thị xã Tam Điệp', 432, 1, NULL, NULL),
(432, 41, 'Huyện Gia Viễn', 433, 1, NULL, NULL),
(433, 41, 'Huyện Hoa Lư', 434, 1, NULL, NULL),
(434, 41, 'Huyện Kim Sơn', 435, 1, NULL, NULL),
(435, 41, 'Huyện Nho Quan', 436, 1, NULL, NULL),
(436, 41, 'Huyện Yên Khánh', 437, 1, NULL, NULL),
(437, 41, 'Huyện Yên Mô', 438, 1, NULL, NULL),
(438, 42, 'Thành phố Phan Rang-Tháp Chàm', 439, 1, NULL, NULL),
(439, 42, 'Huyện Bác Ái', 440, 1, NULL, NULL),
(440, 42, 'Huyện Ninh Hải', 441, 1, NULL, NULL),
(441, 42, 'Huyện Ninh Phước', 442, 1, NULL, NULL),
(442, 42, 'Huyện Ninh Sơn', 443, 1, NULL, NULL),
(443, 42, 'Huyện Thuận Bắc', 444, 1, NULL, NULL),
(444, 42, 'Huyện Thuận Nam', 445, 1, NULL, NULL),
(445, 43, 'Thành phố Việt Trì', 446, 1, NULL, NULL),
(446, 43, 'Thị xã Phú Thọ', 447, 1, NULL, NULL),
(447, 43, 'Huyện Cẩm Khê', 448, 1, NULL, NULL),
(448, 43, 'Huyện Đoan Hùng', 449, 1, NULL, NULL),
(449, 43, 'Huyện Hạ Hòa', 450, 1, NULL, NULL),
(450, 43, 'Huyện Lâm Thao', 451, 1, NULL, NULL),
(451, 43, 'Huyện Phù Ninh', 452, 1, NULL, NULL),
(452, 43, 'Huyện Tam Nông', 453, 1, NULL, NULL),
(453, 43, 'Huyện Tân Sơn', 454, 1, NULL, NULL),
(454, 43, 'Huyện Thanh Ba', 455, 1, NULL, NULL),
(455, 43, 'Huyện Thanh Sơn', 456, 1, NULL, NULL),
(456, 43, 'Huyện Thanh Thủy', 457, 1, NULL, NULL),
(457, 43, 'Huyện Yên Lập', 458, 1, NULL, NULL),
(458, 44, 'Thành phố Tuy Hòa', 459, 1, NULL, NULL),
(459, 44, 'Thị xã Sông Cầu', 460, 1, NULL, NULL),
(460, 44, 'Huyện Đông Hòa', 461, 1, NULL, NULL),
(461, 44, 'Huyện Đồng Xuân', 462, 1, NULL, NULL),
(462, 44, 'Huyện Phú Hòa', 463, 1, NULL, NULL),
(463, 44, 'Huyện Sơn Hòa', 464, 1, NULL, NULL),
(464, 44, 'Huyện Sông Hinh', 465, 1, NULL, NULL),
(465, 44, 'Huyện Tây Hòa', 466, 1, NULL, NULL),
(466, 44, 'Huyện Tuy An', 467, 1, NULL, NULL),
(467, 45, 'Huyện Bố Trạch', 468, 1, NULL, NULL),
(468, 45, 'Huyện Lệ Thủy', 469, 1, NULL, NULL),
(469, 45, 'Huyện Minh Hóa', 470, 1, NULL, NULL),
(470, 45, 'Huyện Quảng Trạch', 471, 1, NULL, NULL),
(471, 45, 'Huyện Quảng Ninh', 472, 1, NULL, NULL),
(472, 45, 'Huyện Tuyên Hóa', 473, 1, NULL, NULL),
(473, 46, 'Thành phố Tam Kỳ', 474, 1, NULL, NULL),
(474, 46, 'Thành phố Hội An', 475, 1, NULL, NULL),
(475, 46, 'Huyện Điện Bàn', 476, 1, NULL, NULL),
(476, 46, 'Huyện Bắc Trà My', 477, 1, NULL, NULL),
(477, 46, 'Huyện Thăng Bình', 478, 1, NULL, NULL),
(478, 46, 'Huyện Nam Trà My', 479, 1, NULL, NULL),
(479, 46, 'Huyện Núi Thành', 480, 1, NULL, NULL),
(480, 46, 'Huyện Phước Sơn', 481, 1, NULL, NULL),
(481, 46, 'Huyện Tiên Phước', 482, 1, NULL, NULL),
(482, 46, 'Huyện Hiệp Đức', 483, 1, NULL, NULL),
(483, 46, 'Huyện Nông Sơn', 484, 1, NULL, NULL),
(484, 46, 'Huyện Đông Giang', 485, 1, NULL, NULL),
(485, 46, 'Huyện Nam Giang', 486, 1, NULL, NULL),
(486, 46, 'Huyện Đại Lộc', 487, 1, NULL, NULL),
(487, 46, 'Huyện Phú Ninh', 488, 1, NULL, NULL),
(488, 46, 'Huyện Tây Giang', 489, 1, NULL, NULL),
(489, 46, 'Huyện Duy Xuyên', 490, 1, NULL, NULL),
(490, 46, 'Huyện Quế Sơn', 491, 1, NULL, NULL),
(491, 47, 'Thành phố Quảng Ngãi', 492, 1, NULL, NULL),
(492, 47, 'Huyện Ba Tơ', 493, 1, NULL, NULL),
(493, 47, 'Huyện Bình Sơn', 494, 1, NULL, NULL),
(494, 47, 'Huyện Đức Phổ', 495, 1, NULL, NULL),
(495, 47, 'Huyện Minh Long', 496, 1, NULL, NULL),
(496, 47, 'Huyện Mộ Đức', 497, 1, NULL, NULL),
(497, 47, 'Huyện Nghĩa Hành', 498, 1, NULL, NULL),
(498, 47, 'Huyện Sơn Hà', 499, 1, NULL, NULL),
(499, 47, 'Huyện Sơn Tây', 500, 1, NULL, NULL),
(500, 47, 'Huyện Sơn Tịnh', 501, 1, NULL, NULL),
(501, 47, 'Huyện Tây Trà', 502, 1, NULL, NULL),
(502, 47, 'Huyện Trà Bồng', 503, 1, NULL, NULL),
(503, 47, 'Huyện Tư Nghĩa', 504, 1, NULL, NULL),
(504, 47, 'Huyện đảo Lý Sơn', 505, 1, NULL, NULL),
(505, 48, 'Thành phố Hạ Long', 506, 1, NULL, NULL),
(506, 48, 'Thành phố Móng Cái', 507, 1, NULL, NULL),
(507, 48, 'Thị xã Cẩm Phả', 508, 1, NULL, NULL),
(508, 48, 'Thị xã Uông Bí', 509, 1, NULL, NULL),
(509, 48, 'Huyện Ba Chẽ', 510, 1, NULL, NULL),
(510, 48, 'Huyện Bình Liêu', 511, 1, NULL, NULL),
(511, 48, 'Huyện Cô Tô', 512, 1, NULL, NULL),
(512, 48, 'Huyện Đầm Hà', 513, 1, NULL, NULL),
(513, 48, 'Huyện Đông Triều', 514, 1, NULL, NULL),
(514, 48, 'Huyện Hải Hà', 515, 1, NULL, NULL),
(515, 48, 'Huyện Hoành Bồ', 516, 1, NULL, NULL),
(516, 48, 'Huyện Tiên Yên', 517, 1, NULL, NULL),
(517, 48, 'Huyện Vân Đồn', 518, 1, NULL, NULL),
(518, 48, 'Huyện Yên Hưng', 519, 1, NULL, NULL),
(519, 49, 'Thành phố Đông Hà', 520, 1, NULL, NULL),
(520, 49, 'Thị xã Quảng Trị', 521, 1, NULL, NULL),
(521, 49, 'Huyện Cam Lộ', 522, 1, NULL, NULL),
(522, 49, 'Huyện Đảo Cồn Cỏ', 523, 1, NULL, NULL),
(523, 49, 'Huyện Đa Krông', 524, 1, NULL, NULL),
(524, 49, 'Huyện Gio Linh', 525, 1, NULL, NULL),
(525, 49, 'Huyện Hải Lăng', 526, 1, NULL, NULL),
(526, 49, 'Huyện Hướng Hóa', 527, 1, NULL, NULL),
(527, 49, 'Huyện Triệu Phong', 528, 1, NULL, NULL),
(528, 49, 'Huyện Vĩnh Linh', 529, 1, NULL, NULL),
(529, 50, 'Thành phố Sóc Trăng', 530, 1, NULL, NULL),
(530, 50, 'Huyện Cù Lao Dung', 531, 1, NULL, NULL),
(531, 50, 'Huyện Kế Sách', 532, 1, NULL, NULL),
(532, 50, 'Huyện Long Phú', 533, 1, NULL, NULL),
(533, 50, 'Huyện Mỹ Tú', 534, 1, NULL, NULL),
(534, 50, 'Huyện Mỹ Xuyên', 535, 1, NULL, NULL),
(535, 50, 'Huyện Ngã Năm', 536, 1, NULL, NULL),
(536, 50, 'Huyện Thạnh Trị', 537, 1, NULL, NULL),
(537, 50, 'Huyện Vĩnh Châu', 538, 1, NULL, NULL),
(538, 50, 'Huyện Châu Thành', 539, 1, NULL, NULL),
(539, 50, 'Huyện Trần Đề', 540, 1, NULL, NULL),
(540, 51, 'Thành phố Sơn La', 541, 1, NULL, NULL),
(541, 51, 'Huyện Quỳnh Nhai', 542, 1, NULL, NULL),
(542, 51, 'Huyện Mường La', 543, 1, NULL, NULL),
(543, 51, 'Huyện Thuận Châu', 544, 1, NULL, NULL),
(544, 51, 'Huyện Phù Yên', 545, 1, NULL, NULL),
(545, 51, 'Huyện Bắc Yên', 546, 1, NULL, NULL),
(546, 51, 'Huyện Mai Sơn', 547, 1, NULL, NULL),
(547, 51, 'Huyện Sông Mã', 548, 1, NULL, NULL),
(548, 51, 'Huyện Yên Châu', 549, 1, NULL, NULL),
(549, 51, 'Huyện Mộc Châu', 550, 1, NULL, NULL),
(550, 51, 'Huyện Sốp Cộp', 551, 1, NULL, NULL),
(551, 52, 'Thị xã Tây Ninh', 552, 1, NULL, NULL),
(552, 52, 'Huyện Tân Biên', 553, 1, NULL, NULL),
(553, 52, 'Huyện Tân Châu', 554, 1, NULL, NULL),
(554, 52, 'Huyện Dương Minh Châu', 555, 1, NULL, NULL),
(555, 52, 'Huyện Châu Thành', 556, 1, NULL, NULL),
(556, 52, 'Huyện Hòa Thành', 557, 1, NULL, NULL),
(557, 52, 'Huyện Bến Cầu', 558, 1, NULL, NULL),
(558, 52, 'Huyện Gò Dầu', 559, 1, NULL, NULL),
(559, 52, 'Huyện Trảng Bàng', 560, 1, NULL, NULL),
(560, 53, 'Thành phố Thái Bình', 561, 1, NULL, NULL),
(561, 53, 'Huyện Đông Hưng', 562, 1, NULL, NULL),
(562, 53, 'Huyện Hưng Hà', 563, 1, NULL, NULL),
(563, 53, 'Huyện Kiến Xương', 564, 1, NULL, NULL),
(564, 53, 'Huyện Quỳnh Phụ', 565, 1, NULL, NULL),
(565, 53, 'Huyện Thái Thụy', 566, 1, NULL, NULL),
(566, 53, 'Huyện Tiền Hải', 567, 1, NULL, NULL),
(567, 53, 'Huyện Vũ Thư', 568, 1, NULL, NULL),
(568, 54, 'Thành phố Thái Nguyên', 569, 1, NULL, NULL),
(569, 54, 'Thị xã Sông Công', 570, 1, NULL, NULL),
(570, 54, 'Huyện Phổ Yên', 571, 1, NULL, NULL),
(571, 54, 'Huyện Phú Bình', 572, 1, NULL, NULL),
(572, 54, 'Huyện Đồng Hỷ', 573, 1, NULL, NULL),
(573, 54, 'Huyện Võ Nhai', 574, 1, NULL, NULL),
(574, 54, 'Huyện Định Hóa', 575, 1, NULL, NULL),
(575, 54, 'Huyện Đại Từ', 576, 1, NULL, NULL),
(576, 54, 'Huyện Phú Lương', 577, 1, NULL, NULL),
(577, 55, 'Thành phố Thanh Hóa', 578, 1, NULL, NULL),
(578, 55, 'Thị xã Bỉm Sơn', 579, 1, NULL, NULL),
(579, 55, 'Thị xã Sầm Sơn', 580, 1, NULL, NULL),
(580, 55, 'Huyện Bá Thước', 581, 1, NULL, NULL),
(581, 55, 'Huyện Cẩm Thủy', 582, 1, NULL, NULL),
(582, 55, 'Huyện Đông Sơn', 583, 1, NULL, NULL),
(583, 55, 'Huyện Hà Trung', 584, 1, NULL, NULL),
(584, 55, 'Huyện Hậu Lộc', 585, 1, NULL, NULL),
(585, 55, 'Huyện Hoằng Hóa', 586, 1, NULL, NULL),
(586, 55, 'Huyện Lang Chánh', 587, 1, NULL, NULL),
(587, 55, 'Huyện Mường Lát', 588, 1, NULL, NULL),
(588, 55, 'Huyện Nga Sơn', 589, 1, NULL, NULL),
(589, 55, 'Huyện Ngọc Lặc', 590, 1, NULL, NULL),
(590, 55, 'Huyện Như Thanh', 591, 1, NULL, NULL),
(591, 55, 'Huyện Như Xuân', 592, 1, NULL, NULL),
(592, 55, 'Huyện Nông Cống', 593, 1, NULL, NULL),
(593, 55, 'Huyện Quan Hóa', 594, 1, NULL, NULL),
(594, 55, 'Huyện Quan Sơn', 595, 1, NULL, NULL),
(595, 55, 'Huyện Quảng Xương', 596, 1, NULL, NULL),
(596, 55, 'Huyện Thạch Thành', 597, 1, NULL, NULL),
(597, 55, 'Huyện Thiệu Hóa', 598, 1, NULL, NULL),
(598, 55, 'Huyện Thọ Xuân', 599, 1, NULL, NULL),
(599, 55, 'Huyện Thường Xuân', 600, 1, NULL, NULL),
(600, 55, 'Huyện Tĩnh Gia', 601, 1, NULL, NULL),
(601, 55, 'Huyện Triệu Sơn', 602, 1, NULL, NULL),
(602, 55, 'Huyện Vĩnh Lộc', 603, 1, NULL, NULL),
(603, 55, 'Huyện Yên Định', 604, 1, NULL, NULL),
(604, 56, 'Thành phố Huế', 605, 1, NULL, NULL),
(605, 56, 'Thị xã Hương Thủy', 606, 1, NULL, NULL),
(606, 56, 'Huyện A Lưới', 607, 1, NULL, NULL),
(607, 56, 'Huyện Hương Trà', 608, 1, NULL, NULL),
(608, 56, 'Huyện Nam Đông', 609, 1, NULL, NULL),
(609, 56, 'Huyện Phong Điền', 610, 1, NULL, NULL),
(610, 56, 'Huyện Phú Lộc', 611, 1, NULL, NULL),
(611, 56, 'Huyện Phú Vang', 612, 1, NULL, NULL),
(612, 56, 'Huyện Quảng Điền', 613, 1, NULL, NULL),
(613, 57, 'Thành phố Mỹ Tho', 614, 1, NULL, NULL),
(614, 57, 'Thị xã Gò Công', 615, 1, NULL, NULL),
(615, 57, 'Huyện Gò Công Đông', 616, 1, NULL, NULL),
(616, 57, 'Huyện Gò Công Tây', 617, 1, NULL, NULL),
(617, 57, 'Huyện Chợ Gạo', 618, 1, NULL, NULL),
(618, 57, 'Huyện Châu Thành', 619, 1, NULL, NULL),
(619, 57, 'Huyện Tân Phước', 620, 1, NULL, NULL),
(620, 57, 'Huyện Cai Lậy', 621, 1, NULL, NULL),
(621, 57, 'Huyện Cái Bè', 622, 1, NULL, NULL),
(622, 57, 'Huyện Tân Phú Đông', 623, 1, NULL, NULL),
(623, 58, 'Quận 1', 624, 1, NULL, NULL),
(624, 58, 'Quận 2', 625, 1, NULL, NULL),
(625, 58, 'Quận 3', 626, 1, NULL, NULL),
(626, 58, 'Quận 4', 627, 1, NULL, NULL),
(627, 58, 'Quận 5', 628, 1, NULL, NULL),
(628, 58, 'Quận 6', 629, 1, NULL, NULL),
(629, 58, 'Quận 7', 630, 1, NULL, NULL),
(630, 58, 'Quận 8', 631, 1, NULL, NULL),
(631, 58, 'Quận 9', 632, 1, NULL, NULL),
(632, 58, 'Quận 10', 633, 1, NULL, NULL),
(633, 58, 'Quận 11', 634, 1, NULL, NULL),
(634, 58, 'Quận 12', 635, 1, NULL, NULL),
(635, 58, 'Quận Gò Vấp', 636, 1, NULL, NULL),
(636, 58, 'Quận Tân Bình', 637, 1, NULL, NULL),
(637, 58, 'Quận Tân Phú', 638, 1, NULL, NULL),
(638, 58, 'Quận Bình Thạnh', 639, 1, NULL, NULL),
(639, 58, 'Quận Phú Nhuận', 640, 1, NULL, NULL),
(640, 58, 'Quận Thủ Đức', 641, 1, NULL, NULL),
(641, 58, 'Quận Bình Tân', 642, 1, NULL, NULL),
(642, 58, 'Huyện Củ Chi', 643, 1, NULL, NULL),
(643, 58, 'Huyện Hóc Môn', 644, 1, NULL, NULL),
(644, 58, 'Huyện Bình Chánh', 645, 1, NULL, NULL),
(645, 58, 'Huyện Nhà Bè', 646, 1, NULL, NULL),
(646, 58, 'Huyện Cần Giờ', 647, 1, NULL, NULL),
(647, 59, 'Thành phố Trà Vinh', 648, 1, NULL, NULL),
(648, 59, 'Huyện Càng Long', 649, 1, NULL, NULL),
(649, 59, 'Huyện Châu Thành', 650, 1, NULL, NULL),
(650, 59, 'Huyện Cầu Kè', 651, 1, NULL, NULL),
(651, 59, 'Huyện Tiểu Cần', 652, 1, NULL, NULL),
(652, 59, 'Huyện Cầu Ngang', 653, 1, NULL, NULL),
(653, 59, 'Huyện Trà Cú', 654, 1, NULL, NULL),
(654, 59, 'Huyện Duyên Hải', 655, 1, NULL, NULL),
(655, 60, 'Thị xã Tuyên Quang', 656, 1, NULL, NULL),
(656, 60, 'Huyện Chiêm Hóa', 657, 1, NULL, NULL),
(657, 60, 'Huyện Hàm Yên', 658, 1, NULL, NULL),
(658, 60, 'Huyện Na Hang', 659, 1, NULL, NULL),
(659, 60, 'Huyện Sơn Dương', 660, 1, NULL, NULL),
(660, 60, 'Huyện Yên Sơn', 661, 1, NULL, NULL),
(661, 61, 'Thành phố Vĩnh Long', 662, 1, NULL, NULL),
(662, 61, 'Huyện Bình Minh', 663, 1, NULL, NULL),
(663, 61, 'Huyện Bình Tân', 664, 1, NULL, NULL),
(664, 61, 'Huyện Long Hồ', 665, 1, NULL, NULL),
(665, 61, 'Huyện Mang Thít', 666, 1, NULL, NULL),
(666, 61, 'Huyện Tam Bình', 667, 1, NULL, NULL),
(667, 61, 'Huyện Trà Ôn', 668, 1, NULL, NULL),
(668, 61, 'Huyện Vũng Liêm', 669, 1, NULL, NULL),
(669, 62, 'Thành phố Vĩnh Yên', 670, 1, NULL, NULL),
(670, 62, 'Thị xã Phúc Yên', 671, 1, NULL, NULL),
(671, 62, 'Huyện Bình Xuyên', 672, 1, NULL, NULL),
(672, 62, 'Huyện Lập Thạch', 673, 1, NULL, NULL),
(673, 62, 'Huyện Sông Lô', 674, 1, NULL, NULL),
(674, 62, 'Huyện Tam Dương', 675, 1, NULL, NULL),
(675, 62, 'Huyện Tam Đảo', 676, 1, NULL, NULL),
(676, 62, 'Huyện Vĩnh Tường', 677, 1, NULL, NULL),
(677, 62, 'Huyện Yên Lạc', 678, 1, NULL, NULL),
(678, 63, 'Thành phố Yên Bái', 679, 1, NULL, NULL),
(679, 63, 'Thị xã Nghĩa Lộ', 680, 1, NULL, NULL),
(680, 63, 'Huyện Lục Yên', 681, 1, NULL, NULL),
(681, 63, 'Huyện Mù Cang Chải', 682, 1, NULL, NULL),
(682, 63, 'Huyện Trấn Yên', 683, 1, NULL, NULL),
(683, 63, 'Huyện Trạm Tấu', 684, 1, NULL, NULL),
(684, 63, 'Huyện Văn Chấn', 685, 1, NULL, NULL),
(685, 63, 'Huyện Văn Yên', 686, 1, NULL, NULL),
(686, 63, 'Huyện Yên Bình', 687, 1, NULL, NULL),
(687, 45, 'TP Đồng Hới', 474, 1, NULL, NULL),
(692, 8, 'Huyện Phù Cát', 69, 1, NULL, NULL),
(693, 8, 'Huyện An Nhơn', 70, 1, NULL, NULL),
(694, 8, 'Huyện Tuy Phước', 71, 1, NULL, NULL),
(695, 8, 'Huyện Vân Canh', 72, 1, NULL, NULL),
(696, 40, 'Huyện Nam Đàn', 431, 1, NULL, NULL),
(697, 40, 'Huyện Nghi Lộc', 432, 1, NULL, NULL),
(698, 40, 'Huyện Nghĩa Đàn', 433, 1, NULL, NULL),
(699, 40, 'Huyện Quế Phong', 434, 1, NULL, NULL),
(700, 40, 'Huyện Quỳ Hợp', 435, 1, NULL, NULL),
(701, 40, 'Huyện Quỳnh Lưu', 436, 1, NULL, NULL),
(702, 40, 'Huyện Tân Kỳ', 437, 1, NULL, NULL),
(703, 40, 'Huyện Thanh Chương', 438, 1, NULL, NULL),
(704, 40, 'Huyện Tương Dương', 439, 1, NULL, NULL),
(705, 40, 'Huyện Yên Thành', 440, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `frames`
--

CREATE TABLE `frames` (
  `id` int(10) UNSIGNED NOT NULL,
  `page_id` int(11) NOT NULL,
  `site_id` int(11) NOT NULL,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `height` int(11) NOT NULL,
  `original_url` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `loaderfunction` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sandbox` tinyint(1) NOT NULL,
  `revision` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `frames`
--

INSERT INTO `frames` (`id`, `page_id`, `site_id`, `content`, `height`, `original_url`, `loaderfunction`, `sandbox`, `revision`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '<html><head>\n	<!-- Basic Page Needs\n  	================================================== -->\n	<meta charset="utf-8">\n	<title>FLATPACK</title>\n	<meta name="description" content="">\n	<meta name="author" content="">\n	<!-- Mobile Specific Metas\n  	================================================== -->\n	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">\n	<!-- CSS\n	================================================== -->\n	<link rel="stylesheet" href="stylesheets/menu.css">\n    <link rel="stylesheet" href="stylesheets/flat-ui-slider.css">\n    <link rel="stylesheet" href="stylesheets/base.css">\n    <link rel="stylesheet" href="stylesheets/skeleton.css">\n    <link rel="stylesheet" href="stylesheets/landings.css">\n    <link rel="stylesheet" href="stylesheets/main.css">\n    <link rel="stylesheet" href="stylesheets/landings_layouts.css">\n    <link rel="stylesheet" href="stylesheets/box.css">\n    <link rel="stylesheet" href="stylesheets/pixicon.css">\n	<!--[if lt IE 9]>\n		<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>\n	<![endif]-->\n	<!-- Favicons\n	================================================== -->\n	<link rel="shortcut icon" href="images/favicon.ico">\n	<link rel="apple-touch-icon" href="images/apple-touch-icon.png">\n	<link rel="apple-touch-icon" sizes="72x72" href="images/apple-touch-icon-72x72.png">\n	<link rel="apple-touch-icon" sizes="114x114" href="images/apple-touch-icon-114x114.png">\n</head><body>\n\n<div id="page">\n	<div class="pixfort_agency_14 " id="section_agency_1">\n		<div class="page_style pix_builder_bg">\n			<div class="container">\n				<div class="sixteen columns">\n		            <div class="text_page">\n		                    <h1 class="title" data-selector="h1, h2, h3, h4, h5, p" style="outline: none; cursor: inherit;"><span class="editContent">FLATPACK NEW AGENCY</span></h1>\n		                    <div class="green_segment pix_builder_bg"></div>\n		                    <p class="subtitle editContent" data-selector="h1, h2, h3, h4, h5, p" style=""><span class="">Lorem ipsum dolor amet consectur adipiscing elit sed do eiusmod tempor incididunt\n		                     <br><br>\n		                     just announced three product updates on our new Releases blog channel</span></p>\n		            </div>\n		            <div class="first_link">\n		                <span class="get_1_btn"><a class="slow_fade pix_text" href="#"><span class="editContent">GET A FREE QUOTE</span></a></span>\n		            </div>\n		        </div>\n			</div>\n		</div>\n	</div>\n</div>\n\n<script src="js/jquery-1.8.3.min.js" type="text/javascript"></script>\n<script src="js-files/jquery.easing.1.3.js" type="text/javascript"></script>\n<script src="js-files/jquery.common.min.js" type="text/javascript"></script>\n<script src="js-files/jquery.ui.touch-punch.min.js"></script>\n<script src="js-files/ticker.js" type="text/javascript"></script>\n<script src="js-files/bootstrap.min.js"></script>\n<script src="js-files/bootstrap-switch.js"></script>\n<script src="assets/js/appear.min.js" type="text/javascript"></script>\n<script src="js-files/custom.js" type="text/javascript"></script>\n<script src="js-files/custom3.js" type="text/javascript"></script>\n\n</body>', 945, NULL, '', 0, 1, '2017-03-30 07:48:21', '2017-03-30 07:50:22'),
(2, 1, 1, '<html><head>\n	<!-- Basic Page Needs\n	================================================== -->\n	<meta charset="utf-8">\n	<title>FLATPACK</title>\n	<meta name="description" content="">\n	<meta name="author" content="">\n	<!-- Mobile Specific Metas\n	================================================== -->\n	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">\n	<!-- CSS\n	================================================== -->\n	<link rel="stylesheet" href="stylesheets/base.css">\n	<link rel="stylesheet" href="stylesheets/skeleton.css">\n	<link rel="stylesheet" href="stylesheets/landings.css">\n	<link rel="stylesheet" href="stylesheets/landings_layouts.css">\n	<link rel="stylesheet" href="stylesheets/box.css">\n	<link rel="stylesheet" href="stylesheets/main.css">\n    <link rel="stylesheet" href="stylesheets/pixicon.css">\n	<!--[if lt IE 9]>\n		<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>\n		<![endif]-->\n	<!-- Favicons\n	================================================== -->\n	<link rel="shortcut icon" href="images/favicon.ico">\n	<link rel="apple-touch-icon" href="images/apple-touch-icon.png">\n	<link rel="apple-touch-icon" sizes="72x72" href="images/apple-touch-icon-72x72.png">\n	<link rel="apple-touch-icon" sizes="114x114" href="images/apple-touch-icon-114x114.png">\n</head><body>\n\n	<div id="page">\n		<div class="extra_padding pix_builder_bg dark paypal_1" id="section_normal_4_1">\n            <div class="container">\n                <div class="sixteen columns">\n                    <div class="ten columns alpha padding_top_60">\n						<p class="big_title editContent "><strong>GET YOUR EVENT TICKETS TODAY!</strong></p>\n                        <p class="normal_text normal_gray editContent">\n                            Eventbrite is the world\'s largest self-service ticketing platform. We build the technology to allow anyone to create, share, find and attend new things to do that fuel their passions and enrich their lives.\n                        </p>\n                        <span class="editContent"><span class="pix_text">*Note: Bundle ends in two weeks from now.</span></span>\n					</div>\n\n					<div class="six columns omega">\n						<div class="">\n							<div class="substyle pix_builder_bg">\n								<form action="https://www.paypal.com/cgi-bin/webscr" method="POST" target="_top" id="contact_form" class="pix_paypal pix_form">\n		                            <input type="text" name="first_name" placeholder="First Name" required="" class="pix_text">\n		                            <input type="text" name="last_name" placeholder="last name" required="" aria-required="true" class="pix_text">\n		                            <input type="email" name="email" placeholder="Email Address" required="" aria-required="true" class="pix_text">\n\n		                            <select name="os0" required="" aria-required="true">\n		                                <option value="">Choose a Plan</option>\n		                                <option value="Normal">Normal $9.99 USD</option>\n		                                <option value="Premium">Premium $14.99 USD</option>\n		                                <option value="Pro">Pro $24.99 USD</option>\n		                            </select>\n\n		                            <select name="quantity" required="" aria-required="true">\n		                                <option value="">Choose Quantity</option>\n		                                <option value="1">1 Ticket</option>\n		                                <option value="2">2 Ticket</option>\n		                                <option value="3">3 Ticket</option>\n		                            </select>\n\n		                            <div class="left_text">\n		                                <label class="left_text">\n		                                    <input type="checkbox" name="terms" value="accept" required="" title="You should accept the terms of use.">\n		                                    <span class="checkbox_span">Accept Terms of Use.</span> <br>\n		                                </label>\n		                            </div>\n\n\n		                            <input type="hidden" name="business" value="pixfort.com@gmail.com">\n		                            <input type="hidden" name="cmd" value="_xclick">\n		                            <input type="hidden" name="lc" value="US">\n		                            <input type="hidden" name="item_name" value="FLATPACK">\n		                            <input type="hidden" name="no_note" value="1">\n		                            <input type="hidden" name="button_subtype" value="services">\n		                            <input type="hidden" name="currency_code" value="USD">\n		                            <input type="hidden" name="on0" value="ticket">\n		                            <input type="hidden" name="bn" value="FLATPACKEvent_BuyNow_WPS_FR">\n		                            <input type="hidden" name="option_select0" value="Normal">\n		                            <input type="hidden" name="option_amount0" value="9.99">\n		                            <input type="hidden" name="option_select1" value="Premium">\n		                            <input type="hidden" name="option_amount1" value="14.99">\n		                            <input type="hidden" name="option_select2" value="Pro">\n		                            <input type="hidden" name="option_amount2" value="24.99">\n		                            <input type="hidden" name="option_index" value="0">\n		                            \n		                            <input type="hidden" name="return" value="http://pixfort.com/landing/flatpack/preview/index.html">\n		                            <input type="hidden" name="cancel_return" value="http://themeforest.net/item/flatpack-landing-pages-pack-with-page-builder/10591107">\n		                            <span class="send_btn">\n		                                <button type="submit" class="submit_btn pix_text orange_bg">\n		                                    <span class="editContent">Get my Ticket</span>\n		                                </button>\n		                                <img alt="" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">\n		                            </span>\n		                        </form>\n                  				<div class="clearfix"></div>\n              				</div>\n						</div>\n      				</div>\n                </div>\n	       </div>\n        </div>\n		<div class="section_pointer" pix-name="paypal"></div>\n	</div>\n\n<script src="js/jquery-1.8.3.min.js" type="text/javascript"></script>\n<script src="js-files/jquery.easing.1.3.js" type="text/javascript"></script>\n<script src="js-files/jquery.common.min.js" type="text/javascript"></script>\n<script src="js-files/jquery.ui.touch-punch.min.js"></script>\n<script src="js-files/ticker.js" type="text/javascript"></script>\n<script src="js-files/bootstrap.min.js"></script>\n<script src="js-files/bootstrap-switch.js"></script>\n<script src="assets/js/appear.min.js" type="text/javascript"></script>\n<script src="js-files/custom.js" type="text/javascript"></script>\n<script src="js-files/custom3.js" type="text/javascript"></script>\n\n</body>', 681, NULL, '', 0, 1, '2017-03-30 08:18:08', '2017-03-30 08:22:15'),
(3, 1, 1, '<html><head>\n	<!-- Basic Page Needs\n    ================================================== -->\n	<meta charset="utf-8">\n	<title>FLATPACK</title>\n	<meta name="description" content="">\n	<meta name="author" content="">\n	<!-- Mobile Specific Metas\n    ================================================== -->\n	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">\n	<!-- CSS\n    ================================================== -->\n	<link rel="stylesheet" href="stylesheets/menu.css">\n    <link rel="stylesheet" href="stylesheets/flat-ui-slider.css">\n    <link rel="stylesheet" href="stylesheets/base.css">\n    <link rel="stylesheet" href="stylesheets/skeleton.css">\n    <link rel="stylesheet" href="stylesheets/landings.css">\n    <link rel="stylesheet" href="stylesheets/main.css">\n    <link rel="stylesheet" href="stylesheets/landings_layouts.css">\n    <link rel="stylesheet" href="stylesheets/box.css">\n    <link rel="stylesheet" href="stylesheets/pixicon.css">\n	<!--[if lt IE 9]>\n		<script src="http://html5shim.googlecode.com/svn/trunk/httpml5.js"></script>\n	<![endif]-->\n	<!-- Favicons\n	================================================== -->\n	<link rel="shortcut icon" href="images/favicon.ico">\n	<link rel="apple-touch-icon" href="images/apple-touch-icon.png">\n	<link rel="apple-touch-icon" sizes="72x72" href="images/apple-touch-icon-72x72.png">\n	<link rel="apple-touch-icon" sizes="114x114" href="images/apple-touch-icon-114x114.png">\n</head><body>\n\n<div id="page">\n\n\n		<div class="light_gray_bg small_padding pix_builder_bg" id="section_text_2">\n            <div class="container">\n                <div class="eight columns alpha mobile_center">\n                    <img class="extra_small_padding padding_left_10" src="images/main/logo.png" alt="" data-selector="img" style="">\n                </div>\n                <div class="eight columns omega right_text mobile_center">\n                    <a href="#" class="pix_button btn_normal small_wide_button small_bold bold_text orange_bg ">\n                        <span>Buy Tickets</span>\n                    </a> \n                </div>\n            </div>\n        </div>\n\n\n        <div class="" id="section_header_1">\n            <div class="header_style header_nav_1 pix_builder_bg">\n                <div class="container">\n                    <div class="sixteen columns firas2">\n                        <nav role="navigation" class="navbar navbar-white navbar-embossed navbar-lg pix_nav_1">\n                            <div class="containerss">                            \n                                <div class="navbar-header">\n                                    <button data-target="#navbar-collapse-02" data-toggle="collapse" class="navbar-toggle" type="button">\n                                        <span class="sr-only">Toggle navigation</span>\n                                    </button>\n                                    \n                                </div>\n                                <div class="padding_25 right_socials">\n                                        <ul class="bottom-icons">\n                                            <li><a class="pi pixicon-facebook2 light_gray" href="#fakelink" data-selector="nav a, a.edit" style=""></a></li>\n                                            <li><a class="pi pixicon-twitter2 light_gray" href="#fakelink" data-selector="nav a, a.edit" style=""></a></li>\n                                            <li><a class="pi pixicon-instagram light_gray" href="#fakelink" data-selector="nav a, a.edit" style=""></a></li>\n                                        </ul>\n                                    </div>\n                                <div id="navbar-collapse-02" class="collapse navbar-collapse">\n                                    <ul class="nav navbar-nav navbar-left">\n                                        <li class="active propClone"><a href="#" data-selector="nav a, a.edit" style="outline: none; cursor: inherit;">Home</a></li>\n                                        <li class="propClone"><a href="#" data-selector="nav a, a.edit" style="outline: none; cursor: inherit;">Work</a></li>\n                                        <li class="propClone"><a href="#" data-selector="nav a, a.edit" style="outline: none; cursor: inherit;">Blog</a></li>\n                                        <li class="propClone"><a href="#" data-selector="nav a, a.edit" style="">Contact</a></li>\n                                    </ul>\n                                </div><!-- /.navbar-collapse -->\n                            </div><!-- /.container -->\n                        </nav>\n                    </div>\n                </div><!-- container -->\n            </div>\n        </div>\n</div>\n\n<script src="js/jquery-1.8.3.min.js" type="text/javascript"></script>\n<script src="js-files/jquery.easing.1.3.js" type="text/javascript"></script>\n<script src="js-files/jquery.common.min.js" type="text/javascript"></script>\n<script src="js-files/jquery.ui.touch-punch.min.js"></script>\n<script src="js-files/ticker.js" type="text/javascript"></script>\n<script src="js-files/bootstrap.min.js"></script>\n<script src="js-files/bootstrap-switch.js"></script>\n<script src="assets/js/appear.min.js" type="text/javascript"></script>\n<script src="js-files/custom.js" type="text/javascript"></script>\n<script src="js-files/custom3.js" type="text/javascript"></script>\n\n\n</body>', 178, NULL, '', 0, 1, '2017-03-30 08:31:42', '2017-03-30 08:32:42'),
(4, 1, 1, '<html><head>\n	<!-- Basic Page Needs\n    ================================================== -->\n	<meta charset="utf-8">\n	<title>FLATPACK</title>\n	<meta name="description" content="">\n	<meta name="author" content="">\n	<!-- Mobile Specific Metas\n    ================================================== -->\n	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">\n	<!-- CSS\n    ================================================== -->\n	<link rel="stylesheet" href="stylesheets/menu.css">\n    <link rel="stylesheet" href="stylesheets/flat-ui-slider.css">\n    <link rel="stylesheet" href="stylesheets/base.css">\n    <link rel="stylesheet" href="stylesheets/skeleton.css">\n    <link rel="stylesheet" href="stylesheets/landings.css">\n    <link rel="stylesheet" href="stylesheets/main.css">\n    <link rel="stylesheet" href="stylesheets/landings_layouts.css">\n    <link rel="stylesheet" href="stylesheets/box.css">\n    <link rel="stylesheet" href="stylesheets/pixicon.css">\n	<!--[if lt IE 9]>\n		<script src="http://html5shim.googlecode.com/svn/trunk/httpml5.js"></script>\n	<![endif]-->\n	<!-- Favicons\n	================================================== -->\n	<link rel="shortcut icon" href="images/favicon.ico">\n	<link rel="apple-touch-icon" href="images/apple-touch-icon.png">\n	<link rel="apple-touch-icon" sizes="72x72" href="images/apple-touch-icon-72x72.png">\n	<link rel="apple-touch-icon" sizes="114x114" href="images/apple-touch-icon-114x114.png">\n</head><body>\n\n<div id="page">\n\n\n		<div class="light_gray_bg small_padding pix_builder_bg" id="section_text_2">\n            <div class="container">\n                <div class="eight columns alpha mobile_center">\n                    <img class="extra_small_padding padding_left_10" src="images/main/logo.png" alt="">\n                </div>\n                <div class="eight columns omega right_text mobile_center">\n                    <a href="#" class="pix_button btn_normal small_wide_button small_bold bold_text orange_bg ">\n                        <span>Buy Tickets</span>\n                    </a> \n                </div>\n            </div>\n        </div>\n\n\n        <div class="" id="section_header_1">\n            <div class="header_style header_nav_1 pix_builder_bg">\n                <div class="container">\n                    <div class="sixteen columns firas2">\n                        <nav role="navigation" class="navbar navbar-white navbar-embossed navbar-lg pix_nav_1">\n                            <div class="containerss">                            \n                                <div class="navbar-header">\n                                    <button data-target="#navbar-collapse-02" data-toggle="collapse" class="navbar-toggle" type="button">\n                                        <span class="sr-only">Toggle navigation</span>\n                                    </button>\n                                    \n                                </div>\n                                <div class="padding_25 right_socials">\n                                        <ul class="bottom-icons">\n                                            <li><a class="pi pixicon-facebook2 light_gray" href="#fakelink"></a></li>\n                                            <li><a class="pi pixicon-twitter2 light_gray" href="#fakelink"></a></li>\n                                            <li><a class="pi pixicon-instagram light_gray" href="#fakelink"></a></li>\n                                        </ul>\n                                    </div>\n                                <div id="navbar-collapse-02" class="collapse navbar-collapse">\n                                    <ul class="nav navbar-nav navbar-left">\n                                        <li class="active propClone"><a href="#">Home</a></li>\n                                        <li class="propClone"><a href="#">Work</a></li>\n                                        <li class="propClone"><a href="#">Blog</a></li>\n                                        <li class="propClone"><a href="#">Contact</a></li>\n                                    </ul>\n                                </div><!-- /.navbar-collapse -->\n                            </div><!-- /.container -->\n                        </nav>\n                    </div>\n                </div><!-- container -->\n            </div>\n        </div>\n</div>\n\n<script src="js/jquery-1.8.3.min.js" type="text/javascript"></script>\n<script src="js-files/jquery.easing.1.3.js" type="text/javascript"></script>\n<script src="js-files/jquery.common.min.js" type="text/javascript"></script>\n<script src="js-files/jquery.ui.touch-punch.min.js"></script>\n<script src="js-files/ticker.js" type="text/javascript"></script>\n<script src="js-files/bootstrap.min.js"></script>\n<script src="js-files/bootstrap-switch.js"></script>\n<script src="assets/js/appear.min.js" type="text/javascript"></script>\n<script src="js-files/custom.js" type="text/javascript"></script>\n<script src="js-files/custom3.js" type="text/javascript"></script>\n\n\n</body>', 191, NULL, '', 0, 1, '2017-03-30 08:32:42', '2017-03-30 08:50:01'),
(5, 1, 1, '<html><head>\n	<!-- Basic Page Needs\n    ================================================== -->\n	<meta charset="utf-8">\n	<title>FLATPACK</title>\n	<meta name="description" content="">\n	<meta name="author" content="">\n	<!-- Mobile Specific Metas\n    ================================================== -->\n	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">\n	<!-- CSS\n    ================================================== -->\n	<link rel="stylesheet" href="stylesheets/menu.css">\n    <link rel="stylesheet" href="stylesheets/flat-ui-slider.css">\n    <link rel="stylesheet" href="stylesheets/base.css">\n    <link rel="stylesheet" href="stylesheets/skeleton.css">\n    <link rel="stylesheet" href="stylesheets/landings.css">\n    <link rel="stylesheet" href="stylesheets/main.css">\n    <link rel="stylesheet" href="stylesheets/landings_layouts.css">\n    <link rel="stylesheet" href="stylesheets/box.css">\n    <link rel="stylesheet" href="stylesheets/pixicon.css">\n	<!--[if lt IE 9]>\n		<script src="http://html5shim.googlecode.com/svn/trunk/httpml5.js"></script>\n	<![endif]-->\n	<!-- Favicons\n	================================================== -->\n	<link rel="shortcut icon" href="images/favicon.ico">\n	<link rel="apple-touch-icon" href="images/apple-touch-icon.png">\n	<link rel="apple-touch-icon" sizes="72x72" href="images/apple-touch-icon-72x72.png">\n	<link rel="apple-touch-icon" sizes="114x114" href="images/apple-touch-icon-114x114.png">\n</head><body>\n\n<div id="page">\n\n\n		<div class="light_gray_bg small_padding pix_builder_bg" id="section_text_2">\n            <div class="container">\n                <div class="eight columns alpha mobile_center">\n                    <img class="extra_small_padding padding_left_10" src="images/main/logo.png" alt="">\n                </div>\n                <div class="eight columns omega right_text mobile_center">\n                    <a href="#" class="pix_button btn_normal small_wide_button small_bold bold_text orange_bg ">\n                        <span>Buy Tickets</span>\n                    </a> \n                </div>\n            </div>\n        </div>\n\n\n        <div class="" id="section_header_1">\n            <div class="header_style header_nav_1 pix_builder_bg">\n                <div class="container">\n                    <div class="sixteen columns firas2">\n                        <nav role="navigation" class="navbar navbar-white navbar-embossed navbar-lg pix_nav_1">\n                            <div class="containerss">                            \n                                <div class="navbar-header">\n                                    <button data-target="#navbar-collapse-02" data-toggle="collapse" class="navbar-toggle" type="button">\n                                        <span class="sr-only">Toggle navigation</span>\n                                    </button>\n                                    \n                                </div>\n                                <div class="padding_25 right_socials">\n                                        <ul class="bottom-icons">\n                                            <li><a class="pi pixicon-facebook2 light_gray" href="#fakelink"></a></li>\n                                            <li><a class="pi pixicon-twitter2 light_gray" href="#fakelink"></a></li>\n                                            <li><a class="pi pixicon-instagram light_gray" href="#fakelink"></a></li>\n                                        </ul>\n                                    </div>\n                                <div id="navbar-collapse-02" class="collapse navbar-collapse">\n                                    <ul class="nav navbar-nav navbar-left">\n                                        <li class="active propClone"><a href="#">Home</a></li>\n                                        <li class="propClone"><a href="#">Work</a></li>\n                                        <li class="propClone"><a href="#">Blog</a></li>\n                                        <li class="propClone"><a href="#">Contact</a></li>\n                                    </ul>\n                                </div><!-- /.navbar-collapse -->\n                            </div><!-- /.container -->\n                        </nav>\n                    </div>\n                </div><!-- container -->\n            </div>\n        </div>\n</div>\n\n<script src="js/jquery-1.8.3.min.js" type="text/javascript"></script>\n<script src="js-files/jquery.easing.1.3.js" type="text/javascript"></script>\n<script src="js-files/jquery.common.min.js" type="text/javascript"></script>\n<script src="js-files/jquery.ui.touch-punch.min.js"></script>\n<script src="js-files/ticker.js" type="text/javascript"></script>\n<script src="js-files/bootstrap.min.js"></script>\n<script src="js-files/bootstrap-switch.js"></script>\n<script src="assets/js/appear.min.js" type="text/javascript"></script>\n<script src="js-files/custom.js" type="text/javascript"></script>\n<script src="js-files/custom3.js" type="text/javascript"></script>\n\n\n</body>', 178, NULL, '', 0, 1, '2017-03-30 08:53:05', '2017-03-30 08:53:55'),
(6, 1, 1, '<html><head>\n	<!-- Basic Page Needs\n    ================================================== -->\n	<meta charset="utf-8">\n	<title>FLATPACK</title>\n	<meta name="description" content="">\n	<meta name="author" content="">\n	<!-- Mobile Specific Metas\n    ================================================== -->\n	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">\n	<!-- CSS\n    ================================================== -->\n	<link rel="stylesheet" href="stylesheets/menu.css">\n    <link rel="stylesheet" href="stylesheets/flat-ui-slider.css">\n    <link rel="stylesheet" href="stylesheets/base.css">\n    <link rel="stylesheet" href="stylesheets/skeleton.css">\n    <link rel="stylesheet" href="stylesheets/landings.css">\n    <link rel="stylesheet" href="stylesheets/main.css">\n    <link rel="stylesheet" href="stylesheets/landings_layouts.css">\n    <link rel="stylesheet" href="stylesheets/box.css">\n    <link rel="stylesheet" href="stylesheets/pixicon.css">\n\n	<!--[if lt IE 9]>\n		<script src="http://html5shim.googlecode.com/svn/trunk/httpml5.js"></script>\n	<![endif]-->\n	<!-- Favicons\n	================================================== -->\n	<link rel="shortcut icon" href="images/favicon.ico">\n	<link rel="apple-touch-icon" href="images/apple-touch-icon.png">\n	<link rel="apple-touch-icon" sizes="72x72" href="images/apple-touch-icon-72x72.png">\n	<link rel="apple-touch-icon" sizes="114x114" href="images/apple-touch-icon-114x114.png">\n</head><body>\n\n<div id="page">\n    <div class="pix_builder_bg hl1" id="section_highlight_1">\n        <div class="big_padding highlight-section">\n            <div class="highlight-left pix_builder_bg"></div>\n            <div class="container ">\n                <div class="sixteen columns ">\n                    <div class="eight columns alpha">\n                        <div class="highlight_inner">\n                            <p class="big_title editContent">Restaurant High Quality Services</p>\n                            <p class="bold_text margin_bottom normal_text orange editContent">BOOK YOUR SEAT ONLINE</p>\n                            <p class="normal_text light_gray editContent">Lorem ipsum dolor sit amet consectetur adipiscing elit sed do eiusmod tempor incididunt ut labore et dolore magna aliqua Ut enim ad minim veniam quis nostrud exercitation ullamco laboris nisi ut aliquip ex commodo consequat Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat.</p>\n                            <a href="#" class="pix_button pix_button_line brown bold_text editContent"><i class="pi pixicon-ribbon"></i> Bookmark Recipes</a>\n                            </div>\n                    </div>                 \n                    <div class="eight columns omega ">\n                        \n                    </div>\n                </div>\n           </div>\n        </div>\n    </div>\n</div>\n\n<script src="js/jquery-1.8.3.min.js" type="text/javascript"></script>\n<script src="js-files/jquery.easing.1.3.js" type="text/javascript"></script>\n<script src="js-files/jquery.common.min.js" type="text/javascript"></script>\n<script src="js-files/jquery.ui.touch-punch.min.js"></script>\n<script src="js-files/ticker.js" type="text/javascript"></script>\n<script src="js-files/bootstrap.min.js"></script>\n<script src="js-files/bootstrap-switch.js"></script>\n<script src="assets/js/appear.min.js" type="text/javascript"></script>\n<script src="js-files/custom.js" type="text/javascript"></script>\n<script src="js-files/custom3.js" type="text/javascript"></script>\n\n</body>', 500, NULL, '', 0, 1, '2017-03-30 08:53:55', '2017-03-30 08:54:47'),
(7, 1, 1, '<html><head>\n	<!-- Basic Page Needs\n    ================================================== -->\n	<meta charset="utf-8">\n	<title>FLATPACK</title>\n	<meta name="description" content="">\n	<meta name="author" content="">\n	<!-- Mobile Specific Metas\n    ================================================== -->\n	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">\n	<!-- CSS\n    ================================================== -->\n	<link rel="stylesheet" href="stylesheets/menu.css">\n    <link rel="stylesheet" href="stylesheets/flat-ui-slider.css">\n    <link rel="stylesheet" href="stylesheets/base.css">\n    <link rel="stylesheet" href="stylesheets/skeleton.css">\n    <link rel="stylesheet" href="stylesheets/landings.css">\n    <link rel="stylesheet" href="stylesheets/main.css">\n    <link rel="stylesheet" href="stylesheets/landings_layouts.css">\n    <link rel="stylesheet" href="stylesheets/box.css">\n    <link rel="stylesheet" href="stylesheets/pixicon.css">\n	<!--[if lt IE 9]>\n		<script src="http://html5shim.googlecode.com/svn/trunk/httpml5.js"></script>\n	<![endif]-->\n	<!-- Favicons\n	================================================== -->\n	<link rel="shortcut icon" href="images/favicon.ico">\n	<link rel="apple-touch-icon" href="images/apple-touch-icon.png">\n	<link rel="apple-touch-icon" sizes="72x72" href="images/apple-touch-icon-72x72.png">\n	<link rel="apple-touch-icon" sizes="114x114" href="images/apple-touch-icon-114x114.png">\n</head><body>\n\n<div id="page">\n\n\n		<div class="light_gray_bg small_padding pix_builder_bg" id="section_text_2">\n            <div class="container">\n                <div class="eight columns alpha mobile_center">\n                    <img class="extra_small_padding padding_left_10" src="images/main/logo.png" alt="">\n                </div>\n                <div class="eight columns omega right_text mobile_center">\n                    <a href="#" class="pix_button btn_normal small_wide_button small_bold bold_text orange_bg ">\n                        <span>Buy Tickets</span>\n                    </a> \n                </div>\n            </div>\n        </div>\n\n\n        <div class="" id="section_header_1">\n            <div class="header_style header_nav_1 pix_builder_bg">\n                <div class="container">\n                    <div class="sixteen columns firas2">\n                        <nav role="navigation" class="navbar navbar-white navbar-embossed navbar-lg pix_nav_1">\n                            <div class="containerss">                            \n                                <div class="navbar-header">\n                                    <button data-target="#navbar-collapse-02" data-toggle="collapse" class="navbar-toggle" type="button">\n                                        <span class="sr-only">Toggle navigation</span>\n                                    </button>\n                                    \n                                </div>\n                                <div class="padding_25 right_socials">\n                                        <ul class="bottom-icons">\n                                            <li><a class="pi pixicon-facebook2 light_gray" href="#fakelink"></a></li>\n                                            <li><a class="pi pixicon-twitter2 light_gray" href="#fakelink"></a></li>\n                                            <li><a class="pi pixicon-instagram light_gray" href="#fakelink"></a></li>\n                                        </ul>\n                                    </div>\n                                <div id="navbar-collapse-02" class="collapse navbar-collapse">\n                                    <ul class="nav navbar-nav navbar-left">\n                                        <li class="active propClone"><a href="#">Home</a></li>\n                                        <li class="propClone"><a href="#">Work</a></li>\n                                        <li class="propClone"><a href="#">Blog</a></li>\n                                        <li class="propClone"><a href="#">Contact</a></li>\n                                    </ul>\n                                </div><!-- /.navbar-collapse -->\n                            </div><!-- /.container -->\n                        </nav>\n                    </div>\n                </div><!-- container -->\n            </div>\n        </div>\n</div>\n\n<script src="js/jquery-1.8.3.min.js" type="text/javascript"></script>\n<script src="js-files/jquery.easing.1.3.js" type="text/javascript"></script>\n<script src="js-files/jquery.common.min.js" type="text/javascript"></script>\n<script src="js-files/jquery.ui.touch-punch.min.js"></script>\n<script src="js-files/ticker.js" type="text/javascript"></script>\n<script src="js-files/bootstrap.min.js"></script>\n<script src="js-files/bootstrap-switch.js"></script>\n<script src="assets/js/appear.min.js" type="text/javascript"></script>\n<script src="js-files/custom.js" type="text/javascript"></script>\n<script src="js-files/custom3.js" type="text/javascript"></script>\n\n\n</body>', 178, NULL, '', 0, 1, '2017-03-30 08:56:41', '2017-03-30 08:57:30'),
(8, 1, 1, '<html><head>\n	<!-- Basic Page Needs\n    ================================================== -->\n	<meta charset="utf-8">\n	<title>FLATPACK</title>\n	<meta name="description" content="">\n	<meta name="author" content="">\n	<!-- Mobile Specific Metas\n    ================================================== -->\n	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">\n	<!-- CSS\n    ================================================== -->\n	<link rel="stylesheet" href="stylesheets/menu.css">\n    <link rel="stylesheet" href="stylesheets/flat-ui-slider.css">\n    <link rel="stylesheet" href="stylesheets/base.css">\n    <link rel="stylesheet" href="stylesheets/skeleton.css">\n    <link rel="stylesheet" href="stylesheets/landings.css">\n    <link rel="stylesheet" href="stylesheets/main.css">\n    <link rel="stylesheet" href="stylesheets/landings_layouts.css">\n    <link rel="stylesheet" href="stylesheets/box.css">\n    <link rel="stylesheet" href="stylesheets/pixicon.css">\n	<!--[if lt IE 9]>\n		<script src="http://html5shim.googlecode.com/svn/trunk/httpml5.js"></script>\n	<![endif]-->\n	<!-- Favicons\n	================================================== -->\n	<link rel="shortcut icon" href="images/favicon.ico">\n	<link rel="apple-touch-icon" href="images/apple-touch-icon.png">\n	<link rel="apple-touch-icon" sizes="72x72" href="images/apple-touch-icon-72x72.png">\n	<link rel="apple-touch-icon" sizes="114x114" href="images/apple-touch-icon-114x114.png">\n</head><body>\n\n<div id="page">\n\n\n		<div class="light_gray_bg small_padding pix_builder_bg" id="section_text_2">\n            <div class="container">\n                <div class="eight columns alpha mobile_center">\n                    <img class="extra_small_padding padding_left_10" src="images/main/logo.png" alt="">\n                </div>\n                <div class="eight columns omega right_text mobile_center">\n                    <a href="#" class="pix_button btn_normal small_wide_button small_bold bold_text orange_bg ">\n                        <span>Buy Tickets</span>\n                    </a> \n                </div>\n            </div>\n        </div>\n\n\n        <div class="" id="section_header_1">\n            <div class="header_style header_nav_1 pix_builder_bg">\n                <div class="container">\n                    <div class="sixteen columns firas2">\n                        <nav role="navigation" class="navbar navbar-white navbar-embossed navbar-lg pix_nav_1">\n                            <div class="containerss">                            \n                                <div class="navbar-header">\n                                    <button data-target="#navbar-collapse-02" data-toggle="collapse" class="navbar-toggle" type="button">\n                                        <span class="sr-only">Toggle navigation</span>\n                                    </button>\n                                    \n                                </div>\n                                <div class="padding_25 right_socials">\n                                        <ul class="bottom-icons">\n                                            <li><a class="pi pixicon-facebook2 light_gray" href="#fakelink"></a></li>\n                                            <li><a class="pi pixicon-twitter2 light_gray" href="#fakelink"></a></li>\n                                            <li><a class="pi pixicon-instagram light_gray" href="#fakelink"></a></li>\n                                        </ul>\n                                    </div>\n                                <div id="navbar-collapse-02" class="collapse navbar-collapse">\n                                    <ul class="nav navbar-nav navbar-left">\n                                        <li class="active propClone"><a href="#">Home</a></li>\n                                        <li class="propClone"><a href="#">Work</a></li>\n                                        <li class="propClone"><a href="#">Blog</a></li>\n                                        <li class="propClone"><a href="#">Contact</a></li>\n                                    </ul>\n                                </div><!-- /.navbar-collapse -->\n                            </div><!-- /.container -->\n                        </nav>\n                    </div>\n                </div><!-- container -->\n            </div>\n        </div>\n</div>\n\n<script src="js/jquery-1.8.3.min.js" type="text/javascript"></script>\n<script src="js-files/jquery.easing.1.3.js" type="text/javascript"></script>\n<script src="js-files/jquery.common.min.js" type="text/javascript"></script>\n<script src="js-files/jquery.ui.touch-punch.min.js"></script>\n<script src="js-files/ticker.js" type="text/javascript"></script>\n<script src="js-files/bootstrap.min.js"></script>\n<script src="js-files/bootstrap-switch.js"></script>\n<script src="assets/js/appear.min.js" type="text/javascript"></script>\n<script src="js-files/custom.js" type="text/javascript"></script>\n<script src="js-files/custom3.js" type="text/javascript"></script>\n\n\n</body>', 178, NULL, '', 0, 1, '2017-03-30 08:57:57', '2017-03-30 09:14:29'),
(9, 1, 1, '<html><head>\n	<!-- Basic Page Needs\n    ================================================== -->\n	<meta charset="utf-8">\n	<title>FLATPACK</title>\n	<meta name="description" content="">\n	<meta name="author" content="">\n	<!-- Mobile Specific Metas\n    ================================================== -->\n	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">\n	<!-- CSS\n    ================================================== -->\n	<link rel="stylesheet" href="stylesheets/menu.css">\n    <link rel="stylesheet" href="stylesheets/flat-ui-slider.css">\n    <link rel="stylesheet" href="stylesheets/base.css">\n    <link rel="stylesheet" href="stylesheets/skeleton.css">\n    <link rel="stylesheet" href="stylesheets/landings.css">\n    <link rel="stylesheet" href="stylesheets/main.css">\n    <link rel="stylesheet" href="stylesheets/landings_layouts.css">\n    <link rel="stylesheet" href="stylesheets/box.css">\n    <link rel="stylesheet" href="stylesheets/pixicon.css">\n	<!--[if lt IE 9]>\n		<script src="http://html5shim.googlecode.com/svn/trunk/httpml5.js"></script>\n	<![endif]-->\n	<!-- Favicons\n	================================================== -->\n	<link rel="shortcut icon" href="images/favicon.ico">\n	<link rel="apple-touch-icon" href="images/apple-touch-icon.png">\n	<link rel="apple-touch-icon" sizes="72x72" href="images/apple-touch-icon-72x72.png">\n	<link rel="apple-touch-icon" sizes="114x114" href="images/apple-touch-icon-114x114.png">\n</head><body>\n\n<div id="page">\n\n\n		<div class="light_gray_bg small_padding pix_builder_bg" id="section_text_2">\n            <div class="container">\n                <div class="eight columns alpha mobile_center">\n                    <img class="extra_small_padding padding_left_10" src="images/main/logo.png" alt="">\n                </div>\n                <div class="eight columns omega right_text mobile_center">\n                    <a href="#" class="pix_button btn_normal small_wide_button small_bold bold_text orange_bg ">\n                        <span>Buy Tickets</span>\n                    </a> \n                </div>\n            </div>\n        </div>\n\n\n        <div class="" id="section_header_1">\n            <div class="header_style header_nav_1 pix_builder_bg">\n                <div class="container">\n                    <div class="sixteen columns firas2">\n                        <nav role="navigation" class="navbar navbar-white navbar-embossed navbar-lg pix_nav_1">\n                            <div class="containerss">                            \n                                <div class="navbar-header">\n                                    <button data-target="#navbar-collapse-02" data-toggle="collapse" class="navbar-toggle" type="button">\n                                        <span class="sr-only">Toggle navigation</span>\n                                    </button>\n                                    \n                                </div>\n                                <div class="padding_25 right_socials">\n                                        <ul class="bottom-icons">\n                                            <li><a class="pi pixicon-facebook2 light_gray" href="#fakelink"></a></li>\n                                            <li><a class="pi pixicon-twitter2 light_gray" href="#fakelink"></a></li>\n                                            <li><a class="pi pixicon-instagram light_gray" href="#fakelink"></a></li>\n                                        </ul>\n                                    </div>\n                                <div id="navbar-collapse-02" class="collapse navbar-collapse">\n                                    <ul class="nav navbar-nav navbar-left">\n                                        <li class="active propClone"><a href="#">Home</a></li>\n                                        <li class="propClone"><a href="#">Work</a></li>\n                                        <li class="propClone"><a href="#">Blog</a></li>\n                                        <li class="propClone"><a href="#">Contact</a></li>\n                                    </ul>\n                                </div><!-- /.navbar-collapse -->\n                            </div><!-- /.container -->\n                        </nav>\n                    </div>\n                </div><!-- container -->\n            </div>\n        </div>\n</div>\n\n<script src="js/jquery-1.8.3.min.js" type="text/javascript"></script>\n<script src="js-files/jquery.easing.1.3.js" type="text/javascript"></script>\n<script src="js-files/jquery.common.min.js" type="text/javascript"></script>\n<script src="js-files/jquery.ui.touch-punch.min.js"></script>\n<script src="js-files/ticker.js" type="text/javascript"></script>\n<script src="js-files/bootstrap.min.js"></script>\n<script src="js-files/bootstrap-switch.js"></script>\n<script src="assets/js/appear.min.js" type="text/javascript"></script>\n<script src="js-files/custom.js" type="text/javascript"></script>\n<script src="js-files/custom3.js" type="text/javascript"></script>\n\n\n</body>', 178, NULL, '', 0, 1, '2017-03-30 09:15:17', '2017-03-30 09:15:47');
INSERT INTO `frames` (`id`, `page_id`, `site_id`, `content`, `height`, `original_url`, `loaderfunction`, `sandbox`, `revision`, `created_at`, `updated_at`) VALUES
(10, 1, 1, '<html><head>\n	<!-- Basic Page Needs\n    ================================================== -->\n	<meta charset="utf-8">\n	<title>FLATPACK</title>\n	<meta name="description" content="">\n	<meta name="author" content="">\n	<!-- Mobile Specific Metas\n    ================================================== -->\n	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">\n	<!-- CSS\n    ================================================== -->\n	<link rel="stylesheet" href="stylesheets/menu.css">\n    <link rel="stylesheet" href="stylesheets/flat-ui-slider.css">\n    <link rel="stylesheet" href="stylesheets/base.css">\n    <link rel="stylesheet" href="stylesheets/skeleton.css">\n    <link rel="stylesheet" href="stylesheets/landings.css">\n    <link rel="stylesheet" href="stylesheets/main.css">\n    <link rel="stylesheet" href="stylesheets/landings_layouts.css">\n    <link rel="stylesheet" href="stylesheets/box.css">\n    <link rel="stylesheet" href="stylesheets/pixicon.css">\n	<!--[if lt IE 9]>\n		<script src="http://html5shim.googlecode.com/svn/trunk/httpml5.js"></script>\n	<![endif]-->\n	<!-- Favicons\n	================================================== -->\n	<link rel="shortcut icon" href="images/favicon.ico">\n	<link rel="apple-touch-icon" href="images/apple-touch-icon.png">\n	<link rel="apple-touch-icon" sizes="72x72" href="images/apple-touch-icon-72x72.png">\n	<link rel="apple-touch-icon" sizes="114x114" href="images/apple-touch-icon-114x114.png">\n</head><body>\n\n<div id="page">\n\n\n		<div class="light_gray_bg small_padding pix_builder_bg" id="section_text_2">\n            <div class="container">\n                <div class="eight columns alpha mobile_center">\n                    <img class="extra_small_padding padding_left_10" src="images/main/logo.png" alt="">\n                </div>\n                <div class="eight columns omega right_text mobile_center">\n                    <a href="#" class="pix_button btn_normal small_wide_button small_bold bold_text orange_bg ">\n                        <span>Buy Tickets</span>\n                    </a> \n                </div>\n            </div>\n        </div>\n\n\n        <div class="" id="section_header_1">\n            <div class="header_style header_nav_1 pix_builder_bg">\n                <div class="container">\n                    <div class="sixteen columns firas2">\n                        <nav role="navigation" class="navbar navbar-white navbar-embossed navbar-lg pix_nav_1">\n                            <div class="containerss">                            \n                                <div class="navbar-header">\n                                    <button data-target="#navbar-collapse-02" data-toggle="collapse" class="navbar-toggle" type="button">\n                                        <span class="sr-only">Toggle navigation</span>\n                                    </button>\n                                    \n                                </div>\n                                <div class="padding_25 right_socials">\n                                        <ul class="bottom-icons">\n                                            <li><a class="pi pixicon-facebook2 light_gray" href="#fakelink"></a></li>\n                                            <li><a class="pi pixicon-twitter2 light_gray" href="#fakelink"></a></li>\n                                            <li><a class="pi pixicon-instagram light_gray" href="#fakelink"></a></li>\n                                        </ul>\n                                    </div>\n                                <div id="navbar-collapse-02" class="collapse navbar-collapse">\n                                    <ul class="nav navbar-nav navbar-left">\n                                        <li class="active propClone"><a href="#">Home</a></li>\n                                        <li class="propClone"><a href="#">Work</a></li>\n                                        <li class="propClone"><a href="#">Blog</a></li>\n                                        <li class="propClone"><a href="#">Contact</a></li>\n                                    </ul>\n                                </div><!-- /.navbar-collapse -->\n                            </div><!-- /.container -->\n                        </nav>\n                    </div>\n                </div><!-- container -->\n            </div>\n        </div>\n</div>\n\n<script src="js/jquery-1.8.3.min.js" type="text/javascript"></script>\n<script src="js-files/jquery.easing.1.3.js" type="text/javascript"></script>\n<script src="js-files/jquery.common.min.js" type="text/javascript"></script>\n<script src="js-files/jquery.ui.touch-punch.min.js"></script>\n<script src="js-files/ticker.js" type="text/javascript"></script>\n<script src="js-files/bootstrap.min.js"></script>\n<script src="js-files/bootstrap-switch.js"></script>\n<script src="assets/js/appear.min.js" type="text/javascript"></script>\n<script src="js-files/custom.js" type="text/javascript"></script>\n<script src="js-files/custom3.js" type="text/javascript"></script>\n\n\n</body>', 170, NULL, '', 0, 1, '2017-03-30 09:20:44', '2017-03-30 09:25:16'),
(11, 1, 1, '<html><head>\n	<!-- Basic Page Needs\n    ================================================== -->\n	<meta charset="utf-8">\n	<title>FLATPACK</title>\n	<meta name="description" content="">\n	<meta name="author" content="">\n	<!-- Mobile Specific Metas\n    ================================================== -->\n	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">\n	<!-- CSS\n    ================================================== -->\n	<link rel="stylesheet" href="stylesheets/menu.css">\n    <link rel="stylesheet" href="stylesheets/flat-ui-slider.css">\n    <link rel="stylesheet" href="stylesheets/base.css">\n    <link rel="stylesheet" href="stylesheets/skeleton.css">\n    <link rel="stylesheet" href="stylesheets/landings.css">\n    <link rel="stylesheet" href="stylesheets/main.css">\n    <link rel="stylesheet" href="stylesheets/landings_layouts.css">\n    <link rel="stylesheet" href="stylesheets/box.css">\n    <link rel="stylesheet" href="stylesheets/pixicon.css">\n	<!--[if lt IE 9]>\n		<script src="http://html5shim.googlecode.com/svn/trunk/httpml5.js"></script>\n	<![endif]-->\n	<!-- Favicons\n	================================================== -->\n	<link rel="shortcut icon" href="images/favicon.ico">\n	<link rel="apple-touch-icon" href="images/apple-touch-icon.png">\n	<link rel="apple-touch-icon" sizes="72x72" href="images/apple-touch-icon-72x72.png">\n	<link rel="apple-touch-icon" sizes="114x114" href="images/apple-touch-icon-114x114.png">\n</head><body>\n\n<div id="page">\n\n\n		<div class="light_gray_bg small_padding pix_builder_bg" id="section_text_2">\n            <div class="container">\n                <div class="eight columns alpha mobile_center">\n                    <img class="extra_small_padding padding_left_10" src="images/main/logo.png" alt="">\n                </div>\n                <div class="eight columns omega right_text mobile_center">\n                    <a href="#" class="pix_button btn_normal small_wide_button small_bold bold_text orange_bg ">\n                        <span>Buy Tickets</span>\n                    </a> \n                </div>\n            </div>\n        </div>\n\n\n        <div class="" id="section_header_1">\n            <div class="header_style header_nav_1 pix_builder_bg">\n                <div class="container">\n                    <div class="sixteen columns firas2">\n                        <nav role="navigation" class="navbar navbar-white navbar-embossed navbar-lg pix_nav_1">\n                            <div class="containerss">                            \n                                <div class="navbar-header">\n                                    <button data-target="#navbar-collapse-02" data-toggle="collapse" class="navbar-toggle" type="button">\n                                        <span class="sr-only">Toggle navigation</span>\n                                    </button>\n                                    \n                                </div>\n                                <div class="padding_25 right_socials">\n                                        <ul class="bottom-icons">\n                                            <li><a class="pi pixicon-facebook2 light_gray" href="#fakelink"></a></li>\n                                            <li><a class="pi pixicon-twitter2 light_gray" href="#fakelink"></a></li>\n                                            <li><a class="pi pixicon-instagram light_gray" href="#fakelink"></a></li>\n                                        </ul>\n                                    </div>\n                                <div id="navbar-collapse-02" class="collapse navbar-collapse">\n                                    <ul class="nav navbar-nav navbar-left">\n                                        <li class="active propClone"><a href="#">Home</a></li>\n                                        <li class="propClone"><a href="#">Work</a></li>\n                                        <li class="propClone"><a href="#">Blog</a></li>\n                                        <li class="propClone"><a href="#">Contact</a></li>\n                                    </ul>\n                                </div><!-- /.navbar-collapse -->\n                            </div><!-- /.container -->\n                        </nav>\n                    </div>\n                </div><!-- container -->\n            </div>\n        </div>\n</div>\n\n<script src="js/jquery-1.8.3.min.js" type="text/javascript"></script>\n<script src="js_files/jquery.easing.1.3.js" type="text/javascript"></script>\n<script src="js-files/jquery.common.min.js" type="text/javascript"></script>\n<script src="js-files/jquery.ui.touch-punch.min.js"></script>\n<script src="js-files/ticker.js" type="text/javascript"></script>\n<script src="js-files/bootstrap.min.js"></script>\n<script src="js-files/bootstrap-switch.js"></script>\n<script src="assets/js/appear.min.js" type="text/javascript"></script>\n<script src="js-files/custom.js" type="text/javascript"></script>\n<script src="js-files/custom3.js" type="text/javascript"></script>\n\n\n</body>', 170, NULL, '', 0, 1, '2017-03-30 09:26:31', '2017-03-30 09:39:13'),
(12, 1, 1, '<html><head>\n	<!-- Basic Page Needs\n    ================================================== -->\n	<meta charset="utf-8">\n	<title>FLATPACK</title>\n	<meta name="description" content="">\n	<meta name="author" content="">\n	<!-- Mobile Specific Metas\n    ================================================== -->\n	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">\n	<!-- CSS\n    ================================================== -->\n	<link rel="stylesheet" href="stylesheets/menu.css">\n    <link rel="stylesheet" href="stylesheets/flat-ui-slider.css">\n    <link rel="stylesheet" href="stylesheets/base.css">\n    <link rel="stylesheet" href="stylesheets/skeleton.css">\n    <link rel="stylesheet" href="stylesheets/landings.css">\n    <link rel="stylesheet" href="stylesheets/main.css">\n    <link rel="stylesheet" href="stylesheets/landings_layouts.css">\n    <link rel="stylesheet" href="stylesheets/box.css">\n    <link rel="stylesheet" href="stylesheets/pixicon.css">\n	<!--[if lt IE 9]>\n		<script src="http://html5shim.googlecode.com/svn/trunk/httpml5.js"></script>\n	<![endif]-->\n	<!-- Favicons\n	================================================== -->\n	<link rel="shortcut icon" href="images/favicon.ico">\n	<link rel="apple-touch-icon" href="images/apple-touch-icon.png">\n	<link rel="apple-touch-icon" sizes="72x72" href="images/apple-touch-icon-72x72.png">\n	<link rel="apple-touch-icon" sizes="114x114" href="images/apple-touch-icon-114x114.png">\n</head><body>\n\n<div id="page">\n\n\n		<div class="light_gray_bg small_padding pix_builder_bg" id="section_text_2">\n            <div class="container">\n                <div class="eight columns alpha mobile_center">\n                    <img class="extra_small_padding padding_left_10" src="images/main/logo.png" alt="">\n                </div>\n                <div class="eight columns omega right_text mobile_center">\n                    <a href="#" class="pix_button btn_normal small_wide_button small_bold bold_text orange_bg ">\n                        <span>Buy Tickets</span>\n                    </a> \n                </div>\n            </div>\n        </div>\n\n\n        <div class="" id="section_header_1">\n            <div class="header_style header_nav_1 pix_builder_bg">\n                <div class="container">\n                    <div class="sixteen columns firas2">\n                        <nav role="navigation" class="navbar navbar-white navbar-embossed navbar-lg pix_nav_1">\n                            <div class="containerss">                            \n                                <div class="navbar-header">\n                                    <button data-target="#navbar-collapse-02" data-toggle="collapse" class="navbar-toggle" type="button">\n                                        <span class="sr-only">Toggle navigation</span>\n                                    </button>\n                                    \n                                </div>\n                                <div class="padding_25 right_socials">\n                                        <ul class="bottom-icons">\n                                            <li><a class="pi pixicon-facebook2 light_gray" href="#fakelink"></a></li>\n                                            <li><a class="pi pixicon-twitter2 light_gray" href="#fakelink"></a></li>\n                                            <li><a class="pi pixicon-instagram light_gray" href="#fakelink"></a></li>\n                                        </ul>\n                                    </div>\n                                <div id="navbar-collapse-02" class="collapse navbar-collapse">\n                                    <ul class="nav navbar-nav navbar-left">\n                                        <li class="active propClone"><a href="#">Home</a></li>\n                                        <li class="propClone"><a href="#">Work</a></li>\n                                        <li class="propClone"><a href="#">Blog</a></li>\n                                        <li class="propClone"><a href="#">Contact</a></li>\n                                    </ul>\n                                </div><!-- /.navbar-collapse -->\n                            </div><!-- /.container -->\n                        </nav>\n                    </div>\n                </div><!-- container -->\n            </div>\n        </div>\n</div>\n\n<script src="js/jquery-1.8.3.min.js" type="text/javascript"></script>\n<script src="js_files/jquery.easing.1.3.js" type="text/javascript"></script>\n<script src="js_files/jquery.common.min.js" type="text/javascript"></script>\n<script src="js_files/jquery.ui.touch-punch.min.js"></script>\n<script src="js_files/ticker.js" type="text/javascript"></script>\n<script src="js_files/bootstrap.min.js"></script>\n<script src="js_files/bootstrap-switch.js"></script>\n<script src="assets/js/appear.min.js" type="text/javascript"></script>\n<script src="js_files/custom.js" type="text/javascript"></script>\n<script src="js_files/custom3.js" type="text/javascript"></script>\n\n\n</body>', 170, NULL, '', 0, 1, '2017-03-30 09:40:28', '2017-03-30 09:40:36'),
(13, 1, 1, '<html><head>\n	<!-- Basic Page Needs\n    ================================================== -->\n	<meta charset="utf-8">\n	<title>FLATPACK</title>\n	<meta name="description" content="">\n	<meta name="author" content="">\n	<!-- Mobile Specific Metas\n    ================================================== -->\n	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">\n	<!-- CSS\n    ================================================== -->\n	<link rel="stylesheet" href="stylesheets/menu.css">\n    <link rel="stylesheet" href="stylesheets/flat-ui-slider.css">\n    <link rel="stylesheet" href="stylesheets/base.css">\n    <link rel="stylesheet" href="stylesheets/skeleton.css">\n    <link rel="stylesheet" href="stylesheets/landings.css">\n    <link rel="stylesheet" href="stylesheets/main.css">\n    <link rel="stylesheet" href="stylesheets/landings_layouts.css">\n    <link rel="stylesheet" href="stylesheets/box.css">\n    <link rel="stylesheet" href="stylesheets/pixicon.css">\n	<!--[if lt IE 9]>\n		<script src="http://html5shim.googlecode.com/svn/trunk/httpml5.js"></script>\n	<![endif]-->\n	<!-- Favicons\n	================================================== -->\n	<link rel="shortcut icon" href="images/favicon.ico">\n	<link rel="apple-touch-icon" href="images/apple-touch-icon.png">\n	<link rel="apple-touch-icon" sizes="72x72" href="images/apple-touch-icon-72x72.png">\n	<link rel="apple-touch-icon" sizes="114x114" href="images/apple-touch-icon-114x114.png">\n</head><body>\n\n<div id="page">\n\n\n		<div class="light_gray_bg small_padding pix_builder_bg" id="section_text_2">\n            <div class="container">\n                <div class="eight columns alpha mobile_center">\n                    <img class="extra_small_padding padding_left_10" src="images/main/logo.png" alt="">\n                </div>\n                <div class="eight columns omega right_text mobile_center">\n                    <a href="#" class="pix_button btn_normal small_wide_button small_bold bold_text orange_bg ">\n                        <span>Buy Tickets</span>\n                    </a> \n                </div>\n            </div>\n        </div>\n\n\n        <div class="" id="section_header_1">\n            <div class="header_style header_nav_1 pix_builder_bg">\n                <div class="container">\n                    <div class="sixteen columns firas2">\n                        <nav role="navigation" class="navbar navbar-white navbar-embossed navbar-lg pix_nav_1">\n                            <div class="containerss">                            \n                                <div class="navbar-header">\n                                    <button data-target="#navbar-collapse-02" data-toggle="collapse" class="navbar-toggle" type="button">\n                                        <span class="sr-only">Toggle navigation</span>\n                                    </button>\n                                    \n                                </div>\n                                <div class="padding_25 right_socials">\n                                        <ul class="bottom-icons">\n                                            <li><a class="pi pixicon-facebook2 light_gray" href="#fakelink"></a></li>\n                                            <li><a class="pi pixicon-twitter2 light_gray" href="#fakelink"></a></li>\n                                            <li><a class="pi pixicon-instagram light_gray" href="#fakelink"></a></li>\n                                        </ul>\n                                    </div>\n                                <div id="navbar-collapse-02" class="collapse navbar-collapse">\n                                    <ul class="nav navbar-nav navbar-left">\n                                        <li class="active propClone"><a href="#">Home</a></li>\n                                        <li class="propClone"><a href="#">Work</a></li>\n                                        <li class="propClone"><a href="#">Blog</a></li>\n                                        <li class="propClone"><a href="#">Contact</a></li>\n                                    </ul>\n                                </div><!-- /.navbar-collapse -->\n                            </div><!-- /.container -->\n                        </nav>\n                    </div>\n                </div><!-- container -->\n            </div>\n        </div>\n</div>\n\n<script src="js/jquery-1.8.3.min.js" type="text/javascript"></script>\n<script src="js_files/jquery.easing.1.3.js" type="text/javascript"></script>\n<script src="js_files/jquery.common.min.js" type="text/javascript"></script>\n<script src="js_files/jquery.ui.touch-punch.min.js"></script>\n<script src="js_files/ticker.js" type="text/javascript"></script>\n<script src="js_files/bootstrap.min.js"></script>\n<script src="js_files/bootstrap-switch.js"></script>\n<script src="assets/js/appear.min.js" type="text/javascript"></script>\n<script src="js_files/custom.js" type="text/javascript"></script>\n<script src="js_files/custom3.js" type="text/javascript"></script>\n\n\n</body>', 170, NULL, '', 0, 1, '2017-03-30 09:43:27', '2017-03-30 09:45:31'),
(14, 1, 1, '<html><head>\n	<!-- Basic Page Needs\n    ================================================== -->\n	<meta charset="utf-8">\n	<title>FLATPACK</title>\n	<meta name="description" content="">\n	<meta name="author" content="">\n	<!-- Mobile Specific Metas\n    ================================================== -->\n	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">\n	<!-- CSS\n    ================================================== -->\n	<link rel="stylesheet" href="stylesheets/menu.css">\n    <link rel="stylesheet" href="stylesheets/flat-ui-slider.css">\n    <link rel="stylesheet" href="stylesheets/base.css">\n    <link rel="stylesheet" href="stylesheets/skeleton.css">\n    <link rel="stylesheet" href="stylesheets/landings.css">\n    <link rel="stylesheet" href="stylesheets/main.css">\n    <link rel="stylesheet" href="stylesheets/landings_layouts.css">\n    <link rel="stylesheet" href="stylesheets/box.css">\n    <link rel="stylesheet" href="stylesheets/pixicon.css">\n	<!--[if lt IE 9]>\n		<script src="http://html5shim.googlecode.com/svn/trunk/httpml5.js"></script>\n	<![endif]-->\n	<!-- Favicons\n	================================================== -->\n	<link rel="shortcut icon" href="images/favicon.ico">\n	<link rel="apple-touch-icon" href="images/apple-touch-icon.png">\n	<link rel="apple-touch-icon" sizes="72x72" href="images/apple-touch-icon-72x72.png">\n	<link rel="apple-touch-icon" sizes="114x114" href="images/apple-touch-icon-114x114.png">\n</head><body>\n\n<div id="page">\n\n\n		<div class="light_gray_bg small_padding pix_builder_bg" id="section_text_2">\n            <div class="container">\n                <div class="eight columns alpha mobile_center">\n                    <img class="extra_small_padding padding_left_10" src="images/main/logo.png" alt="">\n                </div>\n                <div class="eight columns omega right_text mobile_center">\n                    <a href="#" class="pix_button btn_normal small_wide_button small_bold bold_text orange_bg ">\n                        <span>Buy Tickets</span>\n                    </a> \n                </div>\n            </div>\n        </div>\n\n\n        <div class="" id="section_header_1">\n            <div class="header_style header_nav_1 pix_builder_bg">\n                <div class="container">\n                    <div class="sixteen columns firas2">\n                        <nav role="navigation" class="navbar navbar-white navbar-embossed navbar-lg pix_nav_1">\n                            <div class="containerss">                            \n                                <div class="navbar-header">\n                                    <button data-target="#navbar-collapse-02" data-toggle="collapse" class="navbar-toggle" type="button">\n                                        <span class="sr-only">Toggle navigation</span>\n                                    </button>\n                                    \n                                </div>\n                                <div class="padding_25 right_socials">\n                                        <ul class="bottom-icons">\n                                            <li><a class="pi pixicon-facebook2 light_gray" href="#fakelink"></a></li>\n                                            <li><a class="pi pixicon-twitter2 light_gray" href="#fakelink"></a></li>\n                                            <li><a class="pi pixicon-instagram light_gray" href="#fakelink"></a></li>\n                                        </ul>\n                                    </div>\n                                <div id="navbar-collapse-02" class="collapse navbar-collapse">\n                                    <ul class="nav navbar-nav navbar-left">\n                                        <li class="active propClone"><a href="#">Home</a></li>\n                                        <li class="propClone"><a href="#">Work</a></li>\n                                        <li class="propClone"><a href="#">Blog</a></li>\n                                        <li class="propClone"><a href="#">Contact</a></li>\n                                    </ul>\n                                </div><!-- /.navbar-collapse -->\n                            </div><!-- /.container -->\n                        </nav>\n                    </div>\n                </div><!-- container -->\n            </div>\n        </div>\n</div>\n\n<script src="js/jquery-1.8.3.min.js" type="text/javascript"></script>\n<script src="js_files/jquery.easing.1.3.js" type="text/javascript"></script>\n<script src="js_files/jquery.common.min.js" type="text/javascript"></script>\n<script src="js_files/jquery.ui.touch-punch.min.js"></script>\n<script src="js_files/ticker.js" type="text/javascript"></script>\n<script src="js_files/bootstrap.min.js"></script>\n<script src="js_files/bootstrap-switch.js"></script>\n<script src="assets/js/appear.min.js" type="text/javascript"></script>\n<script src="js_files/custom.js" type="text/javascript"></script>\n<script src="js_files/custom3.js" type="text/javascript"></script>\n\n\n</body>', 178, NULL, '', 0, 1, '2017-03-30 09:48:31', '2017-03-30 09:49:34'),
(15, 1, 1, '<html><head>\n	<!-- Basic Page Needs\n    ================================================== -->\n	<meta charset="utf-8">\n	<title>FLATPACK</title>\n	<meta name="description" content="">\n	<meta name="author" content="">\n	<!-- Mobile Specific Metas\n    ================================================== -->\n	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">\n	<!-- CSS\n    ================================================== -->\n	<link rel="stylesheet" href="stylesheets/menu.css">\n    <link rel="stylesheet" href="stylesheets/flat-ui-slider.css">\n    <link rel="stylesheet" href="stylesheets/base.css">\n    <link rel="stylesheet" href="stylesheets/skeleton.css">\n    <link rel="stylesheet" href="stylesheets/landings.css">\n    <link rel="stylesheet" href="stylesheets/main.css">\n    <link rel="stylesheet" href="stylesheets/landings_layouts.css">\n    <link rel="stylesheet" href="stylesheets/box.css">\n    <link rel="stylesheet" href="stylesheets/pixicon.css">\n	<!--[if lt IE 9]>\n		<script src="http://html5shim.googlecode.com/svn/trunk/httpml5.js"></script>\n	<![endif]-->\n	<!-- Favicons\n	================================================== -->\n	<link rel="shortcut icon" href="images/favicon.ico">\n	<link rel="apple-touch-icon" href="images/apple-touch-icon.png">\n	<link rel="apple-touch-icon" sizes="72x72" href="images/apple-touch-icon-72x72.png">\n	<link rel="apple-touch-icon" sizes="114x114" href="images/apple-touch-icon-114x114.png">\n</head><body>\n\n<div id="page">\n\n\n		<div class="light_gray_bg small_padding pix_builder_bg" id="section_text_2">\n            <div class="container">\n                <div class="eight columns alpha mobile_center">\n                    <img class="extra_small_padding padding_left_10" src="images/main/logo.png" alt="" data-selector="img" style="outline: none; cursor: inherit;">\n                </div>\n                <div class="eight columns omega right_text mobile_center">\n                    <a href="#" class="pix_button btn_normal small_wide_button small_bold bold_text orange_bg ">\n                        <span>Buy Tickets</span>\n                    </a> \n                </div>\n            </div>\n        </div>\n\n\n        <div class="" id="section_header_1">\n            <div class="header_style header_nav_1 pix_builder_bg">\n                <div class="container">\n                    <div class="sixteen columns firas2">\n                        <nav role="navigation" class="navbar navbar-white navbar-embossed navbar-lg pix_nav_1">\n                            <div class="containerss">                            \n                                <div class="navbar-header">\n                                    <button data-target="#navbar-collapse-02" data-toggle="collapse" class="navbar-toggle" type="button" style="outline: none; cursor: inherit;">\n                                        <span class="sr-only">Toggle navigation</span>\n                                    </button>\n                                    \n                                </div>\n                                <div class="padding_25 right_socials">\n                                        <ul class="bottom-icons">\n                                            <li><a class="pi pixicon-facebook2 light_gray" href="#fakelink" data-selector="nav a, a.edit" style="outline: none; cursor: inherit;"></a></li>\n                                            <li><a class="pi pixicon-twitter2 light_gray" href="#fakelink" data-selector="nav a, a.edit" style="outline: none; cursor: inherit;"></a></li>\n                                            <li><a class="pi pixicon-instagram light_gray" href="#fakelink" data-selector="nav a, a.edit" style=""></a></li>\n                                        </ul>\n                                    </div>\n                                <div id="navbar-collapse-02" class="collapse navbar-collapse">\n                                    <ul class="nav navbar-nav navbar-left">\n                                        <li class="active propClone"><a href="#" data-selector="nav a, a.edit" style="outline: none; cursor: inherit;">Home</a></li>\n                                        <li class="propClone"><a href="#" data-selector="nav a, a.edit" style="outline: none; cursor: inherit;">Work</a></li>\n                                        <li class="propClone"><a href="#" data-selector="nav a, a.edit" style="">Blog</a></li>\n                                        <li class="propClone"><a href="#" data-selector="nav a, a.edit" style="outline: none; cursor: inherit;">Nội dung</a></li>\n                                    </ul>\n                                </div><!-- /.navbar-collapse -->\n                            </div><!-- /.container -->\n                        </nav>\n                    </div>\n                </div><!-- container -->\n            </div>\n        </div>\n</div>\n\n<script src="js/jquery-1.8.3.min.js" type="text/javascript"></script>\n<script src="js_files/jquery.easing.1.3.js" type="text/javascript"></script>\n<script src="js_files/jquery.common.min.js" type="text/javascript"></script>\n<script src="js_files/jquery.ui.touch-punch.min.js"></script>\n<script src="js_files/ticker.js" type="text/javascript"></script>\n<script src="js_files/bootstrap.min.js"></script>\n<script src="js_files/bootstrap-switch.js"></script>\n<script src="assets/js/appear.min.js" type="text/javascript"></script>\n<script src="js_files/custom.js" type="text/javascript"></script>\n<script src="js_files/custom3.js" type="text/javascript"></script>\n\n\n</body>', 2330, NULL, '', 0, 1, '2017-03-30 09:49:34', '2017-03-30 10:03:13'),
(16, 1, 1, '<html><head>\n	<!-- Basic Page Needs\n    ================================================== -->\n	<meta charset="utf-8">\n	<title>FLATPACK</title>\n	<meta name="description" content="">\n	<meta name="author" content="">\n	<!-- Mobile Specific Metas\n    ================================================== -->\n	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">\n	<!-- CSS\n    ================================================== -->\n	<link rel="stylesheet" href="stylesheets/menu.css">\n    <link rel="stylesheet" href="stylesheets/flat-ui-slider.css">\n    <link rel="stylesheet" href="stylesheets/base.css">\n    <link rel="stylesheet" href="stylesheets/skeleton.css">\n    <link rel="stylesheet" href="stylesheets/landings.css">\n    <link rel="stylesheet" href="stylesheets/main.css">\n    <link rel="stylesheet" href="stylesheets/landings_layouts.css">\n    <link rel="stylesheet" href="stylesheets/box.css">\n    <link rel="stylesheet" href="stylesheets/pixicon.css">\n	<!--[if lt IE 9]>\n		<script src="http://html5shim.googlecode.com/svn/trunk/httpml5.js"></script>\n	<![endif]-->\n	<!-- Favicons\n	================================================== -->\n	<link rel="shortcut icon" href="images/favicon.ico">\n	<link rel="apple-touch-icon" href="images/apple-touch-icon.png">\n	<link rel="apple-touch-icon" sizes="72x72" href="images/apple-touch-icon-72x72.png">\n	<link rel="apple-touch-icon" sizes="114x114" href="images/apple-touch-icon-114x114.png">\n</head><body>\n\n<div id="page">\n\n\n		<div class="light_gray_bg small_padding pix_builder_bg" id="section_text_2">\n            <div class="container">\n                <div class="eight columns alpha mobile_center">\n                    <img class="extra_small_padding padding_left_10" src="images/main/logo.png" alt="">\n                </div>\n                <div class="eight columns omega right_text mobile_center">\n                    <a href="#" class="pix_button btn_normal small_wide_button small_bold bold_text orange_bg ">\n                        <span>Buy Tickets</span>\n                    </a> \n                </div>\n            </div>\n        </div>\n\n\n        <div class="" id="section_header_1">\n            <div class="header_style header_nav_1 pix_builder_bg">\n                <div class="container">\n                    <div class="sixteen columns firas2">\n                        <nav role="navigation" class="navbar navbar-white navbar-embossed navbar-lg pix_nav_1">\n                            <div class="containerss">                            \n                                <div class="navbar-header">\n                                    <button data-target="#navbar-collapse-02" data-toggle="collapse" class="navbar-toggle" type="button">\n                                        <span class="sr-only">Toggle navigation</span>\n                                    </button>\n                                    \n                                </div>\n                                <div class="padding_25 right_socials">\n                                        <ul class="bottom-icons">\n                                            <li><a class="pi pixicon-facebook2 light_gray" href="#fakelink"></a></li>\n                                            <li><a class="pi pixicon-twitter2 light_gray" href="#fakelink"></a></li>\n                                            <li><a class="pi pixicon-instagram light_gray" href="#fakelink"></a></li>\n                                        </ul>\n                                    </div>\n                                <div id="navbar-collapse-02" class="collapse navbar-collapse">\n                                    <ul class="nav navbar-nav navbar-left">\n                                        <li class="active propClone"><a href="#">Home</a></li>\n                                        <li class="propClone"><a href="#">Work</a></li>\n                                        <li class="propClone"><a href="#">Blog</a></li>\n                                        <li class="propClone"><a href="#">Contact</a></li>\n                                    </ul>\n                                </div><!-- /.navbar-collapse -->\n                            </div><!-- /.container -->\n                        </nav>\n                    </div>\n                </div><!-- container -->\n            </div>\n        </div>\n</div>\n\n<script src="js/jquery-1.8.3.min.js" type="text/javascript"></script>\n<script src="jsfiles/jquery.easing.1.3.js" type="text/javascript"></script>\n<script src="jsfiles/jquery.common.min.js" type="text/javascript"></script>\n<script src="jsfiles/jquery.ui.touch-punch.min.js"></script>\n<script src="jsfiles/ticker.js" type="text/javascript"></script>\n<script src="jsfiles/bootstrap.min.js"></script>\n<script src="jsfiles/bootstrap-switch.js"></script>\n<script src="assets/js/appear.min.js" type="text/javascript"></script>\n<script src="jsfiles/custom.js" type="text/javascript"></script>\n<script src="jsfiles/custom3.js" type="text/javascript"></script>\n\n\n</body>', 178, NULL, '', 0, 1, '2017-03-30 10:03:38', '2017-03-30 10:04:36'),
(17, 1, 1, '<html><head>\n	<!-- Basic Page Needs\n    ================================================== -->\n	<meta charset="utf-8">\n	<title>FLATPACK</title>\n	<meta name="description" content="">\n	<meta name="author" content="">\n	<!-- Mobile Specific Metas\n    ================================================== -->\n	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">\n	<!-- CSS\n    ================================================== -->\n	<link rel="stylesheet" href="stylesheets/menu.css">\n    <link rel="stylesheet" href="stylesheets/flat-ui-slider.css">\n    <link rel="stylesheet" href="stylesheets/base.css">\n    <link rel="stylesheet" href="stylesheets/skeleton.css">\n    <link rel="stylesheet" href="stylesheets/landings.css">\n    <link rel="stylesheet" href="stylesheets/main.css">\n    <link rel="stylesheet" href="stylesheets/landings_layouts.css">\n    <link rel="stylesheet" href="stylesheets/box.css">\n    <link rel="stylesheet" href="stylesheets/pixicon.css">\n	<!--[if lt IE 9]>\n		<script src="http://html5shim.googlecode.com/svn/trunk/httpml5.js"></script>\n	<![endif]-->\n	<!-- Favicons\n	================================================== -->\n	<link rel="shortcut icon" href="images/favicon.ico">\n	<link rel="apple-touch-icon" href="images/apple-touch-icon.png">\n	<link rel="apple-touch-icon" sizes="72x72" href="images/apple-touch-icon-72x72.png">\n	<link rel="apple-touch-icon" sizes="114x114" href="images/apple-touch-icon-114x114.png">\n</head><body>\n\n<div id="page">\n\n\n		<div class="light_gray_bg small_padding pix_builder_bg" id="section_text_2">\n            <div class="container">\n                <div class="eight columns alpha mobile_center">\n                    <img class="extra_small_padding padding_left_10" src="images/main/logo.png" alt="" data-selector="img" style="">\n                </div>\n                <div class="eight columns omega right_text mobile_center">\n                    <a href="#" class="pix_button btn_normal small_wide_button small_bold bold_text orange_bg ">\n                        <span>Buy Tickets</span>\n                    </a> \n                </div>\n            </div>\n        </div>\n\n\n        <div class="" id="section_header_1">\n            <div class="header_style header_nav_1 pix_builder_bg">\n                <div class="container">\n                    <div class="sixteen columns firas2">\n                        <nav role="navigation" class="navbar navbar-white navbar-embossed navbar-lg pix_nav_1">\n                            <div class="containerss">                            \n                                <div class="navbar-header">\n                                    <button data-target="#navbar-collapse-02" data-toggle="collapse" class="navbar-toggle" type="button" style="outline: none; cursor: inherit;">\n                                        <span class="sr-only">Toggle navigation</span>\n                                    </button>\n                                    \n                                </div>\n                                <div class="padding_25 right_socials">\n                                        <ul class="bottom-icons">\n                                            <li><a class="pi pixicon-facebook2 light_gray" href="#fakelink" data-selector="nav a, a.edit" style="outline: none; cursor: inherit;"></a></li>\n                                            <li><a class="pi pixicon-twitter2 light_gray" href="#fakelink" data-selector="nav a, a.edit" style="outline: none; cursor: inherit;"></a></li>\n                                            <li><a class="pi pixicon-instagram light_gray" href="#fakelink" data-selector="nav a, a.edit" style="outline: none; cursor: inherit;"></a></li>\n                                        </ul>\n                                    </div>\n                                <div id="navbar-collapse-02" class="collapse navbar-collapse">\n                                    <ul class="nav navbar-nav navbar-left">\n                                        <li class="active propClone"><a href="#" data-selector="nav a, a.edit" style="outline: none; cursor: inherit;">Home</a></li>\n                                        <li class="propClone"><a href="#" data-selector="nav a, a.edit" style="color: rgb(0, 0, 0); font-weight: bold; text-transform: none; outline: none; cursor: inherit;">Hoàn gà</a></li>\n                                        <li class="propClone"><a href="#" data-selector="nav a, a.edit" style="">Blog</a></li>\n                                        <li class="propClone"><a href="#" data-selector="nav a, a.edit" style="">Contact</a></li>\n                                    </ul>\n                                </div><!-- /.navbar-collapse -->\n                            </div><!-- /.container -->\n                        </nav>\n                    </div>\n                </div><!-- container -->\n            </div>\n        </div>\n</div>\n\n<script src="js/jquery-1.8.3.min.js" type="text/javascript"></script>\n<script src="jsfiles/jquery.easing.1.3.js" type="text/javascript"></script>\n<script src="jsfiles/jquery.common.min.js" type="text/javascript"></script>\n<script src="jsfiles/jquery.ui.touch-punch.min.js"></script>\n<script src="jsfiles/ticker.js" type="text/javascript"></script>\n<script src="jsfiles/bootstrap.min.js"></script>\n<script src="jsfiles/bootstrap-switch.js"></script>\n<script src="assets/js/appear.min.js" type="text/javascript"></script>\n<script src="jsfiles/custom.js" type="text/javascript"></script>\n<script src="jsfiles/custom3.js" type="text/javascript"></script>\n\n\n</body>', 178, NULL, '', 0, 1, '2017-03-30 10:04:36', '2017-03-30 10:05:05'),
(18, 1, 1, '<html><head>\n	<!-- Basic Page Needs\n    ================================================== -->\n	<meta charset="utf-8">\n	<title>FLATPACK</title>\n	<meta name="description" content="">\n	<meta name="author" content="">\n	<!-- Mobile Specific Metas\n    ================================================== -->\n	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">\n	<!-- CSS\n    ================================================== -->\n	<link rel="stylesheet" href="stylesheets/menu.css">\n    <link rel="stylesheet" href="stylesheets/flat-ui-slider.css">\n    <link rel="stylesheet" href="stylesheets/base.css">\n    <link rel="stylesheet" href="stylesheets/skeleton.css">\n    <link rel="stylesheet" href="stylesheets/landings.css">\n    <link rel="stylesheet" href="stylesheets/main.css">\n    <link rel="stylesheet" href="stylesheets/landings_layouts.css">\n    <link rel="stylesheet" href="stylesheets/box.css">\n    <link rel="stylesheet" href="stylesheets/pixicon.css">\n	<!--[if lt IE 9]>\n		<script src="http://html5shim.googlecode.com/svn/trunk/httpml5.js"></script>\n	<![endif]-->\n	<!-- Favicons\n	================================================== -->\n	<link rel="shortcut icon" href="images/favicon.ico">\n	<link rel="apple-touch-icon" href="images/apple-touch-icon.png">\n	<link rel="apple-touch-icon" sizes="72x72" href="images/apple-touch-icon-72x72.png">\n	<link rel="apple-touch-icon" sizes="114x114" href="images/apple-touch-icon-114x114.png">\n</head><body>\n\n<div id="page">\n\n\n		<div class="light_gray_bg small_padding pix_builder_bg" id="section_text_2">\n            <div class="container">\n                <div class="eight columns alpha mobile_center">\n                    <img class="extra_small_padding padding_left_10" src="images/main/logo.png" alt="" data-selector="img" style="">\n                </div>\n                <div class="eight columns omega right_text mobile_center">\n                    <a href="#" class="pix_button btn_normal small_wide_button small_bold bold_text orange_bg ">\n                        <span>Buy Tickets</span>\n                    </a> \n                </div>\n            </div>\n        </div>\n\n\n        <div class="" id="section_header_1">\n            <div class="header_style header_nav_1 pix_builder_bg">\n                <div class="container">\n                    <div class="sixteen columns firas2">\n                        <nav role="navigation" class="navbar navbar-white navbar-embossed navbar-lg pix_nav_1">\n                            <div class="containerss">                            \n                                <div class="navbar-header">\n                                    <button data-target="#navbar-collapse-02" data-toggle="collapse" class="navbar-toggle" type="button" style="outline: none; cursor: inherit;">\n                                        <span class="sr-only">Toggle navigation</span>\n                                    </button>\n                                    \n                                </div>\n                                <div class="padding_25 right_socials">\n                                        <ul class="bottom-icons">\n                                            <li><a class="pi pixicon-facebook2 light_gray" href="#fakelink" data-selector="nav a, a.edit" style=""></a></li>\n                                            <li><a class="pi pixicon-twitter2 light_gray" href="#fakelink" data-selector="nav a, a.edit" style="outline: none; cursor: inherit;"></a></li>\n                                            <li><a class="pi pixicon-instagram light_gray" href="#fakelink" data-selector="nav a, a.edit" style="outline: none; cursor: inherit;"></a></li>\n                                        </ul>\n                                    </div>\n                                <div id="navbar-collapse-02" class="collapse navbar-collapse">\n                                    <ul class="nav navbar-nav navbar-left">\n                                        <li class="active propClone"><a href="#" data-selector="nav a, a.edit" style="">Home</a></li>\n                                        <li class="propClone"><a href="#" data-selector="nav a, a.edit" style="color: rgb(0, 0, 0); font-weight: bold; text-transform: none; outline: none; cursor: inherit;">Hoàn gà</a></li>\n                                        <li class="propClone"><a href="#" data-selector="nav a, a.edit" style="">Blog</a></li>\n                                        <li class="propClone"><a href="#" data-selector="nav a, a.edit" style="">Contact</a></li>\n                                    </ul>\n                                </div><!-- /.navbar-collapse -->\n                            </div><!-- /.container -->\n                        </nav>\n                    </div>\n                </div><!-- container -->\n            </div>\n        </div>\n</div>\n\n<script src="js/jquery-1.8.3.min.js" type="text/javascript"></script>\n<script src="jsfiles/jquery.easing.1.3.js" type="text/javascript"></script>\n<script src="jsfiles/jquery.common.min.js" type="text/javascript"></script>\n<script src="jsfiles/jquery.ui.touch-punch.min.js"></script>\n<script src="jsfiles/ticker.js" type="text/javascript"></script>\n<script src="jsfiles/bootstrap.min.js"></script>\n<script src="jsfiles/bootstrap-switch.js"></script>\n<script src="assets/js/appear.min.js" type="text/javascript"></script>\n<script src="jsfiles/custom.js" type="text/javascript"></script>\n<script src="jsfiles/custom3.js" type="text/javascript"></script>\n\n\n</body>', 178, NULL, '', 0, 1, '2017-03-30 10:05:05', '2017-03-31 03:19:33');
INSERT INTO `frames` (`id`, `page_id`, `site_id`, `content`, `height`, `original_url`, `loaderfunction`, `sandbox`, `revision`, `created_at`, `updated_at`) VALUES
(19, 1, 1, '<html><head>\n	<!-- Basic Page Needs\n    ================================================== -->\n	<meta charset="utf-8">\n	<title>FLATPACK</title>\n	<meta name="description" content="">\n	<meta name="author" content="">\n	<!-- Mobile Specific Metas\n    ================================================== -->\n	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">\n	<!-- CSS\n    ================================================== -->\n	<link rel="stylesheet" href="stylesheets/menu.css">\n    <link rel="stylesheet" href="stylesheets/flat-ui-slider.css">\n    <link rel="stylesheet" href="stylesheets/base.css">\n    <link rel="stylesheet" href="stylesheets/skeleton.css">\n    <link rel="stylesheet" href="stylesheets/landings.css">\n    <link rel="stylesheet" href="stylesheets/main.css">\n    <link rel="stylesheet" href="stylesheets/landings_layouts.css">\n    <link rel="stylesheet" href="stylesheets/box.css">\n    <link rel="stylesheet" href="stylesheets/pixicon.css">\n\n	<!--[if lt IE 9]>\n		<script src="http://html5shim.googlecode.com/svn/trunk/httpml5.js"></script>\n	<![endif]-->\n	<!-- Favicons\n	================================================== -->\n	<link rel="shortcut icon" href="images/favicon.ico">\n	<link rel="apple-touch-icon" href="images/apple-touch-icon.png">\n	<link rel="apple-touch-icon" sizes="72x72" href="images/apple-touch-icon-72x72.png">\n	<link rel="apple-touch-icon" sizes="114x114" href="images/apple-touch-icon-114x114.png">\n</head><body>\n\n<div id="page">\n    <div class="pix_builder_bg hl1" id="section_highlight_1">\n        <div class="big_padding highlight-section">\n            <div class="highlight-left pix_builder_bg"></div>\n            <div class="container ">\n                <div class="sixteen columns ">\n                    <div class="eight columns alpha">\n                        <div class="highlight_inner">\n                            <p class="big_title editContent">Restaurant High Quality Services</p>\n                            <p class="bold_text margin_bottom normal_text orange editContent">BOOK YOUR SEAT ONLINE</p>\n                            <p class="normal_text light_gray editContent">Lorem ipsum dolor sit amet consectetur adipiscing elit sed do eiusmod tempor incididunt ut labore et dolore magna aliqua Ut enim ad minim veniam quis nostrud exercitation ullamco laboris nisi ut aliquip ex commodo consequat Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat.</p>\n                            <a href="#" class="pix_button pix_button_line brown bold_text editContent"><i class="pi pixicon-ribbon"></i> Bookmark Recipes</a>\n                            </div>\n                    </div>                 \n                    <div class="eight columns omega ">\n                        \n                    </div>\n                </div>\n           </div>\n        </div>\n    </div>\n</div>\n\n<script src="js/jquery-1.8.3.min.js" type="text/javascript"></script>\n<script src="jsfiles/jquery.easing.1.3.js" type="text/javascript"></script>\n<script src="jsfiles/jquery.common.min.js" type="text/javascript"></script>\n<script src="jsfiles/jquery.ui.touch-punch.min.js"></script>\n<script src="jsfiles/ticker.js" type="text/javascript"></script>\n<script src="jsfiles/bootstrap.min.js"></script>\n<script src="jsfiles/bootstrap-switch.js"></script>\n<script src="assets/js/appear.min.js" type="text/javascript"></script>\n<script src="jsfiles/custom.js" type="text/javascript"></script>\n<script src="jsfiles/custom3.js" type="text/javascript"></script>\n\n</body>', 500, NULL, '', 0, 1, '2017-03-30 10:05:05', '2017-03-31 03:19:33'),
(20, 1, 1, '<html><head>\n	<!-- Basic Page Needs\n    ================================================== -->\n	<meta charset="utf-8">\n	<title>FLATPACK</title>\n	<meta name="description" content="">\n	<meta name="author" content="">\n	<!-- Mobile Specific Metas\n    ================================================== -->\n	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">\n	<!-- CSS\n    ================================================== -->\n	<link rel="stylesheet" href="stylesheets/menu.css">\n    <link rel="stylesheet" href="stylesheets/flat-ui-slider.css">\n    <link rel="stylesheet" href="stylesheets/base.css">\n    <link rel="stylesheet" href="stylesheets/skeleton.css">\n    <link rel="stylesheet" href="stylesheets/landings.css">\n    <link rel="stylesheet" href="stylesheets/main.css">\n    <link rel="stylesheet" href="stylesheets/landings_layouts.css">\n    <link rel="stylesheet" href="stylesheets/box.css">\n    <link rel="stylesheet" href="stylesheets/pixicon.css">\n\n	<!--[if lt IE 9]>\n		<script src="http://html5shim.googlecode.com/svn/trunk/httpml5.js"></script>\n	<![endif]-->\n	<!-- Favicons\n	================================================== -->\n	<link rel="shortcut icon" href="images/favicon.ico">\n	<link rel="apple-touch-icon" href="images/apple-touch-icon.png">\n	<link rel="apple-touch-icon" sizes="72x72" href="images/apple-touch-icon-72x72.png">\n	<link rel="apple-touch-icon" sizes="114x114" href="images/apple-touch-icon-114x114.png">\n</head><body>\n\n<div id="page">\n    <div class="hl2 pix_builder_bg" id="section_highlight_2">\n        <div class="big_padding highlight-section">\n            <div class="highlight-right pix_builder_bg"></div>\n            <div class="container">\n                <div class="sixteen columns">\n                    <div class="eight columns alpha">\n                        <br>\n                    </div>                 \n                    <div class="eight columns omega ">\n                        <div class="highlight_inner">\n                            <p class="big_title editContent">Delicious Meals Weekly in Inbox</p>\n                            <p class="bold_text margin_bottom normal_text orange editContent">OUR SERVICE IS TOTALLY FREE</p>\n                            <p class="normal_text light_gray editContent">Lorem ipsum dolor sit amet consectetur adipiscing elit sed do eiusmod tempor incididunt ut labore et dolore magna aliqua Ut enim ad minim veniam quis nostrud exercitation ullamco laboris nisi ut aliquip ex commodo consequat Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat.</p>\n                            <a href="#" class="pix_button pix_button_line brown bold_text editContent"><i class="pi pixicon-heart"></i>Add to Favorits</a>\n                        </div>\n                    </div>\n                </div>\n           </div>\n        </div>\n    </div>\n</div>\n\n<script src="js/jquery-1.8.3.min.js" type="text/javascript"></script>\n<script src="jsfiles/jquery.easing.1.3.js" type="text/javascript"></script>\n<script src="jsfiles/jquery.common.min.js" type="text/javascript"></script>\n<script src="jsfiles/jquery.ui.touch-punch.min.js"></script>\n<script src="jsfiles/ticker.js" type="text/javascript"></script>\n<script src="jsfiles/bootstrap.min.js"></script>\n<script src="jsfiles/bootstrap-switch.js"></script>\n<script src="assets/js/appear.min.js" type="text/javascript"></script>\n<script src="jsfiles/custom.js" type="text/javascript"></script>\n<script src="jsfiles/custom3.js" type="text/javascript"></script>\n\n</body>', 500, NULL, '', 0, 1, '2017-03-30 10:05:05', '2017-03-31 03:19:33'),
(21, 1, 1, '<html><head>\n    <meta charset="utf-8">\n    <title>FLATPACK</title>\n    <meta name="viewport" content="width=device-width, initial-scale=1.0">\n    <link rel="stylesheet" href="stylesheets/menu.css">\n    <!-- CSS\n    ================================================== -->\n    <link rel="stylesheet" href="stylesheets/menu.css">\n    <link rel="stylesheet" href="stylesheets/flat-ui-slider.css">\n    <link rel="stylesheet" href="stylesheets/base.css">\n    <link rel="stylesheet" href="stylesheets/skeleton.css">\n    <link rel="stylesheet" href="stylesheets/landings.css">\n    <link rel="stylesheet" href="stylesheets/main.css">\n    <link rel="stylesheet" href="stylesheets/landings_layouts.css">\n    <link rel="stylesheet" href="stylesheets/box.css">\n    <link rel="stylesheet" href="stylesheets/pixicon.css">\n    <!--[if lt IE 9]>\n        <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>\n        <![endif]-->\n    <!-- Favicons\n    ================================================== -->\n    <link rel="shortcut icon" href="images/favicon.ico">\n    <link rel="apple-touch-icon" href="images/apple-touch-icon.png">\n    <link rel="apple-touch-icon" sizes="72x72" href="images/apple-touch-icon-72x72.png">\n    <link rel="apple-touch-icon" sizes="114x114" href="images/apple-touch-icon-114x114.png">\n</head><body>\n\n<div id="page">\n    <div class="header_nav_1 dark inter_3_bg pix_builder_bg" id="section_intro_3">\n        <div class="header_style">\n            <div class="container">\n                <div class="sixteen columns firas2">\n                    <nav role="navigation" class="navbar navbar-white navbar-embossed navbar-lg pix_nav_1">\n                        <div class="containerss">\n                            <div class="navbar-header">\n                                <button data-target="#navbar-collapse-02" data-toggle="collapse" class="navbar-toggle" type="button">\n                                    <span class="sr-only">Toggle navigation</span>\n                                </button>\n                                <img src="images/main/logo-dark.png" class="pix_nav_logo" alt="">                \n                            </div>\n                            <div id="navbar-collapse-02" class="collapse navbar-collapse">\n                                <ul class="nav navbar-nav navbar-right">\n                                    <li class="active propClone"><a href="#">Home</a></li>\n                                    <li class="propClone"><a href="#">Work</a></li>\n                                    <li class="propClone"><a href="#">Contact</a></li>\n                                    <li class="propClone icon-item"><a class="pi pixicon-facebook2" href="#fakelink"></a></li>\n                                    <li class="propClone icon-item"><a class="pi pixicon-twitter2" href="#fakelink"></a></li>\n                                    <li class="propClone icon-item"><a class="pi pixicon-instagram" href="#fakelink"></a></li>\n                                </ul>\n                            </div><!-- /.navbar-collapse -->\n                        </div><!-- /.container -->\n                    </nav>\n                </div>\n            </div><!-- container -->\n        </div>\n        <div class="container">\n            <div class="sixteen columns margin_bottom_50 padding_top_60">\n                <div class="twelve offset-by-two columns">\n                    <div class="center_text big_padding">\n                        <p class="big_title bold_text editContent">Restaurant Landing Page</p>\n                        <p class="big_text normal_gray editContent">\n                            From logo design to website development, hand-picked designers and developers are ready to complete.\n                        </p>\n                        <a href="#" class="pix_button pix_button_line white_border_button bold_text big_text btn_big">\n                            <i class="pi pixicon-paper"></i> \n                            <span>Make a Reservation</span>\n                            </a>\n                    </div>\n                </div>\n            </div>\n            <div class="center_text">\n                <a href="#" class="intro_arrow">\n                    <i class="pi pixicon-arrow-down"></i> \n                </a>\n            </div>\n        </div>\n    </div>\n</div>\n\n<script src="js/jquery-1.8.3.min.js" type="text/javascript"></script>\n<script src="jsfiles/jquery.easing.1.3.js" type="text/javascript"></script>\n<script src="jsfiles/jquery.common.min.js" type="text/javascript"></script>\n<script src="jsfiles/jquery.ui.touch-punch.min.js"></script>\n<script src="jsfiles/ticker.js" type="text/javascript"></script>\n<script src="jsfiles/bootstrap.min.js"></script>\n<script src="jsfiles/bootstrap-switch.js"></script>\n<script src="assets/js/appear.min.js" type="text/javascript"></script>\n<script src="jsfiles/custom.js" type="text/javascript"></script>\n<script src="jsfiles/custom3.js" type="text/javascript"></script>\n\n</body>', 632, NULL, '', 0, 1, '2017-03-31 03:19:33', '2017-03-31 03:21:25'),
(22, 1, 1, '<html><head>\n	<!-- Basic Page Needs\n    ================================================== -->\n	<meta charset="utf-8">\n	<title>FLATPACK</title>\n	<meta name="description" content="">\n	<meta name="author" content="">\n	<!-- Mobile Specific Metas\n    ================================================== -->\n	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">\n	<!-- CSS\n    ================================================== -->\n	<link rel="stylesheet" href="stylesheets/menu.css">\n    <link rel="stylesheet" href="stylesheets/flat-ui-slider.css">\n    <link rel="stylesheet" href="stylesheets/base.css">\n    <link rel="stylesheet" href="stylesheets/skeleton.css">\n    <link rel="stylesheet" href="stylesheets/landings.css">\n    <link rel="stylesheet" href="stylesheets/main.css">\n    <link rel="stylesheet" href="stylesheets/landings_layouts.css">\n    <link rel="stylesheet" href="stylesheets/box.css">\n    <link rel="stylesheet" href="stylesheets/pixicon.css">\n\n	<!--[if lt IE 9]>\n		<script src="http://html5shim.googlecode.com/svn/trunk/httpml5.js"></script>\n	<![endif]-->\n	<!-- Favicons\n	================================================== -->\n	<link rel="shortcut icon" href="images/favicon.ico">\n	<link rel="apple-touch-icon" href="images/apple-touch-icon.png">\n	<link rel="apple-touch-icon" sizes="72x72" href="images/apple-touch-icon-72x72.png">\n	<link rel="apple-touch-icon" sizes="114x114" href="images/apple-touch-icon-114x114.png">\n</head><body style="">\n\n<div id="page">\n    <div class="pix_builder_bg hl1" id="section_highlight_1">\n        <div class="big_padding highlight-section">\n            <div class="highlight-left pix_builder_bg"></div>\n            <div class="container ">\n                <div class="sixteen columns ">\n                    <div class="eight columns alpha">\n                        <div class="highlight_inner">\n                            <p class="big_title editContent">Restaurant High Quality Services</p>\n                            <p class="bold_text margin_bottom normal_text orange editContent">BOOK YOUR SEAT ONLINE</p>\n                            <p class="normal_text light_gray editContent">Lorem ipsum dolor sit amet consectetur adipiscing elit sed do eiusmod tempor incididunt ut labore et dolore magna aliqua Ut enim ad minim veniam quis nostrud exercitation ullamco laboris nisi ut aliquip ex commodo consequat Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat.</p>\n                            <a href="#" class="pix_button pix_button_line brown bold_text editContent"><i class="pi pixicon-ribbon"></i> Bookmark Recipes</a>\n                            </div>\n                    </div>                 \n                    <div class="eight columns omega ">\n                        \n                    </div>\n                </div>\n           </div>\n        </div>\n    </div>\n</div>\n\n<script src="js/jquery-1.8.3.min.js" type="text/javascript"></script>\n<script src="jsfiles/jquery.easing.1.3.js" type="text/javascript"></script>\n<script src="jsfiles/jquery.common.min.js" type="text/javascript"></script>\n<script src="jsfiles/jquery.ui.touch-punch.min.js"></script>\n<script src="jsfiles/ticker.js" type="text/javascript"></script>\n<script src="jsfiles/bootstrap.min.js"></script>\n<script src="jsfiles/bootstrap-switch.js"></script>\n<script src="assets/js/appear.min.js" type="text/javascript"></script>\n<script src="jsfiles/custom.js" type="text/javascript"></script>\n<script src="jsfiles/custom3.js" type="text/javascript"></script>\n\n<link rel="stylesheet" type="text/css" property="stylesheet" href="http://localhost:9001/_debugbar/assets/stylesheets?v=1473948356"><script type="text/javascript" src="http://localhost:9001/_debugbar/assets/javascript?v=1473948119"></script><script type="text/javascript">jQuery.noConflict(true);</script>\n<script type="text/javascript">\nvar phpdebugbar = new PhpDebugBar.DebugBar();\nphpdebugbar.addTab("messages", new PhpDebugBar.DebugBar.Tab({"icon":"list-alt","title":"Messages", "widget": new PhpDebugBar.Widgets.MessagesWidget()}));\nphpdebugbar.addIndicator("time", new PhpDebugBar.DebugBar.Indicator({"icon":"clock-o","tooltip":"Request Duration"}), "right");\nphpdebugbar.addTab("timeline", new PhpDebugBar.DebugBar.Tab({"icon":"tasks","title":"Timeline", "widget": new PhpDebugBar.Widgets.TimelineWidget()}));\nphpdebugbar.addIndicator("memory", new PhpDebugBar.DebugBar.Indicator({"icon":"cogs","tooltip":"Memory Usage"}), "right");\nphpdebugbar.addTab("exceptions", new PhpDebugBar.DebugBar.Tab({"icon":"bug","title":"Exceptions", "widget": new PhpDebugBar.Widgets.ExceptionsWidget()}));\nphpdebugbar.addTab("views", new PhpDebugBar.DebugBar.Tab({"icon":"leaf","title":"Views", "widget": new PhpDebugBar.Widgets.TemplatesWidget()}));\nphpdebugbar.addTab("route", new PhpDebugBar.DebugBar.Tab({"icon":"share","title":"Route", "widget": new PhpDebugBar.Widgets.VariableListWidget()}));\nphpdebugbar.addIndicator("currentroute", new PhpDebugBar.DebugBar.Indicator({"icon":"share","tooltip":"Route"}), "right");\nphpdebugbar.addTab("queries", new PhpDebugBar.DebugBar.Tab({"icon":"inbox","title":"Queries", "widget": new PhpDebugBar.Widgets.SQLQueriesWidget()}));\nphpdebugbar.addTab("emails", new PhpDebugBar.DebugBar.Tab({"icon":"inbox","title":"Mails", "widget": new PhpDebugBar.Widgets.MailsWidget()}));\nphpdebugbar.addTab("session", new PhpDebugBar.DebugBar.Tab({"icon":"archive","title":"Session", "widget": new PhpDebugBar.Widgets.VariableListWidget()}));\nphpdebugbar.addTab("request", new PhpDebugBar.DebugBar.Tab({"icon":"tags","title":"Request", "widget": new PhpDebugBar.Widgets.VariableListWidget()}));\nphpdebugbar.setDataMap({\n"messages": ["messages.messages", []],\n"messages:badge": ["messages.count", null],\n"time": ["time.duration_str", \'0ms\'],\n"timeline": ["time", {}],\n"memory": ["memory.peak_usage_str", \'0B\'],\n"exceptions": ["exceptions.exceptions", []],\n"exceptions:badge": ["exceptions.count", null],\n"views": ["views", []],\n"views:badge": ["views.nb_templates", 0],\n"route": ["route", {}],\n"currentroute": ["route.uri", ],\n"queries": ["queries", []],\n"queries:badge": ["queries.nb_statements", 0],\n"emails": ["swiftmailer_mails.mails", []],\n"emails:badge": ["swiftmailer_mails.count", null],\n"session": ["session", {}],\n"request": ["request", {}]\n});\nphpdebugbar.restoreState();\nphpdebugbar.ajaxHandler = new PhpDebugBar.AjaxHandler(phpdebugbar);\nphpdebugbar.ajaxHandler.bindToXHR();\nphpdebugbar.setOpenHandler(new PhpDebugBar.OpenHandler({"url":"http:\\/\\/localhost:9001\\/_debugbar\\/open"}));\nphpdebugbar.addDataSet({"__meta":{"id":"f15d84f6e5dc31519601c41c8e59c6fa","datetime":"2017-03-31 10:19:08","utime":1490930348.41,"method":"GET","uri":"\\/site\\/getframe\\/19","ip":"::1"},"php":{"version":"5.6.25","interface":"apache2handler"},"messages":{"count":0,"messages":[]},"time":{"start":1490930347.67,"end":1490930348.41,"duration":0.740689992905,"duration_str":"740.69ms","measures":[{"label":"Booting","start":1490930347.67,"relative_start":0,"end":1490930348.18,"relative_end":1490930348.18,"duration":0.50679397583,"duration_str":"506.79ms","params":[],"collector":null},{"label":"Application","start":1490930348.06,"relative_start":0.391119003296,"end":1490930348.41,"relative_end":6.19888305664e-6,"duration":0.349577188492,"duration_str":"349.58ms","params":[],"collector":null}]},"memory":{"peak_usage":13107200,"peak_usage_str":"12.5MB"},"exceptions":{"count":0,"exceptions":[]},"views":{"nb_templates":0,"templates":[]},"route":{"uri":"GET site\\/getframe\\/{frame_id}","middleware":"web","as":"getframe","controller":"App\\\\Http\\\\Controllers\\\\SiteController@getFrame","namespace":"App\\\\Http\\\\Controllers","prefix":null,"where":[],"file":"app\\/Http\\/Controllers\\/SiteController.php:355-360"},"queries":{"nb_statements":1,"nb_failed_statements":0,"accumulated_duration":0.00178,"accumulated_duration_str":"1.78ms","statements":[{"sql":"select * from `frames` where `id` = \'19\' limit 1","params":{"0":"19","hints":"Use <code>SELECT *<\\/code> only if you need all columns from table<br \\/><code>LIMIT<\\/code> without <code>ORDER BY<\\/code> causes non-deterministic results, depending on the query execution plan"},"duration":0.00178,"duration_str":"1.78ms","stmt_id":null,"connection":"logistics.system"}]},"swiftmailer_mails":{"count":0,"mails":[]},"session":{"_token":"oOqrHXkGrg1Y0S1bq8ig8l6R9VWrhszjxcS7y8yb","_previous":"array:1 [\\n  \\"url\\" => \\"http:\\/\\/localhost:9001\\/site\\/getframe\\/19\\"\\n]","flash":"array:2 [\\n  \\"old\\" => []\\n  \\"new\\" => []\\n]","login_web_59ba36addc2b2f9401580f014c7f58ea4e30989d":"1","PHPDEBUGBAR_STACK_DATA":"[]","siteID":"1"},"request":{"format":"html","content_type":"text\\/html; charset=UTF-8","status_text":"OK","status_code":"200","request_query":"[]","request_request":"[]","request_headers":"array:9 [\\n  \\"host\\" => array:1 [\\n    0 => \\"localhost:9001\\"\\n  ]\\n  \\"connection\\" => array:1 [\\n    0 => \\"keep-alive\\"\\n  ]\\n  \\"upgrade-insecure-requests\\" => array:1 [\\n    0 => \\"1\\"\\n  ]\\n  \\"user-agent\\" => array:1 [\\n    0 => \\"Mozilla\\/5.0 (Macintosh; Intel Mac OS X 10_11_6) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/56.0.2924.87 Safari\\/537.36\\"\\n  ]\\n  \\"accept\\" => array:1 [\\n    0 => \\"text\\/html,application\\/xhtml+xml,application\\/xml;q=0.9,image\\/webp,*\\/*;q=0.8\\"\\n  ]\\n  \\"referer\\" => array:1 [\\n    0 => \\"http:\\/\\/localhost:9001\\/system\\/landing-page\\/site\\/1\\"\\n  ]\\n  \\"accept-encoding\\" => array:1 [\\n    0 => \\"gzip, deflate, sdch, br\\"\\n  ]\\n  \\"accept-language\\" => array:1 [\\n    0 => \\"vi-VN,vi;q=0.8,fr-FR;q=0.6,fr;q=0.4,en-US;q=0.2,en;q=0.2\\"\\n  ]\\n  \\"cookie\\" => array:1 [\\n    0 => \\"SQLiteManager_currentLangue=2; XSRF-TOKEN=eyJpdiI6ImJQZ3VPc1FBMUtJZE5wVHZsWnJGT1E9PSIsInZhbHVlIjoiQVJOVUpkMTU5RE8zTEk2UEM0RUxvWms4S0ZqRGpSXC9LS1RySUNXNTgzUEVvYmd5TWlHN0JRUnBxYkc0RDI2Y01WRFZBTnRGaCsrUk9mUjIzWDUyUWR3PT0iLCJtYWMiOiJlODNlNDA1OWVmY2MwNzRjOWRlZmYwZmZiMTA1Y2Q4ZTM3M2YxODVhNzg4NGNmY2JmYTJmMWU4N2M1ODFjNmEwIn0%3D; laravel_session=eyJpdiI6IllVXC9GK2FObmRWVzdGWlUxd1lGOTZ3PT0iLCJ2YWx1ZSI6IjdRSzNQRnh1emx5QkdSTlRcL09lNFpzZGhXQnhQOXNEMkU5RWs3WVhteEVqQTVyMTBpNUJrYm95UHE1YW1NblBVelwvb01pQlVpbFc1aG1CWUUySTVrTnc9PSIsIm1hYyI6ImM1NDA3MzliOTAzYjgwODQ0YjU5NmE3ZWY0YjNhN2U5Nzk2MmVkOTQ5ZjdhMTdkNGMyYTg1OGM5Y2Q3M2I2ZWIifQ%3D%3D\\"\\n  ]\\n]","request_server":"array:34 [\\n  \\"REDIRECT_REDIRECT_STATUS\\" => \\"200\\"\\n  \\"REDIRECT_STATUS\\" => \\"200\\"\\n  \\"HTTP_HOST\\" => \\"localhost:9001\\"\\n  \\"HTTP_CONNECTION\\" => \\"keep-alive\\"\\n  \\"HTTP_UPGRADE_INSECURE_REQUESTS\\" => \\"1\\"\\n  \\"HTTP_USER_AGENT\\" => \\"Mozilla\\/5.0 (Macintosh; Intel Mac OS X 10_11_6) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/56.0.2924.87 Safari\\/537.36\\"\\n  \\"HTTP_ACCEPT\\" => \\"text\\/html,application\\/xhtml+xml,application\\/xml;q=0.9,image\\/webp,*\\/*;q=0.8\\"\\n  \\"HTTP_REFERER\\" => \\"http:\\/\\/localhost:9001\\/system\\/landing-page\\/site\\/1\\"\\n  \\"HTTP_ACCEPT_ENCODING\\" => \\"gzip, deflate, sdch, br\\"\\n  \\"HTTP_ACCEPT_LANGUAGE\\" => \\"vi-VN,vi;q=0.8,fr-FR;q=0.6,fr;q=0.4,en-US;q=0.2,en;q=0.2\\"\\n  \\"HTTP_COOKIE\\" => \\"SQLiteManager_currentLangue=2; XSRF-TOKEN=eyJpdiI6ImJQZ3VPc1FBMUtJZE5wVHZsWnJGT1E9PSIsInZhbHVlIjoiQVJOVUpkMTU5RE8zTEk2UEM0RUxvWms4S0ZqRGpSXC9LS1RySUNXNTgzUEVvYmd5TWlHN0JRUnBxYkc0RDI2Y01WRFZBTnRGaCsrUk9mUjIzWDUyUWR3PT0iLCJtYWMiOiJlODNlNDA1OWVmY2MwNzRjOWRlZmYwZmZiMTA1Y2Q4ZTM3M2YxODVhNzg4NGNmY2JmYTJmMWU4N2M1ODFjNmEwIn0%3D; laravel_session=eyJpdiI6IllVXC9GK2FObmRWVzdGWlUxd1lGOTZ3PT0iLCJ2YWx1ZSI6IjdRSzNQRnh1emx5QkdSTlRcL09lNFpzZGhXQnhQOXNEMkU5RWs3WVhteEVqQTVyMTBpNUJrYm95UHE1YW1NblBVelwvb01pQlVpbFc1aG1CWUUySTVrTnc9PSIsIm1hYyI6ImM1NDA3MzliOTAzYjgwODQ0YjU5NmE3ZWY0YjNhN2U5Nzk2MmVkOTQ5ZjdhMTdkNGMyYTg1OGM5Y2Q3M2I2ZWIifQ%3D%3D\\"\\n  \\"PATH\\" => \\"\\/usr\\/bin:\\/bin:\\/usr\\/sbin:\\/sbin\\"\\n  \\"SERVER_SIGNATURE\\" => \\"\\"\\n  \\"SERVER_SOFTWARE\\" => \\"Apache\\/2.2.31 (Unix) mod_wsgi\\/3.5 Python\\/2.7.12 PHP\\/5.6.25 mod_ssl\\/2.2.31 OpenSSL\\/1.0.2h DAV\\/2 mod_fastcgi\\/2.4.6 mod_perl\\/2.0.9 Perl\\/v5.24.0\\"\\n  \\"SERVER_NAME\\" => \\"localhost\\"\\n  \\"SERVER_ADDR\\" => \\"::1\\"\\n  \\"SERVER_PORT\\" => \\"9001\\"\\n  \\"REMOTE_ADDR\\" => \\"::1\\"\\n  \\"DOCUMENT_ROOT\\" => \\"\\/Users\\/phamhung\\/Work\\/Project\\/logistics_system\\"\\n  \\"SERVER_ADMIN\\" => \\"you@example.com\\"\\n  \\"SCRIPT_FILENAME\\" => \\"\\/Users\\/phamhung\\/Work\\/Project\\/logistics_system\\/public\\/index.php\\"\\n  \\"REMOTE_PORT\\" => \\"59356\\"\\n  \\"REDIRECT_URL\\" => \\"\\/public\\/site\\/getframe\\/19\\"\\n  \\"GATEWAY_INTERFACE\\" => \\"CGI\\/1.1\\"\\n  \\"SERVER_PROTOCOL\\" => \\"HTTP\\/1.1\\"\\n  \\"REQUEST_METHOD\\" => \\"GET\\"\\n  \\"QUERY_STRING\\" => \\"\\"\\n  \\"REQUEST_URI\\" => \\"\\/site\\/getframe\\/19\\"\\n  \\"SCRIPT_NAME\\" => \\"\\/public\\/index.php\\"\\n  \\"PHP_SELF\\" => \\"\\/public\\/index.php\\"\\n  \\"REQUEST_TIME_FLOAT\\" => 1490930347.67\\n  \\"REQUEST_TIME\\" => 1490930347\\n  \\"argv\\" => []\\n  \\"argc\\" => 0\\n]","request_cookies":"array:3 [\\n  \\"SQLiteManager_currentLangue\\" => null\\n  \\"XSRF-TOKEN\\" => \\"oOqrHXkGrg1Y0S1bq8ig8l6R9VWrhszjxcS7y8yb\\"\\n  \\"laravel_session\\" => \\"76ea0079831b69bcd6085f38477d11246d31cae8\\"\\n]","response_headers":"array:3 [\\n  \\"cache-control\\" => array:1 [\\n    0 => \\"no-cache\\"\\n  ]\\n  \\"content-type\\" => array:1 [\\n    0 => \\"text\\/html; charset=UTF-8\\"\\n  ]\\n  \\"Set-Cookie\\" => array:2 [\\n    0 => \\"XSRF-TOKEN=eyJpdiI6InI1TUpHSGc4OVRQUXV5WlN0SWM1TXc9PSIsInZhbHVlIjoia29HR09XQ3Z1XC9VekZlRElUSDh5S1hKbHJJTmtwclg5QWIyaDRWZVwvQWlDdXFYbmdlRVAzbHBIU2pxS2JEODBlcjluQVhHSm1ldklpN3l0ZjNyNmwzUT09IiwibWFjIjoiYTJkMTRmMDJmYzFiMmQxMzIxYTFjOTg0YTE4MmQ3ZGIzYTBkNmQwMGUwOTlkZTg1Y2E4YzFjMWU0NmUwNmQxOCJ9; expires=Fri, 31-Mar-2017 05:19:08 GMT; path=\\/\\"\\n    1 => \\"laravel_session=eyJpdiI6ImEzWlBqUHlmTWJlcVQ5OCt6WTFKRnc9PSIsInZhbHVlIjoidU5ZNTRSV0o2dmZnTmJXWWRzSEtXQnZLR3RReHdcL0Zya3Ntc1hRWnozWm5rUGlYQ29zT21vM3N2SnBEZUY5K1VZM3FWQzZjU2hLWE5IdkVLZ2lZWmhBPT0iLCJtYWMiOiIxYmRiYjMzMTUwMmNkZjFiNzNjNWI5ZGZkZWY3ODBkM2JiZjJmNmFjNjllOWJmZGVjOTQ2ODE5MWJlOWFmODQ4In0%3D; expires=Fri, 31-Mar-2017 05:19:08 GMT; path=\\/; httponly\\"\\n  ]\\n]","path_info":"\\/site\\/getframe\\/19","session_attributes":"array:6 [\\n  \\"_token\\" => \\"oOqrHXkGrg1Y0S1bq8ig8l6R9VWrhszjxcS7y8yb\\"\\n  \\"_previous\\" => array:1 [\\n    \\"url\\" => \\"http:\\/\\/localhost:9001\\/site\\/getframe\\/19\\"\\n  ]\\n  \\"flash\\" => array:2 [\\n    \\"old\\" => []\\n    \\"new\\" => []\\n  ]\\n  \\"login_web_59ba36addc2b2f9401580f014c7f58ea4e30989d\\" => 1\\n  \\"PHPDEBUGBAR_STACK_DATA\\" => []\\n  \\"siteID\\" => \\"1\\"\\n]"}}, "f15d84f6e5dc31519601c41c8e59c6fa");\n\n</script><div class="phpdebugbar phpdebugbar-minimized phpdebugbar-closed"><div class="phpdebugbar-drag-capture"></div><div class="phpdebugbar-resize-handle" style="display: none;"></div><div class="phpdebugbar-header" style="display: none;"><div class="phpdebugbar-header-left"><a class="phpdebugbar-tab"><i class="phpdebugbar-fa phpdebugbar-fa-list-alt"></i><span class="phpdebugbar-text">Messages</span><span class="phpdebugbar-badge" style="display: none;"></span></a><a class="phpdebugbar-tab"><i class="phpdebugbar-fa phpdebugbar-fa-tasks"></i><span class="phpdebugbar-text">Timeline</span><span class="phpdebugbar-badge"></span></a><a class="phpdebugbar-tab"><i class="phpdebugbar-fa phpdebugbar-fa-bug"></i><span class="phpdebugbar-text">Exceptions</span><span class="phpdebugbar-badge" style="display: none;"></span></a><a class="phpdebugbar-tab"><i class="phpdebugbar-fa phpdebugbar-fa-leaf"></i><span class="phpdebugbar-text">Views</span><span class="phpdebugbar-badge" style="display: inline;">0</span></a><a class="phpdebugbar-tab"><i class="phpdebugbar-fa phpdebugbar-fa-share"></i><span class="phpdebugbar-text">Route</span><span class="phpdebugbar-badge"></span></a><a class="phpdebugbar-tab"><i class="phpdebugbar-fa phpdebugbar-fa-inbox"></i><span class="phpdebugbar-text">Queries</span><span class="phpdebugbar-badge" style="display: inline;">1</span></a><a class="phpdebugbar-tab"><i class="phpdebugbar-fa phpdebugbar-fa-inbox"></i><span class="phpdebugbar-text">Mails</span><span class="phpdebugbar-badge" style="display: none;"></span></a><a class="phpdebugbar-tab"><i class="phpdebugbar-fa phpdebugbar-fa-archive"></i><span class="phpdebugbar-text">Session</span><span class="phpdebugbar-badge"></span></a><a class="phpdebugbar-tab"><i class="phpdebugbar-fa phpdebugbar-fa-tags"></i><span class="phpdebugbar-text">Request</span><span class="phpdebugbar-badge"></span></a></div><div class="phpdebugbar-header-right"><a class="phpdebugbar-close-btn"></a><a class="phpdebugbar-minimize-btn"></a><a class="phpdebugbar-maximize-btn"></a><a class="phpdebugbar-open-btn" style="display: block;"></a><select class="phpdebugbar-datasets-switcher"><option value="f15d84f6e5dc31519601c41c8e59c6fa">#1 19 (10:19:08)</option></select><span class="phpdebugbar-indicator"><i class="phpdebugbar-fa phpdebugbar-fa-clock-o"></i><span class="phpdebugbar-text">740.69ms</span><span class="phpdebugbar-tooltip">Request Duration</span></span><span class="phpdebugbar-indicator"><i class="phpdebugbar-fa phpdebugbar-fa-cogs"></i><span class="phpdebugbar-text">12.5MB</span><span class="phpdebugbar-tooltip">Memory Usage</span></span><span class="phpdebugbar-indicator"><i class="phpdebugbar-fa phpdebugbar-fa-share"></i><span class="phpdebugbar-text">GET site/getframe/{frame_id}</span><span class="phpdebugbar-tooltip">Route</span></span></div></div><div class="phpdebugbar-body" style="height: 40px; display: none;"><div class="phpdebugbar-panel"><div class="phpdebugbar-widgets-messages"><ul class="phpdebugbar-widgets-list"></ul><div class="phpdebugbar-widgets-toolbar"><i class="phpdebugbar-fa phpdebugbar-fa-search"></i><input type="text"></div></div></div><div class="phpdebugbar-panel"><ul class="phpdebugbar-widgets-timeline"><li><div class="phpdebugbar-widgets-measure"><span class="phpdebugbar-widgets-value" style="left: 0%; width: 68.42%;"></span><span class="phpdebugbar-widgets-label">Booting (506.79ms)</span></div></li><li><div class="phpdebugbar-widgets-measure"><span class="phpdebugbar-widgets-value" style="left: 52.8%; width: 47.2%;"></span><span class="phpdebugbar-widgets-label">Application (349.58ms)</span></div></li></ul></div><div class="phpdebugbar-panel"><div class="phpdebugbar-widgets-exceptions"><ul class="phpdebugbar-widgets-list"></ul></div></div><div class="phpdebugbar-panel"><div class="phpdebugbar-widgets-templates"><div class="phpdebugbar-widgets-status"><span>0 templates were rendered</span></div><ul class="phpdebugbar-widgets-list"></ul></div></div><div class="phpdebugbar-panel"><dl class="phpdebugbar-widgets-kvlist phpdebugbar-widgets-varlist"><dt class="phpdebugbar-widgets-key"><span title="uri">uri</span></dt><dd class="phpdebugbar-widgets-value">GET site/getframe/{frame_id}</dd><dt class="phpdebugbar-widgets-key"><span title="middleware">middleware</span></dt><dd class="phpdebugbar-widgets-value">web</dd><dt class="phpdebugbar-widgets-key"><span title="as">as</span></dt><dd class="phpdebugbar-widgets-value">getframe</dd><dt class="phpdebugbar-widgets-key"><span title="controller">controller</span></dt><dd class="phpdebugbar-widgets-value">App\\Http\\Controllers\\SiteController@getFrame</dd><dt class="phpdebugbar-widgets-key"><span title="namespace">namespace</span></dt><dd class="phpdebugbar-widgets-value">App\\Http\\Controllers</dd><dt class="phpdebugbar-widgets-key"><span title="prefix">prefix</span></dt><dd class="phpdebugbar-widgets-value">null</dd><dt class="phpdebugbar-widgets-key"><span title="where">where</span></dt><dd class="phpdebugbar-widgets-value"></dd><dt class="phpdebugbar-widgets-key"><span title="file">file</span></dt><dd class="phpdebugbar-widgets-value">app/Http/Controllers/SiteController.php:355-360</dd></dl></div><div class="phpdebugbar-panel"><div class="phpdebugbar-widgets-sqlqueries"><div class="phpdebugbar-widgets-status"><span>1 statements were executed</span><span title="Accumulated duration" class="phpdebugbar-widgets-duration">1.78ms</span></div><div class="phpdebugbar-widgets-toolbar"><a class="phpdebugbar-widgets-filter" rel="logistics.system">logistics.system</a></div><ul class="phpdebugbar-widgets-list"><li class="phpdebugbar-widgets-list-item" connection="logistics.system" style="cursor: pointer;"><code class="phpdebugbar-widgets-sql"><span class="hljs-operator"><span class="hljs-keyword">select</span> * <span class="hljs-keyword">from</span> <span class="hljs-string">`frames`</span> <span class="hljs-keyword">where</span> <span class="hljs-string">`id`</span> = <span class="hljs-string">\'19\'</span> limit <span class="hljs-number">1</span></span></code><span title="Duration" class="phpdebugbar-widgets-duration">1.78ms</span><span title="Connection" class="phpdebugbar-widgets-database">logistics.system</span><table class="phpdebugbar-widgets-params"><tbody><tr><th colspan="2">Params</th></tr><tr><td class="phpdebugbar-widgets-name">0</td><td class="phpdebugbar-widgets-value">19</td></tr><tr><td class="phpdebugbar-widgets-name">hints</td><td class="phpdebugbar-widgets-value">Use <code>SELECT *</code> only if you need all columns from table<br><code>LIMIT</code> without <code>ORDER BY</code> causes non-deterministic results, depending on the query execution plan</td></tr></tbody></table></li></ul></div></div><div class="phpdebugbar-panel"><div class="phpdebugbar-widgets-mails"><ul class="phpdebugbar-widgets-list"></ul></div></div><div class="phpdebugbar-panel"><dl class="phpdebugbar-widgets-kvlist phpdebugbar-widgets-varlist"><dt class="phpdebugbar-widgets-key"><span title="_token">_token</span></dt><dd class="phpdebugbar-widgets-value">oOqrHXkGrg1Y0S1bq8ig8l6R9VWrhszjxcS7y8yb</dd><dt class="phpdebugbar-widgets-key"><span title="_previous">_previous</span></dt><dd class="phpdebugbar-widgets-value">array:1 [\n  "url" =&gt; "http://localhost:9001/site/getframe/19"\n]</dd><dt class="phpdebugbar-widgets-key"><span title="flash">flash</span></dt><dd class="phpdebugbar-widgets-value">array:2 [\n  "old" =&gt; []\n  "new" =&gt; []\n]</dd><dt class="phpdebugbar-widgets-key"><span title="login_web_59ba36addc2b2f9401580f014c7f58ea4e30989d">login_web_59ba36addc2b2f9401580f014c7f58ea4e30989d</span></dt><dd class="phpdebugbar-widgets-value">1</dd><dt class="phpdebugbar-widgets-key"><span title="PHPDEBUGBAR_STACK_DATA">PHPDEBUGBAR_STACK_DATA</span></dt><dd class="phpdebugbar-widgets-value">[]</dd><dt class="phpdebugbar-widgets-key"><span title="siteID">siteID</span></dt><dd class="phpdebugbar-widgets-value">1</dd></dl></div><div class="phpdebugbar-panel"><dl class="phpdebugbar-widgets-kvlist phpdebugbar-widgets-varlist"><dt class="phpdebugbar-widgets-key"><span title="format">format</span></dt><dd class="phpdebugbar-widgets-value">html</dd><dt class="phpdebugbar-widgets-key"><span title="content_type">content_type</span></dt><dd class="phpdebugbar-widgets-value">text/html; charset=UTF-8</dd><dt class="phpdebugbar-widgets-key"><span title="status_text">status_text</span></dt><dd class="phpdebugbar-widgets-value">OK</dd><dt class="phpdebugbar-widgets-key"><span title="status_code">status_code</span></dt><dd class="phpdebugbar-widgets-value">200</dd><dt class="phpdebugbar-widgets-key"><span title="request_query">request_query</span></dt><dd class="phpdebugbar-widgets-value">[]</dd><dt class="phpdebugbar-widgets-key"><span title="request_request">request_request</span></dt><dd class="phpdebugbar-widgets-value">[]</dd><dt class="phpdebugbar-widgets-key"><span title="request_headers">request_headers</span></dt><dd class="phpdebugbar-widgets-value">array:9 [\n  "host" =&gt; array:1 [\n    0 =&gt; "localhost:9001"\n  ]\n  "connection" =&gt; array:1 [\n    0 =&gt; "...</dd><dt class="phpdebugbar-widgets-key"><span title="request_server">request_server</span></dt><dd class="phpdebugbar-widgets-value">array:34 [\n  "REDIRECT_REDIRECT_STATUS" =&gt; "200"\n  "REDIRECT_STATUS" =&gt; "200"\n  "HTTP_HOST" =&gt; "loca...</dd><dt class="phpdebugbar-widgets-key"><span title="request_cookies">request_cookies</span></dt><dd class="phpdebugbar-widgets-value">array:3 [\n  "SQLiteManager_currentLangue" =&gt; null\n  "XSRF-TOKEN" =&gt; "oOqrHXkGrg1Y0S1bq8ig8l6R9VWrhsz...</dd><dt class="phpdebugbar-widgets-key"><span title="response_headers">response_headers</span></dt><dd class="phpdebugbar-widgets-value">array:3 [\n  "cache-control" =&gt; array:1 [\n    0 =&gt; "no-cache"\n  ]\n  "content-type" =&gt; array:1 [\n    0...</dd><dt class="phpdebugbar-widgets-key"><span title="path_info">path_info</span></dt><dd class="phpdebugbar-widgets-value">/site/getframe/19</dd><dt class="phpdebugbar-widgets-key"><span title="session_attributes">session_attributes</span></dt><dd class="phpdebugbar-widgets-value">array:6 [\n  "_token" =&gt; "oOqrHXkGrg1Y0S1bq8ig8l6R9VWrhszjxcS7y8yb"\n  "_previous" =&gt; array:1 [\n    "u...</dd></dl></div></div><a class="phpdebugbar-restore-btn" style=""></a></div><div class="phpdebugbar-openhandler" style="display: none;"><div class="phpdebugbar-openhandler-header">PHP DebugBar | Open<a><i class="phpdebugbar-fa phpdebugbar-fa-times"></i></a></div><table><thead><tr><th width="150">Date</th><th width="55">Method</th><th>URL</th><th width="125">IP</th><th width="100">Filter data</th></tr></thead><tbody></tbody></table><div class="phpdebugbar-openhandler-actions"><a>Load more</a><a>Show only current URL</a><a>Show all</a><a>Delete all</a><form><br><b>Filter results</b><br>Method: <select name="method"><option></option><option>GET</option><option>POST</option><option>PUT</option><option>DELETE</option></select><br>Uri: <input type="text" name="uri"><br>IP: <input type="text" name="ip"><br><button type="submit">Search</button></form></div></div><div class="phpdebugbar-openhandler-overlay" style="display: none;"></div>\n</body>', 500, NULL, '', 0, 1, '2017-03-31 03:19:33', '2017-03-31 03:21:25');
INSERT INTO `frames` (`id`, `page_id`, `site_id`, `content`, `height`, `original_url`, `loaderfunction`, `sandbox`, `revision`, `created_at`, `updated_at`) VALUES
(23, 1, 1, '<html><head>\n	<!-- Basic Page Needs\n    ================================================== -->\n	<meta charset="utf-8">\n	<title>FLATPACK</title>\n	<meta name="description" content="">\n	<meta name="author" content="">\n	<!-- Mobile Specific Metas\n    ================================================== -->\n	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">\n	<!-- CSS\n    ================================================== -->\n	<link rel="stylesheet" href="stylesheets/menu.css">\n    <link rel="stylesheet" href="stylesheets/flat-ui-slider.css">\n    <link rel="stylesheet" href="stylesheets/base.css">\n    <link rel="stylesheet" href="stylesheets/skeleton.css">\n    <link rel="stylesheet" href="stylesheets/landings.css">\n    <link rel="stylesheet" href="stylesheets/main.css">\n    <link rel="stylesheet" href="stylesheets/landings_layouts.css">\n    <link rel="stylesheet" href="stylesheets/box.css">\n    <link rel="stylesheet" href="stylesheets/pixicon.css">\n\n	<!--[if lt IE 9]>\n		<script src="http://html5shim.googlecode.com/svn/trunk/httpml5.js"></script>\n	<![endif]-->\n	<!-- Favicons\n	================================================== -->\n	<link rel="shortcut icon" href="images/favicon.ico">\n	<link rel="apple-touch-icon" href="images/apple-touch-icon.png">\n	<link rel="apple-touch-icon" sizes="72x72" href="images/apple-touch-icon-72x72.png">\n	<link rel="apple-touch-icon" sizes="114x114" href="images/apple-touch-icon-114x114.png">\n</head><body style="">\n\n<div id="page">\n    <div class="hl2 pix_builder_bg" id="section_highlight_2">\n        <div class="big_padding highlight-section">\n            <div class="highlight-right pix_builder_bg"></div>\n            <div class="container">\n                <div class="sixteen columns">\n                    <div class="eight columns alpha">\n                        <br>\n                    </div>                 \n                    <div class="eight columns omega ">\n                        <div class="highlight_inner">\n                            <p class="big_title editContent">Delicious Meals Weekly in Inbox</p>\n                            <p class="bold_text margin_bottom normal_text orange editContent">OUR SERVICE IS TOTALLY FREE</p>\n                            <p class="normal_text light_gray editContent">Lorem ipsum dolor sit amet consectetur adipiscing elit sed do eiusmod tempor incididunt ut labore et dolore magna aliqua Ut enim ad minim veniam quis nostrud exercitation ullamco laboris nisi ut aliquip ex commodo consequat Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat.</p>\n                            <a href="#" class="pix_button pix_button_line brown bold_text editContent"><i class="pi pixicon-heart"></i>Add to Favorits</a>\n                        </div>\n                    </div>\n                </div>\n           </div>\n        </div>\n    </div>\n</div>\n\n<script src="js/jquery-1.8.3.min.js" type="text/javascript"></script>\n<script src="jsfiles/jquery.easing.1.3.js" type="text/javascript"></script>\n<script src="jsfiles/jquery.common.min.js" type="text/javascript"></script>\n<script src="jsfiles/jquery.ui.touch-punch.min.js"></script>\n<script src="jsfiles/ticker.js" type="text/javascript"></script>\n<script src="jsfiles/bootstrap.min.js"></script>\n<script src="jsfiles/bootstrap-switch.js"></script>\n<script src="assets/js/appear.min.js" type="text/javascript"></script>\n<script src="jsfiles/custom.js" type="text/javascript"></script>\n<script src="jsfiles/custom3.js" type="text/javascript"></script>\n\n<link rel="stylesheet" type="text/css" property="stylesheet" href="http://localhost:9001/_debugbar/assets/stylesheets?v=1473948356"><script type="text/javascript" src="http://localhost:9001/_debugbar/assets/javascript?v=1473948119"></script><script type="text/javascript">jQuery.noConflict(true);</script>\n<script type="text/javascript">\nvar phpdebugbar = new PhpDebugBar.DebugBar();\nphpdebugbar.addTab("messages", new PhpDebugBar.DebugBar.Tab({"icon":"list-alt","title":"Messages", "widget": new PhpDebugBar.Widgets.MessagesWidget()}));\nphpdebugbar.addIndicator("time", new PhpDebugBar.DebugBar.Indicator({"icon":"clock-o","tooltip":"Request Duration"}), "right");\nphpdebugbar.addTab("timeline", new PhpDebugBar.DebugBar.Tab({"icon":"tasks","title":"Timeline", "widget": new PhpDebugBar.Widgets.TimelineWidget()}));\nphpdebugbar.addIndicator("memory", new PhpDebugBar.DebugBar.Indicator({"icon":"cogs","tooltip":"Memory Usage"}), "right");\nphpdebugbar.addTab("exceptions", new PhpDebugBar.DebugBar.Tab({"icon":"bug","title":"Exceptions", "widget": new PhpDebugBar.Widgets.ExceptionsWidget()}));\nphpdebugbar.addTab("views", new PhpDebugBar.DebugBar.Tab({"icon":"leaf","title":"Views", "widget": new PhpDebugBar.Widgets.TemplatesWidget()}));\nphpdebugbar.addTab("route", new PhpDebugBar.DebugBar.Tab({"icon":"share","title":"Route", "widget": new PhpDebugBar.Widgets.VariableListWidget()}));\nphpdebugbar.addIndicator("currentroute", new PhpDebugBar.DebugBar.Indicator({"icon":"share","tooltip":"Route"}), "right");\nphpdebugbar.addTab("queries", new PhpDebugBar.DebugBar.Tab({"icon":"inbox","title":"Queries", "widget": new PhpDebugBar.Widgets.SQLQueriesWidget()}));\nphpdebugbar.addTab("emails", new PhpDebugBar.DebugBar.Tab({"icon":"inbox","title":"Mails", "widget": new PhpDebugBar.Widgets.MailsWidget()}));\nphpdebugbar.addTab("session", new PhpDebugBar.DebugBar.Tab({"icon":"archive","title":"Session", "widget": new PhpDebugBar.Widgets.VariableListWidget()}));\nphpdebugbar.addTab("request", new PhpDebugBar.DebugBar.Tab({"icon":"tags","title":"Request", "widget": new PhpDebugBar.Widgets.VariableListWidget()}));\nphpdebugbar.setDataMap({\n"messages": ["messages.messages", []],\n"messages:badge": ["messages.count", null],\n"time": ["time.duration_str", \'0ms\'],\n"timeline": ["time", {}],\n"memory": ["memory.peak_usage_str", \'0B\'],\n"exceptions": ["exceptions.exceptions", []],\n"exceptions:badge": ["exceptions.count", null],\n"views": ["views", []],\n"views:badge": ["views.nb_templates", 0],\n"route": ["route", {}],\n"currentroute": ["route.uri", ],\n"queries": ["queries", []],\n"queries:badge": ["queries.nb_statements", 0],\n"emails": ["swiftmailer_mails.mails", []],\n"emails:badge": ["swiftmailer_mails.count", null],\n"session": ["session", {}],\n"request": ["request", {}]\n});\nphpdebugbar.restoreState();\nphpdebugbar.ajaxHandler = new PhpDebugBar.AjaxHandler(phpdebugbar);\nphpdebugbar.ajaxHandler.bindToXHR();\nphpdebugbar.setOpenHandler(new PhpDebugBar.OpenHandler({"url":"http:\\/\\/localhost:9001\\/_debugbar\\/open"}));\nphpdebugbar.addDataSet({"__meta":{"id":"4cbff699ab910c89dd51d514adc85b4a","datetime":"2017-03-31 10:19:08","utime":1490930348.42,"method":"GET","uri":"\\/site\\/getframe\\/20","ip":"::1"},"php":{"version":"5.6.25","interface":"apache2handler"},"messages":{"count":0,"messages":[]},"time":{"start":1490930347.67,"end":1490930348.42,"duration":0.751523017883,"duration_str":"751.52ms","measures":[{"label":"Booting","start":1490930347.67,"relative_start":0,"end":1490930348.27,"relative_end":1490930348.27,"duration":0.598243951797,"duration_str":"598.24ms","params":[],"collector":null},{"label":"Application","start":1490930348.08,"relative_start":0.410331964493,"end":1490930348.42,"relative_end":1.19209289551e-5,"duration":0.341202974319,"duration_str":"341.2ms","params":[],"collector":null}]},"memory":{"peak_usage":13107200,"peak_usage_str":"12.5MB"},"exceptions":{"count":0,"exceptions":[]},"views":{"nb_templates":0,"templates":[]},"route":{"uri":"GET site\\/getframe\\/{frame_id}","middleware":"web","as":"getframe","controller":"App\\\\Http\\\\Controllers\\\\SiteController@getFrame","namespace":"App\\\\Http\\\\Controllers","prefix":null,"where":[],"file":"app\\/Http\\/Controllers\\/SiteController.php:355-360"},"queries":{"nb_statements":1,"nb_failed_statements":0,"accumulated_duration":0.0009,"accumulated_duration_str":"900\\u03bcs","statements":[{"sql":"select * from `frames` where `id` = \'20\' limit 1","params":{"0":"20","hints":"Use <code>SELECT *<\\/code> only if you need all columns from table<br \\/><code>LIMIT<\\/code> without <code>ORDER BY<\\/code> causes non-deterministic results, depending on the query execution plan"},"duration":0.0009,"duration_str":"900\\u03bcs","stmt_id":null,"connection":"logistics.system"}]},"swiftmailer_mails":{"count":0,"mails":[]},"session":{"_token":"oOqrHXkGrg1Y0S1bq8ig8l6R9VWrhszjxcS7y8yb","_previous":"array:1 [\\n  \\"url\\" => \\"http:\\/\\/localhost:9001\\/site\\/getframe\\/20\\"\\n]","flash":"array:2 [\\n  \\"old\\" => []\\n  \\"new\\" => []\\n]","login_web_59ba36addc2b2f9401580f014c7f58ea4e30989d":"1","PHPDEBUGBAR_STACK_DATA":"[]","siteID":"1"},"request":{"format":"html","content_type":"text\\/html; charset=UTF-8","status_text":"OK","status_code":"200","request_query":"[]","request_request":"[]","request_headers":"array:9 [\\n  \\"host\\" => array:1 [\\n    0 => \\"localhost:9001\\"\\n  ]\\n  \\"connection\\" => array:1 [\\n    0 => \\"keep-alive\\"\\n  ]\\n  \\"upgrade-insecure-requests\\" => array:1 [\\n    0 => \\"1\\"\\n  ]\\n  \\"user-agent\\" => array:1 [\\n    0 => \\"Mozilla\\/5.0 (Macintosh; Intel Mac OS X 10_11_6) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/56.0.2924.87 Safari\\/537.36\\"\\n  ]\\n  \\"accept\\" => array:1 [\\n    0 => \\"text\\/html,application\\/xhtml+xml,application\\/xml;q=0.9,image\\/webp,*\\/*;q=0.8\\"\\n  ]\\n  \\"referer\\" => array:1 [\\n    0 => \\"http:\\/\\/localhost:9001\\/system\\/landing-page\\/site\\/1\\"\\n  ]\\n  \\"accept-encoding\\" => array:1 [\\n    0 => \\"gzip, deflate, sdch, br\\"\\n  ]\\n  \\"accept-language\\" => array:1 [\\n    0 => \\"vi-VN,vi;q=0.8,fr-FR;q=0.6,fr;q=0.4,en-US;q=0.2,en;q=0.2\\"\\n  ]\\n  \\"cookie\\" => array:1 [\\n    0 => \\"SQLiteManager_currentLangue=2; XSRF-TOKEN=eyJpdiI6ImJQZ3VPc1FBMUtJZE5wVHZsWnJGT1E9PSIsInZhbHVlIjoiQVJOVUpkMTU5RE8zTEk2UEM0RUxvWms4S0ZqRGpSXC9LS1RySUNXNTgzUEVvYmd5TWlHN0JRUnBxYkc0RDI2Y01WRFZBTnRGaCsrUk9mUjIzWDUyUWR3PT0iLCJtYWMiOiJlODNlNDA1OWVmY2MwNzRjOWRlZmYwZmZiMTA1Y2Q4ZTM3M2YxODVhNzg4NGNmY2JmYTJmMWU4N2M1ODFjNmEwIn0%3D; laravel_session=eyJpdiI6IllVXC9GK2FObmRWVzdGWlUxd1lGOTZ3PT0iLCJ2YWx1ZSI6IjdRSzNQRnh1emx5QkdSTlRcL09lNFpzZGhXQnhQOXNEMkU5RWs3WVhteEVqQTVyMTBpNUJrYm95UHE1YW1NblBVelwvb01pQlVpbFc1aG1CWUUySTVrTnc9PSIsIm1hYyI6ImM1NDA3MzliOTAzYjgwODQ0YjU5NmE3ZWY0YjNhN2U5Nzk2MmVkOTQ5ZjdhMTdkNGMyYTg1OGM5Y2Q3M2I2ZWIifQ%3D%3D\\"\\n  ]\\n]","request_server":"array:34 [\\n  \\"REDIRECT_REDIRECT_STATUS\\" => \\"200\\"\\n  \\"REDIRECT_STATUS\\" => \\"200\\"\\n  \\"HTTP_HOST\\" => \\"localhost:9001\\"\\n  \\"HTTP_CONNECTION\\" => \\"keep-alive\\"\\n  \\"HTTP_UPGRADE_INSECURE_REQUESTS\\" => \\"1\\"\\n  \\"HTTP_USER_AGENT\\" => \\"Mozilla\\/5.0 (Macintosh; Intel Mac OS X 10_11_6) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/56.0.2924.87 Safari\\/537.36\\"\\n  \\"HTTP_ACCEPT\\" => \\"text\\/html,application\\/xhtml+xml,application\\/xml;q=0.9,image\\/webp,*\\/*;q=0.8\\"\\n  \\"HTTP_REFERER\\" => \\"http:\\/\\/localhost:9001\\/system\\/landing-page\\/site\\/1\\"\\n  \\"HTTP_ACCEPT_ENCODING\\" => \\"gzip, deflate, sdch, br\\"\\n  \\"HTTP_ACCEPT_LANGUAGE\\" => \\"vi-VN,vi;q=0.8,fr-FR;q=0.6,fr;q=0.4,en-US;q=0.2,en;q=0.2\\"\\n  \\"HTTP_COOKIE\\" => \\"SQLiteManager_currentLangue=2; XSRF-TOKEN=eyJpdiI6ImJQZ3VPc1FBMUtJZE5wVHZsWnJGT1E9PSIsInZhbHVlIjoiQVJOVUpkMTU5RE8zTEk2UEM0RUxvWms4S0ZqRGpSXC9LS1RySUNXNTgzUEVvYmd5TWlHN0JRUnBxYkc0RDI2Y01WRFZBTnRGaCsrUk9mUjIzWDUyUWR3PT0iLCJtYWMiOiJlODNlNDA1OWVmY2MwNzRjOWRlZmYwZmZiMTA1Y2Q4ZTM3M2YxODVhNzg4NGNmY2JmYTJmMWU4N2M1ODFjNmEwIn0%3D; laravel_session=eyJpdiI6IllVXC9GK2FObmRWVzdGWlUxd1lGOTZ3PT0iLCJ2YWx1ZSI6IjdRSzNQRnh1emx5QkdSTlRcL09lNFpzZGhXQnhQOXNEMkU5RWs3WVhteEVqQTVyMTBpNUJrYm95UHE1YW1NblBVelwvb01pQlVpbFc1aG1CWUUySTVrTnc9PSIsIm1hYyI6ImM1NDA3MzliOTAzYjgwODQ0YjU5NmE3ZWY0YjNhN2U5Nzk2MmVkOTQ5ZjdhMTdkNGMyYTg1OGM5Y2Q3M2I2ZWIifQ%3D%3D\\"\\n  \\"PATH\\" => \\"\\/usr\\/bin:\\/bin:\\/usr\\/sbin:\\/sbin\\"\\n  \\"SERVER_SIGNATURE\\" => \\"\\"\\n  \\"SERVER_SOFTWARE\\" => \\"Apache\\/2.2.31 (Unix) mod_wsgi\\/3.5 Python\\/2.7.12 PHP\\/5.6.25 mod_ssl\\/2.2.31 OpenSSL\\/1.0.2h DAV\\/2 mod_fastcgi\\/2.4.6 mod_perl\\/2.0.9 Perl\\/v5.24.0\\"\\n  \\"SERVER_NAME\\" => \\"localhost\\"\\n  \\"SERVER_ADDR\\" => \\"::1\\"\\n  \\"SERVER_PORT\\" => \\"9001\\"\\n  \\"REMOTE_ADDR\\" => \\"::1\\"\\n  \\"DOCUMENT_ROOT\\" => \\"\\/Users\\/phamhung\\/Work\\/Project\\/logistics_system\\"\\n  \\"SERVER_ADMIN\\" => \\"you@example.com\\"\\n  \\"SCRIPT_FILENAME\\" => \\"\\/Users\\/phamhung\\/Work\\/Project\\/logistics_system\\/public\\/index.php\\"\\n  \\"REMOTE_PORT\\" => \\"59357\\"\\n  \\"REDIRECT_URL\\" => \\"\\/public\\/site\\/getframe\\/20\\"\\n  \\"GATEWAY_INTERFACE\\" => \\"CGI\\/1.1\\"\\n  \\"SERVER_PROTOCOL\\" => \\"HTTP\\/1.1\\"\\n  \\"REQUEST_METHOD\\" => \\"GET\\"\\n  \\"QUERY_STRING\\" => \\"\\"\\n  \\"REQUEST_URI\\" => \\"\\/site\\/getframe\\/20\\"\\n  \\"SCRIPT_NAME\\" => \\"\\/public\\/index.php\\"\\n  \\"PHP_SELF\\" => \\"\\/public\\/index.php\\"\\n  \\"REQUEST_TIME_FLOAT\\" => 1490930347.67\\n  \\"REQUEST_TIME\\" => 1490930347\\n  \\"argv\\" => []\\n  \\"argc\\" => 0\\n]","request_cookies":"array:3 [\\n  \\"SQLiteManager_currentLangue\\" => null\\n  \\"XSRF-TOKEN\\" => \\"oOqrHXkGrg1Y0S1bq8ig8l6R9VWrhszjxcS7y8yb\\"\\n  \\"laravel_session\\" => \\"76ea0079831b69bcd6085f38477d11246d31cae8\\"\\n]","response_headers":"array:3 [\\n  \\"cache-control\\" => array:1 [\\n    0 => \\"no-cache\\"\\n  ]\\n  \\"content-type\\" => array:1 [\\n    0 => \\"text\\/html; charset=UTF-8\\"\\n  ]\\n  \\"Set-Cookie\\" => array:2 [\\n    0 => \\"XSRF-TOKEN=eyJpdiI6IjRCT3B1cTBXb2xETFNvK3ZkMG9hQlE9PSIsInZhbHVlIjoiS2VlaStKSFo2SnRwZmw2dlRZVHF6UDlwMExkNHNrTVlPSE1MR2FKcHNtcElWdDU0RTJMemFYTFRZTGlDYU5YXC9LQXZ1WGJFcHowc1NpVTN3eHA5bFRRPT0iLCJtYWMiOiJmZTUxMDVhNWNhYThmYTU1MDEzNGRhNDQ4NzI1MTM5NzM2NDUyODcwZmIxNzVlYWU4MjY4OGE5OWU5YTA0ZThhIn0%3D; expires=Fri, 31-Mar-2017 05:19:08 GMT; path=\\/\\"\\n    1 => \\"laravel_session=eyJpdiI6IjJLZEZoek5hWlUyYTBBUmplUEJDaGc9PSIsInZhbHVlIjoiVUJTamNUamRwbDBoZmtYa3A4R09sYVRNbVwvcFNkN2xBTnVMNlRuVlRmTVwvRm5wNmNwWEY1OHBsQWpIc1RVVGh3U3BYZ1EyZzZZZ1dCcTFsQzhzVlhUdz09IiwibWFjIjoiZWZlNDM0MDE2YTYwYzE5MGY0YzkzMTAwOTFjYTllODc2MGZiNzY2YmZhMDRmYjM2NTY0YTUwMzIxZjFkODY2NyJ9; expires=Fri, 31-Mar-2017 05:19:08 GMT; path=\\/; httponly\\"\\n  ]\\n]","path_info":"\\/site\\/getframe\\/20","session_attributes":"array:6 [\\n  \\"_token\\" => \\"oOqrHXkGrg1Y0S1bq8ig8l6R9VWrhszjxcS7y8yb\\"\\n  \\"_previous\\" => array:1 [\\n    \\"url\\" => \\"http:\\/\\/localhost:9001\\/site\\/getframe\\/20\\"\\n  ]\\n  \\"flash\\" => array:2 [\\n    \\"old\\" => []\\n    \\"new\\" => []\\n  ]\\n  \\"login_web_59ba36addc2b2f9401580f014c7f58ea4e30989d\\" => 1\\n  \\"PHPDEBUGBAR_STACK_DATA\\" => []\\n  \\"siteID\\" => \\"1\\"\\n]"}}, "4cbff699ab910c89dd51d514adc85b4a");\n\n</script><div class="phpdebugbar phpdebugbar-minimized phpdebugbar-closed"><div class="phpdebugbar-drag-capture"></div><div class="phpdebugbar-resize-handle" style="display: none;"></div><div class="phpdebugbar-header" style="display: none;"><div class="phpdebugbar-header-left"><a class="phpdebugbar-tab"><i class="phpdebugbar-fa phpdebugbar-fa-list-alt"></i><span class="phpdebugbar-text">Messages</span><span class="phpdebugbar-badge" style="display: none;"></span></a><a class="phpdebugbar-tab"><i class="phpdebugbar-fa phpdebugbar-fa-tasks"></i><span class="phpdebugbar-text">Timeline</span><span class="phpdebugbar-badge"></span></a><a class="phpdebugbar-tab"><i class="phpdebugbar-fa phpdebugbar-fa-bug"></i><span class="phpdebugbar-text">Exceptions</span><span class="phpdebugbar-badge" style="display: none;"></span></a><a class="phpdebugbar-tab"><i class="phpdebugbar-fa phpdebugbar-fa-leaf"></i><span class="phpdebugbar-text">Views</span><span class="phpdebugbar-badge" style="display: inline;">0</span></a><a class="phpdebugbar-tab"><i class="phpdebugbar-fa phpdebugbar-fa-share"></i><span class="phpdebugbar-text">Route</span><span class="phpdebugbar-badge"></span></a><a class="phpdebugbar-tab"><i class="phpdebugbar-fa phpdebugbar-fa-inbox"></i><span class="phpdebugbar-text">Queries</span><span class="phpdebugbar-badge" style="display: inline;">1</span></a><a class="phpdebugbar-tab"><i class="phpdebugbar-fa phpdebugbar-fa-inbox"></i><span class="phpdebugbar-text">Mails</span><span class="phpdebugbar-badge" style="display: none;"></span></a><a class="phpdebugbar-tab"><i class="phpdebugbar-fa phpdebugbar-fa-archive"></i><span class="phpdebugbar-text">Session</span><span class="phpdebugbar-badge"></span></a><a class="phpdebugbar-tab"><i class="phpdebugbar-fa phpdebugbar-fa-tags"></i><span class="phpdebugbar-text">Request</span><span class="phpdebugbar-badge"></span></a></div><div class="phpdebugbar-header-right"><a class="phpdebugbar-close-btn"></a><a class="phpdebugbar-minimize-btn"></a><a class="phpdebugbar-maximize-btn"></a><a class="phpdebugbar-open-btn" style="display: block;"></a><select class="phpdebugbar-datasets-switcher"><option value="4cbff699ab910c89dd51d514adc85b4a">#1 20 (10:19:08)</option></select><span class="phpdebugbar-indicator"><i class="phpdebugbar-fa phpdebugbar-fa-clock-o"></i><span class="phpdebugbar-text">751.52ms</span><span class="phpdebugbar-tooltip">Request Duration</span></span><span class="phpdebugbar-indicator"><i class="phpdebugbar-fa phpdebugbar-fa-cogs"></i><span class="phpdebugbar-text">12.5MB</span><span class="phpdebugbar-tooltip">Memory Usage</span></span><span class="phpdebugbar-indicator"><i class="phpdebugbar-fa phpdebugbar-fa-share"></i><span class="phpdebugbar-text">GET site/getframe/{frame_id}</span><span class="phpdebugbar-tooltip">Route</span></span></div></div><div class="phpdebugbar-body" style="height: 40px; display: none;"><div class="phpdebugbar-panel"><div class="phpdebugbar-widgets-messages"><ul class="phpdebugbar-widgets-list"></ul><div class="phpdebugbar-widgets-toolbar"><i class="phpdebugbar-fa phpdebugbar-fa-search"></i><input type="text"></div></div></div><div class="phpdebugbar-panel"><ul class="phpdebugbar-widgets-timeline"><li><div class="phpdebugbar-widgets-measure"><span class="phpdebugbar-widgets-value" style="left: 0%; width: 79.6%;"></span><span class="phpdebugbar-widgets-label">Booting (598.24ms)</span></div></li><li><div class="phpdebugbar-widgets-measure"><span class="phpdebugbar-widgets-value" style="left: 54.6%; width: 45.4%;"></span><span class="phpdebugbar-widgets-label">Application (341.2ms)</span></div></li></ul></div><div class="phpdebugbar-panel"><div class="phpdebugbar-widgets-exceptions"><ul class="phpdebugbar-widgets-list"></ul></div></div><div class="phpdebugbar-panel"><div class="phpdebugbar-widgets-templates"><div class="phpdebugbar-widgets-status"><span>0 templates were rendered</span></div><ul class="phpdebugbar-widgets-list"></ul></div></div><div class="phpdebugbar-panel"><dl class="phpdebugbar-widgets-kvlist phpdebugbar-widgets-varlist"><dt class="phpdebugbar-widgets-key"><span title="uri">uri</span></dt><dd class="phpdebugbar-widgets-value">GET site/getframe/{frame_id}</dd><dt class="phpdebugbar-widgets-key"><span title="middleware">middleware</span></dt><dd class="phpdebugbar-widgets-value">web</dd><dt class="phpdebugbar-widgets-key"><span title="as">as</span></dt><dd class="phpdebugbar-widgets-value">getframe</dd><dt class="phpdebugbar-widgets-key"><span title="controller">controller</span></dt><dd class="phpdebugbar-widgets-value">App\\Http\\Controllers\\SiteController@getFrame</dd><dt class="phpdebugbar-widgets-key"><span title="namespace">namespace</span></dt><dd class="phpdebugbar-widgets-value">App\\Http\\Controllers</dd><dt class="phpdebugbar-widgets-key"><span title="prefix">prefix</span></dt><dd class="phpdebugbar-widgets-value">null</dd><dt class="phpdebugbar-widgets-key"><span title="where">where</span></dt><dd class="phpdebugbar-widgets-value"></dd><dt class="phpdebugbar-widgets-key"><span title="file">file</span></dt><dd class="phpdebugbar-widgets-value">app/Http/Controllers/SiteController.php:355-360</dd></dl></div><div class="phpdebugbar-panel"><div class="phpdebugbar-widgets-sqlqueries"><div class="phpdebugbar-widgets-status"><span>1 statements were executed</span><span title="Accumulated duration" class="phpdebugbar-widgets-duration">900μs</span></div><div class="phpdebugbar-widgets-toolbar"><a class="phpdebugbar-widgets-filter" rel="logistics.system">logistics.system</a></div><ul class="phpdebugbar-widgets-list"><li class="phpdebugbar-widgets-list-item" connection="logistics.system" style="cursor: pointer;"><code class="phpdebugbar-widgets-sql"><span class="hljs-operator"><span class="hljs-keyword">select</span> * <span class="hljs-keyword">from</span> <span class="hljs-string">`frames`</span> <span class="hljs-keyword">where</span> <span class="hljs-string">`id`</span> = <span class="hljs-string">\'20\'</span> limit <span class="hljs-number">1</span></span></code><span title="Duration" class="phpdebugbar-widgets-duration">900μs</span><span title="Connection" class="phpdebugbar-widgets-database">logistics.system</span><table class="phpdebugbar-widgets-params"><tbody><tr><th colspan="2">Params</th></tr><tr><td class="phpdebugbar-widgets-name">0</td><td class="phpdebugbar-widgets-value">20</td></tr><tr><td class="phpdebugbar-widgets-name">hints</td><td class="phpdebugbar-widgets-value">Use <code>SELECT *</code> only if you need all columns from table<br><code>LIMIT</code> without <code>ORDER BY</code> causes non-deterministic results, depending on the query execution plan</td></tr></tbody></table></li></ul></div></div><div class="phpdebugbar-panel"><div class="phpdebugbar-widgets-mails"><ul class="phpdebugbar-widgets-list"></ul></div></div><div class="phpdebugbar-panel"><dl class="phpdebugbar-widgets-kvlist phpdebugbar-widgets-varlist"><dt class="phpdebugbar-widgets-key"><span title="_token">_token</span></dt><dd class="phpdebugbar-widgets-value">oOqrHXkGrg1Y0S1bq8ig8l6R9VWrhszjxcS7y8yb</dd><dt class="phpdebugbar-widgets-key"><span title="_previous">_previous</span></dt><dd class="phpdebugbar-widgets-value">array:1 [\n  "url" =&gt; "http://localhost:9001/site/getframe/20"\n]</dd><dt class="phpdebugbar-widgets-key"><span title="flash">flash</span></dt><dd class="phpdebugbar-widgets-value">array:2 [\n  "old" =&gt; []\n  "new" =&gt; []\n]</dd><dt class="phpdebugbar-widgets-key"><span title="login_web_59ba36addc2b2f9401580f014c7f58ea4e30989d">login_web_59ba36addc2b2f9401580f014c7f58ea4e30989d</span></dt><dd class="phpdebugbar-widgets-value">1</dd><dt class="phpdebugbar-widgets-key"><span title="PHPDEBUGBAR_STACK_DATA">PHPDEBUGBAR_STACK_DATA</span></dt><dd class="phpdebugbar-widgets-value">[]</dd><dt class="phpdebugbar-widgets-key"><span title="siteID">siteID</span></dt><dd class="phpdebugbar-widgets-value">1</dd></dl></div><div class="phpdebugbar-panel"><dl class="phpdebugbar-widgets-kvlist phpdebugbar-widgets-varlist"><dt class="phpdebugbar-widgets-key"><span title="format">format</span></dt><dd class="phpdebugbar-widgets-value">html</dd><dt class="phpdebugbar-widgets-key"><span title="content_type">content_type</span></dt><dd class="phpdebugbar-widgets-value">text/html; charset=UTF-8</dd><dt class="phpdebugbar-widgets-key"><span title="status_text">status_text</span></dt><dd class="phpdebugbar-widgets-value">OK</dd><dt class="phpdebugbar-widgets-key"><span title="status_code">status_code</span></dt><dd class="phpdebugbar-widgets-value">200</dd><dt class="phpdebugbar-widgets-key"><span title="request_query">request_query</span></dt><dd class="phpdebugbar-widgets-value">[]</dd><dt class="phpdebugbar-widgets-key"><span title="request_request">request_request</span></dt><dd class="phpdebugbar-widgets-value">[]</dd><dt class="phpdebugbar-widgets-key"><span title="request_headers">request_headers</span></dt><dd class="phpdebugbar-widgets-value">array:9 [\n  "host" =&gt; array:1 [\n    0 =&gt; "localhost:9001"\n  ]\n  "connection" =&gt; array:1 [\n    0 =&gt; "...</dd><dt class="phpdebugbar-widgets-key"><span title="request_server">request_server</span></dt><dd class="phpdebugbar-widgets-value">array:34 [\n  "REDIRECT_REDIRECT_STATUS" =&gt; "200"\n  "REDIRECT_STATUS" =&gt; "200"\n  "HTTP_HOST" =&gt; "loca...</dd><dt class="phpdebugbar-widgets-key"><span title="request_cookies">request_cookies</span></dt><dd class="phpdebugbar-widgets-value">array:3 [\n  "SQLiteManager_currentLangue" =&gt; null\n  "XSRF-TOKEN" =&gt; "oOqrHXkGrg1Y0S1bq8ig8l6R9VWrhsz...</dd><dt class="phpdebugbar-widgets-key"><span title="response_headers">response_headers</span></dt><dd class="phpdebugbar-widgets-value">array:3 [\n  "cache-control" =&gt; array:1 [\n    0 =&gt; "no-cache"\n  ]\n  "content-type" =&gt; array:1 [\n    0...</dd><dt class="phpdebugbar-widgets-key"><span title="path_info">path_info</span></dt><dd class="phpdebugbar-widgets-value">/site/getframe/20</dd><dt class="phpdebugbar-widgets-key"><span title="session_attributes">session_attributes</span></dt><dd class="phpdebugbar-widgets-value">array:6 [\n  "_token" =&gt; "oOqrHXkGrg1Y0S1bq8ig8l6R9VWrhszjxcS7y8yb"\n  "_previous" =&gt; array:1 [\n    "u...</dd></dl></div></div><a class="phpdebugbar-restore-btn" style=""></a></div><div class="phpdebugbar-openhandler" style="display: none;"><div class="phpdebugbar-openhandler-header">PHP DebugBar | Open<a><i class="phpdebugbar-fa phpdebugbar-fa-times"></i></a></div><table><thead><tr><th width="150">Date</th><th width="55">Method</th><th>URL</th><th width="125">IP</th><th width="100">Filter data</th></tr></thead><tbody></tbody></table><div class="phpdebugbar-openhandler-actions"><a>Load more</a><a>Show only current URL</a><a>Show all</a><a>Delete all</a><form><br><b>Filter results</b><br>Method: <select name="method"><option></option><option>GET</option><option>POST</option><option>PUT</option><option>DELETE</option></select><br>Uri: <input type="text" name="uri"><br>IP: <input type="text" name="ip"><br><button type="submit">Search</button></form></div></div><div class="phpdebugbar-openhandler-overlay" style="display: none;"></div>\n</body>', 500, NULL, '', 0, 1, '2017-03-31 03:19:33', '2017-03-31 03:21:25'),
(24, 1, 1, '<html><head>\n    <meta charset="utf-8">\n    <title>FLATPACK</title>\n    <meta name="viewport" content="width=device-width, initial-scale=1.0">\n    <link rel="stylesheet" href="stylesheets/menu.css">\n    <!-- CSS\n    ================================================== -->\n    <link rel="stylesheet" href="stylesheets/menu.css">\n    <link rel="stylesheet" href="stylesheets/flat-ui-slider.css">\n    <link rel="stylesheet" href="stylesheets/base.css">\n    <link rel="stylesheet" href="stylesheets/skeleton.css">\n    <link rel="stylesheet" href="stylesheets/landings.css">\n    <link rel="stylesheet" href="stylesheets/main.css">\n    <link rel="stylesheet" href="stylesheets/landings_layouts.css">\n    <link rel="stylesheet" href="stylesheets/box.css">\n    <link rel="stylesheet" href="stylesheets/pixicon.css">\n    <!--[if lt IE 9]>\n        <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>\n        <![endif]-->\n    <!-- Favicons\n    ================================================== -->\n    <link rel="shortcut icon" href="images/favicon.ico">\n    <link rel="apple-touch-icon" href="images/apple-touch-icon.png">\n    <link rel="apple-touch-icon" sizes="72x72" href="images/apple-touch-icon-72x72.png">\n    <link rel="apple-touch-icon" sizes="114x114" href="images/apple-touch-icon-114x114.png">\n</head><body>\n\n<div id="page">\n    <div class="header_nav_1 dark inter_3_bg pix_builder_bg" id="section_intro_3">\n        <div class="header_style">\n            <div class="container">\n                <div class="sixteen columns firas2">\n                    <nav role="navigation" class="navbar navbar-white navbar-embossed navbar-lg pix_nav_1">\n                        <div class="containerss">\n                            <div class="navbar-header">\n                                <button data-target="#navbar-collapse-02" data-toggle="collapse" class="navbar-toggle" type="button">\n                                    <span class="sr-only">Toggle navigation</span>\n                                </button>\n                                <img src="images/main/logo-dark.png" class="pix_nav_logo" alt="">                \n                            </div>\n                            <div id="navbar-collapse-02" class="collapse navbar-collapse">\n                                <ul class="nav navbar-nav navbar-right">\n                                    <li class="active propClone"><a href="#">Home</a></li>\n                                    <li class="propClone"><a href="#">Work</a></li>\n                                    <li class="propClone"><a href="#">Contact</a></li>\n                                    <li class="propClone icon-item"><a class="pi pixicon-facebook2" href="#fakelink"></a></li>\n                                    <li class="propClone icon-item"><a class="pi pixicon-twitter2" href="#fakelink"></a></li>\n                                    <li class="propClone icon-item"><a class="pi pixicon-instagram" href="#fakelink"></a></li>\n                                </ul>\n                            </div><!-- /.navbar-collapse -->\n                        </div><!-- /.container -->\n                    </nav>\n                </div>\n            </div><!-- container -->\n        </div>\n        <div class="container">\n            <div class="sixteen columns margin_bottom_50 padding_top_60">\n                <div class="twelve offset-by-two columns">\n                    <div class="center_text big_padding">\n                        <p class="big_title bold_text editContent">Restaurant Landing Page</p>\n                        <p class="big_text normal_gray editContent">\n                            From logo design to website development, hand-picked designers and developers are ready to complete.\n                        </p>\n                        <a href="#" class="pix_button pix_button_line white_border_button bold_text big_text btn_big">\n                            <i class="pi pixicon-paper"></i> \n                            <span>Make a Reservation</span>\n                            </a>\n                    </div>\n                </div>\n            </div>\n            <div class="center_text">\n                <a href="#" class="intro_arrow">\n                    <i class="pi pixicon-arrow-down"></i> \n                </a>\n            </div>\n        </div>\n    </div>\n</div>\n\n<script src="js/jquery-1.8.3.min.js" type="text/javascript"></script>\n<script src="jsfiles/jquery.easing.1.3.js" type="text/javascript"></script>\n<script src="jsfiles/jquery.common.min.js" type="text/javascript"></script>\n<script src="jsfiles/jquery.ui.touch-punch.min.js"></script>\n<script src="jsfiles/ticker.js" type="text/javascript"></script>\n<script src="jsfiles/bootstrap.min.js"></script>\n<script src="jsfiles/bootstrap-switch.js"></script>\n<script src="assets/js/appear.min.js" type="text/javascript"></script>\n<script src="jsfiles/custom.js" type="text/javascript"></script>\n<script src="jsfiles/custom3.js" type="text/javascript"></script>\n\n</body>', 632, NULL, '', 0, 1, '2017-03-31 03:21:25', '2017-03-31 03:23:22');
INSERT INTO `frames` (`id`, `page_id`, `site_id`, `content`, `height`, `original_url`, `loaderfunction`, `sandbox`, `revision`, `created_at`, `updated_at`) VALUES
(25, 1, 1, '<html><head>\n	<!-- Basic Page Needs\n    ================================================== -->\n	<meta charset="utf-8">\n	<title>FLATPACK</title>\n	<meta name="description" content="">\n	<meta name="author" content="">\n	<!-- Mobile Specific Metas\n    ================================================== -->\n	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">\n	<!-- CSS\n    ================================================== -->\n	<link rel="stylesheet" href="stylesheets/menu.css">\n    <link rel="stylesheet" href="stylesheets/flat-ui-slider.css">\n    <link rel="stylesheet" href="stylesheets/base.css">\n    <link rel="stylesheet" href="stylesheets/skeleton.css">\n    <link rel="stylesheet" href="stylesheets/landings.css">\n    <link rel="stylesheet" href="stylesheets/main.css">\n    <link rel="stylesheet" href="stylesheets/landings_layouts.css">\n    <link rel="stylesheet" href="stylesheets/box.css">\n    <link rel="stylesheet" href="stylesheets/pixicon.css">\n\n	<!--[if lt IE 9]>\n		<script src="http://html5shim.googlecode.com/svn/trunk/httpml5.js"></script>\n	<![endif]-->\n	<!-- Favicons\n	================================================== -->\n	<link rel="shortcut icon" href="images/favicon.ico">\n	<link rel="apple-touch-icon" href="images/apple-touch-icon.png">\n	<link rel="apple-touch-icon" sizes="72x72" href="images/apple-touch-icon-72x72.png">\n	<link rel="apple-touch-icon" sizes="114x114" href="images/apple-touch-icon-114x114.png">\n</head><body style="">\n\n<div id="page">\n    <div class="pix_builder_bg hl1" id="section_highlight_1">\n        <div class="big_padding highlight-section">\n            <div class="highlight-left pix_builder_bg"></div>\n            <div class="container ">\n                <div class="sixteen columns ">\n                    <div class="eight columns alpha">\n                        <div class="highlight_inner">\n                            <p class="big_title editContent">Restaurant High Quality Services</p>\n                            <p class="bold_text margin_bottom normal_text orange editContent">BOOK YOUR SEAT ONLINE</p>\n                            <p class="normal_text light_gray editContent">Lorem ipsum dolor sit amet consectetur adipiscing elit sed do eiusmod tempor incididunt ut labore et dolore magna aliqua Ut enim ad minim veniam quis nostrud exercitation ullamco laboris nisi ut aliquip ex commodo consequat Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat.</p>\n                            <a href="#" class="pix_button pix_button_line brown bold_text editContent"><i class="pi pixicon-ribbon"></i> Bookmark Recipes</a>\n                            </div>\n                    </div>                 \n                    <div class="eight columns omega ">\n                        \n                    </div>\n                </div>\n           </div>\n        </div>\n    </div>\n</div>\n\n<script src="js/jquery-1.8.3.min.js" type="text/javascript"></script>\n<script src="jsfiles/jquery.easing.1.3.js" type="text/javascript"></script>\n<script src="jsfiles/jquery.common.min.js" type="text/javascript"></script>\n<script src="jsfiles/jquery.ui.touch-punch.min.js"></script>\n<script src="jsfiles/ticker.js" type="text/javascript"></script>\n<script src="jsfiles/bootstrap.min.js"></script>\n<script src="jsfiles/bootstrap-switch.js"></script>\n<script src="assets/js/appear.min.js" type="text/javascript"></script>\n<script src="jsfiles/custom.js" type="text/javascript"></script>\n<script src="jsfiles/custom3.js" type="text/javascript"></script>\n\n<link rel="stylesheet" type="text/css" property="stylesheet" href="http://localhost:9001/_debugbar/assets/stylesheets?v=1473948356"><script type="text/javascript" src="http://localhost:9001/_debugbar/assets/javascript?v=1473948119"></script><script type="text/javascript">jQuery.noConflict(true);</script>\n<script type="text/javascript">\nvar phpdebugbar = new PhpDebugBar.DebugBar();\nphpdebugbar.addTab("messages", new PhpDebugBar.DebugBar.Tab({"icon":"list-alt","title":"Messages", "widget": new PhpDebugBar.Widgets.MessagesWidget()}));\nphpdebugbar.addIndicator("time", new PhpDebugBar.DebugBar.Indicator({"icon":"clock-o","tooltip":"Request Duration"}), "right");\nphpdebugbar.addTab("timeline", new PhpDebugBar.DebugBar.Tab({"icon":"tasks","title":"Timeline", "widget": new PhpDebugBar.Widgets.TimelineWidget()}));\nphpdebugbar.addIndicator("memory", new PhpDebugBar.DebugBar.Indicator({"icon":"cogs","tooltip":"Memory Usage"}), "right");\nphpdebugbar.addTab("exceptions", new PhpDebugBar.DebugBar.Tab({"icon":"bug","title":"Exceptions", "widget": new PhpDebugBar.Widgets.ExceptionsWidget()}));\nphpdebugbar.addTab("views", new PhpDebugBar.DebugBar.Tab({"icon":"leaf","title":"Views", "widget": new PhpDebugBar.Widgets.TemplatesWidget()}));\nphpdebugbar.addTab("route", new PhpDebugBar.DebugBar.Tab({"icon":"share","title":"Route", "widget": new PhpDebugBar.Widgets.VariableListWidget()}));\nphpdebugbar.addIndicator("currentroute", new PhpDebugBar.DebugBar.Indicator({"icon":"share","tooltip":"Route"}), "right");\nphpdebugbar.addTab("queries", new PhpDebugBar.DebugBar.Tab({"icon":"inbox","title":"Queries", "widget": new PhpDebugBar.Widgets.SQLQueriesWidget()}));\nphpdebugbar.addTab("emails", new PhpDebugBar.DebugBar.Tab({"icon":"inbox","title":"Mails", "widget": new PhpDebugBar.Widgets.MailsWidget()}));\nphpdebugbar.addTab("session", new PhpDebugBar.DebugBar.Tab({"icon":"archive","title":"Session", "widget": new PhpDebugBar.Widgets.VariableListWidget()}));\nphpdebugbar.addTab("request", new PhpDebugBar.DebugBar.Tab({"icon":"tags","title":"Request", "widget": new PhpDebugBar.Widgets.VariableListWidget()}));\nphpdebugbar.setDataMap({\n"messages": ["messages.messages", []],\n"messages:badge": ["messages.count", null],\n"time": ["time.duration_str", \'0ms\'],\n"timeline": ["time", {}],\n"memory": ["memory.peak_usage_str", \'0B\'],\n"exceptions": ["exceptions.exceptions", []],\n"exceptions:badge": ["exceptions.count", null],\n"views": ["views", []],\n"views:badge": ["views.nb_templates", 0],\n"route": ["route", {}],\n"currentroute": ["route.uri", ],\n"queries": ["queries", []],\n"queries:badge": ["queries.nb_statements", 0],\n"emails": ["swiftmailer_mails.mails", []],\n"emails:badge": ["swiftmailer_mails.count", null],\n"session": ["session", {}],\n"request": ["request", {}]\n});\nphpdebugbar.restoreState();\nphpdebugbar.ajaxHandler = new PhpDebugBar.AjaxHandler(phpdebugbar);\nphpdebugbar.ajaxHandler.bindToXHR();\nphpdebugbar.setOpenHandler(new PhpDebugBar.OpenHandler({"url":"http:\\/\\/localhost:9001\\/_debugbar\\/open"}));\nphpdebugbar.addDataSet({"__meta":{"id":"f15d84f6e5dc31519601c41c8e59c6fa","datetime":"2017-03-31 10:19:08","utime":1490930348.41,"method":"GET","uri":"\\/site\\/getframe\\/19","ip":"::1"},"php":{"version":"5.6.25","interface":"apache2handler"},"messages":{"count":0,"messages":[]},"time":{"start":1490930347.67,"end":1490930348.41,"duration":0.740689992905,"duration_str":"740.69ms","measures":[{"label":"Booting","start":1490930347.67,"relative_start":0,"end":1490930348.18,"relative_end":1490930348.18,"duration":0.50679397583,"duration_str":"506.79ms","params":[],"collector":null},{"label":"Application","start":1490930348.06,"relative_start":0.391119003296,"end":1490930348.41,"relative_end":6.19888305664e-6,"duration":0.349577188492,"duration_str":"349.58ms","params":[],"collector":null}]},"memory":{"peak_usage":13107200,"peak_usage_str":"12.5MB"},"exceptions":{"count":0,"exceptions":[]},"views":{"nb_templates":0,"templates":[]},"route":{"uri":"GET site\\/getframe\\/{frame_id}","middleware":"web","as":"getframe","controller":"App\\\\Http\\\\Controllers\\\\SiteController@getFrame","namespace":"App\\\\Http\\\\Controllers","prefix":null,"where":[],"file":"app\\/Http\\/Controllers\\/SiteController.php:355-360"},"queries":{"nb_statements":1,"nb_failed_statements":0,"accumulated_duration":0.00178,"accumulated_duration_str":"1.78ms","statements":[{"sql":"select * from `frames` where `id` = \'19\' limit 1","params":{"0":"19","hints":"Use <code>SELECT *<\\/code> only if you need all columns from table<br \\/><code>LIMIT<\\/code> without <code>ORDER BY<\\/code> causes non-deterministic results, depending on the query execution plan"},"duration":0.00178,"duration_str":"1.78ms","stmt_id":null,"connection":"logistics.system"}]},"swiftmailer_mails":{"count":0,"mails":[]},"session":{"_token":"oOqrHXkGrg1Y0S1bq8ig8l6R9VWrhszjxcS7y8yb","_previous":"array:1 [\\n  \\"url\\" => \\"http:\\/\\/localhost:9001\\/site\\/getframe\\/19\\"\\n]","flash":"array:2 [\\n  \\"old\\" => []\\n  \\"new\\" => []\\n]","login_web_59ba36addc2b2f9401580f014c7f58ea4e30989d":"1","PHPDEBUGBAR_STACK_DATA":"[]","siteID":"1"},"request":{"format":"html","content_type":"text\\/html; charset=UTF-8","status_text":"OK","status_code":"200","request_query":"[]","request_request":"[]","request_headers":"array:9 [\\n  \\"host\\" => array:1 [\\n    0 => \\"localhost:9001\\"\\n  ]\\n  \\"connection\\" => array:1 [\\n    0 => \\"keep-alive\\"\\n  ]\\n  \\"upgrade-insecure-requests\\" => array:1 [\\n    0 => \\"1\\"\\n  ]\\n  \\"user-agent\\" => array:1 [\\n    0 => \\"Mozilla\\/5.0 (Macintosh; Intel Mac OS X 10_11_6) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/56.0.2924.87 Safari\\/537.36\\"\\n  ]\\n  \\"accept\\" => array:1 [\\n    0 => \\"text\\/html,application\\/xhtml+xml,application\\/xml;q=0.9,image\\/webp,*\\/*;q=0.8\\"\\n  ]\\n  \\"referer\\" => array:1 [\\n    0 => \\"http:\\/\\/localhost:9001\\/system\\/landing-page\\/site\\/1\\"\\n  ]\\n  \\"accept-encoding\\" => array:1 [\\n    0 => \\"gzip, deflate, sdch, br\\"\\n  ]\\n  \\"accept-language\\" => array:1 [\\n    0 => \\"vi-VN,vi;q=0.8,fr-FR;q=0.6,fr;q=0.4,en-US;q=0.2,en;q=0.2\\"\\n  ]\\n  \\"cookie\\" => array:1 [\\n    0 => \\"SQLiteManager_currentLangue=2; XSRF-TOKEN=eyJpdiI6ImJQZ3VPc1FBMUtJZE5wVHZsWnJGT1E9PSIsInZhbHVlIjoiQVJOVUpkMTU5RE8zTEk2UEM0RUxvWms4S0ZqRGpSXC9LS1RySUNXNTgzUEVvYmd5TWlHN0JRUnBxYkc0RDI2Y01WRFZBTnRGaCsrUk9mUjIzWDUyUWR3PT0iLCJtYWMiOiJlODNlNDA1OWVmY2MwNzRjOWRlZmYwZmZiMTA1Y2Q4ZTM3M2YxODVhNzg4NGNmY2JmYTJmMWU4N2M1ODFjNmEwIn0%3D; laravel_session=eyJpdiI6IllVXC9GK2FObmRWVzdGWlUxd1lGOTZ3PT0iLCJ2YWx1ZSI6IjdRSzNQRnh1emx5QkdSTlRcL09lNFpzZGhXQnhQOXNEMkU5RWs3WVhteEVqQTVyMTBpNUJrYm95UHE1YW1NblBVelwvb01pQlVpbFc1aG1CWUUySTVrTnc9PSIsIm1hYyI6ImM1NDA3MzliOTAzYjgwODQ0YjU5NmE3ZWY0YjNhN2U5Nzk2MmVkOTQ5ZjdhMTdkNGMyYTg1OGM5Y2Q3M2I2ZWIifQ%3D%3D\\"\\n  ]\\n]","request_server":"array:34 [\\n  \\"REDIRECT_REDIRECT_STATUS\\" => \\"200\\"\\n  \\"REDIRECT_STATUS\\" => \\"200\\"\\n  \\"HTTP_HOST\\" => \\"localhost:9001\\"\\n  \\"HTTP_CONNECTION\\" => \\"keep-alive\\"\\n  \\"HTTP_UPGRADE_INSECURE_REQUESTS\\" => \\"1\\"\\n  \\"HTTP_USER_AGENT\\" => \\"Mozilla\\/5.0 (Macintosh; Intel Mac OS X 10_11_6) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/56.0.2924.87 Safari\\/537.36\\"\\n  \\"HTTP_ACCEPT\\" => \\"text\\/html,application\\/xhtml+xml,application\\/xml;q=0.9,image\\/webp,*\\/*;q=0.8\\"\\n  \\"HTTP_REFERER\\" => \\"http:\\/\\/localhost:9001\\/system\\/landing-page\\/site\\/1\\"\\n  \\"HTTP_ACCEPT_ENCODING\\" => \\"gzip, deflate, sdch, br\\"\\n  \\"HTTP_ACCEPT_LANGUAGE\\" => \\"vi-VN,vi;q=0.8,fr-FR;q=0.6,fr;q=0.4,en-US;q=0.2,en;q=0.2\\"\\n  \\"HTTP_COOKIE\\" => \\"SQLiteManager_currentLangue=2; XSRF-TOKEN=eyJpdiI6ImJQZ3VPc1FBMUtJZE5wVHZsWnJGT1E9PSIsInZhbHVlIjoiQVJOVUpkMTU5RE8zTEk2UEM0RUxvWms4S0ZqRGpSXC9LS1RySUNXNTgzUEVvYmd5TWlHN0JRUnBxYkc0RDI2Y01WRFZBTnRGaCsrUk9mUjIzWDUyUWR3PT0iLCJtYWMiOiJlODNlNDA1OWVmY2MwNzRjOWRlZmYwZmZiMTA1Y2Q4ZTM3M2YxODVhNzg4NGNmY2JmYTJmMWU4N2M1ODFjNmEwIn0%3D; laravel_session=eyJpdiI6IllVXC9GK2FObmRWVzdGWlUxd1lGOTZ3PT0iLCJ2YWx1ZSI6IjdRSzNQRnh1emx5QkdSTlRcL09lNFpzZGhXQnhQOXNEMkU5RWs3WVhteEVqQTVyMTBpNUJrYm95UHE1YW1NblBVelwvb01pQlVpbFc1aG1CWUUySTVrTnc9PSIsIm1hYyI6ImM1NDA3MzliOTAzYjgwODQ0YjU5NmE3ZWY0YjNhN2U5Nzk2MmVkOTQ5ZjdhMTdkNGMyYTg1OGM5Y2Q3M2I2ZWIifQ%3D%3D\\"\\n  \\"PATH\\" => \\"\\/usr\\/bin:\\/bin:\\/usr\\/sbin:\\/sbin\\"\\n  \\"SERVER_SIGNATURE\\" => \\"\\"\\n  \\"SERVER_SOFTWARE\\" => \\"Apache\\/2.2.31 (Unix) mod_wsgi\\/3.5 Python\\/2.7.12 PHP\\/5.6.25 mod_ssl\\/2.2.31 OpenSSL\\/1.0.2h DAV\\/2 mod_fastcgi\\/2.4.6 mod_perl\\/2.0.9 Perl\\/v5.24.0\\"\\n  \\"SERVER_NAME\\" => \\"localhost\\"\\n  \\"SERVER_ADDR\\" => \\"::1\\"\\n  \\"SERVER_PORT\\" => \\"9001\\"\\n  \\"REMOTE_ADDR\\" => \\"::1\\"\\n  \\"DOCUMENT_ROOT\\" => \\"\\/Users\\/phamhung\\/Work\\/Project\\/logistics_system\\"\\n  \\"SERVER_ADMIN\\" => \\"you@example.com\\"\\n  \\"SCRIPT_FILENAME\\" => \\"\\/Users\\/phamhung\\/Work\\/Project\\/logistics_system\\/public\\/index.php\\"\\n  \\"REMOTE_PORT\\" => \\"59356\\"\\n  \\"REDIRECT_URL\\" => \\"\\/public\\/site\\/getframe\\/19\\"\\n  \\"GATEWAY_INTERFACE\\" => \\"CGI\\/1.1\\"\\n  \\"SERVER_PROTOCOL\\" => \\"HTTP\\/1.1\\"\\n  \\"REQUEST_METHOD\\" => \\"GET\\"\\n  \\"QUERY_STRING\\" => \\"\\"\\n  \\"REQUEST_URI\\" => \\"\\/site\\/getframe\\/19\\"\\n  \\"SCRIPT_NAME\\" => \\"\\/public\\/index.php\\"\\n  \\"PHP_SELF\\" => \\"\\/public\\/index.php\\"\\n  \\"REQUEST_TIME_FLOAT\\" => 1490930347.67\\n  \\"REQUEST_TIME\\" => 1490930347\\n  \\"argv\\" => []\\n  \\"argc\\" => 0\\n]","request_cookies":"array:3 [\\n  \\"SQLiteManager_currentLangue\\" => null\\n  \\"XSRF-TOKEN\\" => \\"oOqrHXkGrg1Y0S1bq8ig8l6R9VWrhszjxcS7y8yb\\"\\n  \\"laravel_session\\" => \\"76ea0079831b69bcd6085f38477d11246d31cae8\\"\\n]","response_headers":"array:3 [\\n  \\"cache-control\\" => array:1 [\\n    0 => \\"no-cache\\"\\n  ]\\n  \\"content-type\\" => array:1 [\\n    0 => \\"text\\/html; charset=UTF-8\\"\\n  ]\\n  \\"Set-Cookie\\" => array:2 [\\n    0 => \\"XSRF-TOKEN=eyJpdiI6InI1TUpHSGc4OVRQUXV5WlN0SWM1TXc9PSIsInZhbHVlIjoia29HR09XQ3Z1XC9VekZlRElUSDh5S1hKbHJJTmtwclg5QWIyaDRWZVwvQWlDdXFYbmdlRVAzbHBIU2pxS2JEODBlcjluQVhHSm1ldklpN3l0ZjNyNmwzUT09IiwibWFjIjoiYTJkMTRmMDJmYzFiMmQxMzIxYTFjOTg0YTE4MmQ3ZGIzYTBkNmQwMGUwOTlkZTg1Y2E4YzFjMWU0NmUwNmQxOCJ9; expires=Fri, 31-Mar-2017 05:19:08 GMT; path=\\/\\"\\n    1 => \\"laravel_session=eyJpdiI6ImEzWlBqUHlmTWJlcVQ5OCt6WTFKRnc9PSIsInZhbHVlIjoidU5ZNTRSV0o2dmZnTmJXWWRzSEtXQnZLR3RReHdcL0Zya3Ntc1hRWnozWm5rUGlYQ29zT21vM3N2SnBEZUY5K1VZM3FWQzZjU2hLWE5IdkVLZ2lZWmhBPT0iLCJtYWMiOiIxYmRiYjMzMTUwMmNkZjFiNzNjNWI5ZGZkZWY3ODBkM2JiZjJmNmFjNjllOWJmZGVjOTQ2ODE5MWJlOWFmODQ4In0%3D; expires=Fri, 31-Mar-2017 05:19:08 GMT; path=\\/; httponly\\"\\n  ]\\n]","path_info":"\\/site\\/getframe\\/19","session_attributes":"array:6 [\\n  \\"_token\\" => \\"oOqrHXkGrg1Y0S1bq8ig8l6R9VWrhszjxcS7y8yb\\"\\n  \\"_previous\\" => array:1 [\\n    \\"url\\" => \\"http:\\/\\/localhost:9001\\/site\\/getframe\\/19\\"\\n  ]\\n  \\"flash\\" => array:2 [\\n    \\"old\\" => []\\n    \\"new\\" => []\\n  ]\\n  \\"login_web_59ba36addc2b2f9401580f014c7f58ea4e30989d\\" => 1\\n  \\"PHPDEBUGBAR_STACK_DATA\\" => []\\n  \\"siteID\\" => \\"1\\"\\n]"}}, "f15d84f6e5dc31519601c41c8e59c6fa");\n\n</script><div class="phpdebugbar phpdebugbar-minimized phpdebugbar-closed"><div class="phpdebugbar-drag-capture"></div><div class="phpdebugbar-resize-handle" style="display: none;"></div><div class="phpdebugbar-header" style="display: none;"><div class="phpdebugbar-header-left"><a class="phpdebugbar-tab"><i class="phpdebugbar-fa phpdebugbar-fa-list-alt"></i><span class="phpdebugbar-text">Messages</span><span class="phpdebugbar-badge" style="display: none;"></span></a><a class="phpdebugbar-tab"><i class="phpdebugbar-fa phpdebugbar-fa-tasks"></i><span class="phpdebugbar-text">Timeline</span><span class="phpdebugbar-badge"></span></a><a class="phpdebugbar-tab"><i class="phpdebugbar-fa phpdebugbar-fa-bug"></i><span class="phpdebugbar-text">Exceptions</span><span class="phpdebugbar-badge" style="display: none;"></span></a><a class="phpdebugbar-tab"><i class="phpdebugbar-fa phpdebugbar-fa-leaf"></i><span class="phpdebugbar-text">Views</span><span class="phpdebugbar-badge" style="display: inline;">0</span></a><a class="phpdebugbar-tab"><i class="phpdebugbar-fa phpdebugbar-fa-share"></i><span class="phpdebugbar-text">Route</span><span class="phpdebugbar-badge"></span></a><a class="phpdebugbar-tab"><i class="phpdebugbar-fa phpdebugbar-fa-inbox"></i><span class="phpdebugbar-text">Queries</span><span class="phpdebugbar-badge" style="display: inline;">1</span></a><a class="phpdebugbar-tab"><i class="phpdebugbar-fa phpdebugbar-fa-inbox"></i><span class="phpdebugbar-text">Mails</span><span class="phpdebugbar-badge" style="display: none;"></span></a><a class="phpdebugbar-tab"><i class="phpdebugbar-fa phpdebugbar-fa-archive"></i><span class="phpdebugbar-text">Session</span><span class="phpdebugbar-badge"></span></a><a class="phpdebugbar-tab"><i class="phpdebugbar-fa phpdebugbar-fa-tags"></i><span class="phpdebugbar-text">Request</span><span class="phpdebugbar-badge"></span></a></div><div class="phpdebugbar-header-right"><a class="phpdebugbar-close-btn"></a><a class="phpdebugbar-minimize-btn"></a><a class="phpdebugbar-maximize-btn"></a><a class="phpdebugbar-open-btn" style="display: block;"></a><select class="phpdebugbar-datasets-switcher"><option value="f15d84f6e5dc31519601c41c8e59c6fa">#1 19 (10:19:08)</option></select><span class="phpdebugbar-indicator"><i class="phpdebugbar-fa phpdebugbar-fa-clock-o"></i><span class="phpdebugbar-text">740.69ms</span><span class="phpdebugbar-tooltip">Request Duration</span></span><span class="phpdebugbar-indicator"><i class="phpdebugbar-fa phpdebugbar-fa-cogs"></i><span class="phpdebugbar-text">12.5MB</span><span class="phpdebugbar-tooltip">Memory Usage</span></span><span class="phpdebugbar-indicator"><i class="phpdebugbar-fa phpdebugbar-fa-share"></i><span class="phpdebugbar-text">GET site/getframe/{frame_id}</span><span class="phpdebugbar-tooltip">Route</span></span></div></div><div class="phpdebugbar-body" style="height: 40px; display: none;"><div class="phpdebugbar-panel"><div class="phpdebugbar-widgets-messages"><ul class="phpdebugbar-widgets-list"></ul><div class="phpdebugbar-widgets-toolbar"><i class="phpdebugbar-fa phpdebugbar-fa-search"></i><input type="text"></div></div></div><div class="phpdebugbar-panel"><ul class="phpdebugbar-widgets-timeline"><li><div class="phpdebugbar-widgets-measure"><span class="phpdebugbar-widgets-value" style="left: 0%; width: 68.42%;"></span><span class="phpdebugbar-widgets-label">Booting (506.79ms)</span></div></li><li><div class="phpdebugbar-widgets-measure"><span class="phpdebugbar-widgets-value" style="left: 52.8%; width: 47.2%;"></span><span class="phpdebugbar-widgets-label">Application (349.58ms)</span></div></li></ul></div><div class="phpdebugbar-panel"><div class="phpdebugbar-widgets-exceptions"><ul class="phpdebugbar-widgets-list"></ul></div></div><div class="phpdebugbar-panel"><div class="phpdebugbar-widgets-templates"><div class="phpdebugbar-widgets-status"><span>0 templates were rendered</span></div><ul class="phpdebugbar-widgets-list"></ul></div></div><div class="phpdebugbar-panel"><dl class="phpdebugbar-widgets-kvlist phpdebugbar-widgets-varlist"><dt class="phpdebugbar-widgets-key"><span title="uri">uri</span></dt><dd class="phpdebugbar-widgets-value">GET site/getframe/{frame_id}</dd><dt class="phpdebugbar-widgets-key"><span title="middleware">middleware</span></dt><dd class="phpdebugbar-widgets-value">web</dd><dt class="phpdebugbar-widgets-key"><span title="as">as</span></dt><dd class="phpdebugbar-widgets-value">getframe</dd><dt class="phpdebugbar-widgets-key"><span title="controller">controller</span></dt><dd class="phpdebugbar-widgets-value">App\\Http\\Controllers\\SiteController@getFrame</dd><dt class="phpdebugbar-widgets-key"><span title="namespace">namespace</span></dt><dd class="phpdebugbar-widgets-value">App\\Http\\Controllers</dd><dt class="phpdebugbar-widgets-key"><span title="prefix">prefix</span></dt><dd class="phpdebugbar-widgets-value">null</dd><dt class="phpdebugbar-widgets-key"><span title="where">where</span></dt><dd class="phpdebugbar-widgets-value"></dd><dt class="phpdebugbar-widgets-key"><span title="file">file</span></dt><dd class="phpdebugbar-widgets-value">app/Http/Controllers/SiteController.php:355-360</dd></dl></div><div class="phpdebugbar-panel"><div class="phpdebugbar-widgets-sqlqueries"><div class="phpdebugbar-widgets-status"><span>1 statements were executed</span><span title="Accumulated duration" class="phpdebugbar-widgets-duration">1.78ms</span></div><div class="phpdebugbar-widgets-toolbar"><a class="phpdebugbar-widgets-filter" rel="logistics.system">logistics.system</a></div><ul class="phpdebugbar-widgets-list"><li class="phpdebugbar-widgets-list-item" connection="logistics.system" style="cursor: pointer;"><code class="phpdebugbar-widgets-sql"><span class="hljs-operator"><span class="hljs-keyword">select</span> * <span class="hljs-keyword">from</span> <span class="hljs-string">`frames`</span> <span class="hljs-keyword">where</span> <span class="hljs-string">`id`</span> = <span class="hljs-string">\'19\'</span> limit <span class="hljs-number">1</span></span></code><span title="Duration" class="phpdebugbar-widgets-duration">1.78ms</span><span title="Connection" class="phpdebugbar-widgets-database">logistics.system</span><table class="phpdebugbar-widgets-params"><tbody><tr><th colspan="2">Params</th></tr><tr><td class="phpdebugbar-widgets-name">0</td><td class="phpdebugbar-widgets-value">19</td></tr><tr><td class="phpdebugbar-widgets-name">hints</td><td class="phpdebugbar-widgets-value">Use <code>SELECT *</code> only if you need all columns from table<br><code>LIMIT</code> without <code>ORDER BY</code> causes non-deterministic results, depending on the query execution plan</td></tr></tbody></table></li></ul></div></div><div class="phpdebugbar-panel"><div class="phpdebugbar-widgets-mails"><ul class="phpdebugbar-widgets-list"></ul></div></div><div class="phpdebugbar-panel"><dl class="phpdebugbar-widgets-kvlist phpdebugbar-widgets-varlist"><dt class="phpdebugbar-widgets-key"><span title="_token">_token</span></dt><dd class="phpdebugbar-widgets-value">oOqrHXkGrg1Y0S1bq8ig8l6R9VWrhszjxcS7y8yb</dd><dt class="phpdebugbar-widgets-key"><span title="_previous">_previous</span></dt><dd class="phpdebugbar-widgets-value">array:1 [\n  "url" =&gt; "http://localhost:9001/site/getframe/19"\n]</dd><dt class="phpdebugbar-widgets-key"><span title="flash">flash</span></dt><dd class="phpdebugbar-widgets-value">array:2 [\n  "old" =&gt; []\n  "new" =&gt; []\n]</dd><dt class="phpdebugbar-widgets-key"><span title="login_web_59ba36addc2b2f9401580f014c7f58ea4e30989d">login_web_59ba36addc2b2f9401580f014c7f58ea4e30989d</span></dt><dd class="phpdebugbar-widgets-value">1</dd><dt class="phpdebugbar-widgets-key"><span title="PHPDEBUGBAR_STACK_DATA">PHPDEBUGBAR_STACK_DATA</span></dt><dd class="phpdebugbar-widgets-value">[]</dd><dt class="phpdebugbar-widgets-key"><span title="siteID">siteID</span></dt><dd class="phpdebugbar-widgets-value">1</dd></dl></div><div class="phpdebugbar-panel"><dl class="phpdebugbar-widgets-kvlist phpdebugbar-widgets-varlist"><dt class="phpdebugbar-widgets-key"><span title="format">format</span></dt><dd class="phpdebugbar-widgets-value">html</dd><dt class="phpdebugbar-widgets-key"><span title="content_type">content_type</span></dt><dd class="phpdebugbar-widgets-value">text/html; charset=UTF-8</dd><dt class="phpdebugbar-widgets-key"><span title="status_text">status_text</span></dt><dd class="phpdebugbar-widgets-value">OK</dd><dt class="phpdebugbar-widgets-key"><span title="status_code">status_code</span></dt><dd class="phpdebugbar-widgets-value">200</dd><dt class="phpdebugbar-widgets-key"><span title="request_query">request_query</span></dt><dd class="phpdebugbar-widgets-value">[]</dd><dt class="phpdebugbar-widgets-key"><span title="request_request">request_request</span></dt><dd class="phpdebugbar-widgets-value">[]</dd><dt class="phpdebugbar-widgets-key"><span title="request_headers">request_headers</span></dt><dd class="phpdebugbar-widgets-value">array:9 [\n  "host" =&gt; array:1 [\n    0 =&gt; "localhost:9001"\n  ]\n  "connection" =&gt; array:1 [\n    0 =&gt; "...</dd><dt class="phpdebugbar-widgets-key"><span title="request_server">request_server</span></dt><dd class="phpdebugbar-widgets-value">array:34 [\n  "REDIRECT_REDIRECT_STATUS" =&gt; "200"\n  "REDIRECT_STATUS" =&gt; "200"\n  "HTTP_HOST" =&gt; "loca...</dd><dt class="phpdebugbar-widgets-key"><span title="request_cookies">request_cookies</span></dt><dd class="phpdebugbar-widgets-value">array:3 [\n  "SQLiteManager_currentLangue" =&gt; null\n  "XSRF-TOKEN" =&gt; "oOqrHXkGrg1Y0S1bq8ig8l6R9VWrhsz...</dd><dt class="phpdebugbar-widgets-key"><span title="response_headers">response_headers</span></dt><dd class="phpdebugbar-widgets-value">array:3 [\n  "cache-control" =&gt; array:1 [\n    0 =&gt; "no-cache"\n  ]\n  "content-type" =&gt; array:1 [\n    0...</dd><dt class="phpdebugbar-widgets-key"><span title="path_info">path_info</span></dt><dd class="phpdebugbar-widgets-value">/site/getframe/19</dd><dt class="phpdebugbar-widgets-key"><span title="session_attributes">session_attributes</span></dt><dd class="phpdebugbar-widgets-value">array:6 [\n  "_token" =&gt; "oOqrHXkGrg1Y0S1bq8ig8l6R9VWrhszjxcS7y8yb"\n  "_previous" =&gt; array:1 [\n    "u...</dd></dl></div></div><a class="phpdebugbar-restore-btn" style=""></a></div><div class="phpdebugbar-openhandler" style="display: none;"><div class="phpdebugbar-openhandler-header">PHP DebugBar | Open<a><i class="phpdebugbar-fa phpdebugbar-fa-times"></i></a></div><table><thead><tr><th width="150">Date</th><th width="55">Method</th><th>URL</th><th width="125">IP</th><th width="100">Filter data</th></tr></thead><tbody></tbody></table><div class="phpdebugbar-openhandler-actions"><a>Load more</a><a>Show only current URL</a><a>Show all</a><a>Delete all</a><form><br><b>Filter results</b><br>Method: <select name="method"><option></option><option>GET</option><option>POST</option><option>PUT</option><option>DELETE</option></select><br>Uri: <input type="text" name="uri"><br>IP: <input type="text" name="ip"><br><button type="submit">Search</button></form></div></div><div class="phpdebugbar-openhandler-overlay" style="display: none;"></div>\n</body>', 500, NULL, '', 0, 1, '2017-03-31 03:21:25', '2017-03-31 03:23:22');
INSERT INTO `frames` (`id`, `page_id`, `site_id`, `content`, `height`, `original_url`, `loaderfunction`, `sandbox`, `revision`, `created_at`, `updated_at`) VALUES
(26, 1, 1, '<html><head>\n	<!-- Basic Page Needs\n    ================================================== -->\n	<meta charset="utf-8">\n	<title>FLATPACK</title>\n	<meta name="description" content="">\n	<meta name="author" content="">\n	<!-- Mobile Specific Metas\n    ================================================== -->\n	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">\n	<!-- CSS\n    ================================================== -->\n	<link rel="stylesheet" href="stylesheets/menu.css">\n    <link rel="stylesheet" href="stylesheets/flat-ui-slider.css">\n    <link rel="stylesheet" href="stylesheets/base.css">\n    <link rel="stylesheet" href="stylesheets/skeleton.css">\n    <link rel="stylesheet" href="stylesheets/landings.css">\n    <link rel="stylesheet" href="stylesheets/main.css">\n    <link rel="stylesheet" href="stylesheets/landings_layouts.css">\n    <link rel="stylesheet" href="stylesheets/box.css">\n    <link rel="stylesheet" href="stylesheets/pixicon.css">\n\n	<!--[if lt IE 9]>\n		<script src="http://html5shim.googlecode.com/svn/trunk/httpml5.js"></script>\n	<![endif]-->\n	<!-- Favicons\n	================================================== -->\n	<link rel="shortcut icon" href="images/favicon.ico">\n	<link rel="apple-touch-icon" href="images/apple-touch-icon.png">\n	<link rel="apple-touch-icon" sizes="72x72" href="images/apple-touch-icon-72x72.png">\n	<link rel="apple-touch-icon" sizes="114x114" href="images/apple-touch-icon-114x114.png">\n</head><body style="">\n\n<div id="page">\n    <div class="hl2 pix_builder_bg" id="section_highlight_2">\n        <div class="big_padding highlight-section">\n            <div class="highlight-right pix_builder_bg"></div>\n            <div class="container">\n                <div class="sixteen columns">\n                    <div class="eight columns alpha">\n                        <br>\n                    </div>                 \n                    <div class="eight columns omega ">\n                        <div class="highlight_inner">\n                            <p class="big_title editContent">Delicious Meals Weekly in Inbox</p>\n                            <p class="bold_text margin_bottom normal_text orange editContent">OUR SERVICE IS TOTALLY FREE</p>\n                            <p class="normal_text light_gray editContent">Lorem ipsum dolor sit amet consectetur adipiscing elit sed do eiusmod tempor incididunt ut labore et dolore magna aliqua Ut enim ad minim veniam quis nostrud exercitation ullamco laboris nisi ut aliquip ex commodo consequat Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat.</p>\n                            <a href="#" class="pix_button pix_button_line brown bold_text editContent"><i class="pi pixicon-heart"></i>Add to Favorits</a>\n                        </div>\n                    </div>\n                </div>\n           </div>\n        </div>\n    </div>\n</div>\n\n<script src="js/jquery-1.8.3.min.js" type="text/javascript"></script>\n<script src="jsfiles/jquery.easing.1.3.js" type="text/javascript"></script>\n<script src="jsfiles/jquery.common.min.js" type="text/javascript"></script>\n<script src="jsfiles/jquery.ui.touch-punch.min.js"></script>\n<script src="jsfiles/ticker.js" type="text/javascript"></script>\n<script src="jsfiles/bootstrap.min.js"></script>\n<script src="jsfiles/bootstrap-switch.js"></script>\n<script src="assets/js/appear.min.js" type="text/javascript"></script>\n<script src="jsfiles/custom.js" type="text/javascript"></script>\n<script src="jsfiles/custom3.js" type="text/javascript"></script>\n\n<link rel="stylesheet" type="text/css" property="stylesheet" href="http://localhost:9001/_debugbar/assets/stylesheets?v=1473948356"><script type="text/javascript" src="http://localhost:9001/_debugbar/assets/javascript?v=1473948119"></script><script type="text/javascript">jQuery.noConflict(true);</script>\n<script type="text/javascript">\nvar phpdebugbar = new PhpDebugBar.DebugBar();\nphpdebugbar.addTab("messages", new PhpDebugBar.DebugBar.Tab({"icon":"list-alt","title":"Messages", "widget": new PhpDebugBar.Widgets.MessagesWidget()}));\nphpdebugbar.addIndicator("time", new PhpDebugBar.DebugBar.Indicator({"icon":"clock-o","tooltip":"Request Duration"}), "right");\nphpdebugbar.addTab("timeline", new PhpDebugBar.DebugBar.Tab({"icon":"tasks","title":"Timeline", "widget": new PhpDebugBar.Widgets.TimelineWidget()}));\nphpdebugbar.addIndicator("memory", new PhpDebugBar.DebugBar.Indicator({"icon":"cogs","tooltip":"Memory Usage"}), "right");\nphpdebugbar.addTab("exceptions", new PhpDebugBar.DebugBar.Tab({"icon":"bug","title":"Exceptions", "widget": new PhpDebugBar.Widgets.ExceptionsWidget()}));\nphpdebugbar.addTab("views", new PhpDebugBar.DebugBar.Tab({"icon":"leaf","title":"Views", "widget": new PhpDebugBar.Widgets.TemplatesWidget()}));\nphpdebugbar.addTab("route", new PhpDebugBar.DebugBar.Tab({"icon":"share","title":"Route", "widget": new PhpDebugBar.Widgets.VariableListWidget()}));\nphpdebugbar.addIndicator("currentroute", new PhpDebugBar.DebugBar.Indicator({"icon":"share","tooltip":"Route"}), "right");\nphpdebugbar.addTab("queries", new PhpDebugBar.DebugBar.Tab({"icon":"inbox","title":"Queries", "widget": new PhpDebugBar.Widgets.SQLQueriesWidget()}));\nphpdebugbar.addTab("emails", new PhpDebugBar.DebugBar.Tab({"icon":"inbox","title":"Mails", "widget": new PhpDebugBar.Widgets.MailsWidget()}));\nphpdebugbar.addTab("session", new PhpDebugBar.DebugBar.Tab({"icon":"archive","title":"Session", "widget": new PhpDebugBar.Widgets.VariableListWidget()}));\nphpdebugbar.addTab("request", new PhpDebugBar.DebugBar.Tab({"icon":"tags","title":"Request", "widget": new PhpDebugBar.Widgets.VariableListWidget()}));\nphpdebugbar.setDataMap({\n"messages": ["messages.messages", []],\n"messages:badge": ["messages.count", null],\n"time": ["time.duration_str", \'0ms\'],\n"timeline": ["time", {}],\n"memory": ["memory.peak_usage_str", \'0B\'],\n"exceptions": ["exceptions.exceptions", []],\n"exceptions:badge": ["exceptions.count", null],\n"views": ["views", []],\n"views:badge": ["views.nb_templates", 0],\n"route": ["route", {}],\n"currentroute": ["route.uri", ],\n"queries": ["queries", []],\n"queries:badge": ["queries.nb_statements", 0],\n"emails": ["swiftmailer_mails.mails", []],\n"emails:badge": ["swiftmailer_mails.count", null],\n"session": ["session", {}],\n"request": ["request", {}]\n});\nphpdebugbar.restoreState();\nphpdebugbar.ajaxHandler = new PhpDebugBar.AjaxHandler(phpdebugbar);\nphpdebugbar.ajaxHandler.bindToXHR();\nphpdebugbar.setOpenHandler(new PhpDebugBar.OpenHandler({"url":"http:\\/\\/localhost:9001\\/_debugbar\\/open"}));\nphpdebugbar.addDataSet({"__meta":{"id":"4cbff699ab910c89dd51d514adc85b4a","datetime":"2017-03-31 10:19:08","utime":1490930348.42,"method":"GET","uri":"\\/site\\/getframe\\/20","ip":"::1"},"php":{"version":"5.6.25","interface":"apache2handler"},"messages":{"count":0,"messages":[]},"time":{"start":1490930347.67,"end":1490930348.42,"duration":0.751523017883,"duration_str":"751.52ms","measures":[{"label":"Booting","start":1490930347.67,"relative_start":0,"end":1490930348.27,"relative_end":1490930348.27,"duration":0.598243951797,"duration_str":"598.24ms","params":[],"collector":null},{"label":"Application","start":1490930348.08,"relative_start":0.410331964493,"end":1490930348.42,"relative_end":1.19209289551e-5,"duration":0.341202974319,"duration_str":"341.2ms","params":[],"collector":null}]},"memory":{"peak_usage":13107200,"peak_usage_str":"12.5MB"},"exceptions":{"count":0,"exceptions":[]},"views":{"nb_templates":0,"templates":[]},"route":{"uri":"GET site\\/getframe\\/{frame_id}","middleware":"web","as":"getframe","controller":"App\\\\Http\\\\Controllers\\\\SiteController@getFrame","namespace":"App\\\\Http\\\\Controllers","prefix":null,"where":[],"file":"app\\/Http\\/Controllers\\/SiteController.php:355-360"},"queries":{"nb_statements":1,"nb_failed_statements":0,"accumulated_duration":0.0009,"accumulated_duration_str":"900\\u03bcs","statements":[{"sql":"select * from `frames` where `id` = \'20\' limit 1","params":{"0":"20","hints":"Use <code>SELECT *<\\/code> only if you need all columns from table<br \\/><code>LIMIT<\\/code> without <code>ORDER BY<\\/code> causes non-deterministic results, depending on the query execution plan"},"duration":0.0009,"duration_str":"900\\u03bcs","stmt_id":null,"connection":"logistics.system"}]},"swiftmailer_mails":{"count":0,"mails":[]},"session":{"_token":"oOqrHXkGrg1Y0S1bq8ig8l6R9VWrhszjxcS7y8yb","_previous":"array:1 [\\n  \\"url\\" => \\"http:\\/\\/localhost:9001\\/site\\/getframe\\/20\\"\\n]","flash":"array:2 [\\n  \\"old\\" => []\\n  \\"new\\" => []\\n]","login_web_59ba36addc2b2f9401580f014c7f58ea4e30989d":"1","PHPDEBUGBAR_STACK_DATA":"[]","siteID":"1"},"request":{"format":"html","content_type":"text\\/html; charset=UTF-8","status_text":"OK","status_code":"200","request_query":"[]","request_request":"[]","request_headers":"array:9 [\\n  \\"host\\" => array:1 [\\n    0 => \\"localhost:9001\\"\\n  ]\\n  \\"connection\\" => array:1 [\\n    0 => \\"keep-alive\\"\\n  ]\\n  \\"upgrade-insecure-requests\\" => array:1 [\\n    0 => \\"1\\"\\n  ]\\n  \\"user-agent\\" => array:1 [\\n    0 => \\"Mozilla\\/5.0 (Macintosh; Intel Mac OS X 10_11_6) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/56.0.2924.87 Safari\\/537.36\\"\\n  ]\\n  \\"accept\\" => array:1 [\\n    0 => \\"text\\/html,application\\/xhtml+xml,application\\/xml;q=0.9,image\\/webp,*\\/*;q=0.8\\"\\n  ]\\n  \\"referer\\" => array:1 [\\n    0 => \\"http:\\/\\/localhost:9001\\/system\\/landing-page\\/site\\/1\\"\\n  ]\\n  \\"accept-encoding\\" => array:1 [\\n    0 => \\"gzip, deflate, sdch, br\\"\\n  ]\\n  \\"accept-language\\" => array:1 [\\n    0 => \\"vi-VN,vi;q=0.8,fr-FR;q=0.6,fr;q=0.4,en-US;q=0.2,en;q=0.2\\"\\n  ]\\n  \\"cookie\\" => array:1 [\\n    0 => \\"SQLiteManager_currentLangue=2; XSRF-TOKEN=eyJpdiI6ImJQZ3VPc1FBMUtJZE5wVHZsWnJGT1E9PSIsInZhbHVlIjoiQVJOVUpkMTU5RE8zTEk2UEM0RUxvWms4S0ZqRGpSXC9LS1RySUNXNTgzUEVvYmd5TWlHN0JRUnBxYkc0RDI2Y01WRFZBTnRGaCsrUk9mUjIzWDUyUWR3PT0iLCJtYWMiOiJlODNlNDA1OWVmY2MwNzRjOWRlZmYwZmZiMTA1Y2Q4ZTM3M2YxODVhNzg4NGNmY2JmYTJmMWU4N2M1ODFjNmEwIn0%3D; laravel_session=eyJpdiI6IllVXC9GK2FObmRWVzdGWlUxd1lGOTZ3PT0iLCJ2YWx1ZSI6IjdRSzNQRnh1emx5QkdSTlRcL09lNFpzZGhXQnhQOXNEMkU5RWs3WVhteEVqQTVyMTBpNUJrYm95UHE1YW1NblBVelwvb01pQlVpbFc1aG1CWUUySTVrTnc9PSIsIm1hYyI6ImM1NDA3MzliOTAzYjgwODQ0YjU5NmE3ZWY0YjNhN2U5Nzk2MmVkOTQ5ZjdhMTdkNGMyYTg1OGM5Y2Q3M2I2ZWIifQ%3D%3D\\"\\n  ]\\n]","request_server":"array:34 [\\n  \\"REDIRECT_REDIRECT_STATUS\\" => \\"200\\"\\n  \\"REDIRECT_STATUS\\" => \\"200\\"\\n  \\"HTTP_HOST\\" => \\"localhost:9001\\"\\n  \\"HTTP_CONNECTION\\" => \\"keep-alive\\"\\n  \\"HTTP_UPGRADE_INSECURE_REQUESTS\\" => \\"1\\"\\n  \\"HTTP_USER_AGENT\\" => \\"Mozilla\\/5.0 (Macintosh; Intel Mac OS X 10_11_6) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/56.0.2924.87 Safari\\/537.36\\"\\n  \\"HTTP_ACCEPT\\" => \\"text\\/html,application\\/xhtml+xml,application\\/xml;q=0.9,image\\/webp,*\\/*;q=0.8\\"\\n  \\"HTTP_REFERER\\" => \\"http:\\/\\/localhost:9001\\/system\\/landing-page\\/site\\/1\\"\\n  \\"HTTP_ACCEPT_ENCODING\\" => \\"gzip, deflate, sdch, br\\"\\n  \\"HTTP_ACCEPT_LANGUAGE\\" => \\"vi-VN,vi;q=0.8,fr-FR;q=0.6,fr;q=0.4,en-US;q=0.2,en;q=0.2\\"\\n  \\"HTTP_COOKIE\\" => \\"SQLiteManager_currentLangue=2; XSRF-TOKEN=eyJpdiI6ImJQZ3VPc1FBMUtJZE5wVHZsWnJGT1E9PSIsInZhbHVlIjoiQVJOVUpkMTU5RE8zTEk2UEM0RUxvWms4S0ZqRGpSXC9LS1RySUNXNTgzUEVvYmd5TWlHN0JRUnBxYkc0RDI2Y01WRFZBTnRGaCsrUk9mUjIzWDUyUWR3PT0iLCJtYWMiOiJlODNlNDA1OWVmY2MwNzRjOWRlZmYwZmZiMTA1Y2Q4ZTM3M2YxODVhNzg4NGNmY2JmYTJmMWU4N2M1ODFjNmEwIn0%3D; laravel_session=eyJpdiI6IllVXC9GK2FObmRWVzdGWlUxd1lGOTZ3PT0iLCJ2YWx1ZSI6IjdRSzNQRnh1emx5QkdSTlRcL09lNFpzZGhXQnhQOXNEMkU5RWs3WVhteEVqQTVyMTBpNUJrYm95UHE1YW1NblBVelwvb01pQlVpbFc1aG1CWUUySTVrTnc9PSIsIm1hYyI6ImM1NDA3MzliOTAzYjgwODQ0YjU5NmE3ZWY0YjNhN2U5Nzk2MmVkOTQ5ZjdhMTdkNGMyYTg1OGM5Y2Q3M2I2ZWIifQ%3D%3D\\"\\n  \\"PATH\\" => \\"\\/usr\\/bin:\\/bin:\\/usr\\/sbin:\\/sbin\\"\\n  \\"SERVER_SIGNATURE\\" => \\"\\"\\n  \\"SERVER_SOFTWARE\\" => \\"Apache\\/2.2.31 (Unix) mod_wsgi\\/3.5 Python\\/2.7.12 PHP\\/5.6.25 mod_ssl\\/2.2.31 OpenSSL\\/1.0.2h DAV\\/2 mod_fastcgi\\/2.4.6 mod_perl\\/2.0.9 Perl\\/v5.24.0\\"\\n  \\"SERVER_NAME\\" => \\"localhost\\"\\n  \\"SERVER_ADDR\\" => \\"::1\\"\\n  \\"SERVER_PORT\\" => \\"9001\\"\\n  \\"REMOTE_ADDR\\" => \\"::1\\"\\n  \\"DOCUMENT_ROOT\\" => \\"\\/Users\\/phamhung\\/Work\\/Project\\/logistics_system\\"\\n  \\"SERVER_ADMIN\\" => \\"you@example.com\\"\\n  \\"SCRIPT_FILENAME\\" => \\"\\/Users\\/phamhung\\/Work\\/Project\\/logistics_system\\/public\\/index.php\\"\\n  \\"REMOTE_PORT\\" => \\"59357\\"\\n  \\"REDIRECT_URL\\" => \\"\\/public\\/site\\/getframe\\/20\\"\\n  \\"GATEWAY_INTERFACE\\" => \\"CGI\\/1.1\\"\\n  \\"SERVER_PROTOCOL\\" => \\"HTTP\\/1.1\\"\\n  \\"REQUEST_METHOD\\" => \\"GET\\"\\n  \\"QUERY_STRING\\" => \\"\\"\\n  \\"REQUEST_URI\\" => \\"\\/site\\/getframe\\/20\\"\\n  \\"SCRIPT_NAME\\" => \\"\\/public\\/index.php\\"\\n  \\"PHP_SELF\\" => \\"\\/public\\/index.php\\"\\n  \\"REQUEST_TIME_FLOAT\\" => 1490930347.67\\n  \\"REQUEST_TIME\\" => 1490930347\\n  \\"argv\\" => []\\n  \\"argc\\" => 0\\n]","request_cookies":"array:3 [\\n  \\"SQLiteManager_currentLangue\\" => null\\n  \\"XSRF-TOKEN\\" => \\"oOqrHXkGrg1Y0S1bq8ig8l6R9VWrhszjxcS7y8yb\\"\\n  \\"laravel_session\\" => \\"76ea0079831b69bcd6085f38477d11246d31cae8\\"\\n]","response_headers":"array:3 [\\n  \\"cache-control\\" => array:1 [\\n    0 => \\"no-cache\\"\\n  ]\\n  \\"content-type\\" => array:1 [\\n    0 => \\"text\\/html; charset=UTF-8\\"\\n  ]\\n  \\"Set-Cookie\\" => array:2 [\\n    0 => \\"XSRF-TOKEN=eyJpdiI6IjRCT3B1cTBXb2xETFNvK3ZkMG9hQlE9PSIsInZhbHVlIjoiS2VlaStKSFo2SnRwZmw2dlRZVHF6UDlwMExkNHNrTVlPSE1MR2FKcHNtcElWdDU0RTJMemFYTFRZTGlDYU5YXC9LQXZ1WGJFcHowc1NpVTN3eHA5bFRRPT0iLCJtYWMiOiJmZTUxMDVhNWNhYThmYTU1MDEzNGRhNDQ4NzI1MTM5NzM2NDUyODcwZmIxNzVlYWU4MjY4OGE5OWU5YTA0ZThhIn0%3D; expires=Fri, 31-Mar-2017 05:19:08 GMT; path=\\/\\"\\n    1 => \\"laravel_session=eyJpdiI6IjJLZEZoek5hWlUyYTBBUmplUEJDaGc9PSIsInZhbHVlIjoiVUJTamNUamRwbDBoZmtYa3A4R09sYVRNbVwvcFNkN2xBTnVMNlRuVlRmTVwvRm5wNmNwWEY1OHBsQWpIc1RVVGh3U3BYZ1EyZzZZZ1dCcTFsQzhzVlhUdz09IiwibWFjIjoiZWZlNDM0MDE2YTYwYzE5MGY0YzkzMTAwOTFjYTllODc2MGZiNzY2YmZhMDRmYjM2NTY0YTUwMzIxZjFkODY2NyJ9; expires=Fri, 31-Mar-2017 05:19:08 GMT; path=\\/; httponly\\"\\n  ]\\n]","path_info":"\\/site\\/getframe\\/20","session_attributes":"array:6 [\\n  \\"_token\\" => \\"oOqrHXkGrg1Y0S1bq8ig8l6R9VWrhszjxcS7y8yb\\"\\n  \\"_previous\\" => array:1 [\\n    \\"url\\" => \\"http:\\/\\/localhost:9001\\/site\\/getframe\\/20\\"\\n  ]\\n  \\"flash\\" => array:2 [\\n    \\"old\\" => []\\n    \\"new\\" => []\\n  ]\\n  \\"login_web_59ba36addc2b2f9401580f014c7f58ea4e30989d\\" => 1\\n  \\"PHPDEBUGBAR_STACK_DATA\\" => []\\n  \\"siteID\\" => \\"1\\"\\n]"}}, "4cbff699ab910c89dd51d514adc85b4a");\n\n</script><div class="phpdebugbar phpdebugbar-minimized phpdebugbar-closed"><div class="phpdebugbar-drag-capture"></div><div class="phpdebugbar-resize-handle" style="display: none;"></div><div class="phpdebugbar-header" style="display: none;"><div class="phpdebugbar-header-left"><a class="phpdebugbar-tab"><i class="phpdebugbar-fa phpdebugbar-fa-list-alt"></i><span class="phpdebugbar-text">Messages</span><span class="phpdebugbar-badge" style="display: none;"></span></a><a class="phpdebugbar-tab"><i class="phpdebugbar-fa phpdebugbar-fa-tasks"></i><span class="phpdebugbar-text">Timeline</span><span class="phpdebugbar-badge"></span></a><a class="phpdebugbar-tab"><i class="phpdebugbar-fa phpdebugbar-fa-bug"></i><span class="phpdebugbar-text">Exceptions</span><span class="phpdebugbar-badge" style="display: none;"></span></a><a class="phpdebugbar-tab"><i class="phpdebugbar-fa phpdebugbar-fa-leaf"></i><span class="phpdebugbar-text">Views</span><span class="phpdebugbar-badge" style="display: inline;">0</span></a><a class="phpdebugbar-tab"><i class="phpdebugbar-fa phpdebugbar-fa-share"></i><span class="phpdebugbar-text">Route</span><span class="phpdebugbar-badge"></span></a><a class="phpdebugbar-tab"><i class="phpdebugbar-fa phpdebugbar-fa-inbox"></i><span class="phpdebugbar-text">Queries</span><span class="phpdebugbar-badge" style="display: inline;">1</span></a><a class="phpdebugbar-tab"><i class="phpdebugbar-fa phpdebugbar-fa-inbox"></i><span class="phpdebugbar-text">Mails</span><span class="phpdebugbar-badge" style="display: none;"></span></a><a class="phpdebugbar-tab"><i class="phpdebugbar-fa phpdebugbar-fa-archive"></i><span class="phpdebugbar-text">Session</span><span class="phpdebugbar-badge"></span></a><a class="phpdebugbar-tab"><i class="phpdebugbar-fa phpdebugbar-fa-tags"></i><span class="phpdebugbar-text">Request</span><span class="phpdebugbar-badge"></span></a></div><div class="phpdebugbar-header-right"><a class="phpdebugbar-close-btn"></a><a class="phpdebugbar-minimize-btn"></a><a class="phpdebugbar-maximize-btn"></a><a class="phpdebugbar-open-btn" style="display: block;"></a><select class="phpdebugbar-datasets-switcher"><option value="4cbff699ab910c89dd51d514adc85b4a">#1 20 (10:19:08)</option></select><span class="phpdebugbar-indicator"><i class="phpdebugbar-fa phpdebugbar-fa-clock-o"></i><span class="phpdebugbar-text">751.52ms</span><span class="phpdebugbar-tooltip">Request Duration</span></span><span class="phpdebugbar-indicator"><i class="phpdebugbar-fa phpdebugbar-fa-cogs"></i><span class="phpdebugbar-text">12.5MB</span><span class="phpdebugbar-tooltip">Memory Usage</span></span><span class="phpdebugbar-indicator"><i class="phpdebugbar-fa phpdebugbar-fa-share"></i><span class="phpdebugbar-text">GET site/getframe/{frame_id}</span><span class="phpdebugbar-tooltip">Route</span></span></div></div><div class="phpdebugbar-body" style="height: 40px; display: none;"><div class="phpdebugbar-panel"><div class="phpdebugbar-widgets-messages"><ul class="phpdebugbar-widgets-list"></ul><div class="phpdebugbar-widgets-toolbar"><i class="phpdebugbar-fa phpdebugbar-fa-search"></i><input type="text"></div></div></div><div class="phpdebugbar-panel"><ul class="phpdebugbar-widgets-timeline"><li><div class="phpdebugbar-widgets-measure"><span class="phpdebugbar-widgets-value" style="left: 0%; width: 79.6%;"></span><span class="phpdebugbar-widgets-label">Booting (598.24ms)</span></div></li><li><div class="phpdebugbar-widgets-measure"><span class="phpdebugbar-widgets-value" style="left: 54.6%; width: 45.4%;"></span><span class="phpdebugbar-widgets-label">Application (341.2ms)</span></div></li></ul></div><div class="phpdebugbar-panel"><div class="phpdebugbar-widgets-exceptions"><ul class="phpdebugbar-widgets-list"></ul></div></div><div class="phpdebugbar-panel"><div class="phpdebugbar-widgets-templates"><div class="phpdebugbar-widgets-status"><span>0 templates were rendered</span></div><ul class="phpdebugbar-widgets-list"></ul></div></div><div class="phpdebugbar-panel"><dl class="phpdebugbar-widgets-kvlist phpdebugbar-widgets-varlist"><dt class="phpdebugbar-widgets-key"><span title="uri">uri</span></dt><dd class="phpdebugbar-widgets-value">GET site/getframe/{frame_id}</dd><dt class="phpdebugbar-widgets-key"><span title="middleware">middleware</span></dt><dd class="phpdebugbar-widgets-value">web</dd><dt class="phpdebugbar-widgets-key"><span title="as">as</span></dt><dd class="phpdebugbar-widgets-value">getframe</dd><dt class="phpdebugbar-widgets-key"><span title="controller">controller</span></dt><dd class="phpdebugbar-widgets-value">App\\Http\\Controllers\\SiteController@getFrame</dd><dt class="phpdebugbar-widgets-key"><span title="namespace">namespace</span></dt><dd class="phpdebugbar-widgets-value">App\\Http\\Controllers</dd><dt class="phpdebugbar-widgets-key"><span title="prefix">prefix</span></dt><dd class="phpdebugbar-widgets-value">null</dd><dt class="phpdebugbar-widgets-key"><span title="where">where</span></dt><dd class="phpdebugbar-widgets-value"></dd><dt class="phpdebugbar-widgets-key"><span title="file">file</span></dt><dd class="phpdebugbar-widgets-value">app/Http/Controllers/SiteController.php:355-360</dd></dl></div><div class="phpdebugbar-panel"><div class="phpdebugbar-widgets-sqlqueries"><div class="phpdebugbar-widgets-status"><span>1 statements were executed</span><span title="Accumulated duration" class="phpdebugbar-widgets-duration">900μs</span></div><div class="phpdebugbar-widgets-toolbar"><a class="phpdebugbar-widgets-filter" rel="logistics.system">logistics.system</a></div><ul class="phpdebugbar-widgets-list"><li class="phpdebugbar-widgets-list-item" connection="logistics.system" style="cursor: pointer;"><code class="phpdebugbar-widgets-sql"><span class="hljs-operator"><span class="hljs-keyword">select</span> * <span class="hljs-keyword">from</span> <span class="hljs-string">`frames`</span> <span class="hljs-keyword">where</span> <span class="hljs-string">`id`</span> = <span class="hljs-string">\'20\'</span> limit <span class="hljs-number">1</span></span></code><span title="Duration" class="phpdebugbar-widgets-duration">900μs</span><span title="Connection" class="phpdebugbar-widgets-database">logistics.system</span><table class="phpdebugbar-widgets-params"><tbody><tr><th colspan="2">Params</th></tr><tr><td class="phpdebugbar-widgets-name">0</td><td class="phpdebugbar-widgets-value">20</td></tr><tr><td class="phpdebugbar-widgets-name">hints</td><td class="phpdebugbar-widgets-value">Use <code>SELECT *</code> only if you need all columns from table<br><code>LIMIT</code> without <code>ORDER BY</code> causes non-deterministic results, depending on the query execution plan</td></tr></tbody></table></li></ul></div></div><div class="phpdebugbar-panel"><div class="phpdebugbar-widgets-mails"><ul class="phpdebugbar-widgets-list"></ul></div></div><div class="phpdebugbar-panel"><dl class="phpdebugbar-widgets-kvlist phpdebugbar-widgets-varlist"><dt class="phpdebugbar-widgets-key"><span title="_token">_token</span></dt><dd class="phpdebugbar-widgets-value">oOqrHXkGrg1Y0S1bq8ig8l6R9VWrhszjxcS7y8yb</dd><dt class="phpdebugbar-widgets-key"><span title="_previous">_previous</span></dt><dd class="phpdebugbar-widgets-value">array:1 [\n  "url" =&gt; "http://localhost:9001/site/getframe/20"\n]</dd><dt class="phpdebugbar-widgets-key"><span title="flash">flash</span></dt><dd class="phpdebugbar-widgets-value">array:2 [\n  "old" =&gt; []\n  "new" =&gt; []\n]</dd><dt class="phpdebugbar-widgets-key"><span title="login_web_59ba36addc2b2f9401580f014c7f58ea4e30989d">login_web_59ba36addc2b2f9401580f014c7f58ea4e30989d</span></dt><dd class="phpdebugbar-widgets-value">1</dd><dt class="phpdebugbar-widgets-key"><span title="PHPDEBUGBAR_STACK_DATA">PHPDEBUGBAR_STACK_DATA</span></dt><dd class="phpdebugbar-widgets-value">[]</dd><dt class="phpdebugbar-widgets-key"><span title="siteID">siteID</span></dt><dd class="phpdebugbar-widgets-value">1</dd></dl></div><div class="phpdebugbar-panel"><dl class="phpdebugbar-widgets-kvlist phpdebugbar-widgets-varlist"><dt class="phpdebugbar-widgets-key"><span title="format">format</span></dt><dd class="phpdebugbar-widgets-value">html</dd><dt class="phpdebugbar-widgets-key"><span title="content_type">content_type</span></dt><dd class="phpdebugbar-widgets-value">text/html; charset=UTF-8</dd><dt class="phpdebugbar-widgets-key"><span title="status_text">status_text</span></dt><dd class="phpdebugbar-widgets-value">OK</dd><dt class="phpdebugbar-widgets-key"><span title="status_code">status_code</span></dt><dd class="phpdebugbar-widgets-value">200</dd><dt class="phpdebugbar-widgets-key"><span title="request_query">request_query</span></dt><dd class="phpdebugbar-widgets-value">[]</dd><dt class="phpdebugbar-widgets-key"><span title="request_request">request_request</span></dt><dd class="phpdebugbar-widgets-value">[]</dd><dt class="phpdebugbar-widgets-key"><span title="request_headers">request_headers</span></dt><dd class="phpdebugbar-widgets-value">array:9 [\n  "host" =&gt; array:1 [\n    0 =&gt; "localhost:9001"\n  ]\n  "connection" =&gt; array:1 [\n    0 =&gt; "...</dd><dt class="phpdebugbar-widgets-key"><span title="request_server">request_server</span></dt><dd class="phpdebugbar-widgets-value">array:34 [\n  "REDIRECT_REDIRECT_STATUS" =&gt; "200"\n  "REDIRECT_STATUS" =&gt; "200"\n  "HTTP_HOST" =&gt; "loca...</dd><dt class="phpdebugbar-widgets-key"><span title="request_cookies">request_cookies</span></dt><dd class="phpdebugbar-widgets-value">array:3 [\n  "SQLiteManager_currentLangue" =&gt; null\n  "XSRF-TOKEN" =&gt; "oOqrHXkGrg1Y0S1bq8ig8l6R9VWrhsz...</dd><dt class="phpdebugbar-widgets-key"><span title="response_headers">response_headers</span></dt><dd class="phpdebugbar-widgets-value">array:3 [\n  "cache-control" =&gt; array:1 [\n    0 =&gt; "no-cache"\n  ]\n  "content-type" =&gt; array:1 [\n    0...</dd><dt class="phpdebugbar-widgets-key"><span title="path_info">path_info</span></dt><dd class="phpdebugbar-widgets-value">/site/getframe/20</dd><dt class="phpdebugbar-widgets-key"><span title="session_attributes">session_attributes</span></dt><dd class="phpdebugbar-widgets-value">array:6 [\n  "_token" =&gt; "oOqrHXkGrg1Y0S1bq8ig8l6R9VWrhszjxcS7y8yb"\n  "_previous" =&gt; array:1 [\n    "u...</dd></dl></div></div><a class="phpdebugbar-restore-btn" style=""></a></div><div class="phpdebugbar-openhandler" style="display: none;"><div class="phpdebugbar-openhandler-header">PHP DebugBar | Open<a><i class="phpdebugbar-fa phpdebugbar-fa-times"></i></a></div><table><thead><tr><th width="150">Date</th><th width="55">Method</th><th>URL</th><th width="125">IP</th><th width="100">Filter data</th></tr></thead><tbody></tbody></table><div class="phpdebugbar-openhandler-actions"><a>Load more</a><a>Show only current URL</a><a>Show all</a><a>Delete all</a><form><br><b>Filter results</b><br>Method: <select name="method"><option></option><option>GET</option><option>POST</option><option>PUT</option><option>DELETE</option></select><br>Uri: <input type="text" name="uri"><br>IP: <input type="text" name="ip"><br><button type="submit">Search</button></form></div></div><div class="phpdebugbar-openhandler-overlay" style="display: none;"></div>\n</body>', 500, NULL, '', 0, 1, '2017-03-31 03:21:25', '2017-03-31 03:23:22'),
(27, 1, 1, '<html><head>\n	<!-- Basic Page Needs\n    ================================================== -->\n    <meta charset="utf-8">\n    <title>PixFort</title>\n    <meta name="description" content="">\n    <meta name="author" content="">\n	<!-- Mobile Specific Metas\n    ================================================== -->\n    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">\n	<!-- CSS\n    ================================================== -->\n    <link rel="stylesheet" href="stylesheets/menu.css">\n    <link rel="stylesheet" href="stylesheets/flat-ui-slider.css">\n    <link rel="stylesheet" href="stylesheets/base.css">\n    <link rel="stylesheet" href="stylesheets/skeleton.css">\n    <link rel="stylesheet" href="stylesheets/landings.css">\n    <link rel="stylesheet" href="stylesheets/main.css">\n    <link rel="stylesheet" href="stylesheets/landings_layouts.css">\n    <link rel="stylesheet" href="stylesheets/box.css">\n    <link rel="stylesheet" href="stylesheets/pixicon.css">\n	<!--[if lt IE 9]>\n		<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>\n       <![endif]-->\n	<!-- Favicons\n	================================================== -->\n	<link rel="shortcut icon" href="images/favicon.ico">\n	<link rel="apple-touch-icon" href="images/apple-touch-icon.png">\n	<link rel="apple-touch-icon" sizes="72x72" href="images/apple-touch-icon-72x72.png">\n	<link rel="apple-touch-icon" sizes="114x114" href="images/apple-touch-icon-114x114.png">\n</head><body>\n\n    <div id="page">\n\n\n        <div class="light_gray_bg pix_builder_bg" id="section_call_2">\n            <div class="footer3">\n                <div class="container ">\n                    <div class="ten columns alpha offset-by-three">\n                        <div class="content_div center_text">\n                            <div class="margin_bottom_30 dark_red">\n                                <i class="pi pixicon-clipboard title_56"></i> \n                            </div>\n                            <div class="margin_bottom_30">\n                                <p class="big_title bold_text editContent">Reservation Popup</p>\n                                <p class="normal_text light_gray center_text editContent">This is an example section for popups layouts, you can use it as it is, or you can check our documentation to learn how to add popups to any button or link in your landing pages, it\'s easy as cup cakes!</p>\n                                <p class="normal_text light_gray center_text editContent">\n                                    You can also open this popup from any link in the page by adding the popup\'s id <strong>#popup_2</strong> in the link field.\n                                </p>\n                            </div>\n                            <a href="#popup_2" class="pix_button pix_button_line bold_text dark_red btn_big">\n                                <span>POPUP BUTTON</span>\n                            </a>    \n                        </div>\n                    </div>\n                </div>\n            </div>\n        </div>\n\n\n        <div id="popup_2" class="well pix_popup pop_style_1 pop_hidden light_gray_bg pix_builder_bg">\n            <div class="center_text ">\n                <div class="big_icon dark_red">\n                    <span class="pi pixicon-clipboard2"></span>\n                </div>\n                <span class="editContent"><h4 class="margin_bottom pix_text"><strong>Reservation Form</strong></h4></span>\n                <p class="editContent">You can add unlimited fields directly from HTML</p>\n                <form id="contact_form" class="pix_form">\n                    <div id="result"></div>\n                    <input type="text" name="name" id="name" placeholder="Your Full Name" class="pix_text"> \n                    <input type="email" name="email" id="email" placeholder="Your Email" class="pix_text">\n                    <input type="text" name="number" id="number" placeholder="Your Phone Number" class="pix_text">\n                    <select name="numberp" class="pix_text">\n                        <option value="1">One Person</option>\n                        <option value="2">Two Person</option>\n                        <option value="3">Three Person</option>\n                        <option value="+4">More</option>\n                    </select>\n                    \n                    <span class="send_btn">\n                        <button type="submit" class="orange_bg submit_btn pix_text" id="submit_btn_6">\n                            <span class="editContent">Send Information</span>\n                        </button>\n                    </span>\n                    <div class="pix_text pix_note"><span class="editContent">*Some dummy text goes here.</span></div>\n                </form>\n            </div>\n        </div>\n\n    </div>\n\n\n    <script src="js/jquery-1.8.3.min.js" type="text/javascript"></script>\n    <script src="jsfiles/jquery.easing.1.3.js" type="text/javascript"></script>\n    <script src="jsfiles/jquery.common.min.js" type="text/javascript"></script>\n    <script src="jsfiles/jquery.ui.touch-punch.min.js"></script>\n    <script src="jsfiles/ticker.js" type="text/javascript"></script>\n    <script src="jsfiles/bootstrap.min.js"></script>\n    <script src="jsfiles/bootstrap-switch.js"></script>\n    <script src="assets/js/appear.min.js" type="text/javascript"></script>\n    <script src="jsfiles/custom.js" type="text/javascript"></script>\n    <script src="jsfiles/custom3.js" type="text/javascript"></script>\n\n</body>', 474, NULL, '', 0, 1, '2017-03-31 03:23:40', '2017-04-01 02:43:54'),
(28, 1, 1, '<html><head>\n    <meta charset="utf-8">\n    <title>Header</title>\n    <meta name="viewport" content="width=device-width, initial-scale=1.0">\n    <!-- Loading Flat UI -->\n    \n    <link rel="stylesheet" href="stylesheets/menu.css">\n    <link rel="stylesheet" href="stylesheets/flat-ui-slider.css">\n    <link rel="stylesheet" href="stylesheets/base.css">\n    <link rel="stylesheet" href="stylesheets/skeleton.css">\n    <link rel="stylesheet" href="stylesheets/landings.css">\n    <link rel="stylesheet" href="stylesheets/main.css">\n    <link rel="stylesheet" href="stylesheets/landings_layouts.css">\n    <link rel="stylesheet" href="stylesheets/box.css">\n    <link rel="stylesheet" href="stylesheets/pixicon.css">\n    <!-- HTML5 shim, for IE6-8 support of HTML5 elements. All other JS at the end of file. -->\n    <!--[if lt IE 9]>\n      <script src="js/html5shiv.js"></script>\n      <script src="js/respond.min.js"></script>\n      <![endif]-->\n</head><body>\n\n<div id="page" class="page">\n    <div class="pixfort_pix_slider pix_builder_bg" id="section_slider">\n        <div class="container">\n            <div class="sixteen columns">\n                <div id="myCarousel" class="carousel slide" data-interval="false">    					\n                    <!-- Indicators -->\n                    <ol class="carousel-indicators">\n                        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>\n                        <li data-target="#myCarousel" data-slide-to="1" class=""></li>\n                        <li data-target="#myCarousel" data-slide-to="2" class=""></li>\n                    </ol>\n                    <!-- Wrapper for slides -->\n                    <div class="carousel-inner">\n                        <div class="item active">\n                            <img src="images/uploads/1/1920_X_900.jpg" alt="" data-selector="img" style="">\n                            <div class="carousel-caption editContent">\n                                <h3 data-selector="h1, h2, h3, h4, h5, p" style="outline: none; cursor: inherit;">Thumbnail label</h3>\n                                <p data-selector="h1, h2, h3, h4, h5, p" style="outline: none; cursor: inherit;">Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec.</p>\n                            </div>\n                        </div>\n                        <div class="item">\n                            <img src="images/uploads/1/b9e7172b881d75b654bcc78f16751325_1459159029.jpg" alt="" data-selector="img" style="outline: none; cursor: inherit;">\n                            <div class="carousel-caption editContent">\n                                <h3 data-selector="h1, h2, h3, h4, h5, p" style="outline: none; cursor: inherit;">Thumbnail label</h3>\n                                <p data-selector="h1, h2, h3, h4, h5, p" style="outline: none; cursor: inherit;">Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec.</p>\n                            </div>\n                        </div>\n                        <div class="item">\n                            <img src="images/uploads/1/Fanta-Wallpaper.jpg" alt="" data-selector="img" style="outline: none; cursor: inherit;">\n                            <div class="carousel-caption editContent">\n                                <h3 data-selector="h1, h2, h3, h4, h5, p" style="outline: none; cursor: inherit;">Thumbnail label</h3>\n                                <p data-selector="h1, h2, h3, h4, h5, p" style="outline: none; cursor: inherit;">Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec.</p>\n                            </div>\n                        </div>\n                    </div>\n                    <!-- Controls -->\n                    <a class="left carousel-control fui-arrow-left" href="#myCarousel" data-slide="prev"></a>\n                    <a class="right carousel-control fui-arrow-right" href="#myCarousel" data-slide="next"></a>\n                </div>\n            </div>\n        </div><!-- /.container -->\n    </div>\n</div><!-- /#page -->\n\n<script src="js/jquery-1.8.3.min.js" type="text/javascript"></script>\n<script src="jsfiles/jquery.easing.1.3.js" type="text/javascript"></script>\n<script src="jsfiles/jquery.common.min.js" type="text/javascript"></script>\n<script src="jsfiles/jquery.ui.touch-punch.min.js"></script>\n<script src="jsfiles/ticker.js" type="text/javascript"></script>\n<script src="jsfiles/bootstrap.min.js"></script>\n<script src="jsfiles/bootstrap-switch.js"></script>\n<script src="assets/js/appear.min.js" type="text/javascript"></script>\n<script src="jsfiles/custom.js" type="text/javascript"></script>\n<script src="jsfiles/custom3.js" type="text/javascript"></script>\n\n</body>', 689, NULL, '', 0, 1, '2017-04-01 02:43:54', '2017-04-01 07:57:35');
INSERT INTO `frames` (`id`, `page_id`, `site_id`, `content`, `height`, `original_url`, `loaderfunction`, `sandbox`, `revision`, `created_at`, `updated_at`) VALUES
(29, 1, 1, '<html><head>\n	<!-- Basic Page Needs\n    ================================================== -->\n    <meta charset="utf-8">\n    <title>PixFort</title>\n    <meta name="description" content="">\n    <meta name="author" content="">\n	<!-- Mobile Specific Metas\n    ================================================== -->\n    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">\n	<!-- CSS\n    ================================================== -->\n    <link rel="stylesheet" href="stylesheets/menu.css">\n    <link rel="stylesheet" href="stylesheets/flat-ui-slider.css">\n    <link rel="stylesheet" href="stylesheets/base.css">\n    <link rel="stylesheet" href="stylesheets/skeleton.css">\n    <link rel="stylesheet" href="stylesheets/landings.css">\n    <link rel="stylesheet" href="stylesheets/main.css">\n    <link rel="stylesheet" href="stylesheets/landings_layouts.css">\n    <link rel="stylesheet" href="stylesheets/box.css">\n    <link rel="stylesheet" href="stylesheets/pixicon.css">\n	<!--[if lt IE 9]>\n		<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>\n       <![endif]-->\n	<!-- Favicons\n	================================================== -->\n	<link rel="shortcut icon" href="images/favicon.ico">\n	<link rel="apple-touch-icon" href="images/apple-touch-icon.png">\n	<link rel="apple-touch-icon" sizes="72x72" href="images/apple-touch-icon-72x72.png">\n	<link rel="apple-touch-icon" sizes="114x114" href="images/apple-touch-icon-114x114.png">\n</head><body style="">\n\n    <div id="page">\n\n\n        <div class="light_gray_bg pix_builder_bg" id="section_call_2">\n            <div class="footer3">\n                <div class="container ">\n                    <div class="ten columns alpha offset-by-three">\n                        <div class="content_div center_text">\n                            <div class="margin_bottom_30 dark_red">\n                                <i class="pi pixicon-clipboard title_56"></i> \n                            </div>\n                            <div class="margin_bottom_30">\n                                <p class="big_title bold_text editContent" data-selector="h1, h2, h3, h4, h5, p" style="outline: none; cursor: inherit;">Reservation Popup</p>\n                                <p class="normal_text light_gray center_text editContent" data-selector="h1, h2, h3, h4, h5, p" style="outline: none; cursor: inherit;">This is an example section for popups layouts, you can use it as it is, or you can check our documentation to learn how to add popups to any button or link in your landing pages, it\'s easy as cup cakes!</p>\n                                <p class="normal_text light_gray center_text editContent" data-selector="h1, h2, h3, h4, h5, p" style="outline: none; cursor: inherit;">\n                                    You can also open this popup from any link in the page by adding the popup\'s id <strong>#popup_2</strong> in the link field.\n                                </p>\n                            </div>\n                            <a href="#popup_2" class="pix_button pix_button_line bold_text dark_red btn_big">\n                                <span>POPUP BUTTON</span>\n                            </a>    \n                        </div>\n                    </div>\n                </div>\n            </div>\n        </div>\n\n\n        <div id="popup_2" class="well pix_popup pop_style_1 pop_hidden light_gray_bg pix_builder_bg">\n            <div class="center_text ">\n                <div class="big_icon dark_red">\n                    <span class="pi pixicon-clipboard2"></span>\n                </div>\n                <span class="editContent"><h4 class="margin_bottom pix_text" data-selector="h1, h2, h3, h4, h5, p" style="outline: none; cursor: inherit;"><strong>Reservation Form</strong></h4></span>\n                <p class="editContent" data-selector="h1, h2, h3, h4, h5, p" style="outline: none; cursor: inherit;">You can add unlimited fields directly from HTML</p>\n                <form id="contact_form" class="pix_form">\n                    <div id="result"></div>\n                    <input type="text" name="name" id="name" placeholder="Your Full Name" class="pix_text"> \n                    <input type="email" name="email" id="email" placeholder="Your Email" class="pix_text">\n                    <input type="text" name="number" id="number" placeholder="Your Phone Number" class="pix_text">\n                    <select name="numberp" class="pix_text">\n                        <option value="1">One Person</option>\n                        <option value="2">Two Person</option>\n                        <option value="3">Three Person</option>\n                        <option value="+4">More</option>\n                    </select>\n                    \n                    <span class="send_btn">\n                        <button type="submit" class="orange_bg submit_btn pix_text" id="submit_btn_6">\n                            <span class="editContent">Send Information</span>\n                        </button>\n                    </span>\n                    <div class="pix_text pix_note"><span class="editContent">*Some dummy text goes here.</span></div>\n                </form>\n            </div>\n        </div>\n\n    </div>\n\n\n    <script src="js/jquery-1.8.3.min.js" type="text/javascript"></script>\n    <script src="jsfiles/jquery.easing.1.3.js" type="text/javascript"></script>\n    <script src="jsfiles/jquery.common.min.js" type="text/javascript"></script>\n    <script src="jsfiles/jquery.ui.touch-punch.min.js"></script>\n    <script src="jsfiles/ticker.js" type="text/javascript"></script>\n    <script src="jsfiles/bootstrap.min.js"></script>\n    <script src="jsfiles/bootstrap-switch.js"></script>\n    <script src="assets/js/appear.min.js" type="text/javascript"></script>\n    <script src="jsfiles/custom.js" type="text/javascript"></script>\n    <script src="jsfiles/custom3.js" type="text/javascript"></script>\n\n<link rel="stylesheet" type="text/css" property="stylesheet" href="http://localhost:9001/_debugbar/assets/stylesheets?v=1473948356"><script type="text/javascript" src="http://localhost:9001/_debugbar/assets/javascript?v=1473948119"></script><script type="text/javascript">jQuery.noConflict(true);</script>\n<script type="text/javascript">\nvar phpdebugbar = new PhpDebugBar.DebugBar();\nphpdebugbar.addTab("messages", new PhpDebugBar.DebugBar.Tab({"icon":"list-alt","title":"Messages", "widget": new PhpDebugBar.Widgets.MessagesWidget()}));\nphpdebugbar.addIndicator("time", new PhpDebugBar.DebugBar.Indicator({"icon":"clock-o","tooltip":"Request Duration"}), "right");\nphpdebugbar.addTab("timeline", new PhpDebugBar.DebugBar.Tab({"icon":"tasks","title":"Timeline", "widget": new PhpDebugBar.Widgets.TimelineWidget()}));\nphpdebugbar.addIndicator("memory", new PhpDebugBar.DebugBar.Indicator({"icon":"cogs","tooltip":"Memory Usage"}), "right");\nphpdebugbar.addTab("exceptions", new PhpDebugBar.DebugBar.Tab({"icon":"bug","title":"Exceptions", "widget": new PhpDebugBar.Widgets.ExceptionsWidget()}));\nphpdebugbar.addTab("views", new PhpDebugBar.DebugBar.Tab({"icon":"leaf","title":"Views", "widget": new PhpDebugBar.Widgets.TemplatesWidget()}));\nphpdebugbar.addTab("route", new PhpDebugBar.DebugBar.Tab({"icon":"share","title":"Route", "widget": new PhpDebugBar.Widgets.VariableListWidget()}));\nphpdebugbar.addIndicator("currentroute", new PhpDebugBar.DebugBar.Indicator({"icon":"share","tooltip":"Route"}), "right");\nphpdebugbar.addTab("queries", new PhpDebugBar.DebugBar.Tab({"icon":"inbox","title":"Queries", "widget": new PhpDebugBar.Widgets.SQLQueriesWidget()}));\nphpdebugbar.addTab("emails", new PhpDebugBar.DebugBar.Tab({"icon":"inbox","title":"Mails", "widget": new PhpDebugBar.Widgets.MailsWidget()}));\nphpdebugbar.addTab("session", new PhpDebugBar.DebugBar.Tab({"icon":"archive","title":"Session", "widget": new PhpDebugBar.Widgets.VariableListWidget()}));\nphpdebugbar.addTab("request", new PhpDebugBar.DebugBar.Tab({"icon":"tags","title":"Request", "widget": new PhpDebugBar.Widgets.VariableListWidget()}));\nphpdebugbar.setDataMap({\n"messages": ["messages.messages", []],\n"messages:badge": ["messages.count", null],\n"time": ["time.duration_str", \'0ms\'],\n"timeline": ["time", {}],\n"memory": ["memory.peak_usage_str", \'0B\'],\n"exceptions": ["exceptions.exceptions", []],\n"exceptions:badge": ["exceptions.count", null],\n"views": ["views", []],\n"views:badge": ["views.nb_templates", 0],\n"route": ["route", {}],\n"currentroute": ["route.uri", ],\n"queries": ["queries", []],\n"queries:badge": ["queries.nb_statements", 0],\n"emails": ["swiftmailer_mails.mails", []],\n"emails:badge": ["swiftmailer_mails.count", null],\n"session": ["session", {}],\n"request": ["request", {}]\n});\nphpdebugbar.restoreState();\nphpdebugbar.ajaxHandler = new PhpDebugBar.AjaxHandler(phpdebugbar);\nphpdebugbar.ajaxHandler.bindToXHR();\nphpdebugbar.setOpenHandler(new PhpDebugBar.OpenHandler({"url":"http:\\/\\/localhost:9001\\/_debugbar\\/open"}));\nphpdebugbar.addDataSet({"__meta":{"id":"82dfbfac4755aec2e5ebde043bd769b3","datetime":"2017-04-01 09:42:52","utime":1491014572.91,"method":"GET","uri":"\\/site\\/getframe\\/27","ip":"::1"},"php":{"version":"5.6.25","interface":"apache2handler"},"messages":{"count":0,"messages":[]},"time":{"start":1491014572.36,"end":1491014572.91,"duration":0.549287080765,"duration_str":"549.29ms","measures":[{"label":"Booting","start":1491014572.36,"relative_start":0,"end":1491014572.76,"relative_end":1491014572.76,"duration":0.399843931198,"duration_str":"399.84ms","params":[],"collector":null},{"label":"Application","start":1491014572.68,"relative_start":0.313111066818,"end":1491014572.91,"relative_end":3.81469726562e-6,"duration":0.236179828644,"duration_str":"236.18ms","params":[],"collector":null}]},"memory":{"peak_usage":13107200,"peak_usage_str":"12.5MB"},"exceptions":{"count":0,"exceptions":[]},"views":{"nb_templates":0,"templates":[]},"route":{"uri":"GET site\\/getframe\\/{frame_id}","middleware":"web","as":"getframe","controller":"App\\\\Http\\\\Controllers\\\\SiteController@getFrame","namespace":"App\\\\Http\\\\Controllers","prefix":null,"where":[],"file":"app\\/Http\\/Controllers\\/SiteController.php:355-360"},"queries":{"nb_statements":1,"nb_failed_statements":0,"accumulated_duration":0.00325,"accumulated_duration_str":"3.25ms","statements":[{"sql":"select * from `frames` where `id` = \'27\' limit 1","params":{"0":"27","hints":"Use <code>SELECT *<\\/code> only if you need all columns from table<br \\/><code>LIMIT<\\/code> without <code>ORDER BY<\\/code> causes non-deterministic results, depending on the query execution plan"},"duration":0.00325,"duration_str":"3.25ms","stmt_id":null,"connection":"logistics.system"}]},"swiftmailer_mails":{"count":0,"mails":[]},"session":{"_token":"Wmt3lX1iWJ7Ou3wHkYqsvjnJ7a0gMixOe6xo2OJ0","_previous":"array:1 [\\n  \\"url\\" => \\"http:\\/\\/localhost:9001\\/site\\/getframe\\/27\\"\\n]","flash":"array:2 [\\n  \\"old\\" => []\\n  \\"new\\" => []\\n]","login_web_59ba36addc2b2f9401580f014c7f58ea4e30989d":"1","PHPDEBUGBAR_STACK_DATA":"[]","siteID":"1"},"request":{"format":"html","content_type":"text\\/html; charset=UTF-8","status_text":"OK","status_code":"200","request_query":"[]","request_request":"[]","request_headers":"array:9 [\\n  \\"host\\" => array:1 [\\n    0 => \\"localhost:9001\\"\\n  ]\\n  \\"connection\\" => array:1 [\\n    0 => \\"keep-alive\\"\\n  ]\\n  \\"upgrade-insecure-requests\\" => array:1 [\\n    0 => \\"1\\"\\n  ]\\n  \\"user-agent\\" => array:1 [\\n    0 => \\"Mozilla\\/5.0 (Macintosh; Intel Mac OS X 10_11_6) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/56.0.2924.87 Safari\\/537.36\\"\\n  ]\\n  \\"accept\\" => array:1 [\\n    0 => \\"text\\/html,application\\/xhtml+xml,application\\/xml;q=0.9,image\\/webp,*\\/*;q=0.8\\"\\n  ]\\n  \\"referer\\" => array:1 [\\n    0 => \\"http:\\/\\/localhost:9001\\/system\\/landing-page\\/site\\/1\\"\\n  ]\\n  \\"accept-encoding\\" => array:1 [\\n    0 => \\"gzip, deflate, sdch, br\\"\\n  ]\\n  \\"accept-language\\" => array:1 [\\n    0 => \\"vi-VN,vi;q=0.8,fr-FR;q=0.6,fr;q=0.4,en-US;q=0.2,en;q=0.2\\"\\n  ]\\n  \\"cookie\\" => array:1 [\\n    0 => \\"SQLiteManager_currentLangue=2; XSRF-TOKEN=eyJpdiI6ImlDcThINFZrWXJHOStKUTI5STRSdXc9PSIsInZhbHVlIjoiUm0rMm1lZEszaW15Zmt5YjI1MEtBczdSYVBzQnBsQXhiXC9CUFRYZkFzNmJZZUV1ays5Q1kyMFR0ZnEzRHZTbHVCV2U2Q3hLb2FRUzM4Rzd5allqbFpRPT0iLCJtYWMiOiIzMDgxNjI5Mzk4MWUyYWM3YjY3NTE3YWQ2OTU0YjM5ODk5OGFjY2E5N2E4MWExYjcwODkwMGNhZDExYjkxYjQwIn0%3D; laravel_session=eyJpdiI6IlFpNFVJaHpnRjZCVEZ6ajVWNUJPTGc9PSIsInZhbHVlIjoiTkM2TUQyMWNBTlwvamM2MDYzM2xCMks5dXZpanU0VFFXdUdjSHdHZHFYOU83Wnd4dHE3VXVmdXBrNk9IQjVuRDl3NnRUN29cLzUrandMb2pYSlk1b1wvSFE9PSIsIm1hYyI6IjRmMTliMDViNjUzN2QzNWQ4OTg2ZTU1ZjAzOTUxZTFiYzcyNGU4YWY2YzA2MDYwZDk4OTU5NjgxZjgxZWYzMTAifQ%3D%3D\\"\\n  ]\\n]","request_server":"array:34 [\\n  \\"REDIRECT_REDIRECT_STATUS\\" => \\"200\\"\\n  \\"REDIRECT_STATUS\\" => \\"200\\"\\n  \\"HTTP_HOST\\" => \\"localhost:9001\\"\\n  \\"HTTP_CONNECTION\\" => \\"keep-alive\\"\\n  \\"HTTP_UPGRADE_INSECURE_REQUESTS\\" => \\"1\\"\\n  \\"HTTP_USER_AGENT\\" => \\"Mozilla\\/5.0 (Macintosh; Intel Mac OS X 10_11_6) AppleWebKit\\/537.36 (KHTML, like Gecko) Chrome\\/56.0.2924.87 Safari\\/537.36\\"\\n  \\"HTTP_ACCEPT\\" => \\"text\\/html,application\\/xhtml+xml,application\\/xml;q=0.9,image\\/webp,*\\/*;q=0.8\\"\\n  \\"HTTP_REFERER\\" => \\"http:\\/\\/localhost:9001\\/system\\/landing-page\\/site\\/1\\"\\n  \\"HTTP_ACCEPT_ENCODING\\" => \\"gzip, deflate, sdch, br\\"\\n  \\"HTTP_ACCEPT_LANGUAGE\\" => \\"vi-VN,vi;q=0.8,fr-FR;q=0.6,fr;q=0.4,en-US;q=0.2,en;q=0.2\\"\\n  \\"HTTP_COOKIE\\" => \\"SQLiteManager_currentLangue=2; XSRF-TOKEN=eyJpdiI6ImlDcThINFZrWXJHOStKUTI5STRSdXc9PSIsInZhbHVlIjoiUm0rMm1lZEszaW15Zmt5YjI1MEtBczdSYVBzQnBsQXhiXC9CUFRYZkFzNmJZZUV1ays5Q1kyMFR0ZnEzRHZTbHVCV2U2Q3hLb2FRUzM4Rzd5allqbFpRPT0iLCJtYWMiOiIzMDgxNjI5Mzk4MWUyYWM3YjY3NTE3YWQ2OTU0YjM5ODk5OGFjY2E5N2E4MWExYjcwODkwMGNhZDExYjkxYjQwIn0%3D; laravel_session=eyJpdiI6IlFpNFVJaHpnRjZCVEZ6ajVWNUJPTGc9PSIsInZhbHVlIjoiTkM2TUQyMWNBTlwvamM2MDYzM2xCMks5dXZpanU0VFFXdUdjSHdHZHFYOU83Wnd4dHE3VXVmdXBrNk9IQjVuRDl3NnRUN29cLzUrandMb2pYSlk1b1wvSFE9PSIsIm1hYyI6IjRmMTliMDViNjUzN2QzNWQ4OTg2ZTU1ZjAzOTUxZTFiYzcyNGU4YWY2YzA2MDYwZDk4OTU5NjgxZjgxZWYzMTAifQ%3D%3D\\"\\n  \\"PATH\\" => \\"\\/usr\\/bin:\\/bin:\\/usr\\/sbin:\\/sbin\\"\\n  \\"SERVER_SIGNATURE\\" => \\"\\"\\n  \\"SERVER_SOFTWARE\\" => \\"Apache\\/2.2.31 (Unix) mod_wsgi\\/3.5 Python\\/2.7.12 PHP\\/5.6.25 mod_ssl\\/2.2.31 OpenSSL\\/1.0.2h DAV\\/2 mod_fastcgi\\/2.4.6 mod_perl\\/2.0.9 Perl\\/v5.24.0\\"\\n  \\"SERVER_NAME\\" => \\"localhost\\"\\n  \\"SERVER_ADDR\\" => \\"::1\\"\\n  \\"SERVER_PORT\\" => \\"9001\\"\\n  \\"REMOTE_ADDR\\" => \\"::1\\"\\n  \\"DOCUMENT_ROOT\\" => \\"\\/Users\\/phamhung\\/Work\\/Project\\/logistics_system\\"\\n  \\"SERVER_ADMIN\\" => \\"you@example.com\\"\\n  \\"SCRIPT_FILENAME\\" => \\"\\/Users\\/phamhung\\/Work\\/Project\\/logistics_system\\/public\\/index.php\\"\\n  \\"REMOTE_PORT\\" => \\"58724\\"\\n  \\"REDIRECT_URL\\" => \\"\\/public\\/site\\/getframe\\/27\\"\\n  \\"GATEWAY_INTERFACE\\" => \\"CGI\\/1.1\\"\\n  \\"SERVER_PROTOCOL\\" => \\"HTTP\\/1.1\\"\\n  \\"REQUEST_METHOD\\" => \\"GET\\"\\n  \\"QUERY_STRING\\" => \\"\\"\\n  \\"REQUEST_URI\\" => \\"\\/site\\/getframe\\/27\\"\\n  \\"SCRIPT_NAME\\" => \\"\\/public\\/index.php\\"\\n  \\"PHP_SELF\\" => \\"\\/public\\/index.php\\"\\n  \\"REQUEST_TIME_FLOAT\\" => 1491014572.36\\n  \\"REQUEST_TIME\\" => 1491014572\\n  \\"argv\\" => []\\n  \\"argc\\" => 0\\n]","request_cookies":"array:3 [\\n  \\"SQLiteManager_currentLangue\\" => null\\n  \\"XSRF-TOKEN\\" => \\"Wmt3lX1iWJ7Ou3wHkYqsvjnJ7a0gMixOe6xo2OJ0\\"\\n  \\"laravel_session\\" => \\"f86fb31baf747c9bc6feaeae885d8c25555dd389\\"\\n]","response_headers":"array:3 [\\n  \\"cache-control\\" => array:1 [\\n    0 => \\"no-cache\\"\\n  ]\\n  \\"content-type\\" => array:1 [\\n    0 => \\"text\\/html; charset=UTF-8\\"\\n  ]\\n  \\"Set-Cookie\\" => array:2 [\\n    0 => \\"XSRF-TOKEN=eyJpdiI6ImV0TGlLbTA3RGI4TUJDcHRKN2cwZ3c9PSIsInZhbHVlIjoiNmdKOXVRWUIxSStDNXR4MUowK2JtWVp5UzhCb21FYk5GdGxmRFZXWDAyY0tpUlRWYzNjVFZidWpjRFY2Y0I2R0lBWlV0cm8wckxJQlFoc1RtM0pXREE9PSIsIm1hYyI6IjU2NmE1M2ExMmU4OTcyNzY2MWIxYzFkM2UxMDljYzY3ZGZjMzMzNjZkYjVhNDhiNGQxMzUzYTQ5ZmIzOThlMzYifQ%3D%3D; expires=Sat, 01-Apr-2017 04:42:52 GMT; path=\\/\\"\\n    1 => \\"laravel_session=eyJpdiI6IkR6b0hJRStcL2Y3dUtNYXNzYStcL21udz09IiwidmFsdWUiOiJBRHlTNDdLMWRXdmo4RXBPdWRQcEpnUXIyWVBDK3VBVFRUa3dLejZlaFJQaDFcLzZzZEdFTTVwbCt5cXVqcEV5UlkzM1dJQ3VXRWxadTRJM3JDaHk3cXc9PSIsIm1hYyI6IjVjMWUwNzAyNThlMjMzNDk4MThmMjgyMGFhNWU0OTQ1YWJmOGQ3MzdhOGU2MDc4NjM5NzIwOGE0ZWIwNWE0ZDUifQ%3D%3D; expires=Sat, 01-Apr-2017 04:42:52 GMT; path=\\/; httponly\\"\\n  ]\\n]","path_info":"\\/site\\/getframe\\/27","session_attributes":"array:6 [\\n  \\"_token\\" => \\"Wmt3lX1iWJ7Ou3wHkYqsvjnJ7a0gMixOe6xo2OJ0\\"\\n  \\"_previous\\" => array:1 [\\n    \\"url\\" => \\"http:\\/\\/localhost:9001\\/site\\/getframe\\/27\\"\\n  ]\\n  \\"flash\\" => array:2 [\\n    \\"old\\" => []\\n    \\"new\\" => []\\n  ]\\n  \\"login_web_59ba36addc2b2f9401580f014c7f58ea4e30989d\\" => 1\\n  \\"PHPDEBUGBAR_STACK_DATA\\" => []\\n  \\"siteID\\" => \\"1\\"\\n]"}}, "82dfbfac4755aec2e5ebde043bd769b3");\n\n</script><div class="phpdebugbar phpdebugbar-minimized phpdebugbar-closed"><div class="phpdebugbar-drag-capture"></div><div class="phpdebugbar-resize-handle" style="display: none;"></div><div class="phpdebugbar-header" style="display: none;"><div class="phpdebugbar-header-left"><a class="phpdebugbar-tab"><i class="phpdebugbar-fa phpdebugbar-fa-list-alt"></i><span class="phpdebugbar-text">Messages</span><span class="phpdebugbar-badge" style="display: none;"></span></a><a class="phpdebugbar-tab"><i class="phpdebugbar-fa phpdebugbar-fa-tasks"></i><span class="phpdebugbar-text">Timeline</span><span class="phpdebugbar-badge"></span></a><a class="phpdebugbar-tab"><i class="phpdebugbar-fa phpdebugbar-fa-bug"></i><span class="phpdebugbar-text">Exceptions</span><span class="phpdebugbar-badge" style="display: none;"></span></a><a class="phpdebugbar-tab"><i class="phpdebugbar-fa phpdebugbar-fa-leaf"></i><span class="phpdebugbar-text">Views</span><span class="phpdebugbar-badge" style="display: inline;">0</span></a><a class="phpdebugbar-tab"><i class="phpdebugbar-fa phpdebugbar-fa-share"></i><span class="phpdebugbar-text">Route</span><span class="phpdebugbar-badge"></span></a><a class="phpdebugbar-tab"><i class="phpdebugbar-fa phpdebugbar-fa-inbox"></i><span class="phpdebugbar-text">Queries</span><span class="phpdebugbar-badge" style="display: inline;">1</span></a><a class="phpdebugbar-tab"><i class="phpdebugbar-fa phpdebugbar-fa-inbox"></i><span class="phpdebugbar-text">Mails</span><span class="phpdebugbar-badge" style="display: none;"></span></a><a class="phpdebugbar-tab"><i class="phpdebugbar-fa phpdebugbar-fa-archive"></i><span class="phpdebugbar-text">Session</span><span class="phpdebugbar-badge"></span></a><a class="phpdebugbar-tab"><i class="phpdebugbar-fa phpdebugbar-fa-tags"></i><span class="phpdebugbar-text">Request</span><span class="phpdebugbar-badge"></span></a></div><div class="phpdebugbar-header-right"><a class="phpdebugbar-close-btn"></a><a class="phpdebugbar-minimize-btn"></a><a class="phpdebugbar-maximize-btn"></a><a class="phpdebugbar-open-btn" style="display: block;"></a><select class="phpdebugbar-datasets-switcher"><option value="82dfbfac4755aec2e5ebde043bd769b3">#1 27 (09:42:52)</option></select><span class="phpdebugbar-indicator"><i class="phpdebugbar-fa phpdebugbar-fa-clock-o"></i><span class="phpdebugbar-text">549.29ms</span><span class="phpdebugbar-tooltip">Request Duration</span></span><span class="phpdebugbar-indicator"><i class="phpdebugbar-fa phpdebugbar-fa-cogs"></i><span class="phpdebugbar-text">12.5MB</span><span class="phpdebugbar-tooltip">Memory Usage</span></span><span class="phpdebugbar-indicator"><i class="phpdebugbar-fa phpdebugbar-fa-share"></i><span class="phpdebugbar-text">GET site/getframe/{frame_id}</span><span class="phpdebugbar-tooltip">Route</span></span></div></div><div class="phpdebugbar-body" style="height: 40px; display: none;"><div class="phpdebugbar-panel"><div class="phpdebugbar-widgets-messages"><ul class="phpdebugbar-widgets-list"></ul><div class="phpdebugbar-widgets-toolbar"><i class="phpdebugbar-fa phpdebugbar-fa-search"></i><input type="text"></div></div></div><div class="phpdebugbar-panel"><ul class="phpdebugbar-widgets-timeline"><li><div class="phpdebugbar-widgets-measure"><span class="phpdebugbar-widgets-value" style="left: 0%; width: 72.79%;"></span><span class="phpdebugbar-widgets-label">Booting (399.84ms)</span></div></li><li><div class="phpdebugbar-widgets-measure"><span class="phpdebugbar-widgets-value" style="left: 57%; width: 43%;"></span><span class="phpdebugbar-widgets-label">Application (236.18ms)</span></div></li></ul></div><div class="phpdebugbar-panel"><div class="phpdebugbar-widgets-exceptions"><ul class="phpdebugbar-widgets-list"></ul></div></div><div class="phpdebugbar-panel"><div class="phpdebugbar-widgets-templates"><div class="phpdebugbar-widgets-status"><span>0 templates were rendered</span></div><ul class="phpdebugbar-widgets-list"></ul></div></div><div class="phpdebugbar-panel"><dl class="phpdebugbar-widgets-kvlist phpdebugbar-widgets-varlist"><dt class="phpdebugbar-widgets-key"><span title="uri">uri</span></dt><dd class="phpdebugbar-widgets-value">GET site/getframe/{frame_id}</dd><dt class="phpdebugbar-widgets-key"><span title="middleware">middleware</span></dt><dd class="phpdebugbar-widgets-value">web</dd><dt class="phpdebugbar-widgets-key"><span title="as">as</span></dt><dd class="phpdebugbar-widgets-value">getframe</dd><dt class="phpdebugbar-widgets-key"><span title="controller">controller</span></dt><dd class="phpdebugbar-widgets-value">App\\Http\\Controllers\\SiteController@getFrame</dd><dt class="phpdebugbar-widgets-key"><span title="namespace">namespace</span></dt><dd class="phpdebugbar-widgets-value">App\\Http\\Controllers</dd><dt class="phpdebugbar-widgets-key"><span title="prefix">prefix</span></dt><dd class="phpdebugbar-widgets-value">null</dd><dt class="phpdebugbar-widgets-key"><span title="where">where</span></dt><dd class="phpdebugbar-widgets-value"></dd><dt class="phpdebugbar-widgets-key"><span title="file">file</span></dt><dd class="phpdebugbar-widgets-value">app/Http/Controllers/SiteController.php:355-360</dd></dl></div><div class="phpdebugbar-panel"><div class="phpdebugbar-widgets-sqlqueries"><div class="phpdebugbar-widgets-status"><span>1 statements were executed</span><span title="Accumulated duration" class="phpdebugbar-widgets-duration">3.25ms</span></div><div class="phpdebugbar-widgets-toolbar"><a class="phpdebugbar-widgets-filter" rel="logistics.system">logistics.system</a></div><ul class="phpdebugbar-widgets-list"><li class="phpdebugbar-widgets-list-item" connection="logistics.system" style="cursor: pointer;"><code class="phpdebugbar-widgets-sql"><span class="hljs-operator"><span class="hljs-keyword">select</span> * <span class="hljs-keyword">from</span> <span class="hljs-string">`frames`</span> <span class="hljs-keyword">where</span> <span class="hljs-string">`id`</span> = <span class="hljs-string">\'27\'</span> limit <span class="hljs-number">1</span></span></code><span title="Duration" class="phpdebugbar-widgets-duration">3.25ms</span><span title="Connection" class="phpdebugbar-widgets-database">logistics.system</span><table class="phpdebugbar-widgets-params"><tbody><tr><th colspan="2">Params</th></tr><tr><td class="phpdebugbar-widgets-name">0</td><td class="phpdebugbar-widgets-value">27</td></tr><tr><td class="phpdebugbar-widgets-name">hints</td><td class="phpdebugbar-widgets-value">Use <code>SELECT *</code> only if you need all columns from table<br><code>LIMIT</code> without <code>ORDER BY</code> causes non-deterministic results, depending on the query execution plan</td></tr></tbody></table></li></ul></div></div><div class="phpdebugbar-panel"><div class="phpdebugbar-widgets-mails"><ul class="phpdebugbar-widgets-list"></ul></div></div><div class="phpdebugbar-panel"><dl class="phpdebugbar-widgets-kvlist phpdebugbar-widgets-varlist"><dt class="phpdebugbar-widgets-key"><span title="_token">_token</span></dt><dd class="phpdebugbar-widgets-value">Wmt3lX1iWJ7Ou3wHkYqsvjnJ7a0gMixOe6xo2OJ0</dd><dt class="phpdebugbar-widgets-key"><span title="_previous">_previous</span></dt><dd class="phpdebugbar-widgets-value">array:1 [\n  "url" =&gt; "http://localhost:9001/site/getframe/27"\n]</dd><dt class="phpdebugbar-widgets-key"><span title="flash">flash</span></dt><dd class="phpdebugbar-widgets-value">array:2 [\n  "old" =&gt; []\n  "new" =&gt; []\n]</dd><dt class="phpdebugbar-widgets-key"><span title="login_web_59ba36addc2b2f9401580f014c7f58ea4e30989d">login_web_59ba36addc2b2f9401580f014c7f58ea4e30989d</span></dt><dd class="phpdebugbar-widgets-value">1</dd><dt class="phpdebugbar-widgets-key"><span title="PHPDEBUGBAR_STACK_DATA">PHPDEBUGBAR_STACK_DATA</span></dt><dd class="phpdebugbar-widgets-value">[]</dd><dt class="phpdebugbar-widgets-key"><span title="siteID">siteID</span></dt><dd class="phpdebugbar-widgets-value">1</dd></dl></div><div class="phpdebugbar-panel"><dl class="phpdebugbar-widgets-kvlist phpdebugbar-widgets-varlist"><dt class="phpdebugbar-widgets-key"><span title="format">format</span></dt><dd class="phpdebugbar-widgets-value">html</dd><dt class="phpdebugbar-widgets-key"><span title="content_type">content_type</span></dt><dd class="phpdebugbar-widgets-value">text/html; charset=UTF-8</dd><dt class="phpdebugbar-widgets-key"><span title="status_text">status_text</span></dt><dd class="phpdebugbar-widgets-value">OK</dd><dt class="phpdebugbar-widgets-key"><span title="status_code">status_code</span></dt><dd class="phpdebugbar-widgets-value">200</dd><dt class="phpdebugbar-widgets-key"><span title="request_query">request_query</span></dt><dd class="phpdebugbar-widgets-value">[]</dd><dt class="phpdebugbar-widgets-key"><span title="request_request">request_request</span></dt><dd class="phpdebugbar-widgets-value">[]</dd><dt class="phpdebugbar-widgets-key"><span title="request_headers">request_headers</span></dt><dd class="phpdebugbar-widgets-value">array:9 [\n  "host" =&gt; array:1 [\n    0 =&gt; "localhost:9001"\n  ]\n  "connection" =&gt; array:1 [\n    0 =&gt; "...</dd><dt class="phpdebugbar-widgets-key"><span title="request_server">request_server</span></dt><dd class="phpdebugbar-widgets-value">array:34 [\n  "REDIRECT_REDIRECT_STATUS" =&gt; "200"\n  "REDIRECT_STATUS" =&gt; "200"\n  "HTTP_HOST" =&gt; "loca...</dd><dt class="phpdebugbar-widgets-key"><span title="request_cookies">request_cookies</span></dt><dd class="phpdebugbar-widgets-value">array:3 [\n  "SQLiteManager_currentLangue" =&gt; null\n  "XSRF-TOKEN" =&gt; "Wmt3lX1iWJ7Ou3wHkYqsvjnJ7a0gMix...</dd><dt class="phpdebugbar-widgets-key"><span title="response_headers">response_headers</span></dt><dd class="phpdebugbar-widgets-value">array:3 [\n  "cache-control" =&gt; array:1 [\n    0 =&gt; "no-cache"\n  ]\n  "content-type" =&gt; array:1 [\n    0...</dd><dt class="phpdebugbar-widgets-key"><span title="path_info">path_info</span></dt><dd class="phpdebugbar-widgets-value">/site/getframe/27</dd><dt class="phpdebugbar-widgets-key"><span title="session_attributes">session_attributes</span></dt><dd class="phpdebugbar-widgets-value">array:6 [\n  "_token" =&gt; "Wmt3lX1iWJ7Ou3wHkYqsvjnJ7a0gMixOe6xo2OJ0"\n  "_previous" =&gt; array:1 [\n    "u...</dd></dl></div></div><a class="phpdebugbar-restore-btn" style=""></a></div><div class="phpdebugbar-openhandler" style="display: none;"><div class="phpdebugbar-openhandler-header">PHP DebugBar | Open<a><i class="phpdebugbar-fa phpdebugbar-fa-times"></i></a></div><table><thead><tr><th width="150">Date</th><th width="55">Method</th><th>URL</th><th width="125">IP</th><th width="100">Filter data</th></tr></thead><tbody></tbody></table><div class="phpdebugbar-openhandler-actions"><a>Load more</a><a>Show only current URL</a><a>Show all</a><a>Delete all</a><form><br><b>Filter results</b><br>Method: <select name="method"><option></option><option>GET</option><option>POST</option><option>PUT</option><option>DELETE</option></select><br>Uri: <input type="text" name="uri"><br>IP: <input type="text" name="ip"><br><button type="submit">Search</button></form></div></div><div class="phpdebugbar-openhandler-overlay" style="display: none;"></div>\n</body>', 472, NULL, '', 0, 1, '2017-04-01 02:43:54', '2017-04-01 07:57:35');

-- --------------------------------------------------------

--
-- Table structure for table `inventory`
--

CREATE TABLE `inventory` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `value` longtext COMMENT '{"i:1":{"q":"15"}}',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`migration`, `batch`) VALUES
('2014_10_12_000000_create_users_table', 1),
('2014_10_12_100000_create_password_resets_table', 1),
('2016_11_10_080215_create_warehouse_table', 2),
('2016_11_10_082054_create_product_group_table', 3),
('2016_11_10_083413_create_product_table', 4),
('2016_11_10_084438_create_units_table', 5),
('2016_11_10_093523_create_purchases_ph_table', 6),
('2016_11_10_094223_create_supplier_table', 7),
('2016_11_10_095939_create_purchases_ph_details_table', 8),
('2016_11_10_101244_create_warehouse_ph_table', 9),
('2016_11_10_102122_create_warehouse_ph_details_table', 10),
('2016_11_11_094127_create_transfer_ph_table', 11),
('2016_11_11_095034_create_transfer_ph_details_table', 12),
('2016_11_12_041909_create_inventory_table', 13),
('2016_11_14_024900_create_customers_table', 14),
('2016_11_14_024919_create_orders_table', 15),
('2016_11_14_032029_create_orders_details_table', 16),
('2016_11_14_032029_create_order_details_table', 17),
('2016_11_14_032750_create_payment_methods_table', 17),
('2016_11_14_033412_create_payment_methods_table', 18),
('2016_11_14_033503_create_order_processing_table', 18),
('2016_11_14_041731_create_admins_table', 19),
('2016_11_14_043812_create_channel_table', 20),
('2016_11_30_023833_create_permission_admin_table', 21);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT '0',
  `customer_id` int(11) DEFAULT '0',
  `export_warehouse` int(11) NOT NULL DEFAULT '0',
  `payment_method_id` int(11) DEFAULT '0',
  `channel_id` int(11) DEFAULT '0',
  `code` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `lading_code` varchar(255) DEFAULT NULL,
  `order_status` int(11) NOT NULL DEFAULT '0' COMMENT '0 - Đang chờ duyệt , 1 - Đơn hàng đã duyệt, 2 - Trạng thái vận đơn, 3 - Đơn hàng thành công, 4 - Đơn hàng huỷ, 5 - Đơn hàng ảo, 6 - Trả hàng',
  `payment_status` int(11) DEFAULT '0' COMMENT '0: Chờ xử lý - 1: Đã thanh toán - 2: Chưa thanh toán',
  `lading_status` int(11) NOT NULL DEFAULT '0' COMMENT '0 - Chờ xử lý , 1 - Đợi lấy hàng , 2 - Đang giao hàng , 3 - Đã giao hàng',
  `call_status` int(11) DEFAULT '0' COMMENT '0: Chưa gọi, 1: Đã gọi và liên lạc được, 2: Đã gọi nhưng chưa liên lạc được',
  `status` tinyint(4) NOT NULL DEFAULT '0' COMMENT '0 - Đang tạo đơn , 1 - Đã tạo đơn',
  `total_price` decimal(10,0) NOT NULL DEFAULT '0',
  `cod_price` decimal(10,0) DEFAULT '0',
  `receiver_provinces` int(11) DEFAULT '0',
  `receiver_districts` int(11) DEFAULT '0',
  `receiver_address` text,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `customer_id`, `export_warehouse`, `payment_method_id`, `channel_id`, `code`, `lading_code`, `order_status`, `payment_status`, `lading_status`, `call_status`, `status`, `total_price`, `cod_price`, `receiver_provinces`, `receiver_districts`, `receiver_address`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 2, 1, 4, 'MDH/25032017100657', NULL, 6, 1, 0, 0, 1, '56000', '0', 0, 0, NULL, '2017-03-25 03:06:57', '2017-03-25 03:27:23'),
(2, 1, 1, 2, 1, 4, 'MDH/25032017103700', NULL, 6, 1, 0, 0, 1, '37500', '0', 0, 0, NULL, '2017-03-25 03:37:00', '2017-03-25 03:42:18'),
(3, 1, 1, 2, 1, 4, 'MDH/25032017104723', NULL, 6, 1, 0, 0, 1, '70000', '0', 0, 0, NULL, '2017-03-25 03:47:23', '2017-03-25 03:48:05'),
(4, 1, 1, 2, 1, 1, 'MDH/25032017105104', NULL, 6, 1, 0, 0, 1, '64000', '0', 0, 0, NULL, '2017-03-25 03:51:04', '2017-03-25 03:53:32'),
(5, 1, 2, 2, 1, 1, 'MDH/28032017091412', NULL, 3, 1, 0, 0, 1, '7500', '0', 0, 0, NULL, '2017-03-28 02:14:12', '2017-03-28 02:14:23'),
(6, 1, 2, 0, 1, 4, 'MDH/30032017014946', NULL, 0, 2, 0, 0, 1, '7500', '0', 0, 0, NULL, '2017-03-29 18:49:46', '2017-03-29 18:49:46'),
(7, 1, 2, 0, 1, 1, 'MDH/08042017030842', NULL, 4, 2, 0, 0, 1, '16000', '0', 0, 0, NULL, '2017-04-08 08:08:42', '2017-04-08 08:08:52'),
(8, 1, 1, 1, 1, 1, 'MDH/10042017051638', 'A12113141', 2, 1, 2, 0, 1, '7000', '7000', 0, 0, NULL, '2017-04-10 10:16:38', '2017-04-10 10:21:30');

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

CREATE TABLE `order_details` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `unit_id` int(11) DEFAULT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(10,0) NOT NULL COMMENT 'Giá bán',
  `total_price` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `order_details`
--

INSERT INTO `order_details` (`id`, `order_id`, `product_id`, `unit_id`, `quantity`, `price`, `total_price`, `created_at`, `updated_at`) VALUES
(1, 1, 9, NULL, 7, '8000', 56000, NULL, NULL),
(2, 2, 1, NULL, 5, '7500', 37500, NULL, NULL),
(3, 3, 2, NULL, 10, '7000', 70000, NULL, NULL),
(4, 4, 9, NULL, 8, '8000', 64000, NULL, NULL),
(5, 5, 1, NULL, 1, '7500', 7500, NULL, NULL),
(6, 6, 1, NULL, 1, '7500', 7500, NULL, NULL),
(7, 7, 3, NULL, 1, '16000', 16000, NULL, NULL),
(8, 8, 2, NULL, 1, '7000', 7000, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `order_details_product_in_stock`
--

CREATE TABLE `order_details_product_in_stock` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity_sub` int(11) NOT NULL,
  `price_in` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `order_details_product_in_stock`
--

INSERT INTO `order_details_product_in_stock` (`id`, `order_id`, `product_id`, `quantity_sub`, `price_in`, `created_at`, `updated_at`) VALUES
(9, 8, 2, 1, 5000, '2017-04-10 10:21:30', '2017-04-10 10:21:30'),
(3, 2, 1, 2, 4500, '2017-03-25 03:39:41', '2017-03-25 03:42:18'),
(8, 5, 1, 1, 4500, '2017-03-28 02:14:23', '2017-03-28 02:14:23'),
(7, 4, 9, 1, 4000, '2017-03-25 03:51:31', '2017-03-25 03:53:32');

-- --------------------------------------------------------

--
-- Table structure for table `order_processing`
--

CREATE TABLE `order_processing` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `status` int(11) DEFAULT NULL,
  `order_status` int(11) DEFAULT '0' COMMENT '0 - Đang chờ duyệt , 1 - Đơn hàng đã duyệt, 2 - Trạng thái vận đơn, 3 - Đơn hàng thành công, 4 - Đơn hàng huỷ',
  `lading_status` int(11) DEFAULT NULL COMMENT '0 - Đợi lấy hàng , 1 - Đang giao hàng , 2 - Đã giao hàng , 3 - Hoàn thành',
  `call_status` int(11) DEFAULT '0' COMMENT '0: Chưa gọi, 1: Đã gọi và liên lạc được, 2: Đã gọi nhưng chưa liên lạc được',
  `note` text,
  `report` text,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `order_processing`
--

INSERT INTO `order_processing` (`id`, `order_id`, `user_id`, `status`, `order_status`, `lading_status`, `call_status`, `note`, `report`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, 0, NULL, 0, NULL, NULL, '2017-03-25 03:06:57', '2017-03-25 03:06:57'),
(2, 1, 1, NULL, 3, NULL, 0, NULL, NULL, '2017-03-25 03:08:10', '2017-03-25 03:08:10'),
(3, 1, 1, 1, NULL, NULL, 0, 'Tạo phiếu trả hàng', NULL, '2017-03-25 03:27:23', '2017-03-25 03:27:23'),
(4, 2, 1, 1, 0, NULL, 0, NULL, NULL, '2017-03-25 03:37:00', '2017-03-25 03:37:00'),
(5, 2, 1, NULL, 3, NULL, 0, NULL, NULL, '2017-03-25 03:39:41', '2017-03-25 03:39:41'),
(6, 2, 1, 1, NULL, NULL, 0, 'Tạo phiếu trả hàng', NULL, '2017-03-25 03:42:18', '2017-03-25 03:42:18'),
(7, 3, 1, 1, 0, NULL, 0, NULL, NULL, '2017-03-25 03:47:23', '2017-03-25 03:47:23'),
(8, 3, 1, NULL, 3, NULL, 0, NULL, NULL, '2017-03-25 03:47:43', '2017-03-25 03:47:43'),
(9, 3, 1, 1, NULL, NULL, 0, 'Tạo phiếu trả hàng', NULL, '2017-03-25 03:48:05', '2017-03-25 03:48:05'),
(10, 4, 1, 1, 0, NULL, 0, NULL, NULL, '2017-03-25 03:51:04', '2017-03-25 03:51:04'),
(11, 4, 1, NULL, 3, NULL, 0, NULL, NULL, '2017-03-25 03:51:31', '2017-03-25 03:51:31'),
(12, 4, 1, 1, NULL, NULL, 0, 'Tạo phiếu trả hàng', NULL, '2017-03-25 03:53:32', '2017-03-25 03:53:32'),
(13, 5, 1, 1, 0, NULL, 0, NULL, NULL, '2017-03-28 02:14:12', '2017-03-28 02:14:12'),
(14, 5, 1, NULL, 3, NULL, 0, NULL, NULL, '2017-03-28 02:14:23', '2017-03-28 02:14:23'),
(15, 6, 1, 1, 0, NULL, 0, NULL, NULL, '2017-03-29 18:49:46', '2017-03-29 18:49:46'),
(16, 7, 1, 1, 0, NULL, 0, NULL, NULL, '2017-04-08 08:08:42', '2017-04-08 08:08:42'),
(17, 7, 1, NULL, 4, NULL, 0, NULL, NULL, '2017-04-08 08:08:52', '2017-04-08 08:08:52'),
(18, 8, 1, 1, 0, NULL, 0, NULL, NULL, '2017-04-10 10:16:38', '2017-04-10 10:16:38'),
(19, 8, 1, 1, 2, NULL, 0, NULL, NULL, '2017-04-10 10:17:11', '2017-04-10 10:17:11'),
(20, 8, 1, 1, 2, 2, 0, NULL, NULL, '2017-04-10 10:21:30', '2017-04-10 10:21:30');

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE `pages` (
  `id` int(10) UNSIGNED NOT NULL,
  `site_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `meta_keywords` text COLLATE utf8_unicode_ci,
  `meta_description` text COLLATE utf8_unicode_ci,
  `header_includes` text COLLATE utf8_unicode_ci,
  `preview` text COLLATE utf8_unicode_ci,
  `template` tinyint(1) DEFAULT NULL,
  `css` text COLLATE utf8_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`id`, `site_id`, `name`, `title`, `meta_keywords`, `meta_description`, `header_includes`, `preview`, `template`, `css`, `created_at`, `updated_at`) VALUES
(1, 1, 'index', 'Lò Tôn :: Chuyên cung cấp nước Lavie và bình sứ', 'Lavie, Bình sứ Lavie, chai lavie', 'Lavie, Bình sứ Lavie, chai lavie', '', NULL, NULL, '', '2017-01-07 02:37:49', '2017-03-07 07:57:06');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payment_methods`
--

CREATE TABLE `payment_methods` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `type` tinyint(4) DEFAULT '0' COMMENT '1 - COD ; 0 - Others',
  `fixed` tinyint(4) NOT NULL DEFAULT '0' COMMENT '1 - Cố định',
  `admin_id` int(11) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `payment_methods`
--

INSERT INTO `payment_methods` (`id`, `name`, `status`, `type`, `fixed`, `admin_id`, `created_at`, `updated_at`) VALUES
(1, 'Trả chi phí sau khi nhận được hàng ( COD )', 1, 1, 1, 1, '2017-01-06 06:37:00', '2017-01-06 06:37:00'),
(3, 'Thanh toán tại cửa hàng 35 Nguyễn Tuân', 1, 0, 0, 1, '2017-02-10 07:56:36', '2017-02-10 07:56:36');

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` int(11) NOT NULL,
  `parent_id` int(11) NOT NULL DEFAULT '0',
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `description` text,
  `order` int(11) DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `parent_id`, `name`, `slug`, `description`, `order`, `created_at`, `updated_at`) VALUES
(1, 0, 'Bán hàng', 'admin.orders.index', 'Bán hàng', 2, '2016-11-30 02:37:59', '2017-04-01 03:40:49'),
(2, 0, 'Tổng quan', 'admin.dashboard', 'Thống kê tổng quan', 1, '2016-11-30 03:11:43', '2017-04-01 03:38:44'),
(7, 1, 'Tạo đơn', 'admin.orders.getCreate', 'Tạo đơn hàng', 1, '2016-12-04 21:01:05', '2017-04-01 03:44:32'),
(3, 0, 'Nhóm sản phẩm', 'admin.product-group.index', 'Danh sách nhóm sản phẩm', 3, '2016-11-30 03:26:22', '2017-04-01 04:16:21'),
(4, 3, 'Sửa nhóm sản phẩm', 'admin.product-group.getUpdate', 'Sửa nhóm sản phẩm', 2, '2016-11-30 03:26:57', '2016-12-05 00:33:48'),
(5, 3, 'Tạo nhóm sản phẩm', 'admin.product-group.getCreate', 'Tạo nhóm sản phẩm', 1, '2016-11-30 03:28:06', '2016-12-05 00:34:14'),
(6, 3, 'Xoá nhóm sản phẩm', 'admin.product-group.getDelete', 'Xoá nhóm sản phẩm', 3, '2016-11-30 19:38:01', '2016-11-30 19:38:01'),
(76, 74, 'Sửa nhà cung cấp', 'admin.supplier.getUpdate', 'Sửa nhà cung cấp', 2, '2017-04-01 07:20:23', '2017-04-01 07:20:23'),
(75, 74, 'Thêm nhà cung cấp', 'admin.supplier.getCreate', 'Thêm nhà cung cấp', 1, '2017-04-01 07:19:58', '2017-04-01 07:19:58'),
(67, 62, 'Thống kê theo nhân viên', 'admin.statistic.getStaff', 'Thống kê theo nhân viên', 5, '2017-04-01 04:50:33', '2017-04-01 04:50:33'),
(65, 62, 'Thống kê theo kênh bán hàng', 'admin.statistic.getChannel', 'Thống kê theo kênh bán hàng', 3, '2017-04-01 04:49:47', '2017-04-01 04:49:47'),
(66, 62, 'Thống kê theo vùng', 'admin.statistic.getRegions', 'Thống kê theo vùng', 4, '2017-04-01 04:50:14', '2017-04-01 04:50:14'),
(64, 62, 'Thống kê theo nhóm sản phẩm', 'admin.statistic.getProductGroup', 'Thống kê theo nhóm sản phẩm', 2, '2017-04-01 04:49:26', '2017-04-01 04:49:26'),
(15, 1, 'Vận chuyển đơn hàng', 'admin.orders.delivery', 'Quản lý vận đơn', 4, '2016-12-04 21:44:48', '2017-04-01 03:52:53'),
(63, 62, 'Thống kê theo tên sản phẩm', 'admin.statistic.getProduct', 'Thống kê theo tên sản phẩm', 1, '2017-04-01 04:48:54', '2017-04-01 04:48:54'),
(58, 1, 'Chi tiết đơn hàng', 'admin.orders.details', 'Chi tiết đơn hàng', 3, '2017-04-01 03:50:24', '2017-04-01 03:50:24'),
(60, 59, 'Chi tiết phiếu trả hàng', 'admin.return-product.details', 'Chi tiết phiếu trả hàng', 1, '2017-04-01 04:33:19', '2017-04-01 04:33:19'),
(61, 59, 'Tìm kiếm đơn hàng và tạo phiếu', 'admin.return-product.processing', 'Tìm kiếm đơn hàng và tạo phiếu', 2, '2017-04-01 04:34:16', '2017-04-01 04:34:16'),
(62, 0, 'Thống kê, báo cáo', 'admin.sale-statistic.getDashboard', 'Thống kê, báo cáo', 9, '2017-04-01 04:47:02', '2017-04-01 04:53:38'),
(21, 0, 'Sản phẩm', 'admin.product.index', 'Danh sách sản phẩm', 4, '2016-12-05 00:40:34', '2017-04-01 04:18:48'),
(22, 21, 'Thêm sản phẩm', 'admin.product.getCreate', 'Thêm sản phẩm', 1, '2016-12-05 00:41:02', '2016-12-05 00:41:02'),
(23, 21, 'Sửa sản phẩm', 'admin.product.getUpdate', 'Sửa sản phẩm', 2, '2016-12-05 00:41:58', '2016-12-05 00:41:58'),
(24, 21, 'Xoá sản phẩm', 'admin.product.getDelete', 'Xoá sản phẩm', 3, '2016-12-05 00:42:23', '2016-12-05 00:42:23'),
(25, 0, 'Kho hàng', 'admin.stock.index', 'Quản lý kho hàng', 5, '2016-12-05 00:44:55', '2017-04-01 04:19:36'),
(57, 1, 'Đơn ảo', 'admin.orders.trash', 'Đơn hàng ảo', 2, '2017-04-01 03:46:34', '2017-04-01 03:46:34'),
(59, 0, 'Trả hàng', 'admin.return-product.index', 'Trả hàng', 8, '2017-04-01 04:32:21', '2017-04-01 04:53:33'),
(26, 25, 'Tạo kho hàng', 'admin.stock.getCreate', 'Tạo kho hàng', 1, '2016-12-05 00:46:46', '2016-12-05 00:46:46'),
(27, 25, 'Sửa kho hàng', 'admin.stock.getUpdate', 'Sửa kho hàng', 2, '2016-12-05 00:47:13', '2016-12-05 00:47:13'),
(28, 25, 'Xoá kho hàng', 'admin.stock.getDelete', 'Xoá kho hàng', 3, '2016-12-05 00:47:33', '2016-12-05 00:47:33'),
(29, 0, 'Hàng tồn kho', 'admin.inventory.index', 'Quản lý hàng tồn kho', 6, '2016-12-05 01:32:46', '2017-04-01 04:20:18'),
(30, 0, 'Phiếu nhập kho', 'admin.stock-receipt.index', 'Quản lý danh sách phiếu nhập kho', 7, '2016-12-05 01:42:16', '2017-04-01 04:21:03'),
(31, 30, 'Tạo phiếu nhập kho', 'admin.stock-receipt.getCreate', 'Tạo phiếu nhập kho', 1, '2016-12-05 01:43:29', '2016-12-05 01:43:29'),
(32, 31, 'Nhập sản phẩm vào phiếu nhập kho', 'admin.stock-receipt.getUpdate', 'Nhập sản phẩm vào phiếu nhập kho', 1, '2016-12-05 01:44:48', '2016-12-05 01:44:48'),
(33, 31, 'Sửa sản phẩm trên phiếu nhập kho', 'admin.stock-receipt.getEdit', 'Sửa sản phẩm trên phiếu nhập kho', 2, '2016-12-05 01:45:19', '2016-12-05 01:45:19'),
(34, 31, 'Xoá sản phẩm trên phiếu nhập kho', 'admin.stock-receipt.getDelete', 'Xoá sản phẩm trên phiếu nhập kho', 3, '2016-12-05 01:46:18', '2016-12-05 01:46:18'),
(35, 31, 'Nhập sản phẩm vào kho', 'admin.stock-receipt.getWarehousing', 'Nhập sản phẩm vào kho', 4, '2016-12-05 01:47:11', '2016-12-05 01:47:11'),
(36, 30, 'Chi tiết phiếu nhập kho', 'admin.stock-receipt.details', 'Chi tiết phiếu nhập kho', 2, '2016-12-05 01:47:47', '2016-12-05 01:47:47'),
(68, 52, 'Thống kê, báo cáo', 'admin.staff.getOrders', 'Danh sách đơn hàng của nhân viên này', 4, '2017-04-01 05:00:40', '2017-04-01 07:04:22'),
(69, 43, 'Thống kê, báo cáo', 'admin.customer.getDetails', 'Đơn hàng của khách hàng này', 3, '2017-04-01 06:54:28', '2017-04-01 07:04:08'),
(70, 0, 'Cài đặt đơn vị sản phẩm', 'admin.units.index', 'Cài đặt đơn vị sản phẩm', 14, '2017-04-01 07:15:56', '2017-04-01 07:16:07'),
(71, 70, 'Thêm đơn vị sản phẩm', 'admin.units.getCreate', 'Thêm đơn vị sản phẩm', 1, '2017-04-01 07:17:39', '2017-04-01 07:17:39'),
(72, 70, 'Sửa đơn vị sản phẩm', 'admin.units.getUpdate', 'Sửa đơn vị sản phẩm', 2, '2017-04-01 07:18:20', '2017-04-01 07:18:20'),
(73, 70, 'Xoá đơn vị sản phẩm', 'admin.units.getDelete', 'Xoá đơn vị sản phẩm', 3, '2017-04-01 07:18:43', '2017-04-01 07:18:43'),
(74, 0, 'Cài đặt nhà cung cấp', 'admin.supplier.index', 'Cài đặt nhà cung cấp', 15, '2017-04-01 07:19:30', '2017-04-01 07:21:00'),
(43, 0, 'Khách hàng', 'admin.customer.index', 'Quản lý danh sách khách hàng', 11, '2016-12-05 02:02:50', '2017-04-01 06:54:04'),
(44, 43, 'Tạo thông tin khách hàng', 'admin.customer.getCreate', 'Tạo khách hàng', 1, '2016-12-05 02:03:17', '2016-12-05 02:04:28'),
(45, 43, 'Sửa thông tin khách hàng', 'admin.customer.getUpdate', 'Sửa thông tin khách hàng', 2, '2016-12-05 02:03:43', '2016-12-05 02:03:43'),
(46, 0, 'Cài đặt kênh bán hàng', 'admin.channel.index', 'Quản lý danh sách kênh bán hàng', 12, '2016-12-05 02:10:34', '2017-04-01 07:10:28'),
(47, 46, 'Tạo thông tin kênh bán hàng', 'admin.channel.getCreate', 'Tạo kênh bán hàng', 1, '2016-12-05 02:11:02', '2016-12-05 02:11:49'),
(48, 46, 'Sửa thông tin kênh bán hàng', 'admin.channel.getUpdate', 'Sửa thông tin kênh bán hàng', 2, '2016-12-05 02:11:25', '2016-12-05 02:11:25'),
(49, 0, 'Cài đặt phương thức thanh toán', 'admin.payment-method.index', 'Quản lý danh sách phương thức thanh toán', 13, '2016-12-05 02:15:59', '2017-04-01 07:11:30'),
(50, 49, 'Tạo phương thức thanh toán', 'admin.payment-method.getCreate', 'Tạo phương thức thanh toán', 1, '2016-12-05 02:16:21', '2016-12-05 02:16:21'),
(51, 49, 'Sửa thông tin phương thức thanh toán', 'admin.payment-method.getUpdate', 'Sửa thông tin phương thức thanh toán', 2, '2016-12-05 02:16:42', '2016-12-05 02:16:42'),
(52, 0, 'Nhân viên', 'admin.staff.index', 'Quản lý danh sách nhân viên', 10, '2016-12-05 02:22:20', '2017-04-01 06:49:55'),
(53, 52, 'Thêm thông tin nhân viên', 'admin.staff.getCreate', 'Thêm thông tin nhân viên', 1, '2016-12-05 02:22:46', '2016-12-05 02:22:46'),
(54, 52, 'Sửa thông tin nhân viên', 'admin.staff.getUpdate', 'Sửa thông tin nhân viên', 2, '2016-12-05 02:23:23', '2016-12-05 02:23:23'),
(55, 52, 'Phân quyền cho nhân viên', 'admin.staff.permissions', 'Phân quyền cho nhân viên', 3, '2016-12-05 02:23:53', '2016-12-05 02:23:53'),
(77, 74, 'Xoá nhà cung cấp', 'admin.supplier.getDelete', 'Xoá nhà cung cấp', 3, '2017-04-01 07:20:46', '2017-04-01 07:20:46'),
(78, 0, 'Landing Page', 'admin.landing-page.index', 'Landing Page', 16, '2017-04-01 07:21:36', '2017-04-01 07:21:36'),
(79, 78, 'Tạo thông tin Landing Page', 'admin.landing-page.create_info', 'Tạo thông tin Landing Page', 1, '2017-04-01 07:22:18', '2017-04-01 07:22:18'),
(80, 78, 'Xây dựng Landing Page', 'admin.landing-page.site', 'Xây dựng Landing Page', 2, '2017-04-01 07:24:04', '2017-04-01 07:25:12');

-- --------------------------------------------------------

--
-- Table structure for table `permission_user`
--

CREATE TABLE `permission_user` (
  `id` int(11) NOT NULL,
  `permission_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `permission_user`
--

INSERT INTO `permission_user` (`id`, `permission_id`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 2, 2, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(11) UNSIGNED NOT NULL,
  `product_group_id` int(11) NOT NULL,
  `unit_id` int(11) NOT NULL COMMENT 'Đơn vị đo',
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `sku` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL COMMENT 'Mã sản phẩm',
  `barcode` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL COMMENT 'Mã vạch để quét',
  `price` decimal(30,0) NOT NULL COMMENT 'Giá bán',
  `warning_out_of_stock` int(11) DEFAULT '0',
  `weight` int(11) DEFAULT NULL,
  `volume` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='Sản phẩm';

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `product_group_id`, `unit_id`, `name`, `sku`, `barcode`, `price`, `warning_out_of_stock`, `weight`, `volume`, `created_at`, `updated_at`) VALUES
(1, 1, 2, 'Nước uống thể thao Aquarius', 'AQUARIUS-213312312321', '231231212312312132', '7500', 10, 0, 390, '2017-03-22 01:59:34', '2017-03-22 01:59:34'),
(2, 3, 5, 'Lon nước ngọt Mirinda 330ml', 'MIRINDA-21312312321', '312312321312321', '7000', 10, 0, 330, '2017-03-22 02:02:08', '2017-03-22 02:02:08'),
(3, 3, 2, 'Nước ngọt Mirinda 1,5 Lit', 'MIRINDA-657567657654', '4566465476786867', '16000', 10, 0, 1500, '2017-03-22 02:03:20', '2017-03-22 02:03:20'),
(4, 2, 2, 'Dầu đậu nành Simply 400ml', 'DN-SIM-12312312321343', '312313123213123123', '21000', 10, 0, 400, '2017-03-22 02:04:45', '2017-03-22 02:04:45'),
(5, 2, 2, 'Dầu hướng dương Bartek', 'BARTEK-1231231243432', '1423874238748237483', '59000', 10, 0, 0, '2017-03-22 02:05:26', '2017-03-22 02:05:26'),
(6, 1, 2, 'Nước khoảng Aquafina 1,5 lit', 'AQUAFINA-2131232423', '4324355645645645', '7500', 10, 0, 1500, '2017-03-22 02:06:53', '2017-03-22 02:06:53'),
(7, 1, 4, 'Nước khoảng Aquafina 5 lit', 'AQUAFINA-77777799999', '1234679876645', '19500', 10, 0, 5000, '2017-03-22 02:08:05', '2017-03-22 02:08:05'),
(8, 3, 5, 'Nước tăng lực hoa quả dầm', 'HQD-112312312312', '2131231231231232', '15000', 10, 0, 0, '2017-03-23 06:01:59', '2017-03-23 06:01:59'),
(9, 4, 1, 'Sữa đậu nành Soymen 250ml', 'SDN-SM-2200101000', '0210001000100', '8000', 10, 0, 250, '2017-03-25 02:25:35', '2017-03-25 02:25:35');

-- --------------------------------------------------------

--
-- Table structure for table `product_group`
--

CREATE TABLE `product_group` (
  `id` int(11) NOT NULL,
  `parent_id` int(11) NOT NULL DEFAULT '0',
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='Nhóm sản phẩm';

--
-- Dumping data for table `product_group`
--

INSERT INTO `product_group` (`id`, `parent_id`, `name`, `description`, `created_at`, `updated_at`) VALUES
(1, 0, 'Nước tinh khiết', 'Nước tinh khiết', '2017-01-07 02:36:48', '2017-01-07 02:36:48'),
(2, 0, 'Dầu ăn', 'Dầu ăn', '2017-03-20 10:37:51', '2017-03-20 10:37:51'),
(3, 0, 'Nước ngọt', 'Nước ngọt', '2017-03-22 02:01:17', '2017-03-22 02:01:17'),
(4, 0, 'Sữa đậu nành', 'Sữa đậu nành', '2017-03-25 02:24:26', '2017-03-25 02:24:26');

-- --------------------------------------------------------

--
-- Table structure for table `product_images`
--

CREATE TABLE `product_images` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `data_id` int(11) NOT NULL,
  `avatar` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `provinces`
--

CREATE TABLE `provinces` (
  `id` int(11) NOT NULL,
  `name` varchar(45) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `order_number` int(11) DEFAULT NULL,
  `active` tinyint(1) DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='Tỉnh thành';

--
-- Dumping data for table `provinces`
--

INSERT INTO `provinces` (`id`, `name`, `order_number`, `active`, `created_at`, `updated_at`) VALUES
(1, 'An Giang', 1, 1, NULL, NULL),
(2, 'Bà Rịa-Vũng Tàu', 2, 1, NULL, NULL),
(3, 'Bắc Giang', 3, 1, NULL, NULL),
(4, 'Bắc Kạn', 4, 1, NULL, NULL),
(5, 'Bạc Liêu', 5, 1, NULL, NULL),
(6, 'Bắc Ninh', 6, 1, NULL, NULL),
(7, 'Bến Tre', 7, 1, NULL, NULL),
(8, 'Bình Định', 8, 1, NULL, NULL),
(9, 'Bình Dương', 9, 1, NULL, NULL),
(10, 'Bình Phước', 10, 1, NULL, NULL),
(11, 'Bình Thuận', 11, 1, NULL, NULL),
(12, 'Cà Mau', 12, 1, NULL, NULL),
(13, 'Cần Thơ', 13, 1, NULL, NULL),
(14, 'Cao Bằng', 14, 1, NULL, NULL),
(15, 'Đà Nẵng', 15, 1, NULL, NULL),
(16, 'Đắk Lắk', 16, 1, NULL, NULL),
(17, 'Đắk Nông', 17, 1, NULL, NULL),
(18, 'Điện Biên', 18, 1, NULL, NULL),
(19, 'Đồng Nai', 19, 1, NULL, NULL),
(20, 'Đồng Tháp', 20, 1, NULL, NULL),
(21, 'Gia Lai', 21, 1, NULL, NULL),
(22, 'Hà Giang', 22, 1, NULL, NULL),
(23, 'Hà Nam', 23, 1, NULL, NULL),
(24, 'Hà Nội', 24, 1, NULL, NULL),
(25, 'Hà Tĩnh', 25, 1, NULL, NULL),
(26, 'Hải Dương', 26, 1, NULL, NULL),
(27, 'Hải Phòng', 27, 1, NULL, NULL),
(28, 'Hậu Giang', 28, 1, NULL, NULL),
(29, 'Hòa Bình', 29, 1, NULL, NULL),
(30, 'Hưng Yên', 30, 1, NULL, NULL),
(31, 'Khánh Hoà', 31, 1, NULL, NULL),
(32, 'Kiên Giang', 32, 1, NULL, NULL),
(33, 'Kon Tum', 33, 1, NULL, NULL),
(34, 'Lai Châu', 34, 1, NULL, NULL),
(35, 'Lâm Đồng', 35, 1, NULL, NULL),
(36, 'Lạng Sơn', 36, 1, NULL, NULL),
(37, 'Lào Cai', 37, 1, NULL, NULL),
(38, 'Long An', 38, 1, NULL, NULL),
(39, 'Nam Định', 39, 1, NULL, NULL),
(40, 'Nghệ An', 40, 1, NULL, NULL),
(41, 'Ninh Bình', 41, 1, NULL, NULL),
(42, 'Ninh Thuận', 42, 1, NULL, NULL),
(43, 'Phú Thọ', 43, 1, NULL, NULL),
(44, 'Phú Yên', 44, 1, NULL, NULL),
(45, 'Quảng Bình', 45, 1, NULL, NULL),
(46, 'Quảng Nam', 46, 1, NULL, NULL),
(47, 'Quảng Ngãi', 47, 1, NULL, NULL),
(48, 'Quảng Ninh', 48, 1, NULL, NULL),
(49, 'Quảng Trị', 49, 1, NULL, NULL),
(50, 'Sóc Trăng', 50, 1, NULL, NULL),
(51, 'Sơn La', 51, 1, NULL, NULL),
(52, 'Tây Ninh', 52, 1, NULL, NULL),
(53, 'Thái Bình', 53, 1, NULL, NULL),
(54, 'Thái Nguyên', 54, 1, NULL, NULL),
(55, 'Thanh Hoá', 55, 1, NULL, NULL),
(56, 'Thừa Thiên-Huế', 56, 1, NULL, NULL),
(57, 'Tiền Giang', 57, 1, NULL, NULL),
(58, 'TP Hồ Chí Minh', 58, 1, NULL, NULL),
(59, 'Trà Vinh', 59, 1, NULL, NULL),
(60, 'Tuyên Quang', 60, 1, NULL, NULL),
(61, 'Vĩnh Long', 61, 1, NULL, NULL),
(62, 'Vĩnh Phúc', 62, 1, NULL, NULL),
(63, 'Yên Bái', 63, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `purchases_ph`
--

CREATE TABLE `purchases_ph` (
  `id` int(11) NOT NULL,
  `supplier_id` int(11) NOT NULL,
  `admin_id` int(11) NOT NULL COMMENT 'Người tạo phiếu',
  `name` varchar(255) NOT NULL,
  `code` varchar(255) NOT NULL,
  `total_price` decimal(10,0) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0' COMMENT 'Trạng thái : 0 - Đang xử lý : 1 - Hoàn thành : 2 - Đã nhập kho',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='Phiếu mua hàng từ bên khác';

-- --------------------------------------------------------

--
-- Table structure for table `purchases_ph_details`
--

CREATE TABLE `purchases_ph_details` (
  `id` int(11) NOT NULL,
  `purchases_ph_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `unit_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(30,0) NOT NULL COMMENT 'Giá nhập',
  `total_price` decimal(30,0) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='Chi tiết phiếu mua hàng';

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `value` text COLLATE utf8_unicode_ci NOT NULL,
  `default_value` text COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `required` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `name`, `value`, `default_value`, `description`, `required`, `created_at`, `updated_at`) VALUES
(1, 'elements_dir', 'elements', 'elements', '<h4>Elements Directory</h4><p>The directory where all your element HTML files are stored. This value is relative to the directory in which you installed the application. Do not add a trailing "/" </p>', 1, '2016-12-23 02:12:25', '2016-12-23 02:12:25'),
(2, 'images_dir', 'elements/images', 'elements/images', '<h4>Image Directory</h4><p>This is the main directory for the images used by your elements. The images located in this directory belong to the administrator and can not be deleted by regular users. This directory needs to have <b>full read and write permissions!</b></p>', 1, '2016-12-23 02:12:25', '2016-12-23 02:12:25'),
(3, 'images_uploadDir', 'elements/images/uploads', 'elements/images/uploads', '<h4>Image Upload Directory</h4><p>This directory is used to store images uploaded by regular users. Each user will have his/her own directory within this directory. This directory needs to have <b>full read and write permissions!</b>.</p>', 1, '2016-12-23 02:12:25', '2016-12-23 02:12:25'),
(4, 'upload_allowed_types', 'gif|jpg|png', 'gif|jpg|png', '<h4>Allowed Image Types</h4><p>The types of images users are allowed to upload, separated by "|".</p>', 1, '2016-12-23 02:12:25', '2016-12-23 02:12:25'),
(5, 'upload_max_size', '1000', '1000', '<h4>Maximum Upload Filesize</h4><p>The maximum allowed filesize for images uploaded by users. This number is represents the number of kilobytes. Please note that this number of overruled by possible server settings.</p>', 1, '2016-12-23 02:12:25', '2016-12-23 02:12:25'),
(6, 'upload_max_width', '1024', '1024', '<h4>Maximum Upload Width</h4><p>The maximum allowed width for images uploaded by users.</p>', 1, '2016-12-23 02:12:25', '2016-12-23 02:12:25'),
(7, 'upload_max_height', '768', '768', '<h4>Maximum Upload Height</h4><p>The maximum allowed height for images uploaded by users.</p>', 1, '2016-12-23 02:12:25', '2016-12-23 02:12:25'),
(8, 'images_allowedExtensions', 'jpg|png|gif|svg', 'jpg|png|gif|svg', '<h4>Allowed Extensions</h4><p>These allowed extensions are used when displayed the image library to the user, only these file types will be visible.</p>', 1, '2016-12-23 02:12:25', '2016-12-23 02:12:25'),
(9, 'export_pathToAssets', 'elements/bootstrap|elements/css|elements/fonts|elements/images|elements/js', 'elements/bootstrap|elements/css|elements/fonts|elements/images|elements/js', '<h4>Assets Included in the export</h4><p>The collection of asset paths included in the export function. These paths are relative to the folder in which the application was installed and should have NO trailing "/". The paths are separated by "|".</p>', 1, '2016-12-23 02:12:25', '2016-12-23 02:12:25'),
(10, 'export_fileName', 'website.zip', 'website.zip', '<h4>The Export File Name</h4><p>The name of the ZIP archive file downloaded when exporting a site. We recommend using the ".zip" file extension (others might work, but have not been tested).</p>', 1, '2016-12-23 02:12:25', '2016-12-23 02:12:25'),
(11, 'index_page', 'index.php', 'index.php', '<h4>Index Page</h4><p>Set to "index.php" by default. If you\'d like to use pretty URLs (without "index.php" in them) leave this setting empty. If you want to use pretty URLs, don\'t forget to update your ".htaccess" file as well (more information can be found in the provided documentation).</p>', 1, '2016-12-23 02:12:25', '2016-12-23 02:12:25'),
(12, 'language', 'english', 'english', '<h4>Application Language</h4><p>"english" by default. If you\'re changing this to anything else, please be sure to have all required language files translated and located in the correct folder inside "/application/languages/yourlanguage".</p>', 1, '2016-12-23 02:12:25', '2016-12-23 02:12:25');

-- --------------------------------------------------------

--
-- Table structure for table `sites`
--

CREATE TABLE `sites` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `channel_id` int(11) DEFAULT NULL,
  `site_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ftp_server` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ftp_user` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ftp_password` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ftp_path` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ftp_port` int(11) DEFAULT NULL,
  `ftp_ok` tinyint(1) DEFAULT NULL,
  `ftp_published` tinyint(1) DEFAULT NULL,
  `publish_date` int(11) DEFAULT NULL,
  `global_css` text COLLATE utf8_unicode_ci,
  `remote_url` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `site_trashed` tinyint(1) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `sites`
--

INSERT INTO `sites` (`id`, `user_id`, `product_id`, `channel_id`, `site_name`, `slug`, `ftp_server`, `ftp_user`, `ftp_password`, `ftp_path`, `ftp_port`, `ftp_ok`, `ftp_published`, `publish_date`, `global_css`, `remote_url`, `site_trashed`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, 'Lavie 150ml Bình sứ', NULL, '', '', '', '', 0, 0, NULL, NULL, '', '', 0, '2017-01-07 02:37:49', '2017-03-15 07:26:47');

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `address` text,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='Nhà cung cấp';

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`id`, `name`, `phone`, `email`, `address`, `created_at`, `updated_at`) VALUES
(1, 'Công Ty Tam Nguyên', '00000000000', 'pmhung07@gmail.com', 'To 50, Thanh Xuan Trung, Thanh Xuan', '2017-01-06 07:49:10', '2017-01-06 07:49:10'),
(4, 'Metro Thăng Long - Hà Nội', '01678481198', 'metrothanglong@gmail.com', 'Hà Nội', '2017-01-17 08:51:50', '2017-01-17 08:51:50');

-- --------------------------------------------------------

--
-- Table structure for table `transfer_ph`
--

CREATE TABLE `transfer_ph` (
  `id` int(11) NOT NULL,
  `admin_id` int(11) NOT NULL,
  `warehouse_root` int(11) NOT NULL,
  `warehouse_destination` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `code` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `transfer_ph_details`
--

CREATE TABLE `transfer_ph_details` (
  `id` int(11) NOT NULL,
  `transfer_ph_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `units`
--

CREATE TABLE `units` (
  `id` int(11) NOT NULL,
  `name` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `active` tinyint(4) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='Đơn vị đo';

--
-- Dumping data for table `units`
--

INSERT INTO `units` (`id`, `name`, `active`, `created_at`, `updated_at`) VALUES
(1, 'Sản phẩm', 1, '2017-01-06 07:26:53', '2017-01-06 07:26:53'),
(2, 'Chai', 1, '2017-01-06 07:26:56', '2017-01-06 07:26:56'),
(4, 'Bình', 1, '2017-02-10 07:03:43', '2017-02-10 07:03:43'),
(5, 'Lon', 1, '2017-03-22 02:00:09', '2017-03-29 04:43:28');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_position_id` int(11) NOT NULL DEFAULT '0',
  `user` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8_unicode_ci,
  `identity_card_number` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `permissions` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `user_position_id`, `user`, `name`, `email`, `phone`, `address`, `identity_card_number`, `password`, `remember_token`, `permissions`, `created_at`, `updated_at`) VALUES
(1, 0, 'admin', 'Phạm Mạnh Hùng', 'pmhung07@gmail.com', '01678481197', '35 Nguyễn Tuân - Hà Nội', NULL, '$2y$10$6Xx1y9Se3Q6Pp.OG7l0nfeMmxOh.f1bbWgeTaILlYhr2F6dOLRuXy', 'HoFIWI4h3aypHoREcYjAW1jb7UhBe9NCYMzmOPLO', NULL, NULL, '2017-03-28 09:32:53'),
(2, 2, 'nhungtt', 'Trương Nhung', 'nhungtt@gmail.com', '0984615260', 'Giáp Bát - Hà Nội', NULL, '$2y$10$6Xx1y9Se3Q6Pp.OG7l0nfeMmxOh.f1bbWgeTaILlYhr2F6dOLRuXy', 'FQ5ycB6mSRt51T3hTbjFwXGnASWV9ztNSKOAnpwM', '["3","5","4","6","21","22","23","24","25","26","27","28","29","30","31","32","33","34","35","36","59","60","61"]', '2016-11-29 17:00:00', '2017-04-03 06:36:08'),
(3, 0, NULL, 'Nguyễn Công Phượng', 'congphuongmatloz@gmail.com', '0987662533', 'Nguyễn Thị Định - Hà Nội', NULL, '$2y$10$Mh2QZ8UJ0.KmS8rbNDuk5.YTLI7pmgq1UdCvPwQjH2RHgV12.w.TG', 'HoFIWI4h3aypHoREcYjAW1jb7UhBe9NCYMzmOPLO', '["2","1","3","4"]', '2016-11-30 20:59:44', '2017-03-28 09:32:03'),
(4, 3, NULL, 'Lương Văn Công', 'congluong@gmail.com', '01678882929', 'Hà Nội', '112234131212', '$2y$10$BodHFAFaWG15d7Jk.Hde7.MRXiBBJ2fuBpkoPNMCJ4uvi1Zh.RIfK', 'FQ5ycB6mSRt51T3hTbjFwXGnASWV9ztNSKOAnpwM', '["2","1","7","57","58","15"]', '2017-04-03 06:44:17', '2017-04-03 07:22:51');

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
(3, 'Nhân viên bán hàng cấp 1', '["1","7","57","58","15"]', 1, 0, '2017-04-03 06:01:18', '2017-04-03 06:01:18'),
(4, 'Nhân viên bán hàng cấp 2', '["2"]', 1, 0, '2017-04-03 06:57:37', '2017-04-03 06:57:37'),
(5, 'Nhân viên Telesale', '["1","7","57","58","15","29","59","60","61","43","44","45","69"]', 1, 1, '2017-04-03 06:59:03', '2017-04-03 04:42:46'),
(6, 'Nhân viên bán hàng cấp 3', '["3","5","4","6","21","22","23","24"]', 1, 0, '2017-04-03 06:59:34', '2017-04-03 06:59:34');

-- --------------------------------------------------------

--
-- Table structure for table `warehouse`
--

CREATE TABLE `warehouse` (
  `id` int(11) NOT NULL,
  `province_id` int(11) DEFAULT NULL,
  `district_id` int(11) DEFAULT NULL,
  `code` varchar(255) DEFAULT NULL COMMENT 'Mã kho',
  `name` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `admin_id` int(11) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='Nhà kho';

--
-- Dumping data for table `warehouse`
--

INSERT INTO `warehouse` (`id`, `province_id`, `district_id`, `code`, `name`, `address`, `admin_id`, `created_at`, `updated_at`) VALUES
(1, NULL, NULL, 'NT-35-20171701155302', 'Kho 35 Nguyễn Tuân - Hà Nội', '35 Nguyễn Tuân - Thanh Xuân Trung - Hà Nội', 1, '2017-01-17 08:53:16', '2017-01-17 08:53:16'),
(2, NULL, NULL, 'TDH-00000001', 'Kho 250 Trần Duy Hưng', '250 Trần Duy Hưng - Hà Nội', 1, '2017-03-20 06:59:41', '2017-03-20 06:59:41');

-- --------------------------------------------------------

--
-- Table structure for table `warehouse_inventory`
--

CREATE TABLE `warehouse_inventory` (
  `id` int(11) NOT NULL,
  `warehouse_id` int(11) NOT NULL,
  `warehouse_ph_id` int(11) DEFAULT NULL,
  `product_id` int(11) NOT NULL,
  `unit_id` int(11) DEFAULT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(10,0) NOT NULL COMMENT 'Giá nhập',
  `total_price` decimal(10,0) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='Chi tiết tồn kho';

--
-- Dumping data for table `warehouse_inventory`
--

INSERT INTO `warehouse_inventory` (`id`, `warehouse_id`, `warehouse_ph_id`, `product_id`, `unit_id`, `quantity`, `price`, `total_price`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 4, NULL, 100, '15000', '1500000', NULL, NULL),
(2, 1, 1, 5, NULL, 100, '40000', '4000000', NULL, NULL),
(3, 1, 1, 2, NULL, 99, '5000', '500000', NULL, '2017-04-10 10:21:30'),
(4, 1, 1, 6, NULL, 100, '5500', '550000', NULL, NULL),
(5, 1, 1, 7, NULL, 100, '16000', '1600000', NULL, NULL),
(6, 1, 1, 3, NULL, 100, '13500', '1350000', NULL, '2017-03-23 05:50:54'),
(7, 1, 1, 1, NULL, 98, '7500', '750000', NULL, '2017-03-24 05:02:52'),
(8, 2, 2, 4, NULL, 100, '18000', '1800000', NULL, '2017-03-23 09:08:37'),
(9, 2, 2, 5, NULL, 100, '42000', '4200000', NULL, NULL),
(10, 2, 2, 2, NULL, 90, '4500', '450000', NULL, '2017-03-25 03:47:43'),
(11, 2, 2, 6, NULL, 100, '5500', '550000', NULL, NULL),
(12, 2, 2, 7, NULL, 100, '16500', '1650000', NULL, NULL),
(13, 2, 2, 3, NULL, 100, '13500', '1350000', NULL, '2017-03-23 09:03:38'),
(14, 2, 2, 1, NULL, 94, '4500', '450000', NULL, '2017-03-28 02:14:23'),
(16, 2, 4, 8, NULL, 5, '8500', '42500', NULL, '2017-03-23 06:13:28'),
(19, 1, NULL, 1, NULL, 1, '7500', NULL, '2017-03-24 05:03:29', '2017-03-24 05:03:29'),
(32, 2, NULL, 9, NULL, 2, '5000', NULL, '2017-03-25 03:53:32', '2017-03-25 03:53:32'),
(31, 2, NULL, 9, NULL, 1, '5000', NULL, '2017-03-25 03:53:32', '2017-03-25 03:53:32'),
(22, 1, 9, 9, NULL, 5, '4500', '22500', NULL, NULL),
(25, 2, 7, 9, NULL, 1, '5000', '20000', NULL, '2017-03-25 03:51:31'),
(29, 2, NULL, 1, NULL, 3, '4500', NULL, '2017-03-25 03:42:18', '2017-03-25 03:42:18'),
(30, 2, NULL, 2, NULL, 10, '4500', NULL, '2017-03-25 03:48:05', '2017-03-25 03:48:05'),
(33, 2, NULL, 9, NULL, 4, '4000', NULL, '2017-03-25 03:53:32', '2017-03-25 03:53:32');

-- --------------------------------------------------------

--
-- Table structure for table `warehouse_ph`
--

CREATE TABLE `warehouse_ph` (
  `id` int(11) NOT NULL,
  `supplier_id` int(11) NOT NULL,
  `warehouse_id` int(11) NOT NULL,
  `admin_id` int(11) NOT NULL COMMENT 'Người tạo phiếu',
  `name` varchar(255) DEFAULT NULL,
  `code` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '0' COMMENT '0 : Chưa nhập - 1 : Đã nhập',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='Phiếu nhập kho';

--
-- Dumping data for table `warehouse_ph`
--

INSERT INTO `warehouse_ph` (`id`, `supplier_id`, `warehouse_id`, `admin_id`, `name`, `code`, `status`, `created_at`, `updated_at`) VALUES
(1, 4, 1, 1, 'Phiếu nhập kho 22/03/2017', 'NK/22032017095515', 1, '2017-03-22 02:55:15', '2017-03-22 03:00:57'),
(2, 1, 2, 1, 'Phiếu nhập kho 250 Trần Duy Hưng 22/03/2017', 'NK/22032017100541', 1, '2017-03-22 03:05:41', '2017-03-22 03:12:44'),
(3, 4, 2, 1, 'Phiếu nhập kho 23/3/2017 vào kho 250 Trần Duy Hưng', 'NK/23032017010412', 1, '2017-03-23 06:04:12', '2017-03-23 06:08:56'),
(4, 1, 2, 1, 'Phiếu nhập kho 23/3/2017 vào kho 250 Trần Duy Hưng Tam Nguyên', 'NK/23032017010936', 1, '2017-03-23 06:09:36', '2017-03-23 06:10:05'),
(8, 4, 2, 1, 'Phiếp nhập kho sữa đậu nành Soimen vào kho - Trần Duy Hưng - 25/3/2017 -ptr', 'NK/25032017092913', 1, '2017-03-25 02:29:13', '2017-03-25 03:04:17'),
(9, 4, 1, 1, 'Phiếp nhập kho sữa đậu nành Soimen vào kho - NT - 25/3/2017', 'NK/25032017092953', 1, '2017-03-25 02:29:53', '2017-03-25 02:30:16'),
(7, 1, 2, 1, 'Phiếp nhập kho sữa đậu nành Soimen vào kho - Trần Duy Hưng - 25/3/2017', 'NK/25032017092823', 1, '2017-03-25 02:28:23', '2017-03-25 03:03:17');

-- --------------------------------------------------------

--
-- Table structure for table `warehouse_ph_details`
--

CREATE TABLE `warehouse_ph_details` (
  `id` int(11) NOT NULL,
  `warehouse_ph_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `unit_id` int(11) DEFAULT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(10,0) NOT NULL COMMENT 'Giá nhập',
  `total_price` decimal(10,0) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='Chi tiết phiếu nhập kho';

--
-- Dumping data for table `warehouse_ph_details`
--

INSERT INTO `warehouse_ph_details` (`id`, `warehouse_ph_id`, `product_id`, `unit_id`, `quantity`, `price`, `total_price`, `created_at`, `updated_at`) VALUES
(1, 1, 4, NULL, 100, '15000', '1500000', '2017-03-22 02:58:24', '2017-03-22 02:58:24'),
(2, 1, 5, NULL, 100, '40000', '4000000', '2017-03-22 02:58:43', '2017-03-22 02:58:43'),
(3, 1, 2, NULL, 100, '5000', '500000', '2017-03-22 02:59:02', '2017-03-22 02:59:02'),
(4, 1, 6, NULL, 100, '5500', '550000', '2017-03-22 02:59:19', '2017-03-22 02:59:19'),
(5, 1, 7, NULL, 100, '16000', '1600000', '2017-03-22 02:59:56', '2017-03-22 02:59:56'),
(6, 1, 3, NULL, 100, '13500', '1350000', '2017-03-22 03:00:11', '2017-03-22 03:00:11'),
(7, 1, 1, NULL, 100, '7500', '750000', '2017-03-22 03:00:36', '2017-03-22 03:00:36'),
(8, 2, 4, NULL, 100, '18000', '1800000', '2017-03-22 03:09:37', '2017-03-22 03:09:37'),
(9, 2, 5, NULL, 100, '42000', '4200000', '2017-03-22 03:09:58', '2017-03-22 03:09:58'),
(10, 2, 2, NULL, 100, '4500', '450000', '2017-03-22 03:10:17', '2017-03-22 03:10:17'),
(11, 2, 6, NULL, 100, '5500', '550000', '2017-03-22 03:10:39', '2017-03-22 03:10:39'),
(12, 2, 7, NULL, 100, '16500', '1650000', '2017-03-22 03:11:05', '2017-03-22 03:11:05'),
(13, 2, 3, NULL, 100, '13500', '1350000', '2017-03-22 03:12:21', '2017-03-22 03:12:21'),
(14, 2, 1, NULL, 100, '4500', '450000', '2017-03-22 03:12:36', '2017-03-22 03:12:36'),
(16, 3, 8, NULL, 3, '10000', '30000', '2017-03-23 06:08:25', '2017-03-23 06:08:25'),
(17, 4, 8, NULL, 5, '8500', '42500', '2017-03-23 06:10:00', '2017-03-23 06:10:00'),
(21, 8, 9, NULL, 5, '4000', '20000', '2017-03-25 02:29:24', '2017-03-25 02:29:24'),
(20, 7, 9, NULL, 4, '5000', '20000', '2017-03-25 02:28:39', '2017-03-25 02:28:39'),
(22, 9, 9, NULL, 5, '4500', '22500', '2017-03-25 02:30:13', '2017-03-25 02:30:13');

-- --------------------------------------------------------

--
-- Table structure for table `warehouse_return_product_ph`
--

CREATE TABLE `warehouse_return_product_ph` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `warehouse_id` int(11) NOT NULL,
  `admin_id` int(11) NOT NULL COMMENT 'Người tạo phiếu',
  `name` varchar(255) DEFAULT NULL,
  `code` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '0' COMMENT '0 : Chưa nhập - 1 : Đã nhập',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='Phiếu trả hàng nhập kho';

--
-- Dumping data for table `warehouse_return_product_ph`
--

INSERT INTO `warehouse_return_product_ph` (`id`, `order_id`, `warehouse_id`, `admin_id`, `name`, `code`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 2, 1, 'Phiếu trả hàng đơn hàng: MDH/25032017100657 - 25032017102723', 'PTH25032017102723', 1, '2017-03-25 03:27:23', '2017-03-25 03:27:23'),
(2, 2, 2, 1, 'Phiếu trả hàng đơn hàng: MDH/25032017103700 - 25032017104218', 'PTH25032017104218', 1, '2017-03-25 03:42:18', '2017-03-25 03:42:18'),
(3, 3, 2, 1, 'Phiếu trả hàng đơn hàng: MDH/25032017104723 - 25032017104805', 'PTH25032017104805', 1, '2017-03-25 03:48:05', '2017-03-25 03:48:05'),
(4, 4, 2, 1, 'Phiếu trả hàng đơn hàng: MDH/25032017105104 - 25032017105332', 'PTH25032017105332', 1, '2017-03-25 03:53:32', '2017-03-25 03:53:32');

-- --------------------------------------------------------

--
-- Table structure for table `warehouse_return_product_ph_details`
--

CREATE TABLE `warehouse_return_product_ph_details` (
  `id` int(11) NOT NULL,
  `warehouse_return_product_ph_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `unit_id` int(11) DEFAULT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(10,0) NOT NULL COMMENT 'Giá nhập',
  `total_price` decimal(10,0) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='Chi tiết phiếu trả hàng nhập kho';

--
-- Dumping data for table `warehouse_return_product_ph_details`
--

INSERT INTO `warehouse_return_product_ph_details` (`id`, `warehouse_return_product_ph_id`, `product_id`, `unit_id`, `quantity`, `price`, `total_price`, `created_at`, `updated_at`) VALUES
(1, 1, 9, NULL, 7, '8000', '56000', NULL, NULL),
(2, 2, 1, NULL, 3, '7500', '22500', NULL, NULL),
(3, 3, 2, NULL, 10, '7000', '70000', NULL, NULL),
(4, 4, 9, NULL, 7, '8000', '56000', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `channel`
--
ALTER TABLE `channel`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `data`
--
ALTER TABLE `data`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `districts`
--
ALTER TABLE `districts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `frames`
--
ALTER TABLE `frames`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `inventory`
--
ALTER TABLE `inventory`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_details_product_in_stock`
--
ALTER TABLE `order_details_product_in_stock`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_processing`
--
ALTER TABLE `order_processing`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`),
  ADD KEY `password_resets_token_index` (`token`);

--
-- Indexes for table `payment_methods`
--
ALTER TABLE `payment_methods`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `permission_user`
--
ALTER TABLE `permission_user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_group`
--
ALTER TABLE `product_group`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_images`
--
ALTER TABLE `product_images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `provinces`
--
ALTER TABLE `provinces`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `purchases_ph`
--
ALTER TABLE `purchases_ph`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `purchases_ph_details`
--
ALTER TABLE `purchases_ph_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sites`
--
ALTER TABLE `sites`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transfer_ph`
--
ALTER TABLE `transfer_ph`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transfer_ph_details`
--
ALTER TABLE `transfer_ph_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `units`
--
ALTER TABLE `units`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `users_position`
--
ALTER TABLE `users_position`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `warehouse`
--
ALTER TABLE `warehouse`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `warehouse_inventory`
--
ALTER TABLE `warehouse_inventory`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `warehouse_ph`
--
ALTER TABLE `warehouse_ph`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `warehouse_ph_details`
--
ALTER TABLE `warehouse_ph_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `warehouse_return_product_ph`
--
ALTER TABLE `warehouse_return_product_ph`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `warehouse_return_product_ph_details`
--
ALTER TABLE `warehouse_return_product_ph_details`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `channel`
--
ALTER TABLE `channel`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `data`
--
ALTER TABLE `data`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `districts`
--
ALTER TABLE `districts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=706;
--
-- AUTO_INCREMENT for table `frames`
--
ALTER TABLE `frames`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
--
-- AUTO_INCREMENT for table `inventory`
--
ALTER TABLE `inventory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `order_details`
--
ALTER TABLE `order_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `order_details_product_in_stock`
--
ALTER TABLE `order_details_product_in_stock`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `order_processing`
--
ALTER TABLE `order_processing`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `payment_methods`
--
ALTER TABLE `payment_methods`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;
--
-- AUTO_INCREMENT for table `permission_user`
--
ALTER TABLE `permission_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `product_group`
--
ALTER TABLE `product_group`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `product_images`
--
ALTER TABLE `product_images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `provinces`
--
ALTER TABLE `provinces`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;
--
-- AUTO_INCREMENT for table `purchases_ph`
--
ALTER TABLE `purchases_ph`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `purchases_ph_details`
--
ALTER TABLE `purchases_ph_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `sites`
--
ALTER TABLE `sites`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `supplier`
--
ALTER TABLE `supplier`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `transfer_ph`
--
ALTER TABLE `transfer_ph`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `transfer_ph_details`
--
ALTER TABLE `transfer_ph_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `units`
--
ALTER TABLE `units`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `users_position`
--
ALTER TABLE `users_position`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `warehouse`
--
ALTER TABLE `warehouse`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `warehouse_inventory`
--
ALTER TABLE `warehouse_inventory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;
--
-- AUTO_INCREMENT for table `warehouse_ph`
--
ALTER TABLE `warehouse_ph`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `warehouse_ph_details`
--
ALTER TABLE `warehouse_ph_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT for table `warehouse_return_product_ph`
--
ALTER TABLE `warehouse_return_product_ph`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `warehouse_return_product_ph_details`
--
ALTER TABLE `warehouse_return_product_ph_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
