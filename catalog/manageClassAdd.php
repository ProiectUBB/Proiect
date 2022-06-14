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

if(isset($_POST['btn_add_sem_lab'])) {
    $class_id = sanitizare($_POST['cours_id']);
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    $class_id = sanitizare($_POST['cours_id']);
    $sub_class_type = sanitizare($_POST['subClassType']);
    $sub_class_names = $_POST['subClassName'];
    $sub_class_dates = $_POST['subClassDate'];

    $success_counter = 0;

    for ($index = 0; $index < count($sub_class_names); $index++) {
        $sql = "INSERT INTO $sub_class_type (id_class, ".$sub_class_type."_name, ".$sub_class_type."_date) VALUES ($class_id, '$sub_class_names[$index]', '$sub_class_dates[$index]')";

        $result = mysqli_query($conn, $sql);

        if ($result) {
            $success_counter++;
        }
    }

    if ($success_counter == count($sub_class_names)) {
        $success = "Successfully added " . $success_counter . " item/s";
    }
}
?>

<div class="container">
    <div class="row">
        <div class="col">
            <h1>Add new Laboratory or Seminar to Class</h1>

            <?php if ($success) { ?>
        	<div class="alert alert-success" role="alert">
                <?php echo $success; ?>
            </div>
            <?php } ?>

            <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" >
                <select class="form-select" id="subClassType" name="subClassType" required>
                    <option selected disabled value="">Choose...</option>
                    <option value="laboratory">Laboratory</option>
                    <option value="seminar">Seminar</option>
                </select>
                
                <br>
                
                <ol>
                    <li id="inputFormRow">
                        <div class="row g-3 m-3">
                            <div class="col-md-6">
                                <input type="text" name="subClassName[]" class="form-control" placeholder="Sub Class Name..." required>
                            </div>

                            <div class="col-md-4">
                                <input type="date" name="subClassDate[]" class="form-control" required>
                            </div>

                            <div class="col-md-2">
                                <button id="removeRow" type="button" class="btn btn-danger w-100">Remove</button>
                            </div>
                        </div>
                    </li>
                
                    <div id="newRow"></div>
                </ol>

                <div class="row g-3 m-5">
                    <div class="col-md-6">
                        <button id="addRow" type="button" class="btn btn-info w-100">Add Row</button>
                    </div>
                
                    <div class="col-md-6">
                        <input type='hidden' name='cours_id' value='<?php echo $class_id; ?>'/>
                        <button id="submit" type="submit" name="submit" class="btn btn-success w-100">Add Items</button>
                    </div>
                
                </div>
            </form>
        </div> <!-- end col -->
    </div> <!-- end row -->    
</div> <!-- end container -->

<script type="text/javascript">
    // add row
    $("#addRow").click(function () {
        var html = '';
        html += '<li id="inputFormRow">';
        html += '<div class="row g-3 m-3">';
        html += '<div class="col-md-6">';
        html += '<input type="text" name="subClassName[]" class="form-control" placeholder="Sub Class Name..." required>';
        html += '</div>';
        html += '<div class="col-md-4">';
        html += '<input type="date" name="subClassDate[]" class="form-control" required>';
        html += '</div>';
        html += '<div class="col-md-2">';
        html += '<button id="removeRow" type="button" class="btn btn-danger w-100">Remove</button>';
        html += '</div>';
        html += '</div>';
        html += '</li>';

        $('#newRow').append(html);
    });

    // remove row
    $(document).on('click', '#removeRow', function () {
        $(this).closest('#inputFormRow').remove();
    });
</script>

<?php require_once 'temp-footer.php'; ?>