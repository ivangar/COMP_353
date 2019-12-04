<?php

if(!isset($_GET["event"]) && !isset($_GET["primary"]))
	exit();
include("connection.php");

$event_id = $_GET["event"];
$event_primary_group_id = $_GET["primary"];

if(isset($_GET["search"])) {
	$search_query = $_GET["search"];
	echo "Groups with tags containing : $search_query";
}
else
	$search_query = "";
$sql = "select group_id,name from groups WHERE event_id = $event_id AND NOT group_id = $event_primary_group_id AND `meta_data` LIKE '%$search_query%'";
$event_groups = $conn->query($sql);

echo "Number of groups ". $event_groups->num_rows . "<br>";

while($row = $event_groups->fetch_assoc()) {
	echo "<a target='_blank' href='../frontend/group_report.php?group_id=" . $row["group_id"]."'> Get report for : ". $row["name"]. "</a><br>";
}

?>