<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Results</title>
    <link rel="stylesheet" href="search.css">
    <!--link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"-->
    <!--link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet"-->
</head>
<body>

<?php
include 'connection.php';

// Search functionality
$search = isset($_GET['search']) ? $_GET['search'] : '';
$sql = "SELECT file_name,fname,lname FROM tutor_materials AS tm JOIN users AS u ON tm.uploaded_by=u.id WHERE file_name LIKE '%$search%' ORDER BY file_name";
$query = mysqli_query($conn, $sql);

if (!$query) {
    die("Error in SQL query: " . mysqli_error($conn));
}

// Display search results
echo '<table class="table">';
echo '<thead class="thead-light">';
echo '<tr>';
echo '<th scope="col">File Name</th>';
echo '<th scope="col">Uploaded By</th>';
echo '<th scope="col">Action</th>';
echo '</tr>';
echo '</thead>';
echo '<tbody>';
while ($info = mysqli_fetch_array($query)) {
    $file_name = $info['file_name'];
    $uploaded_by = $info['fname']." ".$info['lname'];
    $file_path = "uploads/" . $file_name;
    echo '<tr>';
    echo '<td>' . $file_name . '</td>';
    echo '<td>' . $uploaded_by . '</td>';
    echo '<td><a class="btn btn-success" href="' . $file_path . '" download>Download</a></td>';
    echo '</tr>';
}
echo '</tbody>';
echo '</table>';

mysqli_close($conn);
?>

</body>
</html>
