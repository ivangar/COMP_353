<?php

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
			echo $data[5];
			echo "<br>";
			if(empty($data[5]))
				$pass = "";
			else
				$pass = "'". password_hash($data[5], PASSWORD_BCRYPT). "'";
			$address = !empty($data[6]) ? "'$data[6]'" : "NULL";
			$email = !empty($data[7]) ? "'$data[7]'" : "NULL";
			$date_of_birth = !empty($data[8]) ? "'$data[8]'" : "NULL";
			$org = !empty($data[9]) ? "'$data[9]'" : "NULL";
			
			$sql = "INSERT INTO users (last_name, first_name, middle_name, user_ID, user_pwd, address , date_of_birth , email , organization) VALUES ($last_name, $first_name, $middle_name, $userID, $pass ,$address , $date_of_birth, $email, $org )";
			if ($conn->query($sql) != TRUE) {
				echo "Error: " . $sql . "<br>" . $conn->error;
			}
		}
	  }

	  echo "Copying contents from CSV to mysql complete";

	  fclose($h);
	  $newFile->deleteFile();
	  $conn->close();

	}
	else
		echo "file bad";
}
?>
