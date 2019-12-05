<?php
/*
 * This file is used to display events that are managed by the current logged in user.
 * It should be included from or redirected from another file (perhaps the home page)
 */
require "connection.php";
ini_set("display_errors", "1");
if (!isset($_SESSION)) {
    session_start();
}

$event_id = (isset($_GET["event_id"])) ? $_GET["event_id"] : 0;
$group_id = (isset($_GET["group_id"])) ? $_GET["group_id"] : 0;

$sql = "SELECT `group_id`, `name` FROM `groups` WHERE `event_id` = $event_id";
$result = $conn->query($sql);
$group_rows = array();

if ($result && $result->num_rows > 0) {

    // output data of each row
    while ($row = $result->fetch_assoc()) {
        $group_url = "<a href='../frontend/event_home.php?event_id=$event_id&group_id=" . $row["group_id"] . "&group_name=" . $row["name"] . "'>" . $row['name'] . "</a>";
        array_push($group_rows, $group_url);
        $event_info = array();
    }
}
if (!empty($group_rows) && sizeof($group_rows) != 0) {
    echo "
	<div class='container pt-5'>
		<a class='btn btn-primary mt-3 mb-3' href='../frontend/view_group_details.php?event_id=$event_id&group_id=$group_id'>Current Group Details</a>
		<form method='POST' action='../backend/leave-group.php'><input type='hidden' name='event_id' value=$event_id></input><input type='hidden' name='group_id' value=$group_id></input><button class='btn btn-primary mt-3 mb-3' type='submit'>Leave Group</button></form>
		<div class='card'>
			<div class='card-header'>
				<p>Groups List</p>
			</div>
			<ul class='list-group list-group-flush'>";

    foreach ($group_rows as $group) {
        echo "<li class='list-group-item'>$group</li>";
    }
    echo "</ul></div></div>";
}
