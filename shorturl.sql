-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 18, 2016 at 06:30 AM
-- Server version: 5.5.47-0ubuntu0.14.04.1
-- PHP Version: 5.5.9-1ubuntu4.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `blog_mvc`
--
CREATE DATABASE IF NOT EXISTS `shorturl` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `shorturl`;

-- --------------------------------------------------------

--
-- Table structure for table `stat`
--

CREATE TABLE IF NOT EXISTS `stat` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `url_id` int(11) NOT NULL,
  `ip` int(11) NOT NULL,
  `user_agent` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `date_visit` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `url_id` (`url_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `stat`
--

INSERT INTO `stat` (`id`, `url_id`, `ip`, `user_agent`, `country`, `city`, `date_visit`) VALUES
(1, 1, -646557410, 'Mozilla/5.0', 'Israel', 'Haifa', '2016-04-18');

-- --------------------------------------------------------

--
-- Table structure for table `url`
--

CREATE TABLE IF NOT EXISTS `url` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `real_url` text NOT NULL,
  `short_url_slug` varchar(255) NOT NULL,
  `date_expired` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `url`
--

INSERT INTO `url` (`id`, `real_url`, `short_url_slug`, `date_expired`) VALUES
(1, 'http://php.net/docs.php', 'tEsT', NULL);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
