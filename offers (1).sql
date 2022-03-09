-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Oct 26, 2021 at 04:48 PM
-- Server version: 8.0.21
-- PHP Version: 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `offers`
--

-- --------------------------------------------------------

--
-- Table structure for table `cities`
--

DROP TABLE IF EXISTS `cities`;
CREATE TABLE IF NOT EXISTS `cities` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `city_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `city_name_english` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lat` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lng` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `country_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `cities_country_id_foreign` (`country_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

DROP TABLE IF EXISTS `countries`;
CREATE TABLE IF NOT EXISTS `countries` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `country_code` int NOT NULL,
  `country_name_ar` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `country_name_en` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lat` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lng` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `flag` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alph2code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alph3code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `enterprises`
--

DROP TABLE IF EXISTS `enterprises`;
CREATE TABLE IF NOT EXISTS `enterprises` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name_ar` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name_en` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `uuid` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `commercial_registration_number` bigint NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` bigint NOT NULL,
  `count_of_brands` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `enterprise_cities`
--

DROP TABLE IF EXISTS `enterprise_cities`;
CREATE TABLE IF NOT EXISTS `enterprise_cities` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `enterprise_countries`
--

DROP TABLE IF EXISTS `enterprise_countries`;
CREATE TABLE IF NOT EXISTS `enterprise_countries` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `enterprise_id` bigint UNSIGNED DEFAULT NULL,
  `country_id` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `enterprise_countries_enterprise_id_foreign` (`enterprise_id`),
  KEY `enterprise_countries_country_id_foreign` (`country_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `enterprise_neighberhoods`
--

DROP TABLE IF EXISTS `enterprise_neighberhoods`;
CREATE TABLE IF NOT EXISTS `enterprise_neighberhoods` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `enterprise_id` bigint UNSIGNED DEFAULT NULL,
  `neighborhood_id` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `enterprise_neighberhoods_enterprise_id_foreign` (`enterprise_id`),
  KEY `enterprise_neighberhoods_neighborhood_id_foreign` (`neighborhood_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2019_08_19_000000_create_failed_jobs_table', 1),
(3, '2021_10_24_130848_create_enterprises_table', 1),
(4, '2021_10_24_130948_create_vendors_table', 1),
(5, '2021_10_24_133046_create_countries_table', 1),
(6, '2021_10_24_133303_create_cities_table', 1),
(7, '2021_10_24_133812_create_neighborhoods_table', 1),
(8, '2021_10_24_133999_create_enterprise_neighberhoods_table', 1),
(9, '2021_10_24_133999_create_vendor_cities_table', 1),
(10, '2021_10_24_133999_create_vendor_neighberhood_table', 1),
(11, '2021_10_24_141459_create_enterprise_cities_table', 1),
(12, '2021_10_24_141521_create_enterprise_countries_table', 1),
(13, '2021_10_24_141545_create_vendor_countries_table', 1),
(14, '2021_10_26_090231_laratrust_setup_tables', 1);

-- --------------------------------------------------------

--
-- Table structure for table `neighborhoods`
--

DROP TABLE IF EXISTS `neighborhoods`;
CREATE TABLE IF NOT EXISTS `neighborhoods` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `neighborhood_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `neighborhood_name_english` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lat` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lng` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `city_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `neighborhoods_city_id_foreign` (`city_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

DROP TABLE IF EXISTS `permissions`;
CREATE TABLE IF NOT EXISTS `permissions` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `permissions_name_unique` (`name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permission_role`
--

DROP TABLE IF EXISTS `permission_role`;
CREATE TABLE IF NOT EXISTS `permission_role` (
  `permission_id` int UNSIGNED NOT NULL,
  `role_id` int UNSIGNED NOT NULL,
  PRIMARY KEY (`permission_id`,`role_id`),
  KEY `permission_role_role_id_foreign` (`role_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permission_role`
--

INSERT INTO `permission_role` (`permission_id`, `role_id`) VALUES
(1, 1),
(2, 1),
(3, 1),
(5, 1),
(6, 1),
(7, 1),
(8, 1),
(9, 1),
(10, 1),
(11, 1),
(12, 1),
(13, 1),
(14, 1),
(15, 1),
(16, 1),
(17, 1),
(18, 1),
(19, 1),
(20, 1),
(21, 1),
(22, 1),
(23, 1),
(24, 1),
(25, 1),
(26, 1),
(27, 1),
(28, 1),
(29, 1),
(30, 1),
(31, 1),
(32, 1),
(33, 1),
(34, 1),
(36, 1),
(37, 1),
(38, 1),
(39, 1),
(40, 1),
(41, 1),
(42, 1),
(43, 1),
(44, 1),
(45, 1),
(46, 1),
(47, 1),
(60, 1),
(61, 1),
(62, 1),
(63, 1),
(64, 1),
(65, 1),
(66, 1),
(67, 1),
(68, 1),
(69, 1),
(70, 1),
(71, 1),
(72, 1),
(73, 1),
(74, 1),
(75, 1),
(76, 1),
(77, 1),
(78, 1),
(79, 1),
(80, 1),
(81, 1),
(82, 1),
(83, 1),
(84, 1),
(85, 1),
(86, 1),
(87, 1),
(88, 1),
(89, 1),
(29, 3),
(73, 3),
(74, 3),
(1, 5),
(2, 5),
(3, 5),
(5, 5),
(6, 5),
(7, 5),
(8, 5),
(9, 5),
(10, 5),
(11, 5),
(12, 5),
(13, 5),
(14, 5),
(17, 5),
(18, 5),
(19, 5),
(20, 5),
(21, 5),
(22, 5),
(23, 5),
(24, 5),
(25, 5),
(26, 5),
(27, 5),
(28, 5),
(29, 5),
(30, 5),
(31, 5),
(32, 5),
(33, 5),
(34, 5),
(36, 5),
(37, 5),
(38, 5),
(39, 5),
(40, 5),
(41, 5),
(42, 5),
(43, 5),
(44, 5),
(45, 5),
(46, 5),
(47, 5),
(60, 5),
(61, 5),
(62, 5),
(63, 5),
(64, 5),
(65, 5),
(66, 5),
(67, 5),
(68, 5),
(69, 5),
(70, 5),
(71, 5),
(72, 5),
(73, 5),
(74, 5),
(75, 5),
(76, 5),
(77, 5),
(78, 5),
(79, 5),
(80, 5),
(81, 5),
(82, 5),
(83, 5),
(84, 5),
(85, 5),
(86, 5),
(87, 5),
(88, 5),
(89, 5),
(1, 8),
(2, 8),
(3, 8),
(5, 8),
(6, 8),
(7, 8),
(8, 8),
(9, 8),
(10, 8),
(11, 8),
(12, 8),
(13, 8),
(14, 8),
(6, 14),
(7, 14),
(8, 14),
(9, 14),
(10, 14),
(11, 14),
(12, 14),
(13, 14),
(14, 14),
(15, 14),
(16, 14),
(17, 14),
(18, 14),
(19, 14),
(20, 14),
(21, 14),
(22, 14),
(23, 14),
(24, 14),
(25, 14),
(26, 14),
(27, 14),
(28, 14),
(29, 14),
(30, 14),
(36, 14),
(37, 14),
(38, 14),
(39, 14),
(40, 14),
(41, 14),
(42, 14),
(43, 14),
(44, 14),
(45, 14),
(46, 14),
(47, 14),
(60, 14),
(61, 14),
(1, 16),
(2, 16),
(5, 16),
(6, 16),
(7, 16),
(8, 16),
(9, 16),
(10, 16),
(11, 16),
(12, 16),
(13, 16),
(14, 16),
(21, 16),
(22, 16),
(23, 16),
(24, 16),
(25, 16),
(26, 16),
(27, 16),
(28, 16),
(29, 16),
(30, 16),
(31, 16),
(32, 16),
(33, 16),
(34, 16),
(36, 16),
(37, 16),
(38, 16),
(39, 16),
(40, 16),
(41, 16),
(42, 16),
(43, 16),
(44, 16),
(45, 16),
(46, 16),
(47, 16),
(60, 16),
(61, 16),
(62, 16),
(63, 16),
(64, 16),
(65, 16),
(66, 16),
(67, 16),
(68, 16),
(69, 16),
(70, 16),
(71, 16),
(72, 16),
(73, 16),
(74, 16),
(76, 16),
(77, 16),
(78, 16),
(79, 16),
(81, 16),
(82, 16),
(83, 16),
(84, 16),
(85, 16),
(86, 16),
(87, 16),
(88, 16),
(89, 16),
(13, 17),
(14, 17),
(1, 26),
(2, 26),
(3, 26),
(5, 26),
(9, 26),
(10, 26),
(12, 26),
(13, 26),
(14, 26),
(22, 26),
(23, 26),
(24, 26),
(25, 26),
(26, 26),
(27, 26),
(28, 26),
(29, 26),
(30, 26),
(31, 26),
(32, 26),
(36, 26),
(43, 26),
(62, 26),
(63, 26),
(64, 26),
(65, 26),
(66, 26),
(67, 26),
(68, 26),
(69, 26),
(70, 26),
(71, 26),
(24, 27),
(25, 27),
(26, 27),
(27, 27),
(13, 29),
(14, 29),
(5, 31),
(6, 31),
(7, 31),
(8, 31),
(9, 31),
(10, 31),
(11, 31),
(12, 31),
(13, 31),
(14, 31),
(21, 31),
(22, 31),
(23, 31),
(24, 31),
(25, 31),
(26, 31),
(27, 31),
(28, 31),
(29, 31),
(36, 31),
(37, 31),
(38, 31),
(39, 31),
(40, 31),
(41, 31),
(42, 31),
(43, 31),
(44, 31),
(45, 31),
(46, 31),
(47, 31),
(60, 31),
(61, 31),
(62, 31),
(63, 31),
(64, 31),
(65, 31),
(5, 32),
(6, 32),
(5, 34),
(6, 34),
(7, 34),
(8, 34),
(9, 34),
(10, 34),
(11, 34),
(12, 34),
(13, 34),
(14, 34),
(21, 34),
(22, 34),
(23, 34),
(24, 34),
(25, 34),
(26, 34),
(27, 34),
(28, 34),
(29, 34),
(36, 34),
(37, 34),
(38, 34),
(39, 34),
(40, 34),
(41, 34),
(42, 34),
(43, 34),
(44, 34),
(45, 34),
(46, 34),
(47, 34),
(60, 34),
(61, 34),
(62, 34),
(63, 34),
(64, 34),
(65, 34),
(66, 34),
(67, 34),
(68, 34),
(69, 34),
(70, 34),
(71, 34),
(72, 34),
(3, 36),
(5, 36),
(6, 36),
(7, 36),
(8, 36),
(9, 36),
(10, 36),
(11, 36),
(12, 36),
(13, 36),
(14, 36),
(17, 36),
(18, 36),
(19, 36),
(20, 36),
(21, 36),
(22, 36),
(23, 36),
(24, 36),
(25, 36),
(26, 36),
(27, 36),
(28, 36),
(29, 36),
(31, 36),
(33, 36),
(34, 36),
(36, 36),
(37, 36),
(38, 36),
(39, 36),
(40, 36),
(41, 36),
(42, 36),
(43, 36),
(44, 36),
(45, 36),
(46, 36),
(60, 36),
(61, 36),
(62, 36),
(63, 36),
(64, 36),
(65, 36),
(66, 36),
(67, 36),
(68, 36),
(69, 36),
(70, 36),
(71, 36),
(3, 37),
(5, 37),
(6, 37),
(7, 37),
(8, 37),
(9, 37),
(10, 37),
(11, 37),
(12, 37),
(13, 37),
(14, 37),
(19, 37),
(20, 37),
(21, 37),
(22, 37),
(23, 37),
(24, 37),
(25, 37),
(26, 37),
(27, 37),
(28, 37),
(29, 37),
(31, 37),
(36, 37),
(37, 37),
(38, 37),
(39, 37),
(40, 37),
(41, 37),
(42, 37),
(43, 37),
(44, 37),
(45, 37),
(46, 37),
(47, 37),
(60, 37),
(61, 37),
(62, 37),
(63, 37),
(64, 37),
(65, 37),
(66, 37),
(67, 37),
(68, 37),
(69, 37),
(70, 37),
(71, 37),
(72, 37),
(5, 38),
(6, 38),
(7, 38),
(8, 38),
(9, 38),
(10, 38),
(11, 38),
(12, 38),
(13, 38),
(14, 38),
(17, 38),
(18, 38),
(21, 38),
(22, 38),
(23, 38),
(24, 38),
(25, 38),
(26, 38),
(27, 38),
(28, 38),
(29, 38),
(36, 38),
(37, 38),
(38, 38),
(39, 38),
(40, 38),
(41, 38),
(42, 38),
(43, 38),
(44, 38),
(45, 38),
(46, 38),
(47, 38),
(60, 38),
(61, 38),
(62, 38),
(63, 38),
(64, 38),
(65, 38),
(73, 39),
(5, 40),
(6, 40),
(7, 40),
(8, 40),
(9, 40),
(10, 40),
(11, 40),
(12, 40),
(13, 40),
(14, 40),
(21, 40),
(22, 40),
(23, 40),
(24, 40),
(25, 40),
(26, 40),
(27, 40),
(28, 40),
(33, 40),
(34, 40),
(36, 40),
(37, 40),
(38, 40),
(39, 40),
(40, 40),
(41, 40),
(42, 40),
(43, 40),
(44, 40),
(45, 40),
(46, 40),
(47, 40),
(60, 40),
(61, 40),
(62, 40),
(63, 40),
(64, 40),
(65, 40),
(66, 40),
(67, 40),
(68, 40),
(69, 40),
(70, 40),
(71, 40),
(72, 40),
(5, 41),
(6, 41),
(7, 41),
(8, 41),
(9, 41),
(10, 41),
(11, 41),
(12, 41),
(13, 41),
(14, 41),
(15, 41),
(16, 41),
(21, 41),
(22, 41),
(23, 41),
(24, 41),
(25, 41),
(26, 41),
(27, 41),
(28, 41),
(29, 41),
(36, 41),
(37, 41),
(38, 41),
(39, 41),
(40, 41),
(41, 41),
(42, 41),
(43, 41),
(44, 41),
(45, 41),
(46, 41),
(47, 41),
(60, 41),
(61, 41),
(62, 41),
(63, 41),
(64, 41),
(65, 41),
(66, 41),
(67, 41),
(68, 41),
(69, 41),
(70, 41),
(71, 41),
(72, 41),
(73, 43),
(73, 45),
(74, 46),
(75, 46),
(29, 48),
(1, 49),
(2, 49),
(3, 49),
(5, 49),
(6, 49),
(7, 49),
(8, 49),
(9, 49),
(10, 49),
(11, 49),
(12, 49),
(13, 49),
(14, 49),
(22, 49),
(23, 49),
(24, 49),
(25, 49),
(26, 49),
(27, 49),
(28, 49),
(29, 49),
(30, 49),
(31, 49),
(32, 49),
(33, 49),
(34, 49),
(36, 49),
(24, 51),
(25, 51),
(26, 51),
(27, 51),
(24, 52),
(25, 52),
(26, 52),
(27, 52);

-- --------------------------------------------------------

--
-- Table structure for table `permission_user`
--

DROP TABLE IF EXISTS `permission_user`;
CREATE TABLE IF NOT EXISTS `permission_user` (
  `permission_id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `user_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`user_id`,`permission_id`,`user_type`),
  KEY `permission_user_permission_id_foreign` (`permission_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
CREATE TABLE IF NOT EXISTS `roles` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=54 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `display_name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'super ADMIN', 'super ADMIN', NULL, '2021-01-06 15:31:39');

-- --------------------------------------------------------

--
-- Table structure for table `role_user`
--

DROP TABLE IF EXISTS `role_user`;
CREATE TABLE IF NOT EXISTS `role_user` (
  `id` int NOT NULL AUTO_INCREMENT,
  `role_id` int UNSIGNED NOT NULL,
  `user_id` int UNSIGNED NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `user_id` (`role_id`,`user_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=278 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_user`
--

INSERT INTO `role_user` (`id`, `role_id`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 1, 91, '2021-01-09 18:01:15', '2021-01-09 18:01:26'),
(3, 5, 181, '2021-01-09 18:01:15', '2021-01-09 18:01:26'),
(4, 16, 198, '2021-01-09 18:01:15', '2021-01-09 18:01:26'),
(5, 2, 199, '2021-01-09 18:01:15', '2021-01-09 18:01:26'),
(6, 2, 207, '2021-01-09 18:01:15', '2021-01-09 18:01:26'),
(8, 2, 216, '2021-01-09 18:01:15', '2021-01-09 18:01:26'),
(9, 3, 220, '2021-01-09 18:01:15', '2021-01-09 18:01:26'),
(10, 5, 222, '2021-01-09 18:01:15', '2021-01-09 18:01:26'),
(11, 5, 223, '2021-01-09 18:01:15', '2021-01-09 18:01:26'),
(12, 5, 224, '2021-01-09 18:01:15', '2021-01-09 18:01:26'),
(13, 5, 225, '2021-01-09 18:01:15', '2021-01-09 18:01:26'),
(14, 5, 226, '2021-01-09 18:01:15', '2021-01-09 18:01:26'),
(15, 5, 227, '2021-01-09 18:01:15', '2021-01-09 18:01:26'),
(16, 2, 228, '2021-01-09 18:01:15', '2021-01-09 18:01:26'),
(17, 5, 229, '2021-01-09 18:01:15', '2021-01-09 18:01:26'),
(18, 5, 230, '2021-01-09 18:01:15', '2021-01-09 18:01:26'),
(19, 2, 231, '2021-01-09 18:01:15', '2021-01-09 18:01:26'),
(20, 5, 232, '2021-01-09 18:01:15', '2021-01-09 18:01:26'),
(21, 2, 233, '2021-01-09 18:01:15', '2021-01-09 18:01:26'),
(22, 2, 234, '2021-01-09 18:01:15', '2021-01-09 18:01:26'),
(23, 2, 235, '2021-01-09 18:01:15', '2021-01-09 18:01:26'),
(24, 5, 236, '2021-01-09 18:01:15', '2021-01-09 18:01:26'),
(25, 2, 237, '2021-01-09 18:01:15', '2021-01-09 18:01:26'),
(26, 5, 238, '2021-01-09 18:01:15', '2021-01-09 18:01:26'),
(27, 5, 239, '2021-01-09 18:01:15', '2021-01-09 18:01:26'),
(28, 5, 240, '2021-01-09 18:01:15', '2021-01-09 18:01:26'),
(29, 2, 241, '2021-01-09 18:01:15', '2021-01-09 18:01:26'),
(30, 2, 242, '2021-01-09 18:01:15', '2021-01-09 18:01:26'),
(31, 2, 243, '2021-01-09 18:01:15', '2021-01-09 18:01:26'),
(32, 2, 244, '2021-01-09 18:01:15', '2021-01-09 18:01:26'),
(33, 2, 245, '2021-01-09 18:01:15', '2021-01-09 18:01:26'),
(35, 2, 247, '2021-01-09 18:01:15', '2021-01-09 18:01:26'),
(36, 2, 248, '2021-01-09 18:01:15', '2021-01-09 18:01:26'),
(37, 2, 249, '2021-01-09 18:01:15', '2021-01-09 18:01:26'),
(38, 2, 250, '2021-01-09 18:01:15', '2021-01-09 18:01:26'),
(39, 5, 251, '2021-01-09 18:01:15', '2021-01-09 18:01:26'),
(40, 5, 252, '2021-01-09 18:01:15', '2021-01-09 18:01:26'),
(41, 5, 253, '2021-01-09 18:01:15', '2021-01-09 18:01:26'),
(42, 5, 254, '2021-01-09 18:01:15', '2021-01-09 18:01:26'),
(43, 5, 255, '2021-01-09 18:01:15', '2021-01-09 18:01:26'),
(44, 5, 256, '2021-01-09 18:01:15', '2021-01-09 18:01:26'),
(45, 5, 258, '2021-01-09 18:01:15', '2021-01-09 18:01:26'),
(46, 2, 259, '2021-01-09 18:01:15', '2021-01-09 18:01:26'),
(47, 2, 260, '2021-01-09 18:01:15', '2021-01-09 18:01:26'),
(48, 5, 263, '2021-01-09 18:01:15', '2021-01-09 18:01:26'),
(49, 5, 264, '2021-01-09 18:01:15', '2021-01-09 18:01:26'),
(50, 3, 266, '2021-01-09 18:01:15', '2021-01-09 18:01:26'),
(51, 3, 267, '2021-01-09 18:01:15', '2021-01-09 18:01:26'),
(52, 3, 268, '2021-01-09 18:01:15', '2021-01-09 18:01:26'),
(54, 2, 270, '2021-01-09 18:01:15', '2021-01-09 18:01:26'),
(55, 5, 298, '2021-01-09 18:01:15', '2021-01-09 18:01:26'),
(56, 2, 299, '2021-01-09 18:01:15', '2021-01-09 18:01:26'),
(57, 2, 300, '2021-01-09 18:01:15', '2021-01-09 18:01:26'),
(58, 3, 301, '2021-01-09 18:01:15', '2021-01-09 18:01:26'),
(59, 3, 302, '2021-01-09 18:01:15', '2021-01-09 18:01:26'),
(60, 2, 303, '2021-01-09 18:01:15', '2021-01-09 18:01:26'),
(61, 16, 304, '2021-01-09 18:01:15', '2021-01-09 18:01:26'),
(63, 5, 306, '2021-01-09 18:01:15', '2021-01-09 18:01:26'),
(64, 5, 307, '2021-01-09 18:01:15', '2021-01-09 18:01:26'),
(65, 5, 308, '2021-01-09 18:01:15', '2021-01-09 18:01:26'),
(66, 1, 1000, '2021-01-09 18:01:15', '2021-01-09 18:01:26'),
(67, 2, 1001, '2021-01-09 18:01:15', '2021-01-09 18:01:26'),
(68, 2, 1002, '2021-01-09 18:01:15', '2021-01-09 18:01:26'),
(69, 2, 1003, '2021-01-09 18:01:15', '2021-01-09 18:01:26'),
(70, 2, 1004, '2021-01-09 18:01:15', '2021-01-09 18:01:26'),
(71, 2, 1005, '2021-01-09 18:01:15', '2021-01-09 18:01:26'),
(72, 5, 1006, '2021-01-09 18:01:15', '2021-01-09 18:01:26'),
(73, 2, 1007, '2021-01-09 18:01:15', '2021-01-09 18:01:26'),
(74, 3, 1008, '2021-01-09 18:01:15', '2021-01-09 18:01:26'),
(75, 2, 1009, '2021-01-09 18:01:15', '2021-01-09 18:01:26'),
(80, 22, 181, '2021-01-09 19:50:16', '2021-01-09 19:50:16'),
(84, 26, 307, '2021-01-10 17:04:32', '2021-01-10 17:04:32'),
(85, 3, 309, '2021-01-11 10:44:43', '2021-01-11 10:44:43'),
(90, 3, 312, '2021-01-12 15:32:59', '2021-01-12 15:32:59'),
(97, 26, 180, '2021-01-16 13:52:25', '2021-01-16 13:52:25'),
(102, 16, 305, '2021-01-20 11:41:15', '2021-01-20 11:41:15'),
(103, 27, 313, '2021-01-20 18:39:21', '2021-01-20 18:39:21'),
(104, 27, 314, '2021-01-20 18:55:02', '2021-01-20 18:55:02'),
(105, 1, 315, '2021-02-11 13:11:03', '2021-02-11 13:11:03'),
(110, 16, 319, '2021-02-15 11:18:37', '2021-02-15 11:18:37'),
(111, 16, 318, '2021-02-15 11:18:59', '2021-02-15 11:18:59'),
(112, 16, 317, '2021-02-15 11:19:18', '2021-02-15 11:19:18'),
(114, 16, 316, '2021-02-15 12:41:41', '2021-02-15 12:41:41'),
(116, 16, 320, '2021-02-16 09:39:06', '2021-02-16 09:39:06'),
(118, 16, 321, '2021-02-16 09:42:47', '2021-02-16 09:42:47'),
(119, 3, 322, '2021-02-17 11:05:57', '2021-02-17 11:05:57'),
(121, 5, 324, '2021-03-06 19:31:36', '2021-03-06 19:31:36'),
(125, 2, 326, '2021-03-09 09:19:13', '2021-03-09 09:19:13'),
(126, 2, 327, '2021-03-09 09:22:16', '2021-03-09 09:22:16'),
(130, 2, 330, '2021-03-10 09:14:36', '2021-03-10 09:14:36'),
(131, 2, 331, '2021-03-10 09:19:10', '2021-03-10 09:19:10'),
(133, 26, 177, '2021-03-10 09:52:00', '2021-03-10 09:52:00'),
(141, 32, 310, '2021-03-11 10:38:33', '2021-03-11 10:38:33'),
(142, 2, 334, '2021-03-11 13:44:26', '2021-03-11 13:44:26'),
(145, 2, 336, '2021-03-11 14:43:29', '2021-03-11 14:43:29'),
(148, 16, 338, '2021-03-14 12:52:47', '2021-03-14 12:52:47'),
(150, 3, 339, '2021-03-29 10:16:58', '2021-03-29 10:16:58'),
(151, 3, 340, '2021-03-29 10:37:58', '2021-03-29 10:37:58'),
(152, 2, 341, '2021-03-29 10:41:05', '2021-03-29 10:41:05'),
(153, 3, 342, '2021-03-29 15:46:15', '2021-03-29 15:46:15'),
(154, 16, 323, '2021-03-31 15:59:59', '2021-03-31 15:59:59'),
(159, 34, 328, '2021-04-01 20:24:28', '2021-04-01 20:24:28'),
(160, 34, 329, '2021-04-01 20:32:32', '2021-04-01 20:32:32'),
(167, 3, 343, '2021-04-05 13:40:02', '2021-04-05 13:40:02'),
(168, 3, 344, '2021-04-08 08:13:02', '2021-04-08 08:13:02'),
(169, 3, 345, '2021-04-08 08:17:29', '2021-04-08 08:17:29'),
(172, 3, 347, '2021-04-14 19:36:46', '2021-04-14 19:36:46'),
(173, 3, 348, '2021-04-14 19:41:38', '2021-04-14 19:41:38'),
(174, 3, 349, '2021-04-15 13:17:20', '2021-04-15 13:17:20'),
(177, 40, 337, '2021-04-21 14:48:58', '2021-04-21 14:48:58'),
(179, 41, 350, '2021-04-24 23:11:58', '2021-04-24 23:11:58'),
(181, 1, 352, '2021-05-25 14:09:14', '2021-05-25 14:09:14'),
(183, 3, 246, '2021-05-31 13:22:58', '2021-05-31 13:22:58'),
(184, 3, 269, '2021-06-02 12:50:57', '2021-06-02 12:50:57'),
(188, 16, 311, '2021-06-02 15:06:03', '2021-06-02 15:06:03'),
(191, 3, 354, '2021-06-06 16:20:00', '2021-06-06 16:20:00'),
(194, 3, 355, '2021-06-06 19:05:36', '2021-06-06 19:05:36'),
(195, 16, 335, '2021-06-07 02:44:16', '2021-06-07 02:44:16'),
(198, 16, 356, '2021-06-14 01:02:06', '2021-06-14 01:02:06'),
(206, 45, 357, '2021-06-17 17:49:29', '2021-06-17 17:49:29'),
(208, 5, 214, '2021-06-20 16:08:32', '2021-06-20 16:08:32'),
(209, 16, 353, '2021-06-22 12:17:37', '2021-06-22 12:17:37'),
(210, 46, 363, '2021-06-22 14:11:44', '2021-06-22 14:11:44'),
(211, 46, 364, '2021-06-22 14:17:15', '2021-06-22 14:17:15'),
(212, 46, 365, '2021-06-22 14:46:54', '2021-06-22 14:46:54'),
(213, 45, 366, '2021-06-22 14:49:17', '2021-06-22 14:49:17'),
(214, 42, 367, '2021-06-22 14:50:59', '2021-06-22 14:50:59'),
(216, 48, 351, '2021-07-14 19:20:34', '2021-07-14 19:20:34'),
(217, 26, 217, '2021-08-05 12:23:08', '2021-08-05 12:23:08'),
(220, 16, 368, '2021-08-11 19:12:46', '2021-08-11 19:12:46'),
(222, 3, 370, '2021-08-12 14:22:16', '2021-08-12 14:22:16'),
(223, 3, 371, '2021-08-12 14:33:47', '2021-08-12 14:33:47'),
(224, 3, 372, '2021-08-12 15:09:22', '2021-08-12 15:09:22'),
(225, 3, 373, '2021-08-12 15:14:32', '2021-08-12 15:14:32'),
(226, 46, 374, '2021-09-04 14:21:04', '2021-09-04 14:21:04'),
(227, 45, 375, '2021-09-06 15:01:39', '2021-09-06 15:01:39'),
(228, 2, 376, '2021-09-13 10:02:39', '2021-09-13 10:02:39'),
(229, 49, 214, '2021-09-13 10:45:56', '2021-09-13 10:45:56'),
(230, 48, 197, '2021-09-13 14:17:56', '2021-09-13 14:17:56'),
(231, 48, 369, '2021-09-13 14:19:57', '2021-09-13 14:19:57'),
(235, 51, 377, '2021-09-15 12:38:56', '2021-09-15 12:38:56'),
(236, 16, 346, '2021-09-18 14:29:50', '2021-09-18 14:29:50'),
(237, 2, 378, '2021-09-18 19:30:38', '2021-09-18 19:30:38'),
(238, 2, 379, '2021-09-18 19:35:19', '2021-09-18 19:35:19'),
(239, 2, 380, '2021-09-19 12:12:31', '2021-09-19 12:12:31'),
(240, 2, 381, '2021-09-19 13:04:14', '2021-09-19 13:04:14'),
(241, 2, 382, '2021-09-19 13:09:48', '2021-09-19 13:09:48'),
(242, 5, 383, '2021-09-19 14:27:40', '2021-09-19 14:27:40'),
(243, 2, 384, '2021-09-19 17:24:15', '2021-09-19 17:24:15'),
(244, 5, 325, '2021-09-22 15:41:53', '2021-09-22 15:41:53'),
(246, 16, 385, '2021-09-22 19:46:56', '2021-09-22 19:46:56'),
(247, 3, 386, '2021-09-23 13:15:32', '2021-09-23 13:15:32'),
(248, 5, 387, '2021-09-26 17:18:46', '2021-09-26 17:18:46'),
(249, 5, 388, '2021-09-26 17:18:58', '2021-09-26 17:18:58'),
(250, 2, 389, '2021-09-26 17:25:54', '2021-09-26 17:25:54'),
(252, 5, 390, '2021-09-26 17:35:28', '2021-09-26 17:35:28'),
(256, 52, 392, '2021-09-26 18:19:59', '2021-09-26 18:19:59'),
(257, 5, 393, '2021-09-29 17:12:33', '2021-09-29 17:12:33'),
(258, 5, 394, '2021-09-30 16:35:15', '2021-09-30 16:35:15'),
(259, 3, 395, '2021-10-06 12:52:51', '2021-10-06 12:52:51'),
(260, 3, 396, '2021-10-12 13:37:35', '2021-10-12 13:37:35'),
(263, 16, 391, '2021-10-12 20:26:38', '2021-10-12 20:26:38'),
(264, 2, 397, '2021-10-18 17:15:29', '2021-10-18 17:15:29'),
(265, 3, 398, '2021-10-18 17:32:42', '2021-10-18 17:32:42'),
(267, 16, 399, '2021-10-24 10:17:06', '2021-10-24 10:17:06'),
(268, 3, 400, '2021-10-25 13:03:01', '2021-10-25 13:03:01'),
(269, 3, 401, '2021-10-25 17:38:23', '2021-10-25 17:38:23'),
(270, 46, 402, '2021-10-25 17:41:40', '2021-10-25 17:41:40'),
(271, 45, 403, '2021-10-26 09:41:07', '2021-10-26 09:41:07'),
(272, 45, 404, '2021-10-26 09:42:25', '2021-10-26 09:42:25'),
(274, 16, 405, '2021-10-26 11:34:14', '2021-10-26 11:34:14'),
(275, 45, 406, '2021-10-26 11:41:08', '2021-10-26 11:41:08'),
(277, 16, 407, '2021-10-26 12:57:00', '2021-10-26 12:57:00');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(50) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `password` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `email` varchar(100) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `last_ip` varchar(40) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `last_login` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `name` varchar(200) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `resturant_id` int DEFAULT NULL,
  `branch_id` int DEFAULT NULL,
  `is_branch` enum('no','yes') CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `address` varchar(200) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `ent_id` int DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `fcm_token` text CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=407 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `last_ip`, `last_login`, `created`, `name`, `resturant_id`, `branch_id`, `is_branch`, `address`, `ent_id`, `created_at`, `updated_at`, `fcm_token`) VALUES
(91, 'admin', '$2y$10$8vxSN94jAdN.eGG6fCQoceKJFI67I1sDXLocaGTI3DBqnG0rstjRa', 'ghandour@yalago.net', '37.106.207.196', '2017-09-23 16:16:55', '2017-09-23 16:16:55', NULL, 18, NULL, 'no', NULL, NULL, '2020-12-08 11:03:03', '2021-06-22 10:59:54', 'dUm5fUc_B-4:APA91bEd4hBvFbrF63f-MfJiN3omcPSYgXZx8bC0qnAsesT9JN8J29YCmXXmsOHk_SiUdclrHeDXm5KTJNgS-OzW_zGWcoE4MtaR_VE8zbEeHqP52l_vHKFN_Q5-kNfSxs_iWBOjXUR-'),
(331, 'Ghandour', '$2y$10$yG/67n2QGFnhTURM3b.JPec1F7hsDfM2QB5Phab/mRlFpAwtmvZwq', 'ghandour@yalago.net', '193.35.20.85', '2021-03-10 09:19:10', '2021-03-10 09:19:10', 'Ghandour', NULL, NULL, NULL, 'Riyadh', 2, '2021-03-10 09:19:10', '2021-03-10 09:19:10', '');

-- --------------------------------------------------------

--
-- Table structure for table `vendors`
--

DROP TABLE IF EXISTS `vendors`;
CREATE TABLE IF NOT EXISTS `vendors` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name_ar` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name_en` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `desc_en` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `desc_ar` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `uuid` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `commercial_registration_number` bigint NOT NULL,
  `telephoone` bigint NOT NULL,
  `mobile` bigint NOT NULL,
  `address` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('active','deactive') COLLATE utf8mb4_unicode_ci NOT NULL,
  `vat_type` enum('value','percentage') COLLATE utf8mb4_unicode_ci NOT NULL,
  `vat` int NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cover_image` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `enterprise_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `vendors_enterprise_id_foreign` (`enterprise_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `vendor_cities`
--

DROP TABLE IF EXISTS `vendor_cities`;
CREATE TABLE IF NOT EXISTS `vendor_cities` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `vendor_id` bigint UNSIGNED DEFAULT NULL,
  `city_id` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `vendor_cities_vendor_id_foreign` (`vendor_id`),
  KEY `vendor_cities_city_id_foreign` (`city_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `vendor_countries`
--

DROP TABLE IF EXISTS `vendor_countries`;
CREATE TABLE IF NOT EXISTS `vendor_countries` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `vendor_id` bigint UNSIGNED DEFAULT NULL,
  `country_id` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `vendor_countries_vendor_id_foreign` (`vendor_id`),
  KEY `vendor_countries_country_id_foreign` (`country_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `vendor_neighberhood`
--

DROP TABLE IF EXISTS `vendor_neighberhood`;
CREATE TABLE IF NOT EXISTS `vendor_neighberhood` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `vendor_id` bigint UNSIGNED DEFAULT NULL,
  `neighborhood_id` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `vendor_neighberhood_vendor_id_foreign` (`vendor_id`),
  KEY `vendor_neighberhood_neighborhood_id_foreign` (`neighborhood_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
