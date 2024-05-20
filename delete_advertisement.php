


<?php
//Database connection
require("connection.php");

// Check if advertisement ID is provided in the URL
if (isset($_GET['id'])) {
    // Sanitize the ID to prevent SQL injection
    $id = mysqli_real_escape_string($conn, $_GET['id']);

    // Construct the SQL DELETE query - Make the status Archived
    //$sql = "DELETE FROM tutor_ad WHERE id = '$id'";
    $sql = "UPDATE tutor_ad SET status='Archived' WHERE id = '$id'";

    // Execute the query
    if (mysqli_query($conn, $sql)) {
        // Redirect to profile page upon successful update
        header("Location: teacher_profile.php");
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

 