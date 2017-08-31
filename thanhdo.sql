-- phpMyAdmin SQL Dump
-- version 4.2.12deb2+deb8u2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Aug 31, 2017 at 08:41 AM
-- Server version: 5.5.57-0+deb8u1
-- PHP Version: 5.6.30-0+deb8u1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `thanhdo`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_q1`
--

CREATE TABLE IF NOT EXISTS `tb_q1` (
  `q1_mid` int(11) NOT NULL,
  `q1_email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tb_serial`
--

CREATE TABLE IF NOT EXISTS `tb_serial` (
  `serial_mid` int(11) NOT NULL,
  `serial_email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tb_user`
--

CREATE TABLE IF NOT EXISTS `tb_user` (
  `user_mid` int(11) NOT NULL,
  `user_email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tb_userq3`
--

CREATE TABLE IF NOT EXISTS `tb_userq3` (
  `userq3_mid` int(11) NOT NULL,
  `userq3_email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `userq3_auth` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `userq3_authno` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tb_user_auth`
--

CREATE TABLE IF NOT EXISTS `tb_user_auth` (
  `user_auth_mid` int(11) NOT NULL,
  `user_auth_auth` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tb_user_auth`
--

INSERT INTO `tb_user_auth` (`user_auth_mid`, `user_auth_auth`) VALUES
(101, 'system'),
(102, 'manager'),
(103, 'guest'),
(104, 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_q1`
--
ALTER TABLE `tb_q1`
 ADD PRIMARY KEY (`q1_mid`);

--
-- Indexes for table `tb_serial`
--
ALTER TABLE `tb_serial`
 ADD PRIMARY KEY (`serial_mid`);

--
-- Indexes for table `tb_user`
--
ALTER TABLE `tb_user`
 ADD PRIMARY KEY (`user_mid`);

--
-- Indexes for table `tb_userq3`
--
ALTER TABLE `tb_userq3`
 ADD PRIMARY KEY (`userq3_mid`);

--
-- Indexes for table `tb_user_auth`
--
ALTER TABLE `tb_user_auth`
 ADD PRIMARY KEY (`user_auth_mid`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
