<?php
	include("../backend/user_role_relation.php");
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
                    <li class="nav-item"><?php
                        if(isset($roleId) && $roleId == 0) {
                            echo '<a class="nav-link" href="admin_create-event.php">Create Event</a>';
                        }
                        if(isset($_GET['event_id']) && isset($_GET['group_id']) && $_GET['event_id'] !="" && $_GET['group_id']!= "") {
                            $params = "?event_id=" . $_GET['event_id'] . "&group_id=" . $_GET['group_id'] . "&create-group=true";
                            echo '<a class="nav-link" href="event_home.php' . $params . '">Create Group</a>';
                        }

                        ?>
                    </li>
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