<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Skill Test Portal</title>
    <!--link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.18/dist/tailwind.min.css" rel="stylesheet"-->
    <!--link href="style.css" rel="stylesheet"-->
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
<body class="bg-gray-100">
    <div class="container mx-auto px-4">
        <h1 class="text-xl font-bold text-center my-6">Skill Test for Teachers</h1>
        <div class="mb-4">
            <label for="subject" class="block text-gray-700 text-sm font-bold mb-2">Choose Subject:</label>
            <select id="subject" class="block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline">
                <option value="-1">---Select a Subject---</option>
                        <?php echo $options; ?>
            </select>
        </div>
        <div class="mb-4">
            <label for="difficulty" class="block text-gray-700 text-sm font-bold mb-2">Select Difficulty:</label>
            <select id="difficulty" class="block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline">
                <option>Beginner</option>
                <option>Intermediate</option>
                <option>Advanced</option>
            </select>
        </div>
        <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" onclick="startTest()">Start Test</button>
    </div>

    <div class="container mt-5" >
        <a onclick="window.location.href = '../my_skills.php'" class="btn btn-secondary">Go Back</a>
    </div>
    <script>
        function startTest() {
            const subject = document.getElementById('subject').value;
            const difficulty = document.getElementById('difficulty').value;
            if (subject == "-1") 
                alert("Please select a subject.");
            else
            window.location.href = `test.php?subject=${subject}&difficulty=${difficulty}`;
        }
    </script>
</body>
</html>