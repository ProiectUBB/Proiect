<?php
require_once 'functions.php';

/* If the user is not logged in, it redirects to the index page. */
if (!userIsLoggedIn()) { header("Location:index.php"); }

require_once 'temp-header.php';
require_once 'temp-sidenav.php';
require_once 'temp-dashboard-header.php';

require_once 'config.php';

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
            <?php } ?>
        </div> <!-- end col -->
    </div> <!-- end row -->
</div>  <!-- end container -->

<!-- Add spacing at bottom of page to make it look better. -->
<div class="mt-5"></div> 

<?php require_once 'temp-footer.php'; ?>