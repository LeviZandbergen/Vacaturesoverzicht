-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 20, 2020 at 07:54 AM
-- Server version: 5.7.24
-- PHP Version: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `vacaturesoverzicht`
--
CREATE DATABASE IF NOT EXISTS `vacaturesoverzicht` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `vacaturesoverzicht`;

-- --------------------------------------------------------

--
-- Table structure for table `jobbranch`
--

CREATE TABLE `jobbranch` (
  `jobbranchID` int(11) NOT NULL,
  `branchName` varchar(254) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `jobbranch`
--

INSERT INTO `jobbranch` (`jobbranchID`, `branchName`) VALUES
(1, 'Zwolle'),
(2, 'Ommen'),
(3, 'Hardenberg');

-- --------------------------------------------------------

--
-- Table structure for table `jobfunction`
--

CREATE TABLE `jobfunction` (
  `jobfunctionID` int(11) NOT NULL,
  `functionName` varchar(254) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `jobfunction`
--

INSERT INTO `jobfunction` (`jobfunctionID`, `functionName`) VALUES
(1, 'retail');

-- --------------------------------------------------------

--
-- Table structure for table `joboffer`
--

CREATE TABLE `joboffer` (
  `jobofferID` int(11) NOT NULL,
  `idJobbranch` int(11) NOT NULL,
  `idJobfunction` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `name` varchar(254) NOT NULL,
  `description` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `joboffer`
--

INSERT INTO `joboffer` (`jobofferID`, `idJobbranch`, `idJobfunction`, `status`, `name`, `description`) VALUES
(1, 1, 1, 1, 'Retail worker', 'Uploads/Vacatures/retail.txt'),
(2, 2, 1, 1, 'Management', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem.'),
(3, 3, 1, 0, 'Shoe tester', 'Uploads/Vacatures/description1.txt');

-- --------------------------------------------------------

--
-- Table structure for table `manager`
--

CREATE TABLE `manager` (
  `managerID` int(11) NOT NULL,
  `manEmail` varchar(45) NOT NULL,
  `manPassword` varchar(254) NOT NULL,
  `isManager` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `manager`
--

INSERT INTO `manager` (`managerID`, `manEmail`, `manPassword`, `isManager`) VALUES
(1, 'manager@mail.nl', '$2y$10$hpP6h/aYC07YPPb/x/VTC.Y7mpBJRGhkymz.ldSLrOEvG3jWmI2Ja', 1);

-- --------------------------------------------------------

--
-- Table structure for table `offerreaction`
--

CREATE TABLE `offerreaction` (
  `offerReactionID` int(11) NOT NULL,
  `idUser` int(11) NOT NULL,
  `idJoboffer` int(11) NOT NULL,
  `motivation` longtext NOT NULL,
  `cv` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `offerreaction`
--

INSERT INTO `offerreaction` (`offerReactionID`, `idUser`, `idJoboffer`, `motivation`, `cv`) VALUES
(1, 1, 1, 'Dit is mijn motivatie', 'Uploads/CV/CV1.txt'),
(2, 1, 2, 'Dit is mijn motivatie', 'Uploads/CV/CV2.txt');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `userID` int(11) NOT NULL,
  `email` varchar(45) NOT NULL,
  `password` varchar(254) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`userID`, `email`, `password`) VALUES
(1, 'admin@mail.nl', '$2y$10$aIlu3KrYmb4Tx8JXcA/JLee3XYWqOr4eAsZDwIKMt6tA4HMHcZhwy');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `jobbranch`
--
ALTER TABLE `jobbranch`
  ADD PRIMARY KEY (`jobbranchID`);

--
-- Indexes for table `jobfunction`
--
ALTER TABLE `jobfunction`
  ADD PRIMARY KEY (`jobfunctionID`);

--
-- Indexes for table `joboffer`
--
ALTER TABLE `joboffer`
  ADD PRIMARY KEY (`jobofferID`),
  ADD KEY `idJobbranch` (`idJobbranch`),
  ADD KEY `idJobfunction` (`idJobfunction`);

--
-- Indexes for table `manager`
--
ALTER TABLE `manager`
  ADD PRIMARY KEY (`managerID`);

--
-- Indexes for table `offerreaction`
--
ALTER TABLE `offerreaction`
  ADD PRIMARY KEY (`offerReactionID`),
  ADD KEY `idUser` (`idUser`),
  ADD KEY `idJoboffer` (`idJoboffer`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`userID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `jobbranch`
--
ALTER TABLE `jobbranch`
  MODIFY `jobbranchID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `jobfunction`
--
ALTER TABLE `jobfunction`
  MODIFY `jobfunctionID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `joboffer`
--
ALTER TABLE `joboffer`
  MODIFY `jobofferID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `manager`
--
ALTER TABLE `manager`
  MODIFY `managerID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `offerreaction`
--
ALTER TABLE `offerreaction`
  MODIFY `offerReactionID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `userID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `joboffer`
--
ALTER TABLE `joboffer`
  ADD CONSTRAINT `joboffer_ibfk_1` FOREIGN KEY (`idJobbranch`) REFERENCES `jobbranch` (`jobbranchID`),
  ADD CONSTRAINT `joboffer_ibfk_2` FOREIGN KEY (`idJobfunction`) REFERENCES `jobfunction` (`jobfunctionID`);

--
-- Constraints for table `offerreaction`
--
ALTER TABLE `offerreaction`
  ADD CONSTRAINT `offerreaction_ibfk_1` FOREIGN KEY (`idUser`) REFERENCES `user` (`userID`),
  ADD CONSTRAINT `offerreaction_ibfk_2` FOREIGN KEY (`idJoboffer`) REFERENCES `joboffer` (`jobofferID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
