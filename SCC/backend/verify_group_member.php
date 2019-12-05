<?php
include("connection.php");
//start session
if(!isset($_SESSION)){
    session_start();
}
//check that user is logged in
if(!isset($userid)){
    $userid = $_SESSION['active_user']['user_id'];
} else {
    $_SESSION['error'] = "Error - No user logged in";
}

$sql = "SELECT * \n"

    . "FROM `group_members`\n"

    . "WHERE user_id = $userid AND group_id = $group_id";

$result = $conn->query($sql);
if($result){
	if($result -> num_rows > 0){
		$_SESSION['group_member'] = true;
	}
	else {
		$_SESSION['group_member'] = false;		
	}
}

?>