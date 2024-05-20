<?php
require "connection.php";
?>
<?php
$email=$_POST['email'];
$tempPass="";
$status ="";

// Query to get the temporary password for the provided email
$sql = "SELECT password,status FROM `user_login` WHERE user_id=(SELECT id FROM `users` WHERE email = '".$email."')";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Output the temporary password
    $row = $result->fetch_assoc();
    if($row["status"]=='active')
        echo "msg:Your account is already active. Please proceed to Log In";
    else if($row["status"]='approved')
        echo $row["password"];
} else {
    // If no matching email found, output an error message
    echo "msg:No records found for the provided email.";
}

$conn->close();
?>