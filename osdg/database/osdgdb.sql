-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 28, 2025 at 02:37 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `osdgdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `qualityrecords`
--

CREATE TABLE `qualityrecords` (
  `id` int(11) NOT NULL,
  `test_date` datetime DEFAULT current_timestamp(),
  `tester_name` varchar(100) NOT NULL,
  `pH_level` decimal(4,2) NOT NULL,
  `turbidity` decimal(5,2) NOT NULL,
  `contamination_status` enum('Safe','Contaminated') NOT NULL,
  `temperature` decimal(5,2) NOT NULL,
  `tds` decimal(6,2) NOT NULL,
  `chemical_composition` text DEFAULT NULL,
  `compliance_status` enum('Compliant','Non-Compliant') NOT NULL,
  `remarks` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `quantity_tested` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `qualityrecords`
--

INSERT INTO `qualityrecords` (`id`, `test_date`, `tester_name`, `pH_level`, `turbidity`, `contamination_status`, `temperature`, `tds`, `chemical_composition`, `compliance_status`, `remarks`, `created_at`, `quantity_tested`) VALUES
(1, '2025-03-18 01:17:39', '2', 99.99, 1.00, 'Safe', 25.00, 400.00, 'ph', 'Compliant', 'good', '2025-03-17 23:17:39', 30.00),
(2, '2025-03-18 02:01:05', '2', 8.00, 1.80, 'Contaminated', 20.00, 200.00, 'none', 'Non-Compliant', 'bad', '2025-03-18 00:01:05', 2.00);

-- --------------------------------------------------------

--
-- Table structure for table `userprofiles`
--

CREATE TABLE `userprofiles` (
  `profile_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `address` varchar(255) DEFAULT NULL,
  `gender` enum('Male','Female','Other') DEFAULT NULL,
  `birth_date` date DEFAULT NULL,
  `profile_picture` varchar(255) DEFAULT NULL,
  `bio` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `userprofiles`
--

INSERT INTO `userprofiles` (`profile_id`, `user_id`, `address`, `gender`, `birth_date`, `profile_picture`, `bio`, `created_at`, `updated_at`) VALUES
(1, 2, 'Kigali rwanda', 'Male', '2025-03-11', 'images/uploads/67d9fd85c1f78.png', 'Wou good', '2025-03-11 12:27:01', '2025-03-18 23:11:01'),
(14, 16, 'Kigali rwanda', 'Male', '2025-03-28', 'images/uploads/67e6a163d4a62.jpg', '11', '2025-03-28 13:17:23', '2025-03-28 13:17:23');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `title` varchar(100) NOT NULL,
  `user_level` enum('Admin','Qualitycontrolofficer','Tester','Regulatorycomplianceofficer') NOT NULL,
  `password` varchar(255) NOT NULL,
  `status` enum('Active','Inactive') DEFAULT 'Active',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstname`, `lastname`, `email`, `phone`, `title`, `user_level`, `password`, `status`, `created_at`, `updated_at`) VALUES
(2, 'Umwiza', 'Estephie', 'jetaimetech@gmail.com', '+250787936791', 'Checking water quality before going out to markert', 'Admin', '$2y$10$Rn8/5fMSzqproENrhWbCxOqbvlv.3DQhSqbMD4HQ.31NoHq/tyeHi', 'Active', '2025-03-11 12:27:01', '2025-03-28 13:17:43'),
(16, 'Umutesi', 'sonia', 'intambwesoftware@gmail.com', '+250787936792', 'Checking water quality before going out to markert', 'Qualitycontrolofficer', '$2y$10$7tp5NqqIk8aUddEm8JTtv.UDh2h1Hu5mUoMTCvv4F8hQcPTMtTf3u', 'Active', '2025-03-28 13:17:23', '2025-03-28 13:17:23');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `qualityrecords`
--
ALTER TABLE `qualityrecords`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `userprofiles`
--
ALTER TABLE `userprofiles`
  ADD PRIMARY KEY (`profile_id`),
  ADD UNIQUE KEY `user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `phone` (`phone`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `qualityrecords`
--
ALTER TABLE `qualityrecords`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `userprofiles`
--
ALTER TABLE `userprofiles`
  MODIFY `profile_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `userprofiles`
--
ALTER TABLE `userprofiles`
  ADD CONSTRAINT `userprofiles_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
