-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jul 13, 2012 at 01:01 PM
-- Server version: 5.5.16
-- PHP Version: 5.3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `newsbasket`
--

-- --------------------------------------------------------

--
-- Table structure for table `article`
--

CREATE TABLE IF NOT EXISTS `article` (
  `id_article` int(11) NOT NULL,
  `id_source` int(11) NOT NULL,
  `author` varchar(255) DEFAULT NULL,
  `create_on` date DEFAULT NULL,
  `last_edited_by` varchar(255) DEFAULT NULL,
  `last_edited_on` date DEFAULT NULL,
  `published_by` varchar(255) DEFAULT NULL,
  `published_on` date DEFAULT NULL,
  `headline` varchar(200) DEFAULT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `lead_article` text,
  `body_article` text,
  `tag` varchar(255) DEFAULT NULL,
  `flag` enum('row_article','edited','published','deleted') DEFAULT NULL,
  `locked` enum('yes','no') DEFAULT NULL,
  PRIMARY KEY (`id_article`),
  KEY `id_source` (`id_source`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `article_category`
--

CREATE TABLE IF NOT EXISTS `article_category` (
  `id_article_category` int(11) NOT NULL AUTO_INCREMENT,
  `id_category` varchar(5) NOT NULL,
  `id_article` int(11) NOT NULL,
  PRIMARY KEY (`id_article_category`,`id_category`,`id_article`),
  KEY `id_article` (`id_article`),
  KEY `id_category` (`id_category`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `article_version`
--

CREATE TABLE IF NOT EXISTS `article_version` (
  `id_article_version` int(11) NOT NULL,
  `id_article` int(11) NOT NULL,
  `edited_by` varchar(255) DEFAULT NULL,
  `edited_on` datetime DEFAULT NULL,
  `headline` varchar(200) DEFAULT NULL,
  `lead_article` text,
  `body_article` text,
  PRIMARY KEY (`id_article_version`),
  KEY `id_article` (`id_article`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `author`
--

CREATE TABLE IF NOT EXISTS `author` (
  `id_author` varchar(50) NOT NULL,
  `id_source` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_author`),
  KEY `id_source` (`id_source`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `author_article`
--

CREATE TABLE IF NOT EXISTS `author_article` (
  `id_author_article` int(11) NOT NULL AUTO_INCREMENT,
  `id_author` varchar(50) NOT NULL,
  `id_article` int(11) NOT NULL,
  `process_date` datetime DEFAULT NULL,
  PRIMARY KEY (`id_author_article`,`id_author`,`id_article`),
  KEY `id_author` (`id_author`),
  KEY `id_article` (`id_article`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE IF NOT EXISTS `category` (
  `id_category` varchar(5) NOT NULL,
  `category_name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_category`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `source`
--

CREATE TABLE IF NOT EXISTS `source` (
  `id_source` int(11) NOT NULL,
  `source_name` varchar(255) DEFAULT NULL,
  `source_type` enum('wires','publisher') DEFAULT NULL,
  PRIMARY KEY (`id_source`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `source`
--

INSERT INTO `source` (`id_source`, `source_name`, `source_type`) VALUES
(1, 'beritasatu.com', 'publisher'),
(2, 'Campus Life', 'publisher');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id_user` varchar(50) NOT NULL,
  `id_source` int(11) NOT NULL,
  `password` varchar(255) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `user_level` enum('viewer','reporter','editor','publisher','administrator') DEFAULT NULL,
  PRIMARY KEY (`id_user`),
  KEY `id_source` (`id_source`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_user`, `id_source`, `password`, `name`, `phone`, `email`, `user_level`) VALUES
('andrefadila@gmail.com', 1, 'bismillah', 'Fadila Andre', '085717598651', 'andrefadila@gmail.com', 'administrator'),
('adminku', 1, 'aadsd', 'sadasd', '432', 'andre_fadila@yahoo.com', 'administrator'),
('administrator', 1, 'asd', 'asd', 'asd', 'andre_fadila@yahoo.com', 'viewer'),
('dasdasd', 0, 'dasdsad', 'sdsd', '2312', 'andre.fadila@live.co.uk', ''),
('sad', 0, 'asd', 'asdasda', '4123', 'sescipb@yahoo.com', ''),
('qwe', 1, 'qweqw', 'qwe', '1235', 'qwe@awew.fity', 'viewer'),
('312', 0, '123', '213', '4213', 'shadow.red1@gmail.com', ''),
('asd', 1, 'sad', 'asdasda', '123', 'andre_fadila@yahoo.com', 'viewer'),
('andrefadila', 1, 'b1b3773a05c0ed0176787a4f1574ff0075f7521e', 'Fadila Andre', '12345', 'andrefadila@gmail.com', 'administrator'),
('ozipriawadi', 1, '321b7bde249ff2e9196855459175a76f', 'Ozi Priawadi', '0857', 'jie.ilkom46ipb@gmail.com', 'administrator');

-- --------------------------------------------------------

--
-- Table structure for table `users_article`
--

CREATE TABLE IF NOT EXISTS `users_article` (
  `id_users_article` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` varchar(50) NOT NULL,
  `id_article` int(11) NOT NULL,
  `flag` enum('row_article','edited','published','deleted') DEFAULT NULL,
  `process_date` datetime DEFAULT NULL,
  PRIMARY KEY (`id_users_article`,`id_user`,`id_article`),
  KEY `id_user` (`id_user`),
  KEY `id_article` (`id_article`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
