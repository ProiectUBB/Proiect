<?php
require_once 'functions.php';

if (!userIsLoggedIn()) { header("Location:/catalog/index.php"); }

require_once 'config.php';

$subClassId = sanitizare($_GET['idSubClass']);
$subClassType = sanitizare($_GET['type']);

if (isset($subClassType) && !empty($subClassType) && $subClassType == 'sem') {
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
exit();
?>