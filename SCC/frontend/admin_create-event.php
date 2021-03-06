<?php
/*
Author: Ragith Sabapathipillai, Ivan Garzon
ID: 26854486, 27006284
This script displays a form to create an event
*/
	require("navbar.php");
	require("../backend/users/get_users.php");
?>

<!doctype html>
<html class="no-js" lang="">

<head>
  <meta charset="utf-8">
  <title> Create Event </title>
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="theme-color" content="#fafafa">
  <style>
		a{
			margin-right:20px;
		}
		.admin-view{
			width: fit-content;
			margin: auto;
			margin-top: 40px;
		}
  </style>
</head>

<body>	
	<div class="container pt-5">
		<h1>Admin View</h1>
		<form action="../backend/eventMaker.php" method="POST">
			<div  class="form-group">
				<p>Enter event name</p>
				<input class="form-control" type="text" name="event_name">
				<?php if(!empty($users) && sizeof($users) != 0) { echo "<p>Select an event manager</p>$select_list";}
				      else echo "<p>Write the user id of the event manager</p><input class='form-control' type='text' name='user_id' required>";
				?>
				<p>Select event type</p>
				<select class="form-control" name="event_type">
					<option value="non-profit_recurrent">non-profit recurrent</option>
					<option value="non-profit">non-profit non-recurrent</option>
					<option value="private_recurrent">private recurrent</option>
					<option value="private">private non-recurrent</option>
				</select>
				<p>Enter user fee</p>
				<input class="form-control" type="text" name="event_fee"><br><br>
				<input type="submit" value="Create new Event" name="submit">
			</div>
		</form>
	</div>

</body>

</html>