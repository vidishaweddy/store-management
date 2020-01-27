-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jan 23, 2020 at 09:19 PM
-- Server version: 5.5.27
-- PHP Version: 7.1.16

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `test_store`
--

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(30) NOT NULL,
  `password` varbinary(250) NOT NULL,
  `name` varchar(70) NOT NULL,
  `photo` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `user`
-- Pass: *Abcd123
INSERT INTO `user` (`name`, `username`, `password`) VALUES
('admin', 'admin', 'cb64f3ee837a350c08963b3e08b8d2009d630ff4f0c900235d1939f1a9089d5d');

-- --------------------------------------------------------

--
-- Table structure for table `loginattempt`
--

CREATE TABLE IF NOT EXISTS `loginattempt` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(30) NOT NULL,
  `date` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `loginattempt`
--

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE IF NOT EXISTS `product` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL,
  `type` text NOT NULL,
  `supplier` text NOT NULL,
  `price` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`name`, `type`, `supplier`, `price`, `quantity`) VALUES
('bread', 'food', 'coles', 5000, 240),
('chocolate', 'snack', 'coles', 2000, 110),
('rice', 'food', 'woolworths', 2000, 240),
('noodle', 'food', 'iga', 1000, 100),
('ice cream', 'snack', 'foodland', 2000, 900),
('soda', 'beverages', 'foodland', 2000, 900),
('water', 'beverages', 'iga', 12000, 1000);

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE IF NOT EXISTS `sales` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` date NOT NULL,
  `name` text NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `total` int(20) NOT NULL,
  `profit` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `sales`
--

INSERT INTO `sales` (`date`, `name`, `quantity`, `price`, `total`, `profit`) VALUES
('2020-01-01', 'rice', 2, 6000, 12000, 2000),
('2020-02-02', 'ice cream', 7, 12000, 84000, 70000),
('2020-01-02', 'noodle', 2, 15000, 30000, 2000),
('2020-02-03', 'noodle', 1, 12000, 12000, 10000),
('2020-01-01', 'soda', 2, 4000, 8000, 4000),
('2020-01-02', 'bread', 2, 17000, 34000, 4000),
('2020-02-03', 'chocolate', 1, 18000, 18000, 6000),
('2020-02-06', 'soda', 2, 19000, 38000, 10000);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
