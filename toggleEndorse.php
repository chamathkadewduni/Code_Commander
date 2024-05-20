<?php 

include "connection.php";
// Handle toggle action
//function toggleEndorse($isEndorsed){
//if (isset($_GET['action']) && $_GET['action'] === 'toggle') {
    $isEndorsed = $_POST['isEndorsed'];
    $endorser_id = $_POST['endorser_id'];
    $endorsee_id = $_POST['endorsee_id'];
    $skill_id = $_POST['skill_id'];
 //echo $endorser_id." | ".$endorsee_id." | ".$skill_id;
    // Toggle endorsement
    //if (isEndorsed($conn, $endorser_id, $endorsee_id, $skill_id)) {
    if($isEndorsed==1){
        // Un-endorse skill
        $delete_query = "DELETE FROM endorsements 
                         WHERE endorser_id = $endorser_id 
                         AND endorsee_id = $endorsee_id 
                         AND skill_id = $skill_id";
        $delete_result = mysqli_query($conn, $delete_query);
        if (!$delete_result) {
            echo '<div class="container mt-3 alert alert-danger" role="alert">';
            echo 'Error deleting endorsement: ' . mysqli_error($conn);
            echo '</div>';
        } else {
            echo '<div class="container mt-3 alert alert-success" role="alert">';
            echo 'Skill with ID ' . $skill_id . ' un-endorsed successfully';
            echo '</div>';
            echo '<button onclick="location.href=\'search_teacher.html\'" class="btn btn-primary mt-3">OK</button>';
        }
    } else {
        // Endorse skill
        $insert_query = "INSERT INTO endorsements (endorser_id, endorsee_id, skill_id, endorsement_date) 
                         VALUES ($endorser_id, $endorsee_id, $skill_id, NOW())";
        $insert_result = mysqli_query($conn, $insert_query);
        if (!$insert_result) {
            echo '<div class="container mt-3 alert alert-danger" role="alert">';
            echo 'Error endorsing skill: ' . mysqli_error($conn);
            echo '</div>';
        } else {
            echo '<div class="container mt-3 alert alert-success" role="alert">';
            echo 'Skill with ID ' . $skill_id . ' endorsed successfully';
            echo '</div>';
            echo '<button onclick="location.href=\'search_teacher.html\'" class="btn btn-primary mt-3">OK</button>';
        }
    }
//}
//echo "<script>location.reload();</script>";
//}

?>