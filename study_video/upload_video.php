<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1.0"/>
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
		<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
		<!--link href="upload_video.css" rel="stylesheet"-->
        

    </head>
<body>

	    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<div class="container" style="padding-top:20px">
            <?php include "../menu_materials.php" ?>
    
    <h2 class="mb-4 mt-4">Upload Videos</h2> 
    <!-- <div class="col-md-3"></div>
    <div class="col-md-6 well">
        Title added
        <h3 class="text-primary">Tutor Video Upload</h3> -->
        <hr style="border-top:1px dotted #ccc;"/>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#form_modal"><span class="glyphicon glyphicon-plus"></span> Add Video</button>
        <br /><br />
        <hr style="border-top:3px solid #ccc;"/>
        <?php
            require 'connection.php';
 
            $query = mysqli_query($conn, "SELECT * FROM `tutor_video` ORDER BY `video_name` ASC") or die(mysqli_error());
            while($fetch = mysqli_fetch_array($query)){
        ?>
        <div class="row mt-3">
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
        </div>
       <!-- <div class="col-md-12">
            <div class="col-md-4" style="word-wrap:break-word;">
                <br />
                <h5 class="text-primary">Video Name: <?php echo $fetch['video_name']?></h5>
            </div>
            <div class="col-md-8">
                <video width="100%" height="240" controls>
                    <source src="<?php echo $fetch['location']?>">
                </video>
            </div>
            <br style="clear:both;"/>
            <hr style="border-top:1px groovy #000;"/>
        </div> -->
        <?php
            }
        ?>
    </div>
    <div class="modal fade" id="form_modal" aria-hidden="true">
        <div class="modal-dialog">
            <form action="save_video.php" method="POST" enctype="multipart/form-data">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="col-md-3"></div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Video File</label>
                                <input type="file" name="tutor_video" class="form-control-file"/>
                            </div>
							<!--<div class="form-group">
                            <label>Person Name</label>
                            <input type="text" name="person_name" class="form-control" required>
                        </div>-->
                        </div>
                    </div>
                    <div style="clear:both;"></div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Close</button>
                        <button name="save" class="btn btn-primary"><span class="glyphicon glyphicon-save"></span> Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <?php include "../menu_back.php" ?>
<!-- </div> -->
    <script>
      function loadPage(filename) {
        window.location.href = filename;
      }
    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>