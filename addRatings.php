<?php
require "connection.php";

$user_id=$_POST['user_id'];
$rating=$_POST['rating'];
$given_by=$_POST['given_by'];
$rating_id=-1;
$credit_id=-1;
$sql="INSERT INTO `ratings` (`user_id`,`ratings_received`,`given_by`,`received_on`) VALUES (".$user_id.",".$rating.",".$given_by.",'".date("Y-m-d H:i:s")."')" ; 
//$result = $conn->query($sql);
if (mysqli_query($conn, $sql)) {
    // Insert successful, return the ID of the inserted city
    $rating_id = mysqli_insert_id($conn);
} 

//Add a credit for 5 star ratings
if($rating==5){
    $sql="INSERT INTO `credits` (`user_id`,`credits_received`,`received_on`,`reason`) VALUES (".$user_id.",1,'".date("Y-m-d H:i:s")."','rating')" ; 
    //$result = $conn->query($sql);
    if (mysqli_query($conn, $sql)) {
        // Insert successful, return the ID of the inserted city
        $credit_id = mysqli_insert_id($conn);
    } 
}
//echo "<script>console.log(test);</script>";
if($rating_id>0 && $credit_id>0){
    $sql="INSERT INTO `credits_ratings` (`credit_id`,`rating_id`) VALUES (".$credit_id.",".$rating_id.")" ; 
    echo "<script>console.log(".$sql.");</script>";
    $result = $conn->query($sql);
}

/*if ($result->num_rows > 0) {
    // Output the temporary password
    $row = $result->fetch_assoc();
    $json_row = json_encode($row);
    echo $json_row;
} else {
    // If no matching email found, output an error message
    echo "msg:No records found for the provided email.";
}
*/
$conn->close();
?>