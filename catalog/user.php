<?php
require_once 'functions.php';

if (!userIsLoggedIn()) { header("Location:index.php"); }

require_once 'temp-header.php';
require_once 'temp-sidenav.php';
require_once 'temp-dashboard-header.php';
?>
<div class="container">
  <div class="row">
    <div class="col">
    <h2>Cont</h2>
<?php 
    require_once 'config.php';
    
    $sql = "SELECT u.username, u.email, u.first_name, u.last_name, u.reg_date, r.role_name FROM users u JOIN roles r ON u.id_role = r.id_role WHERE username='".$_SESSION['Username']."'";
    $result = $conn -> query($sql);
    $row = $result -> fetch_row();
    
    echo 'Username: ' . $row[0] . '<br>';  
    echo 'Email: ' . $row[1] . '<br>';  
    echo 'First Name: ' . $row[2] . '<br>';  
    echo 'Last Name: ' . $row[3] . '<br>';  
    echo 'Role: ' . $row[5] . '<br>';  
    echo 'Regitration date: ' . $row[4] . '<br>';  
?>
    </div>
  </div>  
</div>

<!-- Add spacing at bottom of page to make it look better. -->
<div class="mt-5"></div> 

<?php require_once 'temp-footer.php'; ?>

