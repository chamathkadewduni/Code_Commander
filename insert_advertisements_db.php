<?php
//Database connection
require "connection.php";
include "getCityId.php";
session_start();

        // Get data from form
        // $user_id = $_POST['user_id'];
        $user_id = $_SESSION['user_id'];
        $topic = $_POST['topic'];
        $subject = $_POST['subject'];
        $grade = $_POST['grade'];
        $city = $_POST['city'];
        $district = $_POST['district'];
        $medium = $_POST['medium'];
        $classType = $_POST['classType'];
        $rateType = $_POST['rateType'];
        $rate = $_POST['rate'];
        $status = "Active";
        $description = $_POST['description'];
        $currentDateTime = date("Y-m-d H:i:s");
        $reason = "Ad publish";
        $noOfCredits = -1;
        //echo $user_id;
        
        $city_id = getCityId($city,$district);
        
       /*$sql = "INSERT INTO tutor_ad (user_id, topic, subject, grade, description, city_id, medium, type, rate, rateType, status) VALUES (".$user_id.",'".$topic."','".$subject."','".$grade."','".$description."',".$city_id.",'".$medium."','".$classType."','".$rate."','".$rateType."','".$status."')";
        echo $sql;
        */
        // Prepare and bind the SQL statement
        $stmt = $conn->prepare("INSERT INTO tutor_ad (user_id, topic, subject, grade, description, city_id, medium, type, rate, rateType, status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        
        $stmt->bind_param("issssississ",$user_id, $topic, $subject, $grade, $description, $city_id, $medium, $classType, $rate, $rateType, $status);
        
        // Execute SQL statement
        if ($stmt->execute() === TRUE) {
             
        // Insert record into credits table
        $insert_credit_query = "INSERT INTO credits (user_id, credits_received, received_on, reason) VALUES (?, ?, ?, ?)";
        
        // Prepare and execute the insert credit query
        $insert_stmt = $conn->prepare($insert_credit_query);
        $insert_stmt->bind_param("iiss", $user_id, $noOfCredits, $currentDateTime, $reason);
        $insert_stmt->execute();
        

            echo "Data inserted successfully";
            header("Location: teacher_profile.php");
            exit; // Ensure that code execution stops after redirection
        } else {
            echo "Error: " . $stmt->error;
        }
        
        
      
    /*    // Start a transaction
        $conn->begin_transaction();
        
        $stmt = $conn->prepare("INSERT INTO tutor_ad (user_id, topic, subject, grade, description, city_id, medium, type, rate, rateType, status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ississsis", $user_id, $topic, $subject, $grade, $description, $city_id, $medium, $type, $rate, $rateType, $status);
        
        if ($stmt->execute()) {
            // Insert record into credits table
            $insert_credit_query = "INSERT INTO credits (user_id, credits_received, received_on, reason) VALUES (?, ?, ?, ?)";
            $insert_stmt = $conn->prepare($insert_credit_query);
            $insert_stmt->bind_param("iiss", $user_id, $noOfCredits, $currentDateTime, $reason);
            
            if ($insert_stmt->execute()) {
                // Commit the transaction if both insertions are successful
                $conn->commit();
                echo "Data inserted successfully";
                header("Location: teacher_profile.php");
                exit; // Ensure that code execution stops after redirection
            } else {
                // Rollback the transaction if insertion into credits fails
                $conn->rollback();
                echo "Error inserting into credits table: " . $insert_stmt->error;
            }
        } else {
            // Rollback the transaction if insertion into tutor_ad fails
            $conn->rollback();
            echo "Error inserting into tutor_ad table: " . $stmt->error;
        }
    */

$conn->close();
?>

<html>
    <head>
         <meta charset="utf-8">
       <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-o+RDsa0aLu++PJvFqy8fFf4jGg0F73gHYx8HFRmzV+0i4rT/E3U3JpZISkd/Prur" crossorigin="anonymous">
     <!-- Link to Bootstrap CSS via CDN -->
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
      <!-- Link to Bootstrap Icons CSS via CDN -->
      <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <title>ReachingTeaching.com</title>
    </head>
    <body>
        <br>
        <a href="teacher_profile.php" class="btn btn-secondary">Go back</a>
    </body>
</html>


