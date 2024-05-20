<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Uploaded Videos</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container" style="padding-top:20px">
            <?php include "../menu_materials.php" ?>
      
    <h2 class="mb-4 mt-4">Search Videos</h2> <!-- Title added -->
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="GET">
            <div class="mb-3">
                <input type="text" class="form-control" placeholder="Search by file name" name="search">
            </div>
            <button type="submit" class="btn btn-primary">Search</button>
        </form>
        <div class="row mt-3">
            <?php
            require 'connection.php';

            $search = isset($_GET['search']) ? $_GET['search'] : '';
            $query = mysqli_query($conn, "SELECT video_name,location,fname,lname FROM tutor_video AS tm JOIN users AS u ON tm.uploaded_by=u.id WHERE `video_name` LIKE '%$search%' ORDER BY `video_name` ASC") or die(mysqli_error());
            while ($fetch = mysqli_fetch_array($query)) {
                ?>
                <div class="col-md-6">
                    <div class="card mb-3">
                        <div class="card-body">
                            <h5 class="card-title">Video Name: <?php echo $fetch['video_name']; ?>; Uploaded By: <?php echo $fetch['fname']." ".$fetch['lname']; ?></h5>
                            <video width="100%" height="240" controls>
                                <source src="<?php echo $fetch['location']; ?>">
                            </video>
                        </div>
                    </div>
                </div>
            <?php
            }
            ?>
        </div>
    </div>
    <?php include "../menu_back.php" ?>
</body>
    <script>
      function loadPage(filename) {
        window.location.href = filename;
      }
    </script>
</html>

