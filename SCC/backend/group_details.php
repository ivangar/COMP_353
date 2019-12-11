<?php 
/*
Author: Ivan Garzon
ID: 27006284
This script gets all the group details and saves it into an array
*/
if(!isset($_SESSION)){
    session_start();
}

$event_id = (isset($_GET["event_id"])) ? $_GET["event_id"] : 0;
$group_id = (isset($_GET["group_id"])) ? $_GET["group_id"] : 0;
$group_data = array();
$group_data_ids = array();
$group_manager = false;

$sql = "SELECT `group_manager_id`, `name`, `details`, `status` FROM `groups` WHERE `group_id` = $group_id AND `event_id` = $event_id";
$result = $conn->query($sql);

if ($result && $result->num_rows > 0) {
	
    // output data of each row
    while ($row = $result->fetch_assoc()) {
		$group_manager = ($_SESSION['active_user']["user_id"] === $row["group_manager_id"]) ? true : false;
        $group_data = array("Group Name"=>$row["name"], "Group Details"=>$row["details"], "Status"=>$row["status"], "manager_id"=>$row["group_manager_id"]);
		$group_data_ids = array("Group Name"=>"name", "Group Details"=>"details", "Status"=>"status", "manager_id"=>"group_manager_id");
    }

}
?>