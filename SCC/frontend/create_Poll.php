<?php
include("../backend/authorize_event.php");
?>

<html>
<head>
    <script>
    function addOption()
    {
        var optionCount = document.querySelectorAll(".option").length;
        var newOption = document.createElement("input");
        newOption.type = "input";
        newOption.classList.add("option");
        newOption.name = "option" + optionCount;
        newOption.placeholder = "option" + (optionCount + 1);
        newOption.required = true;
        document.querySelector(".option-List").appendChild(newOption);

    }

    function removeOption()
    {
        var optionList = document.querySelectorAll(".option");
        if(optionList.length > 2)
        {
            var option = optionList[optionList.length - 1];
            option.parentNode.removeChild(option);
        }
    }

    function onSubmit(e)
    {
        var optionString = "";
        document.querySelectorAll(".option").forEach( (item) => {
            optionString += item.value + ";";
        });

        optionString = optionString.substr(0,optionString.length - 1);
        document.querySelector("#option_list").value = optionString;
        //e.preventDefault();

    }
    document.addEventListener("DOMContentLoaded",function(){

    document.querySelector("form").addEventListener('submit', onSubmit);
    });
    </script>
<title> Create poll </title>
</head>
<body>
<h1> Create Poll</h1>
<form action= "../backend/poll_add.php?group_id=<?php echo $_GET["group_id"]; ?>&event_id=<?php echo $event_id; ?>" method="POST" >
    <input type="text" name="title" placeholder="Poll title"/ required><br>
    <div class="option-List">
        <input type="text" class="option" name="option-0" placeholder="option 1" required/><br>
        <input type="text" class="option" name="option-1" placeholder="opton 2" required/><br>
    </div>
        <button type="button" onClick="addOption()">+</button>
        <button type="button" onClick="removeOption()">-</button>
    <h3> Date </h3>
    <input type="datetime-local" name="end_date"/ required><br>
    <input type="hidden" name="option_list" id="option_list"/>
    <input type="submit" value="Create"/>
</form>
</body>

</html>