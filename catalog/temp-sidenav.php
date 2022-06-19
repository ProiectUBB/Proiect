<?php 
require_once 'functions.php'; 

if (!userIsLoggedIn()) { header("Location:index.php"); }
?>

<div class="sidenav">
  <a href="home.php"><i class="fa fa-fw fa-home"></i>  Home</a> 

  <a href="user.php"><i class="fa fa-address-card"></i>  Account</a>

  <?php if (userIsAdmin()) { ?>
    <a href="users.php"><i class="fa fa-users"></i>  Users</a>

    <a href="cursuri.php"><i class="fa fa-book"></i>  Cursuri</a>
  <?php } ?>

  <a href="myClasses.php"><i class="fa fa-chalkboard"></i>  My Classes</a>

  <a href="https://calendar.google.com/calendar/u/0/r"><i class="fa fa-calendar-minus-o"></i> Calendar</a>

  <a href="logout.php"><i class="fa fa-window-close"></i> Logout</a>
</div> <!-- end sidenav -->