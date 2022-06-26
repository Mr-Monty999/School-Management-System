-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 26, 2022 at 12:22 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `school_database`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `admin_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `school_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `classes`
--

CREATE TABLE `classes` (
  `id` int(11) NOT NULL,
  `class_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `school_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `id` int(11) NOT NULL,
  `employe_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `employe_address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `employe_phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `employe_salary` double NOT NULL,
  `employe_birthdate` date NOT NULL,
  `employe_hiredate` date NOT NULL,
  `employe_genre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `employe_photo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `job_id` int(11) DEFAULT NULL,
  `school_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `employees_jobs`
--

CREATE TABLE `employees_jobs` (
  `id` int(11) NOT NULL,
  `job_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `school_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `parents`
--

CREATE TABLE `parents` (
  `id` int(11) NOT NULL,
  `parent_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `parent_address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `parent_job` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `parent_genre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `parent_phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `parent_photo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `school_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `schools`
--

CREATE TABLE `schools` (
  `id` int(11) NOT NULL,
  `school_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `school_owner` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `school_address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `school_phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `school_year_price` double NOT NULL DEFAULT 0,
  `school_logo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` int(11) NOT NULL,
  `student_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `student_address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `student_birthdate` date NOT NULL,
  `student_registered_date` date NOT NULL,
  `student_paid_price` double NOT NULL,
  `student_genre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `student_photo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `class_id` int(11) DEFAULT NULL,
  `school_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `subjects`
--

CREATE TABLE `subjects` (
  `id` int(11) NOT NULL,
  `subject_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `class_id` int(11) DEFAULT NULL,
  `school_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `teachers`
--

CREATE TABLE `teachers` (
  `id` int(11) NOT NULL,
  `teacher_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `teacher_address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `teacher_phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `teacher_salary` double NOT NULL,
  `teacher_genre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `teacher_photo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `teacher_birth_date` date NOT NULL,
  `teacher_hire_date` date NOT NULL,
  `school_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `teacher_subject`
--

CREATE TABLE `teacher_subject` (
  `teacher_id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `school_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD KEY `school_id` (`school_id`);

--
-- Indexes for table `classes`
--
ALTER TABLE `classes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `class_name` (`class_name`),
  ADD KEY `school_id` (`school_id`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`id`),
  ADD KEY `admin_name` (`employe_name`),
  ADD KEY `school_id` (`school_id`),
  ADD KEY `job_id` (`job_id`);

--
-- Indexes for table `employees_jobs`
--
ALTER TABLE `employees_jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `school_id` (`school_id`);

--
-- Indexes for table `parents`
--
ALTER TABLE `parents`
  ADD PRIMARY KEY (`id`),
  ADD KEY `parent_name` (`parent_name`),
  ADD KEY `school_id` (`school_id`);

--
-- Indexes for table `schools`
--
ALTER TABLE `schools`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `school_name_2` (`school_name`),
  ADD KEY `school_name` (`school_name`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`),
  ADD KEY `student_name` (`student_name`),
  ADD KEY `parent_id` (`parent_id`),
  ADD KEY `class_id` (`class_id`),
  ADD KEY `school_id` (`school_id`);

--
-- Indexes for table `subjects`
--
ALTER TABLE `subjects`
  ADD PRIMARY KEY (`id`),
  ADD KEY `class_id` (`class_id`),
  ADD KEY `subject_name` (`subject_name`),
  ADD KEY `school_id` (`school_id`);

--
-- Indexes for table `teachers`
--
ALTER TABLE `teachers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `teacher_name` (`teacher_name`),
  ADD KEY `school_id` (`school_id`);

--
-- Indexes for table `teacher_subject`
--
ALTER TABLE `teacher_subject`
  ADD PRIMARY KEY (`teacher_id`,`subject_id`),
  ADD KEY `subject_id` (`subject_id`),
  ADD KEY `school_id` (`school_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `classes`
--
ALTER TABLE `classes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `employees_jobs`
--
ALTER TABLE `employees_jobs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `parents`
--
ALTER TABLE `parents`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `schools`
--
ALTER TABLE `schools`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `subjects`
--
ALTER TABLE `subjects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `teachers`
--
ALTER TABLE `teachers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `admins`
--
ALTER TABLE `admins`
  ADD CONSTRAINT `admins_ibfk_1` FOREIGN KEY (`school_id`) REFERENCES `schools` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `classes`
--
ALTER TABLE `classes`
  ADD CONSTRAINT `classes_ibfk_1` FOREIGN KEY (`school_id`) REFERENCES `schools` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `employees`
--
ALTER TABLE `employees`
  ADD CONSTRAINT `employees_ibfk_1` FOREIGN KEY (`school_id`) REFERENCES `schools` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `employees_ibfk_2` FOREIGN KEY (`job_id`) REFERENCES `employees_jobs` (`id`) ON DELETE SET NULL ON UPDATE SET NULL;

--
-- Constraints for table `employees_jobs`
--
ALTER TABLE `employees_jobs`
  ADD CONSTRAINT `employees_jobs_ibfk_1` FOREIGN KEY (`school_id`) REFERENCES `schools` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `parents`
--
ALTER TABLE `parents`
  ADD CONSTRAINT `parents_ibfk_1` FOREIGN KEY (`school_id`) REFERENCES `schools` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `students`
--
ALTER TABLE `students`
  ADD CONSTRAINT `students_ibfk_2` FOREIGN KEY (`parent_id`) REFERENCES `parents` (`id`) ON DELETE SET NULL ON UPDATE SET NULL,
  ADD CONSTRAINT `students_ibfk_3` FOREIGN KEY (`class_id`) REFERENCES `classes` (`id`) ON DELETE SET NULL ON UPDATE SET NULL,
  ADD CONSTRAINT `students_ibfk_4` FOREIGN KEY (`school_id`) REFERENCES `schools` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `subjects`
--
ALTER TABLE `subjects`
  ADD CONSTRAINT `subjects_ibfk_3` FOREIGN KEY (`class_id`) REFERENCES `classes` (`id`) ON DELETE SET NULL ON UPDATE SET NULL,
  ADD CONSTRAINT `subjects_ibfk_4` FOREIGN KEY (`school_id`) REFERENCES `schools` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `teachers`
--
ALTER TABLE `teachers`
  ADD CONSTRAINT `teachers_ibfk_1` FOREIGN KEY (`school_id`) REFERENCES `schools` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `teacher_subject`
--
ALTER TABLE `teacher_subject`
  ADD CONSTRAINT `teacher_subject_ibfk_1` FOREIGN KEY (`teacher_id`) REFERENCES `teachers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `teacher_subject_ibfk_2` FOREIGN KEY (`subject_id`) REFERENCES `subjects` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `teacher_subject_ibfk_3` FOREIGN KEY (`school_id`) REFERENCES `schools` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
