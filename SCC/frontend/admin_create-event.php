<?php
	require("navbar.php");
?>

<head>
	<title> p1 -index </title>
	<style>
		a{
			margin-right:20px;
		}
	</style>
</head>

<body>	
	<h1>Admin View</h1>
	<form action="../backend/eventMaker.php" method="POST">
		<p>Enter user id</p>
		<input type="text" name="user_id">
		<p>Select event type</p>
		<select name="event_type">
			<option value="non-profit_recurrent">non-profit recurrent</option>
			<option value="non-profit">non-profit non-recurrent</option>
			<option value="private_recurrent">private recurrent</option>
			<option value="private">private non-recurrent</option>
		</select>
		<p>Enter user fee</p>
		<input type="text" name="event_fee">
		<input type="submit" value="Create new Event" name="submit">
	</form>