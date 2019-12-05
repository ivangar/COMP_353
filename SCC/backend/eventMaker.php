<?php
include("connection.php");
session_start();

$user_id = $_SESSION["active_user"]["user_id"];
$event_manager = $_POST['user_id'];
$event_name = $_POST['event_name'];
$event_fee = $_POST['event_fee'];
$event_payment_id = 0;
$resource_id = 0;
$location_id = 0;
$event_id = 0;
$group_id = 0;

switch ($_POST["event_type"]) {
	case 'non-profit_recurrent':
		$event_type_id = "4";
		break;
	case 'non-profit':
		$event_type_id = "2";
		break;
	case 'private_recurrent':
		$event_type_id = "3";
		break;
	case 'private':
		$event_type_id = "1";
		break;
	default:
		break;
}

//check null values
$event_name = !empty($event_name) ? "'$event_name'" : "NULL";
$event_fee = !empty($event_fee) ? "$event_fee" : "NULL";

$sql = "INSERT INTO event_payment (account_holder, address, phone_no, bank_name, account_number, payment_method) VALUES (NULL, NULL, NULL, NULL, NULL, NULL)";

if($conn->query($sql) === TRUE) {
	$event_payment_id = $conn->insert_id;
	echo "event-succes";
}

$sql = "INSERT INTO resources (flat_fee, type, unit, resource_name, extra_fee, discount) VALUES (NULL, NULL, NULL, NULL, NULL, NULL)";

if($conn->query($sql) === TRUE) {
	$resource_id = $conn->insert_id;
	echo "resource succes";
}

$sql = "INSERT INTO event_locations (address, phone_no, email, room_no, renting_cost, capacity) VALUES (NULL, NULL, NULL, NULL, NULL, NULL)";

if($conn->query($sql) === TRUE) {
	$location_id = $conn->insert_id;
	echo "eventlocation";

}


$sql = "INSERT INTO events (event_payment_id, event_type_id, resource_id, event_manager_id, location_id, event_name, status, total_cost) VALUES ($event_payment_id, $event_type_id, $resource_id, $event_manager, $location_id, $event_name, 2, $event_fee)";

if($conn->query($sql) === TRUE) {
	$event_id = $conn->insert_id;
	echo "event alont success";

}

$sql = "INSERT INTO `groups` (event_id, group_manager_id, name, details) VALUES ($event_id, $event_manager, $event_name, 'Main event group')";

if($conn->query($sql) === TRUE) {
	$group_id = $conn->insert_id;
}

$insert_event_admin = "INSERT INTO group_members (user_id, group_id, participant_status_id) VALUES ($event_manager, $group_id, 1)";
if ($conn->query($insert_event_admin) === TRUE) {
	$var = 'success';
}

$sql = "UPDATE events SET primary_event_group_id = $group_id WHERE event_id = $event_id";
							
if ($conn->query($sql) === TRUE) {
	if($user_id == $event_manager)
		header("Location: ../frontend/form_event_finalizer.php?event_id=$event_id");
	else {
		$_SESSION['new_event'] = true;
	}

	
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>