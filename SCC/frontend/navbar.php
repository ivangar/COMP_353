<?php
    $silent_auth = true;
    include("../backend/authorize_admin.php");
	//start session
if(!isset($_SESSION)){
    session_start();
}
//check that user is logged in
if(isset($userid)){
    $userid = $_SESSION['active_user']['user_id'];
} else {
    $_SESSION['error'] = "Error - No user logged in";
}
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
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" href="#">SCC</a>
            <button class="navbar-toggler collapsed" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <i class="fas fa-bars"></i>
            </button>
            <div class="collapse navbar-collapse navigation" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="dashboard.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="account.php">My Account</a>
                    </li>
                    <li class="nav-item"><?php
                        if(isset($_GET['event_id']) && isset($_GET['group_id']) && $_GET['event_id'] !="" && $_GET['group_id']!= "") {
                            $params = "?event_id=" . $_GET['event_id'] . "&create-group=true";
                            echo '<a class="nav-link" href="event_home.php' . $params . '">Create Group</a>';
                        }
                        else if(isset($is_admin)) {
                            echo '<a class="nav-link" href="admin_create-event.php">Create Event</a>';
                        }
                        ?>
                    </li>
                    <li class="nav-item"> <?php
                        include("../backend/authorize_god.php");
                        if(isset($is_admin) && $is_admin == 2)
                            echo '<a class="nav-link" href="admin_create-event.php">Add Admin</a>';
                    ?>
                    <li class="nav-item"> <?php
                        include("../backend/authorize_controller.php");
                        if(isset($is_admin) && $is_admin == 1)
                            echo '<a class="nav-link" href="controller_dashboard.php">Controller Dashboard</a>';
                    ?>
                    <li class="nav-item">
                        <a class="nav-link" href="../frontend/emails_view.php">Emails</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../backend/logout.php">Logout</a>
                    </li>
                </ul>
            </div>
        </nav>
		?>
        <a href="../frontend/emails_view.php">Emails</a>
		<a href="../backend/logout.php">Logout</a>
	</body>

</html>