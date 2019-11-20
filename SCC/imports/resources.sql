--
-- Table structure for table `resources`
--

CREATE TABLE `resources` (
  `resource_id` int(11) NOT NULL,
  `basic_fee` int(12) DEFAULT NULL,
  `type` varchar(100) DEFAULT NULL,
  `unit` varchar(50) DEFAULT NULL,
  `name` varchar(250) DEFAULT NULL,
  `extra_fee` int(12) DEFAULT NULL,
  `discount` int(12) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for table `resources`
--
ALTER TABLE `resources`
  ADD PRIMARY KEY (`resource_id`);


--
-- AUTO_INCREMENT for table `resources`
--
ALTER TABLE `resources`
  MODIFY `resource_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=0;