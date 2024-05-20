<?php
    date_default_timezone_set('Asia/Manila');
    require_once 'connection.php';
 
 session_start();
$user_id = $_SESSION['user_id'];

    if(ISSET($_POST['save'])){
        // Get person's name from the form
        //$person_name = $_POST['person_name']; // Assuming you have a form field with name "person_name"
        
        // Get uploaded file information
        $file_name = $_FILES['tutor_video']['name'];
        // Extract the file name without the extension
        $file_name_only = pathinfo($file_name, PATHINFO_FILENAME);
        $file_temp = $_FILES['tutor_video']['tmp_name'];
        $file_size = $_FILES['tutor_video']['size'];
 
        if($file_size < 5000000000){
            $file = explode('.', $file_name);
            $end = end($file);
            $allowed_ext = array('avi', 'flv', 'wmv', 'mov', 'mp4');
            if(in_array($end, $allowed_ext)){
                // Construct file location using person's name
                $location = 'tutor_video/' . $file_name_only . '.' . $end;
                if(move_uploaded_file($file_temp, $location)){
                    // Insert into database
                    mysqli_query($conn, "INSERT INTO `tutor_video` VALUES('', '$file_name_only', '$location', '$user_id')") or die(mysqli_error());
                    echo "<script>alert('Video Uploaded')</script>";
                    echo "<script>window.location = 'view_video.php'</script>";
                }
            }else{
                echo "<script>alert('Wrong video format')</script>";
                echo "<script>window.location = 'view_video.php'</script>";
            }
        }else{
            echo "<script>alert('File too large to upload')</script>";
            echo "<script>window.location = 'view_video.php'</script>";
        }
    }
?>
