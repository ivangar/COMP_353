<?php 
/*
Author: Ivan Garzon
ID: 27006284
This script displays all the group participants and their information in a tabular form. 
If the user is the group manager or the event manager then an edit link is displayed to edit any 
participant, approve him, reject him, put his status to pending, etc.
*/
$group_id = $_GET["group_id"];
$group_name = $_GET["group_name"];
$group_manager = $_GET["group_manager"];
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
  <h3><?php echo $group_name; ?> participants</h3>

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
