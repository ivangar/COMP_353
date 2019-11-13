<?php
/*
* This file is used to display events that are managed by the current logged in user.
* It should be included from or redirected from another file (perhaps the home page)
*/

ini_set("display_errors","1");
session_start();
require("../connection.php");

$_SESSION['user_id'] = 1; //Once the login functionality exists this line should be deleted, user id session will be set in the login
$_SESSION['user_name'] = "Ivan";  //Once the login functionality exists this line should be deleted, user id session will be set in the login

$user_id = $_SESSION['user_id'];
//$user_id = $_SESSION['active_user']['user_id'];
$user_name = $_SESSION['user_name'];

$sql = "SELECT * FROM events WHERE event_manager_id = $user_id";
$result = $conn->query($sql);
$event_rows = array();

if ($result->num_rows > 0) {
	
    // output data of each row
    while($row = $result->fetch_assoc()) {
    	$event_details_url = "<a href='event_details.php?event_id=" . $row["event_id"] . "'>view details</a>";
    	$event_info = array($row["event_id"],$row["event_name"],$row["start_date"],$row["end_date"],$row["status"],$event_details_url);
    	array_push($event_rows,$event_info);
    	$event_info = array();
        //echo "<br><br>event id: " . $row["event_id"]. " - Event Name: " . $row["event_name"]. " Start Date " . $row["start_date"] . " End date " . $row["end_date"] . " Status " . $row["status"] . "<br>";
    }
}

?>

<!doctype html>
<html class="no-js" lang="">

<head>
  <meta charset="utf-8">
  <title>Event manager page</title>
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link rel="apple-touch-icon" href="icon.png">
  <!-- Place favicon.ico in the root directory -->

  <meta name="theme-color" content="#fafafa">
</head>

<body>

  <h3>Welcome <?php echo $user_name; ?>!</h3>

  <?php if(!empty($event_rows) && sizeof($event_rows) != 0) {  ?>
   <p> You're the Event Manager of the following events:</p>
	<table cellpadding="10" style="text-align: left;">
		<caption>Events</caption>
	    <thead>
		    <tr>
		      <th>Event Id</th>
		      <th>Event Name</th>
		      <th>Start Date</th>
		      <th>End Date</th>
		      <th>Status</th>
		      <th></th>
		    </tr>
		</thead>
	  	<tbody>
	  		<?php foreach($event_rows as $row){ 
	  				echo "<tr>"; 
	  				foreach($row as $event_attr){ echo "<td>$event_attr</td>"; } 
	  			  	echo "</tr>"; 
	  		}?>
		</tbody>
	</table>
  <?php }?>
  <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
</body>

</html>