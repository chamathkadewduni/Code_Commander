


<?php
//Database connection
require("connection.php");

// Check if advertisement ID is provided in the URL
if (isset($_GET['id'])) {
    // Sanitize the ID to prevent SQL injection
    $id = mysqli_real_escape_string($conn, $_GET['id']);

    // Construct the SQL DELETE query - Set status to Archived
    //$sql = "DELETE FROM student_ad WHERE id = '$id'";
    $sql = "UPDATE student_ad SET status='Archived' WHERE id = '$id'";
    
    // Execute the query
    if (mysqli_query($conn, $sql)) {
       // Redirect to profile page upon successful update
        header("Location: student_profile.php");
        exit;
    } else {
        // Error occurred while deleting advertisement
        echo "Error: " . mysqli_error($conn);
    }
} else {
    // No advertisement ID provided in the URL
    echo "No advertisement ID provided.";
}
?>
