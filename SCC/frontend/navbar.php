<?php
	include("../backend/user_role_relation.php");
?>
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

		<a href="dashboard.php">Home</a>
		<?php
			if($roleId == 0) {
				echo '<a href="admin_create-event.php">Create Event</a>';
			}
		?>
		<a href="../backend/logout.php">Logout</a>
	</body>

</html>