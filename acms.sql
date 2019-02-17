-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 06, 2018 at 07:04 AM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `acms`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `record_id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `designation` varchar(200) NOT NULL,
  `mobile` varchar(30) NOT NULL,
  `image` varchar(200) NOT NULL,
  `username` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`record_id`, `name`, `designation`, `mobile`, `image`, `username`, `password`) VALUES
(1, 'Admin', 'Admin', '03283247234', '1.jpg', 'admin', '12345');

-- --------------------------------------------------------

--
-- Table structure for table `club`
--

CREATE TABLE `club` (
  `record_id` int(11) NOT NULL,
  `club_name` varchar(200) NOT NULL,
  `foundation_date` date NOT NULL,
  `founder` varchar(200) NOT NULL,
  `slogan` varchar(200) NOT NULL,
  `details` varchar(10000) NOT NULL,
  `current_committee` varchar(200) NOT NULL,
  `logo` varchar(200) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `club`
--

INSERT INTO `club` (`record_id`, `club_name`, `foundation_date`, `founder`, `slogan`, `details`, `current_committee`, `logo`, `status`) VALUES
(1, 'AIUB Oratory Club (AOC)', '1998-11-17', '', 'Freedom of Speaking', '', 'EC 17-18', '1.jpg', 1);

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `record_id` int(11) NOT NULL,
  `user_type` varchar(200) NOT NULL,
  `userid` varchar(200) NOT NULL,
  `password` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`record_id`, `user_type`, `userid`, `password`) VALUES
(1, 'excom', '14-26070-1', 1234),
(2, 'osa', '123-00000-1', 1234);

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

CREATE TABLE `post` (
  `record_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `post` varchar(10000) NOT NULL,
  `posted_to` varchar(200) NOT NULL,
  `posted_by` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `post`
--

INSERT INTO `post` (`record_id`, `date`, `time`, `post`, `posted_to`, `posted_by`) VALUES
(1, '2018-12-06', '11:05:00', 'dasdasdsadsa', '0', '123-00000-1'),
(2, '2018-12-06', '11:06:24', 'dasdasd', '0', '123-00000-1');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `record_id` int(11) NOT NULL,
  `name` varchar(500) NOT NULL,
  `mobile` varchar(50) NOT NULL,
  `email` varchar(200) NOT NULL,
  `address` varchar(1000) NOT NULL,
  `userid` varchar(500) NOT NULL,
  `password` varchar(500) NOT NULL,
  `permission` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`record_id`);

--
-- Indexes for table `club`
--
ALTER TABLE `club`
  ADD PRIMARY KEY (`record_id`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`record_id`);

--
-- Indexes for table `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`record_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`record_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `record_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `club`
--
ALTER TABLE `club`
  MODIFY `record_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `record_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `post`
--
ALTER TABLE `post`
  MODIFY `record_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
