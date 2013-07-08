-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jul 08, 2013 at 03:32 PM
-- Server version: 5.5.31
-- PHP Version: 5.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `roommet`
--
CREATE DATABASE IF NOT EXISTS `roommet` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `roommet`;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE IF NOT EXISTS `products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `user_id`, `name`, `price`, `created`, `modified`) VALUES
(1, 3, 'tamatar', 40, '2013-07-08 00:00:00', '2013-07-08 15:24:50'),
(2, 3, 'banana', 60, '2013-07-04 00:00:00', '2013-07-08 15:25:11'),
(3, 2, 'roti', 150, '2013-07-08 00:00:00', '2013-07-08 15:26:28'),
(4, 2, 'poha', 50, '2013-07-04 00:00:00', '2013-07-08 15:26:44'),
(5, 4, 'ande', 70, '2013-07-08 00:00:00', '2013-07-08 15:27:45'),
(6, 1, 'apple', 75, '2013-07-04 00:00:00', '2013-07-08 15:28:05');

-- --------------------------------------------------------

--
-- Table structure for table `rooms`
--

CREATE TABLE IF NOT EXISTS `rooms` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `isActive` tinyint(1) NOT NULL,
  `code` varchar(64) DEFAULT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `rooms`
--

INSERT INTO `rooms` (`id`, `name`, `address`, `isActive`, `code`, `created`, `modified`) VALUES
(1, 'South Tukoganj', 'South tukoganj', 0, '2kurbo9q', '2013-07-08 14:57:30', '2013-07-08 14:57:30');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `room_id` int(11) NOT NULL,
  `username` varchar(128) NOT NULL,
  `password` varchar(64) NOT NULL,
  `nickname` varchar(128) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `room_id`, `username`, `password`, `nickname`, `created`, `modified`) VALUES
(1, 1, 'jitendra', '81a7f94df965bf550dbaf87be77d9382d30a612d', 'jitz', '2013-07-08 15:00:55', '2013-07-08 15:00:55'),
(2, 1, 'vikas', '81a7f94df965bf550dbaf87be77d9382d30a612d', 'vikas', '2013-07-08 15:17:36', '2013-07-08 15:17:36'),
(3, 1, 'dev', '81a7f94df965bf550dbaf87be77d9382d30a612d', 'dev', '2013-07-08 15:24:24', '2013-07-08 15:24:24'),
(4, 1, 'salman', '81a7f94df965bf550dbaf87be77d9382d30a612d', 'sallu', '2013-07-08 15:27:22', '2013-07-08 15:27:22');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
