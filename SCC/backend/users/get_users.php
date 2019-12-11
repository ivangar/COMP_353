<?php
/*
Author: Ivan Garzon
ID: 27006284
This file gets all the users and saves the data as an array
*/
	require("../backend/connection.php");

	//Get all the users from DB and generate select list
	$users = array();
	$participants = array();
	$sql = "SELECT user_id, first_name, last_name FROM users";
	$result = $conn->query($sql);

	if ($result->num_rows > 0) {
		
	    // output data of each row
	    while($row = $result->fetch_assoc()) {
	    	$user_name = $row["first_name"] . " " . $row["last_name"];
	    	$user_data = array("user_id"=>$row["user_id"],"name"=>$user_name);
	    	array_push($users,$user_data);
	    	$user_data = array();
	    }
	}

	//Generate a select list of users
	if(!empty($users) && sizeof($users) != 0) {
		$user_id = 0;
		$select_list = "<select name='user_id' required><option disabled selected value>-- select a user -- </option>";
		foreach($users as $user) { 
			foreach($user as $label => $value) { 
				if($label === "user_id")
					$user_id = $value;
				else
					$select_list .= "<option value='$user_id'>$value</option>";
			}
		}
		
		$select_list .= "</select>";
	}

	//If this file is called to view all participants related to an event then get all users linked to the event
	if(isset($group_id) && $group_id){
		$sql = "SELECT u.*, p.status FROM users u
				JOIN group_members g ON g.user_id = u.user_id
				JOIN participant_status p ON p.participant_status_id = g.participant_status_id
				WHERE g.group_id = $group_id";

		$result = $conn->query($sql);

		if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
				$user_name = $row["first_name"] . " " . $row["last_name"];
				$edit_participant_url = "<a href='edit_participant.php?user_id=" . $row["user_id"] . "&group_id=" . $group_id . "&group_name=".$group_name."'>edit</a>";
				$participant_info = ($group_manager) ? array($user_name,$row["address"],$row["date_of_birth"],$row["email"],$row["organization"],$row["status"],$edit_participant_url) :
									array($user_name,$row["address"],$row["date_of_birth"],$row["email"],$row["organization"],$row["status"]);
		    	array_push($participants,$participant_info);
		    	$participant_info = array();
			}
		}

	}

?>