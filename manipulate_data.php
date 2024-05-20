<?php
function getData($sql){
	require "connection.php";
	$result = $conn->query($sql);
	if (!mysqli_query($conn,$sql)) {
		return "false";//console.log( "Error: " . $sql . "<br>" . $conn->error);
	}
	else{
		if ($result->num_rows > 0) {
			$results= array();
		// output data of each row
			while($row = $result->fetch_assoc()) {
				$results[] =$row;
			}
			return $results;
		} 	
		else
			return "false";
	}
	 mysqli_close($conn);
}
?>