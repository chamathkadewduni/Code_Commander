<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<?php
// Include database connection
include 'connection.php';
?>
   
<body>
    <div class="container mt-5" >
    <a href="skill_test/add_skills.php" class="btn btn-warning"> Add Skills</a>
    <a href="skill_test/add_questions.php" class="btn btn-warning"> Add Questions</a>
    <a href="skill_test/view_results.php" class="btn btn-warning"> Skill Test Report</a>
    </div>
    <div class="container mt-5" >
        <a onclick="window.location.href = 'admin_profile.php'" class="btn btn-secondary">Go Back</a>
    </div>
    
    </body>