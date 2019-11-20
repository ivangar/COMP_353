-- --------------------------------------------------------

--
-- Table structure for table `event_locations`
--

CREATE TABLE `event_locations` (
  `location_id` int(11) NOT NULL,
  `address` varchar(500) DEFAULT NULL,
  `phone_no` varchar(15) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `room_no` int(5) DEFAULT NULL,
  `renting_cost` int(12) DEFAULT NULL,
  `capacity` int(12) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for table `event_locations`
--
ALTER TABLE `event_locations`
  ADD PRIMARY KEY (`location_id`);

--
-- AUTO_INCREMENT for table `event_locations`
--
ALTER TABLE `event_locations`
  MODIFY `location_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=0;