<?php
/*
Author: Ivan Garzon
ID: 27006284
This script updates a resource of an event.
*/

ini_set("display_errors","1");
session_start();
require("connection.php");

if(isset($_POST) && (!empty($_POST))){

  //Setting up post params

  $data = $_POST;
  $resource_id = $data['resource_id'];
  $flat_fee = $data['flat_fee']; 
  $resource_type = $data["resource_type"];
  $unit = $data["unit"];
  $resource_name = $data['resource_name'];
  $extra_fee = $data['extra_fee']; 
  $discount = $data['discount']; 
  $payment_receiver = $data['payment_receiver']; 
  
  //Test Null values, set default for empty fields and wrap strings around single quotes

  $flat_fee = !empty($flat_fee) ? "$flat_fee" : "NULL";
  $resource_type = !empty($resource_type) ? "'$resource_type'" : "NULL"; 
  $unit = !empty($unit) ? "'$unit'" : "NULL"; 
  $resource_name = !empty($resource_name) ? "'$resource_name'" : "NULL"; 
  $extra_fee = !empty($extra_fee) ? "$extra_fee" : "NULL";
  $discount = !empty($discount) ? "$discount" : "NULL";
  $payment_receiver = !empty($payment_receiver) ? "'$payment_receiver'" : "NULL";

    
  //Update resources table
  $sql = "UPDATE resources 
          SET flat_fee = $flat_fee, type = $resource_type, unit = $unit, resource_name = $resource_name, extra_fee = $extra_fee, discount = $discount, payment_receiver = $payment_receiver
          WHERE resource_id = $resource_id";
  
    if ($conn->query($sql) === TRUE) {
        echo "updated";
    } else {
        echo "error " . $conn->error;
    }

      

}