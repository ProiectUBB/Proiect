<?php
require_once 'functions.php';

/* If the user is not logged in, it redirects to the index page. */
if (!userIsLoggedIn()) { header("Location:index.php"); }

require_once 'temp-header.php';
require_once 'temp-sidenav.php';
require_once 'temp-dashboard-header.php';

require_once 'config.php';

/* Sanitizing the `['cid']` variable. */
$cid = sanitizare($_GET['cid']);

/* Selecting all the classes from the database where the id_class is equal to the cid. */
$sql = "SELECT * FROM classes WHERE id_class = $cid";
?>

<div class="container">
    <div class="row">
        <div class="col">
            <h2>Class</h2>
            
            <nav>
                <div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
                    <button class="nav-link" id="nav-seminar-tab" data-bs-toggle="tab" data-bs-target="#nav-seminar" type="button" role="tab" aria-controls="nav-seminar" aria-selected="true">SEMINARS</button>

                    <button class="nav-link" id="nav-laboratory-tab" data-bs-toggle="tab" data-bs-target="#nav-laboratory" type="button" role="tab" aria-controls="nav-laboratory" aria-selected="false">LABORATORIES</button>    
                </div>
            </nav>

            <?php if (userIsTeacher()) { ?>
                <div class="tab-content" id="nav-tabContent">
                    <!-- List Seminars -->
                    <div class="tab-pane fade bg-light" id="nav-seminar" role="tabpanel" aria-labelledby="nav-seminar-tab">
                        <?php $sql = "SELECT s.id_seminar, s.seminar_name, s.seminar_date FROM seminar s WHERE id_class = $cid ORDER BY s.seminar_date ASC";
                        $result = mysqli_query($conn, $sql);

                        if (mysqli_num_rows($result) > 0) { ?>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">Seminar Name</th>
                                        <th scope="col">Seminar Date</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php while ($row = mysqli_fetch_row($result)) { ?>
                                        <tr>
                                            <td><a href="seminar.php?sid=<?php echo $row[0] ?>" class="link-dark"><?php echo $row[1]; ?></a></td>
                                            <td><?php echo $row[2]; ?></td>
                                        </tr>
                                    <?php } // End while loop ?>
                                </tbody>
                            </table>
                        <?php } else { ?>
                            <div class="alert alert-info" role="alert">
                                <h4 class="alert-heading">No seminars found!</h4>
                            </div>
                        <?php } // End num rows if ?>
                    </div> <!-- end List Seminars for this course -->

                    <!-- List Laboratories -->
                    <div class="tab-pane fade bg-light" id="nav-laboratory" role="tabpanel" aria-labelledby="nav-laboratory-tab">
                        <?php $sql = "SELECT l.id_laboratory, l.laboratory_name, l.laboratory_date FROM laboratory l WHERE id_class = $cid ORDER BY l.laboratory_date ASC";
                        $result = mysqli_query($conn, $sql); 

                        if (mysqli_num_rows($result) > 0) { ?>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">Laboratory Name</th>
                                        <th scope="col">Laboratory Date</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php while ($row = mysqli_fetch_row($result)) { ?>
                                        <tr>
                                            <td><a href="laboratory.php?lid=<?php echo $row[0] ?>" class="link-dark"><?php echo $row[1]; ?></a></td>
                                            <td><?php echo $row[2]; ?></td>
                                        </tr>
                                    <?php } // end while loop ?>
                                </tbody>
                            </table>
                        <?php } else { ?>
                            <div class="alert alert-info" role="alert">
                                <h4 class="alert-heading">No laboratories found!</h4>
                            </div>
                        <?php } // end num rows if ?>
                    </div> <!-- end List Laboratories for this course -->
                </div> <!-- end tab-content -->
            <?php } // end if userIsTeacher ?>

            <?php if (userIsStudent()) { 
                $uid = $_SESSION['id_user']; ?>

                <div class="tab-content" id="nav-tabContent">
                    <!-- List Seminars -->
                    <div class="tab-pane fade bg-light" id="nav-seminar" role="tabpanel" aria-labelledby="nav-seminar-tab">
                        <?php $sql = "SELECT s.seminar_name, s.seminar_date, sa.is_present, sa.mentions FROM seminar_attendance sa JOIN seminar s ON sa.id_seminar = s.id_seminar WHERE id_user = $uid ORDER BY s.seminar_date ASC;";
                            $result = mysqli_query($conn, $sql); 

                            if (mysqli_num_rows($result) > 0) { ?>
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col">Seminar Name</th>
                                            <th scope="col">Date</th>
                                            <th scope="col">Attendance</th>
                                            <th scope="col">Mentions</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php while ($row = mysqli_fetch_row($result)) { 
                                            if ($row[2] == 1) {
                                                echo '<tr class="table-success">';
                                            } else if ($row[2] == 2) {
                                                echo '<tr class="table-warning">';
                                            } else {
                                                echo '<tr class="table-danger">';
                                            } ?>
                                                <td><strong><?php echo $row[0]; ?></strong></td>
                                                <td><?php echo $row[1]; ?></td>
                                                <td><?php if ($row[2] == 0) { echo 'Absent'; } elseif ($row[2] == 1) { echo 'Present'; } else { echo 'Exempted'; } ?></td>
                                                <td><?php echo $row[3]; ?></td>
                                            </tr>
                                        <?php } // end while loop ?>
                                    </tbody>
                                </table>
                            <?php } else { ?>
                                <div class="alert alert-warning" role="alert">
                                    No seminaries for this course.
                                </div>
                            <?php } // end num_rows if ?>
                    </div> <!-- end List Seminars for this course -->


                    <!-- List Laboratories -->
                    <div class="tab-pane fade bg-light" id="nav-laboratory" role="tabpanel" aria-labelledby="nav-laboratory-tab">
                    <?php $sql = "SELECT l.laboratory_name, l.laboratory_date, la.is_present, la.grade, la.mentions FROM laboratory_attendance la JOIN laboratory l ON la.id_laboratory = l.id_laboratory WHERE id_user = 4 ORDER BY l.laboratory_date  ASC;";
                            $result = mysqli_query($conn, $sql); 

                            if (mysqli_num_rows($result) > 0) { ?>
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col">Laboratory Name</th>
                                            <th scope="col">Date</th>
                                            <th scope="col">Attendance</th>
                                            <th scope="col">Grade</th>
                                            <th scope="col">Mentions</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php while ($row = mysqli_fetch_row($result)) { 
                                            if ($row[2] == 1) {
                                                echo '<tr class="table-success">';
                                            } else if ($row[2] == 2) {
                                                echo '<tr class="table-warning">';
                                            } else {
                                                echo '<tr class="table-danger">';
                                            } ?>
                                                <td><strong><?php echo $row[0]; ?></strong></td>
                                                <td><?php echo $row[1]; ?></td>
                                                <td><?php if ($row[2] == 0) { echo 'Absent'; } elseif ($row[2] == 1) { echo 'Present'; } else { echo 'Exempted'; } ?></td>
                                                <td><?php echo $row[3]; ?></td>
                                                <td><?php echo $row[4]; ?></td>
                                            </tr>
                                        <?php } // end while loop ?>
                                    </tbody>
                                </table>
                            <?php } else { ?>
                                <div class="alert alert-warning" role="alert">
                                    No laboratories for this course.
                                </div>
                            <?php } // end num_rows if ?>
                    </div> <!-- end List Laboratories for this course -->
                    
                </div> <!-- end tab-content -->
            <?php } ?>

        </div> <!-- end col -->
    </div> <!-- end row -->
</div>  <!-- end container -->

<!-- Add spacing at bottom of page to make it look better. -->
<div class="mt-5"></div> 

<?php require_once 'temp-footer.php'; ?>