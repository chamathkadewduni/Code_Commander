<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <title>Display Tutor Materials</title>
    <!-- Bootstrap CSS link -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
    <h2 class="mb-4">Search Documents</h2> <!-- Title added -->

    <!-- Search form -->
    <form method="GET" action="" class="mb-3">
        <div class="form-group">
            <input type="text" name="search" class="form-control" placeholder="Type Filename...">
        </div>
        <button type="submit" class="btn btn-primary">Search</button>
    </form>

    <?php
    include 'connection.php';

    // Search functionality
    $search = isset($_GET['search']) ? $_GET['search'] : '';
    $sql = "SELECT * FROM tutor_materials WHERE file_name LIKE '%$search%'";
    $query = mysqli_query($conn, $sql);

    if (!$query) {
        die("Error in SQL query: " . mysqli_error($conn));
    }

    // Delete functionality
    if (isset($_GET['delete'])) {
        $file_to_delete = $_GET['delete'];
        $delete_sql = "DELETE FROM tutor_materials WHERE file_name = '$file_to_delete'";
        $delete_query = mysqli_query($conn, $delete_sql);

        if ($delete_query) {
            $file_path = "uploads/" . $file_to_delete;
            if (file_exists($file_path)) {
                unlink($file_path); // Delete file from the server
            }
        } else {
            die("Error in SQL delete query: " . mysqli_error($conn));
        }
        // Refresh the page to update the file list
        header("Location: " . $_SERVER['PHP_SELF']);
        exit;
    }
    ?>
    <table class="table">
        <thead class="thead-light">
            <tr>
                <th scope="col">File Name</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            while ($info = mysqli_fetch_array($query)) {
                $file_name = $info['file_name'];
                $file_path = "uploads/" . $file_name;
                ?>
                <tr>
                    <td><?php echo $file_name; ?></td>
                    <td>
                        <a class="btn btn-success" href="<?php echo $file_path; ?>" download>Download</a>
                        <a class="btn btn-danger" href="?delete=<?php echo $file_name; ?>" onclick="return confirm('Are you sure you want to delete this file?');">Delete</a>
                    </td>
                </tr>
            <?php
            }
            ?>
        </tbody>
    </table>
</div>

<?php mysqli_close($conn); ?>
</body>
</html>
