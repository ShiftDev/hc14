-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 05, 2014 at 05:24 PM
-- Server version: 5.5.40-MariaDB-0ubuntu0.14.04.1
-- PHP Version: 5.5.9-1ubuntu4.5

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

CREATE TABLE IF NOT EXISTS `tbl_devices` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `device_id` text NOT NULL,
  `table_id` text NOT NULL,
  `timestamp` text NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `tbl_devices`
--

INSERT INTO `tbl_devices` (`id`, `device_id`, `table_id`, `timestamp`, `status`) VALUES
(1, 'w', '', '', 0),
(2, '121', 'B', '1417087340', 1),
(3, '121', 'B', '1417756082', 1),
(4, '121', 'C', '1417756352', 1),
(5, '121', 'C', '1417759594', 1),
(6, '121', 'H', '1417759694', 1),
(7, '121', '1', '1417760403', 1),
(8, '121', 'A', '1417769393', 1),
(9, '121', '5', '1417770775', 1),
(10, '121', '4', '1417772898', 1),
(11, '121', 'A', '1417773133', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_qna`
--

CREATE TABLE IF NOT EXISTS `tbl_qna` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `table_id` text NOT NULL,
  `q` mediumtext NOT NULL,
  `a` mediumtext NOT NULL,
  `timestamp` text NOT NULL,
  `opscreen` int(1) NOT NULL,
  `onscreen` int(1) NOT NULL,
  `status` int(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=28 ;

--
-- Dumping data for table `tbl_qna`
--

INSERT INTO `tbl_qna` (`id`, `table_id`, `q`, `a`, `timestamp`, `opscreen`, `onscreen`, `status`) VALUES
(1, 'A', 'dfsd', '', '1417086774', 1, 0, 1),
(2, 'B', 'hi', '', '1417087345', 1, 0, 1),
(3, 'B', 'dfsd', '', '1417756093', 1, 0, 1),
(4, 'B', 'Asdsda', '', '1417756112', 1, 0, 1),
(5, 'C', 'dsfd', '', '1417756357', 1, 0, 2),
(6, 'C', 'ds323423', '', '1417756464', 1, 0, 2),
(7, '1', 'sdfs', '', '1417760408', 1, 0, 0),
(8, 'A', '22', '', '1417769402', 1, 0, 1),
(9, 'A', '2234', '', '1417769663', 1, 0, 0),
(10, 'A', '77', '', '1417769780', 1, 0, 1),
(11, 'A', '77l', '', '1417769795', 1, 0, 0),
(12, 'A', '999', '', '1417770050', 1, 0, 0),
(13, 'A', '66', '', '1417770753', 1, 0, 0),
(14, '5', 'ttt', '', '1417770779', 1, 0, 0),
(15, '5', 'tttrr', '', '1417771033', 1, 0, 0),
(16, '5', 'ddddd', '', '1417771946', 1, 0, 0),
(17, '5', 'dddddjj', '', '1417771965', 1, 0, 0),
(18, '5', '33', '', '1417772111', 1, 0, 0),
(19, '5', '33sdas', '', '1417772840', 1, 0, 0),
(20, '4', 's23', '', '1417772904', 1, 0, 0),
(21, '4', 's23s', '', '1417772956', 1, 0, 0),
(22, '4', 's23ss', '', '1417772977', 1, 0, 0),
(23, '4', 's23ssssss', '', '1417773047', 1, 0, 0),
(24, 'A', 'tt', '', '1417773140', 1, 0, 0),
(25, 'A', 'ttsss', '', '1417773166', 1, 0, 0),
(26, 'A', 'ttsssasdas', '', '1417773223', 1, 0, 0),
(27, 'A', '99', '', '1417774102', 1, 0, 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
