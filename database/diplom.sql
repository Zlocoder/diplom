-- phpMyAdmin SQL Dump
-- version 4.0.10.6
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1:3306
-- Generation Time: Oct 16, 2015 at 09:16 PM
-- Server version: 5.5.41-log
-- PHP Version: 5.4.35

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `diplom`
--

-- --------------------------------------------------------

--
-- Table structure for table `competition`
--

CREATE TABLE IF NOT EXISTS `competition` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `date_add` datetime NOT NULL,
  `date_upd` datetime NOT NULL,
  `date_start` datetime NOT NULL,
  `date_end` datetime NOT NULL,
  `creator_id` int(11) NOT NULL,
  `poster` varchar(16) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `competition`
--

INSERT INTO `competition` (`id`, `title`, `description`, `date_add`, `date_upd`, `date_start`, `date_end`, `creator_id`, `poster`) VALUES
(1, 'Конкурс 1', 'Описание конкурса 1\r\nОписание конкурса 1\r\nОписание конкурса 1\r\n<strong>Описание конкурса 1</strong>\r\nОписание конкурса 1\r\nОписание конкурса 1\r\nОписание конкурса 1', '2015-10-15 20:43:52', '2015-10-15 20:43:52', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, '2dH23xPHV_TC5nEC');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `avatar` varchar(16) NOT NULL,
  `date_add` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `login`, `email`, `password`, `avatar`, `date_add`) VALUES
(1, 'user1', 'user1@site.com', '$2y$13$hsBceljp6nGMYeE5JvpmhOKeZr8W444JxBCWn8K6xKNpmnWBg0wxm', '', '2015-10-01 19:35:04'),
(2, 'user2', 'user2@site.com', '$2y$13$mBLKAZJPCXVPbpzX7WkN8ePmCGZASKbyfPZRObJ/DQoHgipTIoktC', '', '2015-10-02 22:49:23'),
(3, 'user3', 'user3@site.com', '$2y$13$St9lLlGqu2AmhoRkEJn0G.4vbqnb.4p.HX3TRFscnohrIGwRFg7Pm', '', '2015-10-08 20:58:27'),
(4, 'user4', 'user4@site.com', '$2y$13$kMkYAA2hmhhK4QtS4218oOWcC56V42KCRuphm6JE3XnHm8UmvcPQ.', '', '2015-10-08 20:58:49'),
(5, 'user5', 'user5@site.com', '$2y$13$.c0XJxfNgiTN3Y.3cqakO.vRrgLh7LVLtO.i2EHLHkYoj1SO8DLFi', '', '2015-10-08 20:59:07'),
(6, 'user6', 'user6@site.com', '$2y$13$/QzufsADqKinzPBfY1vXEuY0lmfyGOodUPuXeIhJK8RKDikFpVNcq', '', '2015-10-08 20:59:26'),
(7, 'user7', 'user7@site.com', '$2y$13$1b8zZlJR02WCM2Kc.HrZfeu7FeToR3WtZwznlQBmQDIxa0Mr8tIsW', '', '2015-10-08 20:59:44'),
(8, 'user8', 'user8@site.com', '$2y$13$I5LjhcaNPTtp/SqD9SaD8uJ9LNXSIJ1.g9uVtMz1YbijMKU0rI9de', '', '2015-10-08 21:00:00'),
(9, 'user9', 'user9@site.com', '$2y$13$0zWDniQMCrX4z/aOvNbAc.d69QNPdUFTJGBNFNO6CdHAePJWUi0mi', 'o_nFal8pnEBOwmeN', '2015-10-08 21:22:16'),
(10, 'user10', 'user10@site.com', '$2y$13$laIu7eXEYT3TxI1CTLBEJe7Jcsh7./0z/clhu.l1NgSVh/7yvdmt6', '', '2015-10-10 21:24:48'),
(11, 'user12', 'user12@site.com', '$2y$13$9VzLCxUq1nYQlgC0WeY9Ae2MTr7hlZ/LdTcenumRyoRYgM9ynBn9.', 'ArKcfcx8vFzw2dou', '2015-10-10 21:28:44');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
