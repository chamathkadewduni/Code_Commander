<?php
require "connection.php";

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
    console.log('fname');
    // Get the city id from city table
   // $sql="SELECT id FROM `city` WHERE city='".$city."' AND district='".$district."'";
    //$result = mysqli_query($conn,$sql);
    //$result = $conn->query($sql);
/*       if ($result->num_rows > 0) {
           console.log('2');
        	while($row = $result->fetch_assoc()) {
                $city_id=$row;
                console.log('$city_id'.$row);
        	
        } 
       else {console.log('1');}
            $sql="INSERT INTO `city` Values('".$district."','".$city."')";
            mysqli_query($conn, $sql);
            
            $sql="SELECT id FROM `city` WHERE city='".$city."' AND district='".district."'";
            $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                	while($row = $result->fetch_assoc()) {
                        $city_id=$row;
                        console.log('$city_id'.$row);
                	}
                }
        }
        
    // Get the role id from role table
    $sql="SELECT id FROM role WHERE name='".$isa."'";
    $result = $conn->query($sql);
        if ($result->num_rows > 0) {
        	while($row = $result->fetch_assoc()) {
                $role_id=$row;
                console.log('$role_id'.$row);
        	}
        } 

    // Check if email already exists. if not, insert user
    $sql="SELECT email FROM users WHERE email='".$email."'";
    $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            alert("Email already registered");
        } 
        else{
            $sql = "INSERT INTO `users` VALUES ('".$title."', '".$fname."', '".$lname."', '".$email."', ".$city_id.", '".$phone."', ".$dob.",'".$for."')";
            mysqli_query($conn, $sql);
            
            // Get the user id from users table
            $sql="SELECT id FROM users WHERE email='".$email."'";
            $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                	while($row = $result->fetch_assoc()) {
                        $user_id=$row;
                        console.log('$user_id'.$row);
                	}
                } 
        }

    //Update user login table
    $temp_pass = getName(12);
    console.log(temp_pass);
    $sql = "INSERT INTO `user_login` VALUES ('".$user_id."', '".$temp_pass."', '".$status."', '".$role_id."')";
    mysqli_query($conn, $sql);
            console.log('added success');
    

    function getName($n) {
    	$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    	$randomString = '';
    
    	for ($i = 0; $i < $n; $i++) {
    		$index = rand(0, strlen($characters) - 1);
    		$randomString .= $characters[$index];
    	}
    
    	return $randomString;
    }
    
*/
    /*if ($result) {
        header("Location: tutor_reg1.php"); 
        exit();
    } else {
        echo "Failed: " . mysqli_error($conn);
    }*/
}
?>