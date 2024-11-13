-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 13, 2024 at 08:45 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `apgcl_site`
--

-- --------------------------------------------------------

--
-- Table structure for table `board_of_directors`
--

CREATE TABLE `board_of_directors` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `designation` varchar(255) NOT NULL,
  `organisation` varchar(255) NOT NULL,
  `downloadLink` varchar(255) NOT NULL,
  `is_chairman` tinyint(1) NOT NULL,
  `is_md` tinyint(1) NOT NULL,
  `is_gov_rep` tinyint(1) NOT NULL,
  `is_indi_ditr` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `board_of_directors`
--

INSERT INTO `board_of_directors` (`id`, `name`, `designation`, `organisation`, `downloadLink`, `is_chairman`, `is_md`, `is_gov_rep`, `is_indi_ditr`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Shri. Rakesh Kumar, IAS', 'Chairman', 'Power (E). Department,Govt. of Assam<br>Assam Power Generation Corporation Limited', 'admin-assets/About Us/Board of Directors/1731479046_profile-1.jpg', 1, 0, 0, 0, '2024-11-13 07:40:37', '2024-11-13 07:40:37', NULL),
(2, 'Shri. Bibhu Bhuyan', 'Managing Director', 'Assam Power Generation Corporation Limited &nbsp;', 'admin-assets/About Us/Board of Directors/1731481362_Bibhu.jpg', 0, 1, 0, 0, '2024-11-13 07:40:21', '2024-11-13 07:40:21', NULL),
(3, 'Smti. Ira Devi', 'Director', 'Finance (Economic Affairs) Department, Govt. of Assam', 'admin-assets/About Us/Board of Directors/1731482236_img_avatar6.png', 0, 0, 1, 0, '2024-11-13 07:39:02', '2024-11-13 07:39:02', NULL),
(4, 'Ohed Uz Zaman, ACS', 'Joint Secretary, Govt. of Assam', 'Industries, Comm. & PE Department', 'admin-assets/About Us/Board of Directors/1731479046_profile-1.jpg', 0, 0, 1, 0, '2024-11-13 07:39:41', '2024-11-13 07:39:41', NULL),
(5, 'Smt. Madhuchanda Talukdar, ACS', 'Joint Secretary, Govt. of Assam', 'Power (Electricity) Department', 'admin-assets/About Us/Board of Directors/1731482236_img_avatar6.png', 0, 0, 1, 0, '2024-11-13 07:40:03', '2024-11-13 07:40:03', NULL),
(6, 'Dr. Devajit Mahanta', 'Independent Director', 'Assam Power Generation Corporation Limited', 'admin-assets/About Us/Board of Directors/1731482981_Debojit Mahanta-min.jpg', 0, 0, 0, 1, '2024-11-13 07:37:32', '2024-11-13 07:37:32', NULL),
(7, 'Shri. Anop Singh Purohit', 'Independent Director', 'Assam Power Generation Corporation Limited', 'admin-assets/About Us/Board of Directors/1731483082_Anop_Singh_Purohit.jpeg', 0, 0, 0, 1, '2024-11-13 07:38:13', '2024-11-13 07:38:13', NULL),
(8, 'Shri. Nitya Bhushan Dey', 'Independent Director', 'Assam Power Generation Corporation Limited', 'admin-assets/About Us/Board of Directors/1731483257_nitya.jpg', 0, 0, 0, 1, '2024-11-13 07:38:33', '2024-11-13 07:38:33', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `board_of_directors`
--
ALTER TABLE `board_of_directors`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `board_of_directors`
--
ALTER TABLE `board_of_directors`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
