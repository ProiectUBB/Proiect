<?php 
require_once 'functions.php'; 

if (!userIsLoggedIn()) { header("Location:index.php"); }
?>

<div class="sidenav">
  <img src="images/slogo.png" class="img-fluid rounded-top mx-5" alt="" width="50%">
  <h4 class="mx-3">Sunset University</h4>
  <strong class="mx-5">Doctrina Perpetua</strong>

  <hr width="50%" class="mx-5 bg-light">

  <a href="home.php"><i class="fa fa-fw fa-home"></i>  Home</a> 

  <a href="user.php"><i class="fa fa-address-card"></i>  Account</a>

  <?php if (userIsAdmin()) { ?>
    <a href="users.php"><i class="fa fa-users"></i>  Users</a>

    <a href="classes.php"><i class="fa fa-book"></i>  Manage Classes</a>
  <?php } ?>

  <a href="myClasses.php"><i class="fa fa-chalkboard"></i>  My Classes</a>

  <a href="calendar.php"><i class="fa fa-calendar-minus-o"></i> Calendar</a>

  <a href="logout.php"><i class="fa fa-window-close"></i> Logout</a>
</div> <!-- end sidenav -->