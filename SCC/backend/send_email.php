<?php
    if(!isset($_SESSION)){
        session_start();
    }
    include ("connection.php");
    include ("../frontend/emails_view.php");

    $receiver = $_POST["email_receiver"];
    $title = "'" . $_POST["email_title"] . "'";
    $body = "'" . $_POST["email_body"] . "'";
    $sender = "'" . $_SESSION["active_user"]["email"] . "'";
    $_SESSION['reciver_email'] = $receiver;
    include("retrieve-user-from-email.php");
    $receiver_id = $_SESSION['reciver_id'];
    $sql = "INSERT INTO `emails`(`receiver_id`, `sender_email`, `title`, `body`) VALUES ('$receiver_id', $sender , $body, $sender)";

    if ($conn->query($sql) != TRUE) {
        trigger_error('Invalid query: ' . $conn->error);

        if(!isset($_SESSION['errors'])){
            $_SESSION['errors'] = " Error: Email error, did not send email.";
        }
        else {
            $_SESSION['errors'] .= " Error: Email error, did not send email.";
        }
        echo $sql;
        echo "An error occurred: email did not send";
    }
    else {
        echo "Email sent to : " . $receiver;
    }

    $conn->close();

?>