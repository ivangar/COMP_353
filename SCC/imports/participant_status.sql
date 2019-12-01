-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 30, 2019 at 02:27 AM
-- Server version: 10.4.6-MariaDB
-- PHP Version: 7.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `scc_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `participant_status`
--

CREATE TABLE `participant_status` (
  `participant_status_id` int(11) NOT NULL,
  `status` varchar(100) NOT NULL,
  `description` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `participant_status`
--

INSERT INTO `participant_status` (`participant_status_id`, `status`, `description`) VALUES
(1, 'approved', 'The participant has been approved by the admin'),
(2, 'rejected', 'The participant has been rejected by the admin'),
(3, 'pending', 'A user requested to join a group/event but has not been approved by the admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `participant_status`
--
ALTER TABLE `participant_status`
  ADD PRIMARY KEY (`participant_status_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
