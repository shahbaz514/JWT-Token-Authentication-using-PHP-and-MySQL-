-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 03, 2024 at 06:05 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tokenauth`
--

-- --------------------------------------------------------

--
-- Table structure for table `country`
--

CREATE TABLE `country` (
  `id` int(11) NOT NULL,
  `c_name` text NOT NULL,
  `c_code` text NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `country`
--

INSERT INTO `country` (`id`, `c_name`, `c_code`, `date`) VALUES
(1, 'Pakistan', 'PK', '2024-06-26 10:38:03'),
(2, 'India', 'IN', '2024-06-26 10:38:28'),
(3, 'Saudi Arabia', 'SA', '2024-06-26 10:38:45'),
(4, 'Qatar', 'QA', '2024-06-26 10:40:26');

-- --------------------------------------------------------

--
-- Table structure for table `datasave`
--

CREATE TABLE `datasave` (
  `id` int(11) NOT NULL,
  `country` text NOT NULL,
  `language` text NOT NULL,
  `locale` text NOT NULL,
  `model` text NOT NULL,
  `modelCode` text NOT NULL,
  `orderID` text NOT NULL,
  `price` int(11) NOT NULL,
  `options` text NOT NULL,
  `customer` text NOT NULL,
  `vehicle` text NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `datasave`
--

INSERT INTO `datasave` (`id`, `country`, `language`, `locale`, `model`, `modelCode`, `orderID`, `price`, `options`, `customer`, `vehicle`, `date`) VALUES
(10, 'IT', 'it', 'it_IT', 'ModelY', 'my', 'RN147831093', 6497855, '$APBS,$BCYR,$DV4W,$INPB0,$PPSW,$PRMY1,$SC04,$MDLY,$WY21P,$SLR1,$MTY12,$PL31,$SPTY1,$STY5S,$CPF0', 'BUSINESS', 'NEW', '2024-07-15 05:17:58'),
(12, 'IT', 'it', 'it_IT', 'ModelY', 'my', 'RN147831093', 6497855, '$APBS,$BCYR,$DV4W,$INPB0,$PPSW,$PRMY1,$SC04,$MDLY,$WY21P,$SLR1,$MTY12,$PL31,$SPTY1,$STY5S,$CPF0', 'BUSINESS', 'NEW', '2024-07-15 05:20:23'),
(13, 'AE', 'en', '', 'Model3', 'm3', 'RN116961246', 6817000, '$APBS,$BC3R,$CPF0,$DV4W,$IPB1,$MDL3,$MT325,$PL31,$PMNG,$PRM31,$SC04,$SLR1,$SPT31,$W33D', 'PRIVATE', 'NEW', '2024-07-18 08:00:25');

-- --------------------------------------------------------

--
-- Table structure for table `email`
--

CREATE TABLE `email` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `email`
--

INSERT INTO `email` (`id`, `email`, `date`) VALUES
(1, 'shahbazakhtarjaved@gmail.com', '2024-06-26 10:32:18'),
(2, 'shahbaz.lhr.uol@gmail.com', '2024-06-26 10:32:23'),
(3, 'alivu91422@gmail.com', '2024-06-26 10:55:32');

-- --------------------------------------------------------

--
-- Table structure for table `secret`
--

CREATE TABLE `secret` (
  `id` int(11) NOT NULL,
  `skey` text NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `secret`
--

INSERT INTO `secret` (`id`, `skey`, `date`) VALUES
(1, '123456', '2024-08-01 12:40:41');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` text NOT NULL,
  `img` text NOT NULL,
  `otp` text NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `email`, `password`, `img`, `otp`, `date`) VALUES
(8, '', 'admin', 'shahbaz.lhr.uol@gmail.com', '202cb962ac59075b964b07152d234b70', '', '1973', '2024-08-01 12:09:16');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `country`
--
ALTER TABLE `country`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `datasave`
--
ALTER TABLE `datasave`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `email`
--
ALTER TABLE `email`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `secret`
--
ALTER TABLE `secret`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `country`
--
ALTER TABLE `country`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `datasave`
--
ALTER TABLE `datasave`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `email`
--
ALTER TABLE `email`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `secret`
--
ALTER TABLE `secret`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
