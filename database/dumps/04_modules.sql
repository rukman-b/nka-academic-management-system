-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Host: db
-- Generation Time: Mar 19, 2026 at 08:55 AM
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
-- Dumping data for table `modules`
--

INSERT INTO `modules` (`id`, `module_code`, `name`, `fheq_level_id`, `mark`, `lecturer_id`, `description`, `created_at`, `updated_at`) VALUES
(1, 'COSC10001', 'Programming Fundamentals', 1, 40, NULL, 'Introduction to programming concepts using modern languages.', '2026-03-19 06:17:59', '2026-03-19 06:17:59'),
(2, 'COSC10002', 'Computer Systems', 1, 40, NULL, 'Basics of computer architecture and operating systems.', '2026-03-19 06:18:50', '2026-03-19 06:24:05'),
(3, 'COSC10003', 'Web Development Basics', 1, 40, NULL, 'Introduction to HTML, CSS, and JavaScript.', '2026-03-19 06:24:58', '2026-03-19 06:24:58'),
(4, 'COSC20001', 'Data Structures and Algorithms', 2, 40, NULL, '', '2026-03-19 06:25:39', '2026-03-19 06:25:39'),
(5, 'COSC30001', 'Machine Learning', 3, 40, NULL, '', '2026-03-19 06:26:14', '2026-03-19 06:26:14'),
(6, 'COSC30002', 'Distributed Systems', 3, 40, NULL, '', '2026-03-19 06:26:39', '2026-03-19 06:26:39'),
(7, 'COSC30003', 'Final Year Project', 3, 50, NULL, '', '2026-03-19 06:27:13', '2026-03-19 06:27:13'),
(8, 'BUSI10001', 'Introduction to Business Studies', 1, 40, NULL, 'Introduces core business concepts, organisational structures, and the role of business in society.', '2026-03-19 07:05:50', '2026-03-19 07:05:50'),
(9, 'BUSI10002', 'Principles of Management', 1, 40, NULL, 'Covers fundamental management theories, planning, organising, leading, and controlling.', '2026-03-19 07:05:50', '2026-03-19 07:05:50'),
(10, 'BUSI10003', 'Business Communication Skills', 1, 40, NULL, 'Develops written, verbal, and professional communication skills for business contexts.', '2026-03-19 07:05:50', '2026-03-19 07:05:50'),
(11, 'BUSI20001', 'Marketing Principles', 2, 40, NULL, 'Introduces market research, consumer behaviour, segmentation, and branding fundamentals.', '2026-03-19 07:05:50', '2026-03-19 07:05:50'),
(12, 'BUSI30001', 'Strategic Management', 3, 40, NULL, 'Focuses on business strategy, competitive positioning, and long-term organisational planning.', '2026-03-19 07:05:50', '2026-03-19 07:05:50'),
(13, 'BUSI30002', 'Entrepreneurship and Innovation', 3, 40, NULL, 'Covers venture creation, innovation management, and entrepreneurial thinking in business.', '2026-03-19 07:05:50', '2026-03-19 07:05:50'),
(14, 'BUSI30003', 'Business Research Project', 3, 50, NULL, 'Requires independent investigation and application of research methods to a business problem.', '2026-03-19 07:05:50', '2026-03-19 07:05:50'),
(15, 'MECH10001', 'Engineering Mathematics', 1, 40, NULL, 'Introduces mathematical techniques used in mechanical engineering analysis and problem-solving.', '2026-03-19 07:05:50', '2026-03-19 07:05:50'),
(16, 'MECH10002', 'Mechanical Principles', 1, 40, NULL, 'Covers forces, motion, energy, and the principles governing mechanical systems.', '2026-03-19 07:05:50', '2026-03-19 07:05:50'),
(17, 'MECH10003', 'Engineering Drawing and CAD', 1, 40, NULL, 'Introduces technical drawing conventions and computer-aided design tools.', '2026-03-19 07:05:50', '2026-03-19 07:05:50'),
(18, 'MECH20001', 'Thermodynamics', 2, 40, NULL, 'Explores heat, energy transfer, thermodynamic systems, and engineering applications.', '2026-03-19 07:05:50', '2026-03-19 07:05:50'),
(19, 'MECH30001', 'Machine Design', 3, 40, NULL, 'Focuses on the design of mechanical components, systems, and reliability considerations.', '2026-03-19 07:05:50', '2026-03-19 07:05:50'),
(20, 'MECH30002', 'Manufacturing Systems', 3, 40, NULL, 'Examines production methods, automation, process planning, and quality in manufacturing.', '2026-03-19 07:05:50', '2026-03-19 07:05:50'),
(21, 'MECH30003', 'Mechanical Engineering Project', 3, 50, NULL, 'Provides independent project experience in mechanical design, analysis, or systems engineering.', '2026-03-19 07:05:50', '2026-03-19 07:05:50'),
(22, 'ELEC10001', 'Electrical Circuit Theory', 1, 40, NULL, 'Introduces current, voltage, resistance, circuit laws, and simple electrical analysis.', '2026-03-19 07:05:50', '2026-03-19 07:05:50'),
(23, 'ELEC10002', 'Electronic Devices', 1, 40, NULL, 'Covers semiconductors, diodes, transistors, and their practical applications.', '2026-03-19 07:05:50', '2026-03-19 07:05:50'),
(24, 'ELEC10003', 'Engineering Mathematics for Electrical Systems', 1, 40, NULL, 'Develops mathematical skills for analysing electrical and electronic systems.', '2026-03-19 07:05:50', '2026-03-19 07:05:50'),
(25, 'ELEC20001', 'Digital Electronics', 2, 40, NULL, 'Explores logic gates, combinational circuits, sequential systems, and digital design.', '2026-03-19 07:05:50', '2026-03-19 07:05:50'),
(26, 'ELEC30001', 'Power Systems Engineering', 3, 40, NULL, 'Focuses on generation, transmission, distribution, and analysis of electrical power systems.', '2026-03-19 07:05:50', '2026-03-19 07:05:50'),
(27, 'ELEC30002', 'Control Systems', 3, 40, NULL, 'Covers feedback systems, controllers, stability, and dynamic system behaviour.', '2026-03-19 07:05:50', '2026-03-19 07:05:50'),
(28, 'ELEC30003', 'Electrical Engineering Project', 3, 50, NULL, 'Provides independent project work involving design, analysis, or implementation of electrical systems.', '2026-03-19 07:05:50', '2026-03-19 07:05:50'),
(29, 'CIVL10001', 'Construction Materials', 1, 40, NULL, 'Introduces key construction materials, their properties, uses, and performance characteristics.', '2026-03-19 07:05:50', '2026-03-19 07:05:50'),
(30, 'CIVL10002', 'Surveying and Measurement', 1, 40, NULL, 'Covers land measurement, surveying techniques, and interpretation of site data.', '2026-03-19 07:05:50', '2026-03-19 07:05:50'),
(31, 'CIVL10003', 'Engineering Mathematics for Civil Engineering', 1, 40, NULL, 'Develops mathematical methods required for civil engineering calculations and modelling.', '2026-03-19 07:05:50', '2026-03-19 07:05:50'),
(32, 'CIVL20001', 'Structural Analysis', 2, 40, NULL, 'Examines forces, load paths, and behaviour of structural elements under stress.', '2026-03-19 07:05:50', '2026-03-19 07:05:50'),
(33, 'CIVL30001', 'Transportation Engineering', 3, 40, NULL, 'Covers transport systems, road design, traffic engineering, and infrastructure planning.', '2026-03-19 07:05:50', '2026-03-19 07:05:50'),
(34, 'CIVL30002', 'Construction Project Management', 3, 40, NULL, 'Focuses on planning, scheduling, budgeting, and managing construction projects.', '2026-03-19 07:05:50', '2026-03-19 07:05:50'),
(35, 'CIVL30003', 'Civil Engineering Project', 3, 50, NULL, 'Provides independent project work in civil design, construction, or infrastructure analysis.', '2026-03-19 07:05:50', '2026-03-19 07:05:50'),
(36, 'ITEC10001', 'IT Fundamentals', 1, 40, NULL, 'Introduces core information technology concepts, systems, and digital infrastructure.', '2026-03-19 07:05:50', '2026-03-19 07:05:50'),
(37, 'ITEC10002', 'Networking Essentials', 1, 40, NULL, 'Covers basic network models, protocols, devices, and connectivity principles.', '2026-03-19 07:05:50', '2026-03-19 07:05:50'),
(38, 'ITEC10003', 'Database Fundamentals', 1, 40, NULL, 'Introduces database concepts, data modelling, and basic relational database use.', '2026-03-19 07:05:50', '2026-03-19 07:05:50'),
(39, 'ITEC20001', 'Systems Administration', 2, 40, NULL, 'Focuses on operating system administration, user management, and service maintenance.', '2026-03-19 07:05:50', '2026-03-19 07:05:50'),
(40, 'ITEC30001', 'Cloud Computing', 3, 40, NULL, 'Introduces cloud service models, infrastructure concepts, and modern deployment practices.', '2026-03-19 07:05:50', '2026-03-19 07:05:50'),
(41, 'ITEC30002', 'IT Service Management', 3, 40, NULL, 'Explores service delivery, support processes, governance, and IT operational best practices.', '2026-03-19 07:05:50', '2026-03-19 07:05:50'),
(42, 'ITEC30003', 'Information Technology Project', 3, 50, NULL, 'Provides project-based experience solving a practical IT systems or infrastructure problem.', '2026-03-19 07:05:50', '2026-03-19 07:05:50'),
(43, 'FINA10001', 'Principles of Accounting', 1, 40, NULL, 'Introduces financial recording, basic reporting, and accounting principles.', '2026-03-19 07:05:50', '2026-03-19 07:05:50'),
(44, 'FINA10002', 'Business Finance Fundamentals', 1, 40, NULL, 'Covers financial concepts, budgeting, costing, and the role of finance in organisations.', '2026-03-19 07:05:50', '2026-03-19 07:05:50'),
(45, 'FINA10003', 'Quantitative Methods for Finance', 1, 40, NULL, 'Develops numerical and analytical methods used in accounting and financial decision-making.', '2026-03-19 07:05:50', '2026-03-19 07:05:50'),
(46, 'FINA20001', 'Management Accounting', 2, 40, NULL, 'Explores cost behaviour, budgeting, variance analysis, and internal financial reporting.', '2026-03-19 07:05:50', '2026-03-19 07:05:50'),
(47, 'FINA30001', 'Auditing and Assurance', 3, 40, NULL, 'Covers audit processes, controls, assurance frameworks, and professional responsibilities.', '2026-03-19 07:05:50', '2026-03-19 07:05:50'),
(48, 'FINA30002', 'Corporate Finance', 3, 40, NULL, 'Focuses on investment decisions, capital structure, risk, and business finance strategy.', '2026-03-19 07:05:50', '2026-03-19 07:05:50'),
(49, 'FINA30003', 'Finance and Accounting Project', 3, 50, NULL, 'Provides independent investigation of a finance or accounting problem using appropriate methods.', '2026-03-19 07:05:50', '2026-03-19 07:05:50'),
(50, 'HOSP10001', 'Introduction to Hospitality', 1, 40, NULL, 'Introduces the hospitality industry, customer service standards, and operational contexts.', '2026-03-19 07:05:50', '2026-03-19 07:05:50'),
(51, 'HOSP10002', 'Front Office Operations', 1, 40, NULL, 'Covers reception, reservations, guest services, and front office procedures.', '2026-03-19 07:05:50', '2026-03-19 07:05:50'),
(52, 'HOSP10003', 'Food and Beverage Service', 1, 40, NULL, 'Examines food service operations, service standards, and hospitality delivery.', '2026-03-19 07:05:50', '2026-03-19 07:05:50'),
(53, 'HOSP20001', 'Hotel Operations Management', 2, 40, NULL, 'Focuses on managing hotel departments, service quality, and operational efficiency.', '2026-03-19 07:05:50', '2026-03-19 07:05:50'),
(54, 'HOSP30001', 'Strategic Hospitality Management', 3, 40, NULL, 'Examines long-term management strategy, competitiveness, and innovation in hospitality.', '2026-03-19 07:05:50', '2026-03-19 07:05:50'),
(55, 'HOSP30002', 'Hospitality Marketing', 3, 40, NULL, 'Focuses on marketing principles, branding, promotion, and customer engagement in hospitality.', '2026-03-19 07:05:50', '2026-03-19 07:05:50'),
(56, 'HOSP30003', 'Hospitality Management Project', 3, 50, NULL, 'Provides independent project work related to hospitality operations, strategy, or service improvement.', '2026-03-19 07:05:50', '2026-03-19 07:05:50'),
(57, 'HEAL10001', 'Foundations of Health Sciences', 1, 40, NULL, 'Introduces core concepts in health, wellbeing, healthcare systems, and scientific study.', '2026-03-19 07:05:50', '2026-03-19 07:05:50'),
(58, 'HEAL10002', 'Human Anatomy and Physiology', 1, 40, NULL, 'Covers structure and function of major body systems relevant to health sciences.', '2026-03-19 07:05:50', '2026-03-19 07:05:50'),
(59, 'HEAL10003', 'Health Communication', 1, 40, NULL, 'Develops communication skills for healthcare, support services, and public health contexts.', '2026-03-19 07:05:50', '2026-03-19 07:05:50'),
(60, 'HEAL20001', 'Public Health Principles', 2, 40, NULL, 'Examines population health, prevention strategies, health inequalities, and policy.', '2026-03-19 07:05:50', '2026-03-19 07:05:50'),
(61, 'HEAL30001', 'Health Promotion', 3, 40, NULL, 'Focuses on planning and evaluating health improvement strategies for communities and groups.', '2026-03-19 07:05:50', '2026-03-19 07:05:50'),
(62, 'HEAL30002', 'Healthcare Policy and Practice', 3, 40, NULL, 'Explores healthcare systems, policy development, governance, and service delivery.', '2026-03-19 07:05:50', '2026-03-19 07:05:50'),
(63, 'HEAL30003', 'Health Sciences Project', 3, 50, NULL, 'Provides independent project work in health research, promotion, or service evaluation.', '2026-03-19 07:05:50', '2026-03-19 07:05:50'),
(64, 'MKTG10001', 'Principles of Marketing', 1, 40, NULL, 'Introduces marketing concepts, customer needs, segmentation, and promotional activity.', '2026-03-19 07:05:50', '2026-03-19 07:05:50'),
(65, 'MKTG10002', 'Introduction to Media and Communication', 1, 40, NULL, 'Covers communication theory, media channels, and the role of communication in society.', '2026-03-19 07:05:50', '2026-03-19 07:05:50'),
(66, 'MKTG10003', 'Digital Content Fundamentals', 1, 40, NULL, 'Develops content creation skills for digital platforms, campaigns, and brand messaging.', '2026-03-19 07:05:50', '2026-03-19 07:05:50'),
(67, 'MKTG20001', 'Consumer Behaviour', 2, 40, NULL, 'Examines how individuals and groups make purchasing and communication decisions.', '2026-03-19 07:05:50', '2026-03-19 07:05:50'),
(68, 'MKTG30001', 'Strategic Marketing Management', 3, 40, NULL, 'Focuses on long-term marketing planning, positioning, and competitive strategy.', '2026-03-19 07:05:50', '2026-03-19 07:05:50'),
(69, 'MKTG30002', 'Integrated Marketing Communications', 3, 40, NULL, 'Explores coordinated communication across multiple channels for consistent brand impact.', '2026-03-19 07:05:50', '2026-03-19 07:05:50'),
(70, 'MKTG30003', 'Marketing and Communications Project', 3, 50, NULL, 'Provides independent project work involving campaign design, market analysis, or communication strategy.', '2026-03-19 07:05:50', '2026-03-19 07:05:50');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
