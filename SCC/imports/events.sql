-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: grc353.encs.concordia.ca
-- Generation Time: Dec 01, 2019 at 08:48 PM
-- Server version: 8.0.18
-- PHP Version: 7.2.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `grc353_2`
--

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `event_id` int(11) NOT NULL,
  `event_payment_id` int(11) DEFAULT NULL,
  `event_type_id` int(11) DEFAULT NULL,
  `resource_id` int(11) DEFAULT NULL,
  `event_manager_id` int(11) NOT NULL,
  `location_id` int(11) DEFAULT NULL,
  `primary_event_group_id` int(11) DEFAULT NULL,
  `event_name` varchar(250) DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `period` date DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL,
  `total_cost` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`event_id`, `event_payment_id`, `event_type_id`, `resource_id`, `event_manager_id`, `location_id`, `primary_event_group_id`, `event_name`, `start_date`, `end_date`, `period`, `status`, `total_cost`) VALUES
(7, 1, 2, 4, 4480757, 1, 1, 'Weddings celebration', '2019-11-19', '2020-02-26', '2020-12-31', 1, 5000),
(8, 2, 3, 2, 4480757, 3, NULL, 'Halloween Party', '2019-11-19', '2019-11-29', '2019-12-27', 1, 500),
(9, 3, 4, 2, 4480757, 4, NULL, 'Bachelor party', '2020-01-07', '2020-01-11', '2022-01-11', 2, 800),
(10, NULL, 2, 3, 6797613, 5, NULL, 'John\'s birthday', '2019-12-16', '2019-12-16', '2021-12-16', 2, 250),
(11, 5, 1, 1, 6797613, 6, NULL, 'Toronto Conference', '2020-01-10', '2020-01-18', '2020-01-18', 1, 250),
(12, 6, 3, 5, 5526601, 7, NULL, 'siamak event', NULL, NULL, NULL, 2, 90),
(13, 7, 4, 6, 781264, 8, NULL, 'create test', NULL, NULL, NULL, 2, 123),
(14, 8, 4, 7, 1751053, 9, 5, 'proper test', '2019-11-20', '2019-05-30', NULL, 1, 4);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`event_id`),
  ADD KEY `fk_event_payment` (`event_payment_id`),
  ADD KEY `fk_event_resource` (`resource_id`),
  ADD KEY `fk_event_location` (`location_id`),
  ADD KEY `fk_event_manager` (`event_manager_id`),
  ADD KEY `fk_event_type` (`event_type_id`),
  ADD KEY `fk_primary_group_id` (`primary_event_group_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `event_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `events`
--
ALTER TABLE `events`
  ADD CONSTRAINT `fk_event_location` FOREIGN KEY (`location_id`) REFERENCES `event_locations` (`location_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_event_manager` FOREIGN KEY (`event_manager_id`) REFERENCES `users` (`user_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_event_payment` FOREIGN KEY (`event_payment_id`) REFERENCES `event_payment` (`event_payment_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_event_resource` FOREIGN KEY (`resource_id`) REFERENCES `resources` (`resource_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_event_type` FOREIGN KEY (`event_type_id`) REFERENCES `event_types` (`event_type_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_primary_group_id` FOREIGN KEY (`primary_event_group_id`) REFERENCES `groups` (`group_id`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
