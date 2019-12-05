<?php
include("navbar.php");
include("../backend/user_role_relation.php");
include("event_manager_page.php");
if(isset($_SESSION['new_event'])) {
    unset($_SESSION['new_event']);
}
?>
