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

if (isset($_SESSION['group_id'])) {
	$group_id = $_SESSION['group_id'];
}
$sql = "INSERT INTO `group_members`(user_id, group_id, participant_status_id) VALUES ($userid, $group_id, 2)";
$result = $conn->query($sql);
if($result){
	header("Location: ../frontend/dashboard.php");
}

?>