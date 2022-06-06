<?php 
require_once 'temp-header.php';
require_once 'functions.php';


if (userIsLoggedIn()) {
    header("Location: index.php");
    // echo "user is logged in";
}

$usererr=$pswerr=$userPassErr="";
$user=$psw="";
$idRol=0;
$eroare=0;


if ($_SERVER["REQUEST_METHOD"]=="POST") {
	$user=sanitizare($_POST["user"]);
	$psw=sanitizare($_POST["password"]);

    require_once 'config.php';

//Validare 
	if (empty($_POST["user"])) {
        $usererr="Utilizatorul este obligatoriu!";
	    $eroare=1;
	} else {
	    $user=sanitizare($_POST["user"]);

	    if (!preg_match("/^[a-zA-Z0-9 ]*$/",$user)) {
	        $usererr="Username poate contine numai litere, cifre si spatii libere!";
	        $eroare=1;
	    }
	}
    
    if (empty($_POST["password"])) {
	    $pswerr="Parola este obligatorie!";
	    $eroare=1;
	}

	if ($eroare==0) {
	    // $sql = "SELECT * FROM `users` WHERE username='$user' and password='$psw'";
        $sql = "SELECT id_user, id_role, username, password FROM users WHERE username='$user' AND password='$psw'";

		$result = mysqli_query($conn, $sql);

		if (mysqli_num_rows($result) > 0){
            session_start();

            $_SESSION["valid"] = true;
			$_SESSION['Username'] = $user;
			$_SESSION['Password'] = $psw;
			$_SESSION['idRol'] = $idRol;

            header("Location:index.php");

			echo "Exista o sesiune activa pentru utilizatorul".$_SESSION['Username'];

			while($row = $result->fetch_assoc()) {
                $_SESSION['idRol'] = $row['id_role'];

                if ($row['id_role']==1){
                    header("Location:sys_admin_home.php");
                }elseif ($row['id_role']==2) {
                    header("Location:admin_home.php");
                }elseif ($row['id_role']==3) {
                    header("Location:student_home.php");
                }elseif ($row['id_role']==4) {
                    header("Location:profesor_home.php");
                }
            }
        } else {
            $userPassErr = "Utilizatorul sau psw sunt incorecte!";
            $eroare++;
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
            <h4>Login</h4>

            <?php if ($userPassErr) { ?>
            <div class="alert alert-danger" role="alert">
            <?php echo $userPassErr; ?>
        </div>
        <?php } ?>

            <form class="m-1 bg-light p-5" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" target="_self" enctype="multipart/form-data">
                <div class="input-group input-container">
                    <span class="input-group-text" id="basic-addon1"><i class="fa fa-user"></i></span>
                    <input type="text" class="form-control input-field" name="user" placeholder="Username" value="<?php echo $user; ?>">
                    <span class="error">* <?php echo $usererr;?></span>
                </div>

                <div class="input-group input-container">
                    <span class="input-group-text" id="basic-addon1"><i class="fa fa-key"></i></span>
                    <input type="password" class="form-control input-field" name="password" placeholder="Password" value="<?php echo $psw; ?>">
                    <span class="error">* <?php echo $pswerr;?></span>
                </div>

                <button type="submit" class="btn btn-lg btn-success">Login</button>
            </form>
        </div>
    </div>   
</div>

<?php require_once 'temp-footer.php'; ?>