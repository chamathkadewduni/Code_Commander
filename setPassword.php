<?php
require "connection.php";
?>
<?php
$email=$_POST['email'];
$password=$_POST['newPass'];

$sql = "UPDATE `user_login` SET password='".$password."',status='active' WHERE user_id=(SELECT id from `users` WHERE email='".$email."')";
$conn->query($sql) ;
header("Location:index.php");
/*if ($conn->query($sql) === TRUE) {
    header("Location:login.php");
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
*/
$conn->close();
?>