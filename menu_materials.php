            <?php 
                session_start();
                $role = $_SESSION['role'];
            ?>
            <?php if ($role == 'teacher'): ?>
            <a href="#" class="btn btn-warning" onclick="loadPage('../study_documents/upload_documents.php')">➕📓 Upload Documents</a>
            <a href="#" class="btn btn-warning" onclick="loadPage('../study_video/upload_video.php')">➕🎬 Upload Video</a>
            <?php endif; ?>
            <a href="#" class="btn btn-warning" onclick="loadPage('../study_documents/view_documents.php')">🔍📓 Search Documents</a>
            <a href="#" class="btn btn-warning" onclick="loadPage('../study_video/view_video.php')">🔍🎬 Search Video</a>