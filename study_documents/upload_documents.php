<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <title>Insert Tutor Materials</title>
    <!-- Bootstrap CSS link -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="upload_documents.css" rel="stylesheet">

    <style>
        .error {
            color: red;
            font-size: 16px;
            margin-top: 5px;
        }
    </style>
</head>
<body>
<div class="container" style="padding-top:20px">
    <?php include "../menu_materials.php" ?>
    <h2 class="mb-4 mt-4">Upload Documents</h2> <!-- Title added -->
    <div class="row justify-content-center">
        <div class="col-md-6">
            <form action="" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="file">Choose Your Upload File</label><br>
                    <input id="file" type="file" name="file" class="form-control-file" required><br>
                    <?php
                    session_start();
                    include 'connection.php';

                    if (isset($_POST['submit'])) {
                        $user_id = $_SESSION['user_id'];
                        $file_name = $_FILES['file']['name'];
                        $file_type = $_FILES['file']['type'];
                        $file_size = $_FILES['file']['size'];
                        $file_tem_loc = $_FILES['file']['tmp_name'];
                        $file_store = "uploads/" . $file_name;

                        // Check if file exists
                        if (file_exists($file_store)) {
                            $file_error = "File already exists. Please choose a different file.";
                        }
                        // Check file type (Word, PDF, JPEG, PNG)
                        elseif (!in_array($file_type, ['application/pdf', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document', 'image/jpeg', 'image/png'])) {
                            $file_error = "Only PDF, Word (docx), JPEG, and PNG files are allowed.";
                        }
                        // Check file size (in this example, limit to 5MB)
                        elseif ($file_size > 5 * 1024 * 1024) {
                            $file_error = "File size should not exceed 5MB.";
                        } else {
                            // Move uploaded file
                            move_uploaded_file($file_tem_loc, $file_store);

                            // Insert file details into database
                            $sql = "INSERT INTO tutor_materials (file_name, file_type, file_size, uploaded_by) VALUES ('$file_name', '$file_type', '$file_size','$user_id')";
                            $query = mysqli_query($conn, $sql);

                            if ($query) {
                                $file_success = "File uploaded successfully!";
                            } else {
                                $file_error = "Error uploading file to the database. Please try again later.";
                            }
                        }
                    }

                    // Check if there's an error message
                    if (isset($file_error)) {
                        echo "<span class='error'>$file_error</span><br><br>";
                    }
                    // Check if there's a success message
                    if (isset($file_success)) {
                        echo "<span class='text-success'>$file_success</span><br><br>";
                    }
                    ?>
                </div>
                <div class="form-group">
                    <input type="submit" name="submit" value="Upload" class="btn btn-primary">
                </div>
            </form>
        </div>
    </div>
    <?php include "../menu_back.php" ?>
</div>
<script>
    function loadPage(filename) {
        window.location.href = filename;
    }
</script>
</body>
</html>
