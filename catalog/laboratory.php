<?php
require_once 'functions.php';

/* If the user is not logged in, it redirects to the index page. */
if (!userIsLoggedIn()) { header("Location:index.php"); }

require_once 'temp-header.php';
require_once 'temp-sidenav.php';
require_once 'temp-dashboard-header.php';

require_once 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update-laboratory-attendance'])) {
    /* Used to keep track of the index of the array. */
    $index = 0;

    // Get variables
    $laboratory_id = $_POST['laboratory_id'];
    foreach ($_POST['attendance'] as $key => $value) {
        $current_user = $_SESSION['user_id'];
        $stud_id = $key;
        $attendance = $value;
        $mentions = $_POST['mentions'];
        $grades = $_POST['grades'];

        $sql = "SELECT * FROM laboratory_attendance WHERE id_user = $stud_id AND id_laboratory = $laboratory_id";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);

        /* Checking if the student is present/absent/exempted and add status in table update or insert new row.
        Change table row color based on the student status. */
        if ($row) {
            $sql = "UPDATE laboratory_attendance SET is_present = $attendance, grade = $grades[$index], mentions = '$mentions[$index]', last_modified = now() WHERE id_user = $stud_id AND id_laboratory = $laboratory_id";
        } else {
            $sql = "INSERT INTO laboratory_attendance (`id_laboratory`, `id_user`, `is_present`, `date`, `last_modified`, `grade`, `mentions`) VALUES ($laboratory_id, $stud_id, $attendance, now(), now(), $grades[$index], '$mentions[$index]')";
        }

        /* Executing the query. */
        $result = mysqli_query($conn, $sql);

        /* Used to keep track of the index of the array. */
        $index++;
    }

    /* Redirecting the user to the previous page. */
    header("Location: " . $_SERVER['HTTP_REFERER']);
}

/* Get laboratory id and Sanitizing the input from the URL. */
$lid = sanitizare($_GET['lid']);

/* Getting the class id based on the laboratory id. */
$sql = "SELECT l.id_class, l.laboratory_name, l.laboratory_date FROM laboratory l WHERE l.id_laboratory = $lid";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
/* Getting the class id based on the laboratory id. */
$cid = $row['id_class'];
?>

<div class="container">
    <div class="row">
        <div class="col">
            <h2>Laboratory</h2>
            <!-- This section is what the users sees -->
            <?php if (userIsStudent()) { ?>
            <div class="alert alert-secondary" role="alert">
                <strong>View Attendances/Grades</strong>
            </div>
            <?php } ?>

            <!-- This section is what Teacher and Admins sees -->
            <?php if (userIsTeacher()) { ?>
            <div class="alert alert-secondary" role="alert">
                <strong>Add Attendances/Grades</strong>
            </div> 

            <form class="row g-3" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>">
                <table class="table table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th scope="col">Status</th>
                            <th>Student Full Name</th>
                            <th>Email</th>
                            <th>Mentions</th>
                            <th>Laboratory Attendance</th>
                            <th>Grade</th>
                            <th>Add Mentions</th>
                        </tr>
                    </thead>
                    <tbody>
                <?php
                    /* Getting the students from the database and displaying them in a table. */
                    $sql = "SELECT uc.id_user, CONCAT(u.first_name, ' ', u.last_name) as full_name, u.email FROM users_classes uc JOIN users u ON u.id_user = uc.id_user WHERE uc.id_class = $cid AND u.id_role = 4";
                    $result = mysqli_query($conn, $sql);
                    $students = mysqli_fetch_all($result, MYSQLI_ASSOC);

                    /* Getting the students from the database and displaying them in a table. */
                    while ($student = array_shift($students)) {
                        /* Getting the id of the student. */
                        $student_id = $student['id_user'];

                        /* Getting the attendance of the student. */
                        $sql_get_attendence = "SELECT la.id_user, la.is_present, la.grade, la.mentions FROM laboratory_attendance la WHERE id_user = $student_id AND id_laboratory = $lid";
                        $result_attendace = mysqli_query($conn, $sql_get_attendence);
                        $row_attendance = mysqli_fetch_assoc($result_attendace);
                        /* This is checking if the student is present or absent and add status in table.
                        Change table row color based on the student status. */
                        if ($row_attendance['id_user'] == $student_id) {
                            if ($row_attendance['is_present'] == 1) {
                                echo '<tr class="table-success"><td>';
                                echo 'Present';
                                $status = 1;
                            } else if ($row_attendance['is_present'] == 2) {
                                echo '<tr class="table-warning"><td>';
                                echo 'Exempted';
                                $status = 2;
                            } else {
                                echo '<tr class="table-danger"><td>';
                                echo 'Absent';
                                $status = 0;
                            }
                        } else {
                            echo '<tr class="table-danger"><td>';
                            echo 'Absent';
                            $status = 0;
                        } ?>
                            </td>
                            <td><?php echo $student['full_name']; ?></td>
                            <td><?php echo $student['email']; ?></td>
                            <td><?php echo $row_attendance['mentions']; ?></td>
                            <td>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="attendance[<?php echo $student_id ?>]" id="attendance-p-<?php echo $student_id ?>" value="1" <?php if ($status == 1) echo "checked"; ?> />
                                    <label class="form-check-label" for="attendance-p-<?php echo $student_id ?>">Present</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="attendance[<?php echo $student_id ?>]" id="attendance-e-<?php echo $student_id ?>" value="2" <?php if ($status == 2) echo "checked"; ?> />
                                    <label class="form-check-label" for="attendance-e-<?php echo $student_id ?>">Exempted</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="attendance[<?php echo $student_id ?>]" id="attendance-a-<?php echo $student_id ?>" value="0" <?php if ($status == 0) echo "checked"; ?> />
                                    <label class="form-check-label" for="attendance-a-<?php echo $student_id ?>">Absent</label>
                                </div>
                            </td>
                            <td>
                                <div class="form-group">
                                    <input type="number" class="form-control" name="grades[]" value="<?php if ($row_attendance['grade']) { echo $row_attendance['grade']; } ?>" min="1" max="10" required />
                                </div>
                            </td>
                            <td>
                                <div class="form-group">
                                  <input type="text" class="form-control" name="mentions[]" value="<?php if ($row_attendance['mentions']) { echo $row_attendance['mentions']; } ?>">
                                </div>
                            </td>
                        </tr>
                        <?php } // while close ?>
                    </tbody>
                </table>

                <input type="hidden" name="laboratory_id" value="<?php echo $lid ?>">
                <button type="submit" class="btn btn-lg btn-primary" name="update-laboratory-attendance">Update Student Attendance</button>
            </form> 
            <?php } // userIsTeacher close ?>
        </div> <!-- end col -->
    </div> <!-- end row -->
</div>  <!-- end container -->

<!-- Add spacing at bottom of page to make it look better. -->
<div class="mt-5"></div> 

<?php require_once 'temp-footer.php'; ?>