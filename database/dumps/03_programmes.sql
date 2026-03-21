-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Host: db
-- Generation Time: Mar 19, 2026 at 08:54 AM
-- Server version: 10.11.16-MariaDB-ubu2204
-- PHP Version: 8.3.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `nka_hub`
--

--
-- Dumping data for table `programmes`
--

INSERT INTO `programmes` (`id`, `name`, `short_name`, `department_id`, `starting_level_id`, `offered_level_id`, `created_at`, `updated_at`) VALUES
(1, 'Certificate in Computing Fundamentals', 'CCF', 1, 1, 1, '2026-03-19 05:20:55', '2026-03-19 05:20:55'),
(2, 'Diploma in Software Development', 'DSD', 1, 1, 2, '2026-03-19 05:21:32', '2026-03-19 05:21:32'),
(4, 'BSc Computer Science', 'BSC_CS', 1, 1, 3, '2026-03-19 05:23:46', '2026-03-19 05:23:46'),
(5, 'MSc Data Science', 'MSC_DS', 1, 4, 4, '2026-03-19 05:24:26', '2026-03-19 05:24:26'),
(6, 'PhD Artificial Intelligence', 'PHD_AI', 1, 5, 5, '2026-03-19 05:24:55', '2026-03-19 05:24:55'),
(7, 'Certificate in Business Studies', 'CBS', 2, 1, 1, '2026-03-19 05:25:27', '2026-03-19 05:25:27'),
(8, 'Diploma in Business Management', 'DBM', 2, 1, 2, '2026-03-19 05:25:53', '2026-03-19 05:25:53'),
(9, 'BA Business Administration', 'BA_BA', 2, 1, 3, '2026-03-19 05:26:19', '2026-03-19 05:26:19'),
(10, 'MBA Business Leadership', 'MBA_BL', 2, 4, 4, '2026-03-19 05:26:50', '2026-03-19 05:26:50'),
(11, 'PhD Business Strategy', 'PHD_BS', 2, 5, 5, '2026-03-19 05:27:13', '2026-03-19 05:27:13'),
(12, 'Certificate in Engineering Fundamentals', 'CEF', 3, 1, 1, '2026-03-19 05:27:37', '2026-03-19 05:27:37'),
(13, 'Diploma in Mechanical Systems', 'DMS', 3, 1, 2, '2026-03-19 05:28:06', '2026-03-19 05:28:06'),
(14, 'BEng Mechanical Engineering', 'BENG_ME', 3, 1, 3, '2026-03-19 05:28:53', '2026-03-19 05:28:53'),
(15, 'MSc Advanced Manufacturing', 'MSC_AM', 3, 4, 4, '2026-03-19 05:29:23', '2026-03-19 05:29:23'),
(16, 'PhD Mechanical Design', 'PHD_MD', 3, 5, 5, '2026-03-19 05:29:47', '2026-03-19 05:29:47'),
(17, 'Certificate in Electrical Fundamentals', 'CEF_EE', 4, 1, 1, '2026-03-19 05:30:19', '2026-03-19 05:30:19'),
(18, 'Diploma in Electrical Systems', 'DES', 4, 1, 2, '2026-03-19 05:30:44', '2026-03-19 05:30:44'),
(19, 'BEng Electrical Engineering', 'BENG_EE', 4, 1, 3, '2026-03-19 05:31:07', '2026-03-19 05:31:07'),
(20, 'MSc Power and Energy Systems', 'MSC_PES', 4, 4, 4, '2026-03-19 05:31:36', '2026-03-19 05:31:36'),
(21, 'PhD Electrical Networks', 'PHD_EN', 4, 5, 5, '2026-03-19 05:32:06', '2026-03-19 05:32:06'),
(22, 'Certificate in Construction Studies', 'CCS', 5, 1, 1, '2026-03-19 05:32:30', '2026-03-19 05:32:30'),
(23, 'Diploma in Infrastructure Engineering', 'DIE', 5, 1, 2, '2026-03-19 05:32:52', '2026-03-19 05:32:52'),
(24, 'BEng Civil Engineering', 'BENG_CE', 5, 1, 3, '2026-03-19 05:33:21', '2026-03-19 05:33:21'),
(25, 'MSc Structural Engineering', 'MSC_SE', 5, 4, 4, '2026-03-19 05:33:46', '2026-03-19 05:33:46'),
(26, 'PhD Sustainable Infrastructure', 'PHD_SI', 5, 5, 5, '2026-03-19 05:34:07', '2026-03-19 05:34:07'),
(27, 'Certificate in IT Support', 'CITS', 6, 1, 1, '2026-03-19 05:34:31', '2026-03-19 05:34:31'),
(28, 'Diploma in Network Administration', 'DNA', 6, 1, 2, '2026-03-19 05:35:13', '2026-03-19 05:35:13'),
(29, 'BSc Information Technology', 'BSC_IT', 6, 1, 3, '2026-03-19 05:35:39', '2026-03-19 05:35:39'),
(30, 'MSc Cybersecurity', 'MSC_CYB', 6, 4, 4, '2026-03-19 05:36:06', '2026-03-19 05:36:06'),
(31, 'PhD Information Systems', 'PHD_IS', 6, 5, 5, '2026-03-19 05:36:30', '2026-03-19 05:36:30'),
(32, 'Certificate in Accounting Practice', 'CAP', 7, 1, 1, '2026-03-19 05:36:56', '2026-03-19 05:36:56'),
(33, 'Diploma in Financial Management', 'DFM', 7, 1, 2, '2026-03-19 05:37:19', '2026-03-19 05:37:19'),
(34, 'BSc Finance and Accounting', 'BSC_FA', 7, 1, 3, '2026-03-19 05:37:47', '2026-03-19 05:37:47'),
(35, 'MSc Corporate Finance', 'MSC_CF', 7, 4, 4, '2026-03-19 05:38:11', '2026-03-19 05:38:11'),
(36, 'PhD Accounting and Governance', 'PHD_AG', 7, 5, 5, '2026-03-19 05:38:34', '2026-03-19 05:38:34'),
(37, 'Certificate in Hospitality Services', 'CHS', 8, 1, 1, '2026-03-19 05:38:56', '2026-03-19 05:38:56'),
(38, 'Diploma in Hotel Operations', 'DHO', 8, 1, 2, '2026-03-19 05:39:16', '2026-03-19 05:39:16'),
(39, 'BA Hospitality Management', 'BA_HM', 8, 1, 3, '2026-03-19 05:39:43', '2026-03-19 05:39:43'),
(40, 'MSc International Tourism Management', 'MSC_ITM', 8, 4, 4, '2026-03-19 05:40:05', '2026-03-19 05:40:05'),
(41, 'PhD Hospitality Innovation', 'PHD_HI', 8, 5, 5, '2026-03-19 05:40:30', '2026-03-19 05:40:30'),
(42, 'Certificate in Health Studies', 'CHST', 9, 1, 1, '2026-03-19 05:40:51', '2026-03-19 05:40:51'),
(43, 'Diploma in Public Health Practice', 'DPHP', 9, 1, 2, '2026-03-19 05:41:16', '2026-03-19 05:41:16'),
(44, 'BSc Health Sciences', 'BSC_HS', 9, 1, 3, '2026-03-19 05:41:39', '2026-03-19 05:41:39'),
(45, 'MSc Public Health', 'MSC_PH', 9, 4, 4, '2026-03-19 05:42:00', '2026-03-19 05:42:00'),
(46, 'PhD Health Research', 'PHD_HR', 9, 5, 5, '2026-03-19 05:42:22', '2026-03-19 05:42:22'),
(47, 'Certificate in Marketing Practice', 'CMP', 10, 1, 1, '2026-03-19 05:42:56', '2026-03-19 05:42:56'),
(48, 'Diploma in Digital Marketing', 'DDM', 10, 1, 2, '2026-03-19 05:43:16', '2026-03-19 05:43:16'),
(49, 'BA Marketing and Communications', 'BA_MC', 10, 1, 3, '2026-03-19 05:43:47', '2026-03-19 05:43:47'),
(50, 'MSc Strategic Communications', 'MSC_SC', 10, 4, 4, '2026-03-19 05:44:09', '2026-03-19 05:44:09'),
(51, 'PhD Media and Communication Studies', 'PHD_MCS', 10, 5, 5, '2026-03-19 05:44:30', '2026-03-19 05:44:30');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
