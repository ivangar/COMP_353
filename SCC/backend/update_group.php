<?php
/*
Author: Ivan Garzon
ID: 27006284
This script updates the group information
*/

ini_set("display_errors","1");
if(!isset($_SESSION)){
    session_start();
}
require("connection.php");

if(isset($_POST) && (!empty($_POST))){

  //Setting up post params

  $data = $_POST;
  $event_id = $data['event_id'];
  $group_id = $data['group_id'];
  $group_name = $data['name']; 
  $group_details = $data["details"];
  $group_status = $data["status"];
  $group_manager_id = $data['group_manager_id'];
  
  //Test Null values, set default for empty fields and wrap strings around single quotes

  $group_name = !empty($group_name) ? "'$group_name'" : "NULL";
  $group_details = !empty($group_details) ? "'$group_details'" : "NULL";
  $group_status = !empty($group_status) ? "$group_status" : "2";
  $group_manager_id = !empty($group_manager_id) ? "$group_manager_id" : $_SESSION['active_user']["user_id"];

  //Update groups table
  $sql = "UPDATE `groups` 
          SET `group_manager_id` = $group_manager_id, `name` = $group_name, `details` = $group_details, `status` = $group_status
          WHERE `group_id` = $group_id";
  
    if ($conn->query($sql) === TRUE) {
        echo "updated";
    } else {
        echo "error " . $conn->error;
    }
}