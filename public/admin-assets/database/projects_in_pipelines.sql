-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 13, 2024 at 11:02 AM
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
-- Table structure for table `projects_in_pipelines`
--

CREATE TABLE `projects_in_pipelines` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `capacity` double NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `projects_in_pipelines`
--

INSERT INTO `projects_in_pipelines` (`id`, `name`, `capacity`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Kulsi Hydro Project', 55, '2024-11-13 09:53:55', '2024-11-13 09:53:55', NULL),
(2, 'Golaghat Ground Mounted & Floating Solar PV Project', 40, '2024-11-13 09:55:23', '2024-11-13 09:55:23', NULL),
(3, 'Majuli Solar Power Project', 20, '2024-11-13 09:55:59', '2024-11-13 09:55:59', NULL),
(4, 'Karbi Langpi Middle-I Hydro Power Project', 22.5, '2024-11-13 10:00:02', '2024-11-13 10:00:02', NULL),
(5, 'Sonbeel Floating Solar Power Project', 70, '2024-11-13 10:00:32', '2024-11-13 10:00:32', NULL),
(6, 'Namrup Solar PV Project', 100, '2024-11-13 10:00:50', '2024-11-13 10:00:50', NULL),
(7, 'Namrup Replacement Power Project, Phase- II', 100, '2024-11-13 10:01:08', '2024-11-13 10:01:08', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `projects_in_pipelines`
--
ALTER TABLE `projects_in_pipelines`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `projects_in_pipelines`
--
ALTER TABLE `projects_in_pipelines`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
