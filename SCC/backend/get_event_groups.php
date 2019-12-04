<?php
/*
* This file is used to display events that are managed by the current logged in user.
* It should be included from or redirected from another file (perhaps the home page)
*/
require("connection.php");
ini_set("display_errors","1");
if(!isset($_SESSION)){
  session_start();
}

$event_id = (isset($_GET["event_id"]) ) ? $_GET["event_id"] : 0;
$group_id = (isset($_GET["group_id"]) ) ? $_GET["group_id"] : 0;

$sql = "SELECT `group_id`, `name` FROM `groups` WHERE `event_id` = $event_id";
$result = $conn->query($sql);
$group_rows = array();

if ($result && $result->num_rows > 0) {
	
    // output data of each row
    while($row = $result->fetch_assoc()) {
        $group_url = "<a href='../frontend/event_home.php?event_id=$event_id&group_id=" . $row["group_id"] . "&group_name=" . $row["name"] . "'>" . $row['name'] . "</a>";
    	array_push($group_rows,$group_url);
    	$event_info = array();
    }
}

if(!empty($group_rows) && sizeof($group_rows) != 0)
{	
	echo "<div style='position:absolute; left:0; text-align: center;'> <div style='padding: 30px 0;'><a href='../frontend/view_group_details.php?event_id=$event_id&group_id=$group_id'>Group details</a></div>";
	echo "<table cellpadding='10' style='text-align: left;'><caption>Groups</caption><tbody>";
			
	foreach($group_rows as $group){ 
		echo "<tr><td>$group</td></tr>"; 
	}
	
	echo "</tbody></table></div>";
	

}
?>