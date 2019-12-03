<?php
include("connection.php");

function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}
// posted data
$event_id = htmlspecialchars($_POST['event_id']);
$group_id = htmlspecialchars($_POST['group_id']);
$post_permission = htmlspecialchars($_POST['permission_type']);
if($_POST["contentToUpload"] != "") {
    $upload_text = $_POST["contentToUpload"];
}
//start session
if(!isset($_SESSION)){
    session_start();
}
//check that user is logged in
if(!isset($userid)){
    $userid = $_SESSION['active_user']['user_id'];
} else {
    $_SESSION['error'] = "Error - No user logged in";
}

$target_dir = "../uploads/";
$randomNumber = mt_rand(1, 100);
$randomWord = generateRandomString();

$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
$target_file = $target_dir . $randomNumber . $randomWord . "." . $imageFileType;


// if everything is ok, try to save file to server and insert 
if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
    $upload_image = $randomNumber . $randomWord . "." . $imageFileType;
    $sql = "INSERT INTO posts (group_id, user_id, post_content, post_image, post_permission) VALUES ('$group_id', '$userid', '$upload_text', '$upload_image', '$post_permission')";
    if($conn->query($sql) === TRUE) {
        header("Location: ../frontend/event_home.php?event_id=$event_id&group_id=$group_id");

    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

} else if (isset($upload_text)) {
    $upload_image = NULL;
    $sql = "INSERT INTO posts (group_id, user_id, post_content, post_image, post_permission) VALUES ('$group_id', '$userid', '$upload_text', '$upload_image', '$post_permission')";
    if($conn->query($sql) === TRUE) {
        header("Location: ../frontend/event_home.php?event_id=$event_id&group_id=$group_id");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
} else {
    $_SESSION['error'] = "No Data Posted. Please upload an image or enter text.";
        header("Location: ../frontend/event_home.php?event_id=$event_id&group_id=$group_id");
}

$conn->close();
?>