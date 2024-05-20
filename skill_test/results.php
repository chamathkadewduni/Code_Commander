<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <title>Quiz Results</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 80%;
            margin: auto;
            overflow: hidden;
        }
        .quiz-results {
            background: #fff;
            padding: 20px;
            margin-top: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .quiz-results h2 {
            text-align: center;
            color: #333;
        }
        .question {
            margin-bottom: 20px;
        }
        .question h3 {
            color: #333;
        }
        .answers {
            margin: 10px 0;
        }
        .answers p {
            margin: 5px 0;
            color: #555;
        }
        .user-answer {
            font-weight: bold;
            color: blue;
        }
        
        .correct-answer {
            font-weight: bold;
            color: green;
        }
        .total-marks {
            text-align: center;
            font-size: 1.2em;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="quiz-results">
            <h2>Quiz Results</h2>
            <?php
            require "connection.php"; 
            session_start();
            $user_id=$_SESSION['user_id'];
            
            	
            // Sanitize and set default values for subject and difficulty
            $subject = $_POST["subject"];
            $difficulty = filter_input(INPUT_GET, 'difficulty', FILTER_SANITIZE_STRING);// ?? 'Beginner'; 

            if (isset($_POST['answer'])) {
                $answer_list = $_POST['answer'];
                $total_quiz = count($answer_list);  // total number of quiz 
                $marks = 0;

                foreach ($answer_list as $key => $value) {
                    // Prepare the SQL statement
                    $sql = $conn->prepare("SELECT Question, Answer_01, Answer_02, Answer_03, Answer_04, Correct_Answer FROM Questions WHERE QID = ?");
                    $sql->bind_param("i", $key);
                    $sql->execute();
                    $result = $sql->get_result();
                    $row = $result->fetch_assoc();

                    if ($row) {
                        $question = $row['Question'];
                        $answer_01 = $row['Answer_01'];
                        $answer_02 = $row['Answer_02'];
                        $answer_03 = $row['Answer_03'];
                        $answer_04 = $row['Answer_04'];
                        $correct_answer = $row['Correct_Answer'];

                        // Output the question and answers
                        echo "<div class='question'>";
                        //echo "Question ID: $key";
                        echo "<h3>$question</h3>";
                        echo "<div class='answers'>";
                        echo "<p>01) $answer_01</p>";
                        echo "<p>02) $answer_02</p>";
                        echo "<p>03) $answer_03</p>";
                        echo "<p>04) $answer_04</p>";
                        echo "</div>";
                        echo "<p class='user-answer'>Your Answer: $value</p>";
                        echo "<p class='correct-answer'>Correct Answer: $correct_answer</p>";
                        echo "</div>";

                        // Check if the answer is correct
                        if ($value == $correct_answer) {
                            $marks++;
                        }
                        
                       /* // Insert into QuizResults
                        $insert_sql = $conn->prepare("INSERT INTO QuizResults (QID, Answer, Correct_Answer) VALUES (?, ?, ?)");
                        $insert_sql->bind_param("iss", $key, $value, $correct_answer);
                        $insert_sql->execute();
                        $insert_sql->close();*/
                        
                    } else {
                        echo "<p>No result found for Question ID: $key</p>";
                    }

                    $sql->close();
                }
                $total_marks = ($marks / 5) * 100;

                echo "<div class='total-marks'>";
                echo "Total Marks: $total_marks / 100";
                echo "</div>";

                //If teacher scores more than 0, add that as a skill to teacher_skill table if it is not already added as a skill
                if($total_marks>0){
                    $insert_sql = $conn->prepare("INSERT INTO teacher_skills (skill_id, user_id) SELECT ?, ? FROM DUAL WHERE NOT EXISTS (SELECT 1 FROM teacher_skills WHERE skill_id = ? AND user_id = ?)");
                    $insert_sql->execute([$subject, $user_id, $subject, $user_id]);

                }
               
               //Add the results to QuizResults table
                
                $insert_sql = $conn->prepare("INSERT INTO QuizResults (user_id, skill_id, total_marks) SELECT ?, ?, ? FROM DUAL WHERE NOT EXISTS (SELECT 1 FROM QuizResults WHERE user_id = ? AND skill_id = ? AND total_marks = ?)");
                $insert_sql->execute([$user_id, $subject, $total_marks,$user_id, $subject, $total_marks]);
                /*
                    $insert_sql = $conn->prepare("INSERT INTO QuizResults (user_id, skill_id, total_marks) VALUES(?,?,?)");
                    $insert_sql->execute([$user_id, $subject, $total_marks]);*/
            }
            ?>
            <div class="answers-link">
                <a href="Answers.php"></a>
            </div>
            <div class="container mt-5" >
                <a onclick="window.location.href = '../my_skills.php'" class="btn btn-secondary">My Skills</a>
                <a onclick="window.location.href = '../teacher_profile.php'" class="btn btn-secondary">My Profile</a>
            </div>
        </div>
    </div>
    
</body>
</html>
