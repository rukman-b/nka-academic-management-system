-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Host: db
-- Generation Time: Mar 19, 2026 at 08:56 AM
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
-- Dumping data for table `practicals`
--

INSERT INTO `practicals` (`id`, `title`, `description`, `department_id`, `created_at`, `updated_at`) VALUES
(1, 'Programming Lab', 'Hands-on practical sessions covering coding exercises, debugging, and problem-solving techniques.', 1, '2026-03-19 07:19:48', '2026-03-19 07:19:48'),
(2, 'Web Development Workshop', 'Practical work on building responsive web pages and interactive user interfaces.', 1, '2026-03-19 07:19:48', '2026-03-19 07:19:48'),
(3, 'Systems Configuration Lab', 'Practical activities involving operating systems, command-line tools, and system setup.', 1, '2026-03-19 07:19:48', '2026-03-19 07:19:48'),
(4, 'Business Case Study Workshop', 'Practical analysis of business scenarios to support management decision-making.', 2, '2026-03-19 07:19:48', '2026-03-19 07:19:48'),
(5, 'Presentation Skills Lab', 'Practical exercises focused on business presentations, pitching, and communication skills.', 2, '2026-03-19 07:19:48', '2026-03-19 07:19:48'),
(6, 'Entrepreneurship Simulation', 'Hands-on business planning and startup simulation activities.', 2, '2026-03-19 07:19:48', '2026-03-19 07:19:48'),
(7, 'Engineering Drawing Workshop', 'Practical sessions on technical drawing, dimensioning, and CAD-based design.', 3, '2026-03-19 07:19:48', '2026-03-19 07:19:48'),
(8, 'Materials Testing Lab', 'Hands-on testing of engineering materials and interpretation of results.', 3, '2026-03-19 07:19:48', '2026-03-19 07:19:48'),
(9, 'Mechanical Systems Assembly Lab', 'Practical work on assembling and analysing mechanical components and systems.', 3, '2026-03-19 07:19:48', '2026-03-19 07:19:48'),
(10, 'Circuit Design Lab', 'Practical activities involving circuit construction, testing, and troubleshooting.', 4, '2026-03-19 07:19:48', '2026-03-19 07:19:48'),
(11, 'Electronics Measurement Workshop', 'Hands-on use of multimeters, oscilloscopes, and diagnostic tools.', 4, '2026-03-19 07:19:48', '2026-03-19 07:19:48'),
(12, 'Control Systems Simulation Lab', 'Practical modelling and testing of control systems and responses.', 4, '2026-03-19 07:19:48', '2026-03-19 07:19:48'),
(13, 'Surveying Practice', 'Field-based practical sessions in measurement, levelling, and surveying techniques.', 5, '2026-03-19 07:19:48', '2026-03-19 07:19:48'),
(14, 'Construction Materials Lab', 'Practical testing of concrete, soil, and other construction materials.', 5, '2026-03-19 07:19:48', '2026-03-19 07:19:48'),
(15, 'Structural Modelling Workshop', 'Hands-on activities involving structural design models and load testing concepts.', 5, '2026-03-19 07:19:48', '2026-03-19 07:19:48'),
(16, 'Network Configuration Lab', 'Practical setup and testing of network devices, addressing, and connectivity.', 6, '2026-03-19 07:19:48', '2026-03-19 07:19:48'),
(17, 'Cybersecurity Practice Lab', 'Hands-on exercises in system hardening, access control, and threat awareness.', 6, '2026-03-19 07:19:48', '2026-03-19 07:19:48'),
(18, 'Cloud Deployment Workshop', 'Practical activities in deploying and managing applications in cloud environments.', 6, '2026-03-19 07:19:48', '2026-03-19 07:19:48'),
(19, 'Accounting Software Workshop', 'Practical use of accounting software for journal entries, ledgers, and reporting.', 7, '2026-03-19 07:19:48', '2026-03-19 07:19:48'),
(20, 'Financial Analysis Lab', 'Hands-on financial statement analysis and interpretation exercises.', 7, '2026-03-19 07:19:48', '2026-03-19 07:19:48'),
(21, 'Budget Planning Workshop', 'Practical exercises in forecasting, budgeting, and variance analysis.', 7, '2026-03-19 07:19:48', '2026-03-19 07:19:48'),
(22, 'Front Office Operations Lab', 'Practical training in guest check-in, reservations, and hospitality service procedures.', 8, '2026-03-19 07:19:48', '2026-03-19 07:19:48'),
(23, 'Food Service Practice', 'Hands-on activities in table service, service standards, and hospitality delivery.', 8, '2026-03-19 07:19:48', '2026-03-19 07:19:48'),
(24, 'Event Coordination Workshop', 'Practical planning and coordination exercises for hospitality events.', 8, '2026-03-19 07:19:48', '2026-03-19 07:19:48'),
(25, 'Anatomy Observation Lab', 'Practical sessions supporting understanding of body systems and anatomical structures.', 9, '2026-03-19 07:19:48', '2026-03-19 07:19:48'),
(26, 'Public Health Field Activity', 'Hands-on community-focused health observation and reporting exercises.', 9, '2026-03-19 07:19:48', '2026-03-19 07:19:48'),
(27, 'Health Research Skills Workshop', 'Practical training in data collection, recording, and basic analysis in health contexts.', 9, '2026-03-19 07:19:48', '2026-03-19 07:19:48'),
(28, 'Digital Content Studio', 'Practical creation of campaign content for digital platforms and media channels.', 10, '2026-03-19 07:19:48', '2026-03-19 07:19:48'),
(29, 'Brand Strategy Workshop', 'Hands-on exercises in brand identity development and communication planning.', 10, '2026-03-19 07:19:48', '2026-03-19 07:19:48'),
(30, 'Campaign Planning Lab', 'Practical design and evaluation of integrated marketing campaigns.', 10, '2026-03-19 07:19:48', '2026-03-19 07:19:48');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
