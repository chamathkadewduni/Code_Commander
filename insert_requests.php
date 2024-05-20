<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>ReachingTeaching.com</title>
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="css/insert_advertisements_new.css">
<link rel="stylesheet" href="css/master.css">

</head>
<body>
    
<?php
    session_start();
    $user_id="";
    $role="";
	if($_SESSION['user_id']=="")
	{
		$_SESSION=[];
		header("Location: index.php");
	}
	else{
	    $user_id=$_SESSION['user_id'];
	    $role=$_SESSION['role'];
	}
?>
<?php
include "connection.php";
include "loadCities.php";
?>
    <div class="container">
        <h2 class="mt-3">Post Your Class Advertisement</h2>
        <br>
        <form id="insertRequest" action="insert_requests_db.php" method="post">
            <label style="display:block;color:#FFFF00;" id="lblError"></label>
            <!-- Student ID -->
            <div class="form-group">
                <label for="user_id">User Id:</label>
                <input type="number" class="form-control" id="user_id" name="user_id" value=<?php echo $user_id?>   readonly>
                <span id="user_idError" class="error text-danger"></span>
            </div>
            
            <!-- Advertisement Topic -->
            <div class="form-group">
                <label for="topic">Advertisement Title:</label>
                <input type="text" class="form-control" id="topic" name="topic" required>
                <span id="topicError" class="error text-danger"></span>
            </div>

            <!-- Subject -->
            <div class="form-group">
                <label for="subject">Subject:</label>
                <input type="text" class="form-control" id="subject" name="subject" required>
                <span id="subjectError" class="error text-danger"></span>
            </div>
            
            <!-- Grade -->
            <div class="form-group">
                <label for="grade">Grade:</label>
                <input type="text" class="form-control" id="grade" name="grade" required>
                <span id="gradeError" class="error text-danger"></span>
            </div>


             <!-- Subject -->
            <!--<div class="form-group">-->
            <!--    <label for="subject">Teaching Subject:</label>-->
                <!-- <input type="text" class="form-control" id="subject" name="subject"> -->
            <!--    <select class="form-control" name="subject" id="subject" name="subject" required>-->
            <!--        <option value="">Select..</option>-->
            <!--        <option value="Mathematics">Mathematics</option>-->
            <!--        <option value="Science">Science</option>-->
            <!--        <option value="Information Technology">Information Technology</option>-->
            <!--        <option value="Other">Other</option>-->
            <!--    </select>-->
            <!--    <span id="subjectError" class="error text-danger"></span>-->
            <!--</div>-->


            <!-- Grades -->
            <!--<div class="form-group">-->
            <!--    <label for="grade">Focused Grade:</label>-->
            <!--    <select class="form-control" name="grade" id="grade" name="grade" required>-->
            <!--        <option value="">Select..</option>-->
            <!--        <option value="Grade 1">Grade 1</option>-->
            <!--        <option value="Grade 2">Grade 2</option>-->
            <!--        <option value="Grade 3">Grade 3</option>-->
            <!--        <option value="Grade 4">Grade 4</option>-->
            <!--        <option value="Grade 5">Grade 5</option>-->
            <!--        <option value="Grade 6">Grade 6</option>-->
            <!--        <option value="Grade 7">Grade 7</option>-->
            <!--        <option value="Grade 8">Grade 8</option>-->
            <!--        <option value="Grade 9">Grade 9</option>-->
            <!--        <option value="Grade 10">Grade 10</option>-->
            <!--        <option value="Grade 11">Grade 11</option>-->
            <!--        <option value="Grade 12">Grade 12</option>-->
            <!--        <option value="Grade 13">Grade 13</option>-->
            <!--        <option value="Other">Other</option>-->
            <!--    </select>-->
            <!--    <span id="gradeError" class="error text-danger"></span>-->
            <!--</div>-->


            <!-- Method -->
            <!--<div class="form-group">-->
            <!--    <label for="method">Class conducting method:</label>-->
                <!-- <input type="text" class="form-control" id="method" name="method"> -->
            <!--    &nbsp; &nbsp; -->
            <!--    <input class="form-control-radio" type="radio" name="method" id="online" value="Online" required >-->
            <!--    &nbsp; -->
            <!--    <label for="online">Online </label>-->
            <!--    &nbsp; &nbsp; &nbsp;-->
            <!--    <input class="form-control-radio" type="radio" name="method" id="onsite" value="Onsite" required>-->
            <!--    &nbsp; -->
            <!--    <label for="onsite">Onsite </label>-->
            <!--     &nbsp;  &nbsp; &nbsp;-->
            <!--    <input class="form-control-radio" type="radio" name="method" id="travel" value="Travel to Location" required>-->
            <!--    &nbsp;  -->
            <!--    <label for="travel">Travel to Location </label>-->
            <!--    <span id="methodError" class="error text-danger"></span>-->
            <!--</div>-->


            <!-- City Id -->
            <!--<div class="form-group">
                <label for="city_id">City ID:</label>
                 <input type="number" class="form-control" id="city_id" name="city_id" required> 
                <!--<select class="form-control" name="city_id" id="city_id" required>-->
                <!--    <option value="">Select..</option>-->
                <!--    <option value="Galle">Galle</option>-->
                <!--    <option value="Matara">Matara</option>-->
                <!--    <option value="Colombo">Colombo</option>-->
                <!--    <option value="Anuradhapura">Anuradhapura</option>-->
                <!--    <option value="Kandy">Kandy</option>-->
                <!--    <option value="Other">Other</option>-->
                <!--</select>-->
              <!--  <span id="city_idError" class="error text-danger"></span>
            </div>-->
            
            <div class="form-group">
                <label for="city">City:</label>
                <input type="text" oninput="listSuggestions('city','lstCity')" onfocusin="showSuggestions('lstCity')" onkeydown="keyCode(event)" autocomplete="off" class="form-control" id="city" name="city" required>
                <div id="lstCity" class="searchResults"></div>
            </div>
            
            <!-- District -->
            <div class="form-group">
                <label for="district">District:</label>
                <input type="text" oninput="listSuggestions('district','lstDistrict')" onfocusin="showSuggestions('lstDistrict')" onkeydown="keyCode(event)" autocomplete="off" class="form-control" id="district" name="district" required>
                <div id="lstDistrict" class="searchResults"></div>
            </div>


            <!-- Rate Type -->
            <!--<div class="form-group">-->
            <!--    <label for="rateType">Rate Type:</label>-->
            <!--    <select class="form-control" name="rateType" id="rateType" required>-->
            <!--        <option value="">Select..</option>-->
            <!--        <option value="Hourly">Hourly</option>-->
            <!--        <option value="Daily">Daily</option>-->
            <!--        <option value="Monthly">Monthly</option>-->
            <!--    </select>-->
            <!--    <span id="rateTypeError" class="error text-danger"></span>-->
            <!--</div>-->


            <!-- Rate -->
            <!--<div class="form-group">-->
            <!--    <label for="rate">Rate (Rs.):</label>-->
            <!--    <input type="number" class="form-control" id="rate" name="rate" required>-->
            <!--    <span id="rateError" class="error text-danger"></span>-->
            <!--</div>-->

           
            <!-- Medium -->
            <div class="form-group">
                <label for="medium">Medium of Instruction:</label><br>
                
              <!--   <input type="checkbox" id="sinhala" name="language[]" value="Sinhala">
                <label for="sinhala"> Sinhala</label>
                &nbsp;&nbsp;
                <input type="checkbox" id="english" name="language[]" value="English">
                <label for="english"> English</label>
                &nbsp;&nbsp;
                <input type="checkbox" id="tamil" name="language[]" value="Tamil">
                <label for="english"> Tamil </label>
                &nbsp;&nbsp;
                <input type="checkbox" id="other" name="language[]" value="Other">
                <label for="other"> Other</label> -->
                
                <input class="form-control-radio" type="radio" name="medium" id="sinhala" value="Sinhala" required>
                &nbsp;
                <label for="sinhala">Sinhala </label>
                &nbsp; &nbsp; 
                <input class="form-control-radio" type="radio" name="medium" id="english" value="English" required>
                &nbsp;
                <label for="english">English </label>
                &nbsp; &nbsp; 
                <input class="form-control-radio" type="radio" name="medium" id="tamil" value="Tamil" required>
                &nbsp;
                <label for="tamil">Tamil </label>
                &nbsp; &nbsp; 
                <input class="form-control-radio" type="radio" name="medium" id="other" value="Other" required>
                &nbsp;
                <label for="other">Other </label>
              <!-- <select class="form-control" name="medium" id="medium" name="medium" required>
                    <option value="">Select..</option>
                    <option value="Sinhala">Sinhala</option>
                    <option value="English">English</option>
                    <option value="Tamil">Tamil</option>
                    <option value="Other">Other</option>
                </select>-->
                <span id="mediumError" class="error text-danger"></span>
            </div>

            <!-- Type -->
            <div class="form-group">
                <label for="type">Class Type:</label><br>
                <input class="form-control-radio" type="radio" name="type" id="type_group" value="Group" required>
                &nbsp;
                <label for="type_group">Group </label>
                &nbsp; &nbsp; &nbsp;
                <input class="form-control-radio" type="radio" name="type" id="type_individual" value="Individual" required>
                &nbsp;
                <label for="type_individual">Individual </label>
                <span id="typeError" class="error text-danger"></span>
            </div>

         
            <!-- Other Details -->
            <div class="form-group">
                <label for="description">Any other details:</label>
                <textarea class="form-control" id="description" name="description" required></textarea>
                <span id="descriptionError" class="error text-danger"></span>
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
              <button type="button" class="btn btn-danger" name="clearBtn" onclick="clearForm()">Clear</button>
              <a href="student_profile.php" class="btn btn-secondary">Go Back</a>
        </form>
        

    </div>

 <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    
  
<script>
       // Function to clear all input fields including radio buttons
    function clearForm() {
        // Clear text inputs
        $('form :input').val('');
        // Clear drop down menus
        // $('form :input[type="select"]').val('Select..');
        // Clear radio buttons
        $('form :input[type="radio"]').prop('checked', false);
        // Clear error messages
        $('.error').text('');
        // Enable location dropdown
        $('#location').prop('disabled', false);
    }

    //For Disable Location when Online Selected
  // function Online() {
  //   var form = document.forms['insertAdvertisement'];
  //   if(form.method[1].onfocus){
  //   form.location.disabled= false;
  //   form.location.required = true;}
  // }

 // $(document).ready(function() {
 //        // Listen for changes in the radio button selection
 //        $('input[type="radio"]').change(function() {
 //            // Check if the online radio button is selected
 //            if ($('#online').is(':checked')) {
 //                // Disable the location dropdown
 //                $('#location').prop('disabled', true);
 //            } else {
 //                // Enable the location dropdown
 //                $('#location').prop('disabled', false);
 //            }
 //        });

</script>
<script>
        function disableElements(){
            //document.getElementById('topic').disabled=true;
            var form = document.getElementById("insertAdvertisement");
            var elements = form.elements;
            for (var i = 0, len = elements.length; i < len; ++i) {
                elements[i].disabled = true;
            }
            document.getElementById('lblError').innerText="You do not have enough credits to publish an advertisement. Click on 'Help' to know how you can get more credits. Thanks.";
        }
        <?php
            $sql="SELECT SUM(credits_received) AS credits FROM `credits` WHERE user_id=".$user_id;
            $results = $conn->query($sql);
            
            if ($results->num_rows > 0) {
                while($row =$results->fetch_assoc()) {
                    if($row['credits'] <= 0)
                        echo "disableElements()";
                    else
                        echo "document.getElementById('lblError').innerText='Remaining Credits: ".$row['credits']."'";
                }
            } else {
                echo "disableElements()";
            }
        ?>
    </script>
</body>
</html>
