-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 18, 2020 at 10:55 AM
-- Server version: 5.7.24
-- PHP Version: 7.2.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";

--
-- Database: `crime`
--

-- --------------------------------------------------------

--
-- Table structure for table `grpgusers`
--

CREATE TABLE `grpgusers` (
  `id` int(10) NOT NULL,
  `username` varchar(75) NOT NULL DEFAULT '',
  `password` varchar(75) NOT NULL DEFAULT '',
  `exp` int(30) NOT NULL DEFAULT '0',
  `money` int(30) NOT NULL DEFAULT '1000',
  `bank` int(30) NOT NULL DEFAULT '0',
  `whichbank` int(2) NOT NULL DEFAULT '0',
  `hp` int(10) NOT NULL DEFAULT '50',
  `energy` int(10) NOT NULL DEFAULT '10',
  `nerve` int(10) NOT NULL DEFAULT '5',
  `workexp` int(10) NOT NULL DEFAULT '0',
  `strength` int(10) NOT NULL DEFAULT '10',
  `defense` int(10) NOT NULL DEFAULT '10',
  `speed` int(10) NOT NULL DEFAULT '10',
  `battlewon` int(10) NOT NULL DEFAULT '0',
  `battlelost` int(10) NOT NULL DEFAULT '0',
  `battlemoney` int(20) NOT NULL DEFAULT '0',
  `crimesucceeded` int(10) NOT NULL DEFAULT '0',
  `crimefailed` int(10) NOT NULL DEFAULT '0',
  `crimemoney` int(20) NOT NULL DEFAULT '0',
  `points` bigint(20) NOT NULL DEFAULT '0',
  `rmdays` tinyint(5) NOT NULL DEFAULT '0',
  `signuptime` int(20) NOT NULL DEFAULT '0',
  `lastactive` int(20) NOT NULL DEFAULT '0',
  `awake` int(5) NOT NULL DEFAULT '100',
  `email` varchar(75) NOT NULL DEFAULT '',
  `jail` int(1) NOT NULL DEFAULT '0',
  `hospital` int(1) NOT NULL DEFAULT '0',
  `hwho` varchar(30) DEFAULT NULL,
  `hwhen` varchar(30) DEFAULT NULL,
  `hhow` varchar(30) DEFAULT NULL,
  `house` int(3) NOT NULL DEFAULT '0',
  `gang` int(10) NOT NULL DEFAULT '0',
  `quote` text,
  `avatar` varchar(50) DEFAULT NULL,
  `city` int(3) NOT NULL DEFAULT '1',
  `admin` int(1) NOT NULL DEFAULT '0',
  `searchdowntown` int(3) NOT NULL DEFAULT '100',
  `job` int(5) DEFAULT NULL,
  `ip` varchar(20) NOT NULL DEFAULT '0.0.0.0',
  `eqweapon` int(20) DEFAULT NULL,
  `eqarmor` int(20) DEFAULT NULL,
  `potseeds` int(20) DEFAULT NULL,
  `marijuana` int(20) DEFAULT NULL,
  `cocaine` int(20) DEFAULT NULL,
  `style` int(3) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `grpgusers`
--
ALTER TABLE `grpgusers`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `grpgusers`
--
ALTER TABLE `grpgusers`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=99;
COMMIT;
