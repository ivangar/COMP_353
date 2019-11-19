<?php
/*
* This file is used to display event details of a specific event ID.
* It should be called from another file, by passing the event id as part of the url=event_details.php?event_id=2
*/

ini_set("display_errors","1");
session_start();
require("../connection.php");

$user_id = $_SESSION['active_user']['user_id'];
$user_name = $_SESSION['active_user']['first_name'];


if(isset($_POST) && (!empty($_POST))){

  $data = $_POST;

  $event_id = $data['event_id']; 
  $event_name = $data['event_name'];  
  $start_date = $data['start_date']; 
  $end_date = $data['end_date']; 
  $status = $data['status']; 
  $total_cost = $data['total_cost'];  

  $sql = "UPDATE events 
          SET event_name = '$event_name', start_date = '$start_date', end_date = '$end_date', status = $status, total_cost = $total_cost
          WHERE event_id = $event_id";
  
    if ($conn->query($sql) === TRUE) {
        echo "updated";
    } else {
        echo "error " . $conn->error;
    }

}