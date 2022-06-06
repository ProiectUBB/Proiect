<?php
require_once 'functions.php';

if (!userIsLoggedIn()) { header("Location:index.php"); }

require_once 'temp-header.php';
require_once 'temp-sidenav.php';
?>
<div class="container">
  <div class="row">
    <div class="col">

<?php 
    require_once 'config.php';
    
    $sql = "SELECT u.username, u.email, u.first_name, u.last_name, r.role_name FROM users u JOIN roles r ON u.id_role = r.id_role WHERE username='".$_SESSION['Username']."'";
    $result = $conn -> query($sql);
    $row = $result -> fetch_row();
    
    echo 'Username: ' . $row[0] . '<br>';  
    echo 'Email: ' . $row[1] . '<br>';  
    echo 'First Name: ' . $row[2] . '<br>';  
    echo 'Last Name: ' . $row[3] . '<br>';  
    echo 'Role: ' . $row[4] . '<br>';  
?>
    </div>
  </div>  
</div>

<?php require_once 'temp-footer.php'; ?>

