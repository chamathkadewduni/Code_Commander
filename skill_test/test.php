<?php
require "connection.php"; 

// Sanitize and set default values for subject and difficulty
$subject = filter_input(INPUT_GET, 'subject', FILTER_SANITIZE_STRING) ?? 'Mathematics'; 
$difficulty = filter_input(INPUT_GET, 'difficulty', FILTER_SANITIZE_STRING) ?? 'Beginner'; 

/*function fetchQuestions($db, $subject, $difficulty) {
    try {
        $stmt = $db->prepare("SELECT QID AS id, Question AS question, Answer_01 AS 'A', Answer_02 AS 'B', Answer_03 AS 'C', Answer_04 AS 'D', Correct_Answer AS answer FROM Questions WHERE Subject = ':subject' AND Difficulty = ':difficulty' ORDER BY RAND() LIMIT 5");
        
        $stmt->execute(['subject' =>  $subject, 'difficulty' =>  $difficulty]);
        echo $subject;
        
        $questions = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $questions;
    } catch (PDOException $e) {
        // Handle database errors
        echo "Error: " . $e->getMessage();
        return []; // or handle the error accordingly
    }
}*/

function fetchQuestions($db, $subject, $difficulty) {
    require "connection.php";
    try {
        $query = "SELECT sk.name as subject_name,subject, QID AS id, Question AS question, Answer_01 AS '1', Answer_02 AS '2', Answer_03 AS '3', Answer_04 AS '4', Correct_Answer AS answer FROM Questions AS q JOIN skills AS sk ON q.subject=sk.id WHERE Subject = '". $subject."'  AND Difficulty = '". $difficulty."' ORDER BY RAND() LIMIT 5";
        
        $result = mysqli_query($conn, $query);
        while ($row = mysqli_fetch_assoc($result)) {
            $questions[] = $row;
        }
        return $questions;
        
    } catch (PDOException $e) {
        // Handle database errors
        echo "Error: " . $e->getMessage();
        return []; // or handle the error accordingly
    }
}



//echo "SELECT QID AS id, Question AS question, Answer_01 AS 'A', Answer_02 AS 'B', Answer_03 AS 'C', Answer_04 AS 'D', Correct_Answer AS answer FROM questions WHERE Subject = $subject AND Difficulty = $difficulty ORDER BY RAND() LIMIT 5";

// Fetch questions from the database
$questions = fetchQuestions($db, $subject, $difficulty); // Ensure $db is a valid PDO object.

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($subject); ?> Skill Test</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.18/dist/tailwind.min.css" rel="stylesheet">
    <link href="style.css" rel="stylesheet">
    <script>
        // Timer countdown script
        var countdown = 3600; // 1 hour countdown
        var timerId;

        function updateTimer() {
            var minutes = Math.floor(countdown / 60);
            var seconds = countdown % 60;
            document.getElementById('timer').textContent = minutes + ':' + (seconds < 10 ? '0' : '') + seconds;
            if (countdown === 0) {
                clearInterval(timerId);
                document.querySelector('form').submit(); // Submit the form on timeout
            }
            countdown--;
        }

        window.onload = function () {
            timerId = setInterval(updateTimer, 1000);
        }
    </script>
</head>
<body class="bg-gray-100">
    <div class="container mx-auto px-4">
        <h1 class="text-xl font-bold text-center my-6">Skill Test: <?php echo $questions[0]['subject_name']; ?></h1>
        <div class="text-center mb-4">
            Time remaining: <span id="timer"></span>
        </div>
        <form action="results.php" method="post"> <!-- Make sure the action points to the correct handler -->
            <?php foreach ($questions as $index => $question) : ?>
                <div class="mb-6">
                    <input type="text" value="<?php echo $questions[0]['subject']; ?>" name="subject" hidden/>
                    <p class="text-lg font-semibold"><?php echo ($index + 1) . '. ' . htmlspecialchars($question['question']); ?></p>
                    <?php foreach (['1', '2', '3', '4'] as $optionKey) : ?>
                        <label class="block">
                            <input type="radio" name="answer[<?php echo $question['id']; ?>]" value="<?php echo $optionKey; ?>" required>
                            <?php echo $optionKey . ': ' . htmlspecialchars($question[$optionKey]); ?>
                        </label>
                    <?php endforeach; ?>
                </div>
            <?php endforeach; ?>
            <input type="submit" value="Submit Test" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
        </form>
    </div>
</body>
</html>
