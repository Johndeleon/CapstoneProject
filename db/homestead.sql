-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Mar 08, 2019 at 11:03 PM
-- Server version: 5.7.24
-- PHP Version: 7.2.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `homestead`
--

-- --------------------------------------------------------

--
-- Table structure for table `academic_years`
--

DROP TABLE IF EXISTS `academic_years`;
CREATE TABLE IF NOT EXISTS `academic_years` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `academic_year` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `starts_at` int(11) NOT NULL,
  `ends_at` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `academic_years`
--

INSERT INTO `academic_years` (`id`, `academic_year`, `starts_at`, `ends_at`, `status`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, '2018 - 2019', 2018, 2019, 1, NULL, '2019-03-08 04:17:27', '2019-03-08 04:17:27');

-- --------------------------------------------------------

--
-- Table structure for table `available_times`
--

DROP TABLE IF EXISTS `available_times`;
CREATE TABLE IF NOT EXISTS `available_times` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `teacher_id` int(11) NOT NULL,
  `available_day` int(11) NOT NULL,
  `time_start` int(11) NOT NULL,
  `time_finish` int(11) NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=169 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `available_times`
--

INSERT INTO `available_times` (`id`, `teacher_id`, `available_day`, `time_start`, `time_finish`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 800, 2000, NULL, '2019-03-08 04:19:38', '2019-03-08 04:19:38'),
(2, 1, 2, 800, 2000, NULL, '2019-03-08 04:19:38', '2019-03-08 04:19:38'),
(3, 1, 3, 800, 2000, NULL, '2019-03-08 04:19:38', '2019-03-08 04:19:38'),
(4, 1, 4, 800, 2000, NULL, '2019-03-08 04:19:38', '2019-03-08 04:19:38'),
(5, 1, 5, 800, 2000, NULL, '2019-03-08 04:19:38', '2019-03-08 04:19:38'),
(6, 1, 6, 800, 2000, NULL, '2019-03-08 04:19:38', '2019-03-08 04:19:38'),
(7, 2, 1, 800, 2000, NULL, '2019-03-08 04:19:38', '2019-03-08 04:19:38'),
(8, 2, 2, 800, 2000, NULL, '2019-03-08 04:19:38', '2019-03-08 04:19:38'),
(9, 2, 3, 800, 2000, NULL, '2019-03-08 04:19:38', '2019-03-08 04:19:38'),
(10, 2, 4, 800, 2000, NULL, '2019-03-08 04:19:38', '2019-03-08 04:19:38'),
(11, 2, 5, 800, 2000, NULL, '2019-03-08 04:19:38', '2019-03-08 04:19:38'),
(12, 2, 6, 800, 2000, NULL, '2019-03-08 04:19:38', '2019-03-08 04:19:38'),
(13, 4, 1, 800, 2000, NULL, '2019-03-08 04:19:38', '2019-03-08 04:19:38'),
(14, 4, 2, 800, 2000, NULL, '2019-03-08 04:19:38', '2019-03-08 04:19:38'),
(15, 4, 3, 800, 2000, NULL, '2019-03-08 04:19:38', '2019-03-08 04:19:38'),
(16, 4, 4, 800, 2000, NULL, '2019-03-08 04:19:38', '2019-03-08 04:19:38'),
(17, 4, 5, 800, 2000, NULL, '2019-03-08 04:19:38', '2019-03-08 04:19:38'),
(18, 4, 6, 800, 2000, NULL, '2019-03-08 04:19:38', '2019-03-08 04:19:38'),
(19, 3, 1, 800, 2000, NULL, '2019-03-08 04:19:38', '2019-03-08 04:19:38'),
(20, 3, 2, 800, 2000, NULL, '2019-03-08 04:19:38', '2019-03-08 04:19:38'),
(21, 3, 3, 800, 2000, NULL, '2019-03-08 04:19:38', '2019-03-08 04:19:38'),
(22, 3, 4, 800, 2000, NULL, '2019-03-08 04:19:38', '2019-03-08 04:19:38'),
(23, 3, 5, 800, 2000, NULL, '2019-03-08 04:19:38', '2019-03-08 04:19:38'),
(24, 3, 6, 800, 2000, NULL, '2019-03-08 04:19:38', '2019-03-08 04:19:38'),
(25, 5, 1, 800, 2000, NULL, '2019-03-08 04:19:38', '2019-03-08 04:19:38'),
(26, 5, 2, 800, 2000, NULL, '2019-03-08 04:19:38', '2019-03-08 04:19:38'),
(27, 5, 3, 800, 2000, NULL, '2019-03-08 04:19:38', '2019-03-08 04:19:38'),
(28, 5, 4, 800, 2000, NULL, '2019-03-08 04:19:38', '2019-03-08 04:19:38'),
(29, 5, 5, 800, 2000, NULL, '2019-03-08 04:19:38', '2019-03-08 04:19:38'),
(30, 5, 6, 800, 2000, NULL, '2019-03-08 04:19:38', '2019-03-08 04:19:38'),
(31, 6, 1, 800, 2000, NULL, '2019-03-08 04:19:38', '2019-03-08 04:19:38'),
(32, 6, 2, 800, 2000, NULL, '2019-03-08 04:19:38', '2019-03-08 04:19:38'),
(33, 6, 3, 800, 2000, NULL, '2019-03-08 04:19:38', '2019-03-08 04:19:38'),
(34, 6, 4, 800, 2000, NULL, '2019-03-08 04:19:38', '2019-03-08 04:19:38'),
(35, 6, 5, 800, 2000, NULL, '2019-03-08 04:19:38', '2019-03-08 04:19:38'),
(36, 6, 6, 800, 2000, NULL, '2019-03-08 04:19:38', '2019-03-08 04:19:38'),
(37, 7, 1, 800, 2000, NULL, '2019-03-08 04:19:38', '2019-03-08 04:19:38'),
(38, 7, 2, 800, 2000, NULL, '2019-03-08 04:19:38', '2019-03-08 04:19:38'),
(39, 7, 3, 800, 2000, NULL, '2019-03-08 04:19:38', '2019-03-08 04:19:38'),
(40, 7, 4, 800, 2000, NULL, '2019-03-08 04:19:38', '2019-03-08 04:19:38'),
(41, 7, 5, 800, 2000, NULL, '2019-03-08 04:19:38', '2019-03-08 04:19:38'),
(42, 7, 6, 800, 2000, NULL, '2019-03-08 04:19:38', '2019-03-08 04:19:38'),
(43, 8, 1, 800, 2000, NULL, '2019-03-08 04:19:38', '2019-03-08 04:19:38'),
(44, 8, 2, 800, 2000, NULL, '2019-03-08 04:19:38', '2019-03-08 04:19:38'),
(45, 8, 3, 800, 2000, NULL, '2019-03-08 04:19:38', '2019-03-08 04:19:38'),
(46, 8, 4, 800, 2000, NULL, '2019-03-08 04:19:38', '2019-03-08 04:19:38'),
(47, 8, 5, 800, 2000, NULL, '2019-03-08 04:19:38', '2019-03-08 04:19:38'),
(48, 8, 6, 800, 2000, NULL, '2019-03-08 04:19:38', '2019-03-08 04:19:38'),
(49, 9, 1, 800, 2000, NULL, '2019-03-08 04:19:38', '2019-03-08 04:19:38'),
(50, 9, 2, 800, 2000, NULL, '2019-03-08 04:19:38', '2019-03-08 04:19:38'),
(51, 9, 3, 800, 2000, NULL, '2019-03-08 04:19:38', '2019-03-08 04:19:38'),
(52, 9, 4, 800, 2000, NULL, '2019-03-08 04:19:38', '2019-03-08 04:19:38'),
(53, 9, 5, 800, 2000, NULL, '2019-03-08 04:19:38', '2019-03-08 04:19:38'),
(54, 9, 6, 800, 2000, NULL, '2019-03-08 04:19:38', '2019-03-08 04:19:38'),
(55, 10, 1, 800, 2000, NULL, '2019-03-08 04:19:38', '2019-03-08 04:19:38'),
(56, 10, 2, 800, 2000, NULL, '2019-03-08 04:19:38', '2019-03-08 04:19:38'),
(57, 10, 3, 800, 2000, NULL, '2019-03-08 04:19:38', '2019-03-08 04:19:38'),
(58, 10, 4, 800, 2000, NULL, '2019-03-08 04:19:38', '2019-03-08 04:19:38'),
(59, 10, 5, 800, 2000, NULL, '2019-03-08 04:19:38', '2019-03-08 04:19:38'),
(60, 10, 6, 800, 2000, NULL, '2019-03-08 04:19:38', '2019-03-08 04:19:38'),
(61, 11, 1, 800, 2000, NULL, '2019-03-08 04:19:38', '2019-03-08 04:19:38'),
(62, 11, 2, 800, 2000, NULL, '2019-03-08 04:19:38', '2019-03-08 04:19:38'),
(63, 11, 3, 800, 2000, NULL, '2019-03-08 04:19:38', '2019-03-08 04:19:38'),
(64, 11, 4, 800, 2000, NULL, '2019-03-08 04:19:38', '2019-03-08 04:19:38'),
(65, 11, 5, 800, 2000, NULL, '2019-03-08 04:19:38', '2019-03-08 04:19:38'),
(66, 11, 6, 800, 2000, NULL, '2019-03-08 04:19:38', '2019-03-08 04:19:38'),
(67, 12, 1, 800, 2000, NULL, '2019-03-08 04:19:38', '2019-03-08 04:19:38'),
(68, 12, 2, 800, 2000, NULL, '2019-03-08 04:19:38', '2019-03-08 04:19:38'),
(69, 12, 3, 800, 2000, NULL, '2019-03-08 04:19:38', '2019-03-08 04:19:38'),
(70, 12, 4, 800, 2000, NULL, '2019-03-08 04:19:38', '2019-03-08 04:19:38'),
(71, 12, 5, 800, 2000, NULL, '2019-03-08 04:19:38', '2019-03-08 04:19:38'),
(72, 12, 6, 800, 2000, NULL, '2019-03-08 04:19:38', '2019-03-08 04:19:38'),
(73, 13, 1, 800, 2000, NULL, '2019-03-08 04:19:38', '2019-03-08 04:19:38'),
(74, 13, 2, 800, 2000, NULL, '2019-03-08 04:19:38', '2019-03-08 04:19:38'),
(75, 13, 3, 800, 2000, NULL, '2019-03-08 04:19:38', '2019-03-08 04:19:38'),
(76, 13, 4, 800, 2000, NULL, '2019-03-08 04:19:38', '2019-03-08 04:19:38'),
(77, 13, 5, 800, 2000, NULL, '2019-03-08 04:19:38', '2019-03-08 04:19:38'),
(78, 13, 6, 800, 2000, NULL, '2019-03-08 04:19:38', '2019-03-08 04:19:38'),
(79, 14, 1, 800, 2000, NULL, '2019-03-08 04:19:38', '2019-03-08 04:19:38'),
(80, 14, 2, 800, 2000, NULL, '2019-03-08 04:19:38', '2019-03-08 04:19:38'),
(81, 14, 3, 800, 2000, NULL, '2019-03-08 04:19:38', '2019-03-08 04:19:38'),
(82, 14, 4, 800, 2000, NULL, '2019-03-08 04:19:38', '2019-03-08 04:19:38'),
(83, 14, 5, 800, 2000, NULL, '2019-03-08 04:19:38', '2019-03-08 04:19:38'),
(84, 14, 6, 800, 2000, NULL, '2019-03-08 04:19:38', '2019-03-08 04:19:38'),
(85, 15, 1, 800, 2000, NULL, '2019-03-08 04:19:38', '2019-03-08 04:19:38'),
(86, 15, 2, 800, 2000, NULL, '2019-03-08 04:19:38', '2019-03-08 04:19:38'),
(87, 15, 3, 800, 2000, NULL, '2019-03-08 04:19:38', '2019-03-08 04:19:38'),
(88, 15, 4, 800, 2000, NULL, '2019-03-08 04:19:38', '2019-03-08 04:19:38'),
(89, 15, 5, 800, 2000, NULL, '2019-03-08 04:19:38', '2019-03-08 04:19:38'),
(90, 15, 6, 800, 2000, NULL, '2019-03-08 04:19:38', '2019-03-08 04:19:38'),
(91, 16, 1, 800, 2000, NULL, '2019-03-08 04:19:38', '2019-03-08 04:19:38'),
(92, 16, 2, 800, 2000, NULL, '2019-03-08 04:19:38', '2019-03-08 04:19:38'),
(93, 16, 3, 800, 2000, NULL, '2019-03-08 04:19:38', '2019-03-08 04:19:38'),
(94, 16, 4, 800, 2000, NULL, '2019-03-08 04:19:38', '2019-03-08 04:19:38'),
(95, 16, 5, 800, 2000, NULL, '2019-03-08 04:19:38', '2019-03-08 04:19:38'),
(96, 16, 6, 800, 2000, NULL, '2019-03-08 04:19:38', '2019-03-08 04:19:38'),
(97, 17, 1, 800, 2000, NULL, '2019-03-08 04:19:38', '2019-03-08 04:19:38'),
(98, 17, 2, 800, 2000, NULL, '2019-03-08 04:19:38', '2019-03-08 04:19:38'),
(99, 17, 3, 800, 2000, NULL, '2019-03-08 04:19:38', '2019-03-08 04:19:38'),
(100, 17, 4, 800, 2000, NULL, '2019-03-08 04:19:38', '2019-03-08 04:19:38'),
(101, 17, 5, 800, 2000, NULL, '2019-03-08 04:19:38', '2019-03-08 04:19:38'),
(102, 17, 6, 800, 2000, NULL, '2019-03-08 04:19:38', '2019-03-08 04:19:38'),
(103, 18, 1, 800, 2000, NULL, '2019-03-08 04:19:38', '2019-03-08 04:19:38'),
(104, 18, 2, 800, 2000, NULL, '2019-03-08 04:19:38', '2019-03-08 04:19:38'),
(105, 18, 3, 800, 2000, NULL, '2019-03-08 04:19:38', '2019-03-08 04:19:38'),
(106, 18, 4, 800, 2000, NULL, '2019-03-08 04:19:38', '2019-03-08 04:19:38'),
(107, 18, 5, 800, 2000, NULL, '2019-03-08 04:19:38', '2019-03-08 04:19:38'),
(108, 18, 6, 800, 2000, NULL, '2019-03-08 04:19:38', '2019-03-08 04:19:38'),
(109, 19, 1, 800, 2000, NULL, '2019-03-08 04:19:38', '2019-03-08 04:19:38'),
(110, 19, 2, 800, 2000, NULL, '2019-03-08 04:19:38', '2019-03-08 04:19:38'),
(111, 19, 3, 800, 2000, NULL, '2019-03-08 04:19:38', '2019-03-08 04:19:38'),
(112, 19, 4, 800, 2000, NULL, '2019-03-08 04:19:38', '2019-03-08 04:19:38'),
(113, 19, 5, 800, 2000, NULL, '2019-03-08 04:19:38', '2019-03-08 04:19:38'),
(114, 19, 6, 800, 2000, NULL, '2019-03-08 04:19:38', '2019-03-08 04:19:38'),
(115, 20, 1, 800, 2000, NULL, '2019-03-08 04:19:38', '2019-03-08 04:19:38'),
(116, 20, 2, 800, 2000, NULL, '2019-03-08 04:19:38', '2019-03-08 04:19:38'),
(117, 20, 3, 800, 2000, NULL, '2019-03-08 04:19:38', '2019-03-08 04:19:38'),
(118, 20, 4, 800, 2000, NULL, '2019-03-08 04:19:38', '2019-03-08 04:19:38'),
(119, 20, 5, 800, 2000, NULL, '2019-03-08 04:19:38', '2019-03-08 04:19:38'),
(120, 20, 6, 800, 2000, NULL, '2019-03-08 04:19:38', '2019-03-08 04:19:38'),
(121, 21, 1, 800, 2000, NULL, '2019-03-08 04:19:38', '2019-03-08 04:19:38'),
(122, 21, 2, 800, 2000, NULL, '2019-03-08 04:19:38', '2019-03-08 04:19:38'),
(123, 21, 3, 800, 2000, NULL, '2019-03-08 04:19:38', '2019-03-08 04:19:38'),
(124, 21, 4, 800, 2000, NULL, '2019-03-08 04:19:38', '2019-03-08 04:19:38'),
(125, 21, 5, 800, 2000, NULL, '2019-03-08 04:19:38', '2019-03-08 04:19:38'),
(126, 21, 6, 800, 2000, NULL, '2019-03-08 04:19:38', '2019-03-08 04:19:38'),
(127, 22, 1, 800, 2000, NULL, '2019-03-08 04:19:38', '2019-03-08 04:19:38'),
(128, 22, 2, 800, 2000, NULL, '2019-03-08 04:19:38', '2019-03-08 04:19:38'),
(129, 22, 3, 800, 2000, NULL, '2019-03-08 04:19:38', '2019-03-08 04:19:38'),
(130, 22, 4, 800, 2000, NULL, '2019-03-08 04:19:38', '2019-03-08 04:19:38'),
(131, 22, 5, 800, 2000, NULL, '2019-03-08 04:19:38', '2019-03-08 04:19:38'),
(132, 22, 6, 800, 2000, NULL, '2019-03-08 04:19:38', '2019-03-08 04:19:38'),
(133, 23, 1, 800, 2000, NULL, '2019-03-08 04:19:38', '2019-03-08 04:19:38'),
(134, 23, 2, 800, 2000, NULL, '2019-03-08 04:19:38', '2019-03-08 04:19:38'),
(135, 23, 3, 800, 2000, NULL, '2019-03-08 04:19:38', '2019-03-08 04:19:38'),
(136, 23, 4, 800, 2000, NULL, '2019-03-08 04:19:38', '2019-03-08 04:19:38'),
(137, 23, 5, 800, 2000, NULL, '2019-03-08 04:19:38', '2019-03-08 04:19:38'),
(138, 23, 6, 800, 2000, NULL, '2019-03-08 04:19:38', '2019-03-08 04:19:38'),
(139, 24, 1, 800, 2000, NULL, '2019-03-08 04:19:38', '2019-03-08 04:19:38'),
(140, 24, 2, 800, 2000, NULL, '2019-03-08 04:19:38', '2019-03-08 04:19:38'),
(141, 24, 3, 800, 2000, NULL, '2019-03-08 04:19:38', '2019-03-08 04:19:38'),
(142, 24, 4, 800, 2000, NULL, '2019-03-08 04:19:38', '2019-03-08 04:19:38'),
(143, 24, 5, 800, 2000, NULL, '2019-03-08 04:19:38', '2019-03-08 04:19:38'),
(144, 24, 6, 800, 2000, NULL, '2019-03-08 04:19:38', '2019-03-08 04:19:38'),
(145, 25, 1, 800, 2000, NULL, '2019-03-08 04:19:38', '2019-03-08 04:19:38'),
(146, 25, 2, 800, 2000, NULL, '2019-03-08 04:19:38', '2019-03-08 04:19:38'),
(147, 25, 3, 800, 2000, NULL, '2019-03-08 04:19:38', '2019-03-08 04:19:38'),
(148, 25, 4, 800, 2000, NULL, '2019-03-08 04:19:38', '2019-03-08 04:19:38'),
(149, 25, 5, 800, 2000, NULL, '2019-03-08 04:19:38', '2019-03-08 04:19:38'),
(150, 25, 6, 800, 2000, NULL, '2019-03-08 04:19:38', '2019-03-08 04:19:38'),
(151, 26, 1, 800, 2000, NULL, '2019-03-08 04:19:38', '2019-03-08 04:19:38'),
(152, 26, 2, 800, 2000, NULL, '2019-03-08 04:19:38', '2019-03-08 04:19:38'),
(153, 26, 3, 800, 2000, NULL, '2019-03-08 04:19:38', '2019-03-08 04:19:38'),
(154, 26, 4, 800, 2000, NULL, '2019-03-08 04:19:38', '2019-03-08 04:19:38'),
(155, 26, 5, 800, 2000, NULL, '2019-03-08 04:19:38', '2019-03-08 04:19:38'),
(156, 26, 6, 800, 2000, NULL, '2019-03-08 04:19:38', '2019-03-08 04:19:38'),
(157, 27, 1, 800, 2000, NULL, '2019-03-08 04:51:38', '2019-03-08 04:51:38'),
(158, 27, 2, 800, 2000, NULL, '2019-03-08 04:51:38', '2019-03-08 04:51:38'),
(159, 27, 3, 800, 2000, NULL, '2019-03-08 04:51:38', '2019-03-08 04:51:38'),
(160, 27, 4, 800, 2000, NULL, '2019-03-08 04:51:38', '2019-03-08 04:51:38'),
(161, 27, 5, 800, 2000, NULL, '2019-03-08 04:51:38', '2019-03-08 04:51:38'),
(162, 27, 6, 800, 2000, NULL, '2019-03-08 04:51:38', '2019-03-08 04:51:38'),
(163, 28, 1, 800, 2000, NULL, '2019-03-08 05:33:08', '2019-03-08 05:33:08'),
(164, 28, 2, 800, 2000, NULL, '2019-03-08 05:33:08', '2019-03-08 05:33:08'),
(165, 28, 3, 800, 2000, NULL, '2019-03-08 05:33:08', '2019-03-08 05:33:08'),
(166, 28, 4, 800, 2000, NULL, '2019-03-08 05:33:08', '2019-03-08 05:33:08'),
(167, 28, 5, 800, 2000, NULL, '2019-03-08 05:33:08', '2019-03-08 05:33:08'),
(168, 28, 6, 800, 2000, NULL, '2019-03-08 05:33:08', '2019-03-08 05:33:08');

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

DROP TABLE IF EXISTS `courses`;
CREATE TABLE IF NOT EXISTS `courses` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `program_id` int(11) NOT NULL,
  `academic_year` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `semester` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `level` int(11) NOT NULL,
  `teacher` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `units` int(11) DEFAULT '1',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=44 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`id`, `program_id`, `academic_year`, `semester`, `level`, `teacher`, `title`, `code`, `units`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 5, '1', '2', 1, 'Marben Adora', 'The Contemporary World ', 'GE 5', 3, NULL, '2019-03-08 08:26:07', '2019-03-08 08:26:07'),
(2, 5, '1', '2', 1, 'John Orbista', 'Art Appreciation', 'GE 6', 3, NULL, '2019-03-08 08:26:07', '2019-03-08 08:26:07'),
(3, 5, '1', '2', 1, 'John Orbista', 'Pagtuturo at Pagtataya sa Pagbasa at Pagsulat', 'Fil 1', 3, NULL, '2019-03-08 08:26:07', '2019-03-08 08:26:07'),
(4, 5, '1', '2', 1, 'George deMesa', 'Philippine Social Realities and Social Welfare', 'SW 102', 3, NULL, '2019-03-08 08:26:07', '2019-03-08 08:26:07'),
(5, 5, '1', '2', 1, 'George deMesa', 'Fields of Social Work', 'SW 103', 3, NULL, '2019-03-08 08:26:07', '2019-03-08 08:26:07'),
(6, 5, '1', '2', 1, 'Marissa Donida', 'Filipino Personality and Social Work', 'SW 104', 3, NULL, '2019-03-08 08:26:07', '2019-03-08 08:26:07'),
(7, 5, '1', '2', 1, 'Kesiah Cruz', 'Rhythmic Activities', 'PE 2', 2, NULL, '2019-03-08 08:26:07', '2019-03-08 08:26:07'),
(8, 5, '1', '2', 1, 'Richard Javier', 'National Service Training Program 2', 'NSTP 2', 3, NULL, '2019-03-08 08:26:07', '2019-03-08 08:26:07'),
(9, 5, '1', '2', 1, 'Gilbert Fruel', 'Christian Teachings 2', 'CT 2', 2, NULL, '2019-03-08 08:26:07', '2019-03-08 08:26:07'),
(10, 5, '1', '2', 3, 'John Orbista', 'World Literature', 'LIT 2', 3, NULL, '2019-03-08 08:26:19', '2019-03-08 08:26:19'),
(11, 5, '1', '2', 3, 'John Orbista', 'Rizals Life and Works', 'RIZAL', 3, NULL, '2019-03-08 08:26:19', '2019-03-08 08:26:19'),
(12, 5, '1', '2', 3, 'Lamberto Bonifacio', 'Economics', 'ONOMICS', 3, NULL, '2019-03-08 08:26:19', '2019-03-08 08:26:19'),
(13, 5, '1', '2', 3, 'Julito Varquez', 'Christian Teachings 6', 'CL 6', 2, NULL, '2019-03-08 08:26:19', '2019-03-08 08:26:19'),
(14, 5, '1', '2', 3, 'Leah Campanilla', 'Social Work Research 2', 'SW 119', 3, NULL, '2019-03-08 08:26:19', '2019-03-08 08:26:19'),
(15, 5, '1', '2', 3, 'Raquel Umbalin', 'Social Welfare Project Development and Management', 'SW 116', 3, NULL, '2019-03-08 08:26:19', '2019-03-08 08:26:19'),
(16, 5, '1', '2', 3, 'Raquel Umbalin', 'Social Work Practice with Communities', 'SW 117', 3, NULL, '2019-03-08 08:26:19', '2019-03-08 08:26:19'),
(17, 5, '1', '2', 3, 'Raquel Umbalin', 'Social Work Community Education and Training', 'SW 118', 3, NULL, '2019-03-08 08:26:19', '2019-03-08 08:26:19'),
(18, 7, '1', '2', 3, 'Ammie Pineda', 'Speech and Oral Communication', 'Eng 4', 3, NULL, '2019-03-08 08:26:30', '2019-03-08 08:26:30'),
(19, 7, '1', '2', 3, 'Albert Soriano', 'Math of Investment', 'Math 5', 3, NULL, '2019-03-08 08:26:30', '2019-03-08 08:26:30'),
(20, 7, '1', '2', 3, 'John Orbista', 'Rizal’s Life, Works and Writings', 'Hist 2', 3, NULL, '2019-03-08 08:26:30', '2019-03-08 08:26:30'),
(21, 7, '1', '2', 3, 'MaryAnn Cruz', 'Evaluation of Business Performance', 'MIS 104', 3, NULL, '2019-03-08 08:26:30', '2019-03-08 08:26:30'),
(22, 7, '1', '2', 3, 'Shareene Labung', 'Methods of Research', 'Research 1', 3, NULL, '2019-03-08 08:26:30', '2019-03-08 08:26:30'),
(23, 7, '1', '2', 3, 'Shareene Labung', 'IT Security and Risk Management', 'IS Elect 3', 3, NULL, '2019-03-08 08:26:30', '2019-03-08 08:26:30'),
(24, 7, '1', '2', 3, 'Jennifer Aguilar', 'Software Engineering', 'IS 109', 3, NULL, '2019-03-08 08:26:30', '2019-03-08 08:26:30'),
(25, 7, '1', '2', 3, 'Loyd Larazo', 'Mobile Applications Development', 'IS Elect 4', 3, NULL, '2019-03-08 08:26:30', '2019-03-08 08:26:30'),
(26, 7, '1', '2', 3, 'Shareene Labung', 'Christian Morality and Ethics', 'CL/VF 6', 2, NULL, '2019-03-08 08:26:30', '2019-03-08 08:26:30'),
(27, 3, '1', '2', 5, 'Lamberto Bonifacio', 'Business Law', 'AC 124', 3, NULL, '2019-03-08 08:27:02', '2019-03-08 08:27:02'),
(28, 3, '1', '2', 5, 'Julito Varquez', 'Christian Teaching 10', 'CL10', 2, NULL, '2019-03-08 08:27:02', '2019-03-08 08:27:02'),
(29, 3, '1', '2', 5, 'Erlinda Mallari', 'Acc Integration, Taxation', 'AC 120a', 3, NULL, '2019-03-08 08:27:02', '2019-03-08 08:27:02'),
(30, 3, '1', '2', 5, 'Erlinda Mallari', 'Acc Integration, Financial Acounting', 'AC 120b', 3, NULL, '2019-03-08 08:27:02', '2019-03-08 08:27:02'),
(31, 3, '1', '2', 5, 'Ammie Pineda', 'Acc Integration, Management Acounting', 'AC 122', 3, NULL, '2019-03-08 08:27:02', '2019-03-08 08:27:02'),
(32, 3, '1', '2', 5, 'Eric Yumul', 'Acc Integration, Advanced Acounting', 'AC 121', 3, NULL, '2019-03-08 08:27:02', '2019-03-08 08:27:02'),
(33, 3, '1', '2', 5, 'Eric Yumul', 'Acc Integration, Auditing', 'AC 123', 3, NULL, '2019-03-08 08:27:02', '2019-03-08 08:27:02'),
(34, 2, '1', '2', 1, 'Richard Javier', 'Mathematics in the Modern World', 'GE 4', 3, NULL, '2019-03-08 08:27:27', '2019-03-08 08:27:27'),
(35, 2, '1', '2', 1, 'Marben Adora', 'The Contemporary World', 'GE 5', 3, NULL, '2019-03-08 08:27:27', '2019-03-08 08:27:27'),
(36, 2, '1', '2', 1, 'John Orbista', 'Art Appreciation', 'GE 6', 3, NULL, '2019-03-08 08:27:27', '2019-03-08 08:27:27'),
(37, 2, '1', '2', 1, 'John Orbista', 'Pagtuturo at Pagtataya sa Pagbasa at Pagsulat', 'Fil 1', 3, NULL, '2019-03-08 08:27:27', '2019-03-08 08:27:27'),
(38, 2, '1', '2', 1, 'Edyssa Belandres', 'Introduction to Broadcasting, Interactive and Emerging Media', 'Broad 2', 3, NULL, '2019-03-08 08:27:27', '2019-03-08 08:27:27'),
(39, 2, '1', '2', 1, 'Caroline Laguinto', 'Communication & Media Theory', 'Broad 3', 3, NULL, '2019-03-08 08:27:27', '2019-03-08 08:27:27'),
(40, 2, '1', '2', 1, 'Kesiah Cruz', 'Rhythmic Activities', 'PE 2', 3, NULL, '2019-03-08 08:27:27', '2019-03-08 08:27:27'),
(41, 2, '1', '2', 1, 'Richard Javier', 'National Service Training Program 2', 'NSTP 2', 3, NULL, '2019-03-08 08:27:27', '2019-03-08 08:27:27'),
(42, 2, '1', '2', 1, 'Julito Varquez', 'Christian Teachings 2', 'CT 2', 2, NULL, '2019-03-08 08:27:27', '2019-03-08 08:27:27'),
(43, 5, '1', '2', 4, 'Raquel Umbalin', 'SEMINAR ON CURRENT TRENDS IN SOCIAL WORK PRACTICE', 'SW SEMINAR', 4, NULL, '2019-03-08 14:47:28', '2019-03-08 14:47:28');

-- --------------------------------------------------------

--
-- Table structure for table `fixed_schedules`
--

DROP TABLE IF EXISTS `fixed_schedules`;
CREATE TABLE IF NOT EXISTS `fixed_schedules` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `academic_year_id` int(11) NOT NULL,
  `semester` int(11) NOT NULL,
  `program_id` int(11) NOT NULL,
  `course_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `teacher_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `room_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `level` int(11) NOT NULL,
  `day` int(11) NOT NULL,
  `time_start` int(11) NOT NULL,
  `time_finish` int(11) NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=70 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `fixed_schedules`
--

INSERT INTO `fixed_schedules` (`id`, `academic_year_id`, `semester`, `program_id`, `course_name`, `teacher_name`, `room_name`, `level`, `day`, `time_start`, `time_finish`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 1, 2, 2, 'Christian Teachings 2', 'Julito Varquez', 'dsr1', 1, 5, 1300, 1400, NULL, '2019-03-08 05:44:32', '2019-03-08 05:44:32'),
(2, 1, 2, 2, 'Christian Teachings 2', 'Julito Varquez', 'dsr2', 1, 3, 1300, 1400, NULL, '2019-03-08 05:44:32', '2019-03-08 05:44:32'),
(3, 1, 2, 2, 'National Service Training Program 2', 'Richard Javier', 'dsr1', 1, 2, 1000, 1170, NULL, '2019-03-08 05:44:32', '2019-03-08 05:44:32'),
(4, 1, 2, 2, 'National Service Training Program 2', 'Richard Javier', 'dsr1', 1, 5, 1000, 1170, NULL, '2019-03-08 05:44:32', '2019-03-08 05:44:32'),
(5, 1, 2, 2, 'Rhythmic Activities', 'Kesiah Cruz', 'dsr1', 1, 4, 1030, 1230, NULL, '2019-03-08 05:44:32', '2019-03-08 05:44:32'),
(6, 1, 2, 2, 'Communication & Media Theory', 'Caroline Laguinto', 'dsr1', 1, 6, 800, 1100, NULL, '2019-03-08 05:44:32', '2019-03-08 05:44:32'),
(7, 1, 2, 2, 'Introduction to Broadcasting, Interactive and Emerging Media', 'Edyssa Belandres', 'dsr1', 1, 3, 1600, 1700, NULL, '2019-03-08 05:44:32', '2019-03-08 05:44:32'),
(8, 1, 2, 2, 'Introduction to Broadcasting, Interactive and Emerging Media', 'Edyssa Belandres', 'dsr2', 1, 4, 1600, 1700, NULL, '2019-03-08 05:44:32', '2019-03-08 05:44:32'),
(9, 1, 2, 2, 'Pagtuturo at Pagtataya sa Pagbasa at Pagsulat', 'John Orbista', 'dsr2', 1, 5, 1430, 1560, NULL, '2019-03-08 05:44:32', '2019-03-08 05:44:32'),
(10, 1, 2, 2, 'Pagtuturo at Pagtataya sa Pagbasa at Pagsulat', 'John Orbista', 'dsr3', 1, 3, 1430, 1560, NULL, '2019-03-08 05:44:32', '2019-03-08 05:44:32'),
(11, 1, 2, 2, 'Art Appreciation', 'John Orbista', 'dsr2', 1, 2, 1430, 1560, NULL, '2019-03-08 05:44:32', '2019-03-08 05:44:32'),
(12, 1, 2, 2, 'Art Appreciation', 'John Orbista', 'dsr3', 1, 4, 1430, 1560, NULL, '2019-03-08 05:44:32', '2019-03-08 05:44:32'),
(13, 1, 2, 2, 'Mathematics in the Modern World', 'Richard Javier', 'dsr2', 1, 5, 800, 930, NULL, '2019-03-08 05:44:32', '2019-03-08 05:44:32'),
(14, 1, 2, 2, 'Mathematics in the Modern World', 'Richard Javier', 'dsr3', 1, 4, 800, 930, NULL, '2019-03-08 05:44:32', '2019-03-08 05:44:32'),
(15, 1, 2, 2, 'The Contemporary World ', 'Marben Adora', 'dsr3', 1, 5, 1630, 1760, NULL, '2019-03-08 05:44:32', '2019-03-08 05:44:32'),
(16, 1, 2, 2, 'The Contemporary World ', 'Marben Adora', 'dsr4', 1, 2, 1630, 1760, NULL, '2019-03-08 05:44:32', '2019-03-08 05:44:32'),
(17, 1, 2, 3, 'Acc Integration, Advanced Acounting', 'Eric Yumul', 'dsr1', 5, 6, 900, 1200, NULL, '2019-03-08 06:12:06', '2019-03-08 06:12:06'),
(18, 1, 2, 3, 'Acc Integration, Auditing', 'Eric Yumul', 'dsr2', 5, 6, 1300, 1600, NULL, '2019-03-08 06:12:06', '2019-03-08 06:12:06'),
(19, 1, 2, 3, 'Acc Integration, Management Acounting', 'Ammie Pineda', 'dsr3', 5, 5, 830, 1130, NULL, '2019-03-08 06:12:06', '2019-03-08 06:12:06'),
(20, 1, 2, 3, 'Acc Integration, Taxation', 'Erlinda Mallari', 'dsr2', 5, 5, 1700, 1870, NULL, '2019-03-08 06:12:06', '2019-03-08 06:12:06'),
(21, 1, 2, 3, 'Acc Integration, Taxation', 'Erlinda Mallari', 'dsr2', 5, 4, 830, 960, NULL, '2019-03-08 06:12:06', '2019-03-08 06:12:06'),
(22, 1, 2, 3, 'Acc Integration, Financial Acounting', 'Erlinda Mallari', 'dsr1', 5, 5, 1530, 1660, NULL, '2019-03-08 06:12:06', '2019-03-08 06:12:06'),
(23, 1, 2, 3, 'Acc Integration, Financial Acounting', 'Erlinda Mallari', 'dsr2', 5, 4, 1700, 1830, NULL, '2019-03-08 06:12:06', '2019-03-08 06:12:06'),
(24, 1, 2, 3, 'Business Law', 'Lamberto Bonifacio', 'dsr2', 5, 4, 1830, 1960, NULL, '2019-03-08 06:12:06', '2019-03-08 06:12:06'),
(25, 1, 2, 3, 'Business Law', 'Lamberto Bonifacio', 'dsr3', 5, 3, 1830, 1960, NULL, '2019-03-08 06:12:06', '2019-03-08 06:12:06'),
(26, 1, 2, 3, 'Christian Teaching 10', 'Julito Varquez', 'dsr3', 5, 3, 1500, 1700, NULL, '2019-03-08 06:12:06', '2019-03-08 06:12:06'),
(27, 1, 2, 7, 'Methods of Research', 'Shareene Labung', 'comlabB', 3, 1, 1300, 1430, NULL, '2019-03-08 08:48:26', '2019-03-08 08:48:26'),
(28, 1, 2, 7, 'Methods of Research', 'Shareene Labung', 'comlabB', 3, 5, 1530, 1660, NULL, '2019-03-08 08:48:26', '2019-03-08 08:48:26'),
(29, 1, 2, 7, 'IT Security and Risk Management', 'Shareene Labung', 'comlabB', 3, 5, 1030, 1160, NULL, '2019-03-08 08:48:26', '2019-03-08 08:48:26'),
(30, 1, 2, 7, 'IT Security and Risk Management', 'Shareene Labung', 'comlabA', 3, 3, 1230, 1360, NULL, '2019-03-08 08:48:26', '2019-03-08 08:48:26'),
(31, 1, 2, 7, 'Christian Morality and Ethics', 'Shareene Labung', 'dsr1', 3, 3, 1000, 1100, NULL, '2019-03-08 08:48:26', '2019-03-08 08:48:26'),
(32, 1, 2, 7, 'Christian Morality and Ethics', 'Shareene Labung', 'dsr2', 3, 2, 1530, 1630, NULL, '2019-03-08 08:48:26', '2019-03-08 08:48:26'),
(33, 1, 2, 7, 'Mobile Applications Development', 'Loyd Larazo', 'comlabB', 3, 6, 1400, 1700, NULL, '2019-03-08 08:48:26', '2019-03-08 08:48:26'),
(34, 1, 2, 7, 'Software Engineering', 'Jennifer Aguilar', 'comlabA', 3, 6, 1000, 1300, NULL, '2019-03-08 08:48:26', '2019-03-08 08:48:26'),
(35, 1, 2, 7, 'Rizal’s Life, Works and Writings', 'John Orbista', 'dsr3', 3, 2, 1030, 1160, NULL, '2019-03-08 08:48:26', '2019-03-08 08:48:26'),
(36, 1, 2, 7, 'Rizal’s Life, Works and Writings', 'John Orbista', 'dsr1', 3, 1, 1500, 1630, NULL, '2019-03-08 08:48:26', '2019-03-08 08:48:26'),
(37, 1, 2, 7, 'Evaluation of Business Performance', 'MaryAnn Cruz', 'comlabB', 3, 2, 1330, 1500, NULL, '2019-03-08 08:48:26', '2019-03-08 08:48:26'),
(38, 1, 2, 7, 'Evaluation of Business Performance', 'MaryAnn Cruz', 'comlabA', 3, 5, 1400, 1530, NULL, '2019-03-08 08:48:26', '2019-03-08 08:48:26'),
(39, 1, 2, 7, 'Speech and Oral Communication', 'Ammie Pineda', 'dsr3', 3, 5, 1300, 1430, NULL, '2019-03-08 08:48:26', '2019-03-08 08:48:26'),
(40, 1, 2, 7, 'Speech and Oral Communication', 'Ammie Pineda', 'dsr3', 3, 3, 1230, 1360, NULL, '2019-03-08 08:48:26', '2019-03-08 08:48:26'),
(41, 1, 2, 7, 'Math of Investment', 'Albert Soriano', 'dsr1', 3, 2, 1300, 1430, NULL, '2019-03-08 08:48:26', '2019-03-08 08:48:26'),
(42, 1, 2, 7, 'Math of Investment', 'Albert Soriano', 'dsr4', 3, 1, 1030, 1160, NULL, '2019-03-08 08:48:26', '2019-03-08 08:48:26'),
(43, 1, 2, 5, 'Christian Teachings 2', 'Gilbert Fruel', 'dsr1', 1, 2, 1230, 1430, NULL, '2019-03-08 14:27:47', '2019-03-08 14:27:47'),
(44, 1, 2, 5, 'National Service Training Program 2', 'Richard Javier', 'dsr1', 1, 2, 1000, 1170, NULL, '2019-03-08 14:27:47', '2019-03-08 14:27:47'),
(45, 1, 2, 5, 'National Service Training Program 2', 'Richard Javier', 'dsr4', 1, 5, 1000, 1130, NULL, '2019-03-08 14:27:47', '2019-03-08 14:27:47'),
(46, 1, 2, 5, 'Rhythmic Activities', 'Kesiah Cruz', 'dsr5', 1, 4, 1030, 1230, NULL, '2019-03-08 14:27:47', '2019-03-08 14:27:47'),
(47, 1, 2, 5, 'Filipino Personality and Social Work', 'Marissa Donida', 'dsr2', 1, 3, 1430, 1560, NULL, '2019-03-08 14:27:47', '2019-03-08 14:27:47'),
(48, 1, 2, 5, 'Filipino Personality and Social Work', 'Marissa Donida', 'dsr3', 1, 5, 1430, 1560, NULL, '2019-03-08 14:27:47', '2019-03-08 14:27:47'),
(49, 1, 2, 5, 'Philippine Social Realities and Social Welfare', 'George deMesa', 'dsr3', 1, 6, 1400, 1700, NULL, '2019-03-08 14:27:47', '2019-03-08 14:27:47'),
(50, 1, 2, 5, 'Pagtuturo at Pagtataya sa Pagbasa at Pagsulat', 'John Orbista', 'dsr2', 1, 2, 1600, 1730, NULL, '2019-03-08 14:27:47', '2019-03-08 14:27:47'),
(51, 1, 2, 5, 'Pagtuturo at Pagtataya sa Pagbasa at Pagsulat', 'John Orbista', 'dsr5', 1, 3, 1600, 1730, NULL, '2019-03-08 14:27:47', '2019-03-08 14:27:47'),
(52, 1, 2, 5, 'Fields of Social Work', 'George deMesa', 'dsr3', 1, 6, 1700, 2000, NULL, '2019-03-08 14:27:47', '2019-03-08 14:27:47'),
(53, 1, 2, 5, 'The Contemporary World ', 'Marben Adora', 'dsr5', 1, 4, 1630, 1760, NULL, '2019-03-08 14:27:47', '2019-03-08 14:27:47'),
(54, 1, 2, 5, 'The Contemporary World ', 'Marben Adora', 'dsr3', 1, 5, 1300, 1430, NULL, '2019-03-08 14:27:47', '2019-03-08 14:27:47'),
(55, 1, 2, 5, 'Art Appreciation', 'John Orbista', 'dsr4', 1, 2, 1430, 1560, NULL, '2019-03-08 14:27:47', '2019-03-08 14:27:47'),
(56, 1, 2, 5, 'Art Appreciation', 'John Orbista', 'dsr4', 1, 4, 1430, 1560, NULL, '2019-03-08 14:27:47', '2019-03-08 14:27:47'),
(57, 1, 2, 5, 'Social Welfare Project Development and Management', 'Raquel Umbalin', 'dsr1', 3, 5, 800, 1100, NULL, '2019-03-08 14:45:34', '2019-03-08 14:45:34'),
(58, 1, 2, 5, 'Social Work Practice with Communities', 'Raquel Umbalin', 'dsr6', 3, 5, 1200, 1500, NULL, '2019-03-08 14:45:34', '2019-03-08 14:45:34'),
(59, 1, 2, 5, 'Social Work Community Education and Training', 'Raquel Umbalin', 'dsr6', 3, 5, 1530, 1830, NULL, '2019-03-08 14:45:34', '2019-03-08 14:45:34'),
(60, 1, 2, 5, 'Social Work Research 2', 'Leah Campanilla', 'dsr3', 3, 2, 1340, 1640, NULL, '2019-03-08 14:45:34', '2019-03-08 14:45:34'),
(61, 1, 2, 5, 'Christian Teachings 6', 'Julito Varquez', 'dsr2', 3, 4, 1530, 1630, NULL, '2019-03-08 14:45:34', '2019-03-08 14:45:34'),
(62, 1, 2, 5, 'Christian Teachings 6', 'Julito Varquez', 'dsr3', 3, 2, 930, 1030, NULL, '2019-03-08 14:45:34', '2019-03-08 14:45:34'),
(63, 1, 2, 5, 'Rizals Life and Works', 'John Orbista', 'dsr5', 3, 2, 1800, 1930, NULL, '2019-03-08 14:45:34', '2019-03-08 14:45:34'),
(64, 1, 2, 5, 'Rizals Life and Works', 'John Orbista', 'dsr3', 3, 1, 1500, 1630, NULL, '2019-03-08 14:45:34', '2019-03-08 14:45:34'),
(65, 1, 2, 5, 'Economics', 'Lamberto Bonifacio', 'dsr5', 3, 1, 1700, 1830, NULL, '2019-03-08 14:45:34', '2019-03-08 14:45:34'),
(66, 1, 2, 5, 'Economics', 'Lamberto Bonifacio', 'dsr2', 3, 4, 1700, 1830, NULL, '2019-03-08 14:45:34', '2019-03-08 14:45:34'),
(67, 1, 2, 5, 'World Literature', 'John Orbista', 'dsr4', 3, 1, 1300, 1430, NULL, '2019-03-08 14:45:34', '2019-03-08 14:45:34'),
(68, 1, 2, 5, 'World Literature', 'John Orbista', 'dsr4', 3, 4, 900, 1030, NULL, '2019-03-08 14:45:34', '2019-03-08 14:45:34'),
(69, 1, 2, 5, 'SEMINAR ON CURRENT TRENDS IN SOCIAL WORK PRACTICE', 'Raquel Umbalin', 'dsr2', 4, 6, 700, 1200, NULL, '2019-03-08 14:48:59', '2019-03-08 14:48:59');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=241 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(229, '2014_10_12_000000_create_users_table', 1),
(230, '2014_10_12_100000_create_password_resets_table', 1),
(231, '2017_11_27_054243_create_academic_years_table', 1),
(232, '2017_11_27_054414_create_programs_table', 1),
(233, '2017_11_27_055707_create_courses_table', 1),
(234, '2017_11_27_061949_create_teachers_table', 1),
(235, '2017_11_27_061957_create_teacher_courses_table', 1),
(236, '2018_11_05_012353_create_available_times_table', 1),
(237, '2018_11_05_012700_create_rooms_table', 1),
(238, '2018_11_05_012859_create_room_types_table', 1),
(239, '2018_12_03_103508_create_schedules_table', 1),
(240, '2019_02_13_013047_create_fixed_schedules_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `programs`
--

DROP TABLE IF EXISTS `programs`;
CREATE TABLE IF NOT EXISTS `programs` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `levels` int(11) NOT NULL,
  `academic_year_id` int(11) NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `programs`
--

INSERT INTO `programs` (`id`, `title`, `description`, `levels`, `academic_year_id`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'ACT', 'description', 2, 1, NULL, '2019-03-08 04:17:47', '2019-03-08 04:17:47'),
(2, 'BAB', 'description', 4, 1, NULL, '2019-03-08 04:17:47', '2019-03-08 04:17:47'),
(3, 'BSA', 'description', 5, 1, NULL, '2019-03-08 04:17:47', '2019-03-08 04:17:47'),
(4, 'BSAIS', 'description', 4, 1, NULL, '2019-03-08 04:17:47', '2019-03-08 04:17:47'),
(5, 'BSSW', 'description', 4, 1, NULL, '2019-03-08 04:17:47', '2019-03-08 04:17:47'),
(6, 'OM', 'description', 2, 1, NULL, '2019-03-08 04:17:47', '2019-03-08 04:17:47'),
(7, 'BSIS', 'description', 4, 1, NULL, '2019-03-08 04:17:47', '2019-03-08 04:17:47'),
(8, 'BSAT', 'description', 4, 1, NULL, '2019-03-08 04:17:47', '2019-03-08 04:17:47');

-- --------------------------------------------------------

--
-- Table structure for table `rooms`
--

DROP TABLE IF EXISTS `rooms`;
CREATE TABLE IF NOT EXISTS `rooms` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `room_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `room_type_id` int(11) NOT NULL,
  `available_time_start` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `available_time_finish` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `rooms`
--

INSERT INTO `rooms` (`id`, `room_name`, `room_type_id`, `available_time_start`, `available_time_finish`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'dsr1', 1, '800', '2000', NULL, '2019-03-08 04:19:17', '2019-03-08 04:19:17'),
(2, 'dsr2', 1, '800', '2000', NULL, '2019-03-08 04:19:17', '2019-03-08 04:19:17'),
(3, 'dsr3', 1, '800', '2000', NULL, '2019-03-08 04:19:17', '2019-03-08 04:19:17'),
(4, 'dsr4', 1, '800', '2000', NULL, '2019-03-08 04:19:17', '2019-03-08 04:19:17'),
(5, 'dsr5', 1, '800', '2000', NULL, '2019-03-08 04:19:17', '2019-03-08 04:19:17'),
(6, 'dsr6', 1, '800', '2000', NULL, '2019-03-08 04:19:17', '2019-03-08 04:19:17'),
(7, 'dsr7', 1, '800', '2000', NULL, '2019-03-08 04:19:17', '2019-03-08 04:19:17'),
(8, 'dsr8', 1, '800', '2000', NULL, '2019-03-08 04:19:17', '2019-03-08 04:19:17'),
(9, 'dsr9', 1, '800', '2000', NULL, '2019-03-08 04:19:17', '2019-03-08 04:19:17'),
(10, 'dsr11', 1, '800', '2000', NULL, '2019-03-08 04:19:17', '2019-03-08 04:19:17'),
(11, 'dsr12', 1, '800', '2000', NULL, '2019-03-08 04:19:17', '2019-03-08 04:19:17'),
(12, 'dsr13', 1, '800', '2000', NULL, '2019-03-08 04:19:17', '2019-03-08 04:19:17'),
(13, 'dsr14', 1, '800', '2000', NULL, '2019-03-08 04:19:17', '2019-03-08 04:19:17'),
(14, 'dsr15', 1, '800', '2000', NULL, '2019-03-08 04:19:17', '2019-03-08 04:19:17'),
(15, 'dsr16', 1, '800', '2000', NULL, '2019-03-08 04:19:17', '2019-03-08 04:19:17'),
(16, 'comlabA', 2, '800', '2000', NULL, '2019-03-08 04:19:17', '2019-03-08 04:19:17'),
(17, 'comlabB', 2, '800', '2000', NULL, '2019-03-08 04:19:17', '2019-03-08 04:19:17'),
(18, 'comlabHS', 2, '800', '2000', NULL, '2019-03-08 04:19:17', '2019-03-08 04:19:17'),
(19, 'comlabElem', 2, '800', '2000', NULL, '2019-03-08 04:19:17', '2019-03-08 04:19:17');

-- --------------------------------------------------------

--
-- Table structure for table `room_types`
--

DROP TABLE IF EXISTS `room_types`;
CREATE TABLE IF NOT EXISTS `room_types` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `room_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `room_types`
--

INSERT INTO `room_types` (`id`, `room_type`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'Normal Room', NULL, '2019-03-08 04:17:05', NULL),
(2, 'Laboratory Room', NULL, '2019-03-08 04:17:05', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `schedules`
--

DROP TABLE IF EXISTS `schedules`;
CREATE TABLE IF NOT EXISTS `schedules` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `academic_year_id` int(11) NOT NULL,
  `semester` int(11) NOT NULL,
  `program_id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `teacher_id` int(11) NOT NULL,
  `room_id` int(11) NOT NULL,
  `level` int(11) NOT NULL,
  `day_of_week` int(11) NOT NULL,
  `time_start` int(11) NOT NULL,
  `time_finish` int(11) NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=70 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `schedules`
--

INSERT INTO `schedules` (`id`, `academic_year_id`, `semester`, `program_id`, `course_id`, `teacher_id`, `room_id`, `level`, `day_of_week`, `time_start`, `time_finish`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 1, 2, 2, 9, 6, 1, 1, 5, 1300, 1400, NULL, '2019-03-08 05:37:05', '2019-03-08 05:38:52'),
(2, 1, 2, 2, 9, 6, 2, 1, 3, 1300, 1400, NULL, '2019-03-08 05:37:05', '2019-03-08 05:42:34'),
(3, 1, 2, 2, 8, 5, 1, 1, 2, 1000, 1170, NULL, '2019-03-08 05:37:05', '2019-03-08 05:43:50'),
(4, 1, 2, 2, 8, 5, 1, 1, 5, 1000, 1170, NULL, '2019-03-08 05:37:05', '2019-03-08 05:38:21'),
(5, 1, 2, 2, 7, 26, 1, 1, 4, 1030, 1230, NULL, '2019-03-08 05:37:05', '2019-03-08 05:41:05'),
(6, 1, 2, 2, 49, 28, 1, 1, 6, 800, 1100, NULL, '2019-03-08 05:37:05', '2019-03-08 05:37:35'),
(7, 1, 2, 2, 48, 17, 1, 1, 3, 1600, 1700, NULL, '2019-03-08 05:37:05', '2019-03-08 05:43:29'),
(8, 1, 2, 2, 48, 17, 2, 1, 4, 1600, 1700, NULL, '2019-03-08 05:37:05', '2019-03-08 05:41:56'),
(9, 1, 2, 2, 3, 1, 2, 1, 5, 1430, 1560, NULL, '2019-03-08 05:37:05', '2019-03-08 05:39:17'),
(10, 1, 2, 2, 3, 1, 3, 1, 3, 1430, 1560, NULL, '2019-03-08 05:37:05', '2019-03-08 05:42:46'),
(11, 1, 2, 2, 2, 1, 2, 1, 2, 1430, 1560, NULL, '2019-03-08 05:37:05', '2019-03-08 05:44:17'),
(12, 1, 2, 2, 2, 1, 3, 1, 4, 1430, 1560, NULL, '2019-03-08 05:37:05', '2019-03-08 05:41:22'),
(13, 1, 2, 2, 44, 5, 2, 1, 5, 800, 930, NULL, '2019-03-08 05:37:05', '2019-03-08 05:37:58'),
(14, 1, 2, 2, 44, 5, 3, 1, 4, 800, 930, NULL, '2019-03-08 05:37:05', '2019-03-08 05:40:14'),
(15, 1, 2, 2, 1, 25, 3, 1, 5, 1630, 1760, NULL, '2019-03-08 05:37:05', '2019-03-08 05:39:45'),
(16, 1, 2, 2, 1, 25, 4, 1, 2, 1630, 1760, NULL, '2019-03-08 05:37:05', '2019-03-08 05:40:42'),
(17, 1, 2, 3, 41, 27, 1, 5, 6, 900, 1200, NULL, '2019-03-08 05:56:06', '2019-03-08 05:56:28'),
(18, 1, 2, 3, 42, 27, 2, 5, 6, 1300, 1600, NULL, '2019-03-08 05:56:06', '2019-03-08 05:56:54'),
(19, 1, 2, 3, 40, 9, 3, 5, 5, 830, 1130, NULL, '2019-03-08 05:56:06', '2019-03-08 06:07:46'),
(20, 1, 2, 3, 38, 7, 2, 5, 5, 1700, 1870, NULL, '2019-03-08 05:56:06', '2019-03-08 06:00:12'),
(21, 1, 2, 3, 38, 7, 2, 5, 4, 830, 960, NULL, '2019-03-08 05:56:06', '2019-03-08 06:03:10'),
(22, 1, 2, 3, 39, 7, 1, 5, 5, 1530, 1660, NULL, '2019-03-08 05:56:06', '2019-03-08 06:09:47'),
(23, 1, 2, 3, 39, 7, 2, 5, 4, 1700, 1830, NULL, '2019-03-08 05:56:06', '2019-03-08 06:04:32'),
(24, 1, 2, 3, 36, 10, 2, 5, 4, 1830, 1960, NULL, '2019-03-08 05:56:06', '2019-03-08 06:11:16'),
(25, 1, 2, 3, 36, 10, 3, 5, 3, 1830, 1960, NULL, '2019-03-08 05:56:06', '2019-03-08 06:11:42'),
(26, 1, 2, 3, 37, 6, 3, 5, 3, 1500, 1700, NULL, '2019-03-08 05:56:06', '2019-03-08 06:11:58'),
(27, 1, 2, 7, 22, 3, 17, 3, 1, 1300, 1430, NULL, '2019-03-08 08:29:59', '2019-03-08 08:40:25'),
(28, 1, 2, 7, 22, 3, 17, 3, 5, 1530, 1660, NULL, '2019-03-08 08:29:59', '2019-03-08 08:38:48'),
(29, 1, 2, 7, 23, 3, 17, 3, 5, 1030, 1160, NULL, '2019-03-08 08:29:59', '2019-03-08 08:36:18'),
(30, 1, 2, 7, 23, 3, 16, 3, 3, 1230, 1360, NULL, '2019-03-08 08:29:59', '2019-03-08 08:48:10'),
(31, 1, 2, 7, 26, 3, 1, 3, 3, 1000, 1100, NULL, '2019-03-08 08:29:59', '2019-03-08 08:44:24'),
(32, 1, 2, 7, 26, 3, 2, 3, 2, 1530, 1630, NULL, '2019-03-08 08:29:59', '2019-03-08 08:43:32'),
(33, 1, 2, 7, 25, 14, 17, 3, 6, 1400, 1700, NULL, '2019-03-08 08:29:59', '2019-03-08 08:35:45'),
(34, 1, 2, 7, 24, 13, 16, 3, 6, 1000, 1300, NULL, '2019-03-08 08:29:59', '2019-03-08 08:35:12'),
(35, 1, 2, 7, 20, 1, 3, 3, 2, 1030, 1160, NULL, '2019-03-08 08:29:59', '2019-03-08 08:41:54'),
(36, 1, 2, 7, 20, 1, 1, 3, 1, 1500, 1630, NULL, '2019-03-08 08:29:59', '2019-03-08 08:39:39'),
(37, 1, 2, 7, 21, 2, 17, 3, 2, 1330, 1500, NULL, '2019-03-08 08:29:59', '2019-03-08 08:29:59'),
(38, 1, 2, 7, 21, 2, 16, 3, 5, 1400, 1530, NULL, '2019-03-08 08:29:59', '2019-03-08 08:37:46'),
(39, 1, 2, 7, 18, 9, 3, 3, 5, 1300, 1430, NULL, '2019-03-08 08:29:59', '2019-03-08 08:36:58'),
(40, 1, 2, 7, 18, 9, 3, 3, 3, 1230, 1360, NULL, '2019-03-08 08:29:59', '2019-03-08 08:43:13'),
(41, 1, 2, 7, 19, 12, 1, 3, 2, 1300, 1430, NULL, '2019-03-08 08:29:59', '2019-03-08 08:47:03'),
(42, 1, 2, 7, 19, 12, 4, 3, 1, 1030, 1160, NULL, '2019-03-08 08:29:59', '2019-03-08 08:46:23'),
(43, 1, 2, 5, 9, 4, 1, 1, 2, 1230, 1430, NULL, '2019-03-08 14:10:52', '2019-03-08 14:26:14'),
(44, 1, 2, 5, 8, 5, 1, 1, 2, 1000, 1170, NULL, '2019-03-08 14:10:52', '2019-03-08 14:25:27'),
(45, 1, 2, 5, 8, 5, 4, 1, 5, 1000, 1130, NULL, '2019-03-08 14:10:52', '2019-03-08 14:15:12'),
(46, 1, 2, 5, 7, 26, 5, 1, 4, 1030, 1230, NULL, '2019-03-08 14:10:52', '2019-03-08 14:19:21'),
(47, 1, 2, 5, 6, 24, 2, 1, 3, 1430, 1560, NULL, '2019-03-08 14:10:52', '2019-03-08 14:20:09'),
(48, 1, 2, 5, 6, 24, 3, 1, 5, 1430, 1560, NULL, '2019-03-08 14:10:52', '2019-03-08 14:18:12'),
(49, 1, 2, 5, 4, 23, 3, 1, 6, 1400, 1700, NULL, '2019-03-08 14:10:52', '2019-03-08 14:11:37'),
(50, 1, 2, 5, 3, 1, 2, 1, 2, 1600, 1730, NULL, '2019-03-08 14:10:52', '2019-03-08 14:26:52'),
(51, 1, 2, 5, 3, 1, 5, 1, 3, 1600, 1730, NULL, '2019-03-08 14:10:52', '2019-03-08 14:21:33'),
(52, 1, 2, 5, 5, 23, 3, 1, 6, 1700, 2000, NULL, '2019-03-08 14:10:52', '2019-03-08 14:14:09'),
(53, 1, 2, 5, 1, 25, 5, 1, 4, 1630, 1760, NULL, '2019-03-08 14:10:52', '2019-03-08 14:19:46'),
(54, 1, 2, 5, 1, 25, 3, 1, 5, 1300, 1430, NULL, '2019-03-08 14:10:52', '2019-03-08 14:15:55'),
(55, 1, 2, 5, 2, 1, 4, 1, 2, 1430, 1560, NULL, '2019-03-08 14:10:52', '2019-03-08 14:24:57'),
(56, 1, 2, 5, 2, 1, 4, 1, 4, 1430, 1560, NULL, '2019-03-08 14:10:52', '2019-03-08 14:18:50'),
(57, 1, 2, 5, 15, 22, 1, 3, 5, 800, 1100, NULL, '2019-03-08 14:37:15', '2019-03-08 14:37:45'),
(58, 1, 2, 5, 16, 22, 6, 3, 5, 1200, 1500, NULL, '2019-03-08 14:37:15', '2019-03-08 14:39:21'),
(59, 1, 2, 5, 17, 22, 6, 3, 5, 1530, 1830, NULL, '2019-03-08 14:37:15', '2019-03-08 14:39:58'),
(60, 1, 2, 5, 14, 21, 3, 3, 2, 1340, 1640, NULL, '2019-03-08 14:37:15', '2019-03-08 14:45:28'),
(61, 1, 2, 5, 13, 6, 2, 3, 4, 1530, 1630, NULL, '2019-03-08 14:37:15', '2019-03-08 14:41:58'),
(62, 1, 2, 5, 13, 6, 3, 3, 2, 930, 1030, NULL, '2019-03-08 14:37:15', '2019-03-08 14:45:01'),
(63, 1, 2, 5, 11, 1, 5, 3, 2, 1800, 1930, NULL, '2019-03-08 14:37:15', '2019-03-08 14:37:15'),
(64, 1, 2, 5, 11, 1, 3, 3, 1, 1500, 1630, NULL, '2019-03-08 14:37:15', '2019-03-08 14:44:01'),
(65, 1, 2, 5, 12, 10, 5, 3, 1, 1700, 1830, NULL, '2019-03-08 14:37:15', '2019-03-08 14:44:25'),
(66, 1, 2, 5, 12, 10, 2, 3, 4, 1700, 1830, NULL, '2019-03-08 14:37:15', '2019-03-08 14:42:52'),
(67, 1, 2, 5, 10, 1, 4, 3, 1, 1300, 1430, NULL, '2019-03-08 14:37:15', '2019-03-08 14:43:40'),
(68, 1, 2, 5, 10, 1, 4, 3, 4, 900, 1030, NULL, '2019-03-08 14:37:15', '2019-03-08 14:41:26'),
(69, 1, 2, 5, 43, 22, 2, 4, 6, 700, 1200, NULL, '2019-03-08 14:48:00', '2019-03-08 14:48:39');

-- --------------------------------------------------------

--
-- Table structure for table `teachers`
--

DROP TABLE IF EXISTS `teachers`;
CREATE TABLE IF NOT EXISTS `teachers` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `first_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contact_number` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=29 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `teachers`
--

INSERT INTO `teachers` (`id`, `first_name`, `last_name`, `address`, `contact_number`, `email`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'John', 'Orbista', '123,abc', '09876543211', 'test23@gmail.com', NULL, '2019-03-08 04:19:30', '2019-03-08 04:19:30'),
(2, 'MaryAnn', 'Cruz', '123,abc', '09876543211', 'test24@gmail.com', NULL, '2019-03-08 04:19:30', '2019-03-08 04:19:30'),
(3, 'Shareene', 'Labung', '123,abc', '09876543211', 'test25@gmail.com', NULL, '2019-03-08 04:19:30', '2019-03-08 04:19:30'),
(4, 'Gilbert', 'Fruel', '123,abc', '09876543211', 'test26@gmail.com', NULL, '2019-03-08 04:19:30', '2019-03-08 04:19:30'),
(5, 'Richard', 'Javier', '123,abc', '09876543211', 'test1@gmail.com', NULL, '2019-03-08 04:19:30', '2019-03-08 04:19:30'),
(6, 'Julito', 'Varquez', '123,abc', '09876543211', 'test2@gmail.com', NULL, '2019-03-08 04:19:30', '2019-03-08 04:19:30'),
(7, 'Erlinda', 'Mallari', '123,abc', '09876543211', 'test3@gmail.com', NULL, '2019-03-08 04:19:30', '2019-03-08 04:19:30'),
(8, 'Lita', 'Bueno', '123,abc', '09876543211', 'test4@gmail.com', NULL, '2019-03-08 04:19:30', '2019-03-08 04:19:30'),
(9, 'Ammie', 'Pineda', '123,abc', '09876543211', 'test5@gmail.com', NULL, '2019-03-08 04:19:30', '2019-03-08 04:19:30'),
(10, 'Lamberto', 'Bonifacio', '123,abc', '09876543211', 'test6@gmail.com', NULL, '2019-03-08 04:19:30', '2019-03-08 04:19:30'),
(11, 'Rosemarie', 'Dimaranan', '123,abc', '09876543211', 'test7@gmail.com', NULL, '2019-03-08 04:19:30', '2019-03-08 04:19:30'),
(12, 'Albert', 'Soriano', '123,abc', '09876543211', 'test8@gmail.com', NULL, '2019-03-08 04:19:30', '2019-03-08 04:19:30'),
(13, 'Jennifer', 'Aguilar', '123,abc', '09876543211', 'test9@gmail.com', NULL, '2019-03-08 04:19:30', '2019-03-08 04:19:30'),
(14, 'Loyd', 'Larazo', '123,abc', '09876543211', 'test10@gmail.com', NULL, '2019-03-08 04:19:30', '2019-03-08 04:19:30'),
(15, 'Christian', 'Gutierrez', '123,abc', '09876543211', 'test11@gmail.com', NULL, '2019-03-08 04:19:30', '2019-03-08 04:19:30'),
(16, 'JeanneMarie', 'Kaikhan', '123,abc', '09876543211', 'test12@gmail.com', NULL, '2019-03-08 04:19:30', '2019-03-08 04:19:30'),
(17, 'Edyssa', 'Belandres', '123,abc', '09876543211', 'test13@gmail.com', NULL, '2019-03-08 04:19:30', '2019-03-08 04:19:30'),
(18, 'Rey', 'AustriaJr.', '123,abc', '09876543211', 'test14@gmail.com', NULL, '2019-03-08 04:19:30', '2019-03-08 04:19:30'),
(19, 'Joel', 'Regino', '123,abc', '09876543211', 'test15@gmail.com', NULL, '2019-03-08 04:19:30', '2019-03-08 04:19:30'),
(20, 'VeraAisa', 'Marin', '123,abc', '09876543211', 'test16@gmail.com', NULL, '2019-03-08 04:19:30', '2019-03-08 04:19:30'),
(21, 'Leah', 'Campanilla', '123,abc', '09876543211', 'test17@gmail.com', NULL, '2019-03-08 04:19:30', '2019-03-08 04:19:30'),
(22, 'Raquel', 'Umbalin', '123,abc', '09876543211', 'test18@gmail.com', NULL, '2019-03-08 04:19:30', '2019-03-08 04:19:30'),
(23, 'George', 'deMesa', '123,abc', '09876543211', 'test19@gmail.com', NULL, '2019-03-08 04:19:30', '2019-03-08 04:19:30'),
(24, 'Marissa', 'Donida', '123,abc', '09876543211', 'test20@gmail.com', NULL, '2019-03-08 04:19:30', '2019-03-08 04:19:30'),
(25, 'Marben', 'Adora', '123,abc', '09876543211', 'test21@gmail.com', NULL, '2019-03-08 04:19:30', '2019-03-08 04:19:30'),
(26, 'Kesiah', 'Cruz', '123,abc', '09876543211', 'test22@gmail.com', NULL, '2019-03-08 04:19:30', '2019-03-08 04:19:30'),
(27, 'Eric', 'Yumul', '123,abc', '09876543211', 'test@gmail.com', NULL, '2019-03-08 04:51:38', '2019-03-08 04:51:38'),
(28, 'Carolinne', 'Laguinto', '123,abc', '09876543211', 'test@gmail.com', NULL, '2019-03-08 05:33:08', '2019-03-08 05:33:08');

-- --------------------------------------------------------

--
-- Table structure for table `teacher_courses`
--

DROP TABLE IF EXISTS `teacher_courses`;
CREATE TABLE IF NOT EXISTS `teacher_courses` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `teacher_id` bigint(20) UNSIGNED DEFAULT NULL,
  `course_id` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `teacher_courses_teacher_id_foreign` (`teacher_id`),
  KEY `teacher_courses_course_id_foreign` (`course_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `access_level` int(11) NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `access_level`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'john doe', 'angularjohn@gmail.com', 1, '$2y$10$tX5cfJG9eihlfRNV4L7u6OlYRIVtE5YwG85cZAiSn5xpKvkZl/o82', NULL, '2019-03-08 04:17:05', NULL),
(2, 'jane doe', 'jane@gmail.com', 2, '$2y$10$OpCfAWqos36uLx7rP7mKi.GwYqcqdEhoEFbwq.Mrh2y2z3APd2C0q', NULL, '2019-03-08 04:17:05', NULL),
(3, '2019-03-08 12:17:05', 'james@gmail.com', 3, '$2y$10$DxtfmvOorVxkiYLe8AsQZOuXMEXzmE/u1uTf5AIBE1KFKPVkRfhuO', NULL, NULL, NULL);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
