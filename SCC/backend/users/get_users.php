<?php
	require("../backend/connection.php");

	//Get all the users from DB and generate select list
	$users = array();
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

?>