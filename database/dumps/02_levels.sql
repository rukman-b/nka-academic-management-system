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
-- Dumping data for table `levels`
--

INSERT INTO `levels` (`id`, `fheq_level`, `name`, `description`, `created_at`, `updated_at`) VALUES
(1, 4, 'Certificate of Higher Education (CertHE)', 'Introductory level covering fundamental concepts and basic academic skills in the subject area.', '2026-03-19 04:14:56', '2026-03-19 04:14:56'),
(2, 5, 'Diploma of Higher Education (DipHE)', 'Intermediate level focusing on deeper understanding and application of subject knowledge.', '2026-03-19 04:15:19', '2026-03-19 04:15:19'),
(3, 6, 'Bachelor\'s Degree (BSc/BEng/BA)', 'Advanced undergraduate level involving critical thinking, independent study, and project work.', '2026-03-19 04:15:35', '2026-03-19 04:15:35'),
(4, 7, 'Master\'s Degree (MSc/MBA/MA)', 'Postgraduate level focusing on specialised knowledge, research, and professional skills.', '2026-03-19 04:15:54', '2026-03-19 04:15:54'),
(5, 8, 'Doctorate (PhD/DBA)', 'Highest academic level involving original research and significant contribution to knowledge.', '2026-03-19 04:16:12', '2026-03-19 04:16:12');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
