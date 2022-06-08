<?php 
require_once 'functions.php'; 
if (!userIsLoggedIn()) { header("Location:index.php"); }
?>

<div class="sidenav">
    
<?php
if ($_SESSION['idRol']==1){ $href = 'sys_admin_home.php';}
    elseif ($_SESSION['idRol']==2) { $href = 'admin_home.php'; }
    elseif ($_SESSION['idRol']==3) { $href = 'student_home.php'; }
    elseif ($_SESSION['idRol']==4) { $href = 'profesor_home.php'; }
echo '<a href="'.$href.'"><i class="fa fa-fw fa-home"></i>  Home</a>';
?>

  <a href="cont.php"><i class="fa fa-address-card"></i>  Cont</a>

  <a href="users.php"><i class="fa fa-users"></i>  Users</a>

  <a href="https://calendar.google.com/calendar/u/0/r"><i class="fa fa-calendar-minus-o"></i> Calendar</a>

  <!-- <button class="dropdown-btn"><i class="fa fa-sticky-note-o"></i> Seminars
    <i class="fa fa-caret-down"></i>
  </button> 
  <div class="dropdown-container">
    <a href="#">Attendances</a>
  </div> -->

  <!-- <button class="dropdown-btn"><i class="fa fa-cogs"></i> Labs
    <i class="fa fa-caret-down"></i>
  </button> -->
  <!-- <div class="dropdown-container">
    <a href="#">Attendances</a>
    <a href="#">Grades</a>
  </div> -->
    
    <a href="logout.php"><i class="fa fa-window-close"></i> Logout</a>
</div>



<script>
/* Loop through all dropdown buttons to toggle between hiding and showing its dropdown content - This allows the user to have multiple dropdowns without any conflict */
var dropdown = document.getElementsByClassName("dropdown-btn");
var i;

for (i = 0; i < dropdown.length; i++) {
  dropdown[i].addEventListener("click", function() {
    this.classList.toggle("active");
    var dropdownContent = this.nextElementSibling;
    if (dropdownContent.style.display === "block") {
      dropdownContent.style.display = "none";
    } else {
      dropdownContent.style.display = "block";
    }
  });
}
</script>