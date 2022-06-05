<?php
require 'header.php';

$userId = $_GET['idUser'];
echo "am intrat in delete";
echo "id ul userului e ".$userId;


//write a query that deletes the student by the given student ID
$sql1 = "DELETE FROM users WHERE id_user = $userId";
$result1=mysqli_query($conn,$sql1);

if($result1){
  header("Location: http://localhost/Proiect11/catalog/users3.php"); /* Redirect browser */
  exit();
  }else{
    echo "nu s-au sters";
    die(mysqli_error($conn));

  }
exit();

?>
