-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 08, 2024 at 08:13 AM
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
-- Table structure for table `contacts`
--

CREATE TABLE `contacts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `designation` varchar(255) NOT NULL,
  `priority` int(11) NOT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `is_office_bearer` tinyint(1) NOT NULL,
  `office_category` varchar(255) DEFAULT NULL,
  `office_name` varchar(255) DEFAULT NULL,
  `office_address` varchar(255) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `contacts`
--

INSERT INTO `contacts` (`id`, `name`, `designation`, `priority`, `phone`, `email`, `is_office_bearer`, `office_category`, `office_name`, `office_address`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'Rakesh Kumar, IAS', 'Chairman, APGCL', 1, NULL, 'rakesh.kumar@apgcl.org', 1, 'chairman_and_md', 'Office of The Chairman', 'Assam Power Generation Corporation Ltd.\r\n3rd Floor, Bijulee Bhawan, Guwahati-1', NULL, '2024-11-08 06:04:15', '2024-11-08 06:04:15'),
(2, 'Bibhu Bhuyan', 'Managing Director, APGCL', 2, NULL, 'bibhu.bhuyan@apgcl.org', 1, 'chairman_and_md', 'Office of The Managing Director', 'Assam Power Generation Corporation Ltd.\r\n3rd Floor, Bijulee Bhawan, Guwahati-1', NULL, '2024-11-08 06:06:00', '2024-11-08 06:06:00'),
(3, 'MD Zakir', 'Chief General Manager, Generation', 3, NULL, 'md.zakir@apgcl.org', 1, 'other_offices_in_hq', 'Office of The Chief General Manager(Generation)', 'Assam Power Generation Corporation Ltd.\r\n3rd Floor, Bijulee Bhawan, Guwahati-1', NULL, '2024-11-08 06:07:14', '2024-11-08 06:07:14'),
(4, 'Saurav Saikia', 'Chief General Manager, Hydro & Civil', 4, NULL, 'saurav.saikia@apgcl.org', 1, 'other_offices_in_hq', 'Office of The Chief General Manager(Hydro & Civil)', 'Assam Power Generation Corporation Ltd.\r\n3rd Floor, Bijulee Bhawan, Guwahati-1', NULL, '2024-11-08 06:09:15', '2024-11-08 06:09:15'),
(5, 'Akshay Talukdar', 'Chief General Manager (Project, Planning & Implementation)', 5, NULL, 'akshay.talukdar@apgcl.org', 1, 'other_offices_in_hq', 'Office of The Chief General Manager(PP&I)', 'Assam Power Generation Corporation Ltd.\r\n3rd Floor, Bijulee Bhawan, Guwahati-1', NULL, '2024-11-08 06:10:37', '2024-11-08 06:10:37'),
(6, 'Prasanna Gogoi', 'Chief General Manager (NRE)', 6, NULL, 'prasanna.gogoi@apgcl.org', 1, 'other_offices_in_hq', 'Office of The Chief General Manager(NRE)', 'Assam Power Generation Corporation Ltd.\r\n3rd Floor, Bijulee Bhawan, Guwahati-1', NULL, '2024-11-08 06:12:02', '2024-11-08 06:12:02'),
(7, 'Suresh Kaimal', 'Chief General Manager (F&A)', 7, NULL, 'suresh.kaimal@apgcl.org', 1, 'other_offices_in_hq', 'Office of The Chief General Manager(F&A)', 'Assam Power Generation Corporation Ltd.\r\n3rd Floor, Bijulee Bhawan, Guwahati-1', NULL, '2024-11-08 06:13:51', '2024-11-08 06:13:51'),
(8, 'MD Zakir', 'General Manager (Human Resource) I/C', 8, NULL, 'md.zakir@apgcl.org', 0, NULL, NULL, NULL, NULL, '2024-11-08 06:16:03', '2024-11-08 06:16:03'),
(9, 'Suresh Kaimal', 'General Manager, F&A i/c', 9, NULL, 'suresh.kaimal@apgcl.org', 0, NULL, NULL, NULL, NULL, '2024-11-08 06:17:20', '2024-11-08 06:17:20'),
(10, 'Khonsing Teron', 'General Manager (Project Planning & Implementation)', 10, NULL, 'khonsing.teron@apgcl.org', 0, NULL, NULL, NULL, NULL, '2024-11-08 06:18:07', '2024-11-08 06:18:07'),
(11, 'Abhijit Saha', 'General Manager (Head Quarter) I/c', 11, NULL, 'abhijit.saha@apgcl.org', 0, NULL, NULL, NULL, NULL, '2024-11-08 06:18:45', '2024-11-08 06:18:45'),
(12, 'Jadupran Borgohain', 'General Manager, Namrup Thermal Power Station', 12, NULL, 'jadupran.borgohain@apgcl.org', 1, 'project_offices', 'Office of The General Manager', 'Namrup Thermal Power Station\r\nNamrup, Dibrugarh', NULL, '2024-11-08 06:20:10', '2024-11-08 06:20:10'),
(13, 'Janardan Das', 'General Manager, Lakwa Thermal Power Station', 13, NULL, 'janardan.das@apgcl.org', 1, 'project_offices', 'Office of The General Manager', 'Lakwa Thermal Power Station\r\nMaibella, Charaideo', NULL, '2024-11-08 06:27:32', '2024-11-08 06:27:32'),
(14, 'Long Sing Bey', 'General Manager, Karbi Langpi Hydro-Electric Project', 14, NULL, 'longsing.bey@apgcl.org', 1, 'project_offices', 'Office of The General Manager', 'Karbi Langpi Hydro Electric Project\r\nLengery, Karbi Anglong', NULL, '2024-11-08 06:28:43', '2024-11-08 06:28:43'),
(15, 'Jonardan Rongpi', 'Project Manager, Lower Kopili Hydro-Electric Project', 15, NULL, 'jonardan.rongpi@apgcl.org', 1, 'project_offices', 'Office of The Project Manager', 'Lower Kopili Hydro Electric Project, APGCL\r\nLongku, Dima Hasao', NULL, '2024-11-08 06:30:21', '2024-11-08 06:48:33'),
(16, 'Bitupan Khaklari', 'Project Manager, Myntriang Small Hydro Electric Project', 16, NULL, 'bitupan.khaklari@apgcl.org', 1, 'project_offices', 'Office of The Project Manager', 'Myntriang Small Hydro Electric Project\r\nLengery, Karbi Anglong', NULL, '2024-11-08 06:45:58', '2024-11-08 06:48:33'),
(17, 'Nayana Das', 'Company Secretary, APGCL', 18, NULL, 'nayana.das@apgcl.org', 0, NULL, NULL, NULL, NULL, '2024-11-08 06:49:47', '2024-11-08 06:56:36'),
(18, 'Hitendra Gayari', 'Officer on Special Duty to Chairman, APGCL', 19, NULL, 'hitendra.gayari@apgcl.org', 0, NULL, NULL, NULL, NULL, '2024-11-08 06:51:33', '2024-11-08 06:56:36'),
(19, 'Nabajit Phukan', 'Officer on Special Duty to Managing Director, APGCL', 20, NULL, 'nabajit.phukan@apgcl.org', 0, NULL, NULL, NULL, NULL, '2024-11-08 06:52:30', '2024-11-08 06:56:36'),
(20, 'Montu Deori', 'P.S. to Chairman, APGCL', 24, NULL, 'mantu.deori@apgcl.org', 0, NULL, NULL, NULL, NULL, '2024-11-08 06:53:21', '2024-11-08 07:12:56'),
(21, 'Lakheswar Khaklari', 'Chief Security Officer', 25, NULL, NULL, 0, NULL, NULL, NULL, NULL, '2024-11-08 06:53:57', '2024-11-08 07:12:56'),
(22, 'Amarendra Singha', 'General Manager, Design(Civil)', 17, NULL, 'amarendra.singha@apgcl.org', 1, 'other_offices', 'Office of The General Manager', 'Design(Civil), APGCL\r\nNarengi, Guwahati-781026', NULL, '2024-11-08 06:56:36', '2024-11-08 06:56:36'),
(23, 'Jayanta Kumar Das', 'Deputy General Manager, Investigation Circle', 21, NULL, 'jayantakumar.das@apgcl.org', 1, 'other_offices', 'Office of Deputy General Manager', 'Investigation Circle, APGCL\r\nNarengi, Guwahati-781026', NULL, '2024-11-08 07:08:22', '2024-11-08 07:08:22'),
(24, 'Ashish Choudhury', 'Resident Engineer (Liaison)', 22, NULL, 'ashish.choudhury@apgcl.org', 1, 'other_offices', 'Office of the Resident Engineer (Liaison)', 'ASEB, E-18, Lajpat Nagar-II\r\nNew Delhi-110 024', NULL, '2024-11-08 07:11:02', '2024-11-08 07:11:02'),
(25, 'Pickloo Deka', 'Assistant General Manager, Investigation Division', 23, NULL, 'pickloo.deka@apgcl.org', 1, 'other_offices', 'Office of Assistant General Manager', 'Borpani Killing Valley (BKV)\r\nInvestigation Division, Jagiroad\r\nAPGCL', NULL, '2024-11-08 07:12:56', '2024-11-08 07:12:56');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
