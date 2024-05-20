<?php
session_start();
include('connection.php');
/*if (!isset($_SESSION['username'])) {
    exit("You are not logged in-1");
}
*/

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Database connection (similar to chat.php)

    $sender = $_POST['sender'];
    $receiver = $_POST['receiver'];
    $message = $_POST['message'];

    $sql = "INSERT INTO chat_messages (sender, receiver, message,created_at) VALUES ('$sender', '$receiver', '$message','".date("Y-m-d H:i:s")."')";
    //echo $sql;
    $conn->query($sql);
    $conn->close();
}


?>