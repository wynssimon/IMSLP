-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 10, 2022 at 03:45 PM
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
-- Table structure for table `imslp_users`
--

CREATE TABLE `imslp_users` (
  `users_ID` int(11) NOT NULL,
  `users_username` varchar(255) DEFAULT NULL,
  `users_password` varchar(255) DEFAULT NULL,
  `users_name` text DEFAULT NULL,
  `users_email` text DEFAULT NULL,
  `users_permissions` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `imslp_users`
--

INSERT INTO `imslp_users` (`users_ID`, `users_username`, `users_password`, `users_name`, `users_email`, `users_permissions`) VALUES
(1, 'Simonwyns', '123456789', 'simon wyns', 'wynssimonw@gmail.com', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `imslp_users`
--
ALTER TABLE `imslp_users`
  ADD PRIMARY KEY (`users_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `imslp_users`
--
ALTER TABLE `imslp_users`
  MODIFY `users_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
