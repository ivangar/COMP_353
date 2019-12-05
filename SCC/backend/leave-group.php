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

$group_id = $_POST['group_id'];

$sql = "DELETE FROM `group_members` WHERE `user_id` = '$userid' AND `group_id` = '$group_id'";
$result = $conn->query($sql);
if($result){
		echo "here?";
	echo "$userid";
	echo "$group_id";
} else {
	echo "here?";
	echo "$userid";
	echo "$group_id";
}

?>