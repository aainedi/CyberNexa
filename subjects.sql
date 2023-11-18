-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 18, 2023 at 10:30 AM
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
-- Database: `cybernexa`
--

-- --------------------------------------------------------

--
-- Table structure for table `subjects`
--

CREATE TABLE `subjects` (
  `no` int(100) NOT NULL,
  `courseCode` varchar(20) NOT NULL,
  `subjectCode` varchar(40) NOT NULL,
  `subjectName` varchar(40) NOT NULL,
  `creditHour` varchar(40) NOT NULL,
  `sem` varchar(20) NOT NULL,
  `grade` varchar(10) NOT NULL,
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `subjects`
--

INSERT INTO `subjects` (`no`, `courseCode`, `subjectCode`, `subjectName`, `creditHour`, `sem`, `grade`, `status`) VALUES
(1, 'CC101', 'NWC1023', 'NETWORKING ESSENTIALS', '3', '4', 'A ', 'PAC'),
(2, 'CC101', 'NWC3053', 'COMPUTER NETWORK SECURITY', '3', '4', 'A', 'PAC'),
(3, 'CC101', 'SWC2353', 'WEB DESIGN', '3', '4', 'A ', 'PAC'),
(4, 'CC101', 'SWC2363', 'WEB APPLICATION DEVELOPMENT', '3', '4', 'A ', 'PAC'),
(5, 'CC101', 'SWC2373', 'EMERGING TECHNOLOGY', '3', '4', 'A ', 'PAC'),
(6, 'CC101', 'SWC3393', 'SYSTEM ANALYSIS AND DESIGN', '3', '4', 'A ', 'PAC'),
(7, 'AA103', 'ACC2033', 'INTRODUCTION TO FINANCIAL REPORTING AND ', '3', '4', 'A ', 'PAC'),
(8, 'AA103', 'FIN2023', 'FINANCIAL MANAGEMENT 2', '3', '4', 'A', 'PAC'),
(9, 'AA103', 'LAW2013', 'COMPANY LAW', '3', '4', 'A', 'PAC'),
(10, 'AA103', 'MAC2023', 'COST AND MANAGEMENT ACCOUNTING', '3', '4', 'A', 'PAC'),
(11, 'AA103', 'MPU2353', 'PENGAJIAN ISLAM 2', '3', '4', 'A', 'PAC'),
(12, 'AA103', 'TAX2013', 'TAXATION 1', '3', '4', 'A', 'PAC');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `subjects`
--
ALTER TABLE `subjects`
  ADD PRIMARY KEY (`no`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `subjects`
--
ALTER TABLE `subjects`
  MODIFY `no` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
