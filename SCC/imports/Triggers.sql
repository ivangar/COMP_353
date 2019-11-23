/* This trigger creates a new row for each of the tables that have a functional dependency on Event.
Before inserting a new record in Events table, we need the foreign keys of event payment, event type, resources and event location
In order to be able to create a new row without violating foreign key dependency, this trigger creates a set of empty rows and gets the new ids
and then inserts these as foreign keys.
The new rows are empty for now, but will be used later, when event manager updates the event info*/

DELIMITER $$
CREATE TRIGGER `CreateEventForeignKeys` BEFORE INSERT ON `events`
 FOR EACH ROW BEGIN
	 	INSERT INTO `event_payment` (`name`, `address`, `phone_no`, `bank_name`, `account_number`, `payment_method`) VALUES (NULL, NULL, NULL, NULL, NULL, NULL);
	 	SET NEW.event_payment_id = LAST_INSERT_ID();
	 	INSERT INTO `resources` (`basic_fee`, `type`, `unit`, `name`, `extra_fee`, `discount`) VALUES (NULL, NULL, NULL, NULL, NULL, NULL);
	 	SET NEW.resource_id = LAST_INSERT_ID();
	 	INSERT INTO `event_locations` (`address`, `phone_no`, `email`, `room_no`, `renting_cost`, `capacity`) VALUES (NULL, NULL, NULL, NULL, NULL, NULL);
	 	SET NEW.location_id = LAST_INSERT_ID();
END
$$
DELIMITER ;