<?php
/*
* This file is used to display events that are managed by the current logged in user.
* It should be included from or redirected from another file (perhaps the home page)
*/
include("../backend/user_role_relation.php");
ini_set("display_errors","1");
if(!isset($_SESSION)){
  session_start();
}

$user_id = $_SESSION['active_user']['user_id'];
$user_name = $_SESSION['active_user']['first_name'];

if($roleId != 0) {
    $sql = "SELECT * FROM events WHERE event_manager_id = $user_id";
}
else {
    $sql = "SELECT * FROM events"; 
}
$result = $conn->query($sql);
$event_rows = array();

if ($result->num_rows > 0) {
	
    // output data of each row
    while($row = $result->fetch_assoc()) {
    	if($row['status'] == '2') {
            $status = 'archived';
    		$event_details_url = "<a href='form_event_finalizer.php?event_id=" . $row["event_id"] . "'>Finalize Event</a>";
    	} else if($row['status'] == '1') {
            $status = 'active';
    		$event_details_url = "<a href='event_details_page.php?event_id=" . $row["event_id"] . "'>view details</a>";
    	}
        $event_name = "<a href='event_home.php?event_id=" . $row["event_id"] . "'>" . $row['event_name'] . "</a>";
    	$event_info = array($row["event_id"],$event_name,$row["start_date"],$row["end_date"],$status,$event_details_url);
    	array_push($event_rows,$event_info);
    	$event_info = array();
    }
}

?>