<?php 
session_start();
include("navbar.php");
include("../backend/connection.php");


if(!isset($_SESSION['active_user'])) {
	exit();
}

$user_id = $_SESSION['active_user']["user_id"];

$sql = "SELECT * From users WHERE user_id = $user_id";
$user_info = $conn->query($sql)->fetch_assoc();

echo "ID: ".$user_info["user_id"]."<br>";
echo "First Name : ".$user_info["first_name"]."<br>";
echo "Middle Name : ".$user_info["middle_name"]."<br>";
echo "Last Name : ".$user_info["last_name"]."<br>";
echo "Address : ".$user_info["address"]."<br>";
echo "Date of Birth : ".$user_info["date_of_birth"]."<br>";
echo "Email : ".$user_info["email"]."<br>";
echo "Organization : ".$user_info["organization"]."<br>";

?>


<iframe src="tags.php?type=user&user=<?php echo $user_id?>">