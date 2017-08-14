-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Aug 14, 2017 at 08:15 AM
-- Server version: 5.7.19-0ubuntu0.16.04.1
-- PHP Version: 7.0.22-0ubuntu0.16.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `teqniHome`
--

-- --------------------------------------------------------

--
-- Table structure for table `levelNames`
--

CREATE TABLE `levelNames` (
  `id` int(11) NOT NULL,
  `level1` varchar(100) NOT NULL,
  `level2` varchar(100) NOT NULL,
  `level3` varchar(100) NOT NULL,
  `level1opt` varchar(200) NOT NULL,
  `level2opt` varchar(200) NOT NULL,
  `level3opt` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `levelNames`
--

INSERT INTO `levelNames` (`id`, `level1`, `level2`, `level3`, `level1opt`, `level2opt`, `level3opt`) VALUES
(1, 'University', 'Branch', 'Year', 'VIT,SRM,BITS', 'CSE,ECE,Mech,Civil', '1,2,3,4');

-- --------------------------------------------------------

--
-- Table structure for table `listenData`
--

CREATE TABLE `listenData` (
  `id` int(11) NOT NULL,
  `data` varchar(400) NOT NULL,
  `state` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `listenData`
--

INSERT INTO `listenData` (`id`, `data`, `state`) VALUES
(1, 'VIT_CSE_1_ses one', 2);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `hashed_password` varchar(100) NOT NULL,
  `usertype` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `hashed_password`, `usertype`) VALUES
(2, 'Prashant Bhardwaj', 'pkb@gmail.com', '$2y$10$YjMwNTA4NWEzZTVhN2Q4NuT9ZCZawFZXP8ZS1tSzrWZ3PzyWfb7w6', 'Super User'),
(3, 'Shashank Bhardwaj', 'skb@gmail.com', '$2y$10$YmFmYjZmOWI2MmI4OWNkZe7QHytHnCEcNTvW0HakopzelB4DSadR6', 'Teacher'),
(4, 'Abhishek Singh', 'as@gmail.com', '$2y$10$YmI3ODM2NGI0Zjg4ODM4ZOe1KPSLJcx2/Kx4YIePWmX/u1VWkA5ua', 'Student'),
(5, 'Prasang Sharma', 'ps@gmail.com', '$2y$10$N2ViNTdjZTQ4ZmI1ODk0YeMWmLdgpPJj4P9bI/LaoNopglriVwle2', 'Teacher');

-- --------------------------------------------------------

--
-- Table structure for table `volleyupload`
--

CREATE TABLE `volleyupload` (
  `id` int(11) NOT NULL,
  `imgPath` varchar(400) NOT NULL,
  `uploader` varchar(100) NOT NULL,
  `level1` varchar(100) NOT NULL,
  `level2` varchar(100) NOT NULL,
  `level3` varchar(100) NOT NULL,
  `pictureName` varchar(100) NOT NULL,
  `sessionName` varchar(100) NOT NULL,
  `timeDuration` varchar(50) NOT NULL,
  `dateUpload` varchar(100) NOT NULL,
  `qrcode` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `volleyupload`
--

INSERT INTO `volleyupload` (`id`, `imgPath`, `uploader`, `level1`, `level2`, `level3`, `pictureName`, `sessionName`, `timeDuration`, `dateUpload`, `qrcode`) VALUES
(33, 'http://www.vit5icnn2018.com/teqniHome/uploads/20170813024803.png', 'skb@gmail.com', 'SRM', 'Mech', '3', 'Car front', 'ses one', '5', '13 Aug, 2017 | 08:18 pm', 'https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=SRM_Mech_3_ses one'),
(34, 'http://www.vit5icnn2018.com/teqniHome/uploads/20170813025126.png', 'skb@gmail.com', 'BITS', 'ECE', '2', 'Car board', 'sess two', '3', '13 Aug, 2017 | 08:21 pm', 'https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=BITS_ECE_2_sess two'),
(35, 'http://www.vit5icnn2018.com/teqniHome/uploads/20170813025213.png', 'skb@gmail.com', 'VIT', 'CSE', '4', 'pkb', 'sess three', '6', '13 Aug, 2017 | 08:22 pm', 'https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=VIT_CSE_4_sess three'),
(36, 'http://www.vit5icnn2018.com/teqniHome/uploads/20170813025414.png', 'skb@gmail.com', 'SRM', 'Mech', '2', 'car board', 'sess four', '6', '13 Aug, 2017 | 08:24 pm', 'https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=SRM_Mech_2_sess four'),
(37, 'http://www.vit5icnn2018.com/teqniHome/uploads/20170813062601.png', 'skb@gmail.com', 'BITS', 'ECE', '2', 'car back', 'sess two', '10', '13 Aug, 2017 | 11:56 pm', 'https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=BITS_ECE_2_sess two'),
(38, 'http://www.vit5icnn2018.com/teqniHome/uploads/20170813082510.png', 'skb@gmail.com', 'VIT', 'CSE', '1', 'me', 'ses one', '5', '14 Aug, 2017 | 01:55 am', 'https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=VIT_CSE_1_ses one');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `levelNames`
--
ALTER TABLE `levelNames`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `listenData`
--
ALTER TABLE `listenData`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `volleyupload`
--
ALTER TABLE `volleyupload`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `levelNames`
--
ALTER TABLE `levelNames`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `listenData`
--
ALTER TABLE `listenData`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `volleyupload`
--
ALTER TABLE `volleyupload`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
