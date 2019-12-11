<?php
/*
Author: Jesse Desmarais
ID: 40035761
This page displays the poll

*/


include "../backend/connection.php";

$user_id = $_SESSION['active_user']['user_id'];

$sql = "SELECT * FROM poll WHERE group_id = $group_id";
$polls = $conn->query($sql);

echo "
<body>
	<div class='container border border-primary p-0 rounded-top mb-5'>
		<header class='page-header bg-primary p-4 text-white'>
			<div class='container-fluid'>
				<h2>Polls</h2>
			</div>
		</header>
		<div class='bg-light p-4'>
";
while ($poll_data = $polls->fetch_assoc()) {

    $options = explode(";", $poll_data["options"]);
    $optionCount = 1;
    $today = strtotime("now");
    $end = $poll_data["end_date"];
    $poll_id = $poll_data["poll_id"];

    if ($today < strtotime($end)) {
        $stillAvailable = true;
    } else {
        $stillAvailable = false;
    }

    echo "<div class='card m-4 shadow'>
            <div class='card-header'>
                <h3>" . $poll_data['title'] . "</h3>
            </div>
          <div class='card-block p-4'>";

    $sql = "SELECT option_selected FROM poll_results WHERE poll_id = $poll_id and user_id = $user_id";
    $result = $conn->query($sql);
    if ($result->num_rows > 0 || !$stillAvailable) {
        echo "<h6 class='font-weight-bold'>Poll results:</h6>";
        $our_selection = $result->fetch_assoc()["option_selected"];
        foreach ($options as $option) {

            if ($optionCount == $our_selection) {
                echo "<p class = 'bg-light p-2' rounded><b>" . $option . "</b>";
            } else {
                echo "<p class = 'bg-light p-2 rounded'>" . $option;
            }

            $sql = "SELECT count(option_selected) as votes FROM `poll_results` WHERE option_selected = " . $optionCount++;
            $vote_count = $conn->query($sql)->fetch_assoc()["votes"];
            echo "<span class='badge badge-secondary p-2 float-right'>" . $vote_count . "</span></p>";
        }

        if ($stillAvailable) {
            echo "<div class='alert alert-warning' role='alert'>Ends in : " . $end . "</div>";

            echo "<form action='../backend/poll_change.php' method='POST'>
				<input type='hidden' name='id' value ='$poll_id'/>
				<br>  <input class='btn btn-primary' type='submit' value='Change Vote'></form></div></div>
			";
        }
    } else {
        if (count($options) > 1) {
            echo "<form action='../backend/poll_submit.php' method='POST'><ul class='list-group'>";
            foreach ($options as $option) {
                echo "<li class='list-group-item m-0'><input class='mr-1' type='radio' name='vote' value='" . $optionCount++ . "'/> $option </li> ";
            }
            echo "</ul></div>

            <div class='card-footer text-xs-center'>
                <button type='submit' value='Submit' class='btn btn-primary btn-block btn-sm'>Vote</button>
            </div>
            <input type='hidden' name='id' value ='$poll_id'/>
            </form></div>";
        }
    }
    $silent_auth = true;
    include "../backend/authorize_event.php";
    if (isset($is_event_manager)) {
        echo "<form class='text-center' action='../backend/poll_remove.php' method='POST'>";
        echo "<input type='hidden' name='id' value ='$poll_id'/>
                <input class='btn btn-secondary' type='submit' value='Remove Poll'>
                </form> ";

    }

}
echo "</div></div></div></div></body>";
