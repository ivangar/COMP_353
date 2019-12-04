<?php	
	include ("connection.php");

	$username = "'" . $_POST["login_username"] . "'";
	//$pass = "'". password_hash($_POST["login_password"], PASSWORD_BCRYPT). "'";
	$pass = $_POST["login_password"];

	$sql = "SELECT * from users Where user_id = $username";


	$result = $conn->query($sql);
	
	if($result != true)
		echo "Error: " . $sql . "<br>" . $conn->error;

	
	if ($result->num_rows == 1) {
		
		while ($row = $result->fetch_assoc()) {

		  if($pass == $row['user_pwd'])
		  {
				session_start();
				$_SESSION['active_user'] = $row;
				header('Location: ../frontend/dashboard.php');
		  }
		  else
			  "invalid password";
		}
	}
	else 
		echo "Error: incorrect login";	
	$conn->close();
?>