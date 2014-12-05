-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Host: localhost:8889
-- Generation Time: Dec 02, 2014 at 12:18 PM
-- Server version: 5.5.34
-- PHP Version: 5.5.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `shiftsri_hc14qa`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_devices`
--

CREATE TABLE `tbl_devices` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `device_id` text NOT NULL,
  `table_id` text NOT NULL,
  `timestamp` text NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `tbl_devices`
--

INSERT INTO `tbl_devices` (`id`, `device_id`, `table_id`, `timestamp`, `status`) VALUES
(1, 'w', '', '', 0),
(2, '121', 'B', '1417087340', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_qna`
--

CREATE TABLE `tbl_qna` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `table_id` text NOT NULL,
  `q` mediumtext NOT NULL,
  `a` mediumtext NOT NULL,
  `timestamp` text NOT NULL,
  `status` int(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `tbl_qna`
--

INSERT INTO `tbl_qna` (`id`, `table_id`, `q`, `a`, `timestamp`, `status`) VALUES
(1, 'A', 'dfsd', '', '1417086774', 0),
(2, 'B', 'hi', '', '1417087345', 2);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
