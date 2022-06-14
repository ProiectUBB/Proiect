<?php
require_once 'functions.php';

/* If the user is not logged in, it redirects to the index page. */
if (!userIsLoggedIn()) { header("Location:index.php"); }
/* Checking if the user is a sysadmin. If not, it redirects to the index page. */
if ($_SESSION['idRol'] != 1) { header("Location:index.php"); }

require_once 'temp-header.php';
require_once 'temp-sidenav.php';
require_once 'temp-dashboard-header.php';

require_once 'config.php';

$classId = $_GET['cid'];
$sql = "SELECT * FROM classes c WHERE id_class = $classId;";
$result = mysqli_query($conn, $sql);


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['btn_assign_teacher'])) {

    if(isset($_POST['chk_add_utid']) && !empty($_POST['chk_add_utid'])) {
        $cours_id = $_POST['cours_id'];

        /* Taking the array of the checkboxes and turning it into a string. */

        foreach ($_POST['chk_add_utid'] as $utid) {
            $sql = "INSERT INTO users_classes VALUES ($utid, $cours_id);";
            $result = mysqli_query($conn,$sql);
        }

        if ($result) {
            header("Location: " . $_SERVER['HTTP_REFERER']);
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
     } else {
        header("Location: " . $_SERVER['HTTP_REFERER']);
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['btn_assign_student'])) {
    if(isset($_POST['chk_add_usid']) && !empty($_POST['chk_add_usid'])) {
        $cours_id = $_POST['cours_id'];

        foreach ($_POST['chk_add_usid'] as $usid) {
            $sql = "INSERT INTO users_classes VALUES ($usid, $cours_id);";
            $result = mysqli_query($conn,$sql);
        }

        if ($result) {
            header("Location: " . $_SERVER['HTTP_REFERER']);
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
     } else {
        header("Location: " . $_SERVER['HTTP_REFERER']);
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['btn_del_teacher'])) {
    if(isset($_POST['chk_del_utid']) && !empty($_POST['chk_del_utid'])) {
        $cours_id = $_POST['cours_id'];

        foreach ($_POST['chk_del_utid'] as $utid) {
            $sql = "DELETE FROM users_classes WHERE id_user = $utid AND id_class = $cours_id;";
            $result = mysqli_query($conn,$sql);
        }

        if ($result) {
            header("Location: " . $_SERVER['HTTP_REFERER']);
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    } else {
        header("Location: " . $_SERVER['HTTP_REFERER']);
    }
}       


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['btn_del_student'])) {
    if(isset($_POST['chk_del_usid']) && !empty($_POST['chk_del_usid'])) {
        $cours_id = $_POST['cours_id'];

        foreach ($_POST['chk_del_usid'] as $usid) {
            $sql = "DELETE FROM users_classes WHERE id_user = $usid AND id_class = $cours_id;";
            $result = mysqli_query($conn,$sql);
        }

        if ($result) {
            header("Location: " . $_SERVER['HTTP_REFERER']);
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    } else {
        header("Location: " . $_SERVER['HTTP_REFERER']);
    }
}

?>



<div class="container">
    <div class="row">
        <div class="col">
            <?php while ($row = mysqli_fetch_row($result)) { ?>
            <h2>Curs: <?php echo $row[1]; ?></h2>
            <hr>
            <p><?php echo $row[2]; ?></p>
            <?php } ?>
        </div> <!-- end col -->
    </div> <!-- end row -->  

    <div class="row">
        <div class="col">

            <div class="accordion" id="accordionExample">
                <div class="accordion-item text-danger">
                    <h2 class="accordion-header" id="headingOne">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                            List or Remove Assigned Teachers Or Students Of This Class
                        </button>
                    </h2> <!-- end accordion-header -->

                    <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                        <div class="accordion-body"> 

                            <nav>
                                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                    <button class="nav-link active" id="nav-list-teacher-tab" data-bs-toggle="tab" data-bs-target="#nav-list-teacher" type="button" role="tab" aria-controls="nav-list-teacher" aria-selected="true">List Teachers</button>

                                    <button class="nav-link" id="nav-list-student-tab" data-bs-toggle="tab" data-bs-target="#nav-list-student" type="button" role="tab" aria-controls="nav-list-student" aria-selected="false">List Students</button>    
                                </div>
                            </nav>

                            <div class="tab-content" id="nav-tabContent">
                                <!-- List teachers -->
                                <div class="tab-pane fade show active bg-light" id="nav-list-teacher" role="tabpanel" aria-labelledby="nav-list-teacher-tab">
                                    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                <th scope="col"></th>
                                                <th scope="col">First Name</th>
                                                <th scope="col">Last Name</th>
                                                <th scope="col">Email</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            <?php $sql_list_teachers = "SELECT u.id_user, u.first_name, u.last_name, u.email FROM users_classes uc JOIN users u ON uc.id_user = u.id_user WHERE u.id_role = 3 AND uc.id_class = $classId;";
                                                $result_list_teachers = mysqli_query($conn, $sql_list_teachers);
                                                
                                                while ($row_list_teachers = mysqli_fetch_row($result_list_teachers)) { ?>
                                            <tr>
                                                <td><input name="chk_del_utid[]" type="checkbox" class="chkbox" value="<?php echo $row_list_teachers[0]; ?>"/></td>
                                                <td><?php echo $row_list_teachers[1]; ?></td>
                                                <td><?php echo $row_list_teachers[2]; ?></td>
                                                <td><?php echo $row_list_teachers[3]; ?></td>
                                            </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>

                                    <input type='hidden' name='cours_id' value='<?php echo $classId; ?>'/> 
                                    <button type="submit" name="btn_del_teacher" class="btn btn-danger m-3 w-100">Unassign teacher/s</button>
                                </form>
                            </div> <!-- end List assigned teachers -->

                            <!-- List Students -->
                            <div class="tab-pane fade bg-light" id="nav-list-student" role="tabpanel" aria-labelledby="nav-list-student-tab">
                                <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th scope="col"></th>
                                                <th scope="col">First Name</th>
                                                <th scope="col">Last Name</th>
                                                <th scope="col">Email</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            <?php $sql_list_students = "SELECT u.id_user, u.first_name, u.last_name, u.email FROM users_classes uc JOIN users u ON uc.id_user = u.id_user WHERE u.id_role = 4 AND uc.id_class = $classId;";
                                                $result_list_students = mysqli_query($conn, $sql_list_students);

                                                while ($row_list_students = mysqli_fetch_row($result_list_students)) { ?>
                                            <tr>
                                                <td><input name="chk_del_usid[]" type="checkbox" class="chkbox" value="<?php echo $row_list_students[0]; ?>"/></td>
                                                <td><?php echo $row_list_students[1]; ?></td>
                                                <td><?php echo $row_list_students[2]; ?></td>
                                                <td><?php echo $row_list_students[3]; ?></td>
                                            </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>

                                    <input type='hidden' name='cours_id' value='<?php echo $classId; ?>'/> 
                                    <button type="submit" name="btn_del_student" class="btn btn-danger m-3 w-100">Unassign student/s</button>
                                </form>
                            </div> <!-- end List assigned Students -->
                        </div> <!-- end accordion-body -->
                    </div> <!-- end collapseOne -->
                </div> <!-- end accordion-item -->

                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingTwo">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                            Add Unnasigned Teachers/Students To This Course
                        </button>
                    </h2>

                    <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                        <div class="accordion-body">

                            <nav>
                                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                    <button class="nav-link active" id="nav-manage-teacher-tab" data-bs-toggle="tab" data-bs-target="#nav-manage-teacher" type="button" role="tab" aria-controls="nav-manage-teacher" aria-selected="true">Manage Teachers</button>

                                    <button class="nav-link" id="nav-manage-student-tab" data-bs-toggle="tab" data-bs-target="#nav-manage-student" type="button" role="tab" aria-controls="nav-manage-student" aria-selected="false">Manage Students</button>    
                                </div>
                            </nav>

                            <div class="tab-content" id="nav-tabContent">
                                <!-- Assign Teachers to Course -->
                                <div class="tab-pane fade show active bg-light" id="nav-manage-teacher" role="tabpanel" aria-labelledby="nav-manage-teacher-tab">
                                    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th scope="col"></th>
                                                    <th scope="col">First Name</th>
                                                    <th scope="col">Last Name</th>
                                                    <th scope="col">Email</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                <?php $sql_list_teachers = "SELECT u.id_user, u.first_name, u.last_name, u.email FROM users u JOIN roles r ON u.id_role = r.id_role WHERE r.role_name = 'teacher' AND u.id_user NOT IN (SELECT uc.id_user from users_classes uc WHERE uc.id_class = $classId);";
                                                    $result_list_teachers = mysqli_query($conn, $sql_list_teachers);

                                                    while ($row_list_teachers = mysqli_fetch_row($result_list_teachers)) { ?>
                                                <tr>
                                                    <td><input name="chk_add_utid[]" type="checkbox" class="chkbox" value="<?php echo $row_list_teachers[0]; ?>"/></td>
                                                    <td><?php echo $row_list_teachers[1]; ?></td>
                                                    <td><?php echo $row_list_teachers[2]; ?></td>
                                                    <td><?php echo $row_list_teachers[3]; ?></td>
                                                </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>

                                        <input type='hidden' name='cours_id' value='<?php echo $classId; ?>'/> 
                                        <button type="submit" name="btn_assign_teacher" class="btn btn-success m-3 w-100">Assign teacher/s</button>
                                    </form>
                                </div> <!-- end Assign Teachers to Course -->

                                <!-- Assign Students to Course -->
                                <div class="tab-pane fade bg-light" id="nav-manage-student" role="tabpanel" aria-labelledby="nav-manage-student-tab">
                                    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th scope="col"></th>
                                                    <th scope="col">First Name</th>
                                                    <th scope="col">Last Name</th>
                                                    <th scope="col">Email</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                <?php $sql_list_students = "SELECT u.id_user, u.first_name, u.last_name, u.email FROM users u JOIN roles r ON u.id_role = r.id_role WHERE r.role_name = 'student' AND u.id_user NOT IN (SELECT uc.id_user from users_classes uc WHERE uc.id_class = $classId);";
                                                    $result_list_students = mysqli_query($conn, $sql_list_students);

                                                    while ($row_list_students = mysqli_fetch_row($result_list_students)) { ?>
                                                <tr>
                                                    <td><input name="chk_add_usid[]" type="checkbox" class="chkbox" value="<?php echo $row_list_students[0]; ?>"/></td>
                                                    <td><?php echo $row_list_students[1]; ?></td>
                                                    <td><?php echo $row_list_students[2]; ?></td>
                                                    <td><?php echo $row_list_students[3]; ?></td>
                                                </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>

                                        <input type='hidden' name='cours_id' value='<?php echo $classId; ?>'/> 
                                        <button type="submit" name="btn_assign_student" class="btn btn-success m-3 w-100">Assign student/s</button>
                                    </form>
                                </div> <!-- end Assign Students to Course -->
                            </div> <!-- end tab-content -->
                        </div> <!-- end accordion-body -->
                    </div> <!-- end collapseTwo -->
                </div> <!-- end accordion-item -->

                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingThree">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                            Manage Seminars and Laboratories
                        </button>
                    </h2>

                    <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                        <div class="accordion-body">

                            <form action="manageClassAdd.php" method="post">    
                                <input type='hidden' name='cours_id' value='<?php echo $classId; ?>'/>
                                <button type="submit" name="btn_add_sem_lab" class="btn btn-success m-3 w-100">Add New Seminar or Laboratory</button>
                            </form> 

                            <nav>
                                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                    <button class="nav-link active" id="nav-manage-seminar-tab" data-bs-toggle="tab" data-bs-target="#nav-manage-seminar" type="button" role="tab" aria-controls="nav-manage-seminar" aria-selected="true">Manage Seminars</button>

                                    <button class="nav-link" id="nav-manage-laboratory-tab" data-bs-toggle="tab" data-bs-target="#nav-manage-laboratory" type="button" role="tab" aria-controls="nav-manage-laboratory" aria-selected="false">Manage Laboratories</button>    
                                </div>
                            </nav>

                            <div class="tab-content" id="nav-tabContent">
                                <!-- Manage Seminars -->
                                <div class="tab-pane fade show active bg-light" id="nav-manage-seminar" role="tabpanel" aria-labelledby="nav-manage-seminar-tab">
                                    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th scope="col"></th>
                                                    <th scope="col">Seminar Name</th>
                                                    <th scope="col">Date</th>
                                                    <th scope="col">Options</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                <?php $sql_list_seminars = "SELECT s.id_class, s.seminar_name, s.seminar_date, s.id_seminar FROM seminar s WHERE s.id_class = $classId ORDER BY s.seminar_date ASC;";
                                                    $result_list_seminars = mysqli_query($conn, $sql_list_seminars);

                                                    while ($row_list_seminars = mysqli_fetch_row($result_list_seminars)) { ?>
                                                <tr>
                                                    <td>-</td>
                                                    <td><?php echo $row_list_seminars[1]; ?></td>
                                                    <td><?php echo $row_list_seminars[2]; ?></td>
                                                    <td>
                                                        <a href="manageClassDelete.php?idSubClass=<?php echo $row_list_seminars[3] ?>&type=sem" class="delete" >
                                                            <i class="material-icons" title="Delete">&#xE872;</i>
                                                        </a>
                                                    </td>
                                                </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>

                                        <!-- <input type='hidden' name='cours_id' value='<?php echo $classId; ?>'/>  -->
                                        <!-- <button type="submit" name="btn_assign_teacher" class="btn btn-success m-3 w-100">Assign teacher/s</button> -->
                                    </form>
                                </div> <!-- end Manage Seminars -->

                                <!-- Manage Laboratories -->
                                <div class="tab-pane fade bg-light" id="nav-manage-laboratory" role="tabpanel" aria-labelledby="nav-manage-laboratory-tab">
                                    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th scope="col"></th>
                                                    <th scope="col">Laboratory Name</th>
                                                    <th scope="col">Date</th>
                                                    <th scope="col">Options</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                <?php $sql_list_laboratories = "SELECT l.id_class, l.laboratory_name, l.laboratory_date, l.id_laboratory FROM laboratory l WHERE l.id_class = $classId ORDER BY l.laboratory_date ASC;";
                                                    $result_list_laboratories = mysqli_query($conn, $sql_list_laboratories);

                                                    while ($row_list_laboratories = mysqli_fetch_row($result_list_laboratories)) { ?>
                                                <tr>
                                                    <td>-</td>
                                                    <td><?php echo $row_list_laboratories[1]; ?></td>
                                                    <td><?php echo $row_list_laboratories[2]; ?></td>
                                                    <td>
                                                        <a href="manageClassDelete.php?idSubClass=<?php echo $row_list_laboratories[3] ?>&type=lab" class="delete" >
                                                            <i class="material-icons" title="Delete">&#xE872;</i>
                                                        </a>
                                                    </td>
                                                </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>

                                        <!-- <input type='hidden' name='cours_id' value='<?php echo $classId; ?>'/>  -->
                                        <!-- <button type="submit" name="btn_assign_teacher" class="btn btn-success m-3 w-100">Assign teacher/s</button> -->
                                    </form>
                                </div> <!-- end Manage laboratories -->
                                
                            </div> <!-- end tab-content -->
                        </div> <!-- end accordion-body -->
                    </div> <!-- end collapseThree -->
                </div> <!-- end accordion-item -->
                
            </div> <!-- end accordion -->
        </div> <!-- end col -->
    </div> <!-- end row -->    
</div> <!-- end container -->

<?php require_once 'temp-footer.php'; ?>