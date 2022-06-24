<?php
require_once 'functions.php';

/* If the user is not logged in, it redirects to the index page. */
if (!userIsLoggedIn()) { header("Location:index.php"); }
/* Checking if the user is a sysadmin. If not, it redirects to the index page. */
if (!userIsAdmin()) { header("Location:index.php"); }

require_once 'temp-header.php';
require_once 'temp-sidenav.php';
require_once 'temp-dashboard-header.php';

require_once 'config.php';

/* Checking if the order is set and if it is equal to desc. If it is, it will return DESC, if not, it
will return ASC. */
$sort_order = isset($_GET['order']) && strtolower($_GET['order']) == 'desc' ? 'DESC' : 'ASC';
/* Replacing the ASC and DESC with up and down. */
$up_or_down = str_replace(array('ASC','DESC'), array('up','down'), $sort_order);
/* Checking if the sort order is ASC and if it is, it will return desc, if not, it will return asc. */
$asc_or_desc = $sort_order == 'ASC' ? 'desc' : 'asc';

/* Selecting all the classes from the database and ordering them by class name. */
$sql_courses = "SELECT * FROM classes ORDER BY class_name " . $sort_order;
$result_courses = $conn->query($sql_courses);
$num_rows_courses = mysqli_num_rows($result_courses);


if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $error = 0;

  $class_name = sanitizare($_POST['class_name']);
  $class_description = sanitizare($_POST['description']);

  if (empty($class_name)) {
    $class_nameErr = "* class name is required";
    $error++;
  } else {
    if (strlen($class_name) < 3) {
      $class_nameErr = "* class name must be at least 3 characters long";
      $error++;
    }
    if (!preg_match("/^[a-zA-Z0-9_]*$/", $class_name)) {
      $class_nameErr = "* only letters, numbers and underscore are accepted";
      $error++;
    }
  } 

  if (empty($class_description)) {
    $class_descriptionErr = "* class description is required";
    $error++;
  } else {
    if (strlen($class_description) < 3) {
      $class_descriptionErr = "* class description must be at least 3 characters long";
      $error++;
    }
  }

  if ($error == 0) {
    $sql = "INSERT INTO classes (class_name, description) VALUES ('$class_name', '$class_description')";
    $result = $conn->query($sql);
    header("Location: " . $_SERVER['HTTP_REFERER']);
  }

  header("Location: " . $_SERVER['HTTP_REFERER']);
}
?>

<div class="container">
  <div class="row">
    <div class="col">
      <h2>Cursuri </h2>
       
      <button type="button" class="btn btn-success my-3 w-100" data-bs-toggle="modal" data-bs-target="#addNewClass">
        Add New Class
      </button> 

      <!-- Modal -->
      <div class="modal fade" id="addNewClass" enctype="multipart/form-data" aria-hidden="true">
        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" target="_self" method="post">
          <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="addNewClassLabel">Add New Class</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div> <!-- Modal Header -->

                <div class="modal-body">
                  <div class="form-group">
                    <label class="form-label">Class Name</label>
                    <input type="text" name="class_name" class="form-control" value=""  required>
                  </div>

                  <div class="form-group">
                    <label class="form-label">Class Description</label>
                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="description"></textarea>
                  </div> 
                </div> <!-- Modal Body --> 

                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-primary" name="addClassBtn">Save class</button>
                </div> <!-- end modal-footer -->
            </div> <!-- end modal-content -->
          </div> <!-- end modal-dialog -->
        </form> <!-- end form -->
      </div> <!-- end modal -->

      <table class="table table-hover">
        <thead class="table-dark">
          <tr>
            <th></th>
            <th><a href="?order=<?php echo $asc_or_desc; ?>">Class Name<i class="fas fa-sort<?php echo 1 == 1 ? '-' . $up_or_down : ''; ?>"></i></a></th>
            <th>Teachers</th>
            <th>Students</th>
            <th>Seminaries</th>
            <th>Laboratories</th>
            <th>Options</th>
          </tr>
        </thead>

        <tbody>
          <?php 
          if ($num_rows_courses > 0) {
					  while($row = $result_courses->fetch_assoc()) { ?>
              <tr>
                <td></td>

                <td>
                  <a type="text/html" href="class.php?cid=<?php echo $row["id_class"]; ?>" class="link-primary" data-bs-toggle="tooltip" data-bs-placement="top" title="<?php echo $row["description"]; ?>">
                    <?php echo $row["class_name"]; ?>
                  </a>
                </td>

                <td>
                  <?php $sql = "SELECT uc.id_user FROM users_classes uc JOIN users u ON uc.id_user = u.id_user WHERE u.id_role = 3 AND uc.id_class = " . $row['id_class']; 
                  echo $conn->query($sql)->num_rows; ?>
                </td>

                <td>
                  <?php $sql = "SELECT uc.id_user FROM users_classes uc JOIN users u ON uc.id_user = u.id_user WHERE u.id_role = 4 AND uc.id_class = " . $row['id_class']; 
                  echo $conn->query($sql)->num_rows; ?>
                </td>

                <td>
                  <?php $sql = "SELECT s.id_seminar FROM seminar s WHERE s.id_class = " . $row['id_class']; 
                  echo $conn->query($sql)->num_rows; ?>
                </td>

                <td>
                  <?php $sql = "SELECT l.id_laboratory FROM laboratory l WHERE l.id_class = " . $row['id_class']; 
                  echo $conn->query($sql)->num_rows; ?>
                </td> 

                <td>
                  <a href="classEdit.php?cid=<?php echo $row['id_class'] ?>" class="edit"><i class="material-icons" title="Edit">&#xE254;</i></a>
                  <a href="classDelete.php?cid=<?php echo $row['id_class'] ?>" class="delete"><i class="material-icons" title="Delete">&#xE872;</i></a>
                </td>
              </tr>
          <?php
            } // end while
          } else {
            echo "0 results";
          } // end if ?>
        </tbody>
      </table>
    </div> <!-- end col -->
  </div> <!-- end row -->
</div> <!-- end container -->

<!-- Add spacing at bottom of page to make it look better. -->
<div class="mt-5"></div>

<?php require_once 'temp-footer.php'; ?>