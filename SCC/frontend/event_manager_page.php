<?php 
require("../backend/connection.php");
require '../backend/events/event_manager.php';?>

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