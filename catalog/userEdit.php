<?php
require_once 'functions.php';

if (!userIsLoggedIn()) { header("Location:/catalog/index.php"); }
/* Checking if the user is a admin. If not, it redirects to the index page. */
if (!userIsAdmin()) { header("Location:index.php"); }

require_once 'temp-header.php';
require_once 'temp-sidenav.php';
require_once 'temp-dashboard-header.php';

require_once 'config.php';
$usernameErr = $passwordErr = $verifyPasswordErr = $emailErr = $firstNameErr = $lastNameErr = $id_roleErr = "";
// definirea variabilelor pentru valorile din formular. Daca nu am stabili, la prima afisare a formularului ar da eroare
$username1 = $password1 = $verifyPassword1 = $email1 = $firstName1 = $lastName1 = $id_role1 = "";
//definirea valorii la eroarea principala. Daca intervine orice eroare la verificare formular, ii vom atribui o alta valoare
$error = 0;
$success = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username1 = sanitizare($_POST['username']);
    $password1 = md5(sanitizare($_POST['password']));
    $verifyPassword1 = md5(sanitizare($_POST['verifyPassword']));
    $id_role1 = sanitizare($_POST['id_role']);
    $email1 = sanitizare($_POST['email']);
    $firstName1 = sanitizare($_POST['firstName']);
    $lastName1 = sanitizare($_POST['lastName']);
// Verify Username
if (strlen($username1) < 3) {
    $usernameErr = "* username must be at least 3 characters long";
    $error++;
} 

if (!preg_match("/^[a-zA-Z0-9_]*$/", $username1)) {
    $usernameErr = "* only letters, numbers and underscore are accepted";
    $error++;
}

$query_ext = "SELECT * FROM `users` WHERE username = '$username1'";
$result_ext = mysqli_query($conn, $query_ext);
$rows_ext = mysqli_num_rows($result_ext);

if ($rows_ext > 0) {
    $usernameErr = "* username already exists";
    $error++;
}

// Verify Password
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

// Verify Email
if (!preg_match('/^[a-zA-Z0-9\+_\-\.]+@+[a-zA-Z]+.+[a-zA-Z]$/i', $email1)) {
    $emailErr = "* not a valid email address; the format should be like this: xxx@yyy.zzz";
    $error++;
    }
}
if($error == 0)
{
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $uid = sanitizare($_POST['uid']);
    $username = sanitizare($_POST['username']);
    $password = md5(sanitizare($_POST['password']));
    $verifyPassword = md5(sanitizare($_POST['verifyPassword']));
    $id_role = sanitizare($_POST['id_role']);
    $email = sanitizare($_POST['email']);
    $firstName = sanitizare($_POST['firstName']);
    $lastName = sanitizare($_POST['lastName']);

    $query = "UPDATE `users` SET `username` = '$username', `password` = '$password', `email` = '$email', `id_role` = $id_role, `last_name` = '$lastName', `first_name` = '$firstName' WHERE `id_user` = $uid";
    $result = mysqli_query($conn, $query);

    $back = "userEdit.php?uid=" . $uid;
    if ($result) {     
        header("Location:" . $back);
    }

    header("Location:" . $back);
}
    $uid = sanitizare($_GET['uid']);
    $sql = "SELECT * FROM users WHERE id_user = $uid";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);

}
else 
{
    //TODO: should show errors
    $uid = sanitizare($_POST['uid']);
    $back = "userEdit.php?uid=" . $uid;
    header("Location:" . $back);
}

?>
	
<div class="container">
    <div class="row">
        <div class="col">
            <h4>Update User</h4>

            <form class="m-1 bg-light p-5" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>">
                <input type="hidden" name="uid" value='<?php echo sanitizare($_GET['uid']) ?>'>

                <label for="username">Username:</label>
                <div class="input-group input-container">
                    <span class="input-group-text" id="basic-addon1"><i class="fa fa-user"></i></span>
					<input type="username" name="username" class="form-control" placeholder="Username" value="<?php echo $row['username']; ?>" required>
                    <span class="error"><?php echo $usernameErr; ?></span>
                </div>  

                <label for="password">Password:</label>
                <div class="input-group input-container">
                    <span class="input-group-text" id="basic-addon1"><i class="fa fa-key"></i></span>
                    <input type="password" name="password" class="form-control input-field" placeholder="Password" id="inputPassword" value="<?php echo md5($row['password']); ?>" required>
					<span class="error"><?php echo $passwordErr; ?></span>
                </div>

                <label for="verifyPassword">Verify Password:</label>
				<div class="input-group input-container">
					<span class="input-group-text" id="basic-addon1"><i class="fa fa-key"></i></span>
					<input type="password" name="verifyPassword" class="form-control input-field" id="inputVerifyPassword" placeholder="Verify Password" value="<?php echo md5($row['password']); ?>" required>
					<span class="error"><?php echo $verifyPasswordErr; ?></span>
				</div>

                <label for="id_role">Role:</label>
                <div class="input-group input-container">
                    <span class="input-group-text" id="basic-addon1"><i class="fa fa-user"></i></span>

                    <select class="form-select" aria-label="Default select example" name="id_role">
                        <?php if (userIsSysAdmin()) { ?><option value="2" <?php if ($row['id_role'] == 2) { echo 'selected'; } ?>>Admin</option><?php } ?>
                        <option value="3" <?php if ($row['id_role'] == 3) { echo 'selected'; } ?>>Profesor</option>
                        <option value="4" <?php if ($row['id_role'] == 4) { echo 'selected'; } ?>>Student</option>
                    </select>
                </div>

                <label for="email">Email:</label>
				<div class="input-group input-container">
					<span class="input-group-text" id="basic-addon1"><i class="fa fa-envelope"></i></span>
					<input type="text" name="email" class="form-control input-field" id="inputEmail" placeholder="Email" value="<?php echo $row['email']; ?>" required>
                    <span class="error"><?php echo $emailErr; ?></span>
				</div>

                <label for="firstName">First Name:</label>
				<div class="input-group input-container">
                    <span class="input-group-text" id="basic-addon1"><i class="fa fa-user"></i></span>
					<input type="text" name="firstName" class="form-control" id="inputFirstName" placeholder="First Name" value="<?php echo $row['first_name']; ?>" required>
                    <span class="error"><?php echo $firstNameErr; ?></span>
                </div>

                <label for="lastName">Last Name:</label>
				<div class="input-group input-container">
                    <span class="input-group-text" id="basic-addon1"><i class="fa fa-user"></i></span>
					<input type="text" name="lastName" class="form-control" id="inputLastName" placeholder="Last Name" value="<?php echo $row['last_name']; ?>" required>
                    <span class="error"><?php echo $firstNameErr; ?></span>
                </div>

                <button type="submit" name="submit" class="btn btn-lg btn-success w-100">Update User</button>
            </form>
        </div>
    </div>   
</div>

<!-- Add spacing at bottom of page to make it look better. -->
<div class="mt-5"></div>

<?php require_once 'temp-footer.php'; ?>