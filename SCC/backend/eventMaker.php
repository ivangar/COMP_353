<?php
include("connection.php");
$event_manager = $_POST['user_id'];
$event_name = $_POST['event_name'];
$event_fee = $_POST['event_fee'];
$event_payment_id = 0;
$resource_id = 0;
$location_id = 0;

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
}

$sql = "INSERT INTO resources (flat_fee, type, unit, resource_name, extra_fee, discount) VALUES (NULL, NULL, NULL, NULL, NULL, NULL)";

if($conn->query($sql) === TRUE) {
	$resource_id = $conn->insert_id;
}

$sql = "INSERT INTO event_locations (address, phone_no, email, room_no, renting_cost, capacity) VALUES (NULL, NULL, NULL, NULL, NULL, NULL)";

if($conn->query($sql) === TRUE) {
	$location_id = $conn->insert_id;
}


$sql = "INSERT INTO events (event_payment_id, event_type_id, resource_id, event_manager_id, location_id, event_name, status, total_cost) VALUES ($event_payment_id, $event_type_id, $resource_id, $event_manager, $location_id, $event_name, 2, $event_fee)";

if($conn->query($sql) === TRUE) {
	header("Location: ../frontend/dashboard.php");
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}


$conn->close();
?>