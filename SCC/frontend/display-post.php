<?php
require "HotReloader.php";
use HotReloader\HotReloader;
$reloader = new HotReloader();
$reloader->init();
$event_id;

include("../backend/retrieve-posts.php");
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<style type="text/css">
		.post {
			width: 600px;
			margin: auto;
			display: flex;
			flex-direction: column;
			align-items: center;
			margin-bottom: 40px;
			border: 1px solid gray;
		}
		.post_data-container {
			display: flex;
			justify-content: space-between;
			width: 100%;
		}
	</style>
</head>
<body>

</body>
</html>