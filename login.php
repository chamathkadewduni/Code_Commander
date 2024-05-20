<?php
require "connection.php";

header("Cache-Control: no-cache, no-store, must-revalidate");
header("Pragma: no-cache");
header("Expires: 0");
?>

<?php
session_start();
    // Extracting data from the form
	$username = $_POST['username'];
	$password = $_POST['password'];
	$role="";
	$fname="";
	$isLoggedin=false;
	$failedReason = "";
	$user_id="";

	// Get user login details and validate login
    $sql="SELECT ul.user_id,u.fname,ul.password,r.role FROM `user_login` as ul 
            JOIN `users` as u ON u.id=ul.user_id 
            JOIN `role` as r ON r.id=ul.role_id
            WHERE u.email='".$username."' AND ul.status='active'";
    $result = mysqli_query($conn,$sql);
    if ($result->num_rows > 0) { 
        while($row = $result->fetch_assoc()) {
            if($row['password']==$password){
        	    $isLoggedin=true;
        	    $fname=$row['fname'];
        	    $role=$row['role'];
        	    $user_id=$row['user_id'];
        	    //echo $role." ".$isLoggedin;
            }
        	else 
        	    $failedReason = "incorrect password";
        }
    }
    else
        $failedReason = "incorrect username or password";
        
    if($isLoggedin){
        //session_start();
	    $_SESSION['user_id'] = $user_id;
	    $_SESSION['fname']=$fname;
	    $_SESSION['role']=$role;
        if($role=='teacher')
            header("Location: teacher_profile.php");
        else if($role=='student')
            header("Location: student_profile.php");
        else if($role=='admin')
            header("Location: admin_profile.php");
    }
    else 
        echo "<center><h3>Login failed because of ".$failedReason.". Please try again.</h3><div><input type='button' onclick='returnSignin()' value='Sign In'></div>";
?>
<script>
    function returnSignin(){
        window.location.href ="index.php";
    }
</script>