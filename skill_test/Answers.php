<?php
require "connection.php"; 

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['answer'])) {
    $answer_list = $_POST['answer'];
    $total_quiz = count($answer_list);  // total number of quiz 
    $marks = 0;

    /*foreach ($answer_list as $key => $value) {
        // Prepare the SQL statement
        $sql = $conn->prepare("SELECT Question, Answer_01, Answer_02, Answer_03, Answer_04, Correct_Answer FROM Questions WHERE QID = ?");
        $sql->bind_param("i", $key);
        $sql->execute();
        $result = $sql->get_result();
        $row = $result->fetch_assoc();

        if ($row) {
            $correct_answer = $row['Correct_Answer'];

            // Check if the answer is correct
            if ($value == $correct_answer) {
                $marks++;
            }
        }

        $sql->close();
    }

    $total_marks = ($marks / $total_quiz) * 100;*/

    // Insert total marks into QuizResults
    $insert_sql = $conn->prepare("INSERT INTO QuizResults (total_marks) VALUES (?)");
    $insert_sql->bind_param("d", $total_marks);
    $insert_sql->execute();
    $insert_sql->close();
    
    echo $total_marks;
    
    // Redirect to results page with total marks
    header("Location: Results.php?total_marks=$total_marks");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz Submission</title>
</head>
<body>
    <div class="container">
        <h2>Submitting your quiz...</h2>
        <p>If you are not redirected automatically, <a href="Results.php?total_marks=<?php echo $total_marks; ?>">click here</a>.</p>
    </div>
</body>
</html>
