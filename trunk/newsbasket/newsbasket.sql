-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jul 19, 2012 at 01:05 PM
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
  `created_on` date DEFAULT NULL,
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `article`
--

INSERT INTO `article` (`id_article`, `id_source`, `author`, `created_on`, `last_edited_by`, `last_edited_on`, `published_by`, `published_on`, `headline`, `slug`, `lead_article`, `body_article`, `tag`, `flag`, `locked`) VALUES
(1, 1, 'author', '2012-07-18', NULL, NULL, NULL, NULL, 'test', 'test', 'testing', 'testing', 'test', 'row_article', 'no'),
(2, 2, 'author2', '2012-07-18', NULL, NULL, NULL, NULL, 'test2', 'test2', 'testing2', 'testing2', 'test', 'row_article', 'no');

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `author`
--

CREATE TABLE IF NOT EXISTS `author` (
  `id_author` varchar(50) NOT NULL,
  `id_source` int(11) NOT NULL,
  `password` varchar(255) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `date_created` datetime NOT NULL,
  PRIMARY KEY (`id_author`),
  KEY `id_source` (`id_source`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `author`
--

INSERT INTO `author` (`id_author`, `id_source`, `password`, `name`, `email`, `phone`, `date_created`) VALUES
('author', 1, 'f64cd8e32f5ac7553c150bd05d6f2252bb73f68d', 'bambang', 'andre_fadila@yahoo.com', '12345', '2012-07-18 11:58:54'),
('author2', 2, 'a85995f5f133b0be0b49a5ec41d6e593fc8c9e9b', 'budi', 'awpwebanimator49@gmail.com', '12345', '2012-07-18 12:00:17');

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE IF NOT EXISTS `category` (
  `id_category` varchar(5) NOT NULL,
  `category_name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_category`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id_category`, `category_name`) VALUES
('eco', 'Economy'),
('oto', 'Otomotif'),
('pol', 'Politic'),
('tec', 'Technology');

-- --------------------------------------------------------

--
-- Table structure for table `source`
--

CREATE TABLE IF NOT EXISTS `source` (
  `id_source` int(11) NOT NULL,
  `source_name` varchar(255) DEFAULT NULL,
  `source_type` enum('wires','publisher') DEFAULT NULL,
  PRIMARY KEY (`id_source`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `source`
--

INSERT INTO `source` (`id_source`, `source_name`, `source_type`) VALUES
(1, 'beritasatu.com', 'publisher'),
(2, 'Campus Life', 'publisher'),
(3, 'AFP', 'wires');

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
  `date_created` datetime NOT NULL,
  PRIMARY KEY (`id_user`),
  KEY `id_source` (`id_source`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_user`, `id_source`, `password`, `name`, `phone`, `email`, `user_level`, `date_created`) VALUES
('aaa', 2, '7e240de74fb1ed08fa08d38063f6a6a91462a815', 'cccc', '12345', 'andre.fadila@live.co.uk', 'viewer', '2012-07-18 07:37:02'),
('admin', 2, 'd033e22ae348aeb5660fc2140aec35850c4da997', 'admin', '12345', 'andre_fadila@yahoo.com', 'administrator', '2012-07-18 06:56:05'),
('andrefadila', 1, 'b1b3773a05c0ed0176787a4f1574ff0075f7521e', 'Fadila Andre', '12345', 'andrefadila@gmail.com', 'administrator', '0000-00-00 00:00:00'),
('andrefadilaaaa', 2, '47bce5c74f589f4867dbd57e9ca9f808', 'asdasdaqqq', '12345', 'andre_fadila@yahoo.com', 'editor', '0000-00-00 00:00:00'),
('andrefadilax', 2, 'd8578edf8458ce06fbc5bb76a58c5ca4', 'a', '12345', 'andre_fadila@yahoo.com', 'reporter', '0000-00-00 00:00:00'),
('asd', 2, 'f10e2821bbbea527ea02200352313bc059445190', 'asd', '12345', 'andre_fadila@yahoo.com', 'reporter', '2012-07-18 06:53:42'),
('ffff', 1, 'f6949a8c7d5b90b4a698660bbfb9431503fbb995', 'ffff', '21123123', 'fadilaandre@gmail.com', 'reporter', '2012-07-18 07:53:46'),
('publisher', 1, 'b497a0aad7d4c7179b4fa30ccb0b930e674048dd', 'publisherrrrr', '12345', 'andre_fadila@yahoo.com', 'publisher', '0000-00-00 00:00:00'),
('qqqq', 1, '33a9e269dd782e92489a8e547b7ed582e0e1d42b', 'qqqq', '12345', 'afsfa@awed.asds', 'editor', '2012-07-18 07:52:23'),
('viewer', 1, '40b4f25b1fd956b576d880db2b41182e0444bd1d', 'viewer', '12345', 'afsfa@awed.asds', 'viewer', '0000-00-00 00:00:00'),
('zzz', 1, '40fa37ec00c761c7dbb6ebdee6d4a260b922f5f4', 'bambang', '12345', 'zczc@xzczx.zxc', 'publisher', '0000-00-00 00:00:00');

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
