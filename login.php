<!DOCTYPE html>
<html>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
body {font-family: Arial, Helvetica, sans-serif;
background-color:  #3366cc}

.navbar {
  width: 100%;
  background-color:  #3366cc;
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

.login{
    background-color: white;
    float: center;
    padding: 100px;
    margin-left:430px;
    margin-right: 430px;
    height: 180px;
    display: center;
    color: #000066;
    border: 3px solid #000066;
    text-align: center;
   
  
}

.submit_login{
    background-color: #000066;
    color: white;
    height: 30px;
    width:60px;
    border: white;
}

.input_username{
    background-color: white;
    color: white;
    height: 21px;
    width:177px;
    border: 1px solid #000066;
}

.input_password{
    background-color: white;
    color: white;
    height: 21px;
    width:177px;
    border: 1px solid #000066;
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
  <a href='index.php'><i class="fa fa-fw fa-home"></i> Home</a> 
  <a class="active" href='login.php' target='_self'><i class="fa fa-fw fa-user"></i>Log in</a>"
  <a href="contact.php"><i class="fa fa-fw fa-envelope"></i> Contact</a> 
</div>

</body>
</html> 


<?php
$servername="localhost";
$username="root";
$password="";
$dbname="userapp";
$tbname="utilizatori";
//creare conexiune
$conn=mysqli_connect($servername,$username,$password,$dbname);
//verificare conexiune
if (!$conn) die ("Connection failed: " . mysqli_connect_error());
//echo "Connected successfully"."</br>";

if ($_SERVER["REQUEST_METHOD"]=="POST")
{
$utilizator=htmlentities($_POST['utilizator']);
$parola=htmlentities($_POST['parola']);
$query="SELECT * FROM $tbname WHERE username='$utilizator' AND parola='$parola'";
$result=mysqli_query($conn,$query);
if ($result) {
echo "Bine ai revenit!";
} else {
echo "Error: ". $query. "<br>" .mysqli_error($conn);
}
exit();
}
?>







<div >
    
  <div class="login">
<form method="post" action="<?php $_SERVER['PHP_SELF'] ?>" target="_self" enctype="multipart/form-data">
Username</br>
<input class="input_username" type="text" id="string" name="utilizator"></br></br></br>
Parola</br>
<input class="input_password" type="text" id="string" name="parola"></br></br></br></br>
<input class="submit_login" type="submit" name="submit" value="Log in"></br>
</form>
<div>
   
</div>