-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 25, 2025 at 10:30 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `consoles`
--

-- --------------------------------------------------------

--
-- Table structure for table `console`
--

CREATE TABLE `console` (
  `console_id` int(11) NOT NULL,
  `console_name` text NOT NULL,
  `release_date` text NOT NULL,
  `controller_no` int(11) NOT NULL,
  `manufacturer` text NOT NULL,
  `bits` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `console`
--

INSERT INTO `console` (`console_id`, `console_name`, `release_date`, `controller_no`, `manufacturer`, `bits`) VALUES
(1, 'nintendo', '01/01/2003', 4, 'nintendo', 64),
(2, 'PlayStation 2', '2000-03-04', 2, 'Sony', 128),
(3, 'Xbox', '2001-11-15', 4, 'Microsoft', 64),
(4, 'Sega Dreamcast', '1999-09-09', 4, 'Sega', 128),
(5, 'GameCube', '2001-11-18', 4, 'Nintendo', 128),
(6, 'PlayStation', '1994-12-03', 2, 'Sony', 32);

-- --------------------------------------------------------

--
-- Table structure for table `owns`
--

CREATE TABLE `owns` (
  `owns_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `console_id` int(11) NOT NULL,
  `buy_date` text NOT NULL,
  `link_date` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `owns`
--

INSERT INTO `owns` (`owns_id`, `user_id`, `console_id`, `buy_date`, `link_date`) VALUES
(1, 1, 1, '01/01/2023', '01/01/2023'),
(2, 1, 2, '2023-01-01', '2023-01-01'),
(3, 1, 3, '2023-01-01', '2023-01-01'),
(4, 1, 4, '2023-01-01', '2023-01-01'),
(5, 1, 5, '2023-01-01', '2023-01-01'),
(6, 1, 6, '2023-01-01', '2023-01-01'),
(7, 2, 2, '2024-02-20', '2024-02-20'),
(8, 2, 3, '2024-02-20', '2024-02-20'),
(9, 3, 4, '2024-03-25', '2024-03-25'),
(10, 3, 5, '2024-03-25', '2024-03-25'),
(11, 4, 3, '2024-04-12', '2024-04-12'),
(12, 4, 6, '2024-04-12', '2024-04-12'),
(13, 5, 2, '2024-05-10', '2024-05-10'),
(14, 5, 5, '2024-05-10', '2024-05-10'),
(15, 6, 4, '2024-06-01', '2024-06-01'),
(16, 6, 6, '2024-06-01', '2024-06-01');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `username` text NOT NULL,
  `password` text NOT NULL,
  `signupdate` text NOT NULL,
  `dob` text NOT NULL,
  `country` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `username`, `password`, `signupdate`, `dob`, `country`) VALUES
(1, 'nathan', 'password', '01/01/2024', '06/11/2007', 'united kingdom'),
(2, 'alex99', 'pass1234', '2024-02-15', '2005-08-21', 'canada'),
(3, 'jessica_m', 'mypassword', '2024-03-22', '2006-01-30', 'australia'),
(4, 'li_wei', 'securepass', '2024-04-10', '2004-05-12', 'china'),
(5, 'maria_g', 'qwertyui', '2024-05-05', '2003-11-09', 'spain'),
(6, 'david_k', 'letmein123', '2024-06-18', '2002-07-25', 'germany');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `console`
--
ALTER TABLE `console`
  ADD PRIMARY KEY (`console_id`);

--
-- Indexes for table `owns`
--
ALTER TABLE `owns`
  ADD PRIMARY KEY (`owns_id`),
  ADD KEY `user_id` (`user_id`,`console_id`),
  ADD KEY `console_id` (`console_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `console`
--
ALTER TABLE `console`
  MODIFY `console_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `owns`
--
ALTER TABLE `owns`
  MODIFY `owns_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `owns`
--
ALTER TABLE `owns`
  ADD CONSTRAINT `owns_ibfk_1` FOREIGN KEY (`console_id`) REFERENCES `console` (`console_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `owns_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
