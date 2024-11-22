-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Nov 21, 2024 at 03:32 PM
-- Server version: 8.0.39
-- PHP Version: 8.1.30

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
-- Table structure for table `tenders`
--

CREATE TABLE `tenders` (
  `id` bigint UNSIGNED NOT NULL,
  `tender_no` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_archived` tinyint(1) NOT NULL,
  `directory_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `financial_year_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tenders`
--

INSERT INTO `tenders` (`id`, `tender_no`, `description`, `is_archived`, `directory_name`, `financial_year_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Notice No. APGCL/CGM (H&C)/07 of 2019-20 Date: 27/09/2019', 'CANCELLATION NOTICE FOR TENDER INVITED FOR REPAIRING OF ZIG ZAG QUARRY ROAD TO DAM SITE INCLUDING HILL SIDE DRAIN CLEARANCE AT KLHEP', 1, 'KLHEP REPAIRING OF ZIG ZAG QUARRY ROAD', 1, '2024-11-21 13:55:58', '2024-11-21 13:57:07', NULL),
(2, 'APGCL/CGM(H&C)/18 of 2019-20', 'EXTENSION NOTICE FOR TENDER NO. TENDER NOTICE NO. APGCL/CGM(H&C)/18 OF 2019-20', 1, 'MSHEP Construction Of Masonry Structures', 1, '2024-11-21 14:00:34', '2024-11-21 14:01:04', NULL),
(3, 'APGCL/CGM(H&C)/18 of 2019-20', '2ND EXTENSION NOTICE FOR TENDER NO. TENDER NOTICE NO. APGCL/CGM(H&C)/18 OF 2019-20', 1, 'MSHEP Construction Of Masonry Structures', 1, '2024-11-21 14:07:53', '2024-11-21 14:08:52', NULL),
(4, 'TENDER NOTICE NO. 21 OF 2019-20 OF CGM (H&C), APGCL', 'TENDER FOR:\r\n1. CONSTRUCTION OF STEEL BRACING SADDLE BLOCKS AT MYNTRIANG SMALL HYDRO ELECTRIC PROJECT, STAGE-I, APGCL, KARBI ANGLONG (GROUP A).\r\n2. CONSTRUCTION OF STEEL BRACING SADDLE BLOCKS AT MYNTRIANG SMALL HYDRO ELECTRIC PROJECT, STAGE-I, APGCL, KARBI ANGLONG (GROUP B).', 1, 'Jungle Clearance', 1, '2024-11-21 14:12:23', '2024-11-21 14:20:28', NULL),
(5, 'NOTICE NO. APGCL/CGM (H&C)/23 of 2019-20 DATE: 15/02/2020', 'JUNGLE CLEARANCE AT DAG NO. 117 AT APCD, ATPP, APGCL, AMGURI', 1, 'Jungle Clearance', 1, '2024-11-21 14:28:26', '2024-11-21 14:29:14', NULL),
(6, 'NOTICE NO. APGCL/CGM (H&C)/24 OF 2019-20 DATE: 19/02/2020', 'REPAIRING AND MODIFICATION OF OFFICE BUILDING AT AMGURI SOLAR POWER PROJECT (70 MW)', 1, 'AMGURI OFFICE BUILDING REPAIR', 1, '2024-11-21 14:31:33', '2024-11-21 14:33:01', NULL),
(7, 'TENDER NOTICE NO.:APGCL/PD/LKHEP/CIVIL WORKS/02 OF 2019-20 DATED: 25.02.2020', 'CONSTRUCTION OF CAST-IN-SITU BOUNDARY PILLAR ALONG WITH THE PROJECT BOUNDARY IN THE EASTERN AND NORTHERN SIDE OF LKHEP IN THE REVENUE LAND AREA (EXCLUDING RESERVOIR AREA) IN THE RIGHT BANK OF KOPILI RIVER, DIMA HASAO DISTRICT', 1, 'LKHEP CAST-IN-SITU BOUNDARY PILLAR', 1, '2024-11-21 14:35:55', '2024-11-21 14:36:31', NULL),
(8, 'NOTICE NO. APGCL/CGM (H&C)/25 OF 2019-20 Date: 04/03/2020', 'CONSTRUCTION OF BITUMINOUS SURFACE ROAD FROM SWITCHYARD TO ABHAYPURIA NORA ALI (PART-A) AND CONSTRUCTION OF HUME PIPE CULVERT AT THE ROAD FROM SWITCHYARD TO ABHAYPURIA NORA ALI (PART-B) AT 70MW AMGURI SOLAR PARK, APGCL, AMGURI', 1, 'AMGURI BITUMINOUS ROAD CONSTRUCTION', 1, '2024-11-21 14:40:53', '2024-11-21 14:42:08', NULL),
(9, 'IFB No.: APGCL/ADB/Tranche-3/P-3 dated 06/03/2020', 'PROCUREMENT OF PLANT- DESIGN AND ENGINEERING, MANUFACTURING, SUPPLY, ERECTION, TESTING AND COMMISSIONING OF ELECTROMECHANICAL EQUIPMENT FOR 120 MW LOWER KOPILI HYDROELECTRIC PROJECT, ASSAM, INDIA (PACKAGE-3)', 1, 'Lkhep Procurement Of Plant', 1, '2024-11-21 14:40:54', '2024-11-21 15:06:15', NULL),
(10, 'NOTICE NO. APGCL/CGM (H&C)/26 OF 2019-20 DATED: 12/03/2020', 'TENDER FOR REPAIRING OF HEAD RACE TUNNEL (HRT) AT KLHEP, WEST KARBI ANGLONG', 1, 'Klhep Hrt Repair', 1, '2024-11-21 15:11:05', '2024-11-21 15:14:12', NULL),
(11, 'NOTICE NO. APGCL/CGM (H&C)/27 OF 2019-20 DATE: 19/03/2020', 'ADDITIONAL AND SUPPLEMENTARY WORK FOR CONSTRUCTION OF CAUSEWAY NEAR WEIR STAGE-I, MYNTRIANG SHEP,APGCL, KARBI ANGLONG.', 1, 'Myntriang Causeway Construction', 1, '2024-11-21 15:16:08', '2024-11-21 15:19:32', NULL),
(12, 'TENDER NOTICE NO. 01 OF 2020-21', 'CONSTRUCTION OF PROPOSED OFFICER’S MULTI STORIED BUILDING INSIDE LTPS COLONY, MAIBELLA', 1, 'Ltps Building Construction', 2, '2024-11-21 15:24:20', '2024-11-21 15:31:05', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tender_files`
--

CREATE TABLE `tender_files` (
  `id` bigint UNSIGNED NOT NULL,
  `tender_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `downloadLink` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tender_files`
--

INSERT INTO `tender_files` (`id`, `tender_id`, `name`, `downloadLink`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 'Notice', 'admin-assets/Tenders/2019-2020/KLHEP REPAIRING OF ZIG ZAG QUARRY ROAD/1732197414_Can ZIG ZIG.pdf', '2024-11-21 13:56:54', '2024-11-21 13:56:54', NULL),
(2, 2, 'Extension Notice', 'admin-assets/Tenders/2019-2020/MSHEP Construction Of Masonry Structures/1732197659_Extension of NIT 18.pdf', '2024-11-21 14:00:59', '2024-11-21 14:00:59', NULL),
(3, 3, 'Extension Notice', 'admin-assets/Tenders/2019-2020/MSHEP Construction Of Masonry Structures/1732198125_2nd Extension.pdf', '2024-11-21 14:08:45', '2024-11-21 14:08:45', NULL),
(4, 4, 'NIT', 'admin-assets/Tenders/2019-2020/Jungle Clearance/1732198820_NIT.pdf', '2024-11-21 14:20:20', '2024-11-21 14:20:20', NULL),
(5, 4, 'Tender Document for Group A', 'admin-assets/Tenders/2019-2020/Jungle Clearance/1732198893_Tender Group A.pdf', '2024-11-21 14:21:33', '2024-11-21 14:21:33', NULL),
(6, 4, 'Tender Document for Group B', 'admin-assets/Tenders/2019-2020/Jungle Clearance/1732198932_Tender Group B.pdf', '2024-11-21 14:22:12', '2024-11-21 14:22:12', NULL),
(7, 4, 'Extension Notice', 'admin-assets/Tenders/2019-2020/Jungle Clearance/1732198970_extension notice of NIT 21.pdf', '2024-11-21 14:22:50', '2024-11-21 14:22:50', NULL),
(8, 5, 'NIT', 'admin-assets/Tenders/2019-2020/Jungle Clearance/1732199346_NIT.pdf', '2024-11-21 14:29:06', '2024-11-21 14:29:06', NULL),
(9, 6, 'NIT', 'admin-assets/Tenders/2019-2020/AMGURI OFFICE BUILDING REPAIR/1732199573_NIT 24.pdf', '2024-11-21 14:32:53', '2024-11-21 14:32:53', NULL),
(10, 6, 'Tender Document', 'admin-assets/Tenders/2019-2020/AMGURI OFFICE BUILDING REPAIR/1732199612_tender doc NIT 24.pdf', '2024-11-21 14:33:32', '2024-11-21 14:33:32', NULL),
(11, 7, 'NIT', 'admin-assets/Tenders/2019-2020/LKHEP CAST-IN-SITU BOUNDARY PILLAR/1732199785_NIT, LKHEP.pdf', '2024-11-21 14:36:25', '2024-11-21 14:36:25', NULL),
(12, 7, 'Tender Document', 'admin-assets/Tenders/2019-2020/LKHEP CAST-IN-SITU BOUNDARY PILLAR/1732199825_Tender document for Boundary Pillar, LKHEP (Re-bidding).pdf', '2024-11-21 14:37:05', '2024-11-21 14:37:05', NULL),
(13, 7, 'Extension Notice', 'admin-assets/Tenders/2019-2020/LKHEP CAST-IN-SITU BOUNDARY PILLAR/1732199856_Extension Notice (Boundary Pillar).pdf', '2024-11-21 14:37:36', '2024-11-21 14:37:36', NULL),
(14, 7, '2nd Extension', 'admin-assets/Tenders/2019-2020/LKHEP CAST-IN-SITU BOUNDARY PILLAR/1732199882_2nd extension notice LKHEP.pdf', '2024-11-21 14:38:02', '2024-11-21 14:38:02', NULL),
(15, 8, 'NIT', 'admin-assets/Tenders/2019-2020/AMGURI BITUMINOUS ROAD CONSTRUCTION/1732200382_NIT No. 25 of 2019-20.pdf', '2024-11-21 14:41:24', '2024-11-21 14:41:24', NULL),
(16, 8, 'Tender Document', 'admin-assets/Tenders/2019-2020/AMGURI BITUMINOUS ROAD CONSTRUCTION/1732200402_Tender document.pdf', '2024-11-21 14:41:58', '2024-11-21 14:41:58', NULL),
(17, 9, 'IFB', 'admin-assets/Tenders/2019-2020/Lkhep Procurement Of Plant/1732201497_IFB Tranche-3 LKHEP.pdf', '2024-11-21 14:46:22', '2024-11-21 15:04:57', NULL),
(18, 9, '1st ADDENDUM', 'admin-assets/Tenders/2019-2020/Lkhep Procurement Of Plant/1732201559_1stAddendum.pdf', '2024-11-21 14:46:42', '2024-11-21 15:05:59', NULL),
(19, 9, '2nd ADDENDUM', 'admin-assets/Tenders/2019-2020/Lkhep Procurement Of Plant/1732201656_1stAddendum.pdf', '2024-11-21 15:07:36', '2024-11-21 15:07:36', NULL),
(20, 9, '3rd ADDENDUM', 'admin-assets/Tenders/2019-2020/Lkhep Procurement Of Plant/1732201711_3rdAddendum-P3.pdf', '2024-11-21 15:08:31', '2024-11-21 15:08:31', NULL),
(21, 9, '4th ADDENDUM(Online Pre-Bid Meeting)', 'admin-assets/Tenders/2019-2020/Lkhep Procurement Of Plant/1732201743_4thAddendum-P3.pdf', '2024-11-21 15:09:03', '2024-11-21 15:09:03', NULL),
(22, 10, 'NIT', 'admin-assets/Tenders/2019-2020/Klhep Hrt Repair/1732201898_NIT 26.pdf', '2024-11-21 15:11:38', '2024-11-21 15:11:38', NULL),
(23, 10, 'Tender Document', 'admin-assets/Tenders/2019-2020/Klhep Hrt Repair/1732201965_Tender document.pdf', '2024-11-21 15:12:45', '2024-11-21 15:12:45', NULL),
(24, 10, 'Extension Notice', 'admin-assets/Tenders/2019-2020/Klhep Hrt Repair/1732202001_Extension NIT26.pdf', '2024-11-21 15:13:21', '2024-11-21 15:13:21', NULL),
(25, 10, 'Cancellation Notice', 'admin-assets/Tenders/2019-2020/Klhep Hrt Repair/1732202041_cancellation HRT Tender 26.pdf', '2024-11-21 15:14:01', '2024-11-21 15:14:01', NULL),
(26, 11, 'NIT', 'admin-assets/Tenders/2019-2020/Myntriang Causeway Construction/1732202204_NIT 27.pdf', '2024-11-21 15:16:44', '2024-11-21 15:16:44', NULL),
(27, 11, 'Tender Document', 'admin-assets/Tenders/2019-2020/Myntriang Causeway Construction/1732202273_Tender document.pdf', '2024-11-21 15:17:53', '2024-11-21 15:17:53', NULL),
(28, 11, 'Extension Notice', 'admin-assets/Tenders/2019-2020/Myntriang Causeway Construction/1732202298_extension causeway additional.pdf', '2024-11-21 15:18:18', '2024-11-21 15:18:18', NULL),
(29, 11, '2nd Extension Notice', 'admin-assets/Tenders/2019-2020/Myntriang Causeway Construction/1732202322_Extension of Causeway.pdf', '2024-11-21 15:18:42', '2024-11-21 15:18:42', NULL),
(30, 11, 'Corrigendum', 'admin-assets/Tenders/2019-2020/Myntriang Causeway Construction/1732202346_corrigendum to nit 27.pdf', '2024-11-21 15:19:06', '2024-11-21 15:19:06', NULL),
(31, 12, 'NIT', 'admin-assets/Tenders/2020-2021/Ltps Building Construction/1732202877_NIT No. 01 of 2020-21 of CGM(H&C).pdf', '2024-11-21 15:27:57', '2024-11-21 15:27:57', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tenders`
--
ALTER TABLE `tenders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tenders_financial_year_id_foreign` (`financial_year_id`);

--
-- Indexes for table `tender_files`
--
ALTER TABLE `tender_files`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tender_files_tender_id_foreign` (`tender_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tenders`
--
ALTER TABLE `tenders`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `tender_files`
--
ALTER TABLE `tender_files`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tenders`
--
ALTER TABLE `tenders`
  ADD CONSTRAINT `tenders_financial_year_id_foreign` FOREIGN KEY (`financial_year_id`) REFERENCES `financial_years` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE;

--
-- Constraints for table `tender_files`
--
ALTER TABLE `tender_files`
  ADD CONSTRAINT `tender_files_tender_id_foreign` FOREIGN KEY (`tender_id`) REFERENCES `tenders` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
