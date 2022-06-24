<?php
require_once 'functions.php';

/* If the user is not logged in, it redirects to the index page. */
if (!userIsLoggedIn()) { header("Location:index.php"); }
/* Checking if the user is a admin. If not, it redirects to the index page. */
if (!userIsAdmin()) { header("Location:index.php"); }

require_once 'temp-header.php';
require_once 'temp-sidenav.php';
require_once 'temp-dashboard-header.php';

require_once 'config.php';


$classNameErr = $classDescrErr = "";
$className1 = $classDescr1 = "";
$error = 0;
$success = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get variables
    $className1 = sanitizare($_POST['class_name']);
    $classDescr1 = sanitizare($_POST['description']);

    $cid1 = sanitizare($_POST['cid']);
    $cid1 = (int) $cid1;

    if (empty($className1)) {       
        $classNameErr = "* username is required";
        $error++;
    }    

    if (empty($classDescr1)) {       
        $classDescrErr = "* username is required";
         $error++;
    }
    
    if ($error == 0) {
        if(isset($_POST['submit'])) {
            $class_name = sanitizare($_POST['class_name']);
            $description = sanitizare($_POST['description']);
            $cid = $_POST['cid'];
    
            $sql = "UPDATE classes SET class_name = '$class_name', description = '$description' WHERE id_class = $cid";

            $result = mysqli_query($conn,$sql);
                if ($result) {
                    header("Location:classes.php");
                } else {
                    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                }
        }
    }
    
    header("Location:classes.php");
}


$cid = sanitizare($_GET['cid']);
$sql = "SELECT * FROM classes WHERE id_class = $cid";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
?>

<div class="container">
    <div class="row">
        <div class="col text-muted">
            <h5><strong>Current Name: </strong><?php echo $row['class_name']; ?></h5>
            <p><strong>Current Description: </strong><?php echo $row['description']; ?></p>
        </div>
    </div>

</div>

<div class="container-fluid">
    <div class="row p-5 justify-content-center">
        <div class="col-12">
		<form action="classEdit.php" method="POST" class="col-6 mx-auto" >
					<h4>Edit Class</h4>
                    
					<div class="form-group">
						<label>Class Name</label>
						<input type="text" class="form-control" name="class_name" value="<?php echo $row['class_name']; ?>"> 
                        <input type="hidden" class="form-control" name="cid" value="<?php echo $_GET['cid']?>">
					</div>
					<div class="form-group">
						<label>Class Description</label>
                        <textarea class="form-control" rows="8" name="description"><?php echo $row['description']; ?></textarea>
					</div>
					<div class="d-flex mx-auto justify-content-center pt-4 gap-2">
                        <a href="classes.php" target="classes.php"><input type="button" class="btn btn-warning" value="Cancel"></a>
						<input type="submit" class="btn btn-success" name="submit" value="Update Class">
					</div>   
            </form> <!-- End of form -->
        </div> <!-- End of col-4 -->
    </div> <!-- End of row -->
</div> <!-- End of container-fluid -->

<!-- Add spacing at bottom of page to make it look better. -->
<div class="mt-5"></div>

<?php require_once 'temp-footer.php'; ?>