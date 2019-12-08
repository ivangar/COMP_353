<?php 
require("navbar.php");
$user_id = $_GET["user_id"];
$group_id = $_GET["group_id"];
$group_name = $_GET["group_name"];
require("../backend/users/participant.php");
?>

<!doctype html>
<html class="no-js" lang="">

<head>
  <meta charset="utf-8">
  <title>Edit participant</title>
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link rel="apple-touch-icon" href="icon.png">
  <!-- Place favicon.ico in the root directory -->

  <meta name="theme-color" content="#fafafa">

  <style type="text/css">
  	h3{ 
  		text-align: center; 
  	}
    div.container{
    	margin: auto; 
    	width: 50%;
    }
    table{
    	text-align: left;
    }
    .right {
      position: absolute;
      right: 0px;
      padding: 10px;
    }
</style>
</head>

<body>

  <h3>Edit participant's information</h3>

  	<div class="container">
	  	<form action="../backend/users/update_participant.php" method="post" name="update_participant_form" id="update_participant_form" accept-charset="utf-8">
        
			<?php 
			 echo "<input type='hidden' name='group_id' value='$group_id'>
             <input type='hidden' name='user_id' value='$user_id'>
             <input type='hidden' name='action' value='update_participant'>";

			 if(!empty($participant_data) && sizeof($participant_data) != 0) {
        echo "<fieldset><table cellpadding='10' style='text-align: left;'><tbody>";

				foreach($participant_data as $label => $value) { 
					$column_name = $participant_data_ids[$label];
          $input_type = "text";
          $required = "";

          if($column_name === "participant_status_id"){
              $options = "";
              if($value == 1)
                $options = "<option value='1' selected>approved</option><option value='2'>rejected</option><option value='3'>pending</option>";
              elseif($value == 2)
                $options = "<option value='1'>approved</option><option value='2' selected>rejected</option><option value='3'>pending</option>";
              else
                $options = "<option value='1'>approved</option><option value='2'>rejected</option><option value='3' selected>pending</option>";

             echo "<tr><td><label>$label</label></td><td><select name='status'>$options</select></td></tr>";
          }

          //Check date types
          elseif($column_name === "date_of_birth"){
            
            $input = "<input type='date' name='$column_name' title='$column_name'>";
            
            if(!empty($value))
              $input = "<input type='date' name='$column_name' title='$column_name' value='$value'>";

            echo "<tr><td><label>$label</label></td><td>$input</td></tr>";

          }

          else{
            //Check non null columns and set required input field
            if($column_name === "first_name" || $column_name === "last_name" || $column_name === "email"){$required = "required";}
            echo "<tr><td><label>$label</label></td><td><input type='$input_type' name='$column_name' title='$column_name' value='$value' $required></td></tr>";
          }
							 
				}
        echo "</tbody></table></fieldset>";
			}

      echo "<div style='padding-top:30px;'>
            <table cellpadding='10' style='text-align: left;'>
              <tbody>
                <tr>
                <td><button id='update_event' type='submit'>Update</button></td>
                </tr>
              </tbody>
            </table>
            </div>";
			?>
		</form>
	</div>

  <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
  <script type="text/javascript">
	$(document).ready(function () {
    var group_id = <?php echo "$group_id"; ?>;
    var group_name = <?php echo "'$group_name'"; ?>;

		$( "#update_participant_form" ).submit(function( event ) {
			  participant_data = $("#update_participant_form").serializeArray();
        event.preventDefault();

        $.ajax({
              url: "../backend/users/update_participant.php",
              cache: false,
              type: "POST",
              dataType: "html",
              data: participant_data
            }) 
            .done(function( data ) {
             	if(data === "updated"){
                alert("participant has been updated");
                window.location.href = "view_participants.php?group_id="+group_id+"&group_manager=1&group_name="+group_name;
              } 
                else alert(data);
            })
            .fail(function() {
                alert("participant's info did not update"); 
            }); //ajax call

    });
      
	});//end document.ready
  </script>
</body>

</html>