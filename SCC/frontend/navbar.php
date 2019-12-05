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
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
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
                            $params = "?event_id=" . $_GET['event_id'] . "&group_id=" . $_GET['group_id'] . "&create-group=true";
                            echo '<a class="nav-link" href="event_home.php' . $params . '">Create Group</a>';
                        }
                        else if(isset($is_admin)) {
                            echo '<a class="nav-link" href="admin_create-event.php">Create Event</a>';
                        }
                        ?>
                    </li>
                    <?php 
                        if(isset($_GET['event_id']) && isset($_GET['group_id']) && $_GET['event_id'] !="" && $_GET['group_id']!= "") {         
                            include("../backend/authorize_event.php");
                            if(isset($is_event_manager)) {
                                echo "<li class='nav-item'>";
                                echo '<a class="nav-link" href="create_poll.php' . $params . '">Create Poll</a>';
                                echo "</li>";
                            }
                        }
                    ?>
                    
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

	</body>

</html>