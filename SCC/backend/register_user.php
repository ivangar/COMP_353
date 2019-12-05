<?php
	include ("connection.php");

	$fname = "'" . $_POST["register_fname"] . "'";
    $mname = "'" . $_POST["register_mname"] . "'";
    $lname = "'" . $_POST["register_lname"] . "'";
    $address = "'" . $_POST["register_address"] . "'";
    $dob = "'" . $_POST["register_dob"] . "'";
    $email = "'" . $_POST["register_email"] . "'";
    $org = "'" . $_POST["register_org"] . "'";

	$pass = "'". password_hash($_POST["register_password"], PASSWORD_BCRYPT). "'";
	//$pass = $_POST["register_password"];

	$sql = "Insert into `users`(`first_name`, `middle_name`, `last_name`, `user_pwd`, `address`, `date_of_birth`, `email`, `organization`)
 Values($fname, $mname, $lname, $pass, $address, $dob, $email, $org)";


	$result = $conn->query($sql);

	if($result != true) {
        echo "Error: " . $sql . "<br>" . $conn->error;
        echo "Error: incorrect Registration";
    }
    else

        $get_userid = "Select u.user_id from users u where u.email = $email";
        $result = $conn->query($get_userid);
        if($result->num_rows > 0) {
            $useridRow = $result->fetch_assoc();
            $userid = $useridRow["user_id"];

            $send_email = "INSERT INTO emails(receiver_id, sender_email, title, body) VALUES ("
                . $userid
                . ", 'sandra@email.com', '"
                . $conn->real_escape_string("New Registration")
                . "', '"
                . $conn->real_escape_string("Congrats on creating an account, your UserId for logging in is: ")
                . $userid
                . "')";

            if ($conn->query($send_email) != TRUE) {
                $_SESSION['errors'] .= " Error: emails could not be sent to newly registered user";
            }

            echo '<script type="text/javascript">';
            echo "window.location.href = \"../frontend/index.php\";";
            echo "alert(\"Your User Id to login : $userid\")";
            echo '</script>';
        }

	$conn->close();
?>