<?php
// Database connection
require("connection.php");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the ID parameter is set in the URL
if(isset($_GET['id']) && !empty($_GET['id'])) {
    $id = $_GET['id'];
    
    // Retrieve data based on the ID from the database
    $sql = "SELECT * FROM student_ad WHERE id = $id";
    $result = $conn->query($sql);
    
    if ($result->num_rows == 1) {
        // retrieved data
        $row = $result->fetch_assoc();
        $user_id = $row["user_id"];
        $topic = $row["topic"];
        $description = $row["description"];
        $city_id = $row["city_id"];
        $medium = $row["medium"];
        $type = $row["type"];
       
    } else {
        echo "No data found for the provided ID.";
        exit;
    }
} else {
    echo "Invalid ID provided.";
    exit;
}

// submission to update the data
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve updated values from the form
    $updated_user_id = $_POST["user_id"];
    $updated_topic = $_POST["topic"];
    $updated_description = $_POST["description"];
    $updated_city_id = $_POST["city_id"];
    $updated_medium = $_POST["medium"];
    $updated_type = $_POST["type"];
 
    
    // Update the data in the database
    $sql = "UPDATE student_ad SET user_id = '$updated_user_id', topic = '$updated_topic', description = '$updated_description', city_id = '$updated_city_id', medium = '$updated_medium', type = '$updated_type' WHERE id = $id";
    
    
    if ($conn->query($sql) === TRUE) {
        // Redirect to profile page upon successful update
        header("Location: student_profile.php");
        exit;
    } else {
        echo "Error updating record: " . $conn->error;
    }
}

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Advertisement</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="insert_requests.css">
</head>
<body>
    <br>
    <div class="container">
        <h2>Update Advertisement</h2>
        <br>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"] . "?id=" . $id); ?>">
            <!-- Topic -->
            <div class="mb-3">
                <label for="topic" class="form-label">Advertisement's Topic:</label>
                <input type="text" class="form-control" id="topic" name="topic" value="<?php echo $topic; ?>" required>
            </div>
            <!-- User ID -->
            <div class="mb-3">
                <label for="user_id" class="form-label">S_ID:</label>
                <input type="number" class="form-control" id="user_id" name="user_id" value="<?php echo $user_id; ?>" required>
            </div>
            <!-- City ID -->
            <div class="mb-3">
                <label for="city_id" class="form-label">City ID:</label>
                <input type="number" class="form-control" id="city_id" name="city_id" value="<?php echo $city_id; ?>" required>
            </div>
             
            <!-- Medium -->
            <div class="mb-3">
                <label for="medium" class="form-label">Teaching Language Medium:</label>
                <select class="form-select" id="medium" name="medium" required>
                    <option <?php if ($medium == "Sinhala") echo "selected"; ?>>Sinhala</option>
                    <option <?php if ($medium == "English") echo "selected"; ?>>English</option>
                    <option <?php if ($medium == "Tamil") echo "selected"; ?>>Tamil</option>
                    <option <?php if ($medium == "Other") echo "selected"; ?>>Other</option>
                </select>
            </div>
            <!-- Type -->
            <div class="mb-3">
                <label class="form-label">Class Type:</label>
                &nbsp;
                 &nbsp;
                    <input class="form-check-input-inline" type="radio" name="type" id="Group" value="Group" <?php if ($type == "Group") echo "checked"; ?> required>
                     &nbsp;
                    <label class="form-check-label" for="Group">Group</label>
                     &nbsp;
                 &nbsp;
                    <input class="form-check-input-inline" type="radio" name="type" id="Individual" value="Individual" <?php if ($type == "Individual") echo "checked"; ?> required>
                     &nbsp;
                    <label class="form-check-label" for="Individual">Individual</label>
            </div>
            <!-- Description -->
            <div class="mb-3">
                <label for="description" class="form-label">Any other details:</label>
                <textarea class="form-control" id="description" name="description" required><?php echo $description; ?></textarea>
            </div>
            
            <button type="submit" class="btn btn-primary">Update</button> &nbsp;
            <a href="student_profile.php" class="btn btn-secondary">Go back</a>
        </form>
        
    </div>
</body>
</html>

