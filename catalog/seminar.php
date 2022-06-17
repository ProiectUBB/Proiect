<?php
require_once 'functions.php';

/* If the user is not logged in, it redirects to the index page. */
if (!userIsLoggedIn()) { header("Location:index.php"); }

require_once 'temp-header.php';
require_once 'temp-sidenav.php';
require_once 'temp-dashboard-header.php';

require_once 'config.php';

/* Get Seminar id and Sanitizing the input from the URL. */
$sid = sanitizare($_GET['sid']);

/* Getting the class id based on the seminar id. */
$sql = "SELECT s.id_class FROM seminar s WHERE s.id_seminar = $sid";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$cid = $row['id_class'];

?>

<div class="container">
    <div class="row">
        <div class="col">
            <h2>Seminar</h2>
            <!-- This section is what the users sees -->
            <?php if (userIsStudent()) { ?>
            <!-- This alert is for orientation purposes only. It will be removed in the future. -->
            <div class="alert alert-secondary" role="alert">
                <strong>View Attendances/Grades</strong>
            </div>


            <?php } ?>

            <!-- This section is what Teacher and Admins sees -->
            <?php if (userIsTeacher()) { ?>
        
            <!-- This alert is for orientation purposes only. It will be removed in the future. -->
            <div class="alert alert-secondary" role="alert">
                <strong>Add Attendances/Grades</strong>
            </div>

            <table class="table table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>Student Full Name</th>
                        <th>Email</th>
                        <th>Seminar Attendance</th>
                    </tr>
                </thead>
                <tbody>
                    

            

            <?php 
                $sql = "SELECT uc.id_user, CONCAT(u.first_name, ' ', u.last_name) as full_name, u.email  FROM users_classes uc JOIN users u ON u.id_user = uc.id_user WHERE uc.id_class = $cid AND u.id_role = 4";
                $result = mysqli_query($conn, $sql);
                $students = mysqli_fetch_all($result, MYSQLI_ASSOC);
                
                while ($student = array_shift($students)) {
                    $student_id = $student['id_user'];
                    ?>
                    <tr>
                        <td><?php echo $student['full_name']; ?></td>
                        <td><?php echo $student['email']; ?></td>
                        <td><div class="input-group" id="secondDiv" style = "margin-bottom: 10px">
            <span class="input-group-addon">
                <span class="glyphicon glyphicon-list-alt"></span>
            </span>
            <input type="radio" class="form-control" name="attendance" id="present" value=1>
			<label for="attendance">present</label>
				<input type="radio" class="form-control" name="attendance" id="absent" value=0>
				<label for="attendance">absent</label>
        </div></td>
                    </tr>
                    <?php
                } ?>
                </tbody>
                </table>
            <?php } ?>
        </div> <!-- end col -->
    </div> <!-- end row -->
</div>  <!-- end container -->

<!-- Add spacing at bottom of page to make it look better. -->
<div class="mt-5"></div> 

<?php require_once 'temp-footer.php'; ?>