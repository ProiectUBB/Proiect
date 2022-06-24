<?php
require_once 'temp-header.php';

$classNameErr = $classDescrErr = "";
$className1 = $classDescr1 = "";
$error = 0;
$success = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    require_once 'functions.php';
    // Get variables
    $className1 = sanitizare($_POST['class_name']);
    $classDescr1 = sanitizare($_POST['description']);

    $cid1 = sanitizare($_POST['cid']);
    $cid1 = (int) $cid1;

    require_once 'config.php';

    if (empty($className1)) {       
        $classNameErr = "* username is required";
        $error++;
    } else {
      
        if (!preg_match("/^[a-zA-Z0-9]*$/", $className1)) {
            $classNameErr = "* only letters, numbers accepted";
            $error++;
        }
    }

    if (empty($classDescr1)) {       
        $classDescrErr = "* username is required";
         $error++;
    } else {
          
        if (!preg_match("/^[a-zA-Z0-9]*$/", $classDescr1)) {
            $classDescrErr = "* only letters, numbers accepted";
            $error++;
        }
    }
}
if ($error == 0) {
    if(isset($_POST['submit'])) {
        $class_name = $_POST['class_name'];
        $description = $_POST['decription'];
        $cid = $_POST['cid'];

        $sql = "UPDATE classes SET class_name = '$class_name', description = '$description' WHERE id_class = '$cid'";
            $result = mysqli_query($conn,$sql);
            if ($result) {
                header("Location:classes.php");
            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            }
    }
}

?>

<div class="container-fluid">
    <div class="row p-5 justify-content-center">
        <div class="col-4">
		<form action="classEdit.php" method="POST" class="col-6 mx-auto" >
					<h4>Edit Class</h4>
					<div class="form-group">
						<label>Class</label>
						<input type="text" class="form-control" name="class_name" value=""> 
                        <input type="hidden" class="form-control" name="cid" value="<?php echo $_GET['cid']?>">
					</div>
					<div class="form-group">
						<label>Class Description</label>
						<input type="text" class="form-control" name="description">
					</div>
					<div class="d-flex mx-auto justify-content-center pt-4 gap-2">
                        <a href="classes.php" target="classes.php"><input type="button" class="btn btn-warning" value="Cancel"></a>
						<input type="submit" class="btn btn-success" name="submit" value="Save">
					</div>   
            </form> <!-- End of form -->
        </div> <!-- End of col-4 -->
    </div> <!-- End of row -->
</div> <!-- End of container-fluid -->