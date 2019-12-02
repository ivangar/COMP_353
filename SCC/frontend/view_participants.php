<?php 
$event_id = $_GET["event_id"];
$event_name = $_GET["event_name"];
require("navbar.php");
require("../backend/users/get_users.php");
?>

<!doctype html>
<html class="no-js" lang="">

<head>
  <meta charset="utf-8">
  <title>View Participants</title>
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link rel="apple-touch-icon" href="icon.png">
  <!-- Place favicon.ico in the root directory -->

  <meta name="theme-color" content="#fafafa">
  <style type="text/css">
     h3{ 
  		text-align: center; 
  	}
  	.right {
      position: absolute;
      right: 0px;
      padding: 10px;
    }
  </style>
</head>

<body>
  <?php echo "<a class='right' href='event_details_page.php?event_id=".$event_id."'>Go Back</a>";?>
  <h3><?php echo $event_name; ?> participants</h3>

  <?php if(!empty($participants) && sizeof($participants) != 0) {  ?>
	<table cellpadding="10" style="text-align: left;">
	    <thead>
		    <tr>
		      <th>Participant Name</th>
		      <th>Address</th>
		      <th>Date of birth</th>
		      <th>Email</th>
		      <th>Organization</th>
		      <th>Status</th>
		      <th></th>
		    </tr>
		</thead>
	  	<tbody>
	  		<?php foreach($participants as $row){ 
	  				echo "<tr>"; 
	  				foreach($row as $participant_attr){ echo "<td>$participant_attr</td>"; } 
	  			  	echo "</tr>"; 
	  		}?>
		</tbody>
	</table>
  <?php } else { echo "<h4> This event does not have participants </h4>"; }?>
  <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
</body>

</html>