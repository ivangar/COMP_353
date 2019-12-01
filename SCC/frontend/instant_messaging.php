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

    <body class="pt-5">
        <div class="container border border-primary p-0 rounded-top">
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
                    <form class="form-horizontal" onsubmit="addMessage(); return false;">
                        <div class="row">
                            <div class="col-sm-9 p-2">
                                <textarea class="form-control" rows="3" name="message" id="message" placeholder="message"></textarea>
                                <input type="hidden" name="group_id" value="<?php echo $_GET['group_id']; ?>">
                            </div>
                            <div class="col-sm-3 p-2">
                                <button type="submit" class="btn btn-primary btn-block">Send</button>
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
            .get('https://jsonplaceholder.typicode.com/todos?_limit=5')
            .then(res => {
                setChatBox(res);
                setTimeout(function() { getMessage(); }, 3000);
                })
            .catch(err => console.error(err));
    }

    function addMessage() {
    axios
        .post('https://jsonplaceholder.typicode.com/todos', {

        // group_id: document.getElementById('group_id').value,
        // message: document.getElementById('message').value,

        //remove both these line and replace with ^r
        title: document.getElementById('message').value,
        completed: false
        })
        .then(res => console.log(res))
        .catch(err => console.error(err));
    }

    function setChatBox(res){
        var chatMessages = "";

        res.data.forEach(function(item){
            chatMessages = chatMessages.concat( "<div class='chat-log-item bg-light'>" +
                                                    "<h6 class='font-weight-bold'>Siamak <small class='pl-1'>3:30</small></h6>" +
                                                    "<div>"+item.title+"</div>" +
                                                "</div>");
            console.log(item.title);
        });

        document.getElementById("chat-log").innerHTML = chatMessages;

    }
</script>


