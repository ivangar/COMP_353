<?php
include "navbar.php";
require "../backend/get_event_report_info.php";

include "group_report.php";

?>


<head>
	<script>
	function searchGroups()
	{
		var frame = document.getElementById("searchView");
		var search = document.getElementById("searchTerms").value;
		frame.src = "../backend/group_search.php?event=<?php echo $event_id ?>&primary=<?php echo $event_primary_group_id ?>&search="+search;
	}

	</script>
</head>
<body>
<h4>Event info</h4>
	<table class="table">
	<thead>
		<tr>
		<th scope="col">Name</th>
		<th scope="col">Value</th>

		</tr>
	</thead>
	<tbody>
		<tr>
		<td>Event ID</td>
		<td><?php echo $event_id ?></td>
		</tr>
		<tr>
		<td>Event Name</td>
		<td><?php echo $event_name ?></td>
		</tr>
		<tr>
		<td>Event Cost</td>
		<td><?php echo $event_cost ?></td>
		</tr>
		<tr>
		<td>Start Date</td>
		<td><?php echo $event_start ?></td>
		</tr>
		<tr>
		<td>End Date</td>
		<td><?php echo $event_end ?></td>
		</tr>
		<tr>
		<td>Primary Group ID</td>
		<td><?php echo $event_primary_group_id ?></td>
		</tr>
	</tbody>
	</table>

	<div class='container pt-5'>
		<h4>Search for a group</h4>
		<input class='form-control d-inline-flex w-75' id="searchTerms" type="text" placeholder="search groups" />
		<button class = 'btn btn-primary d-inline-flex' onclick="searchGroups()">Search</button>
		<br>
		<iframe id="searchView" frameborder="0" width="800" height="300" src="../backend/group_search.php?event=<?php echo $event_id ?>&primary=<?php echo $event_primary_group_id ?>"></iframe>
	</div>
</body>