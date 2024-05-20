<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.0.4/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="style.css" rel="stylesheet">
    
</head>
<?php
// Include database connection
include 'connection.php';

// Fetching skills
$sql = "SELECT id,name FROM skills ORDER BY name";
$result = mysqli_query($conn, $sql);

// Generating <option> tags
$options = "";
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $options .= '<option value="' . $row['id'] . '">' . $row['name'] . '</option>';
    }
} else {
    $options = '<option value="" disabled>No skills found</option>';
}

// Close connection
mysqli_close($conn);
?>
<body class="bg-gray-200">
    <div class="container mx-auto px-4">
       
        <!-- Form to add questions -->
        <div class="max-w-2xl mx-auto p-5">
            <form action="add_questions_db.php" method="POST" onsubmit="return validateForm()">
                <div class="mb-4">
                    <h3>Add Questions</h3>
                    <label for="subject" class="block text-sm font-medium text-gray-700">Subject</label>
                    <select id="subject" name="subject" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                        <option value="-1">---Select a Subject---</option>
                        <?php echo $options; ?>
                    </select>
                </div>
                <div class="mb-4">
                    <label for="difficulty" class="block text-sm font-medium text-gray-700">Select Difficulty:</label>
                    <select id="difficulty" name="difficulty" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        <option>Beginner</option>
                        <option>Intermediate</option>
                        <option>Advanced</option>
                    </select>
                </div>
                <!-- <div class="mb-4">
                    <label for="questionid" class="block text-sm font-medium text-gray-700">Question ID</label>
                    <input type="text" id="questionid" name="questionid" required class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                </div> -->
                <div class="mb-4">
                    <label for="question" class="block text-sm font-medium text-gray-700">Question</label>
                    <input type="text" id="question" name="question" required class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">Answers</label>
                    <div class="mt-1">
                        <input type="text" name="answer1" required placeholder="Answer A" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        <input type="text" name="answer2" required placeholder="Answer B" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        <input type="text" name="answer3" required placeholder="Answer C" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        <input type="text" name="answer4" required placeholder="Answer D" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    </div>
                </div>
                <div class="mb-4">
                    <label for="correct_answer" class="block text-sm font-medium text-gray-700">Correct Answer</label>
                    <select id="correct_answer" name="correct_answer" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        <option value="1">Answer 1</option>
                        <option value="2">Answer 2</option>
                        <option value="3">Answer 3</option>
                        <option value="4">Answer 4</option>
                    </select>
                </div>
                <button type="submit" class="form-button">Add Question</button>
                <button type="button" class="form-button" onclick="loadQuestions()">Load existing questions</button>
            </form>
        </div>
    </div>
    <div style="width:100%;margin-left:auto;margin-right:auto;display: flex;justify-content: center;">
        <div id="questionsContainer" style="display:none; max-height: 200px; overflow-y: auto; border: 1px solid #ccc; padding: 10px;"></div>
    </div>
    <div class="container mt-5" >
        <a onclick="window.location.href = '../skills_management.php'" class="btn btn-secondary">Go Back</a>
    </div>
    <script>
        function loadQuestions() {
            var subject = document.getElementById("subject").value;
            var difficulty = document.getElementById("difficulty").value;
            if (subject == "-1") {
                alert("Please select a subject.");
                return;
            }

            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function() {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                        document.getElementById("questionsContainer").innerHTML = xhr.responseText;
                        document.getElementById("questionsContainer").style.display = "block";
                    } else {
                        console.error("Request failed with status: " + xhr.status);
                    }
                }
            };
            xhr.open("GET", "fetch_questions.php?subject=" + encodeURIComponent(subject)+"&difficulty=" + encodeURIComponent(difficulty), true);
            xhr.send();
        }
    </script>
    <script>
        function validateForm() {
            var subject = document.getElementById("subject");
            if (subject.value == "-1") {
                alert("Please select a subject.");
                return false;
            }
            return true;
        }
    </script>
</body>
</html>
