-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 10, 2022 at 04:34 PM
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
-- Database: `imslp`
--

-- --------------------------------------------------------

--
-- Table structure for table `imslp_sheets`
--

CREATE TABLE `imslp_sheets` (
  `sheets_title` varchar(255) NOT NULL,
  `sheets_composer` varchar(255) NOT NULL,
  `sheets_genre` varchar(255) NOT NULL,
  `sheets_instrument` varchar(255) NOT NULL,
  `sheets_instrument2` varchar(255) NOT NULL,
  `sheets_instrument3` varchar(255) NOT NULL,
  `sheets_difficulty` varchar(255) NOT NULL,
  `sheets_file` varchar(255) NOT NULL,
  `sheets_pdf` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `imslp_sheets`
--

INSERT INTO `imslp_sheets` (`sheets_title`, `sheets_composer`, `sheets_genre`, `sheets_instrument`, `sheets_instrument2`, `sheets_instrument3`, `sheets_difficulty`, `sheets_file`, `sheets_pdf`) VALUES
('Band Of Brothers', 'Michael Kamen', 'Movies', 'Accordion', '', '', '1', '', '');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
