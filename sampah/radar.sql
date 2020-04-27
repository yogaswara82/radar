-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 18, 2018 at 05:35 PM
-- Server version: 10.1.36-MariaDB
-- PHP Version: 7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bismillahwebgis`
--

-- --------------------------------------------------------

--
-- Table structure for table `uny`
--

CREATE TABLE `uny` (
  `id` varchar(20) NOT NULL,
  `name` varchar(100) NOT NULL,
  `addres` varchar(100) NOT NULL,
  `type` varchar(20) NOT NULL,
  `long` float DEFAULT NULL,
  `lat` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `uny`
--

INSERT INTO `uny` (`id`, `name`, `addres`, `type`, `long`, `lat`) VALUES
('1', 'coba uny', 'nang uny', 'coba', 110.407, -7.7699),
('2', 'coba ft uny', 'nang ft uny', 'cobaa', 110.386, -7.76913),
('3', 'coba fis', 'nang fis', 'cobaaa', 110.385, -7.77351);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `uny`
--
ALTER TABLE `uny`
  ADD PRIMARY KEY (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
