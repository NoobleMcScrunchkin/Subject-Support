-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jan 09, 2020 at 11:38 AM
-- Server version: 5.7.26
-- PHP Version: 7.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `subject_support`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

DROP TABLE IF EXISTS `accounts`;
CREATE TABLE IF NOT EXISTS `accounts` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Username` text NOT NULL,
  `Password` text NOT NULL,
  `First Name` text NOT NULL,
  `Last Name` text NOT NULL,
  `Email` text NOT NULL,
  `Privileged` tinyint(1) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`ID`, `Username`, `Password`, `First Name`, `Last Name`, `Email`, `Privileged`) VALUES
(0, 'Admin', '$2y$10$Pwln9ELDwT4.zhWWdqJhkOJT0oKLKRGNv3Bbk0rolk7DV0Y2qL91G', 'Admin', 'Admin', 'email@elizabethcollege.gg', 1);

-- --------------------------------------------------------

--
-- Table structure for table `completed`
--

DROP TABLE IF EXISTS `completed`;
CREATE TABLE IF NOT EXISTS `completed` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `StudentID` int(11) NOT NULL,
  `Week` date NOT NULL,
  `Period` int(11) NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `StudentID` (`StudentID`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `forgotpass`
--

DROP TABLE IF EXISTS `forgotpass`;
CREATE TABLE IF NOT EXISTS `forgotpass` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `AccountID` int(11) NOT NULL,
  `Code` int(11) NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `AccountID` (`AccountID`)
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

DROP TABLE IF EXISTS `students`;
CREATE TABLE IF NOT EXISTS `students` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `First Name` text NOT NULL,
  `Last Name` text NOT NULL,
  `Subject` text NOT NULL,
  `Year` int(11) NOT NULL,
  `House` text NOT NULL,
  `colNum` int(11) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=latin1;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `completed`
--
ALTER TABLE `completed`
  ADD CONSTRAINT `completed_ibfk_1` FOREIGN KEY (`StudentID`) REFERENCES `students` (`ID`);

--
-- Constraints for table `forgotpass`
--
ALTER TABLE `forgotpass`
  ADD CONSTRAINT `forgotpass_ibfk_1` FOREIGN KEY (`AccountID`) REFERENCES `accounts` (`ID`);

DELIMITER $$
--
-- Events
--
DROP EVENT IF EXISTS `Truncate forgotpass`$$
CREATE DEFINER=`root`@`localhost` EVENT `Truncate forgotpass` ON SCHEDULE EVERY 1 DAY STARTS '2020-01-10 00:00:00' ON COMPLETION NOT PRESERVE ENABLE COMMENT 'Remove codes at end of day' DO TRUNCATE forgotpass$$

DROP EVENT IF EXISTS `Remove month old records`$$
CREATE DEFINER=`root`@`localhost` EVENT `Remove month old records` ON SCHEDULE EVERY 1 WEEK STARTS '2020-01-11 00:00:00' ON COMPLETION NOT PRESERVE ENABLE COMMENT 'Removes student completed records that are older than one month' DO DELETE FROM completed WHERE Week < DATE_SUB(NOW(), INTERVAL 1 MONTH)$$

DELIMITER ;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
