<?php
/*
* This file is used to display event details of a specific event ID.
* It should be called from another file, by passing the event id as part of the url=event_details.php?event_id=2
*/

ini_set("display_errors","1");
session_start();

$user_id = $_SESSION['active_user']['user_id'];
$user_name = $_SESSION['active_user']['first_name'];
$event_id = (isset($_GET["event_id"]) && !empty($_GET["event_id"])) ? $_GET["event_id"] : 0;
$event_info = array();  //array holding main details
$event_location = array();  //array holding location details
$event_payment = array();  //array holding payment details

if($event_id){
	$sql = "SELECT * FROM events WHERE event_manager_id = $user_id AND event_id = $event_id";
	$result = $conn->query($sql);

	if ($result->num_rows > 0) {
	
	    // output data of each row
	    while($row = $result->fetch_assoc()) {
	    	$event_info = array("Event name"=>$row["event_name"], "Start Date"=>$row["start_date"], "End Date"=>$row["end_date"], "Status"=>$row["status"], "Total cost"=>$row["total_cost"]);
	    	$event_info_ids = array("Event name"=>"event_name", "Start Date"=>"start_date", "End Date"=>"end_date", "Status"=>"status", "Total cost"=>"total_cost");
	    }
	}
}

?>