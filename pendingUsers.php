<?php
   include "connection.php";
   ?>
<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
	  <link rel="stylesheet" href="css/nav.css">
      <!-- Bootstrap -->
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
      <!-- Font Awesome -->
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
      <title>View Route</title>
   </head>
   <body>
	    <!--(nav bar calling)-->
		    <?php include("nav.php"); ?>
        <!--(nav bar closing)
	  <a href="admindash.php" class="btn btn-dark mb-3">Back</a>
	  <a href="index.php" class="btn btn-warning">Sign Out</a>-->
      <div class="container">
         <?php
            if (isset($_GET["msg"])) {
              $msg = $_GET["msg"];
              echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
              ' . $msg . '
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
            }
            ?>
        
               <?php
                  $sql = "SELECT r.role,u.id,u.title,u.fname,u.lname,u.email,ct.city,ct.district,u.phone,u.dob,u.for FROM `users` as u 
                            JOIN `city` as ct ON ct.id=u.city_id 
                            JOIN `user_login` as ul ON ul.user_id=u.id
                            JOIN `role` as r ON r.id=ul.role_id
                            WHERE ul.status='pending' ORDER By u.id";
                  $result = mysqli_query($conn, $sql);
                  if ($result && mysqli_num_rows($result) > 0) { ?>
                        <form action="approveUser.php" method="POST">
                         <table class="table table-hover text-center">
                            <thead class="table-dark">
                               <tr>
                                  <th scope="col">User role</th>
                                  <th scope="col">ID</th>
                                  <th scope="col">Title</th>
                                  <th scope="col">First Name</th>
                                  <th scope="col">Last Name</th>
                				  <th scope="col">Email Address</th>
                                  <th scope="col">City</th>
                                  <th scope="col">District</th>
                                  <th scope="col">Phone Number</th>
                                  <th scope="col">Date of Birth</th>
                                  <th scope="col">Profile created for</th>
                                  <th scope="col">Select</th>
                               </tr>
                            </thead>
                            <tbody>
                    <?php
                  while ($row = mysqli_fetch_assoc($result)) {
                  ?>
               <tr>
                  <td><?php echo $row["role"] ?></td>
                  <td><?php echo $row["id"] ?></td>
                  <td><?php echo $row["title"] ?></td>
                  <td><?php echo $row["fname"] ?></td>
                  <td><?php echo $row["lname"] ?></td>
                  <td><?php echo $row["email"] ?></td>
                  <td><?php echo $row["city"] ?></td>
                  <td><?php echo $row["district"] ?></td>
                  <td><?php echo $row["phone"] ?></td>
				  <td><?php echo $row["dob"] ?></td>
                  <td><?php echo $row["for"] ?></td>
                  <td>
                      <input type="checkbox" id="<?php echo $row["id"] ?>" email="<?php echo $row["email"] ?>" fname="<?php echo $row["fname"] ?>">
                  <!--   <a href="update_student.php?id=''" class="link-dark"><i class="fa-solid fa-pen-to-square fs-5 me-3"></i></a>
                     <a href="delete_student.php?id=''" class="link-dark"><i class="fa-solid fa-trash fs-5"></i></a> -->
                  </td>
               </tr>
               <?php
                  }
                  ?>
            </tbody>
         </table>
         <button id="btnApprove" name="btnApprove" onclick="return getCheckedBoxes();">Approve</button> <button id="btnDecline" name="btnDecline" onclick="return getCheckedBoxes();">Decline</button> 
         <input type="hidden" id="checkedBoxes" name="checkedBoxes" value="5">
         <input type="hidden" id="emails" name="emails" value="6">
         <input type="hidden" id="fnames" name="fnames" value="7">
         </form>
         <?php  }  ?>
      </div>
     
      <!-- Bootstrap -->
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
   </body>
    <script>
    var checkedBoxIds="";
    var emails="";
    var fnames="";
        function getCheckedBoxes(){
            checkedBoxIds="";
            var checkedBoxes = document.querySelectorAll('input[type=checkbox]:checked');      //Get all selected users
            if(checkedBoxes.length>0){      //Check if any user is selected
                for(var i=0;i<checkedBoxes.length;i++) 
                    addHiddenValue(checkedBoxes[i]);      //This function creates a comma separated value of selected user ids
                checkedBoxIds = checkedBoxIds.substring(0, checkedBoxIds.length - 1);       //Remove last comma
                emails = emails.substring(0, emails.length - 1);       //Remove last comma
                fnames = fnames.substring(0, fnames.length - 1);       //Remove last comma
                document.getElementById("checkedBoxes").value = checkedBoxIds;       //Set hidden field value
                document.getElementById("emails").value = emails;       //Set hidden field value
                document.getElementById("fnames").value = fnames;       //Set hidden field value
            }
            return true;
        }
        function addHiddenValue(checkedbox){
            checkedBoxIds+=checkedbox.id+","; console.log(checkedBoxIds);
            emails+=checkedbox.getAttribute("email")+",";// console.log(emails); alert(checkedbox.getAttribute("email"));
            fnames+=checkedbox.getAttribute("fname")+","; //console.log(fnames);
        }
    </script>
</html>