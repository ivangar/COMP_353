<?php
include("authorize_event.php");

$sql = "SELECT * FROM `resources` JOIN `events` ON `events`.`resource_id` = `resources`.`resource_id` WHERE `events`.`event_id` = $event_id";
$results = $conn->query($sql);
$event_info = $results->fetch_assoc();

$group_id = $event_info["primary_event_group_id"];
$payment_email = $event_info["payment_receiver"];
include("get_total.php");
$event_name = $event_info["event_name"];

?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <script>
    document.addEventListener("DOMContentLoaded",function(){

    document.querySelector("form").submit();
    });
    </script>
</head>
<body>



<form name="_xclick" action="https://www.paypal.com/us/cgi-bin/webscr" method="post">
<input type="hidden" name="cmd" value="_xclick" />
<input type="hidden" name="business" value="<?php echo $payment_email; ?>" />
<input type="hidden" name="currency_code" value="CAD" />
<input type="hidden" name="item_name" value="SCC - <?php echo $event_name; ?>" />
<input type="hidden" name="amount" value="<?php echo $total;?>"  />
</form>


</body>
</html>
