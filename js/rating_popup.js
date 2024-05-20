var user_id = -1;
var given_by = -1;
function showPopup(id,by) {
  user_id = id;
  given_by = by;
  document.getElementById("popupContainer").style.display = "block";
}

function closePopup() {
  document.getElementById("popupContainer").style.display = "none";
}
var rating='5'; 
document.querySelectorAll(".star").forEach(function(star) {
  star.addEventListener("click", function() {
    rating = this.getAttribute("data-rating");
    document.querySelectorAll(".star").forEach(function(star) {
        star.style="color: #ddd;";
    });
    
        selectedStars();
    //alert("You rated us " + rating + " stars!");
    //document.getElementById("popupContainer").style.display = "none";
  });
});
function selectedStars(){
    for(var i=0;i<rating;i++){
        document.querySelectorAll(".star")[i].style="color: #f39c12;";
    }
}
document.getElementById("submitRating").addEventListener("click", function() {
  //let selectedRating = document.querySelector(".star:hover");
  if (rating>0) {
    addRatings();
    loadTeachers();//alert("You rated us " + rating + " stars!");
  } else {
    alert("Please select a rating!");
  }
  document.getElementById("popupContainer").style.display = "none";
});

function addRatings(){
    var xhr = new XMLHttpRequest();
        xhr.open("POST", "addRatings.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded"); console.log(user_id);
        xhr.send("user_id=" + encodeURIComponent(user_id)+"&rating=" + encodeURIComponent(rating)+"&given_by=" + encodeURIComponent(given_by));
}




