 <?php
 $servername = "127.0.0.1:3306";
 $username = "u383691782_cc";
 $password = "Sep@2024";
 $dbname = "u383691782_live";
 // Create connection
 $conn = mysqli_connect($servername,$username,$password,$dbname);
 // Check connection
 if ($conn->connect_error) {
     die("Connection failed: " . $conn->connect_error);
	 console.log("Connection failed: " . $conn->connect_error);
 }
 ?>