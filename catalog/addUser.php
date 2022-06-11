<?php
require_once 'functions.php';

// definirea valorilor pentru erori ca fiind goale. Altfel la prima afisare a formularului ar da o eroare
$usernameErr = $passwordErr = $verifyPasswordErr = $emailErr = $firstNameErr = $lastNameErr = $id_roleErr = "";

// definirea variabilelor pentru valorile din formular. Daca nu am stabili, la prima afisare a formularului ar da eroare
$username1 = $password1 = $verifyPassword1 = $email1 = $firstName1 = $lastName1 = $id_role1 = "";

//definirea valorii la eroarea principala. Daca intervine orice eroare la verificare formular, ii vom atribui o alta valoare
$error = 0;
$success = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get variables
    $username1 = sanitizare($_POST['username']);
    $password1 = sanitizare($_POST['password']);
    $verifyPassword1 = sanitizare($_POST['verifyPassword']);
    $email1 = sanitizare($_POST['email']);
    $firstName1 = sanitizare($_POST['firstName']);
    $lastName1 = sanitizare($_POST['lastName']);
    $id_role1 = sanitizare($_POST['id_role']);

    $id_role1 = (int) $id_role1;

    require_once 'config.php';

    // Verify Username
    if (empty($username1)) {       
        $usernameErr = "* username is required";
        $error++;
    } else {
        if (strlen($username1) < 3) {
            $usernameErr = "* username must be at least 3 characters long";
            $error++;
        } 
        
        if (!preg_match("/^[a-zA-Z0-9_]*$/", $username1)) {
            $usernameErr = "* only letters, numbers and underscore are accepted";
            $error++;
        }


        $query = "SELECT * FROM `users` WHERE username = '$username1'";
        $result = mysqli_query($conn, $query);
        $rows = mysqli_num_rows($result);

        if ($rows > 0) {
            $usernameErr = "* username already exists";
            $error++;
        }
    }

    // Verify Password
    if (empty($password1)) {   
        $passwordErr = "* password is required";
        $error++;
    } else {
        if (strlen($password1) < 2) {
            $passwordErr = "* password must be at least 3 characters long";
            $error++;
        } else {
            if (empty($verifyPassword1)) {
                $verifyPasswordErr = "* verify password is required";
                $error++;
            } else {
                if ($password1 != $verifyPassword1){
                    $verifyPasswordErr = "* passwords does not match";
                    $error++;
                }
            }
        }
    }

    // Verify Email
    if (empty($email1)) {       
        $emailErr = "* email is required";
        $error++;
    } else {
        if (!preg_match('/^[a-zA-Z0-9\+_\-\.]+@+[a-zA-Z]+.+[a-zA-Z]$/i', $email1)) {
            $emailErr = "* not a valid email address; the format should be like this: xxx@yyy.zzz";
            $error++;
        }

        $query = "SELECT * FROM `users` WHERE email = '$email1'";
        $result = mysqli_query($conn, $query);
        $rows = mysqli_num_rows($result);

        if ($rows > 0) {
            $emailErr = "* email already exists";
            $error++;
        }
    }

    // Verify First Name
    if (empty($firstName1)) {       
        $firstNameErr = "* first name is required";
        $error++;
    } else {
        if (!preg_match("/^[a-zA-Z]*$/", $firstName1)) {
            $firstNameErr = "* only letters are accepted";
            $error++;
        }
    }

    // Verify Last Name
    if (empty($lastName1)) {       
        $lastNameErr = "* first name is required";
        $error++;
    } else {
        if (!preg_match("/^[a-zA-Z]*$/", $lastName1)) {
            $lastNameErr = "* only letters are accepted";
            $error++;
        }
    }    

    // If no errors and everything is correct proceed to add user to db
    if ($error == 0) {
        // $password1 = md5($password1);
        // $currentDate = date('Y-m-d');
        $query = "INSERT INTO `users`(`id_role`, `username`, `password`, `first_name`, `last_name`, `email`) VALUES ($id_role1, '$username1','$password1','$lastName1','$firstName1','$email1')";
        // echo $query;
        $result = mysqli_query($conn, $query);

        if ($result) {     
            $success = "user succesfully created";
            header("Location: " . $_SERVER['HTTP_REFERER']);
        }
    }
}
 ?>
