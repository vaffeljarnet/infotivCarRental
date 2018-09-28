-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Sep 28, 2018 at 11:15 AM
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

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`orderID`, `licenseNumber`, `startDate`, `endDate`, `userID`) VALUES
(239, 'ASD432', '2018-09-28', '2018-09-28', '85'),
(240, 'BDE463', '2018-09-28', '2018-09-28', '85'),
(241, 'BWE530', '2018-09-28', '2018-09-28', '85'),
(242, 'DSA321', '2018-09-28', '2018-09-28', '1');

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
('ASD432', 'audi', '123', 8, 1),
('BCD639', 'Volvo', 'S90', 5, 1),
('BDE463', 'Tesla', 'Model S', 5, 0),
('BNW013', 'Volvo', 'S90', 5, 1),
('BWE530', 'Volvo', 'V40', 5, 1),
('BWS902', 'Volvo', 'V40', 5, 1),
('DSA321', 'audi', 'a12', 7, 1),
('IEK382', 'Tesla', 'Model S', 5, 1),
('ILE820', 'Tesla', 'Model S', 5, 1),
('JKI321', 'Volvo', 'XC90', 5, 1),
('KLW531', 'Volvo', 'XC90', 5, 1),
('LAW219', 'Volvo', 'V40', 5, 1),
('OLW672', 'Volvo', 'V40', 5, 1),
('PER352', 'Volvo', 'S90', 5, 1),
('PQS746', 'Volvo', 'S90', 5, 1),
('QOP532', 'Volvo', 'V40', 5, 1),
('QWE123', 'audi', 'a12', 5, 1),
('RFU342', 'Volvo', 'XC90', 5, 1),
('TDS820', 'Volvo', 'XC90', 5, 1),
('TRE543', 'audi', 'a12', 8, 1),
('TRE576', 'Volvo', 'XC90', 5, 1),
('UHE839', 'Tesla', 'Model S', 5, 1),
('YTE362', 'Tesla', 'Model S', 5, 1),
('YTR782', 'Volvo', 'S90', 5, 1);

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

--
-- Dumping data for table `orderhistory`
--

INSERT INTO `orderhistory` (`orderID`, `licenseNumber`, `startDate`, `endDate`, `userID`) VALUES
(123, 'BCD639', '2018-09-24', '2018-09-24', '1'),
(207, 'JKI321', '2018-09-24', '2018-09-24', '1'),
(208, 'ASD432', '2018-09-25', '2018-09-25', '79'),
(209, 'BDE463', '2018-09-25', '2018-09-25', '79'),
(211, 'BWE530', '2018-09-25', '2018-09-25', '79'),
(212, 'BDE463', '2018-09-25', '2018-09-25', '1'),
(213, 'BCD639', '2018-09-25', '2018-09-25', '1'),
(214, 'BWS902', '2018-09-25', '2018-09-25', '1'),
(215, 'DSA321', '2018-09-25', '2018-09-25', '1'),
(223, 'DSA321', '2018-09-25', '2018-09-25', '1'),
(224, 'BCD639', '2018-09-25', '2018-09-25', '1'),
(225, 'BWE530', '2018-09-25', '2018-09-25', '1'),
(226, 'ASD432', '2018-09-25', '2018-09-25', '1'),
(227, 'ASD432', '2018-09-26', '2018-09-26', '1'),
(228, 'BDE463', '2018-09-26', '2018-09-26', '1'),
(229, 'BDE463', '2018-09-28', '2018-09-28', '1'),
(230, 'IEK382', '2018-09-28', '2018-09-28', '1'),
(231, 'ASD432', '2018-09-28', '2018-09-28', '86'),
(232, 'BWE530', '2018-09-28', '2018-09-28', '86'),
(233, 'DSA321', '2018-09-28', '2018-09-28', '87'),
(234, 'BDE463', '2018-09-28', '2018-09-28', '1'),
(235, 'ASD432', '2018-09-28', '2018-09-28', '85'),
(236, 'BWE530', '2018-09-28', '2018-09-28', '85');

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
(0, '', '', '', 'Admin', '$2y$10$DsxIRZBwT35MRir2cZDThuM3Vw.o4t0Pcn5of6kK6mLPELvv/L1n6', 1),
(1, 'mindre', 'kaffe', '123321', 'test@email.se', '$2y$10$RP3vaQ9uYWZfsCBLo6pvIOotzMeWj7eS3ftg325aAlfPm710RuM6e', NULL),
(72, 'mer', 'te', '123123123', 'yay@email.se', '$2y$10$4D8pLlMs00GDRqf/ZM.ql.Rn6uVa5UrknD292R3NXIW4uciKj9vAu', NULL),
(78, 'joakim', 'gustavsson', '4534534534', 'ema@email.se', '$2y$10$JxmAP3xuQgCtCNlb8EIzfurBH.W5H3jB.7EsCadCF1xhGGJSUZ3C6', NULL),
(79, 'magnus', 'magnusson', '123321123', 'ny@email.se', '$2y$10$L0j.cKwys8u9F2.4oFSz/e3ihNuyl6BJxaDkMZHptghQm/hXv/.w.', NULL),
(80, 'fel', 'tele', '+123123123', 'ful@email.se', '$2y$10$7n1.pxJ/Gh8ITkElbXHNn.xqGP7WiVzMIfjdWkquEvoGzOv6j/eI.', NULL),
(81, '123123', '123123123', 'qweqweqwe', 'new@email.se', '$2y$10$q6CoTaHu0ftRISLnA.qdJekF/XrIi9r29ZjWAX3d1mVxDWCeSMu12', NULL),
(82, 'falco', 'falcosson', 'asdfgweavarsgvsdyhsd', 'qwer@email.se', '$2y$10$pCjwCs.6GJK/VGJKcriOqu5bAVkwDYpsesFhDcsGHY5m6szL8Xi6.', NULL),
(83, 'trwe', 'rewq', 'rewq', 'asd@email.se', '$2y$10$y8oPLCGNLJmkTsYup5krF.RuJJu6uIGhejQGuBw9ccYw0ArYH.tla', NULL),
(84, 'qwewer', 'ewrwerwe', '+235457yrgdte45', 'fds@email.se', '$2y$10$vRLdknznGx0OO80uk2QxJeKCxAOHWht23ikfhW0igR6o1Cl0RMasS', NULL),
(85, 'siffertest123', 'siffertest4321', '12344321', 'dbcheck@email.com', '$2y$10$RqFRB06m4chVEplV06l2TOitOZzYY73c86RAcjD2Pag85Gxp7ROJy', NULL);

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
  MODIFY `orderID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=243;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=92;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
