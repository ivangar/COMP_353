--
-- Table structure for table `event_payment`
--

CREATE TABLE `event_payment` (
  `event_payment_id` int(11) NOT NULL,
  `name` varchar(250) DEFAULT NULL,
  `address` varchar(500) DEFAULT NULL,
  `phone_no` varchar(15) DEFAULT NULL,
  `bank_name` varchar(100) DEFAULT NULL,
  `account_number` varchar(250) DEFAULT NULL,
  `payment_method` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for table `event_payment`
--
ALTER TABLE `event_payment`
  ADD PRIMARY KEY (`event_payment_id`);

--
-- AUTO_INCREMENT for table `event_payment`
--
ALTER TABLE `event_payment`
  MODIFY `event_payment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=0;