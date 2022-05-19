<style>.error {color:#FF0000;}</style>
<?php

require 'header.php';

$usererr=$parolaerr="";
$user=$parola="";
$eroare=0;

$table_name = "utilizatori";

if ($_SERVER["REQUEST_METHOD"]=="POST") {
$user=sanitizare($_POST["user"]);
$parola=sanitizare($_POST["password1"]);
$verificare_parola=sanitizare($_POST["password2"]);

	if (empty($_POST["user"])) {
		$usererr="Utilizatorul este obligatoriu";
		$eroare=1;
	}
	else {
		$user=sanitizare($_POST["user"]);
		if (!preg_match("/^[a-zA-Z0-9 ]*$/",$user)) {
		$usererr="Numai litere, cifre si spatii sunt acceptate";
		$eroare=1;
		}
	}

	if (empty($_POST["password1"])) {
		$parolaerr="Parola este obligatorie";
		$eroare=1;
	}
	else {
		if (empty($_POST["password2"])) {
			$parolaerr="Verificare parola este obligatorie";
			$eroare=1;
		}
		else {
			if ($_POST["password1"]!=$_POST["password2"]) {
				$parolaerr="Parola nu se potriveste";
				$eroare=1;
			}
		}
	}

	//poza

	if ($eroare==0) {
		$query="INSERT INTO $table_name (username,parola)
		VALUES ('$user','$parola')";
		$result=mysqli_query($conn,$query);
		if ($result) {
			echo "New user created successfully!";
		}else {
			echo "Error: " . $query. "<br>" .mysqli_error($conn);
		}
		exit();
	}
}

?>
<?php
	echo date("Y-m-d H:i:s");
?>


<form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" target="_self" enctype="multipart/form-data"><br><br>

	User:<input type="text" name="user" value="<?php echo $user; ?>" lenght="40">
	<span class="error">* <?php echo $usererr;?></span><br><br>

	Parola:<input type="password" name="password1" value="<?php echo $parola; ?>" lenght="40">
	<span class="error">* <?php echo $parolaerr;?></span><br><br>

	Verificare Parola:<input type="password" name="password2" value="<?php echo $verificare_parola; ?>" lenght="40">
	<span class="error">* <?php echo $parolaerr;?></span><br><br>

	<input type="submit" name="submit" value="Submit"><br><br>

  <input type="button" onclick="location.href='index.php';" value="Inapoi" />

</form>
