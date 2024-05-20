<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-o+RDsa0aLu++PJvFqy8fFf4jGg0F73gHYx8HFRmzV+0i4rT/E3U3JpZISkd/Prur" crossorigin="anonymous">
 <!-- Link to Bootstrap CSS via CDN -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Link to Bootstrap Icons CSS via CDN -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
  
  <body>
          

            

        
      <div class="container" style="padding-top:20px">
        <div class="container mt-5" >
            <?php if ($role == 'teacher'): ?>
            <a onclick="window.location.href = 'teacher_profile.php'" class="btn btn-secondary">Go Back</a>
            <?php endif; ?>
            <?php if ($role == 'student'): ?>
            <a onclick="window.location.href = 'student_profile.php'" class="btn btn-secondary">Go Back</a>
            <?php endif; ?>
            <?php if ($role == 'admin'): ?>
            <a onclick="window.location.href = 'admin_profile.php'" class="btn btn-secondary">Go Back</a>
            <?php endif; ?>
        </div>
            <?php 
                session_start();
                $role = $_SESSION['role'];
            ?>
            <?php if ($role == 'teacher'): ?>
            <a href="#" class="btn btn-warning" onclick="loadPage('study_documents/upload_documents.php')">➕📓 Upload Documents</a>
            <a href="#" class="btn btn-warning" onclick="loadPage('study_video/upload_video.php')">➕🎬 Upload Video</a>
            <?php endif; ?>
            <a href="#" class="btn btn-warning" onclick="loadPage('study_documents/view_documents.php')">🔍📓 Search Documents</a>
            <a href="#" class="btn btn-warning" onclick="loadPage('study_video/view_video.php')">🔍🎬 Search Video</a>


      </div>
      
      <script>
      function loadPage(filename) {
        window.location.href = filename;
      }
    </script>
  </body>
