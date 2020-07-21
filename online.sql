-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3309
-- Generation Time: Mar 30, 2020 at 06:16 AM
-- Server version: 5.7.24
-- PHP Version: 7.2.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `online`
--

-- --------------------------------------------------------

--
-- Table structure for table `bill`
--

DROP TABLE IF EXISTS `bill`;
CREATE TABLE IF NOT EXISTS `bill` (
  `bid` int(11) NOT NULL AUTO_INCREMENT,
  `compid` int(11) NOT NULL,
  `amt` int(11) NOT NULL,
  `bill` varchar(1000) NOT NULL,
  PRIMARY KEY (`bid`),
  UNIQUE KEY `compid` (`compid`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;



-- --------------------------------------------------------

--
-- Table structure for table `category`
--

DROP TABLE IF EXISTS `category`;
CREATE TABLE IF NOT EXISTS `category` (
  `catid` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `head` int(11) DEFAULT NULL,
  PRIMARY KEY (`catid`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`catid`, `name`, `head`) VALUES
(1, 'Electrical', NULL),
(2, 'Networking', NULL),
(3, 'General', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `complaint`
--

DROP TABLE IF EXISTS `complaint`;
CREATE TABLE IF NOT EXISTS `complaint` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sub` varchar(200) NOT NULL,
  `descp` varchar(1000) NOT NULL,
  `proof` varchar(1000) NOT NULL,
  `cat` int(11) NOT NULL,
  `filedby` int(11) NOT NULL,
  `dept` int(11) NOT NULL,
  `approvedby` varchar(100) DEFAULT NULL,
  `status` varchar(100) NOT NULL DEFAULT 'Pending',
  `date` date NOT NULL,
  `time` time NOT NULL,
  `checks` int(11) NOT NULL DEFAULT '0',
  `due` date DEFAULT NULL,
  `remarks` varchar(1000) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;


-- --------------------------------------------------------

--
-- Table structure for table `dept`
--

DROP TABLE IF EXISTS `dept`;
CREATE TABLE IF NOT EXISTS `dept` (
  `deptid` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `head` int(11) DEFAULT NULL,
  PRIMARY KEY (`deptid`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `dept`
--

INSERT INTO `dept` (`deptid`, `name`, `head`) VALUES
(1, 'Computer Science', NULL),
(2, 'Information Science', NULL),
(3, 'Electronics and Communication', NULL),
(4, 'Mechanical', NULL),
(5, 'Hostel', NULL),
(6, 'Canteen', NULL),
(7, 'Principal', NULL),
(8, 'Admin', 1);

-- --------------------------------------------------------

--
-- Table structure for table `estimation`
--

DROP TABLE IF EXISTS `estimation`;
CREATE TABLE IF NOT EXISTS `estimation` (
  `estid` int(11) NOT NULL AUTO_INCREMENT,
  `compid` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `estimate` varchar(1000) NOT NULL,
  `replaces` int(11) NOT NULL,
  `dates` date NOT NULL,
  `times` time NOT NULL,
  PRIMARY KEY (`estid`),
  UNIQUE KEY `compid` (`compid`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;



-- --------------------------------------------------------

--
-- Table structure for table `replacement`
--

DROP TABLE IF EXISTS `replacement`;
CREATE TABLE IF NOT EXISTS `replacement` (
  `repid` int(11) NOT NULL AUTO_INCREMENT,
  `compid` int(11) NOT NULL,
  `date` date DEFAULT NULL,
  PRIMARY KEY (`repid`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;



-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

DROP TABLE IF EXISTS `staff`;
CREATE TABLE IF NOT EXISTS `staff` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `dept` int(11) NOT NULL,
  `pass` varchar(100) NOT NULL,
  `auth` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;



-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(1000) NOT NULL,
  `auth` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `auth`) VALUES
(1, 'Admin', 'admin@admin.com', '123456', 'sadmin');


-- --------------------------------------------------------

--
-- Table structure for table `work`
--

DROP TABLE IF EXISTS `work`;
CREATE TABLE IF NOT EXISTS `work` (
  `wid` int(11) NOT NULL AUTO_INCREMENT,
  `compid` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `phone` bigint(20) NOT NULL,
  `organization` varchar(1000) NOT NULL,
  PRIMARY KEY (`wid`),
  UNIQUE KEY `compid` (`compid`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;


COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
