<?php
/*
Author: Ivan Garzon
ID: 27006284
This file searches a specific user by id and populates the table if it exists and not part of the group/event/
*/
	session_start();
	require("../connection.php");

	$user_id = $_POST["user_id"];
	$group_id = $_POST["group_id"];

	//first check that this user actually exists in the DB
	$search_user_sql = "SELECT * FROM users WHERE user_id = $user_id";
	$search_result = $conn->query($search_user_sql);

	if ($search_result->num_rows > 0) {
		
		//Next check that this user is already a participant in the event
		$search_participant_sql = "SELECT * FROM group_members WHERE group_id = $group_id AND user_id = $user_id";
		$result = $conn->query($search_participant_sql);

		if ($result->num_rows > 0) {
			echo "This user is already a participant of your event, please check his status";	
		}

		else{
		    // fill in participant info
		    while($row = $search_result->fetch_assoc()) {
		    	$_SESSION['participant_data'] = array("user_id"=>$user_id,"First Name"=>$row["first_name"],"Last Name"=>$row["last_name"],"Middle Name"=>$row["middle_name"],"Address"=>$row["address"],"Date of birth"=>$row["date_of_birth"],"Email"=>$row["email"],"Organization"=>$row["organization"]);	
		    }
		}

	}

	else echo "This user does not exist in the database";

?>