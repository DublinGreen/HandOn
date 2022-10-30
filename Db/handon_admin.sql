-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Oct 18, 2022 at 11:38 PM
-- Server version: 5.7.39-cll-lve
-- PHP Version: 7.3.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `handon_admin`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `reg_id` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `deviceId` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `device_type` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `login_type` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `loginOtp` int(11) NOT NULL,
  `name` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `gender` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `dob` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `latitude` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `longitude` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `phone`, `reg_id`, `deviceId`, `device_type`, `login_type`, `loginOtp`, `name`, `gender`, `dob`, `latitude`, `longitude`, `image`, `created`, `updated`) VALUES
(1, '@135555982', '534534645', '', '', '', '', 0, 'HARSH', 'MALE', '2 JUNE', '34534', '53453', 'uploads/products/1656759994_001_(3).png', '2022-07-02 14:34:48', '2022-07-02 16:36:34'),
(2, '@910459652', '12345665', '', '', '', '', 0, '', '', '', '', '', '', '2022-07-02 14:40:47', '0000-00-00 00:00:00'),
(3, '@135234516', '8285748292', '', '', '', '', 0, '', '', '', '', '', '', '2022-07-02 14:44:35', '0000-00-00 00:00:00'),
(4, '@236093113', '9555458707', '', '', '', '', 0, '', '', '', '', '', '', '2022-07-02 14:45:20', '0000-00-00 00:00:00'),
(5, '@537193582', '788787', '', '', '', '', 0, 'nansi', 'Female', '14-06-2022', '', 'kharar', 'uploads/products/1656760407_IMG_20220702_143319635.jpg', '2022-07-02 15:59:32', '2022-07-02 16:43:27'),
(6, '@922041186', '64949797766', '', '', '', '', 0, '', '', '', '', '', '', '2022-07-02 16:43:59', '0000-00-00 00:00:00'),
(7, '@381507036', '988985866886', '', '', '', '', 0, '', '', '', '', '', '', '2022-07-02 16:44:56', '0000-00-00 00:00:00'),
(8, '@213604445', '94949979779', '', '', '', '', 0, 'msni', 'Male', '17-06-2022', '', 'kharar', 'uploads/products/1656760852_IMG_20220702_135250213.jpg', '2022-07-02 16:50:22', '2022-07-02 16:50:52');

-- --------------------------------------------------------

--
-- Table structure for table `user_otp`
--

CREATE TABLE `user_otp` (
  `id` int(11) NOT NULL,
  `phone` varchar(14) NOT NULL,
  `loginOtp` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_otp`
--

INSERT INTO `user_otp` (`id`, `phone`, `loginOtp`) VALUES
(2, '534534645', 954251),
(3, '123123123', 340311),
(6, '8285748292', 5101),
(7, '9555458707', 2904),
(8, '12345665', 7318),
(9, '788787', 8586),
(10, '64949797766', 3653),
(11, '988985866886', 2646),
(12, '94949979779', 9811);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_otp`
--
ALTER TABLE `user_otp`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `user_otp`
--
ALTER TABLE `user_otp`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
