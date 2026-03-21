-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Host: db
-- Generation Time: Mar 19, 2026 at 08:53 AM
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
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`id`, `name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Computer Science', 'Focuses on software development, artificial intelligence, and data science.', '2026-03-19 03:45:40', '2026-03-19 03:45:40'),
(2, 'Business Administration', 'Provides education in management, finance, and entrepreneurship.', '2026-03-19 03:46:48', '2026-03-19 03:46:48'),
(3, 'Mechanical Engineering', 'Covers design, manufacturing, and mechanical systems.', '2026-03-19 03:47:37', '2026-03-19 03:47:37'),
(4, 'Electrical Engineering', 'Focuses on electrical systems, circuits, and power engineering.', '2026-03-19 03:48:20', '2026-03-19 03:48:20'),
(5, 'Civil Engineering', 'Specializes in construction, infrastructure, and environmental engineering.', '2026-03-19 03:49:05', '2026-03-19 03:49:05'),
(6, 'Information Technology', 'Covers networking, cybersecurity, and system administration.', '2026-03-19 03:49:57', '2026-03-19 03:49:57'),
(7, 'Finance and Accounting', 'Focuses on financial management, auditing, and accounting systems.', '2026-03-19 03:50:40', '2026-03-19 03:50:40'),
(8, 'Hospitality Management', 'Provides training in hotel management, tourism, and customer service.', '2026-03-19 03:51:27', '2026-03-19 03:51:27'),
(9, 'Health Sciences', 'Covers healthcare, public health, and medical support studies.', '2026-03-19 03:52:08', '2026-03-19 03:52:08'),
(10, 'Marketing and Communications', 'Focuses on digital marketing, branding, and communication strategies.', '2026-03-19 03:52:46', '2026-03-19 03:52:46');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
