<?php
/*
* This file is used to display event details of a specific event ID.
* It should be called from another file, by passing the event id as part of the url=event_details.php?event_id=2
*/

ini_set("display_errors","1");
session_start();
require("../connection.php");

$_SESSION['user_id'] = 1; //Once the login functionality exists this line should be deleted, user id session will be set in the login
$_SESSION['user_name'] = "Ivan";  //Once the login functionality exists this line should be deleted, user id session will be set in the login

$user_id = $_SESSION['user_id'];
$user_name = $_SESSION['user_name'];
$event_id = (isset($_GET["event_id"]) && !empty($_GET["event_id"])) ? $_GET["event_id"] : 0;
$event_info = array();  //array holding main details
$event_location = array();  //array holding location details
$event_payment = array();  //array holding payment details

if($event_id){
	$sql = "SELECT * FROM events WHERE event_manager_id = $user_id AND event_id = $event_id";
	$result = $conn->query($sql);

	if ($result->num_rows > 0) {
	
	    // output data of each row
	    while($row = $result->fetch_assoc()) {
	    	$event_info = array("Event name"=>$row["event_name"], "Start Date"=>$row["start_date"], "End Date"=>$row["end_date"], "Status"=>$row["status"], "Total cost"=>$row["total_cost"]);
	    }
	}
}

?>

<!doctype html>
<html class="no-js" lang="">

<head>
  <meta charset="utf-8">
  <title>Event details</title>
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link rel="apple-touch-icon" href="icon.png">
  <!-- Place favicon.ico in the root directory -->

  <meta name="theme-color" content="#fafafa">

  <style type="text/css">
  	h3{ 
  		text-align: center; 
  	}
    div.container{
    	margin: auto; 
    	width: 50%;
    }
    table{
    	text-align: left;
    }
</style>
</head>

<body>

  <h3 >Event Details</h3>

  <?php if(!empty($event_id) && $event_id) {  ?>
  	<div class="container">
	<table cellpadding="10">
		<caption>Main info</caption>
	  	<tbody>
	  		<?php foreach($event_info as $label => $value) { echo "<tr><td>$label</td><td>$value</td></tr>"; }
	  		?>
		</tbody>
	</table>
	</div>


  <?php }?>
  <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
</body>

</html>