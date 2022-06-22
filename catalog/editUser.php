<?php
require_once 'header.php';

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
}

//edit a user
if(isset($_POST['submit'])) {
	$id_user = $_POST['id_user'];
	$username = $_POST['username'];
	$id_role = $_POST['id_role'];
	$last_name = $_POST['last_name'];
	$first_name = $_POST['first_name'];
	$email = $_POST['email'];

	$sql = "UPDATE users SET username = '$username', email = '$email', id_role = '$id_role', last_name = '$last_name', first_name = '$first_name' WHERE id_user = '$id_user'";
	$result = mysqli_query($conn,$sql);
	if ($result) {
		header("Location:users.php");
	} else {
		echo "Error: " . $sql . "<br>" . mysqli_error($conn);
	}
}
 ?>
	

<div class="container-fluid">
    <div class="row p-5 justify-content-center">
        <div class="col-4">
		<form action="editUser.php" method="POST" class="col-6 mx-auto" >
					<h4>Edit User</h4>
					<div class="form-group">
						<label>Username</label>
						<input type="text" class="form-control" name="username" value=""> 
						<input type="text" class="form-control" name="id_user" value="<?php echo $_GET['idUser']?>">
					</div>
					<div class="form-group">
						<label>Role</label>
						<input type="text" class="form-control" name="id_role">
					</div>
					<div class="form-group">
						<label>First name</label>
						<input type="text" class="form-control" name="first_name">
					</div>
					<div class="form-group">
						<label>Last name</label>
							<input type="text" class="form-control" name="last_name">
					</div>
					<div class="form-group">
						<label>Email</label>
						<input type="text" class="form-control" name="email">
					</div>
					<div class="d-flex mx-auto justify-content-center pt-4">
						<a href="users.php" target="users.php"><input type="button" class="btn btn-warning" value="Cancel"></a>
						<input type="submit" class="btn btn-success" name= "submit" value="Save">
					</div>
            </form> <!-- End of form -->
        </div> <!-- End of col-4 -->
    </div> <!-- End of row -->
</div> <!-- End of container-fluid -->