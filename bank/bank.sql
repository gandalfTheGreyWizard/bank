-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 19, 2018 at 03:50 PM
-- Server version: 10.1.31-MariaDB
-- PHP Version: 5.6.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bank`
--

-- --------------------------------------------------------

--
-- Table structure for table `AccountHistory`
--

CREATE TABLE `AccountHistory` (
  `acc_id` int(11) DEFAULT NULL,
  `type` varchar(20) DEFAULT NULL,
  `amount` int(11) DEFAULT NULL,
  `date` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `AccountHistory`
--

INSERT INTO `AccountHistory` (`acc_id`, `type`, `amount`, `date`) VALUES
(3, 'deposit', 44955, '19:04:18-02:55:13pm'),
(3, 'withdraw', 44455, '19:04:18-02:55:25pm'),
(3, 'deposit', 44461, '19:04:18-02:55:34pm');

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

CREATE TABLE `accounts` (
  `customer_id` varchar(10) DEFAULT NULL,
  `type` varchar(30) DEFAULT NULL,
  `amount` int(11) DEFAULT NULL,
  `acc_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`customer_id`, `type`, `amount`, `acc_id`) VALUES
(NULL, NULL, NULL, 0),
('cus3', 'current', 30039, 1),
('cus4', 'savings', 80000, 2),
('cus3', 'savings', 44461, 3);

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `customer_name` varchar(50) DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `address` varchar(50) DEFAULT NULL,
  `city` varchar(20) DEFAULT NULL,
  `state` varchar(20) DEFAULT NULL,
  `password` varchar(20) DEFAULT NULL,
  `sr_no` int(11) DEFAULT NULL,
  `address2` varchar(50) DEFAULT NULL,
  `customer_id` varchar(10) DEFAULT NULL,
  `status` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`customer_name`, `dob`, `address`, `city`, `state`, `password`, `sr_no`, `address2`, `customer_id`, `status`) VALUES
(NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL),
('soumik', '0000-00-00', 'asdf', 'asdfasdf', 'asdfasdf', '2f15a0b04d274834474e', 0, NULL, NULL, NULL),
('t', '0000-00-00', 'asdf', 'asdf', 'asdf', '202cb962ac59075b964b', 0, NULL, NULL, NULL),
('new', '0000-00-00', 'asdfa', 'asdfadsf', 'adfasdfa', 'tolate', 0, NULL, NULL, NULL),
('newuser', '0000-00-00', 'asdf', 'asdfasdf', 'asdfafsd', '145', 1, NULL, NULL, NULL),
('dhon', '0000-00-00', 'asdfasdf', 'asdfasdf', 'asdfasdf', '789', 2, '', NULL, NULL),
('chodon', '2018-04-20', 'asdfasdfasdf', 'oikokik', 'oikoik', '789', 5, 'ikikik', 'cus5', 1),
('ram', '2018-04-03', 'purulia', 'gram', 'wb', 'lyadh', 6, '', 'cus6', 1),
('ram', '2018-04-03', 'purulia', 'gram', 'wb', 'lyadh', 7, '', 'cus7', 1),
('sam', '2018-04-03', 'gg', 'gg', 'gg', 'gg', 8, 'gg', 'cus8', 0);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
