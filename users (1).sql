-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Oct 26, 2021 at 12:37 PM
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
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
