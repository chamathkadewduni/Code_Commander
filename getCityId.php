<?php
/*function getCityId($city,$district){ 
    include "connection.php";
// Get the city id from city table
    $sql="SELECT id FROM `city` WHERE city='".$city."' AND district='".$district."'"; 
    $result = mysqli_query($conn,$sql);
    if ($result->num_rows > 0) {
    	while($row = $result->fetch_assoc()) {
            return $row['id'];
        }
    }
    else {
        $sql="INSERT INTO `city` (`district`,`city`) Values('".$district."','".$city."')";
        mysqli_query($conn, $sql);
        getCityId($city,$district);
    }
}*/
?>
<?php

function getCityId($city, $district) {
    include "connection.php";

    // Get the city id from the city table
    $sql = "SELECT id FROM `city` WHERE city='$city' AND district='$district'";
    $result = mysqli_query($conn, $sql);

    if ($result->num_rows > 0) {
        // City exists, return its ID
        $row = $result->fetch_assoc();
        return $row['id'];
    } else {
        // City doesn't exist, insert it
        $sql = "INSERT INTO `city` (`district`, `city`) VALUES ('$district', '$city')";
        if (mysqli_query($conn, $sql)) {
            // Insert successful, return the ID of the inserted city
            return mysqli_insert_id($conn);
        } else {
            // Insert failed, handle the error (e.g., log it, return an error code)
            return -1;
        }
    }
}


?>