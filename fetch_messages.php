<?php
session_start();
include('connection.php');

/*if (!isset($_SESSION['username'])) {
    exit("You are not logged in");
}*/

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $sender = $_POST['sender'];
    $receiver = $_POST['receiver'];

    //$sql = "SELECT * FROM chat_messages WHERE (sender='$sender' AND receiver='$receiver') OR (sender='$receiver' AND receiver='$sender') ORDER BY created_at";
    $sql="SELECT sender,fname,message FROM chat_messages AS cm LEFT JOIN users AS u ON u.id= cm.sender WHERE receiver='$sender' OR sender='$sender' ORDER BY created_at;";
    $result = $conn->query($sql);


    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            if($row['sender']==$_SESSION['user_id'])
                echo '<div class="message right"><strong> You:</strong> <br>' . $row['message'] . '</div>';
            else
                echo '<div class="message"><strong>' . ucfirst($row['fname']) . ':</strong> <br>' . $row['message'] . '</div>';
        }
    }
}

?>