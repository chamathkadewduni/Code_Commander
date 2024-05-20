<?php 
//Database connection
require("connection.php");


// Check if advertisement ID is provided in the URL
if (isset($_GET['id'])) {
    // Sanitize the ID to prevent SQL injection
    $id = mysqli_real_escape_string($conn, $_GET['id']);

    // Fetch the advertisement data from the database based on ID
    $sql = "SELECT ta.id,topic,city,district,rateType,rate,medium,type,description,status FROM tutor_ad ta JOIN city c ON c.id=ta.city_id WHERE ta.id = '$id'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) == 1) {
        // request found, fetch its data
        $request = mysqli_fetch_assoc($result);
        $location= $request['city'].", ".$request['district'];
    } else {
        // advertisement not found
        echo "Advertisement with ID $id not found.";
        exit; // Stop further execution
    }
} else {
    // No Advertisement ID provided in the URL
    echo "No advertisement ID provided.";
    exit; // Stop further execution
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>ReachingTeaching.com</title>
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

</head>
<body>
     <br>
    <div class="container">
    

    <h2>View Posted Advertiesement Details</h2>

    <br><br>    

    <form action="teacher_profile.php" class="form-group">

        <!-- ID -->
        <label class="form-control">Advertisement No:</label>
        <input class="form-control" value="<?php echo htmlspecialchars($request['id']); ?>" disabled />
        <br>

        <!-- Topic -->
        <label class="form-control">Advertisement's Topic: </label>
        <input class="form-control" value="<?php echo htmlspecialchars($request['topic']); ?>" disabled />
        <br>

        <!-- Teaching Subject -->
        <!--<label class="form-control">Teaching Subject:</label>-->
        <!--<input class="form-control" value="<?php echo htmlspecialchars($request['']); ?>" disabled />-->
        <!--<br>-->

        <!-- Focused Grade -->
        <!--<label class="form-control">Focused Grade:</label>-->
        <!--<input class="form-control" value="<?php echo htmlspecialchars($request['a_grade']); ?>" disabled />-->
        <!--<br>-->

        <!-- Class conducting method -->
        <!--<label class="form-control">Class conducting method:</label>-->
        <!--<input class="form-control" value="<?php echo htmlspecialchars($request['a_method']); ?>" disabled />-->
        <!--<br>-->

        <!-- City ID -->
        <label class="form-control">Class Conducting Location:</label>
        <input class="form-control" value="<?php echo htmlspecialchars($location); ?>" disabled />
        <br>

        <!-- Rate Type: -->
        <label class="form-control">Rate Type:</label>
        <input class="form-control" value="<?php echo htmlspecialchars($request['rateType']); ?>" disabled />
        <br>

        <!-- Rate (Rs.): -->
        <label class="form-control">Rate (Rs.):</label>
        <input class="form-control" value="<?php echo htmlspecialchars($request['rate']); ?>" disabled />
        <br>


        <!-- Language Medium -->
        <label class="form-control">Teaching Language Medium:</label>
        <input class="form-control" value="<?php echo htmlspecialchars($request['medium']); ?>" disabled />
        <br>

         <!-- Class Type -->
        <label class="form-control">Class Type:</label>
        <input class="form-control" value="<?php echo htmlspecialchars($request['type']); ?>" disabled />
        <br>

         <!-- Any other details: -->
        <label class="form-control">Any other details:</label>
        <textarea class="form-control"  disabled /><?php echo htmlspecialchars($request['description']); ?></textarea>
        <br>
        
          <!-- Status -->
        <label class="form-control">Status:</label>
        <input class="form-control" value="<?php echo htmlspecialchars($request['status']); ?>" disabled />
        <br>

        <!-- Posted Date -->
        <!--<label class="form-control">Posted Date:</label>-->
        <!--<input class="form-control" value="<?php echo htmlspecialchars($request['a_posted_date']); ?>" disabled />-->
        <!--<br>-->

        <button type="submit" class="btn btn-secondary">Go back</button>
    </form> 

    </div>
    
</body>
</html>
