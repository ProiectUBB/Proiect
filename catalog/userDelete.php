<?php
require_once 'functions.php';

if (!userIsLoggedIn()) { header("Location:/catalog/index.php"); }
/* Checking if the user is a admin. If not, it redirects to the index page. */
if (!userIsAdmin()) { header("Location:index.php"); }

require_once 'config.php';

if(isset($_POST['submit'])) {
/* Deleting multiple users at once. */
    if(isset($_POST['chk_id']) && !empty($_POST['chk_id'])) {
        /* Taking the array of the checkboxes and turning it into a string. */
        $all=implode(",",$_POST["chk_id"]);
        /* Deleting multiple users at once. */
        $sql = "DELETE FROM users WHERE id_user IN ($all)";
        $result = mysqli_query($conn,$sql);

        if ($result) {
            header("Location:users.php");
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    } else {
        header("Location:users.php");
    }
} else {
    /* Checking if the user is not the sysadmin, if it is not, it will delete the user. */
    $userId = $_GET['uid'];
    
    if ($userId != 1) {
        if (isset($userId) && !empty($userId)) {
            $sql = "DELETE FROM users WHERE id_user = $userId";
            $result = mysqli_query($conn,$sql);
    
            if ($result) {
                header("Location:users.php");
            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            }
        } else {
            header("Location:users.php");
        }
    }else {
        header("Location:users.php");
    }    
}

exit();
?>