<?php
/*
* This file is used to display event details of a specific event ID.
* It should be called from another file, by passing the event id as part of the url=event_details.php?event_id=2
*/

ini_set("display_errors","1");
session_start();
require("../connection.php");

if(isset($_POST) && (!empty($_POST))){

  //Setting up post params

  $data = $_POST;
  //print_r($data);
  $event_id = $data['event_id'];
  $event_location_id = $data['location_id']; 
  $event_payment_id = $data["payment_id"];
  $event_resource_id = $data["resource_id"];
  $event_name = $data['event_name'];
  $start_date = $data['start_date']; 
  $end_date = $data['end_date']; 
  $period = $data['period']; 
  $status = $data['status']; 
  $total_cost = $data['total_cost'];
  $event_type = $data['event_types'];
  $recurrent_event = $data['recurrent_event'];
  $event_address = $data['address'];
  $event_phone_no = $data['phone_no'];
  $event_email = $data['email'];
  $event_room_no = $data['room_no'];
  $event_renting_cost = $data['renting_cost'];
  $event_capacity = $data['capacity'];
  $account_holder = $data['account_holder'];
  $payment_address = $data['payment_address'];
  $payment_phone_no = $data['payment_phone_no'];
  $bank_name = $data['bank_name'];
  $account_number = $data['account_number'];
  $payment_method = $data['payment_method'];
  $flat_fee = $data['flat_fee'];
  $resource_type = $data['resource_type'];
  $unit = $data['unit'];
  $resource_name = $data['resource_name'];
  $extra_fee = $data['extra_fee'];
  $discount = $data['discount'];
  $event_type_id = 0;
  $updated_tables = 0;
  
  //Test Null values, set default for empty fields and wrap strings around single quotes

  $event_name = !empty($event_name) ? "'$event_name'" : "NULL";
  $start_date = !empty($start_date) ? "'$start_date'" : "NULL"; 
  $end_date = !empty($end_date) ? "'$end_date'" : "NULL"; 
  $period = !empty($period) ? "'$period'" : "NULL"; 
  $status = !empty($status) ? "$status" : "2";
  $total_cost = !empty($total_cost) ? "$total_cost" : "NULL";
  $event_address = !empty($event_address) ? "'$event_address'" : "NULL";
  $event_phone_no = !empty($event_phone_no) ? "'$event_phone_no'" : "NULL";
  $event_email = !empty($event_email) ? "'$event_email'" : "NULL";
  $event_room_no = !empty($event_room_no) ? "$event_room_no" : "NULL";
  $event_renting_cost = !empty($event_renting_cost) ? "$event_renting_cost" : "NULL";
  $event_capacity = !empty($event_capacity) ? "$event_capacity" : "NULL";
  $account_holder = !empty($account_holder) ? "'$account_holder'" : "NULL";
  $payment_address = !empty($payment_address) ? "'$payment_address'" : "NULL";
  $payment_phone_no = !empty($payment_phone_no) ? "'$payment_phone_no'" : "NULL";
  $bank_name = !empty($bank_name) ? "'$bank_name'" : "NULL";
  $account_number = !empty($account_number) ? "'$account_number'" : "NULL";
  $payment_method = !empty($payment_method) ? "'$payment_method'" : "NULL";
  $flat_fee = !empty($flat_fee) ? "$flat_fee" : "NULL";
  $resource_type = !empty($resource_type) ? "'$resource_type'" : "NULL";
  $unit = !empty($unit) ? "'$unit'" : "NULL";
  $resource_name = !empty($resource_name) ? "'$resource_name'" : "NULL";
  $extra_fee = !empty($extra_fee) ? "$extra_fee" : "NULL";
  $discount = !empty($discount) ? "$discount" : "NULL";

  //Check all possible 4 combinations of Event type & recurrent options from select list, and save as one id
  //example: if(event_types === "private" && recurrent_event == 1) $event_type_id = 3;

  if($event_type === "private"){
      $event_type_id = ($recurrent_event == 1) ? 3 : 1;
  }

  if($event_type === "non-profit"){
      $event_type_id = ($recurrent_event == 1) ? 4 : 2;
  }
    
  //Update events table
  $sql = "UPDATE events 
          SET event_type_id = $event_type_id, event_name = $event_name, start_date = $start_date, end_date = $end_date, period = $period, status = $status, total_cost = $total_cost
          WHERE event_id = $event_id";
  
    if ($conn->query($sql) === TRUE) {
        $updated_tables++;
    } else {
        echo "error " . $conn->error;
    }

    //Update event_locations table
  $sql = "UPDATE event_locations 
          SET address = $event_address, phone_no = $event_phone_no, email = $event_email, room_no = $event_room_no, renting_cost = $event_renting_cost, capacity = $event_capacity
          WHERE location_id = $event_location_id";
  
    if ($conn->query($sql) === TRUE) {
        $updated_tables++;
    } else {
        echo "error " . $conn->error;
    }

    //Update event_payment table
  $sql = "UPDATE event_payment 
          SET account_holder = $account_holder, address = $payment_address, phone_no = $payment_phone_no, bank_name = $bank_name, account_number = $account_number, payment_method = $payment_method
          WHERE event_payment_id = $event_payment_id";
  
    if ($conn->query($sql) === TRUE) {
        $updated_tables++;
    } else {
        echo "error " . $conn->error;
    }

        //Update resources table
  $sql = "UPDATE resources 
          SET flat_fee = $flat_fee, type = $resource_type, unit = $unit, resource_name = $resource_name, extra_fee = $extra_fee, discount = $discount
          WHERE resource_id = $event_resource_id";
  
    if ($conn->query($sql) === TRUE) {
        $updated_tables++;
    } else {
        echo "error " . $conn->error;
    }

    if($updated_tables == 4)
      echo "updated";
}