<?php
	require("../connection.php");

	if(isset($_POST) && (!empty($_POST))){
		if($_POST['action'] === 'update_participant'){

			//Setting up post params

			$data = $_POST;
			$event_id = $data['event_id'];
			$user_id = $data['user_id'];
			$first_name = $data['first_name'];
			$last_name = $data['last_name'];
			$middle_name = $data['middle_name'];
			$address = $data['address'];
			$date_of_birth = $data['date_of_birth'];
			$email = $data['email'];
			$organization = $data['organization'];
			$status = $data['status'];
			$updated_tables = 0;

			//Test Null values, set default for empty fields and wrap strings around single quotes

  			$first_name = !empty($first_name) ? "'$first_name'" : "NULL";
  			$last_name = !empty($last_name) ? "'$last_name'" : "NULL";
  			$middle_name = !empty($middle_name) ? "'$middle_name'" : "NULL";
  			$address = !empty($address) ? "'$address'" : "NULL";
  			$date_of_birth = !empty($date_of_birth) ? "'$date_of_birth'" : "0000-00-00";
  			$email = !empty($email) ? "'$email'" : "NULL";
  			$organization = !empty($organization) ? "'$organization'" : "NULL";

			//Update users table
			$sql = "UPDATE users 
			      SET first_name = $first_name, middle_name = $middle_name, last_name = $last_name, address = $address, date_of_birth = $date_of_birth, email = $email, organization = $organization
			      WHERE user_id = $user_id";

			if ($conn->query($sql) === TRUE) {
			    $updated_tables++;
			} else {
			    echo "error " . $conn->error;
			}

			//Update event_participants table
			$sql = "UPDATE event_participants 
			      SET participant_status_id = $status
			      WHERE event_id = $event_id AND user_id = $user_id";

			if ($conn->query($sql) === TRUE) {
			    $updated_tables++;
			} else {
			    echo "error " . $conn->error;
			}

			if($updated_tables == 2) echo "updated";

		}

		if($_POST['action'] === 'add_participant'){

			//Setting up post params
			
			$data = $_POST;
			$event_id = $data['event_id'];
			$user_id = $data['user_id'];

			//user might already exist in DB but not linked yet, so just link the user with the event
			$insert_event_participants = "INSERT INTO event_participants (event_id, user_id, participant_status_id) VALUES ($event_id, $user_id, 1)";
			if ($conn->query($insert_event_participants) != TRUE) {
				echo "error " . $conn->error;
			}
			else {
			    echo "success";
			}

		}	
	}
?>