-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jul 23, 2012 at 07:24 AM
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
(2, 2, 'author2', '2012-07-18', 'editor2', '2012-07-23', NULL, NULL, 'test2', 'test2', 'lead2lead2 lead2 lead2 lead2 lead2 lead2lead2 lead2 lead2 lead2 lead2lead2 lead2lead2lead2 lead2 lead2lead2  lead2lead2lead2 lead2lead2  lead2 lead2 lead2 lead2 lead2 lead2 lead2', 'testing2 testing2testing2 testing2 testing2 testing2 testing2 testing2 testing2v testing2 vvtesting2 testing2 testing2 testing2 testing2 testing2 testing2 testing2 testing2 testing2 testing2 testing2 testing2 testing2 testing2 testing2 testing2 testing2 testing2 testing2 testing2 testing2 testing2 testing2 testing2 testing2 testing2 testing2 testing2 testing2 testing2 testing2 testing2 testing2 testing2 testing2 testing2 testing2 testing2 testing2 testing2 testing2 testing2 testing2 testing2 testing2 testing2 testing2 testing2', 'test', 'edited', 'no'),
(3, 3, 'author', '2012-07-18', NULL, NULL, NULL, NULL, 'test3', 'test3', 'testing3', 'testing3', 'test', 'row_article', 'no');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `article_category`
--

INSERT INTO `article_category` (`id_article_category`, `id_category`, `id_article`) VALUES
(1, 'eco', 1),
(3, 'pol', 1),
(2, 'eco', 2),
(4, 'oto', 2);

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

--
-- Dumping data for table `article_version`
--

INSERT INTO `article_version` (`id_article_version`, `id_article`, `edited_by`, `edited_on`, `headline`, `lead_article`, `body_article`) VALUES
(1, 2, 'editor', '2012-07-19 00:00:00', 'versi1', 'versi1 versi1  versi1 versi1versi1 versi1versi1versi1versi1 versi1 versi1versi1 versi1versi1versi1 ', 'versi1versi1 versi1versi1 versi1versi1versi1versi1 versi1versi1 versi1 versi1versi1versi1 versi1 versi1 versi1 versi1versi1versi1versi1versi1 versi1 versi1 versi1versi1versi1versi1 versi1versi1versi1versi1 versi1versi1'),
(2, 2, 'editor2', '2012-07-20 00:00:00', 'versi2', 'versi2versi2 versi2 versi2 versi2versi2versi2versi2 versi2 versi2 versi2versi2versi2 versi2 versi2versi2 versi2versi2 versi2 versi2 versi2 versi2 ', 'versi2versi2versi2versi2versi2 versi2versi2 versi2versi2versi2 versi2versi2 versi2versi2 versi2versi2versi2 versi2versi2 versi2versi2 versi2versi2versi2 versi2versi2 versi2 versi2versi2 versi2versi2 versi2 versi2 versi2 versi2 versi2versi2 versi2 versi2versi2 versi2 versi2 versi2versi2  versi2'),
(3, 2, 'editor2', '2012-07-20 00:00:00', 'versi2', 'versi2versi2 versi2 versi2 versi2versi2versi2versi2 versi2 versi2 versi2versi2versi2 versi2 versi2versi2 versi2versi2 versi2 versi2 versi2 versi2 ', 'versi2versi2versi2versi2versi2 versi2versi2 versi2versi2versi2 versi2versi2 versi2versi2 versi2versi2versi2 versi2versi2 versi2versi2 versi2versi2versi2 versi2versi2 versi2 versi2versi2 versi2versi2 versi2 versi2 versi2 versi2 versi2versi2 versi2 versi2versi2 versi2 versi2 versi2versi2  versi2'),
(4, 2, 'editor2', '2012-07-20 00:00:00', 'versi2', 'versi2versi2 versi2 versi2 versi2versi2versi2versi2 versi2 versi2 versi2versi2versi2 versi2 versi2versi2 versi2versi2 versi2 versi2 versi2 versi2 ', 'versi2versi2versi2versi2versi2 versi2versi2 versi2versi2versi2 versi2versi2 versi2versi2 versi2versi2versi2 versi2versi2 versi2versi2 versi2versi2versi2 versi2versi2 versi2 versi2versi2 versi2versi2 versi2 versi2 versi2 versi2 versi2versi2 versi2 versi2versi2 versi2 versi2 versi2versi2  versi2'),
(5, 2, 'editor2', '2012-07-20 00:00:00', 'versi2', 'versi2versi2 versi2 versi2 versi2versi2versi2versi2 versi2 versi2 versi2versi2versi2 versi2 versi2versi2 versi2versi2 versi2 versi2 versi2 versi2 ', 'versi2versi2versi2versi2versi2 versi2versi2 versi2versi2versi2 versi2versi2 versi2versi2 versi2versi2versi2 versi2versi2 versi2versi2 versi2versi2versi2 versi2versi2 versi2 versi2versi2 versi2versi2 versi2 versi2 versi2 versi2 versi2versi2 versi2 versi2versi2 versi2 versi2 versi2versi2  versi2'),
(6, 1, 'editor2', '2012-07-20 00:00:00', 'versi2', 'versi2versi2 versi2 versi2 versi2versi2versi2versi2 versi2 versi2 versi2versi2versi2 versi2 versi2versi2 versi2versi2 versi2 versi2 versi2 versi2 ', 'versi2versi2versi2versi2versi2 versi2versi2 versi2versi2versi2 versi2versi2 versi2versi2 versi2versi2versi2 versi2versi2 versi2versi2 versi2versi2versi2 versi2versi2 versi2 versi2versi2 versi2versi2 versi2 versi2 versi2 versi2 versi2versi2 versi2 versi2versi2 versi2 versi2 versi2versi2  versi2'),
(7, 1, 'editor', '2012-07-20 00:00:00', 'versi2', 'versi2versi2 versi2 versi2 versi2versi2versi2versi2 versi2 versi2 versi2versi2versi2 versi2 versi2versi2 versi2versi2 versi2 versi2 versi2 versi2 ', 'versi2versi2versi2versi2versi2 versi2versi2 versi2versi2versi2 versi2versi2 versi2versi2 versi2versi2versi2 versi2versi2 versi2versi2 versi2versi2versi2 versi2versi2 versi2 versi2versi2 versi2versi2 versi2 versi2 versi2 versi2 versi2versi2 versi2 versi2versi2 versi2 versi2 versi2versi2  versi2'),
(8, 1, 'editor', '2012-07-20 00:00:00', 'versi2', 'versi2versi2 versi2 versi2 versi2versi2versi2versi2 versi2 versi2 versi2versi2versi2 versi2 versi2versi2 versi2versi2 versi2 versi2 versi2 versi2 ', 'versi2versi2versi2versi2versi2 versi2versi2 versi2versi2versi2 versi2versi2 versi2versi2 versi2versi2versi2 versi2versi2 versi2versi2 versi2versi2versi2 versi2versi2 versi2 versi2versi2 versi2versi2 versi2 versi2 versi2 versi2 versi2versi2 versi2 versi2versi2 versi2 versi2 versi2versi2  versi2');

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
  `date_created` datetime NOT NULL,
  PRIMARY KEY (`id_author`),
  KEY `id_source` (`id_source`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `author`
--

INSERT INTO `author` (`id_author`, `id_source`, `name`, `email`, `phone`, `date_created`) VALUES
('author', 1, 'bambang', 'andre_fadila@yahoo.com', '12345', '2012-07-18 11:58:54'),
('author2', 2, 'budi', 'awpwebanimator49@gmail.com', '12345', '2012-07-18 12:00:17');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `author_article`
--

INSERT INTO `author_article` (`id_author_article`, `id_author`, `id_article`, `process_date`) VALUES
(1, 'author', 2, '2012-07-18 00:00:00');

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
('admin', 2, 'd033e22ae348aeb5660fc2140aec35850c4da997', 'admin', '12345', 'andre_fadila@yahoo.com', 'administrator', '2012-07-18 06:56:05'),
('andrefadila', 1, 'b1b3773a05c0ed0176787a4f1574ff0075f7521e', 'Fadila Andre', '12345', 'andrefadila@gmail.com', 'administrator', '0000-00-00 00:00:00'),
('editor', 1, 'ab41949825606da179db7c89ddcedcc167b64847', 'editor', '12345', 'editor@kasd.asd', 'editor', '2012-07-20 06:46:15'),
('editor2', 2, 'dca51001e938d082f9bd520e46d33c865ed14cd5', 'editor2', '12345', 'andre.fadila@live.co.uk', 'editor', '2012-07-20 06:47:13'),
('publisher', 1, 'b497a0aad7d4c7179b4fa30ccb0b930e674048dd', 'publisherrrrr', '12345', 'andre_fadila@yahoo.com', 'publisher', '0000-00-00 00:00:00'),
('publisher2', 2, '6ece5178b6179bb6da9a40ec7ef5d685e2138845', 'publisher2', '12345', 'andrefadila@gmail.com', 'publisher', '2012-07-20 08:40:52'),
('reporter', 2, '40a630e157504605e40ba241f6b1f78ab1dd97b9', 'reporter', '12345', 'andre_fadila@yahoo.com', 'reporter', '2012-07-20 06:45:06'),
('reporter2', 1, '7434f3a72ae238f7b3716873971665d505b7d008', 'reporter2', '12345', 'andre.fadila@live.co.uk', 'reporter', '2012-07-20 08:39:59'),
('viewer', 1, '40b4f25b1fd956b576d880db2b41182e0444bd1d', 'viewer', '12345', 'afsfa@awed.asds', 'viewer', '0000-00-00 00:00:00');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `users_article`
--

INSERT INTO `users_article` (`id_users_article`, `id_user`, `id_article`, `flag`, `process_date`) VALUES
(1, 'editor', 2, 'edited', '2012-07-19 00:00:00'),
(2, 'editor2', 2, 'edited', '2012-07-20 00:00:00'),
(3, 'editor', 1, 'edited', '2012-07-23 00:00:00'),
(4, 'editor2', 1, 'edited', '2012-07-23 00:00:00'),
(5, 'editor2', 2, 'row_article', '2012-07-01 00:00:00');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
