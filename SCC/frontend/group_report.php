<?php
require "../backend/get_group_report_info.php";
?>


<head>
	<script>
	function searchUsers(target)
	{
		var frame = document.getElementById("search_view_user");
		var search = document.getElementById("search_terms_user").value;
		frame.src = "../backend/user_search.php?group_id=<?php echo $group_id ?>&search="+search;
	}

	</script>
</head>

<body>
<div class='container pt-4'>
<div class = ''>
<h4>Posts information</h4>
<ul class="list-group">
  <li class="list-group-item active">Post Statitics</li>
  <li class="list-group-item">First Post posted on : <?php echo $first_post_date ?></li>
  <li class="list-group-item">Latest Post posted on : <?php echo $latest_post_date ?></li>
<?php
if (count($most_active_dates) > 1) {
    echo "<li class='list-group-item active'>Most active dates</li>";
} else if (count($most_active_dates) == 1) {
    echo "<li class='list-group-item active'>Most active date</li>";
}
?>
<?php
foreach ($most_active_dates as $date) {
    echo "<li class='list-group-item'>$date</li>";
}
?>
</ul>
</div>
<br><br>
<h4>Search for a user</h4>
<input class='form-control d-inline-flex w-75 ' id="search_terms_user" type="text" placeholder="search users" />
<button class='btn btn-primary d-inline-flex' onclick="searchUsers()">Search</button>
<br>
<iframe id="search_view_user" frameborder="0" width="800" height="200" src="../backend/user_search.php?group_id=<?php echo $group_id ?>"></iframe> <br>
</container>
</body>