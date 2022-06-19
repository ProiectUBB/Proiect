<?php
require_once 'functions.php';

/* If the user is not logged in, it redirects to the index page. */
if (!userIsLoggedIn()) { header("Location:index.php"); }

require_once 'temp-header.php';
require_once 'temp-sidenav.php';
require_once 'temp-dashboard-header.php';

require_once 'config.php';

/* Sanitizing the `['cid']` variable. */
$classId = sanitizare($_GET['cid']);

/* Selecting all the classes from the database where the id_class is equal to the classId. */
$sql = "SELECT * FROM classes WHERE id_class = $classId";
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

            <div class="tab-content" id="nav-tabContent">
                <!-- List Seminars -->
                <div class="tab-pane fade bg-light" id="nav-seminar" role="tabpanel" aria-labelledby="nav-seminar-tab">
                    <?php $sql = "SELECT s.id_seminar, s.seminar_name, s.seminar_date FROM seminar s WHERE id_class = $classId ORDER BY s.seminar_date ASC";
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
                    <?php $sql = "SELECT l.id_laboratory, l.laboratory_name, l.laboratory_date FROM laboratory l WHERE id_class = $classId ORDER BY l.laboratory_date ASC";
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
        </div> <!-- end col -->
    </div> <!-- end row -->
</div>  <!-- end container -->

<!-- Add spacing at bottom of page to make it look better. -->
<div class="mt-5"></div> 

<?php require_once 'temp-footer.php'; ?>