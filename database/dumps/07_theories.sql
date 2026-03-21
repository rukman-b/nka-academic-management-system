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
-- Dumping data for table `theories`
--

INSERT INTO `theories` (`id`, `department_id`, `title`, `description`, `created_at`, `updated_at`) VALUES
(1, 1, 'Programming Concepts', 'Theoretical foundations of programming logic, control structures, data types, and problem solving.', '2026-03-19 07:19:58', '2026-03-19 07:19:58'),
(2, 1, 'Computer Architecture Theory', 'Theory of computer organisation, processors, memory, and system-level operations.', '2026-03-19 07:19:58', '2026-03-19 07:19:58'),
(3, 1, 'Software Development Principles', 'Theoretical principles of software design, development lifecycles, and maintainability.', '2026-03-19 07:19:58', '2026-03-19 07:19:58'),
(4, 2, 'Management Theory', 'Covers classical and modern management theories, leadership approaches, and organisational behaviour.', '2026-03-19 07:19:58', '2026-03-19 07:19:58'),
(5, 2, 'Business Strategy Theory', 'Explores strategic planning, competitive advantage, and organisational positioning.', '2026-03-19 07:19:58', '2026-03-19 07:19:58'),
(6, 2, 'Entrepreneurship Theory', 'Theoretical study of innovation, venture creation, and entrepreneurial ecosystems.', '2026-03-19 07:19:58', '2026-03-19 07:19:58'),
(7, 3, 'Mechanics Theory', 'Theoretical principles of forces, motion, equilibrium, and engineering mechanics.', '2026-03-19 07:19:58', '2026-03-19 07:19:58'),
(8, 3, 'Thermodynamics Theory', 'Covers the laws of thermodynamics, heat transfer, and energy systems.', '2026-03-19 07:19:58', '2026-03-19 07:19:58'),
(9, 3, 'Machine Design Theory', 'Theoretical concepts in component design, stress, strain, and mechanical reliability.', '2026-03-19 07:19:58', '2026-03-19 07:19:58'),
(10, 4, 'Circuit Theory', 'Theoretical principles of current, voltage, resistance, and circuit behaviour.', '2026-03-19 07:19:58', '2026-03-19 07:19:58'),
(11, 4, 'Electromagnetic Theory', 'Covers electric fields, magnetic fields, and electromagnetic interactions.', '2026-03-19 07:19:58', '2026-03-19 07:19:58'),
(12, 4, 'Control Systems Theory', 'Theoretical study of feedback, stability, dynamic response, and system modelling.', '2026-03-19 07:19:58', '2026-03-19 07:19:58'),
(13, 5, 'Structural Engineering Theory', 'Theoretical foundations of loads, forces, structural behaviour, and design concepts.', '2026-03-19 07:19:58', '2026-03-19 07:19:58'),
(14, 5, 'Geotechnical Theory', 'Covers soil behaviour, ground mechanics, and foundational engineering theory.', '2026-03-19 07:19:58', '2026-03-19 07:19:58'),
(15, 5, 'Construction Management Theory', 'Theory of project planning, scheduling, cost control, and construction processes.', '2026-03-19 07:19:58', '2026-03-19 07:19:58'),
(16, 6, 'Networking Theory', 'Theoretical study of network models, communication protocols, and data transmission.', '2026-03-19 07:19:58', '2026-03-19 07:19:58'),
(17, 6, 'Cybersecurity Theory', 'Covers confidentiality, integrity, availability, threats, vulnerabilities, and controls.', '2026-03-19 07:19:58', '2026-03-19 07:19:58'),
(18, 6, 'Cloud Computing Theory', 'Theoretical foundations of cloud models, service layers, and virtual infrastructure.', '2026-03-19 07:19:58', '2026-03-19 07:19:58'),
(19, 7, 'Accounting Principles Theory', 'Theoretical foundations of accounting standards, financial recording, and reporting.', '2026-03-19 07:19:58', '2026-03-19 07:19:58'),
(20, 7, 'Corporate Finance Theory', 'Covers financial decision-making, capital structure, valuation, and risk concepts.', '2026-03-19 07:19:58', '2026-03-19 07:19:58'),
(21, 7, 'Auditing Theory', 'Theoretical study of assurance, internal control, audit processes, and professional ethics.', '2026-03-19 07:19:58', '2026-03-19 07:19:58'),
(22, 8, 'Hospitality Operations Theory', 'Theoretical understanding of hospitality service systems, guest experience, and operations.', '2026-03-19 07:19:58', '2026-03-19 07:19:58'),
(23, 8, 'Tourism Management Theory', 'Covers destination development, tourism systems, and visitor management concepts.', '2026-03-19 07:19:58', '2026-03-19 07:19:58'),
(24, 8, 'Service Quality Theory', 'Theoretical principles of service quality, customer satisfaction, and service improvement.', '2026-03-19 07:19:58', '2026-03-19 07:19:58'),
(25, 9, 'Human Physiology Theory', 'Theoretical study of body systems, function, and biological processes.', '2026-03-19 07:19:58', '2026-03-19 07:19:58'),
(26, 9, 'Public Health Theory', 'Covers health promotion, prevention, policy, and population-level health frameworks.', '2026-03-19 07:19:58', '2026-03-19 07:19:58'),
(27, 9, 'Health Research Theory', 'Theoretical foundations of research design, evidence, ethics, and data interpretation in health.', '2026-03-19 07:19:58', '2026-03-19 07:19:58'),
(28, 10, 'Marketing Principles Theory', 'Theoretical foundations of segmentation, targeting, positioning, and customer value.', '2026-03-19 07:19:58', '2026-03-19 07:19:58'),
(29, 10, 'Media and Communication Theory', 'Covers communication models, media channels, and message delivery in society.', '2026-03-19 07:19:58', '2026-03-19 07:19:58'),
(30, 10, 'Brand Management Theory', 'Theoretical study of branding, identity, reputation, and strategic communication.', '2026-03-19 07:19:58', '2026-03-19 07:19:58');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
