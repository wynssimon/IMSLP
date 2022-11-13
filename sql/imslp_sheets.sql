-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 13, 2022 at 04:03 PM
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
  `sheets_ID` int(255) NOT NULL,
  `sheets_title` varchar(255) NOT NULL,
  `sheets_composer` varchar(255) NOT NULL,
  `sheets_genre` varchar(255) NOT NULL,
  `sheets_instrument1` varchar(255) NOT NULL,
  `sheets_instrument2` varchar(255) NOT NULL,
  `sheets_instrument3` varchar(255) NOT NULL,
  `sheets_instrument4` varchar(255) NOT NULL,
  `sheets_instrument5` varchar(255) NOT NULL,
  `sheets_img` varchar(255) NOT NULL,
  `sheets_xml` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `imslp_sheets`
--
ALTER TABLE `imslp_sheets`
  ADD PRIMARY KEY (`sheets_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `imslp_sheets`
--
ALTER TABLE `imslp_sheets`
  MODIFY `sheets_ID` int(255) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
