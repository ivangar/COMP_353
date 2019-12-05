<?php
include "connection.php";

//start session
if (!isset($_SESSION)) {
    session_start();
}
//check that user is logged in
if (!isset($userid)) {
    $userid = $_SESSION['active_user']['user_id'];
} else {
    $_SESSION['error'] = "Error - No user logged in";
}
if (isset($_GET['event_id'])) {
    $event_id = $_GET['event_id'];
} else {
    $event_id = "";
}

$recieve = trim($_SESSION['reciver_email']);

$sql = "SELECT * FROM `users` WHERE email = '$recieve'";

$result = $conn->query($sql);
if (!$result) {
    trigger_error('Invalid query: ' . $conn->error);
}
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
	    $_SESSION['reciver_id'] = $row['user_id'];
    }

} else {
	echo "$recieve";
	echo "failed ";
	echo "$sql";
}

?>