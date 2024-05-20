<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Skills</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
               <div class="container" style="padding-top:20px">
                    <a href="#" class="btn btn-warning" onclick="loadPage('skill_test/skill_test.php')">🎯 Test my Skills</a>

<?php
// Include database connection
include 'connection.php';

// Check if form is submitted
//if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    // $endorser_id = $_POST['endorser_id'];
    
    session_start();
    $endorsee_id = $_SESSION['user_id'];
    
   // Fetch endorsee's skills and count of endorsements for each skill
    $query = "SELECT skills.id, skills.name, COUNT(endorsements.id) AS endorsement_count 
              FROM teacher_skills 
              INNER JOIN skills ON teacher_skills.skill_id = skills.id 
              LEFT JOIN endorsements ON teacher_skills.skill_id = endorsements.skill_id 
              WHERE teacher_skills.user_id = $endorsee_id 
              GROUP BY skills.id, skills.name ORDER BY skills.name";
              
              

    $result = mysqli_query($conn, $query);
    if (!$result) {
        die("Query failed: " . mysqli_error($conn));
    }
    
    // Display search results
    echo '<div class="container mt-5">';
    echo '<h2>My Skills</h2>';
    while ($row = mysqli_fetch_assoc($result)) {
        echo '<div class="row">';
        echo '<div class="col-md-3">';
        echo '<button type="button" class="btn btn-primary">' . $row['name'] . '</button>';
        if ($row['endorsement_count'] == 1) {
            echo '<h6 class="mt-2">' . $row['endorsement_count'] . ' peer endorsed you</h6>';
        } else if ($row['endorsement_count'] > 1) {
            echo '<h6 class="mt-2">' . $row['endorsement_count'] . ' peers endorsed you</h6>';
        }
        echo '</div>';
        echo '</div>';
        echo '<hr>';
    }
    echo '</div>';

    // "Go back" button
    echo '<div class="container mt-3">';
    echo '<a href="teacher_profile.php" class="btn btn-secondary">Go back</a>';
    echo '</div>';
//}

// Close database connection
mysqli_close($conn);
?>
</div>
<script>
      function loadPage(filename) {
        window.location.href = filename;
      }
    </script>
<!-- Bootstrap JS, jQuery -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
