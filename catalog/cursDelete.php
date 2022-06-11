<?php
require_once 'functions.php';

if (!userIsLoggedIn()) { header("Location:/catalog/index.php"); }

require_once 'config.php';

$classId = $_GET['cid'];

if (isset($classId) && !empty($classId)) {
    $sql = "DELETE FROM users_classes WHERE id_class = $classId";
    $result = mysqli_query($conn,$sql);

    if ($result) {
        $sql2 = "DELETE FROM classes WHERE id_class = $classId";
        $result2 = mysqli_query($conn,$sql2);
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }

    header("Location:cursuri.php");
} else {
    header("Location:cursuri.php");
}

header("Location:cursuri.php");
exit();
?>