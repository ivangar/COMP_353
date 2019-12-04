<?php 
require("authorize.php");
require("connectioh.php");


$sql = "SELECT COUNT(*) AS 'permission' FROM groups JOIN events ON events.event_id = groups.event_id WHERE groups.group_id = $group_id AND events.event_manager_id = $user_id";
$result = $conn->query($sql);

if ($result->fetch_assoc()["COUNT(*)"] == 0) {
	  header("Location: ../frontend/dashboard.php");
}

?>