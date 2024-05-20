<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="style.css" rel="stylesheet">
</head>
<?php
// Include database connection
include 'connection.php';
?>

<body>
    <div class="container mt-5" >
        <h5> Skill Test Report</h5>
    <?php
        // Assuming you have a valid database connection $conn
        
        // Fetch user_id, skill_id, and marks from the database
        $sql = "SELECT fname, lname, name, ROUND(AVG(total_marks), 2) AS average_marks FROM QuizResults AS qr JOIN users AS u ON u.id=qr.user_id JOIN skills AS sk ON sk.id=skill_id ORDER BY name,fname,lname";
        $result = mysqli_query($conn, $sql);
        
        // Check if there are any rows returned
        if (mysqli_num_rows($result) > 0) {
            echo '<div style="max-height: 500px; overflow-y: auto; border: 1px solid #ccc; padding: 10px;">';
            echo '<table style="width: 100%;">';
            echo '<tr><th style="width: 33.33%;">Teacher Name</th><th style="width: 33.33%;">Skill/Subject</th><th style="width: 33.33%;">Average Marks</th></tr>';
            
            // Output data of each row
            while($row = mysqli_fetch_assoc($result)) {
                echo '<tr>';
                echo '<td>' . $row['fname'] ." ".$row['fname'] . '</td>';
                echo '<td>' . $row['name'] . '</td>';
                echo '<td>' . $row['average_marks'] . '</td>';
                echo '</tr>';
            }
            
            echo '</table>';
            echo '</div>';
        } else {
            echo "No data available";
        }
        
        // Close the database connection
        mysqli_close($conn);
    ?>
    </div>
    <?php if (basename($_SERVER['PHP_SELF']) !== 'admin_profile.php') {?>
    <div class="container mt-5" >
        <a onclick="window.location.href = '../skills_management.php'" class="btn btn-secondary">Skills Management</a>
        <a onclick="window.location.href = '../admin_profile.php'" class="btn btn-secondary">Home</a>
    </div>
    <?php } ?>
    </body>