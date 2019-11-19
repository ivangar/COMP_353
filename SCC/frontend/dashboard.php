<?php
//backend logic included here
include("../backend/user_role_relation.php");

//frontend view based on returned result
if($roleId == 0){
	include("admin_dashboard.php");
}
else {
	//will implement once event_manager separated into frontend and backend
	include("user_dashboard.php");
}

?>