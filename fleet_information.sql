-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Oct 04, 2018 at 08:43 AM
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
  `orderID` int(11) NOT NULL,
  `licenseNumber` varchar(255) NOT NULL,
  `startDate` varchar(255) NOT NULL,
  `endDate` varchar(255) NOT NULL,
  `userID` varchar(255) NOT NULL
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
('BDE463', 'Tesla', 'Model S', 5, 1),
('BNW013', 'Volvo', 'S90', 5, 1),
('BWE530', 'Volvo', 'V40', 5, 1),
('BWS902', 'Volvo', 'V40', 5, 1),
('CEA328', 'Tesla', 'Roadster', 2, 1),
('DQA442', 'Opel', 'Vivaro', 9, 1),
('ERB203', 'Audi', 'Q7', 7, 1),
('GTE432', 'Audi', 'TT', 2, 1),
('HHW746', 'Tesla', 'Model X', 7, 1),
('IED923', 'Audi', 'Q7', 5, 1),
('IEK382', 'Tesla', 'Model S', 5, 1),
('JKI321', 'Volvo', 'XC90', 5, 1),
('KLA821', 'Tesla', 'Model X', 6, 1),
('KLW531', 'Volvo', 'XC90', 5, 1),
('OEB193', 'Tesla', 'Model X', 6, 1),
('OES930', 'Audi', 'Q7', 5, 1),
('PRE392', 'Audi', 'Q7', 7, 1),
('UBD738', 'Audi', 'TT', 2, 1),
('UWU227', 'Tesla', 'Model X', 7, 1),
('UZO039', 'Opel', 'Vivaro', 9, 1),
('VQW952', 'Tesla', 'Roadster', 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `orderhistory`
--

CREATE TABLE `orderhistory` (
  `orderID` int(11) NOT NULL,
  `licenseNumber` varchar(255) DEFAULT NULL,
  `startDate` varchar(255) DEFAULT NULL,
  `endDate` varchar(255) DEFAULT NULL,
  `userID` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `userID` int(11) NOT NULL,
  `userFirst` varchar(256) NOT NULL,
  `userLast` varchar(256) NOT NULL,
  `userPhone` varchar(256) NOT NULL,
  `userEmail` varchar(256) NOT NULL,
  `userPass` varchar(256) NOT NULL,
  `Admin` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userID`, `userFirst`, `userLast`, `userPhone`, `userEmail`, `userPass`, `Admin`) VALUES
(0, '', '', '', 'Admin', '$2y$10$DsxIRZBwT35MRir2cZDThuM3Vw.o4t0Pcn5of6kK6mLPELvv/L1n6', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`orderID`);

--
-- Indexes for table `cars`
--
ALTER TABLE `cars`
  ADD PRIMARY KEY (`licenseNumber`);

--
-- Indexes for table `orderhistory`
--
ALTER TABLE `orderhistory`
  ADD PRIMARY KEY (`orderID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userID`),
  ADD UNIQUE KEY `user_email` (`userEmail`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `orderID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=253;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=93;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
