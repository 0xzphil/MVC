-- phpMyAdmin SQL Dump
-- version 4.3.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Aug 21, 2015 at 08:59 AM
-- Server version: 5.6.24
-- PHP Version: 5.6.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `data_mvc`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(11) NOT NULL,
  `category_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `activate` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `time_created` datetime NOT NULL,
  `time_updated` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `category_name`, `activate`, `time_created`, `time_updated`) VALUES
(2, 'test', 'Deactivate', '5555-11-11 00:00:00', '5555-11-11 00:00:00'),
(3, 'asdasdasd', 'Deactivate', '5555-11-11 00:00:00', '5555-11-11 00:00:00'),
(4, 'fgdgdf', 'Deactivate', '5555-11-11 00:00:00', '5555-11-11 00:00:00'),
(5, 'fsdf', 'Deactivate', '5555-11-11 00:00:00', '5555-11-11 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE IF NOT EXISTS `products` (
  `id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `product_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `price` int(100) NOT NULL,
  `details` varchar(9999) COLLATE utf8_unicode_ci NOT NULL,
  `activate` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `time_created` datetime NOT NULL,
  `time_updated` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `category_id`, `product_name`, `price`, `details`, `activate`, `time_created`, `time_updated`) VALUES
(2, 5, 'dadsadasd', 0, '', 'Deactivate', '5555-11-11 00:00:00', '5555-11-11 00:00:00'),
(3, 3, 'czxczxcz', 0, '', 'Activate', '5555-11-11 00:00:00', '5555-11-11 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `rank` int(1) NOT NULL DEFAULT '0',
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `activate` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `time_created` datetime NOT NULL,
  `time_updated` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=72 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `rank`, `email`, `activate`, `time_created`, `time_updated`) VALUES
(46, '', '', 0, '', 'Activate', '5555-11-11 00:00:00', '5555-11-11 00:00:00'),
(48, 'utyutyut', '', 0, 'yutyutyut', 'Activate', '5555-11-11 00:00:00', '5555-11-11 00:00:00'),
(49, 'ouiouioiu', '', 0, 'ouioiuou', 'Activate', '5555-11-11 00:00:00', '5555-11-11 00:00:00'),
(50, 'nm,nm,nm', '', 0, ',mnnm,nm,', 'Activate', '5555-11-11 00:00:00', '5555-11-11 00:00:00'),
(51, 'bxcvxcv', '', 0, 'vxcvxvxc', 'Deactivate', '5555-11-11 00:00:00', '5555-11-11 00:00:00'),
(52, 'fdfgdfgd', '', 0, 'fgdfgdfg', 'Activate', '5555-11-11 00:00:00', '5555-11-11 00:00:00'),
(53, 'ghjghjhg', '', 0, 'jghjghjgh', 'Deactivate', '5555-11-11 00:00:00', '5555-11-11 00:00:00'),
(54, 'qwqeqwe', '', 0, 'qwewqeq', 'Deactivate', '5555-11-11 00:00:00', '5555-11-11 00:00:00'),
(55, 'asdda', 'asda', 0, 'asdda', 'Deactivate', '5555-11-11 00:00:00', '5555-11-11 00:00:00'),
(56, 'sdfsdf', '', 0, '', 'Deactivate', '5555-11-11 00:00:00', '5555-11-11 00:00:00'),
(58, 'sdfsdfsd', '', 0, 'sdfsdfsdf', 'Deactivate', '5555-11-11 00:00:00', '5555-11-11 00:00:00'),
(60, 'yry', '', 0, 'y', 'Deactivate', '5555-11-11 00:00:00', '5555-11-11 00:00:00'),
(62, 'k', '', 0, 'k', 'Deactivate', '5555-11-11 00:00:00', '5555-11-11 00:00:00'),
(63, 'n', '', 0, 'n', 'Deactivate', '5555-11-11 00:00:00', '5555-11-11 00:00:00'),
(66, 'daadasd', '', 0, 'asdasdasda', 'Deactivate', '5555-11-11 00:00:00', '5555-11-11 00:00:00'),
(67, 'aaadads', 'dsadasdasd', 0, 'adasdasdasd', 'Deactivate', '5555-11-11 00:00:00', '5555-11-11 00:00:00'),
(68, 'admin', 'a5d8008c8ff876ba51c7dd17f0e9835e', 9, 'fizz.uet@gmail.com', 'Deactivate', '6666-11-11 00:00:00', '6666-11-11 00:00:00'),
(70, 'Ã¡Ä‘s', 'Ã¡Ä‘Ã¡', 0, 'Ã¡Ä‘Ã¡', 'Activate', '5555-11-11 00:00:00', '5555-11-11 00:00:00'),
(71, 'zxczx', '', 0, '', '0', '5555-11-11 00:00:00', '5555-11-11 00:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=72;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
