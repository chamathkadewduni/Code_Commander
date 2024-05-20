<?php
//Database connection
require("connection.php");

// Retrieve form data
$subject = $_POST['subject'];
$difficulty = $_POST['difficulty'];
$questionid = $_POST['questionid'];
$question = $_POST['question'];
$answer1 = $_POST['answer1'];
$answer2 = $_POST['answer2'];
$answer3 = $_POST['answer3'];
$answer4 = $_POST['answer4'];
$correct_answer = $_POST['correct_answer'];

//echo $subject." | ".$difficulty." | ".$questionid." | ".$question." | ".$answer1." | ".$answer2." | ".$answer3." | ".$answer4." | ".$correct_answer;
// Prepare SQL statement
$stmt = $conn->prepare("INSERT INTO Questions (Subject, Difficulty, Question, Answer_01, Answer_02, Answer_03, Answer_04, Correct_Answer) 
VALUES (?, ?, ?, ?, ?, ?, ?, ?)");

//$stmt = $conn->prepare($sql);

// Bind parameters
$stmt->bind_param("issssssi", $subject, $difficulty, $question, $answer1, $answer2, $answer3, $answer4, $correct_answer);


// Execute statement
if ($stmt->execute()) {
    header("Location: add_questions.php");
} else {
    echo "Error: " . $stmt->error;
}

// Close statement
$stmt->close();

// Close connection
$conn->close();
?>
