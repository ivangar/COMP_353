<?php

// Creating connection
$conn = new mysqli($servername, $username, $password);

// Checking connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
//For now I commented these, cauz it was printing the successful message every time
/*else{
echo "Connected successfully";
}*/
$conn->select_db($db);
