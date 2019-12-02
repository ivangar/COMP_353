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
			if(isset($roleId) && $roleId == 0) {
				echo '<a href="admin_create-event.php">Create Event</a>';
			}
			if(isset($_GET['event_id']) && isset($_GET['group_id']) && $_GET['event_id'] !="" && $_GET['group_id']!= "") {
				$params = "?event_id=" . $_GET['event_id'] . "&group_id=" . $_GET['group_id'] . "&create-group=true";
				echo '<a href="event_home.php' . $params . '">Create Group</a>';
			}
		?>
        <a href="../frontend/emails_view.php">Emails</a>
		<a href="../backend/logout.php">Logout</a>
	</body>

</html>