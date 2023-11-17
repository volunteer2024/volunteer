-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 09, 2023 at 07:41 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `volunteer`
--

-- --------------------------------------------------------

--
-- Table structure for table `complaints`
--

CREATE TABLE `complaints` (
  `id` int(11) NOT NULL,
  `name` text DEFAULT NULL,
  `email` text DEFAULT NULL,
  `message` text DEFAULT NULL,
  `msg_date` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `complaints`
--

INSERT INTO `complaints` (`id`, `name`, `email`, `message`, `msg_date`) VALUES
(1, 'gd', 'hdfh@g', 'hdg', '2023-10-11 23:03:01'),
(2, 'gd', 'hdfh@g', 'hdg', '2023-10-11 23:03:01'),
(3, 'Aziz aladany', 'admin@gmail.com', 'ghh', '2023-11-07 16:45:02');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `type` text DEFAULT 'student',
  `info` text DEFAULT '',
  `hours_number` int(11) DEFAULT 0,
  `school_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `phone`, `password`, `type`, `info`, `hours_number`, `school_id`) VALUES
(1, 't', 't@t.com', '4', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'org', 'gsg', 23, 0),
(2, 's', 's@s.com', '4', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'org', 'ghs', 0, 0),
(6, 'organize1', 'organize1@gmail.com', '0500618018', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'org', '', 0, 0),
(7, 'Administrator', 'admin123@gmail.com', '0537657098', 'f865b53623b121fd34ee5426c792e5c33af8c227', 'admin', '', 0, 0),
(11, 'School 1', 'school1@gmail.com', '0500618018', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'school', 'This First School Account For Test', 0, 0),
(13, 'School 2', 'school2@gmail.com', '0537657098', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'school', 'This Second School Account For Test', 0, 0),
(23, 'reem', 'reem@gmail.com', '0500618018', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'student', '', 18, 11),
(25, 'student1', 'student1@uj.edu.sa', '0537657098', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'student', '', 0, 11);

-- --------------------------------------------------------

--
-- Table structure for table `volunteering_categories`
--

CREATE TABLE `volunteering_categories` (
  `id` int(11) NOT NULL,
  `name` text DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `seats_number` int(11) DEFAULT 0,
  `seats_reserved` int(11) DEFAULT 0,
  `skills` text DEFAULT '',
  `hours_number` int(11) DEFAULT 0,
  `user_id` int(11) NOT NULL,
  `img_url` text DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `volunteering_categories`
--

INSERT INTO `volunteering_categories` (`id`, `name`, `start_date`, `end_date`, `seats_number`, `seats_reserved`, `skills`, `hours_number`, `user_id`, `img_url`) VALUES
(9, 'نظافة الجامعة', '2023-10-26', '2023-10-28', 15, 2, 'any', 10, 1, ''),
(10, 'مساعدة', '2023-10-25', '2023-10-28', 54, 3, 'any', 19, 1, ''),
(19, 'نظافة الجامعة', '2023-10-25', '2023-10-28', 55, 3, 'gh', 546, 6, 'img_4721187.png');

-- --------------------------------------------------------

--
-- Table structure for table `volunteering_orders`
--

CREATE TABLE `volunteering_orders` (
  `id` int(11) NOT NULL,
  `category_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `state` text DEFAULT '',
  `note` text DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `volunteering_orders`
--

INSERT INTO `volunteering_orders` (`id`, `category_id`, `user_id`, `state`, `note`) VALUES
(14, 19, 23, '', '');

-- --------------------------------------------------------

--
-- Table structure for table `volunteersorganizationstatus`
--

CREATE TABLE `volunteersorganizationstatus` (
  `Id` int(11) NOT NULL,
  `org_id` int(11) NOT NULL,
  `school_id` int(11) NOT NULL,
  `status` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `volunteersorganizationstatus`
--

INSERT INTO `volunteersorganizationstatus` (`Id`, `org_id`, `school_id`, `status`) VALUES
(1, 1, 11, 'rejected'),
(2, 6, 11, 'accepted');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `complaints`
--
ALTER TABLE `complaints`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `complaints_id_uindex` (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `volunteering_categories`
--
ALTER TABLE `volunteering_categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `volunteering_categories_users_id_fk` (`user_id`);

--
-- Indexes for table `volunteering_orders`
--
ALTER TABLE `volunteering_orders`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `volunteering_orders_id_uindex` (`id`),
  ADD KEY `volunteering_orders_volunteering_categories_id_fk` (`category_id`),
  ADD KEY `Student_VolunteeringOrders_FK` (`user_id`);

--
-- Indexes for table `volunteersorganizationstatus`
--
ALTER TABLE `volunteersorganizationstatus`
  ADD PRIMARY KEY (`Id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `complaints`
--
ALTER TABLE `complaints`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `volunteering_categories`
--
ALTER TABLE `volunteering_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `volunteering_orders`
--
ALTER TABLE `volunteering_orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `volunteersorganizationstatus`
--
ALTER TABLE `volunteersorganizationstatus`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `volunteering_categories`
--
ALTER TABLE `volunteering_categories`
  ADD CONSTRAINT `volunteering_categories_users_id_fk` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `volunteering_orders`
--
ALTER TABLE `volunteering_orders`
  ADD CONSTRAINT `Student_VolunteeringOrders_FK` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `volunteering_orders_volunteering_categories_id_fk` FOREIGN KEY (`category_id`) REFERENCES `volunteering_categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
