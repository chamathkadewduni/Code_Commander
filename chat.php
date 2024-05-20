<?php
session_start();
include('connection.php');

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}


$user_id = $_SESSION['user_id'];
$fname = $_SESSION['fname'];
$selectedUser = '';



if (isset($_GET['user'])) {
    $selectedUser = $_GET['user'];
    $selectedUser    = mysqli_real_escape_string($conn, $selectedUser);
    $showChatBox = true; // Set to true only when a user is selected
} else {
    $showChatBox = false; // Set to false initially
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Real-time Chat</title>
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
<link href="css/chat_style.css" rel="stylesheet">

</head>
<body>
<div class="container">
    <div class="header">
        <h1>My Messages</h1>
        <a onclick="history.back()" class="logout">Go Back</a>
        <!--<a href="logout.php" class="logout">Logout</a>-->
    </div>
    <div class="account-info">
        <div class="welcome">
            <h3>Welcome, <?php echo ucfirst($fname); ?>!</h3>
        </div>
        <div class="user-list">
            <h3>Select a User to Chat With:</h3>
            <ul>
                <?php 
                // Fetch all users except the current user
                //$sql = "SELECT u.fname FROM users AS u JOIN chat_messages as cm ON u.id = cm.sender WHERE id != '$user_id' AND id !='-1' ";
                $sql="SELECT fname,id FROM users WHERE id IN (SELECT sender FROM chat_messages WHERE receiver = ".$user_id.")";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $user = $row['fname'];
                        $user = ucfirst($user);
                        echo "<li style='cursor:pointer'><a onclick='showChat(\"" . $user ."\",$user_id,". $row['id']. ")'>$user</a></li>";
                    }
                }
                ?>
            </ul>
        </div>
    </div>

    <div id="chat_container" style="display:none">
    <div class="chat-box" id="chat-box">
        <div class="chat-box-header">
            <h3 id="chatHeader">Hi</h3>
            <button class="close-btn" onclick="closeChat()">✖</button>
        </div>
        <div class="chat-box-body" id="chat-box-body">
            <!-- Chat messages will be loaded here -->
        </div>
        <form class="chat-form" id="chat-form">
            <input type="hidden" id="sender" value="user_id">
            <input type="hidden" id="receiver" value="fname">
            <input type="text" id="message" placeholder="Type your message..." required>
            <button type="submit">Send</button>
        </form>
    </div>
    </div>
</div>



<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>

    
    
    function closeChat() {
        document.getElementById("chat_container").style.display = "none";
    }


    // Function to toggle chat box visibility
    function toggleChatBox() {
    var chatBox = document.getElementById("chat-box");
    if (chatBox.style.display === "none") {
        chatBox.style.display = "block"; // Show the chat box
    } else {
        chatBox.style.display = "none"; // Hide the chat box
    }
}


       /* function fetchMessages() {
            var sender = $('#sender').val();
            var receiver = $('#receiver').val();
            
            $.ajax({
                url: 'fetch_messages.php',
                type: 'POST',
                data: {sender: sender, receiver: receiver},
                success: function(data) {
                    $('#chat-box-body').html(data);
                    scrollChatToBottom();
                }
            });
        }


        // Function to scroll the chat box to the bottom
        function scrollChatToBottom() {
            var chatBox = $('#chat-box-body');
            chatBox.scrollTop(chatBox.prop("scrollHeight"));
        }

 
        
        $(document).ready(function() {
            // Fetch messages every 3 seconds
            
            fetchMessages();
            setInterval(fetchMessages, 3000);
        });


           // Submit the chat message
            $('#chat-form').submit(function(e) {
            e.preventDefault();
            var sender = $('#sender').val();
            var receiver = $('#receiver').val();
            var message = $('#message').val();

            $.ajax({
                url: 'submit_message.php',
                type: 'POST',
                data: {sender: sender, receiver: receiver, message: message},
                success: function() {
                    $('#message').val('');
                    fetchMessages(); // Fetch messages after submitting
                }
            });

            });
*/

</script>
    <script src="js/chat.js"></script>
    <script>
        function showChat(fname,sender,receiver){
        document.getElementById("chat_container").style="display:inline-block";
        document.getElementById("chatHeader").innerText=fname;
        document.getElementById("sender").value=sender;
        document.getElementById("receiver").value=receiver;
        fetchMessages();
    }
    </script>
</body>
</html>