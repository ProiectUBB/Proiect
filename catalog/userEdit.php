<?php
require_once 'functions.php';

if (!userIsLoggedIn()) { header("Location:/catalog/index.php"); }
/* Checking if the user is a admin. If not, it redirects to the index page. */
if (!userIsAdmin()) { header("Location:index.php"); }

require_once 'temp-header.php';
require_once 'temp-sidenav.php';
require_once 'temp-dashboard-header.php';

require_once 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $uid = sanitizare($_POST['uid']);
    $username = sanitizare($_POST['username']);
    $password = sanitizare($_POST['password']);
    $verifyPassword = sanitizare($_POST['verifyPassword']);
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
                    <input type="password" name="password" class="form-control input-field" placeholder="Password" id="inputPassword" value="<?php echo $row['password']; ?>" required>
					<span class="error"><?php echo $passwordErr; ?></span>
                </div>

                <label for="verifyPassword">Verify Password:</label>
				<div class="input-group input-container">
					<span class="input-group-text" id="basic-addon1"><i class="fa fa-key"></i></span>
					<input type="password" name="verifyPassword" class="form-control input-field" id="inputVerifyPassword" placeholder="Verify Password" value="<?php echo $row['password']; ?>" required>
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