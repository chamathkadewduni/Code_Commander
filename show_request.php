
<?php

require("connection.php");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Update the status of advertisement to 'active' in the database
if(isset($_GET['id']) && !empty($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "UPDATE student_ad SET status = 'Active' WHERE id = $id";
    
    if ($conn->query($sql) === TRUE) {
        // Redirect to profile page upon successful update
        header("Location: student_profile.php");
        exit;
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
} else {
    echo "Invalid advertisement ID.";
}


// Close the database connection
$conn->close();
?>
