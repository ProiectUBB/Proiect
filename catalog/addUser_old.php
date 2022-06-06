<?php
require 'header.php';

if ($_SERVER["REQUEST_METHOD"]=="POST") {

  if(isset($_POST['submit'])){
    $id_role=$_POST['id_role'];
    $username=$_POST['username'];
    $password=$_POST['password'];
    $first_name=$_POST['first_name'];
    $last_name=$_POST['last_name'];
    $email=$_POST['email'];

    echo $username;

    $sql="INSERT INTO  users (id_role, username, password, first_name, last_name, email)
    VALUES ('".$id_role."','".$username."','".$password."','".$first_name."','".$last_name."','".$email."')";
    $result=mysqli_query($conn,$sql);

    if($result){
      header("Location: http://localhost/Proiect11/catalog/users3.php"); /* Redirect browser */
      exit();
    }else{
      die(mysqli_error($conn));
    }
    exit();

  }
}
 ?>
