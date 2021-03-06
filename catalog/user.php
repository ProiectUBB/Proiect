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
    
    /* Selecting the username, email, first name, last name, registration date, and role name from the
    users table and the roles table. It is joining the two tables on the id_role column. It is also
    filtering the results to only show the user that is logged in. */
    $sql = "SELECT u.username, u.email, u.first_name, u.last_name, u.reg_date, r.role_name FROM users u JOIN roles r ON u.id_role = r.id_role WHERE username='".$_SESSION['Username']."'";
    $result = $conn -> query($sql);
    $row = $result -> fetch_row();
    
    echo 'Username: ' . $row[0] . '<br>';  
    echo 'Email: ' . $row[1] . '<br>';  
    echo 'First Name: ' . $row[2] . '<br>';  
    echo 'Last Name: ' . $row[3] . '<br>';  
    echo 'Role: ' . $row[5] . '<br>';  
    echo 'Regitration date: ' . $row[4] . '<br>';  

    if (userIsStudent()) {
      $sql = "SELECT c.class_name FROM users_classes uc JOIN classes c ON uc.id_class = c.id_class WHERE uc.id_user = ". $_SESSION['id_user'];
      $result = $conn->query($sql);
      $num_rows = mysqli_num_rows($result);

      if ($num_rows > 0) {
        echo '<br />You are registered to the following classes:<br />';
        echo '<ol>';
        while($row = $result->fetch_assoc()) {
          echo '<li>'. $row['class_name'] .'</li>';
        }
        echo '<ol>';
      } else {
        echo 'No classes registered.';
      }
      
    }
?>
    </div> <!-- end col -->
  </div>  <!-- end row -->
</div> <!-- end container -->

<!-- Add spacing at bottom of page to make it look better. -->
<div class="mt-5"></div> 

<?php require_once 'temp-footer.php'; ?>

