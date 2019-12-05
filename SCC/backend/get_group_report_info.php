<?php
// session_start();
if (!isset($_SESSION['active_user'])) {
    header("Location: ../frontend/dashboard.php");
}

if (isset($_GET["group_id"])) {
    include "connection.php";
    $group_id = $_GET["group_id"];
    $user_id = $_SESSION['active_user']['user_id'];

} else {
    $group_id = $event["primary_event_group_id"];
}

if (is_null($group_id)) {
    echo "we gotta break here <br>";
}
//TODO add authorization here

$sql = "SELECT first_name , middle_name, last_name FROM `users` JOIN group_members ON users.user_id = group_members.user_id WHERE group_members.group_id = $group_id AND group_members.participant_status_id = 1";
$group_members = $conn->query($sql);

$sql = "SELECT `posts`.`user_id`,`posts`.`upload_date` FROM `groups` JOIN `posts` on `groups`.`group_id` = `posts`.`group_id` WHERE `posts`.`group_id` = $group_id ORDER BY `posts`.`upload_date` LIMIT 1";
$result = $conn->query($sql);

$first_post_date = $result->fetch_assoc()["upload_date"];

$sql = "SELECT `posts`.`user_id`,`posts`.`upload_date` FROM `groups` JOIN `posts` on `groups`.`group_id` = `posts`.`group_id` WHERE `posts`.`group_id` = $group_id ORDER BY `posts`.`upload_date` DESC LIMIT 1";
$result = $conn->query($sql);
$latest_post_date = $result->fetch_assoc()["upload_date"];

$sql = "SELECT CAST(upload_date AS DATE) AS 'most_frequent' , COUNT(upload_date) AS 'frequency' FROM posts WHERE group_id = $group_id GROUP BY CAST(upload_date AS DATE) ORDER BY 'frequency' DESC ";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
$most_active_dates = array();
$highest_frequency = $row['frequency'];
do {
    if ($row['frequency'] == $highest_frequency) {
        array_push($most_active_dates, $row['most_frequent']);
    } else {
        break;
    }

} while ($row = $result->fetch_assoc());
