<!DOCTYPE html>
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
    <?php
    session_start();
    $user_id="";
    $role="";
	if($_SESSION['user_id']=="")
	{
		$_SESSION=[];
		header("Location: index.php");
	}
	else{
	    $user_id=$_SESSION['user_id'];
	    $role=$_SESSION['role'];
	}
    ?>
    <style>
    body{
        padding:20px;
    }
        .card {
          box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
          transition: 0.3s;
          /*width: 20%;*/
        }
        
        .card:hover {
          box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2);
        }
        
        .container {
          padding: 2px 16px;
        }
    </style>
    
        <!-- <a href="insert_advertisements.php" class="btn btn-warning">+ Create a post</a>  -->
        <a href="teacher_search.php" class="btn btn-warning">🔍 Find a teacher</a>
        <!--<a href="chat.php" class="btn btn-warning">💬 My Messages</a>
         <a href="my_skills.php" class="btn btn-warning">🎓️ My Skills</a> -->
         <a href="skills_management.php" class="btn btn-warning">🎓 Skills Management</a>
        <a href="study_materials.php" class="btn btn-warning">📚 Study Materials</a>
         <a href="index.php" class="btn btn-warning">Sign Out</a>
       
        <br><br>
        <?php 
            include "pendingUsers.php"; 
            include "skill_test/view_results.php";
        
        ?>

        <br>
</body>
</html>
<?php

//Database connection
require("connection.php");

/*
// Fetch advertisement data from the database
$sql = "SELECT id, user_id, topic, status FROM tutor_ad WHERE user_id=".$user_id;//." AND status='Active'";
$result = $conn->query($sql);

// Display data in Bootstrap cards 
if ($result->num_rows > 0) {
    $counter = 0;
    echo '<div class="row">';
    while($row = $result->fetch_assoc()) {
        if ($counter % 3 == 0 && $counter != 0) {
            echo '</div>'; // Close previous row
            echo '<div class="row">'; // Start new row
        }
        echo '<div class="col-md-3">';
        echo '<div class="card">';
        echo '<div class="card-body">';
        
        echo '<h4 class="card-title">' . $row["topic"] . '</h4>';
        
       // echo '<br>';
         // View Button
        echo '<a href="view_advertisement.php?id=' . $row["id"] . '" class="btn btn-primary"><i class="bi bi-file-text"></i></a> &nbsp';
        // Update Button
        echo '<a href="update_advertisement.php?id=' . $row["id"] . '" class="btn btn-success"><i class="bi bi-pencil"></i> </a>&nbsp';
        // Delete Button
        echo '<a href="delete_advertisement.php?id=' . $row["id"] . '" class="btn btn-danger"><i class="bi bi-trash"></i> </a>&nbsp';
        //Status change Button
        echo $row["status"] === "Active" ? '<a href="hide_advertisement.php?id=' . $row["id"] . '" class="btn btn-secondary"><i class="bi bi-eye-slash"></i></a>' : '<a href="show_advertisement.php?id=' . $row["id"] . '" class="btn btn-secondary"><i class="bi bi-eye"></i></a>';
        echo '<p></p>';
        echo '<div class="card-text"><b>Ad id: </b><i>' . $row["id"] . '</i></div>';
        echo '<div class="card-text"><i>' . $row["status"] . '</i></div>';
       echo '</div>';   
        echo '</div>';
         echo '<br>';
        echo '</div>';
        $counter++;
       
    }
    echo '</div>'; // Close the last row
} else {
    echo "No posts yet";
}

*/
// $stmt->close();
$conn->close();
?>
