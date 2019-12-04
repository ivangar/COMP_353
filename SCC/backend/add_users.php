<?php
if(!isset($_SESSION)) { session_start(); }
$event_id = $_GET["event_id"];
$location = "Location: ../frontend/event_details_page.php?event_id=$event_id" ;

if(isset($_POST["submit"]))
{
	include ("FileUploader.php");
	
	$newFile = new FileUploader();
	$newFile->createFile("user_file", "", "csv");
	
	if ($newFile->isCreated && ($h = fopen($newFile->filePath, "r")) !== FALSE) 
	{
	  	include("connection.php");

	  	$group_id = 0;
  		$sql = "SELECT primary_event_group_id FROM events WHERE event_id = $event_id";
		$result = $conn->query($sql);

		if ($result->num_rows > 0) {
			
		   	while($row = $result->fetch_assoc()) {
		    	$group_id = $row["primary_event_group_id"];

		    	  //get each line as an array seperated by an "|" 
				  while (($data = fgetcsv($h, 1000, "|")) !== FALSE) 
				  {		
					// Ignoring the lines of column titles. No need to store that in DB

					if(count($data) == 11 && $data[1] != "lastname"){   

						$last_name = !empty($data[1]) ? "'$data[1]'" : "NULL";
						$first_name = !empty($data[2]) ? "'$data[2]'" : "NULL";
						$middle_name = !empty($data[3]) ? "'$data[3]'" : "NULL";
						$userID = !empty($data[4]) ? "'$data[4]'" : "NULL";

						if(empty($data[5]))
							$pass = "";
						else
							$pass = "'". password_hash($data[5], PASSWORD_BCRYPT). "'";
						$address = !empty($data[6]) ? "'$data[6]'" : "NULL";
						$email = !empty($data[7]) ? "'$data[7]'" : "NULL";
						$date_of_birth = !empty($data[8]) ? "'$data[8]'" : "NULL";
						$org = !empty($data[9]) ? "'$data[9]'" : "NULL";

						$sql_user_exists = "SELECT user_id FROM users WHERE user_id = $userID";
						$result = $conn->query($sql_user_exists);
						if ($result->num_rows > 0) {
              
							//Check if the participant is already linked to the event
							$sql_event_participant = "SELECT * FROM group_members WHERE group_id = $group_id AND user_id = $userID";
							$result = $conn->query($sql_event_participant);
							if ($result->num_rows > 0) {
								continue;
							}

							//user might already exist in DB but not linked yet, so just link the user with the event
							$insert_event_participants = "INSERT INTO group_members (user_id, group_id, participant_status_id) VALUES ($userID, $group_id, 1)";
							if ($conn->query($insert_event_participants) != TRUE) {
								$_SESSION['users_imported'] = false;
								$_SESSION['errors'] .= " Error: " . $insert_event_participants . " Connection error: " . $conn->error . " ";
							}
						    
						}
						else{
							$insert_users = "INSERT INTO users (last_name, first_name, middle_name, user_id, user_pwd, address , date_of_birth , email , organization) VALUES ($last_name, $first_name, $middle_name, $userID, $pass ,$address , $date_of_birth, $email, $org )";
							if ($conn->query($insert_users) != TRUE) {
								$_SESSION['users_imported'] = false;
								$_SESSION['errors'] .= " Error: " . $insert_users . " Connection error: " . $conn->error . " ";
							}

							$insert_event_participants = "INSERT INTO group_members (user_id, group_id, participant_status_id) VALUES ($userID, $group_id, 1)";
							if ($conn->query($insert_event_participants) != TRUE) {
								$_SESSION['users_imported'] = false;
								$_SESSION['errors'] .= " Error: " . $insert_event_participants . " Connection error: " . $conn->error . " ";
							}
              
						}
            
              // Send email to added user
              $send_email = "INSERT INTO emails(receiver_id, sender_id, title, body) VALUES ("
                  . $userID.",". $_SESSION['active_user']['user_id']
                  . ", \"Event invitation\", \"You have been invited to event "
                  . $event_id
                  ." and have been added to this event, if you wish to leave the event, go to events page and select leave event.\")";

              if ($conn->query($send_email) != TRUE) {
                  $_SESSION['errors'] .= " Error: emails could not be send after importing user from csv";
              }
					  }
				  }

		    } 
		}


		fclose($h);
		$newFile->deleteFile();
		$conn->close();

		$_SESSION['users_imported'] = true;
		header($location);

	}
	else{
		$_SESSION['users_imported'] = false;
		$_SESSION['errors'] .= " Error: File was not uploaded correctly ";
		header($location);
	}
}
?>
