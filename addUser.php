<?php
require "connection.php";
?>

<?php

if (isset($_POST["registration_add"])) {
    // Extracting data from the form
	$for = $_POST['rdbFor'];
	$isa = $_POST['rdbIsa'];
	$title = $_POST['title'];
    $fname = $_POST['fname'];
	$lname = $_POST['lname'];
    $email = $_POST['email'];
    $city = $_POST['city'];
    $district = $_POST['district'];
    $phone = $_POST['phone'];
    $dob = $_POST['dob'];
    $city_id="";
    $status="pending";
    if($for=='child')
        $isa='student';
        
    $role_id="";
    $user_id="";
    
    // Get the city id from city table
    $sql="SELECT id FROM `city` WHERE city='".$city."' AND district='".$district."'";
    $result = mysqli_query($conn,$sql);
    if ($result->num_rows > 0) {
    	while($row = $result->fetch_assoc()) {
            $city_id=$row['id'];
        }
    }
    else {
        $sql="INSERT INTO `city` (`district`,`city`) Values('".$district."','".$city."')";
        mysqli_query($conn, $sql);
        //echo "INSERT INTO `city` Values('".$district."','".$city."')";
        $sql="SELECT id FROM `city` WHERE city='".$city."' AND district='".district."'";
        $result = $conn->query($sql);
            if ($result->num_rows > 0) {
            	while($row = $result->fetch_assoc()) {
                    $city_id=$row['id'];
            	}
            }
            else
                echo "Error getting city id";
    }

    // Get the role id from role table
    $sql="SELECT id FROM role WHERE role='".$isa."'"; 
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
    	while($row = $result->fetch_assoc()) {
            $role_id=$row['id'];
    	}
    }
    else
        echo "Error in getting role id";
    // Check if email already exists. if not, insert user
    $sql="SELECT email FROM users WHERE email='".$email."'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        echo "Email already registered"; 
    } 
    else{
        //Insert user to users table
        $sql = "INSERT INTO `users` (`title`,`fname`,`lname`,`email`,`city_id`,`phone`,`dob`,`for`) VALUES ('".$title."', '".$fname."', '".$lname."', '".$email."', ".$city_id.", '".$phone."', '".$dob."','".$for."')";
        mysqli_query($conn, $sql);
        
        // Get the user id from users table
        $sql="SELECT id FROM users WHERE email='".$email."'";
        $result = $conn->query($sql);
            if ($result->num_rows > 0) {
            	while($row = $result->fetch_assoc()) {
                    $user_id=$row['id'];
            	}
            } 
            else
                echo "Error in getting user id";
    }
    
    //Update user login table
    $sql = "INSERT INTO `user_login` (`user_id`,`password`,`status`,`role_id`) VALUES ('".$user_id."', '', '".$status."', '".$role_id."')";
    mysqli_query($conn, $sql);
    
    //Update ratings table with zero ratings to JOIN ratings table with users table
    	
    $sql = "INSERT INTO `ratings` (`user_id`,`ratings_received`,`given_by`,`received_on`) VALUES ('".$user_id."', '0', '-1','".date("Y-m-d H:i:s")."')";
    mysqli_query($conn, $sql);
    
    //Add teacher skills
    $selectedValues = json_decode($_POST['selectedValues'], true);
    // Insert selected options into the database
    foreach ($selectedValues as $skill) {
       // echo $skill['skill_id']."}";
        $sql = "INSERT INTO `teacher_skills` (`skill_id`,`user_id`) VALUES (".$skill['skill_id'].",".$user_id.")";
        if (!$conn->query($sql)) {
          echo "Error inserting record: " . $conn->error;
        }
    }
    
    echo "<center><h3>Your request has been successfully submitted and will be processed soon. Please check your inbox for updates.</h3><div><input type='button' onclick='returnSignin()' value='Sign In'></div>";
}

?>
<script>
    function returnSignin(){
        window.location.href ="index.php";
    }
</script>