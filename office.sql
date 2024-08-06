-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 20, 2023 at 11:19 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `office`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`email`, `password`) VALUES
('admin@gmail.com', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

CREATE TABLE `attendance` (
  `id` int(11) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `employee_id` int(11) NOT NULL,
  `status` varchar(10) NOT NULL,
  `attendance_percentage` decimal(5,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `attendance`
--

INSERT INTO `attendance` (`id`, `date`, `time`, `employee_id`, `status`, `attendance_percentage`) VALUES
(47, '2023-05-28', '16:21:18', 1, 'Present', '100.00'),
(48, '2023-05-28', '16:21:18', 2, 'Present', '100.00'),
(49, '2023-05-28', '16:21:18', 3, 'Absent', '0.00'),
(50, '2023-05-28', '16:21:18', 8, 'Present', '100.00'),
(51, '2023-05-29', '07:31:47', 1, 'Present', '100.00'),
(52, '2023-05-29', '07:31:47', 2, 'Present', '100.00'),
(53, '2023-05-29', '07:31:47', 3, 'Absent', '0.00'),
(54, '2023-05-29', '07:31:47', 8, 'Present', '100.00'),
(87, '2023-06-03', '18:34:47', 1, 'Present', '100.00'),
(88, '2023-06-03', '18:34:47', 2, 'Present', '100.00'),
(89, '2023-06-03', '18:48:08', 3, 'Present', '0.00'),
(90, '2023-06-03', '18:34:47', 8, 'Present', '100.00'),
(91, '2023-06-05', '11:29:54', 1, 'Present', '100.00'),
(92, '2023-06-05', '11:29:54', 2, 'Present', '100.00'),
(93, '2023-06-05', '11:29:54', 3, 'Present', '100.00'),
(94, '2023-06-05', '11:29:54', 8, 'Present', '100.00'),
(95, '2023-06-05', '11:29:54', 10, 'Present', '100.00');

-- --------------------------------------------------------

--
-- Table structure for table `leaves`
--

CREATE TABLE `leaves` (
  `l_id` int(11) NOT NULL,
  `e_id` int(255) NOT NULL,
  `uname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `leave_type` varchar(255) NOT NULL DEFAULT 'leave_type',
  `from_date` date NOT NULL,
  `to_date` date NOT NULL,
  `reason` varchar(1000) NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `leaves`
--

INSERT INTO `leaves` (`l_id`, `e_id`, `uname`, `email`, `leave_type`, `from_date`, `to_date`, `reason`, `status`) VALUES
(4, 1, 'kittu', 'kittu@gmail.com', 'Casual Leave', '2023-05-05', '2023-05-06', 'emo', 'Approved'),
(5, 1, 'kittu', 'kittu@gmail.com', 'Casual Leave', '2023-05-11', '2023-05-12', 'personal', 'Approved'),
(6, 1, 'kittu', 'kittu@gmail.com', 'Personal Leave', '2023-05-18', '2023-05-27', 'emo nak', 'Rejected'),
(7, 1, 'kittu', 'kittu@gmail.com', 'Personal Leave', '2023-06-05', '2023-06-06', 'personal leave', 'Approved');

-- --------------------------------------------------------

--
-- Table structure for table `register`
--

CREATE TABLE `register` (
  `e_id` int(11) NOT NULL,
  `fname` varchar(255) NOT NULL,
  `uname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phno` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `gender` varchar(255) NOT NULL DEFAULT 'gender'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `register`
--

INSERT INTO `register` (`e_id`, `fname`, `uname`, `email`, `phno`, `password`, `gender`) VALUES
(1, 'kittu', 'kittu', 'kittu@gmail.com', '8179277785', '1267', 'Male'),
(2, 'jaanu', 'jaanu', 'jaanu@gmail.com', '1111', '1267', 'Female'),
(3, 'arvind', 'arvind', 'arvind@gmail.com', '123', '11', 'Male'),
(8, 'lakavath rathan chand', 'sonu', 'sonu@gmail.com', '7075970775', 'rathanchand', 'Male'),
(10, 'i pravallika', 'pravi', 'pravi@gmail.com', '8179277784', '1234567890', 'Male');

-- --------------------------------------------------------

--
-- Table structure for table `tasks`
--

CREATE TABLE `tasks` (
  `t_id` int(11) NOT NULL,
  `e_id` int(11) NOT NULL,
  `description` varchar(255) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `status` varchar(100) NOT NULL DEFAULT 'Not Started'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tasks`
--

INSERT INTO `tasks` (`t_id`, `e_id`, `description`, `start_date`, `end_date`, `status`) VALUES
(9, 1, 'king ', '2023-05-21', '2023-05-31', 'In-progress'),
(10, 0, 'hey hii', '2023-06-04', '2023-06-14', 'Not Started'),
(11, 0, 'office ', '2023-06-06', '2023-06-16', 'Not Started');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `attendance`
--
ALTER TABLE `attendance`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `leaves`
--
ALTER TABLE `leaves`
  ADD PRIMARY KEY (`l_id`);

--
-- Indexes for table `register`
--
ALTER TABLE `register`
  ADD PRIMARY KEY (`e_id`);

--
-- Indexes for table `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`t_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `attendance`
--
ALTER TABLE `attendance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=96;

--
-- AUTO_INCREMENT for table `leaves`
--
ALTER TABLE `leaves`
  MODIFY `l_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `register`
--
ALTER TABLE `register`
  MODIFY `e_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tasks`
--
ALTER TABLE `tasks`
  MODIFY `t_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
