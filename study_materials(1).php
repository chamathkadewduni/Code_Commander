<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-o+RDsa0aLu++PJvFqy8fFf4jGg0F73gHYx8HFRmzV+0i4rT/E3U3JpZISkd/Prur" crossorigin="anonymous">
 <!-- Link to Bootstrap CSS via CDN -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Link to Bootstrap Icons CSS via CDN -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
  
  <body>
      <div class="container" style="padding-top:20px">
            <a href="#" class="btn btn-warning" onclick="loadPage('study_documents/upload_documents.php')">➕📓 Upload Documents</a>
            <a href="#" class="btn btn-warning" onclick="loadPage('study_video/upload_video.php')">➕🎬 Upload Video</a>
            <a href="#" class="btn btn-warning" onclick="loadPage('study_documents/view_documents.php')">🔍📓 Search Documents</a>
            <a href="#" class="btn btn-warning" onclick="loadPage('study_video/view_video.php')">🔍🎬 Search Video</a>

    <div id="uploadContainer"></div>

            
        <div class="container mt-5" >
            <a onclick="window.location.href = 'teacher_profile.php'" class="btn btn-secondary">Go Back</a>
        </div>
      </div>
      
      <script>
      function loadPage(filename) {
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
          if (this.readyState == 4 && this.status == 200) {
            document.getElementById("uploadContainer").innerHTML = this.responseText;
          }
        };
        xhttp.open("GET", filename, true);
        xhttp.send();
      }
    </script>
  </body>
