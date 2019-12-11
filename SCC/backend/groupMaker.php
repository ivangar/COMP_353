<?php
/*
Author: Ivan Garzon
ID: 27006284
This script inserts a new group linked to the current event. It inserts all the members that were selected by the user
into the group members table. Thus these users become group members at the creation of a group. The user can also not
adding any member yet, however he becomes the group manager and the only group member of this group.
*/
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

$selectedUser = array();

if(!empty($_POST['userSelected']) && sizeof($_POST['userSelected']) != 0) {
	$selectedUser = $_POST['userSelected'];
}
array_push($selectedUser, $userid);
$groupName = $_POST['group_name'];
$groupDetails = $_POST['group_details'];
$eventId = $_POST['event_id'];

$sql = "INSERT INTO `groups`(event_id, group_manager_id, name, details) VALUES ($eventId, $userid, '$groupName', '$groupDetails');";

if($conn->query($sql) === TRUE) {
	$last_id = $conn->insert_id;
	foreach ($selectedUser as $key => $value) {
		$groupMemberSql = "INSERT INTO `group_members`(user_id, group_id, participant_status_id) VALUES ($value, $last_id, '1');";
		if($conn->query($groupMemberSql) !== TRUE){
			echo "error user id $value was not inserted into the new group";
		}
	}
	echo $last_id;
} else {
	echo "Error: " . $sql . "<br>" . $conn->error;
}

?>