<?php
require_once 'functions.php';

/* It checks if the user is logged in. If not, it redirects to the login page. */
if (!userIsLoggedIn()) { header("Location:/catalog/index.php"); }
/* Checking if the user is a admin. If not, it redirects to the index page. */
if (!userIsAdmin()) { header("Location:index.php"); }

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

    /* It redirects the user to the `classes.php` page. */
    header("Location:classes.php");
} else {
    /* It redirects the user to the `classes.php` page. */
    header("Location:classes.php");
}

/* It redirects the user to the `classes.php` page. */
header("Location:classes.php");

exit();
?>