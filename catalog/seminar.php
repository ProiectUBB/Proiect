<?php
require_once 'functions.php';

/* If the user is not logged in, it redirects to the index page. */
if (!userIsLoggedIn()) { header("Location:index.php"); }

if (!userIsTeacher()) { header("Location:index.php"); }

require_once 'temp-header.php';
require_once 'temp-sidenav.php';
require_once 'temp-dashboard-header.php';

require_once 'config.php';


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update-seminar-attendance'])) {
    /* Used to keep track of the index of the array. */
    $index = 0;

    // Get variables
    $seminar_id = $_POST['seminar_id'];
    
    foreach ($_POST['attendance'] as $key => $value) {
        $current_user = $_SESSION['user_id'];
        $stud_id = $key;
        $attendance = $value;
        $mentions = $_POST['mentions'];

        $sql = "SELECT * FROM seminar_attendance WHERE id_user = $stud_id AND id_seminar = $seminar_id";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);


        /* Checking if the student is present/absent/exempted and add status in table update or insert new row.
        Change table row color based on the student status. */
        if ($row) {
            $sql = "UPDATE seminar_attendance SET is_present = $attendance, mentions = '$mentions[$index]', last_modified = now() WHERE id_user = $stud_id AND id_seminar = $seminar_id";
        } else {
            $sql = "INSERT INTO seminar_attendance (`id_seminar`, `id_user`, `is_present`, `date`, `last_modified`, `mentions`) VALUES ($seminar_id, $stud_id, $attendance, now(), now(), '$mentions[$index]')";
        }

        /* Executing the query. */
        $result = mysqli_query($conn, $sql);

        /* Used to keep track of the index of the array. */
        $index++;
    }

    /* Redirecting the user to the previous page. */
    header("Location: " . $_SERVER['HTTP_REFERER']);
}

/* Get Seminar id and Sanitizing the input from the URL. */
$sid = sanitizare($_GET['sid']);

/* Getting the class id based on the seminar id. */
$sql = "SELECT s.id_class, s.seminar_name, s.seminar_date FROM seminar s WHERE s.id_seminar = $sid";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
/* Getting the class id based on the seminar id. */
$cid = $row['id_class'];
?>

<div class="container">
    <div class="row">
        <div class="col">
            <h2>Seminar</h2>
            <h4><?php echo $row['seminar_name'] ?></h4>
            <p><?php echo date("Y-m-d",strtotime($row['seminar_date'])); ?></p>
            <form class="row g-3" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>">
                <table class="table table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th scope="col">Status</th>
                            <th>Student Full Name</th>
                            <th>Email</th>
                            <th>Mentions</th>
                            <th>Seminar Attendance</th>
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
                        $sql_get_attendence = "SELECT sa.id_user, sa.is_present, sa.mentions FROM seminar_attendance sa WHERE id_user = $student_id AND id_seminar = $sid";
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
                                <div>
                                  <input type="text" class="form-control" name="mentions[]" value="<?php if ($row_attendance['mentions']) { echo $row_attendance['mentions']; } ?>">
                                </div>
                            </td>
                        </tr>
                        <?php } // while close ?>
                    </tbody>
                </table>

                <input type="hidden" name="seminar_id" value="<?php echo $sid ?>">
                <button type="submit" class="btn btn-lg btn-primary" name="update-seminar-attendance">Update Student Attendance</button>
                <a type="button" class="btn btn-warning" href="myClass.php?cid=<?php echo $cid; ?>" role="button">Go Back</a>
            </form>
        </div> <!-- end col -->
    </div> <!-- end row -->
</div>  <!-- end container -->

<!-- Add spacing at bottom of page to make it look better. -->
<div class="mt-5"></div>

<?php require_once 'temp-footer.php'; ?>
