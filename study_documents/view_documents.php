<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <title>Display Tutor Materials</title>
    <!-- Bootstrap CSS link -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="view_documents.css" rel="stylesheet">
</head>
<body>

<div class="container" style="padding-top:20px">
            <?php include "../menu_materials.php" ?>
      
    <h2 class="mb-4 mt-4">Search Documents</h2> <!-- Title added -->

    <!-- Search form -->
    <form id="searchForm" class="mb-3">
        <div class="form-group">
            <input type="text" id="search" name="search" class="form-control" placeholder="Type Filename...">
        </div>
        <button type="submit" class="btn btn-primary">View Uploaded Files</button>
    </form>

    <div id="searchResults"></div> <!-- Display search results here -->

    <?php include "../menu_back.php" ?>
</div>
    <script>
      function loadPage(filename) {
        window.location.href = filename;
      }
    </script>
<!-- jQuery Library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script>
$(document).ready(function(){
    $('#searchForm').submit(function(event){
        event.preventDefault(); // Prevent the form from submitting normally

        // Get the form data
        var formData = $(this).serialize();

        // Send AJAX request
        $.ajax({
            type: 'GET',
            url: 'search.php',
            data: formData,
            success: function(response){
                $('#searchResults').html(response); // Update search results div with the response
            }
        });
    });
});
</script>

</body>
</html>
