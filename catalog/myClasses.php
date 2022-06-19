<?php
require_once 'functions.php';

/* If the user is not logged in, it redirects to the index page. */
if (!userIsLoggedIn()) { header("Location:index.php"); }

require_once 'temp-header.php';
require_once 'temp-sidenav.php';
require_once 'temp-dashboard-header.php';

require_once 'config.php';

/* This is a SQL query that is selecting the id_class, class_name, and description from the
users_classes and classes tables. It is joining the two tables on the id_class. It is also filtering
the results by the id_user. */
$sql = "SELECT uc.id_class, c.class_name, c.description FROM users_classes uc JOIN classes c ON uc.id_class = c.id_class WHERE uc.id_user = ". $_SESSION['id_user'];
$result = $conn->query($sql);
$num_rows = mysqli_num_rows($result);
?>

<div class="container">
    <div class="row">
        <div class="col">
            <h2>My Classes</h2>
            <?php if ($num_rows > 0) { ?>
                <ol class="list-group list-group-numbered">
                    <?php while ($row = $result->fetch_assoc()) { ?>
                        <li class="list-group-item d-flex justify-content-between align-items-start">
                            <div class="ms-2 me-auto">
                                <div class="fw-bold"><a href="myClass.php?cid=<?php echo $row['id_class']; ?>" class="link-dark"><?php echo $row['class_name']; ?></a></div>
                                <span class="d-inline-block text-truncate" style="max-width: 640px;" data-bs-toggle="tooltip" data-bs-placement="bottom" title="<?php echo $row['description']; ?>">
                                    <?php echo $row['description']; ?>
                                </span>
                            </div>
                    
                            <?php if (userIsTeacher()) { 
                                /* This is a SQL query that is selecting the id_user from the users_classes and users tables. It is joining the two tables on the
                                id_user. It is also filtering the results by the id_role and id_class. */
                                $sql = "SELECT uc.id_user FROM users_classes uc JOIN users u ON uc.id_user = u.id_user WHERE u.id_role = 4 AND uc.id_class = " . $row['id_class'];
                                $num_rows = $conn->query($sql)->num_rows; ?>

                                <span class="badge bg-<?php if ($num_rows > 0) { echo 'primary'; } else { echo 'danger'; } ?> rounded-pill">
                                    <?php echo $num_rows ?>
                                </span>
                            <?php } // Close userIsTeacher() ?>
                        </li>
                    <?php } // End while loop ?>
                </ol>
            <?php } else { ?>
                <p>You don't have any classes yet.</p>
            <?php } // End if num_rows ?>
        </div> <!-- end col -->
    </div> <!-- end row -->
</div>  <!-- end container -->

<!-- Add spacing at bottom of page to make it look better. -->
<div class="mt-5"></div> 

<?php require_once 'temp-footer.php'; ?>