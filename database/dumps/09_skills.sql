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
-- Dumping data for table `skills`
--

INSERT INTO `skills` (`id`, `skill_category_id`, `name`, `description`, `created_at`, `updated_at`) VALUES
(1, 1, 'Programming', 'Ability to write, test, and maintain software code effectively.', '2026-03-19 07:31:45', '2026-03-19 07:31:45'),
(2, 1, 'System Configuration', 'Ability to configure and manage technical systems and environments.', '2026-03-19 07:31:45', '2026-03-19 07:31:45'),
(3, 1, 'Circuit Design', 'Ability to design and analyse electrical and electronic circuits.', '2026-03-19 07:31:45', '2026-03-19 07:31:45'),
(4, 1, 'Engineering Design', 'Ability to develop and evaluate technical designs for engineering solutions.', '2026-03-19 07:31:45', '2026-03-19 07:31:45'),
(5, 2, 'Data Analysis', 'Ability to examine data, identify patterns, and draw meaningful conclusions.', '2026-03-19 07:31:45', '2026-03-19 07:31:45'),
(6, 2, 'Critical Thinking', 'Ability to evaluate information logically and make reasoned judgments.', '2026-03-19 07:31:45', '2026-03-19 07:31:45'),
(7, 2, 'Financial Analysis', 'Ability to assess financial information for decision-making purposes.', '2026-03-19 07:31:45', '2026-03-19 07:31:45'),
(8, 2, 'Risk Assessment', 'Ability to identify, evaluate, and manage risks in academic or professional contexts.', '2026-03-19 07:31:45', '2026-03-19 07:31:45'),
(9, 3, 'Written Communication', 'Ability to communicate ideas clearly and effectively in writing.', '2026-03-19 07:31:45', '2026-03-19 07:31:45'),
(10, 3, 'Oral Presentation', 'Ability to present information clearly and confidently to an audience.', '2026-03-19 07:31:45', '2026-03-19 07:31:45'),
(11, 3, 'Professional Reporting', 'Ability to prepare structured reports suitable for academic or professional use.', '2026-03-19 07:31:45', '2026-03-19 07:31:45'),
(12, 3, 'Stakeholder Communication', 'Ability to communicate effectively with clients, teams, or stakeholders.', '2026-03-19 07:31:45', '2026-03-19 07:31:45'),
(13, 4, 'Laboratory Practice', 'Ability to perform structured practical activities safely and accurately.', '2026-03-19 07:31:45', '2026-03-19 07:31:45'),
(14, 4, 'Fieldwork Techniques', 'Ability to carry out practical work in field-based or real-world settings.', '2026-03-19 07:31:45', '2026-03-19 07:31:45'),
(15, 4, 'Equipment Handling', 'Ability to use specialised tools and equipment correctly and safely.', '2026-03-19 07:31:45', '2026-03-19 07:31:45'),
(16, 4, 'Operational Procedures', 'Ability to follow and apply practical operational processes effectively.', '2026-03-19 07:31:45', '2026-03-19 07:31:45'),
(17, 5, 'Research Design', 'Ability to plan and structure academic or applied research effectively.', '2026-03-19 07:31:45', '2026-03-19 07:31:45'),
(18, 5, 'Literature Review', 'Ability to locate, evaluate, and synthesise relevant academic or professional sources.', '2026-03-19 07:31:45', '2026-03-19 07:31:45'),
(19, 5, 'Data Collection', 'Ability to gather valid and relevant data using suitable methods.', '2026-03-19 07:31:45', '2026-03-19 07:31:45'),
(20, 5, 'Academic Investigation', 'Ability to conduct systematic investigation into a defined problem or topic.', '2026-03-19 07:31:45', '2026-03-19 07:31:45'),
(21, 6, 'Project Planning', 'Ability to plan tasks, timelines, and resources to achieve objectives.', '2026-03-19 07:31:45', '2026-03-19 07:31:45'),
(22, 6, 'Team Coordination', 'Ability to organise and support collaborative work within a group.', '2026-03-19 07:31:45', '2026-03-19 07:31:45'),
(23, 6, 'Resource Management', 'Ability to manage time, materials, or financial resources effectively.', '2026-03-19 07:31:45', '2026-03-19 07:31:45'),
(24, 6, 'Decision Making', 'Ability to make informed and effective management decisions.', '2026-03-19 07:31:45', '2026-03-19 07:31:45'),
(25, 7, 'Database Management', 'Ability to use and manage digital data systems effectively.', '2026-03-19 07:31:45', '2026-03-19 07:31:45'),
(26, 7, 'Spreadsheet Proficiency', 'Ability to organise, analyse, and present data using spreadsheet tools.', '2026-03-19 07:31:45', '2026-03-19 07:31:45'),
(27, 7, 'Digital Content Creation', 'Ability to create effective digital materials for communication or media use.', '2026-03-19 07:31:45', '2026-03-19 07:31:45'),
(28, 7, 'Cloud Platform Use', 'Ability to work with cloud-based tools, services, and environments.', '2026-03-19 07:31:45', '2026-03-19 07:31:45'),
(29, 8, 'Troubleshooting', 'Ability to identify issues and apply effective corrective actions.', '2026-03-19 07:31:45', '2026-03-19 07:31:45'),
(30, 8, 'Solution Design', 'Ability to design suitable solutions to academic, technical, or operational problems.', '2026-03-19 07:31:45', '2026-03-19 07:31:45'),
(31, 8, 'Adaptability', 'Ability to respond effectively to change, uncertainty, or new requirements.', '2026-03-19 07:31:45', '2026-03-19 07:31:45'),
(32, 8, 'Process Improvement', 'Ability to evaluate and improve workflows, methods, or systems.', '2026-03-19 07:31:45', '2026-03-19 07:31:45');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
