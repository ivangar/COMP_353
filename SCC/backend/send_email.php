<?php
    if(!isset($_SESSION)){
        session_start();
    }
    include ("connection.php");
    include ("../frontend/emails_view.php");

    $receiver = "'" . $_POST["email_receiver"] . "'";
    $title = "'" . $_POST["email_title"] . "'";
    $body = "'" . $_POST["email_body"] . "'";

    $sql = "Insert into emails(receiver_id, sender_id, title, body) Select "
            . "u.user_id, "
            . $_SESSION["active_user"]["user_id"] . ", "
            . $title . ", "
            . $body
            . " From users u Where u.email = "
            . $receiver;

    if ($conn->query($sql) != TRUE) {
        if(!isset($_SESSION['errors'])){
            $_SESSION['errors'] = " Error: Email error, did not send email.";
        }
        else {
            $_SESSION['errors'] .= " Error: Email error, did not send email.";
        }

        echo "An error occurred: email did not send";
    }
    else {
        echo "Email sent to : " . $receiver;
    }

    $conn->close();

?>