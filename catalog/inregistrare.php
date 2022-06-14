<?php 
require_once 'temp-header.php';
require_once 'functions.php';

/* If the user is logged in, redirect to index.php */
if (userIsLoggedIn()) { header("Location: index.php"); }

// definirea valorilor pentru erori ca fiind goale. Altfel la prima afisare a formularului ar da o eroare
$usernameErr = $passwordErr = $verifyPasswordErr = $emailErr = $firstNameErr = $lastNameErr = "";

// definirea variabilelor pentru valorile din formular. Daca nu am stabili, la prima afisare a formularului ar da eroare
$username1 = $password1 = $verifyPassword1 = $email1 = $firstName1 = $lastName1 = "";

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

    /* It's a type casting. It's converting the value of `` to an integer. */
    $id_role1 = (int) $id_role1;

    require_once 'config.php';

    // Verify Username
    if (empty($username1)) {       
        $usernameErr = "* username is required";
        $GLOBALS['error'] = "xxx";
        $error++;
    } else {
        /* It's checking if the username is less than 3 characters long. If it is, it will display an
        error message. */
        if (strlen($username1) < 3) {
            $usernameErr = "* username must be at least 3 characters long";
            $error++;
        } 
        
        /* It's checking if the username is less than 3 characters long. If it is, it will display an
                error message. */
        if (!preg_match("/^[a-zA-Z0-9_]*$/", $username1)) {
            $usernameErr = "* only letters, numbers and underscore are accepted";
            $error++;
        }

        /* It's checking if the username already exists in the database. */
        $query = "SELECT * FROM `users` WHERE username = '$username1'";
        $result = mysqli_query($conn, $query);
        $rows = mysqli_num_rows($result);

        /* It's checking if the username already exists in the database. */
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
        /* It's checking if the password is less than 3 characters long. If it is, it will display an
        error message. If it's not empty, it will check if the password and the verify password are
        the same. If they are not, it will display an error message. */
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
        /* It's checking if the email is empty. If it is, it will display an error message. If it's not
        empty, it will check if the email is valid. If it's not, it will display an error message.
        It will also check if the email already exists in the database. If it does, it will display
        an error message. */
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
        /* It's checking if the first name is empty. If it is, it will display an error message. If
        it's not empty, it will check if the first name is valid. If it's not, it will display an error message. */
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
        /* It's checking if the last name is empty. If it is, it will display an error message. If it's
        not empty, it will check if the last name is valid. If it's not, it will display an
        error message. */
        $lastNameErr = "* first name is required";
        $error++;
    } else {
        if (!preg_match("/^[a-zA-Z]*$/", $lastName1)) {
            $lastNameErr = "* only letters are accepted";
            $error++;
        }
    }    

    if ($id_role1 == 0) {
      $id_role1 = 3;
    }

    // If no errors and everything is correct proceed to add user to db
    if ($error == 0) {
        /* It's inserting the values from the form into the database. */
        // $password1 = md5($password1);
        // $currentDate = date('Y-m-d');
        $query = "INSERT INTO `users`(`id_role`, `username`, `password`, `first_name`, `last_name`, `email`) VALUES ($id_role1, '$username1','$password1','$lastName1','$firstName1','$email1')";
        // echo $query;
        $result = mysqli_query($conn, $query);

        if ($result) {     
            $success = "user succesfully created";
            // header("Location: " . $_SERVER['HTTP_REFERER']);
        }
    }
}
?>

<header>
    <div class="container-fluid">
        <?php require_once 'temp-subheader.php'; ?>

        <?php require_once 'temp-mainnav.php'; ?>
    </div>
</header>

<div class="container-fluid">
    <div class="row p-5 justify-content-center">
        <div class="col-4">
            <h4>Inregistrare</h4>

            <?php if ($success) { ?>
        	<div class="alert alert-success" role="alert">
            <?php echo $success; ?>
        </div>
        <?php } ?>

            <form class="m-1 bg-light p-5" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" target="_self" enctype="multipart/form-data">
                <div class="input-group input-container">
                    <span class="input-group-text" id="basic-addon1"><i class="fa fa-user"></i></span>
					<input type="username" name="username" class="form-control" placeholder="Username" value="<?php if ($error != 0) echo $username1 ?>" >
                    <span class="error"><?php echo $usernameErr; ?></span>
                </div>

                <div class="input-group input-container">
                    <span class="input-group-text" id="basic-addon1"><i class="fa fa-key"></i></span>
                    <input type="password" name="password" class="form-control input-field" placeholder="Password" id="inputPassword" value="<?php if ($error != 0) echo $password1 ?>" >
					<span class="error"><?php echo $passwordErr; ?></span>
                </div>

				<div class="input-group input-container">
					<span class="input-group-text" id="basic-addon1"><i class="fa fa-key"></i></span>
					<input type="password" name="verifyPassword" class="form-control input-field" id="inputVerifyPassword" placeholder="Verify Password" value="<?php if ($error != 0) echo $verifyPassword1 ?>" >
					<span class="error"><?php echo $verifyPasswordErr; ?></span>
				</div>

				<div class="input-group input-container">
					<span class="input-group-text" id="basic-addon1"><i class="fa fa-envelope"></i></span>
					<input type="text" name="email" class="form-control input-field" id="inputEmail" placeholder="Email" value="<?php if ($error != 0) echo $email1 ?>" >
                    <span class="error"><?php echo $emailErr; ?></span>
				</div>

				<div class="input-group input-container">
                    <span class="input-group-text" id="basic-addon1"><i class="fa fa-user"></i></span>
					<input type="text" name="firstName" class="form-control" id="inputFirstName" placeholder="First Name" value="<?php if ($error != 0) echo $firstName1 ?>" >
                    <span class="error"><?php echo $firstNameErr; ?></span>
                </div>

				<div class="input-group input-container">
                    <span class="input-group-text" id="basic-addon1"><i class="fa fa-user"></i></span>
					<input type="text" name="lastName" class="form-control" id="inputLastName" placeholder="Last Name" value="<?php if ($error != 0) echo $firstName1 ?>" >
                    <span class="error"><?php echo $firstNameErr; ?></span>
                </div>

                <button type="submit" class="btn btn-lg btn-success">Inregistrare</button>
            </form>
        </div>

		<div class="border-top mt-3 pt-3 text-center">
            <small class="text-muted">
                <p>Already have an Account? <a href="login.php" class="ml-2">Login</a></p>
            </small>
        </div>
    </div>   
</div>

<?php require_once 'temp-footer.php'; ?>