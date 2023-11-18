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
-- Table structure for table `register`
--

CREATE TABLE `register` (
  `studName` varchar(40) NOT NULL,
  `courseCode` varchar(40) NOT NULL,
  `subjectCode` varchar(40) NOT NULL,
  `subjectName` varchar(40) NOT NULL,
  `creditHour` int(100) NOT NULL,
  `sem` int(100) NOT NULL,
  `grade` varchar(10) NOT NULL,
  `status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `register`
--

INSERT INTO `register` (`studName`, `courseCode`, `subjectCode`, `subjectName`, `creditHour`, `sem`, `grade`, `status`) VALUES
('NURUL AAIN BINTI ABDUL ADL', 'CC101', 'SWC2373', 'EMERGING TECHNOLOGY', 3, 4, 'A+', 'PAC'),
('NURUL AAIN BINTI ABDUL ADL', 'CC101', 'SWC2363', 'WEB APPLICATION DEVELOPMENT', 3, 4, 'A+', 'PAC'),
('MUHAMMAD NURHAYAT ABDUL HALIM', 'CC101', 'SWC2363', 'WEB APPLICATION DEVELOPMENT', 3, 4, 'A+', 'PAC'),
('NURUL AAIN BINTI ABDUL ADL', 'CC101', 'NWC3053', 'COMPUTER NETWORK SECURITY', 3, 4, 'A+', 'PAC'),
('NURUL AIN BINTI AHMAD NASIR', 'AA103', 'ACC2033', 'INTRODUCTION TO FINANCIAL REPORTING AND ', 3, 4, 'A+', 'PAC'),
('NURUL AIN BINTI AHMAD NASIR', 'AA103', 'FIN2023', 'FINANCIAL MANAGEMENT 2', 3, 4, 'A+', 'PAC'),
('NURUL AIN BINTI AHMAD NASIR', 'AA103', 'LAW2013', 'COMPANY LAW', 3, 4, 'A+', 'PAC'),
('NURUL AIN BINTI AHMAD NASIR', 'AA103', 'MAC2023', 'COST AND MANAGEMENT ACCOUNTING', 3, 4, 'A+', 'PAC'),
('NURUL AIN BINTI AHMAD NASIR', 'AA103', 'TAX2013', 'TAXATION 1', 3, 4, 'A+', 'PAC'),
('NURUL AAIN BINTI ABDUL ADL', 'CC101', 'SWC2353', 'WEB DESIGN', 3, 4, 'A+', 'PAC');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
