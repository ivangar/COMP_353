<!--
test link:
http://comp_353.test/SCC/frontend/instant_messaging.php?group_id=1
-->

<!doctype html>
<html class="no-js" lang="">

    <head>
        <meta charset="utf-8">
        <title> ChatBox </title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="theme-color" content="#fafafa">
        <link rel="stylesheet" type="text/css" href="../css/chatbox.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    </head>

    <body>
        <div class="container border border-primary p-0 rounded-top mb-5">
            <header class="page-header bg-primary p-4 text-white">
                <div class="container-fluid ">
                    <h2>Chat Box</h2>
                </div>
            </header>
            <div class="container-fluid pl-4 pr-0">
                <div class="chat-log pt-4 pb-4 " id="chat-log">
            </div>
            <div class="bg-light p-4 border-top">
                <div class="container ">
                    <form class="form-horizontal">
                        <div class="row">
                            <div class="col-sm-9 p-2">
                                <textarea class="form-control" rows="3" name="message" id="message" placeholder="message"></textarea>
                                <input type="hidden" id="group_id" name="group_id" value="<?php echo $_GET['group_id']; ?>">
                            </div>
                            <div class="col-sm-3 p-2">
                                <button type="button" onclick="addMessage(); return false;" class="btn btn-primary btn-block">Send</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>

<script src="https://unpkg.com/axios/dist/axios.min.js"></script>

<script>

    window.onload = getMessage;

    // gets messags recursively and asynchronously every 3 seconds
    function getMessage(){
        axios
            .get('../backend/instant_messaging/get_messages.php/?group_id='+ document.getElementById('group_id').value)
            .then(res => {
                setChatBox(res);
                setTimeout(function() { getMessage(); }, 1000);
                })
            .catch(err => console.error(err));
    }

    function addMessage() {
        axios
            .post('../backend/instant_messaging/add_message.php', {

            group_id: document.getElementById('group_id').value,
            message: document.getElementById('message').value
            })
            .then(res => console.log(res))
            .catch(err => console.error(err));

        document.getElementById('message').value = ''
    }

    function setChatBox(res){
        var chatMessages = "";
        console.log(res);
        res.data.forEach(function(item){
            chatMessages = "<div class='chat-log-item bg-light'>" +
                                "<h6 class='font-weight-bold'>"+item.first_name+" <small class='pl-1'>"+item.time+"</small></h6>" +
                                "<div>"+item.message+"</div>" +
                            "</div>" + chatMessages ;
            console.log(item.title);
        });
        document.getElementById("chat-log").innerHTML = chatMessages;

    }
</script>


