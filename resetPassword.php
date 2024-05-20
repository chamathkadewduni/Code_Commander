<?php
require "connection.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Setup New Password</title>
    <style>
        body
        {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
        }
        
        form
        {
            margin: 50px auto;
            max-width: 400px;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0,0,0,0.2);
        }
        
        label
        {
            display: block;
            margin-bottom: 10px;
            font-weight: bold;
        }
        
        input[type=email],input[type=password]
        {
            width: calc(100% - 20px);
            padding: 10px;
            margin-bottom: 20px;
            border: none;
            border-radius: 5px;
            box-shadow: 0 0 5px rgba(0,0,0,0.2);
        }
        
        input[type=submit],button
        {
            background-color: #4CAF50;
            color: #fff;
            border: none;
            border-radius: 5px;
            padding: 10px;
            cursor: pointer;
        }
        
        input[type=submit]:hover
        {
            background-color: #3e8e41;
        }
    </style>
</head>

<body>
    <!-- HTML form for the login page -->
    <form method="POST" action="setPassword.php" id="passwordForm">
        <center><h2>Setup New Password</h2></center>
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" onfocusout="getTempPassword();" required>
        <label for="tempPass">Temporary Password:</label>
        <input type="password" id="tempPass" name="tempPass" required>
        <label for="newPass">New Password:</label>
        <input type="password" id="newPass" name="newPass" required>
        <label for="confirmPass">Confirm Password:</label>
        <input type="password" id="confirmPass" name="confirmPass" required>
        <label style="display:none;" id="lblError"></label>
        <!--<a href="#"  ><input type="submit" value="Set New Password" onclick="return SetNewPassword();"><a> onclick="return SetNewPassword();"-->
        <button type="button" value="Set New Password" onclick="return SetNewPassword();" >Set New Password</button> 
    </form>

</body>
<script>
var tempPass="";
    function getTempPassword() {
        var email = document.getElementById("email").value;
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "getTempPassword.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function () {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    tempPass = xhr.responseText.trim();
                } else {
                    // Handle error
                }
            }
        };
        xhr.send("email=" + encodeURIComponent(email));
        //console.log(tempPass);
        //SetNewPassword(tempPass);
    }
</script>
<script>
    function SetNewPassword(){
        if(tempPass!=document.getElementById('tempPass').value){
            if(tempPass.substring(1,4)=="msg:")
                document.getElementById('lblError').innerText=tempPass.substring(5);
            else
                document.getElementById('lblError').innerText="You have entered a wrong temporary password. Please check your inbox for the email containing your temporary password";
            document.getElementById('lblError').style="display:block;color:#AF4C50;";
            //return false;
        }
        else if(document.getElementById('newPass').value!=document.getElementById('confirmPass').value){
            document.getElementById('lblError').innerText="New Password and Confirm Password do not match!";
            document.getElementById('lblError').style="display:block;color:#AF4C50;";
            //return false;
        }
        else if(document.getElementById('tempPass').value=="" || document.getElementById('newPass').value=="" || document.getElementById('confirmPass').value==""){
            document.getElementById('lblError').innerText="Please fill all the fields";
            document.getElementById('lblError').style="display:block;color:#AF4C50;";
            //return false;
        }
        else{
            document.getElementById("passwordForm").submit();
        }
    }
</script>
</html>