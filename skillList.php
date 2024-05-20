<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Toggle Select Options</title>
<style>
  /* Style to display options horizontally */
  .select-container {
    width: 100%;
    border: 1px solid #ccc;
    border-radius: 4px;
    padding: 5px;
    display: inline-block;
    overflow-y: auto;
    max-height: 200px; /* Adjust as needed */
  }
  
  /* Style for options */
  .select-option {
    display: inline-block;
    padding: 5px 10px;
    margin: 5px;
    background-color: #f0f0f0;
    border-radius: 4px;
    cursor: pointer;
  }
  
  /* Style for selected options */
  .select-option.selected {
    background-color: #a0c4ff; /* Change to your preferred color */
  }
</style>
</head>
<body>
<?php
include "connection.php";
?>

<div class="select-container" id="skillContainer">
<?php
    $sql = "SELECT * FROM skills ORDER BY name";
    $result = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_assoc($result)) {
        ?><div class="select-option" skill_id="<?php echo $row["id"] ?>" skill_name="<?php echo $row["name"] ?>"> <?php echo $row["name"] ?></div><?php
    }
?>
</div>

<script>
document.addEventListener("DOMContentLoaded", function() {
  var selectContainer = document.getElementById("skillContainer");
  
  // Add click event listener to the select container
  selectContainer.addEventListener("click", function(event) {
    var targetOption = event.target;
    if (targetOption.classList.contains("select-option")) {
      // Toggle selection for the clicked option
      targetOption.classList.toggle("selected");
    }
  });
});
</script>

</body>
</html>
