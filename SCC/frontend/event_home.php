<?php
/*
Author: Ragith Sabapathipillai
Id: 26854486

The wall page for an event, contains posts, polls and instant messages.

*/


//start session
if (!isset($_SESSION)) {
    session_start();
}

require "HotReloader.php";
use HotReloader\HotReloader;
$reloader = new HotReloader();
$reloader->init();

if (isset($_SESSION['error'])) {
    $error = $_SESSION['error'];
    echo "<span>$error</span>";
}
if (isset($_GET['event_id'])) {
    $event_id = $_GET['event_id'];
}

if (isset($_GET['group_id'])) {
	$group_id = $_GET['group_id'];
	$_SESSION['group_id'] = $group_id;
}
include("../backend/verify_group_member.php");
include("navbar.php");
if (isset($_GET['create-group']) && $_GET['create-group'] == "true") {
    include "create-group.php";
}
if($_SESSION['group_member'] == true)  {
include "../backend/get_event_groups.php";
include "post-content.php";
include "display-post.php";
include "poll.php";
include "instant_messaging.php";
}
else {
	include("join-group-page.php");
}
unset($_SESSION['error']);
