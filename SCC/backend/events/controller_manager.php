<?php
/*
 * This file is used to display all events for the controller to set specific details.
 */

include "../backend/user_role_relation.php";
ini_set("display_errors", "1");
if (!isset($_SESSION)) {
    session_start();
}

$user_id = $_SESSION['active_user']['user_id'];
$user_name = $_SESSION['active_user']['first_name'];

if (isset($roleId) && $roleId == 0) {
    $sql = "SELECT * FROM events";
} else {
    $sql = "SELECT `e`.`event_id`,`e`.`primary_event_group_id` , `e`.`status`, `e`.`event_name`, `e`.`start_date`, `e`.`end_date`, `group_members`.`user_id`     \n"

        . "FROM `events` AS `e`\n"

        . "INNER JOIN `groups` ON `e`.`primary_event_group_id` = `groups`.`group_id`\n"

        . "INNER JOIN `group_members`ON `groups`.`group_id` = `group_members`.`group_id`\n"

        . "WHERE `group_members`.`user_id` = $user_id AND (`e`.`status` = 1 OR `e`.`event_manager_id` = $user_id)";
}
$result = $conn->query($sql);
$event_rows = array();

if ($result && $result->num_rows > 0) {

    // output data of each row
    while ($row = $result->fetch_assoc()) {
        $event_details_url = "<a href='form_event_controller.php?event_id=" . $row["event_id"] . "'>Set Resources</a>";
        $event_name = "<a href='event_home.php?event_id=" . $row["event_id"] . "&group_id=" . $row["primary_event_group_id"] . "'>" . $row['event_name'] . "</a>";
        $event_info = array($row["event_id"], $event_name, $row["start_date"], $row["end_date"], $event_details_url);
        array_push($event_rows, $event_info);
        $event_info = array();
    }
}
