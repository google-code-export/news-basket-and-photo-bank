-- phpMyAdmin SQL Dump
-- version 3.2.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jul 26, 2012 at 01:07 PM
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
  `date_created` datetime NOT NULL,
  `last_login` datetime NOT NULL,
  `last_ip` varchar(45) NOT NULL,
  PRIMARY KEY (`id_user`),
  KEY `id_group` (`id_source`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_user`, `name`, `id_source`, `password`, `user_level`, `email`, `phone`, `date_created`, `last_login`, `last_ip`) VALUES
('abdi', 'abdi P M', 3, 'b1b3773a05c0ed0176787a4f1574ff0075f7521e', 'user', 'abdi@gmail.com', '12345', '2012-07-20 00:00:00', '2012-07-26 13:02:48', '0.0.0.0'),
('rahmad', 'Rahmad Syaifullah G', 2, '8cb2237d0679ca88db6464eac60da96345513964', 'administrator', 'rahmad.bkt@gmail.com', '085714871637', '2012-07-20 06:00:00', '2012-07-26 13:01:26', '0.0.0.0');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`id_source`) REFERENCES `source` (`id_source`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
