<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- Add icon library -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="css/login.css">


</head>

</html>

<?php
require_once 'header.php';
$usererr=$parolaerr="";
$user=$parola="";
$idRol=0;
$eroare=0;


if ($_SERVER["REQUEST_METHOD"]=="POST"){

	$user=sanitizare($_POST["user"]);
	$parola=sanitizare($_POST["password"]);



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
	  $parolaerr="Parola este obligatorie!";
	  $eroare=1;
	}

	if ($eroare==0) {
	  $sql = "SELECT idRol, username, parola FROM utilizatori WHERE username='$user' AND parola='$parola'";

		$result = mysqli_query($conn, $sql);

		if (mysqli_num_rows($result) > 0){

			$_SESSION['Username'] = $user;
			$_SESSION['Password'] = $parola;
			$_SESSION['idRol'] = $idRol;

			echo "Exista o sesiune activa pentru utilizatorul".$_SESSION['Username'];

			$sql1 = "SELECT id FROM utilizatori WHERE username='$user' AND parola='$parola'";
			$result1 = mysqli_query($conn, $sql);
			while($row = $result->fetch_assoc()) {
					$_SESSION['idRol'] = $row['idRol'];
					if ($row['idRol']==1){
							header("Location:student_home.php");
					}elseif ($row['idRol']==2) {
						header("Location:profesor_home.php");
					}elseif ($row['idRol']==3) {
						header("Location:admin_home.php");
					}

			 }
		  }

//pentru userul student


		} else{
			echo "<div class='container mt-4'>";
			echo "<div class='alert alert-danger'>Autentificare nereusita</div>";
		}

	}else {
	  echo mysqli_error($conn);
	}

?>

<form method="post" class="form" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" target="_self" enctype="multipart/form-data">

<h1>Login</h1>
<br>
<div class="input-container">
    <i class="fa fa-user icon"></i>
    <input type="text" class="input-field" name="user" placeholder="Username" value="<?php echo $user; ?>" lenght="40">
		<span class="error">* <?php echo $usererr;?></span><br><br>
  </div>

  <div class="input-container">
    <i class="fa fa-key icon"></i>
    <input type="password" class="input-field" name="password" placeholder="Password" value="<?php echo $parola; ?>" lenght="40">
		<span class="error">* <?php echo $parolaerr;?></span><br><br>
  </div>
  <button type="submit" class="btn">Login</button>
</form>
