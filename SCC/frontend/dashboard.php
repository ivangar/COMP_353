<?php
/*
Author: Ragith Sabapathipillai
ID:26854486
This is the dashboard for everyone, where they can see a list of events they belong to
*/


include("navbar.php");
include("../backend/user_role_relation.php");
include("event_manager_page.php");
if(isset($_SESSION['new_event'])) {
    unset($_SESSION['new_event']);
}
?>
