<?php
/**
 * It takes a string, trims it, strips slashes, and converts special characters to HTML entities
 * 
 * @param string The string to be sanitized.
 * 
 * @return the sanitized string.
 */
function sanitizare($string) {
    $string=trim($string);
    $string=stripslashes($string);
    $string=htmlspecialchars($string);

    return $string;
}

/**
 * It returns the value of the key in the method array, or an empty string if the key doesn't exist
 * 
 * @param method The method used to send the data to the server.
 * @param key The key of the parameter you want to get.
 * 
 * @return The value of the key in the method array.
 */
function getData($method,$key) {
	$value="";

	if(isset($method["$key"]))
		$value=htmlentities($method["$key"]);

	return $value;
}

/**
 * If the session is valid and the username is set, return true. Otherwise, return false.
 * 
 * @return A boolean value.
 */
function userIsLoggedIn() {
    session_start();
    
    if (isset($_SESSION["valid"]) && isset($_SESSION["Username"])) {
        return true;
    }

    return false;
}
?>
