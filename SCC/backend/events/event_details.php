<?php
/*
* This file is used to display event details of a specific event ID.
* It should be called from another file, by passing the event id as part of the url=event_details.php?event_id=2
*/

ini_set("display_errors","1");
session_start();

$user_id = $_SESSION['active_user']['user_id'];
$user_name = $_SESSION['active_user']['first_name'];
$event_id = (isset($_GET["event_id"]) && !empty($_GET["event_id"])) ? $_GET["event_id"] : 0;
$event_info = array();  //array holding main details
$event_location = array();  //array holding location details
$event_payment = array();  //array holding payment details
$event_resources = array();  //array holding payment details
$event_manager = 0;   //flag to display event buttons (update, archive)
$event_location_id = 0;
$event_payment_id = 0;
$event_resource_id = 0;


if($event_id){

  //Check if the current user viewing the details is the event manager (and has the rights to update/archive the event)
  $sql = "SELECT * FROM events WHERE event_manager_id = $user_id AND event_id = $event_id";
  $result = $conn->query($sql);
  if ($result->num_rows > 0) {
      $event_manager = 1;
  }

  //Show event details for an event
	$sql = "SELECT * FROM events WHERE event_id = $event_id";
	$result = $conn->query($sql);

	if ($result->num_rows > 0) {

	    // output data of each row
	    while($row = $result->fetch_assoc()) {
        
        $event_type_id = $row["event_type_id"];
        $event_location_id = $row["location_id"];
        $event_payment_id = $row["event_payment_id"];
        $event_resource_id = $row["resource_id"];

        $event_type_sql = "SELECT type, recurrent FROM event_types WHERE event_type_id = $event_type_id";
        $event_type_result = $conn->query($event_type_sql);
        
        if ($event_type_result->num_rows > 0) {
          while($event_type_row = $event_type_result->fetch_assoc()) {
            $event_type = $event_type_row["type"];
            $event_recurrent = $event_type_row["recurrent"];
          }
            
        }

	    	$event_info = array("Event name"=>$row["event_name"], "Start Date"=>$row["start_date"], "End Date"=>$row["end_date"], "Period (expires)"=>$row["period"], "Status"=>$row["status"], "Event type"=>$event_type, "Recurrent"=>$event_recurrent, "Total cost"=>$row["total_cost"]);
	    	$event_info_ids = array("Event name"=>"event_name", "Start Date"=>"start_date", "End Date"=>"end_date", "Period (expires)"=>"period", "Status"=>"status", "Event type"=>"type", "Recurrent"=>"recurrent", "Total cost"=>"total_cost");
	     
        //SELECT EVENT LOCATION 
        $location_sql = "SELECT * FROM event_locations WHERE location_id = $event_location_id";
        $location_result = $conn->query($location_sql);

        if ($location_result->num_rows > 0) {

            // output data of each row
            while($row = $location_result->fetch_assoc()) {
              $event_location = array("Event address"=>$row["address"], "Phone no"=>$row["phone_no"], "Email"=>$row["email"], "Room no"=>$row["room_no"], "Renting cost"=>$row["renting_cost"], "Capacity"=>$row["capacity"]);
              $event_location_ids = array("Event address"=>"address", "Phone no"=>"phone_no", "Email"=>"email", "Room no"=>"room_no", "Renting cost"=>"renting_cost", "Capacity"=>"capacity");
            }

        }

        //SELECT EVENT PAYMENT DETAILS
        $payment_sql = "SELECT * FROM event_payment WHERE event_payment_id = $event_payment_id";
        $payment_result = $conn->query($payment_sql);

        if ($payment_result->num_rows > 0) {

            // output data of each row
            while($row = $payment_result->fetch_assoc()) {
              $event_payment = array("Account holder"=>$row["account_holder"], "Bank address"=>$row["address"], "Phone no"=>$row["phone_no"], "Bank name"=>$row["bank_name"], "Account no"=>$row["account_number"], "Payment method"=>$row["payment_method"]);
              $event_payment_ids = array("Account holder"=>"account_holder", "Bank address"=>"payment_address", "Phone no"=>"payment_phone_no", "Bank name"=>"bank_name", "Account no"=>"account_number", "Payment method"=>"payment_method");
            }

        }

        //SELECT EVENT RESOURCES
        $resource_sql = "SELECT * FROM resources WHERE resource_id = $event_resource_id";
        $resource_result = $conn->query($resource_sql);

        if ($resource_result->num_rows > 0) {

            // output data of each row
            while($row = $resource_result->fetch_assoc()) {
              $event_resources = array("Flat fees"=>$row["flat_fee"], "Resource type"=>$row["type"], "Unit"=>$row["unit"], "Resource name"=>$row["resource_name"], "Extra fees"=>$row["extra_fee"], "Payment discount"=>$row["discount"]);
              $event_resources_ids = array("Flat fees"=>"flat_fee", "Resource type"=>"resource_type", "Unit"=>"unit", "Resource name"=>"resource_name", "Extra fees"=>"extra_fee", "Payment discount"=>"discount");
            }

        }

      }

	}

}

?>