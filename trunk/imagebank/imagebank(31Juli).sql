-- phpMyAdmin SQL Dump
-- version 3.2.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jul 31, 2012 at 05:44 PM
-- Server version: 5.1.41
-- PHP Version: 5.3.1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `imagebank`
--

-- --------------------------------------------------------

--
-- Table structure for table `album`
--

CREATE TABLE IF NOT EXISTS `album` (
  `id_album` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` varchar(50) NOT NULL,
  `album_name` char(50) DEFAULT NULL,
  PRIMARY KEY (`id_album`),
  KEY `id_user` (`id_user`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `album`
--

INSERT INTO `album` (`id_album`, `id_user`, `album_name`) VALUES
(1, 'abdi', 'terserah'),
(2, 'rahmad', 'buku baru'),
(3, 'AFP', 'lalala'),
(5, 'AFP', 'lala'),
(6, 'rahmad', 'lama'),
(7, 'ria', 'spongbob');

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
('tec', 'Technology');

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE IF NOT EXISTS `images` (
  `id_images` int(11) NOT NULL AUTO_INCREMENT,
  `id_album` int(11) NOT NULL,
  `image_name` char(50) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `caption` varchar(255) NOT NULL,
  `filetype` char(15) NOT NULL,
  `image_height` int(11) NOT NULL,
  `image_width` int(11) NOT NULL,
  `timestamp` int(11) NOT NULL,
  `thumbnail` varchar(255) NOT NULL,
  `filesize` int(11) NOT NULL,
  `path` varchar(255) NOT NULL,
  `update_at` datetime NOT NULL,
  PRIMARY KEY (`id_images`),
  KEY `id_album` (`id_album`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `images`
--

INSERT INTO `images` (`id_images`, `id_album`, `image_name`, `title`, `caption`, `filetype`, `image_height`, `image_width`, `timestamp`, `thumbnail`, `filesize`, `path`, `update_at`) VALUES
(1, 1, 'gL2jUXTnkQTK.jpg', 'basket', 'basket ilkom isc', 'jpeg', 540, 720, 1343102816, 'gL2jUXTnkQTK_tn.jpg', 99, 'C:/xampp/htdocs/imagebank/images/galeri/', '2012-07-24 12:06:56'),
(2, 1, 'ZqLg9SrduxZf.jpg', 'angkatan 46', 'basket ilkom', 'jpeg', 643, 960, 1343102836, 'ZqLg9SrduxZf_tn.jpg', 109, 'C:/xampp/htdocs/imagebank/images/galeri/', '2012-07-24 12:07:16'),
(3, 1, 'U2ApEKQLwIRl.jpg', 'untitled', 'asdawasdas', 'jpeg', 640, 960, 1343102868, 'U2ApEKQLwIRl_tn.jpg', 88, 'C:/xampp/htdocs/imagebank/images/galeri/', '2012-07-24 12:07:48'),
(4, 1, '3LC8LIawk9Ga.jpg', 'asdasd', 'aswdsdasd', 'jpeg', 643, 960, 1343102893, '3LC8LIawk9Ga_tn.jpg', 116, 'C:/xampp/htdocs/imagebank/images/galeri/', '2012-07-26 18:05:35'),
(5, 1, 'RfnpwIRjJe8Q.jpg', 'sawdsd', 'awasdadw', 'jpeg', 640, 960, 1343102906, 'RfnpwIRjJe8Q_tn.jpg', 80, 'C:/xampp/htdocs/imagebank/images/galeri/', '2012-07-26 18:12:25'),
(6, 10, '3jehHiBecvrA.jpg', 'wewe', 'ererer', 'jpeg', 540, 720, 1343635193, '3jehHiBecvrA_tn.jpg', 99, 'C:/xampp/htdocs/imagebank/images/galeri/', '2012-07-30 15:59:53'),
(7, 0, 'f9BzHQAAUXez.JPG', 'qweqw', '32432432', 'jpeg', 2448, 3264, 1343643621, 'f9BzHQAAUXez_tn.JPG', 626, 'C:/xampp/htdocs/imagebank/images/galeri/', '2012-07-30 18:20:21'),
(8, 2, 'UiI5XsbJUbQi.jpg', 'guest', 'guest star ', 'jpeg', 640, 960, 1343718007, 'UiI5XsbJUbQi_tn.jpg', 107, 'C:/xampp/htdocs/imagebank/images/galeri/', '2012-07-31 15:00:07'),
(9, 7, 'D3dNxujrpJjm.jpg', 'spongebob', 'aku suka kartun ini', 'jpeg', 143, 120, 1343720937, 'D3dNxujrpJjm_tn.jpg', 5, 'C:/xampp/htdocs/imagebank/images/galeri/', '2012-07-31 15:48:57');

-- --------------------------------------------------------

--
-- Table structure for table `imagescategory`
--

CREATE TABLE IF NOT EXISTS `imagescategory` (
  `id_category_image` int(11) NOT NULL AUTO_INCREMENT,
  `id_category` varchar(5) NOT NULL,
  `id_images` int(11) NOT NULL,
  PRIMARY KEY (`id_category_image`),
  KEY `id_images` (`id_images`),
  KEY `id_category` (`id_category`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `imagescategory`
--

INSERT INTO `imagescategory` (`id_category_image`, `id_category`, `id_images`) VALUES
(1, 'oto', 2),
(2, 'eco', 4),
(3, 'oto', 5),
(4, 'oto', 6),
(5, 'eco', 7),
(6, 'eco', 8),
(7, 'eco', 9);

-- --------------------------------------------------------

--
-- Table structure for table `imagetag`
--

CREATE TABLE IF NOT EXISTS `imagetag` (
  `id_image_tag` int(11) NOT NULL AUTO_INCREMENT,
  `id_image` int(11) NOT NULL,
  `id_tag` varchar(45) NOT NULL,
  PRIMARY KEY (`id_image_tag`),
  KEY `id_image` (`id_image`,`id_tag`),
  KEY `id_image_2` (`id_image`),
  KEY `id_image_3` (`id_image`),
  KEY `id_image_4` (`id_image`),
  KEY `id_image_5` (`id_image`),
  KEY `id_image_6` (`id_image`),
  KEY `id_image_7` (`id_image`),
  KEY `id_image_8` (`id_image`),
  KEY `id_tag` (`id_tag`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `imagetag`
--

INSERT INTO `imagetag` (`id_image_tag`, `id_image`, `id_tag`) VALUES
(1, 5, 'kue'),
(2, 5, 'kerasa'),
(3, 5, 'enak');

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
(0, 'bloomberg', 'wires'),
(1, 'Berita Satu.com', 'publisher'),
(2, 'BeritaSatu tv', 'publisher'),
(3, 'Jakarta Globe', 'publisher'),
(4, 'Suara Pembaharuan', 'publisher'),
(5, 'Investor Daily', 'publisher'),
(6, 'Straits Times', 'publisher'),
(7, 'Student Globe', 'publisher'),
(8, 'Globe Asia', 'publisher'),
(9, 'Majalah Investor', 'publisher'),
(10, 'The Peak', 'publisher'),
(11, 'Campus Asia', 'publisher'),
(13, 'Campus Life', 'publisher');

-- --------------------------------------------------------

--
-- Table structure for table `tag`
--

CREATE TABLE IF NOT EXISTS `tag` (
  `id_tag` varchar(45) NOT NULL,
  `tag` varchar(45) NOT NULL,
  PRIMARY KEY (`id_tag`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tag`
--

INSERT INTO `tag` (`id_tag`, `tag`) VALUES
('we,res,ter', ''),
('ger,lum,lost', ''),
('kue', ''),
('kerasa', ''),
('enak', '');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id_user` varchar(50) NOT NULL,
  `name` varchar(255) NOT NULL,
  `id_source` int(11) NOT NULL,
  `password` varchar(255) NOT NULL,
  `user_level` enum('administrator','user') DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `last_login` datetime NOT NULL,
  `last_ip` varchar(45) NOT NULL,
  `last_logout` datetime NOT NULL,
  PRIMARY KEY (`id_user`),
  KEY `id_group` (`id_source`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_user`, `name`, `id_source`, `password`, `user_level`, `email`, `phone`, `last_login`, `last_ip`, `last_logout`) VALUES
('abdi', 'abdi P M', 3, 'b1b3773a05c0ed0176787a4f1574ff0075f7521e', 'user', 'abdi@gmail.com', '12345', '2012-07-27 12:23:54', '0.0.0.0', '0000-00-00 00:00:00'),
('AFP', 'AFP', 0, '8cb2237d0679ca88db6464eac60da96345513964', 'user', 'AFP@gmail.com', '11241232', '2012-07-27 15:47:12', '0.0.0.0', '0000-00-00 00:00:00'),
('erina', 'erinagede', 5, 'b1b3773a05c0ed0176787a4f1574ff0075f7521e', 'user', 'erinagede@yahoo.com', '12312321', '2012-07-30 17:47:13', '0.0.0.0', '0000-00-00 00:00:00'),
('rahmad', 'Rahmad Syaifullah G', 2, '8cb2237d0679ca88db6464eac60da96345513964', 'administrator', 'rahmad.bkt@gmail.com', '085714871637', '2012-07-31 17:26:41', '0.0.0.0', '0000-00-00 00:00:00'),
('ria', 'riaria', 0, 'b1b3773a05c0ed0176787a4f1574ff0075f7521e', 'user', 'riani@gmail.com', '129312323-', '2012-07-31 15:47:14', '0.0.0.0', '0000-00-00 00:00:00');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `album`
--
ALTER TABLE `album`
  ADD CONSTRAINT `album_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`);

--
-- Constraints for table `imagescategory`
--
ALTER TABLE `imagescategory`
  ADD CONSTRAINT `imagescategory_ibfk_1` FOREIGN KEY (`id_category`) REFERENCES `category` (`id_category`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `imagescategory_ibfk_2` FOREIGN KEY (`id_images`) REFERENCES `images` (`id_images`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`id_source`) REFERENCES `source` (`id_source`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
