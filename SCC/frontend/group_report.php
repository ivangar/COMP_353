<?php
require("../backend/get_group_report_info.php");

echo $group_id;

//echo "Number of members :". $group_members->num_rows . "<br>";
/*
while($row = $group_members->fetch_assoc()) {
	echo $row["first_name"] . " " . $row["middle_name"] . " " . $row["last_name"] . "<br>";
}*/


echo "First Post posted on : ". $first_post_date . "<br>";
echo "Lastest Post posted on : ". $latest_post_date. "<br>";

if(count($most_active_dates) > 1) {
	echo "Most active dates Are <br>";
}
else if(count($most_active_dates) == 1) {
	echo "Most active date is : ";
}

foreach($most_active_dates as $date) {
	echo $date . "<br>";
}

?>


<head>
	<script>
	function searchUsers(target)
	{
		var frame = document.getElementById("search_view_user");
		var search = document.getElementById("search_terms_user").value;
		frame.src = "../backend/user_search.php?event=<?php echo $event_id?>&search="+search;
	}

	</script>
</head>

<input id="search_terms_user" type="text" placeholder="search users" />
<button onclick="searchUsers()">Search</button>
<br>
<iframe id="search_view_user" frameborder="0" width="800" height="500" src="../backend/user_search.php?group=<?php echo $group_id?>"></iframe> <br>