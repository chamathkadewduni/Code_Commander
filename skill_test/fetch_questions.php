<?php
// Database connection
include "../connection.php";

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$subject = $_GET['subject'];
$difficulty = $_GET['difficulty'];

$sql = "SELECT Question, Answer_01, Answer_02, Answer_03, Answer_04, Correct_Answer FROM Questions AS q JOIN skills as sk ON q.subject=sk.id WHERE subject = '$subject' AND difficulty='$difficulty'";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    echo "<table border='1'>";
    echo "<tr><th>Question</th><th>Option 1</th><th>Option 2</th><th>Option 3</th><th>Option 4</th><th> Correct Answer</th></tr>";
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr><td>" . $row['Question'] . "</td><td>" . $row['Answer_01'] . "</td><td>" . $row['Answer_02'] . "</td><td>" . $row['Answer_03'] . "</td><td>" . $row['Answer_04'] . "</td><td>" . $row['Correct_Answer'] . "</td></tr>";
    }
    echo "</table>";
} else {
    echo "No questions found for this subject.";
}

mysqli_close($conn);
?>
