<html>
	<head>
		<title> p1 -index </title>
		<style>
			a{
				margin-right:20px;
			}
		</style>
	</head>

	<body>	
		<h1>Finalize Event</h1>
		<form action="../backend/events/event_finalize.php" method="POST">
			<p>Enter event name</p>
			<input type="text" name="event_name" required>
			<p>Enter Location</p>
			<input type="text" name="event_location" required>
			<p>Start Date</p>
			<input type="date" name="event_start" required>
			<p>End Date</p>
			<input type="date" name="event_end" required>
			<input type="hidden" name="event_id" value="<?php echo $_GET['event_id'] ?>">
			<input type="submit" value="Create new Event" name="submit">
		</form>
	</body>

</html>