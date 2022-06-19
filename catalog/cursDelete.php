<?php
require_once 'functions.php';

/* It checks if the user is logged in. If not, it redirects to the login page. */
if (!userIsLoggedIn()) { header("Location:/catalog/index.php"); }

require_once 'config.php';

/* It gets the class id from the url. */
$classId = $_GET['cid'];

if (isset($classId) && !empty($classId)) {
    /* It deletes the class from the database. */
    $sql = "DELETE FROM users_classes WHERE id_class = $classId";
    $result = mysqli_query($conn,$sql);

    /* It deletes the class from the database. */
    if ($result) {
        $sql2 = "DELETE FROM classes WHERE id_class = $classId";
        $result2 = mysqli_query($conn,$sql2);
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }

    /* It redirects the user to the `cursuri.php` page. */
    header("Location:cursuri.php");
} else {
    /* It redirects the user to the `cursuri.php` page. */
    header("Location:cursuri.php");
}

/* It redirects the user to the `cursuri.php` page. */
header("Location:cursuri.php");

exit();
?>