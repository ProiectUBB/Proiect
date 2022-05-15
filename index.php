
<!DOCTYPE html>
<html>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
body {font-family: Arial, Helvetica, sans-serif; background-color:  #3366cc;}

.navbar {
  width: 100%;
  background-color: #3366cc;
  overflow: auto;
}

.navbar a {
  float: left;
  padding: 12px;
  color: white;
  text-decoration: none;
  font-size: 17px;
}

.navbar a:hover {
  background-color: #000;
}

.active {
  background-color: #000066;
}

@media screen and (max-width: 500px) {
  .navbar a {
    float: none;
    display: block;
  }
}
</style>
<body>
<div class="navbar">
  <a class="active" href="#"><i class="fa fa-fw fa-home"></i> Home</a> 
  <a href='login.php' target='_self'><i class="fa fa-fw fa-user"></i>Log in</a>"
  <a href="contact.php"><i class="fa fa-fw fa-envelope"></i> Contact</a> 
</div>

</body>
</html> 



<?php


echo "Bine ai venit!!"."</br>";
//echo "<a href='inregistrare.php' target='_self'>Inregistrare</a>"."</br>";
//echo "Pentru a te reintoarce la pagina anterioara apasa "."<a href='index.php' target='_self'>aici</a>"."</br>";
exit();

?>

