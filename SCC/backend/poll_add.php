<?php
/*
Author: Jesse Desmarais
ID: 40035761
Called when the event manager tries to add a poll
*/

    include("authorize_event.php");
    $group_id = $_GET["group_id"];
    $date = $_POST["end_date"];
    $title = $_POST["title"];
    $options = $_POST["option_list"];
    $sql = "INSERT INTO `poll` (`poll_id`, `group_id`, `title`, `end_date`, `options`) VALUES (NULL, $group_id, '$title', '$date', '$options')";
    $conn->query($sql);
    header("Location: ../frontend/event_home.php?event_id=$event_id&group_id=$group_id");



?>