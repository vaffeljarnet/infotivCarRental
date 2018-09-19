-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Sep 19, 2018 at 07:16 AM
-- Server version: 5.6.34-log
-- PHP Version: 7.2.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fleet_information`
--

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `licenseNumber` varchar(6) DEFAULT NULL,
  `startDate` varchar(10) DEFAULT NULL,
  `endDate` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `cars`
--

CREATE TABLE `cars` (
  `licenseNumber` varchar(6) NOT NULL,
  `make` varchar(255) NOT NULL,
  `model` varchar(255) NOT NULL,
  `passengers` int(11) NOT NULL,
  `availability` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cars`
--

INSERT INTO `cars` (`licenseNumber`, `make`, `model`, `passengers`, `availability`) VALUES
('BCD639', 'Volvo', 'S90', 5, 1),
('BDE463', 'Tesla', 'Model S', 5, 0),
('BNW013', 'Volvo', 'S90', 5, 1),
('BWE530', 'Volvo', 'V40', 5, 1),
('BWS902', 'Volvo', 'V40', 5, 1),
('IEK382', 'Tesla', 'Model S', 5, 1),
('ILE820', 'Tesla', 'Model S', 5, 1),
('JKI321', 'Volvo', 'XC90', 5, 1),
('KLW531', 'Volvo', 'XC90', 5, 1),
('LAW219', 'Volvo', 'V40', 5, 1),
('OLW672', 'Volvo', 'V40', 5, 1),
('PER352', 'Volvo', 'S90', 5, 1),
('PQS746', 'Volvo', 'S90', 5, 1),
('QOP532', 'Volvo', 'V40', 5, 1),
('RFU342', 'Volvo', 'XC90', 5, 1),
('TDS820', 'Volvo', 'XC90', 5, 1),
('TRE576', 'Volvo', 'XC90', 5, 1),
('UHE839', 'Tesla', 'Model S', 5, 1),
('YTE362', 'Tesla', 'Model S', 5, 1),
('YTR782', 'Volvo', 'S90', 5, 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `user_first` varchar(256) NOT NULL,
  `user_last` varchar(256) NOT NULL,
  `user_phone` varchar(256) NOT NULL,
  `user_email` varchar(256) NOT NULL,
  `user_pass` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_first`, `user_last`, `user_phone`, `user_email`, `user_pass`) VALUES
(55, 'test', 'TEST', '123321', 'test@email.se', '$2y$10$RP3vaQ9uYWZfsCBLo6pvIOotzMeWj7eS3ftg325aAlfPm710RuM6e');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cars`
--
ALTER TABLE `cars`
  ADD PRIMARY KEY (`licenseNumber`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `user_email` (`user_email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
