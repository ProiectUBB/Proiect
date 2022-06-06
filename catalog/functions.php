<?php
function sanitizare($string)
{
$string=trim($string);
$string=stripslashes($string);
$string=htmlspecialchars($string);
return $string;
}

function getData($method,$key){
	$value="";
	if(isset($method["$key"]))
		$value=htmlentities($method["$key"]);
	return $value;
}

function userIsLoggedIn() {
    session_start();
    
    if (isset($_SESSION["valid"]) && isset($_SESSION["Username"])) {
        return true;
    }

    return false;
}
?>
