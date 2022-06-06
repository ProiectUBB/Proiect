<?php
require_once 'functions.php';

if (!userIsLoggedIn()) { header("Location:/catalog/index.php"); }
if ($_SESSION['idRol'] != 1) { header("Location:/catalog/index.php"); }

require_once 'config.php';

$userId = $_GET['idUser'];
// echo "am intrat in delete";
// echo "id ul userului e ".$userId;


//write a query that deletes the student by the given student ID
$sql1 = "DELETE FROM users WHERE id_user = $userId";
$result1=mysqli_query($conn,$sql1);

if($result1){
    header("Location: " . $_SERVER['HTTP_REFERER']);
    exit();
}else{
    echo "nu s-au sters";
    die(mysqli_error($conn));
}

exit();
?>