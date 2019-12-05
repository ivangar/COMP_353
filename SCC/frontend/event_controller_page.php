<?php
require "../backend/connection.php";
require "../backend/events/controller_manager.php";
include "../backend/get_system_charge_rate.php";?>


<!doctype html>
<html class="no-js" lang="">

<head>
  <meta charset="utf-8">
  <title>Controller page </title>
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link rel="apple-touch-icon" href="icon.png">
  <!-- Place favicon.ico in the root directory -->

  <meta name="theme-color" content="#fafafa">
</head>

<body>
    <div class="container pt-5">
      <h3>Welcome <?php echo $user_name; ?>!</h3>

      <?php if (!empty($event_rows) && sizeof($event_rows) != 0) {?>

        <form action="../backend/set_system_charge_rate.php" method="post" name="set_system_charge_rate_form" id="set_system_charge_rate_form" enctype="multipart/form-data" class="form-inline pt-4 pb-4">
          <div class="form-group mb-2">
            <label class="pr-3">System Charge Rate</label>
            <input type="text" class="form-control mr-3" name="charge_rate" title="charge_rate" <?php if (!empty($charge_rate)) {echo "value='" . $charge_rate . "'";}?> >
            <button id='update_event' type='submit' class="btn btn-primary">Set System Charge Rate</button>
          </div>
        </form>
        <table class="table"  cellpadding="10" style="text-align: left;">
          <thead>
            <tr>
              <th scope="col">Event Id</th>
              <th scope="col">Event Name</th>
              <th scope="col">Start Date</th>
              <th scope="col">End Date</th>
              <th scope="col">Set Resources</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($event_rows as $row) {
    echo "<tr>";
    foreach ($row as $event_attr) {echo "<td>$event_attr</td>";}
    echo "</tr>";
}?>
        </tbody>
      </table>
      <?php }?>
    </div>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
</body>

</html>


<script>

var url_string =  window.location.href;
var url = new URL(url_string);
var charge_rate_success = url.searchParams.get("charge_rate_update");

if(charge_rate_success == "success"){
  alert("You updated the system charge rate successfully");
}
else if(charge_rate_success=="fail"){
  alert("An error occured, charge rate not updated");
}

</script>