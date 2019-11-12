-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 06, 2019 at 09:11 PM
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
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `user_name` varchar(250) NOT NULL,
  `user_pwd` varchar(500) NOT NULL,
  `address` varchar(500) DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `email` varchar(120) DEFAULT NULL,
  `organization` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `users` (`user_id`, `user_name`, `user_pwd`, `address`, `date_of_birth`, `email`, `organization`) VALUES
(1, 'Ivan', 'pwd', '1455 Boulevard de Maisonneuve O, Montreal, QC H3G 1M8', '1989-10-04', 'garzon861@gmail.com', NULL),
(2, 'Jesse', 'pwd', 'asda', '2019-11-06', 'jesse@gmail.com', NULL),
(3, 'Ragith', 'pwd', 'random', '1993-11-05', 'ragith@gmail.com', 'Wonderland Inc.'),
(4, 'Samie', 'pwd', 'next door', '1991-03-14', NULL, 'Monsters Inc.'),
(5, 'Nico', 'pwd', 'addr', '1994-11-06', 'nico@gmail.com', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `event_id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `event_payment_id` int(11) NOT NULL,
  `event_type_id` int(11) NOT NULL,
  `resource_id` int(11) NOT NULL,
  `event_manager_id` int(11) NOT NULL,
  `location_id` int(11) NOT NULL,
  `event_name` varchar(250) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `period` date NOT NULL,
  `status` tinyint(1) NOT NULL,
  `total_cost` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `events` (`event_id`, `event_payment_id`, `event_type_id`, `resource_id`, `event_manager_id`, `location_id`, `event_name`, `start_date`, `end_date`, `period`, `status`, `total_cost`) VALUES
(1, 1, 1, 1, 1, 1, 'Wedding celebration', '2019-12-22', '2019-12-23', '2020-12-31', 1, 5000),
(2, 2, 2, 2, 1, 2, 'Halloween Party', '2020-10-31', '2020-10-31', '2022-10-31', 1, 350),
(3, 3, 1, 2, 1, 3, 'Bachelor\'s party', '2020-01-08', '2020-01-11', '2022-01-11', 1, 700),
(4, 4, 2, 3, 1, 4, 'John\'s birthday', '2019-12-16', '2019-12-16', '2021-12-16', 1, 250);

COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
