<head>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <style>
        .horizontal-list {
            display: flex;
            flex-wrap: wrap;
            list-style: none;
            padding-left: 0;
        }
        .horizontal-list-item {
            margin-right: 10px;
            margin-bottom: 10px;
        }
        </style>
</head>
<body>
    <?php
    include "../connection.php";
    
    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
    
    // Fetching skills
    $sql = "SELECT * FROM skills ORDER BY name";
    $result = mysqli_query($conn, $sql);
    
    // Adding new skill
    if(isset($_POST['add_skill'])) {
        $new_skill = $_POST['new_skill'];
        $insert_sql = "INSERT INTO skills (name) VALUES ('$new_skill')";
        if(mysqli_query($conn, $insert_sql)) {
            header("Location: add_skills.php");
            exit();
        } else {
            echo "Error: " . $insert_sql . "<br>" . mysqli_error($conn);
        }
    }
    
    ?>
    
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Skills</title>
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    </head>
    <body>
    
    <div class="container mt-5">
        <h2>List of Skills</h2>
        <ul class="horizontal-list">
            <?php
            // Displaying skills
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo '<li class="horizontal-list-item">' . $row['name'] . '</li>';
                }
            } else {
                echo "<li class='list-group-item'>No skills found.</li>";
            }
            ?>
        </ul>
    
        <h2 class="mt-5">Add New Skill</h2>
        <form method="post">
            <div class="form-group">
                <label for="new_skill">Skill Name:</label>
                <input type="text" class="form-control" id="new_skill" name="new_skill" required>
            </div>
            <button type="submit" class="btn btn-primary" name="add_skill">Add Skill</button>
        </form>
    </div>
    
    <!-- Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    </body>
    </html>
    
    <?php
    // Close connection
    mysqli_close($conn);
    ?>

    </body><div class="container mt-5" >
        <a onclick="window.location.href = '../skills_management.php'" class="btn btn-secondary">Go Back</a>
    </div>
</body>