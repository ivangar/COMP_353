-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 21, 2019 at 11:50 PM
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
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `event_id` int(11) NOT NULL,
  `event_payment_id` int(11) DEFAULT NULL,
  `event_type_id` int(11) DEFAULT NULL,
  `resource_id` int(11) DEFAULT NULL,
  `event_manager_id` int(11) NOT NULL,
  `location_id` int(11) DEFAULT NULL,
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

--IF YOU WANT TO ADD DUMMY DATA TO EVENTS, MAKE SURE TO FIRST INSERT THE RECORDS IN THE OTHER TABLES REFERENCED BY THE FOREIGN KEYS (event_payment, event_locations, etc.)
/*
INSERT INTO `events` (`event_id`, `event_payment_id`, `event_type_id`, `resource_id`, `event_manager_id`, `location_id`, `event_name`, `start_date`, `end_date`, `period`, `status`, `total_cost`) VALUES
(1, 1, 1, 1, 4480757, 1, 'Wedding celebration', '2020-02-23', '2020-02-29', '2020-12-31', 1, 5300),
(2, 2, 2, 2, 4480757, 3, 'Halloween Party', '2020-10-31', '2020-10-31', '2022-10-31', 2, 350),
(3, 3, 3, 2, 4480757, 2, 'Bachelors party', '2020-01-08', '2020-01-11', '2022-01-11', 1, 700),
(4, 4, 2, 3, 6797613, 1, 'John\'s birthday', '2019-12-16', '2019-12-16', '2021-12-16', 2, 250),
(5, 4, 1, 1, 6797613, 2, 'Toronto Conference', '2020-01-10', '2020-01-18', '2020-01-18', 1, 250),
(6, 6, 2, 5, 4480757, 5, NULL, NULL, NULL, NULL, NULL, NULL);
*/
--
-- Triggers `events`
--
DELIMITER $$
CREATE TRIGGER `CreateEventForeignKeys` BEFORE INSERT ON `events` FOR EACH ROW BEGIN
	 	INSERT INTO `event_payment` (`name`, `address`, `phone_no`, `bank_name`, `account_number`, `payment_method`) VALUES (NULL, NULL, NULL, NULL, NULL, NULL);
	 	SET NEW.event_payment_id = LAST_INSERT_ID();
	 	INSERT INTO `resources` (`basic_fee`, `type`, `unit`, `name`, `extra_fee`, `discount`) VALUES (NULL, NULL, NULL, NULL, NULL, NULL);
	 	SET NEW.resource_id = LAST_INSERT_ID();
	 	INSERT INTO `event_locations` (`address`, `phone_no`, `email`, `room_no`, `renting_cost`, `capacity`) VALUES (NULL, NULL, NULL, NULL, NULL, NULL);
	 	SET NEW.location_id = LAST_INSERT_ID();
END
$$
DELIMITER ;

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
  ADD KEY `fk_event_type` (`event_type_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `event_id` int(11) NOT NULL AUTO_INCREMENT;

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
  ADD CONSTRAINT `fk_event_type` FOREIGN KEY (`event_type_id`) REFERENCES `event_types` (`event_type_id`) ON DELETE SET NULL ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
