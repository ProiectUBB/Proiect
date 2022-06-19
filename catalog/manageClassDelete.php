<?php
require_once 'functions.php';

/* If the user is not logged in, it redirects to the index page. */
if (!userIsLoggedIn()) { header("Location:/catalog/index.php"); }

require_once 'config.php';

/* Sanitizing the input from the user. */
$subClassId = sanitizare($_GET['idSubClass']);
$subClassType = sanitizare($_GET['type']);

/* Deleting the seminar or laboratory with the id that is passed as a parameter. */
if (isset($subClassType) && !empty($subClassType) && $subClassType == 'sem') {
    /* Deleting the seminar with the id that is passed as a parameter. */
    if (isset($subClassId) && !empty($subClassId)) {
        $sql = "DELETE FROM seminar WHERE id_seminar = $subClassId";
        $result = mysqli_query($conn,$sql);

        if ($result) {
            header("Location: " . $_SERVER['HTTP_REFERER']);
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    } else {
        header("Location: " . $_SERVER['HTTP_REFERER']);
    }
} else if (isset($subClassType) && !empty($subClassType) && $subClassType == 'lab') {
    /* It deletes the laboratory with the id that is passed as a parameter. */
    if (isset($subClassId) && !empty($subClassId)) {
        $sql = "DELETE FROM laboratory WHERE id_laboratory = $subClassId";
        $result = mysqli_query($conn,$sql);

        if ($result) {
            header("Location: " . $_SERVER['HTTP_REFERER']);
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    } else {
        header("Location: " . $_SERVER['HTTP_REFERER']);
    }
}

/* It stops the execution of the script. */
exit();
?>