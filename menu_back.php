<?php 
    session_start();
    $role = $_SESSION['role'];
?>

<div class="container mt-5" >
    <?php if ($role == 'teacher'): ?>
        <a onclick="window.location.href = '../teacher_profile.php'" class="btn btn-secondary">Go Back</a>
    <?php endif; ?>
    <?php if ($role == 'student'): ?>
        <a onclick="window.location.href = '../student_profile.php'" class="btn btn-secondary">Go Back</a>
    <?php endif; ?>
    <?php if ($role == 'admin'): ?>
        <a onclick="window.location.href = '../admin_profile.php'" class="btn btn-secondary">Go Back</a>
    <?php endif; ?>
</div>