<!DOCTYPE html>
<html>
   <head>
      <title>Reaching Teaching</title>
      <link rel="stylesheet" href="css/nav.css">
      <!--<link rel="stylesheet" href="css/footer.css">
      footer social media icon style-->
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-...your-integrity-hash-here..." crossorigin="anonymous" />

      <style type="text/css">
         #container{
            display: flex;
            height: 100vh;
            width: 100%;
            position: relative;
            margin-top: -50px; /* Minimize the white background from the top */
            margin-bottom: -50px; /* Minimize the white background from the bottom */
         }

         /* Left column (8/12) */
         .left-column {
            flex: 9;
            position: relative;
            overflow: hidden;
         }

         .background-animation {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            background-attachment: fixed;
            animation: animate 40s infinite alternate-reverse;
         }

         @keyframes animate {
            0% {
               background-image: url('image/1.jpg');
            }
            10% {
               background-image: url('image/2.jpg');
            }
            20% {
               background-image: url('image/3.jpg');
            }
            30% {
               background-image: url('image/4.jpg');
            }
            40% {
               background-image: url('image/5.jpg');
            }
            50% {
               background-image: url('image/6.jpg');
            }
            60% {
               background-image: url('image/7.jpeg');
            }
            70% {
               background-image: url('image/8.jpg');
            }
            80% {
               background-image: url('image/9.jpg');
            }
            90% {
               background-image: url('image/10.jpg');
            }
            100% {
               background-image: url('image/1.jpg');
            }
         }

         .transparent-layer {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(255, 255, 255, 0.5);
         }

         .content {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            text-align: center;
            color: #ffffff; /* Changed the color to white */
            font-family: inherit;
            z-index: 1; /* Ensure it's above the transparent layer */
         }

         .home_details {
            font-size: 44px;
            margin-bottom: 20px;
         }

         .font {
            color: #F9522E;
         }

         .btnHome {
            font-family: inherit;
            background-color: #F9522E;
            padding: 13px 44px 13px 44px;
            font-size: 18px;
            border-style: none;
            cursor: pointer;
            color: white; /* Changed the color to white */
         }

         .btnHome:hover {
            background-color: orange;
         }

         /* Right column (4/12) */
         .right-column {
            flex: 3;
            background-color: transparent; /* Transparent background */
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 50px; /* Add padding to increase space from top and bottom */
         }

         .login-form {
            width: 100%;
            max-width: 400px;
            text-align: center;
            height: 100%; /* Make the form height full */
            display: flex;
            flex-direction: column;
            justify-content: center;
         }

         .login-form h2{
            margin:20px;
         }

         .login-form input {
            width: calc(100% - 20px); /* Make inputs full width with some spacing */
            padding: 10px;
            margin-bottom: 10px; /* Reduced margin between inputs */
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
         }

         .login-form button {
            width: 100%;
            padding: 10px;
            background-color: #F9522E;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
         }

         .login-form button:hover {
            background-color: orange;
         }

         /* Footer CSS */
         footer {
            width: 100%;
            height: 50px;
            text-align: center;
            color: #fff;
            background-color: #333;
            display: flex;
            justify-content: center;
            align-items: center;
            position: absolute;
            bottom: 0;
         }

         .social-icons {
            color: white;
            margin: 0 10px;
            font-size: 24px;
         }
      </style>
   </head>
   <?php
       session_destroy();
   ?>
   <body>
       <header>
         <nav class="navbar">
             <img src="image/logo.png" width="50px" onclick="window.location.href='index.php'">
           <div class="logo">
              <label class="name"> Reaching Teaching </label>
           </div>
         </nav>
      </header>
      <div id="container">
         <div class="left-column">
            <!-- Background Animation/Image -->
            <div class="background-animation"></div>
            <div class="transparent-layer"></div>
            <div class="content">
               <h1 class="home_details">Welcome to our Platform!<br><span class="font">Manage your students and teachers efficiently.</span></h1>
               <a href="registration.php"><button class="btnHome">SIGN UP NOW</button></a>
            </div>
         </div>
         <div class="right-column">
            <div class="login-form">
               <h2>LOG IN</h2>
               <form action="login.php" method="post">
                  <input type="text" name="username" id="username" placeholder="Username" required><br>
                  <input type="password" name="password" id="password" placeholder="Password" required><br><br>
                  <a href="#">Forgot password?</a><br><br>
                  <button type="submit" name="login">LOGIN</button>
               </form>
            </div>
         </div>
      </div>

      <!-- Footer -->
      <footer>
         <div class="social-icons">
            <a href="#"><i class="fab fa-facebook-f"></i></a>
         </div>
         <div class="social-icons">
            <a href="#"><i class="fab fa-twitter"></i></a>
         </div>
         <div class="social-icons">
            <a href="#"><i class="fab fa-instagram"></i></a>
         </div>
         &copy; A project by Code Commanders (v1.0)<!--STUDENT @ TEACHER PLATFORM-->
      </footer>
   </body>
</html>
