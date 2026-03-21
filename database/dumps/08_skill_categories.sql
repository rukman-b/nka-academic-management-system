-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Host: db
-- Generation Time: Mar 19, 2026 at 08:58 AM
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
-- Dumping data for table `skill_categories`
--

INSERT INTO `skill_categories` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Technical Skills', '2026-03-19 07:31:35', '2026-03-19 07:31:35'),
(2, 'Analytical Skills', '2026-03-19 07:31:35', '2026-03-19 07:31:35'),
(3, 'Communication Skills', '2026-03-19 07:31:35', '2026-03-19 07:31:35'),
(4, 'Practical Skills', '2026-03-19 07:31:35', '2026-03-19 07:31:35'),
(5, 'Research Skills', '2026-03-19 07:31:35', '2026-03-19 07:31:35'),
(6, 'Management Skills', '2026-03-19 07:31:35', '2026-03-19 07:31:35'),
(7, 'Digital Skills', '2026-03-19 07:31:35', '2026-03-19 07:31:35'),
(8, 'Problem-Solving Skills', '2026-03-19 07:31:35', '2026-03-19 07:31:35');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
