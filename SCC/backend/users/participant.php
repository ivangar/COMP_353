<?php
	require("../backend/connection.php");

	//Get all the data from DB for a specific participant
	$participant_data = array();
	$participant_data_ids = array();
	$sql = "SELECT first_name, last_name, middle_name, address, date_of_birth, email, organization, e.participant_status_id 
			FROM users u
			JOIN event_participants e ON e.user_id = u.user_id
			WHERE e.event_id = $event_id AND u.user_id = $user_id";
	$result = $conn->query($sql);

	if ($result->num_rows > 0) {

	    // output data of each row
	    while($row = $result->fetch_assoc()) {
	    	$participant_data = array("First Name"=>$row["first_name"],"Last Name"=>$row["last_name"],"Middle Name"=>$row["middle_name"],"Address"=>$row["address"],"Date of birth"=>$row["date_of_birth"],"Email"=>$row["email"],"Organization"=>$row["organization"],"Status"=>$row["participant_status_id"]);
	    	$participant_data_ids = array("First Name"=>"first_name", "Last Name"=>"last_name", "Middle Name"=>"middle_name", "Address"=>"address", "Date of birth"=>"date_of_birth", "Email"=>"email", "Organization"=>"organization", "Status"=>"participant_status_id");
	    }
	}
?>