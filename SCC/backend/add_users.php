<?php
session_start();
$event_id = $_GET["event_id"];

if(isset($_POST["submit"]))
{
	include ("FileUploader.php");
	
	$newFile = new FileUploader();
	$newFile->createFile("user_file", "", "csv");
	
	if ($newFile->isCreated && ($h = fopen($newFile->filePath, "r")) !== FALSE) 
	{
	  include("connection.php");

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
				$sql_event_participant = "SELECT * FROM event_participants WHERE event_id = $event_id AND user_id = $userID";
				$result = $conn->query($sql_event_participant);
				if ($result->num_rows > 0) {
					continue;
				}

				//user might already exist in DB but not linked yet, so just link the user with the event
				$insert_event_participants = "INSERT INTO event_participants (event_id, user_id, participant_status_id) VALUES ($event_id, $userID, 1)";
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

				$insert_event_participants = "INSERT INTO event_participants (event_id, user_id, participant_status_id) VALUES ($event_id, $userID, 1)";
				if ($conn->query($insert_event_participants) != TRUE) {
					$_SESSION['users_imported'] = false;
					$_SESSION['errors'] .= " Error: " . $insert_event_participants . " Connection error: " . $conn->error . " ";
				}
			}

		}
	  }

	  fclose($h);
	  $newFile->deleteFile();
	  $conn->close();

	  $_SESSION['users_imported'] = true;
	  header("Location: ../frontend/event_details_page.php?event_id=".$event_id);

	}
	else{
		$_SESSION['users_imported'] = false;
		$_SESSION['errors'] .= " Error: File was not uploaded correctly ";
		header("Location: ../frontend/event_details_page.php?event_id=".$event_id);
	}
}
?>
