<?php
require "connection.php";

$tname=$_POST['tname'];
$tnameType=$_POST['tnameType'];

$subject=$_POST['subject'];
$grade=$_POST['grade'];
$city=$_POST['city'];
$district=$_POST['district'];
$rating=$_POST['rating'];

$additionalFilters = "";
$ratingFilter="";

if($subject != -1)
    $additionalFilters .= " AND ta.subject='".$subject."'";
if($grade != -1)
    $additionalFilters .= " AND ta.grade='".$grade."'";
if($city != -1)
    $additionalFilters .= " AND ct.city='".$city."'";
if($district != -1)
    $additionalFilters .= " AND ct.district='".$district."'";
if($rating != -1)
    $ratingFilter = "HAVING ROUND(AVG(NULLIF(rt.ratings_received,0)),1) >= ".$rating."";

$sql="SELECT u.id,title,fname,lname,ta.subject,ta.grade,ct.city,ct.district,ROUND(AVG(NULLIF(rt.ratings_received,0)),1) as ratings FROM users u
JOIN tutor_ad AS ta ON ta.user_id=u.id
JOIN city AS ct ON ta.city_id=ct.id
JOIN ratings AS rt ON rt.user_id=ta.user_id
JOIN user_login AS ul ON ul.user_id=u.id
WHERE ".$tnameType."='".$tname."' AND ul.status='active' ".$additionalFilters."
GROUP BY u.id, u.title, u.fname, u.lname, ta.subject, ta.grade, ct.city, ct.district ".$ratingFilter;
$result = $conn->query($sql);

$rows = array(); // Array to hold all rows

if ($result->num_rows > 0) {
    // Output the temporary password
    /*$row = $result->fetch_assoc();
    $json_row = json_encode($row);
    echo $json_row;*/
    while ($row = $result->fetch_assoc()) {
        // Append each row to the $rows array
        $rows[] = $row;
    }
    // Encode the array of rows as JSON and echo it
    echo json_encode($rows);
} else {
    // If no matching email found, output an error message
    echo "msg:No records found for the provided email.";
}

$conn->close();
?>