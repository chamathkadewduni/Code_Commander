<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Teacher Search</title>
  <!-- Bootstrap CSS -->
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="css/teacher_search.css">
  <link rel="stylesheet" href="css/rating_popup.css">
  <link rel="stylesheet" href="css/chat_style.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<?php
    session_start();
	if($_SESSION['user_id']=="")
	{
		$_SESSION=[];
		header("Location: index.php");
	}
	else{
	    $user_id=$_SESSION['user_id'];
	    $role=$_SESSION['role'];
	}
/*	$user_id = $_SESSION['user_id'];
    $fname = $_SESSION['fname'];
    var_dump($user_id);*/
?>
  <?php
  function loadTeacherName($field){
       session_start();
      include "connection.php";
      $sql="SELECT DISTINCT ".$field." FROM `users` AS u JOIN user_login AS ul ON u.id=ul.user_id JOIN role as rl ON rl.id=ul.role_id WHERE ul.status='active' AND rl.role='teacher' AND ul.user_id != ".$_SESSION['user_id']." ORDER BY ".$field; echo $sql;
      $result = mysqli_query($conn, $sql);

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()){
                echo "<option value='".$row[$field]."'> ".$row[$field]."</option>";
            }
        } 
        /*else
            return "No Records";*/
  }
  function loadOptions($field,$table){
      include "connection.php";
      $sql="SELECT DISTINCT ".$field." FROM `".$table."` WHERE ".$field." IS NOT NULL ORDER BY ".$field ; echo $sql;
      $result = mysqli_query($conn, $sql);

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()){
                echo "<option> ".$row[$field]."</option>";
            }
        } 
        /*else
            return "No Records";*/
  }
  ?>
<body>
  <div class="container mt-5">
    <h2>Search Teachers</h2>
    <form action="" method="POST"><!--search.php-->
      <span class="form-group">
        <label for="rdbTeacherName">Teacher Name:</label><br/>
        <input type="radio" class="form-control-radio" id="fname" name="rdbTeacherName" value="fname" onchange="show()" checked required><label for="fname">Firstname</label>&nbsp&nbsp
        <input type="radio" class="form-control-radio" id="lname" name="rdbTeacherName" value="lname" onchange="show()" required><label for="lname">Lastname</label>
      </span>
      <span class="form-group" id="fname_group">
       <!-- <label for="firstname">Teacher Firstname:</label> -->
        <select class="form-control" id="firstname" name="firstname">
            <option value="-1">---Select Firstname---</option>
            <?php loadTeacherName('fname'); ?>
          </select>
      </span>
      <span class="form-group" id="lname_group" style="display:none !important;">
        <select class="form-control" id="lastname" name="lastname">
            <option value="-1">---Select Lastname---</option>
            <?php loadTeacherName('lname'); ?>
          </select>
      </span> 
      <span class="form-group">
        <label for="subject">Subject:</label>
        <select class="form-control" id="subject" name="subject">
            <option value="-1">---Select Subject---</option>
            <?php loadOptions('subject','tutor_ad'); ?>
          </select>
      </span>
      <span class="form-group">
        <label for="grade">Grade:</label>
        <select class="form-control" id="grade" name="grade">
            <option value="-1">---Select Grade---</option>
            <?php loadOptions('grade','tutor_ad'); ?>
          </select>
      </span>
      <span class="form-group">
        <label for="city">City:</label>
        <select class="form-control" id="city" name="city">
            <option value="-1">---Select City---</option>
            <?php loadOptions('city','city'); ?>
          </select>
      </span>
      <span class="form-group">
        <label for="district">District:</label>
        <select class="form-control" id="district" name="district">
            <option value="-1">---Select District---</option>
            <?php loadOptions('district','city'); ?>
          </select>
      </span>
      <span class="form-group">
            <label for="ratings">Average Rating:</label><br>
            <select class="form-control" id="ratings" name="ratings">
            <option value="-1">---Select Rating---</option>
            <option value="1">1+</option>
            <option value="2">2+</option>
            <option value="3">3+</option>
            <option value="4">4+</option>
            <option value="5">5</option>
          </select>
        </span>
      <span class="form-group">
    <button type="submit" class="btn btn-primary" onclick="return loadTeachers()">Search</button>
          
        </span>
    </form>
    <div id="popupContainer" class="popupContainer">
        <div class="popupContent">
            <span class="closePopup" id="closePopup" onclick='closePopup()'>&times;</span>
            <h2>Rate Teacher!</h2>
            <p>Please rate your experience:</p>
            <div class="stars" id="stars">
              <span class="star" data-rating="1">&#9733;</span>
              <span class="star" data-rating="2">&#9733;</span>
              <span class="star" data-rating="3">&#9733;</span>
              <span class="star" data-rating="4">&#9733;</span>
              <span class="star" data-rating="5">&#9733;</span>
            </div>
            <button id="submitRating">Submit</button>
        </div>
    </div>
  </div>
    
    <div class="container mt-5" >
        
    <div id="loadResults" class="form">
        <label>At least one selection needed! </label>
        </div>
        
    </div>
    
    <div class="container mt-5" >
        <a onclick="history.back()" class="btn btn-secondary">Go Back</a>
    </div>
    
    <div id="chat_container" style="display:none">
        <div class="chat-box" id="chat-box">
        <div class="chat-box-header">
            <h3 id="chatHeader">Hi,</h3>
            <button class="close-btn" onclick="closeChat()">✖</button>
        </div>
        <div class="chat-box-body" id="chat-box-body">
            <!-- Chat messages will be loaded here -->
        </div>
        <form class="chat-form" id="chat-form">
            <input type="hidden" id="sender" value="user_id">
            <input type="hidden" id="receiver" value="fname">
            <input type="text" id="message" placeholder="Type your message..." required>
            <button type="submit">Send</button>
        </form>
        </div>
    </div>
    
  <script>
    // Array of Sri Lankan districts
    var districts = [
        "Colombo", "Gampaha", "Kalutara", "Kandy", "Matale", "Nuwara Eliya", "Galle", "Matara", "Hambantota",
        "Jaffna", "Kilinochchi", "Mannar", "Mullaitivu", "Vavuniya", "Batticaloa", "Ampara", "Trincomalee",
        "Kurunegala", "Puttalam", "Anuradhapura", "Polonnaruwa", "Badulla", "Monaragala", "Ratnapura", "Kegalle"
    ];
    
    // Function to search for districts
    function searchDistrict() {
        var input, filter, searchResults;
        input = document.getElementById("districtInput");
        filter = input.value.toUpperCase();
        searchResults = document.getElementById("searchResults");
        searchResults.innerHTML = ""; // Clear previous results
    
        // Filter districts based on user input
        districts.forEach(function(district) {
            if (district.toUpperCase().startsWith(filter)) {
                var result = document.createElement("div");
                result.textContent = district;
                result.addEventListener("click", function() {
                    input.value = district;
                    searchResults.innerHTML = ""; // Clear results after selection
                });
                searchResults.appendChild(result);
            }
        });
    }
    </script>
    <script>
    var tnameType='fname';
        function show(){
            if(document.getElementById('fname').checked){
                tnameType='fname';
                document.getElementById('lname_group').style = "display:none !important;";
                document.getElementById('fname_group').style = "display:inline-block !important;";
            }
            else if(document.getElementById('lname').checked){
                tnameType='lname';
                document.getElementById('fname_group').style = "display:none !important;";
                document.getElementById('lname_group').style = "display:inline-block !important;";
            }
        }
    </script>
    <script>
    var table = "";
    function loadTeachers(){
        var tname ='';
        if(tnameType=='fname')
            tname = document.getElementById("firstname").value;
        else if (tnameType=='lname')
            tname = document.getElementById("lastname").value;
            
        var subject = document.getElementById("subject").value;
        var grade = document.getElementById("grade").value;
        var city = document.getElementById("city").value;
        var district = document.getElementById("district").value;
        var ratings = document.getElementById("ratings").value;
        
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "filterTeachers.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function () { 
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {//console.log(JSON.parse(xhr.responseText));
                    if(xhr.responseText.substring(1,5)!="msg:" && xhr.responseText.substring(14,10)!="null"){ 
                        // Parse JSON response
                        var responseData = JSON.parse(xhr.responseText);
                        // Update HTML content with the response
                        console.log(responseData);
                        table = "<table><tr><th>Title</th><th>Firstname</th><th>Lastname</th><th>Subject</th><th>Grade</th><th>City</th><th>District</th><th>Average Rating</th></tr>";
                        for(var i=0;i<responseData.length;i++){
                            if(responseData[i]['id']>0)
                                displayResults(responseData[i]);
                            else
                            document.getElementById('loadResults').innerHTML = "<label>No records found! Try changing filters.</label>";
                        }
                        table += "</table>";
                        // Update the HTML element with id "loadResults" with the table content
                        document.getElementById('loadResults').innerHTML = table;
                    }
                    else{
                        document.getElementById('loadResults').innerHTML = "<label>No records found!</label>";
                    }
                } else {
                    console.error("XHR request failed with status:", xhr.status);
                    // Handle error if needed
                }
            }
        };
        xhr.send("tname=" + encodeURIComponent(tname) + "&tnameType=" + encodeURIComponent(tnameType) + "&subject=" + encodeURIComponent(subject) + "&grade=" + encodeURIComponent(grade) + "&city=" + encodeURIComponent(city) + "&district=" + encodeURIComponent(district) + "&rating=" + encodeURIComponent(ratings));
        return false; // Prevent default form submission
    }
    function displayResults(data) { 
        //var table = "<table><tr><th>Title</th><th>Firstname</th><th>Lastname</th><th>Subject</th><th>Grade</th><th>City</th><th>District</th><th>Average Rating</th></tr>";
        // Loop through each item in the data array
        table += "<tr>";
        for (var item in data) {
            if(item!="id")
            if (data.hasOwnProperty(item)) {
                //console.log(item + ": " + data[item]);
                if(!data[item])
                    data[item]=0;
                table += "<td>" + data[item] + "</td>";
                
            }
        }
        table += "<td> <button onclick='showPopup("+data['id']+",<?php echo $user_id ?>)'>Rate</button> </td>"; //showPopup function is in rating_popup.js
        table += "<td> <button onclick='showChat(\"" + data['fname'] + "\",<?php echo $user_id ?>,"+data['id']+")'>Message</button> </td>";
        <?php if($role=='teacher'){ ?>
            table += "<td> <button onclick='showEndorse(<?php echo $user_id ?>,"+data['id']+",\"" + data['fname'] + "\")'>Endorse</button> </td>";
        <?php } ?>
        table += "</tr>";
    }
    function showEndorse(endorser_id,endorsee_id,endorsee_name){
        // Make an AJAX request to set the session variables
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "set_session_variables.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.send("endorser_id=" + encodeURIComponent(endorser_id) + "&endorsee_id=" + encodeURIComponent(endorsee_id)+ "&endorsee_name=" + encodeURIComponent(endorsee_name));
    
        // Redirect to endorse.php
        window.location.href = "endorse.php";
    }
    function showChat(fname,sender,receiver){
        document.getElementById("chat_container").style="display:inline-block";
        document.getElementById("chatHeader").innerText=fname;
        document.getElementById("sender").value=sender;
        document.getElementById("receiver").value=receiver;
    }
    function closeChat() {
        document.getElementById("chat_container").style.display = "none";
    }
</script>
<script src="js/rating_popup.js"></script>
<script src="js/chat.js"></script>
</body>
</html>
