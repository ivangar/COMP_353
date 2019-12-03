<?php
include("connection.php");

if(!isset($_SESSION)){
    session_start();
}

//check that user is logged in
if(!isset($userid)){
    $userid = $_SESSION['active_user']['user_id'];
} else {
    $_SESSION['error'] = "Error - No user logged in";
}

$selectedUser = $_POST['userSelected'];
array_push($selectedUser, $userid);
$groupName = $_POST['group_name'];
$groupDetails = $_POST['group_details'];
$eventId = $_POST['event_id'];

$sql = "INSERT INTO `groups`(event_id, name, details) VALUES ($eventId, '$groupName', '$groupDetails');";

if($conn->query($sql) === TRUE) {
	$last_id = $conn->insert_id;
	echo "New record created successfully. Last inserted ID is: " . $last_id;
	foreach ($selectedUser as $key => $value) {
		$groupMemberSql = "INSERT INTO `group_members`(user_id, group_id, participant_status_id) VALUES ($value, $last_id, '1');";
		if($conn->query($groupMemberSql) === TRUE){
			echo "new groupmembers added";
		}
	}
	header("Location: ../frontend/event_home.php?&group_id=" . $last_id);
} else {
	echo "Error: " . $sql . "<br>" . $conn->error;
}

?>