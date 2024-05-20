<?php
include "connection.php";
include "loadCities.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="css/master.css">
	<link rel="stylesheet" href="css/registration.css">
	<script src="js/registration.js"></script>

    <title>Registration</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <div class="row justify-content-center mt-5">
            <div class="col-md-8">
                <div class="card">
                    <center><h1>Registration</h1></center>

                         <!--   <h3>Personal Details</h3> -->
							<div class="card-body">
                        <form method="post" action="addUser.php" id="registrationForm">
						    
						    <div class="form-group" id="rdgFor">
                                <label for="rdbFor">For:</label>
                                <input type="radio" class="form-control" id="self" name="rdbFor" value="self" checked required><label for="self">Self</label>
                                <input type="radio" class="form-control" id="child" name="rdbFor" value="child" required><label for="child">My child</label>
                            </div>
                            <div class="form-group" id="rdgIsA">
                                <label for="rdbIsa">Is a:</label>
                                <input type="radio" class="form-control" id="teacher" name="rdbIsa" value="teacher" required><label for="teacher">Teacher</label>
                                <input type="radio" class="form-control" id="student" name="rdbIsa" value="student" required><label for="student">Student</label>
                            </div>
                            <div class="form-group" id="skillsContainer">
                                <label for="skillList">Select your skills:</label>
                                <div><?php include "skillList.php"; ?></div>
                            </div>
                            <div class="form-group">
                                <label for="gender">Title:</label>
                                <select class="form-control" id="title" name="title" required>
                                    <option value="">Select Title</option>
                                    <option value="Master">Master</option>
                                    <option value="Mr">Mr</option>
                                    <option value="Miss">Miss</option>
                                    <option value="Mrs">Mrs</option>
                                    <option value="Dr">Dr</option>
                                    <option value="Prof">Prof</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="fname">First Name:</label>
                                <input type="text" class="form-control" id="fname" name="fname" required>
                            </div>
                            <div class="form-group">
                                <label for="lname">Last Name:</label>
                                <input type="text" class="form-control" id="lname" name="lname" required>
                            </div>
                            <div class="form-group">
                                <label for="email">Email Address:</label>
                                <input type="email" class="form-control" id="email" name="email" required>
                            </div>
                            <div class="form-group">
                                <label for="city">City:</label>
                                <input type="text" oninput="listSuggestions('city','lstCity')" onfocusin="showSuggestions('lstCity')" onkeydown="keyCode(event)" autocomplete="off" class="form-control" id="city" name="city" required>
                                <div id="lstCity" class="searchResults"></div>
                            </div>
                            <div class="form-group">
                                <label for="district">District:</label>
                                <input type="text" oninput="listSuggestions('district','lstDistrict')" onfocusin="showSuggestions('lstDistrict')" onkeydown="keyCode(event)" autocomplete="off" class="form-control" id="district" name="district" required>
                                <div id="lstDistrict" class="searchResults"></div>
                            </div>
                            <div class="form-group">
                                <label for="phone">Phone Number:</label>
                                <input type="text" class="form-control" id="phone" name="phone" required>
                            </div>
                            <div class="form-group">
                                <label for="dob">Date of Birth:</label>
                                <input type="date" class="form-control" id="dob" name="dob" required>
                            </div>
                            <button type="submit" class="btn btn-success" name="registration_add" onclick="return mapSkills()">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JavaScript libraries -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        function mapSkills(){
            var selectedOptions = document.querySelectorAll(".select-option.selected");
            //var selectedValues = Array.from(selectedOptions).map(option => option.getAttribute("skill_id"));
            var selectedValues = Array.from(selectedOptions).map(option => {
                return {
                    skill_id: option.getAttribute("skill_id"),
                    skill_name: option.getAttribute("skill_name"),
                };
            });
            
            // Create a hidden input field to store the JavaScript variable
            var hiddenInput = document.createElement("input");
            hiddenInput.setAttribute("type", "hidden");
            hiddenInput.setAttribute("id", "selectedValues");
            hiddenInput.setAttribute("name", "selectedValues");
            hiddenInput.setAttribute("value", JSON.stringify(selectedValues));
            
            // Append the hidden input field to the form
            document.getElementById("registrationForm").appendChild(hiddenInput);
            return selectedValues;
        }
    </script>
    
</body>
</html>
