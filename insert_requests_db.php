<?php
//Database connection
require("connection.php");
include "getCityId.php";

// Get data from form
        $user_id = $_POST['user_id'];
        $topic = $_POST['topic'];
        $subject = $_POST['subject'];
        $grade = $_POST['grade'];
        $city = $_POST['city'];
        $district = $_POST['district'];
        $medium = $_POST['medium'];
        $classType = $_POST['classType'];
        $status = "Active";
        $description = $_POST['description'];
        $currentDateTime = date("Y-m-d H:i:s");
        $reason = "Ad publish";
        $noOfCredits = -1;
        //echo $user_id;
        
        $city_id = getCityId($city,$district); 
        /*$sql = "INSERT INTO student_ad (user_id, topic, subject, grade, description, city_id, medium, type, status) VALUES (".$user_id.",'".$topic."','".$subject."','".$grade."','".$description."',".$city_id.",'".$medium."','".$classType."','".$status."')";
        echo $sql;*/
// Prepare and bind the SQL statement
$stmt = $conn->prepare("INSERT INTO student_ad (user_id, topic, subject, grade, description, city_id, medium, type, status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");

$stmt->bind_param("issssisss",$user_id, $topic, $subject, $grade, $description, $city_id, $medium, $classType, $status );

// Set parameters
/*$topic = $_POST['topic'];
$user_id = $_POST['user_id'];
$city_id = $_POST['city_id'];
$medium = $_POST['medium'];
$type = $_POST['type'];
$status = "Active";
$description = $_POST['description'];

*/
    // Insert each interest into the database
    // foreach ($_POST['language'] as $language) {
    //     $stmt->execute();
    // }

        // Execute SQL statement
        if ($stmt->execute() === TRUE) {
             
        // Insert record into credits table
        $insert_credit_query = "INSERT INTO credits (user_id, credits_received, received_on, reason) VALUES (?, ?, ?, ?)";
        
        // Prepare and execute the insert credit query
        $insert_stmt = $conn->prepare($insert_credit_query);
        $insert_stmt->bind_param("iiss", $user_id, $noOfCredits, $currentDateTime, $reason);
        $insert_stmt->execute();
        

            echo "Data inserted successfully";
            header("Location: student_profile.php");
            exit; // Ensure that code execution stops after redirection
        } else {
            echo "Error: " . $stmt->error;
        }

//$stmt->close();
$conn->close();
?>
