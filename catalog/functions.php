<?php
    session_start();
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
    if (isset($_SESSION["valid"]) && isset($_SESSION["Username"])) {
        return true;
    }

    return false;
}

/**
 * If the user is logged in and the user's role is 1, then the user is a system administrator.
 */
function userIsSysAdmin() {
    if (isset($_SESSION["valid"]) && isset($_SESSION["idRol"]) && $_SESSION["idRol"] == 1) {
        return true;
    }

    return false;
}

/**
 * If the user is logged in and has a role of 2 or less, then they are an admin.
 * 
 * @return A boolean value.
 */
function userIsAdmin() {
    if (isset($_SESSION["valid"]) && isset($_SESSION["idRol"]) && $_SESSION["idRol"] <= 2) {
        return true;
    }

    return false;
}

/**
 * If the user is logged in and has a role of 3 or less, then they are a teacher.
 * 
 * @return A boolean value.
 */
function userIsTeacher() {
    if (isset($_SESSION["valid"]) && isset($_SESSION["idRol"]) && $_SESSION["idRol"] <= 3) {
        return true;
    }

    return false;
}

/**
 * If the user is logged in and has a role of 4 or less, then the user is a student.
 * 
 * @return A boolean value.
 */
function userIsStudent() {
    if (isset($_SESSION["valid"]) && isset($_SESSION["idRol"]) && $_SESSION["idRol"] <= 4) {
        return true;
    }

    return false;
}
?>
