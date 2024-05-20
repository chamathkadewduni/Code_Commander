<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Endorse Teacher</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/master.css">
</head>
<body>
<?php
// Include database connection
include 'connection.php';

session_start();

// Retrieve the values of endorser and endorsee from session variables
$endorser_id = $_SESSION['endorser_id'];
$endorsee_id = $_SESSION['endorsee_id'];
$endorsee_name = $_SESSION['endorsee_name'];
//echo $endorser_id." ".$endorsee_id." ".$endorsee_name;



// Function to check if a skill is endorsed by the endorser
function isEndorsed($conn, $endorser_id, $endorsee_id, $skill_id) {
    $query = "SELECT * FROM endorsements 
              WHERE endorser_id = $endorser_id 
              AND endorsee_id = $endorsee_id 
              AND skill_id = $skill_id";
    $result = mysqli_query($conn, $query);
    if (!$result) {
        die("Query failed: " . mysqli_error($conn));
    }
    if(mysqli_num_rows($result) > 0)
        return 1;
    else
        return 0;
}

// Check if form is submitted
//if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
   // $endorser_id = $_POST['endorser_id'];
//    $endorsee_id = $_POST['endorsee_id'];

    // Fetch endorsee's skills
    $query = "SELECT skills.id, skills.name FROM teacher_skills 
              INNER JOIN skills ON teacher_skills.skill_id = skills.id 
              WHERE teacher_skills.user_id = $endorsee_id";

    $result = mysqli_query($conn, $query);
    if (!$result) {
        die("Query failed: " . mysqli_error($conn));
    }
    
    // Display search results
    echo '<div class="container mt-5">';
    echo '<h2>'. $endorsee_name.'\'s Skills</h2>';
    echo '<div class="row">';
    while ($row = mysqli_fetch_assoc($result)) {
        $skill_id = $row['id'];
        $skill_name = $row['name'];
        $is_endorsed = isEndorsed($conn, $endorser_id, $endorsee_id, $skill_id);

        echo '<div class="col-md-3">';
        //echo '<a href="endorse.php?action=toggle&endorser_id='.$endorser_id.'&endorsee_id='.$endorsee_id.'&skill_id='.$skill_id.'">';
        if ($is_endorsed) {
            echo '<button onclick="toggleEndorse('.$is_endorsed.','.$endorser_id.','.$endorsee_id.','.$skill_id.')" type="button" class="btn btn-success">' . $skill_name . ' &#10004;</button>';
        } else {
            echo '<button onclick="toggleEndorse('.$is_endorsed.','.$endorser_id.','.$endorsee_id.','.$skill_id.')" type="button" class="btn btn-primary">' . $skill_name . '</button>';
        }
        //echo '</a>';
        echo '</div>';
    }
    echo '</div>';
    echo '</div>';

    // "Go back" button
    echo '<div class="container mt-3">';
    echo '<a href="teacher_search.php" class="btn btn-secondary marginR20">Go back</a>';
    echo '<a href="teacher_profile.php" class="btn btn-secondary marginR20">Dashboard</a>';
    echo '</div>';
//}



// Close database connection
mysqli_close($conn); 
?>
<script>
    function toggleEndorse(isEndorsed,endorser_id,endorsee_id,skill_id){
        // Make an AJAX request to set the session variables
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "toggleEndorse.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        
     /*   xhr.onreadystatechange = function() {
    if (xhr.readyState === XMLHttpRequest.DONE) {
        if (xhr.status === 200) {
            console.log(xhr.responseText); // Log the response
        } else {
            console.error('Request failed with status:', xhr.status);
        }
    }
};
*/
        xhr.send("isEndorsed=" + encodeURIComponent(isEndorsed)+"&endorser_id=" + encodeURIComponent(endorser_id)+"&endorsee_id=" + encodeURIComponent(endorsee_id)+"&skill_id=" + encodeURIComponent(skill_id));

        // Redirect to endorse.php
        window.location.href = "endorse.php";
    }
</script>
<!-- Bootstrap JS, jQuery -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>