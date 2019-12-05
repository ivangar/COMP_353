<?php 
require("../backend/connection.php");
require("../backend/group_details.php");
require("navbar.php");?>

<!doctype html>
<html class="no-js" lang="">

<head>
  <meta charset="utf-8">
  <title>Event details</title>
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link rel="apple-touch-icon" href="icon.png">
  <!-- Place favicon.ico in the root directory -->

  <meta name="theme-color" content="#fafafa">
</head>

<body>

<div class="container text-center pt-5">
  <?php if(!empty($group_data) && sizeof($group_data) != 0) {  ?>
		<div class="flex border border-primary rounded-top mb-4">
			<form action="../backend/events/update_event.php" class="form" method="post" name="update_group_form" id="update_group_form" accept-charset="utf-8">
			<?php 
			    $disabled = (!$group_manager) ? "disabled='disabled'" : "";
				echo "<input type='hidden' name='event_id' value='$event_id'>
						<input type='hidden' name='group_id' value='$group_id'>";
				echo "<fieldset $disabled><legend class='bg-primary p-4 mb-4 text-white rounded-top'>Group details</legend><table class='d-flex justify-content-center' cellpadding='10' style='text-align: left;'><tbody>";
				foreach($group_data as $label => $value) { 
				   $column_name = $group_data_ids[$label];
				   $input_type = "text";
				   
				   if($column_name === "status"){
						  $radio_btns = ($value == 1) ? 
						  "<input type='radio' name='status' title='status' value='1' checked> active <input type='radio' name='status' title='status' value='2' > archived " : 
									"<input type='radio' name='status' title='status' value='1' > active <input type='radio' name='status' title='status' value='2' checked > archived ";
									echo "<tr><td><label>$label</label></td><td>$radio_btns</td></tr>";
								  }

					else echo "<tr><td><label>$label</label></td><td><input class='form-control' type='$input_type' name='$column_name' title='$column_name' value='$value'></td></tr>";
				}
				echo "</tbody></table></fieldset><div style='padding-top:30px;'>
								<table class='d-flex justify-content-center' cellpadding='10' style='text-align: left;'>
								  <tbody>
								  <tr>
									  <td><button class='btn btn-primary' id='view_participants'>View participants</button></td>";
									  if($group_manager){ echo "<td><button class='btn btn-primary'  id='update_participant' type='submit'>Update</button></td>";}
								  echo "
									  </tr>
									  </tbody>
									  </table>
									  </div>";
			?>
			</form>
		</div>
  <?php }?>
</div>

  <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
  <script type="text/javascript">
	$(document).ready(function () {
		
		var group_id = <?php echo $group_id; ?>;
		var event_id = <?php echo $event_id; ?>;
		var group_manager = <?php if($group_manager) {echo 1;} else echo 0;?>;
		
		$( "#update_group_form" ).submit(function( event ) {
			group_data = $("#update_group_form").serializeArray();
			event.preventDefault();

		    $.ajax({
			  url: "../backend/update_group.php",
              cache: false,
              type: "POST",
              dataType: "html",
              data: group_data
            }) 
            .done(function( data ) {
             	if(data === "updated"){
					alert("event has been updated");
					window.location.href = "event_home.php?event_id="+event_id+"&group_id="+group_id;
				}
                else alert(data);
            })
            .fail(function() {
                alert("event did not update"); 
            }); //ajax call
		});

		$("#view_participants").click(function (event) {
			event.preventDefault();
			var group_name = $('#update_group_form').find('input[name="name"]').val();
			window.location.href = "view_participants.php?group_id="+group_id+"&group_manager="+group_manager+"&group_name="+group_name;
		});
      
	});//end document.ready
  </script>
</body>

</html>