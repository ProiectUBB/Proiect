<?php
require_once 'functions.php';


if (!userIsLoggedIn()) { header("Location:index.php"); }

if (!userIsAdmin()) { header("Location:index.php"); }

require_once 'temp-header.php';
require_once 'temp-sidenav.php';
require_once 'temp-dashboard-header.php';

require_once 'config.php';

/* Creating an array of columns that can be sorted. */
$columns = array('username', 'role_name', 'email', 'first_name', 'last_name',);
/* Checking if the column is set and if it is in the array of columns. If it is, it will return the
column, if not, it will return the first column in the array. */
$column = isset($_GET['column']) && in_array($_GET['column'], $columns) ? $_GET['column'] : $columns[0];
/* Checking if the order is set and if it is equal to desc. If it is, it will return DESC, if not, it
will return ASC. */
$sort_order = isset($_GET['order']) && strtolower($_GET['order']) == 'desc' ? 'DESC' : 'ASC';
/* Replacing the ASC and DESC with up and down. */
$up_or_down = str_replace(array('ASC','DESC'), array('up','down'), $sort_order);
/* Checking if the sort order is ASC and if it is, it will return desc, if not, it will return asc. */
$asc_or_desc = $sort_order == 'ASC' ? 'desc' : 'asc';

/* Selecting all the columns from the users table and the role_name column from the roles table. It is
also joining the two tables on the id_role column. It is also ordering the results by the column and
sort order. */
$sql = "SELECT u.*, r.role_name FROM users u JOIN roles r ON u.id_role = r.id_role WHERE u.id_user != 1 ORDER BY " . $column . " " . $sort_order;
$result = $conn->query($sql);

$nrRows = mysqli_num_rows($result);
?>

<script>
$(document).ready(function(){
	/* Checking all the checkboxes. */
    $('#chk_all').click(function(){
        if(this.checked)
            $(".chkbox").prop("checked", true);
        else
            $(".chkbox").prop("checked", false);
    });
});

function myFunction() {
  // Declare variables
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("myInput");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable");
  tr = table.getElementsByTagName("tr");

  // Loop through all table rows, and hide those who don't match the search query
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[1];
    if (td) {
      txtValue = td.textContent || td.innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }
  }
}
</script>

<div class="container-xxl">
	<div class="table-responsive">
		<div class="table-wrapper">
			<form action="deleteUser.php" method="post">
				<div class="table-title">
					<div class="row">
						<div class="col-sm-6">
							<h2>Manage <b>Users</b></h2>
						</div>

						<div class="col-sm-6">
							<a href="#addUserModal" class="btn btn-success" data-toggle="modal"><i class="material-icons">&#xE147;</i> <span>Add New User</span></a>

							<!-- Button trigger modal -->
							<button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteUsersModal">
								<i class="material-icons">&#xE15C;</i> <span>Delete</span>
							</button>

							<!-- Modal -->
							<div class="modal fade" id="deleteUsersModal" tabindex="-1" aria-labelledby="deleteUsersModalLabel" aria-hidden="true">
								<div class="modal-dialog">
									<div class="modal-content text-dark">
										<div class="modal-header">
											<h5 class="modal-title" id="deleteUsersModalLabel">Delete Users</h5>
											<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
										</div>

										<div class="modal-body">
											<p>Are you sure you want to delete the selected users?</p>
											<p class="text-danger">
												<b>Note:</b>
												<span>This action cannot be undone.</span>
											</p>
										</div>

										<div class="modal-footer">
											<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
											<button type="submit" name="submit" class="btn btn-danger">Delete</button>
										</div>
									</div>
								</div>
							</div> <!-- End of Modal -->

							<input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search for Username..">
						</div> <!-- End of col-sm-6 -->
					</div> <!-- End of row -->
				</div> <!-- End of table-title -->

				<table class="table table-striped table-hover" id="myTable">
					<thead>
						<tr class="bg-light">
							<th><input id="chk_all" name="chk_all" type="checkbox"  /></th>
							<th><a href="?column=username&order=<?php echo $asc_or_desc; ?>">Username<i class="fas fa-sort<?php echo $column == 'username' ? '-' . $up_or_down : ''; ?>"></i></a></th>
							<th><a href="?column=role_name&order=<?php echo $asc_or_desc; ?>">Role<i class="fas fa-sort<?php echo $column == 'role_name' ? '-' . $up_or_down : ''; ?>"></i></a></th>
							<th><a href="?column=first_name&order=<?php echo $asc_or_desc; ?>">First name<i class="fas fa-sort<?php echo $column == 'first_name' ? '-' . $up_or_down : ''; ?>"></i></a></th>
							<th><a href="?column=last_name&order=<?php echo $asc_or_desc; ?>">Last name<i class="fas fa-sort<?php echo $column == 'last_name' ? '-' . $up_or_down : ''; ?>"></i></a></th>
							<th><a href="?column=email&order=<?php echo $asc_or_desc; ?>">Email<i class="fas fa-sort<?php echo $column == 'email' ? '-' . $up_or_down : ''; ?>"></i></a></th>
							<th>Operations</th>
						</tr>
					</thead>

					<tbody>
					<?php
						if ($result->num_rows > 0) {
							while($row = $result->fetch_assoc()) {
					?>
						<tr>
							<td><input name="chk_id[]" type="checkbox" class="chkbox" value="<?php echo $row['id_user']; ?>"/></td>
							<td><?php echo $row['username'] ?></td>
							<td><?php echo $row['role_name'] ?></td>
							<td><?php echo $row['first_name'] ?></td>
							<td><?php echo $row['last_name'] ?></td>
							<td><?php echo $row['email'] ?></td>
							<td>
								<a href="#editUserModal" class="edit" data-toggle="modal">
									<i class="material-icons" data-toggle="tooltip" title="Edit">&#xE254;</i>
									<a href="editUser.php?idUser=<?php echo $row['id_user'] ?>" class="edit" ></a>
								</a>

								<a href="deleteUser.php?idUser=<?php echo $row['id_user'] ?>" class="delete" >
									<i class="material-icons" title="Delete">&#xE872;</i>
								</a>
							</tr>
					<?php
							}
						} else {
							echo "0 results";
						}
					?>
					</tbody>
				</table> <!-- End of table -->
			</form> <!-- End of form -->

			<div class="clearfix">
				<div class="hint-text">Total: <b><?php echo $nrRows ?></b> entries</div>

				<ul class="pagination">
					<li class="page-item disabled"><a href="#">Previous</a></li>
					<li class="page-item active"><a href="#" class="page-link">1</a></li>
					<li class="page-item"><a href="#" class="page-link">2</a></li>
					<li class="page-item"><a href="#" class="page-link">3</a></li>
					<li class="page-item"><a href="#" class="page-link">Next</a></li>
				</ul>
			</div> <!-- End of clearfix -->
		</div> <!-- End of table-responsive -->
	</div> 	<!-- End of container -->
</div> 	<!-- End of content -->

<!-- Add Modal HTML -->
<div id="addUserModal" class="modal fade" enctype="multipart/form-data">
	<form action="addUser.php" method="POST" >
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title">Add User</h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				</div> <!-- End of modal-header -->

				<div class="modal-body">
					<div class="form-group">
						<label>Username</label>
						<input type="text" name="username" class="form-control" value=""  required>
					</div>
					<div class="form-group">
						<label>Password</label>
						<input type="password" name="password" class="form-control" value=""  required>
					</div>
					<div class="form-group">
						<label>Verify Password</label>
						<input type="password" name="verifyPassword" class="form-control" value=""  required>
					</div>
					<div class="form-group">
						<label>Role</label>
						<select class="form-select" aria-label="Default select example" name="id_role">
							<?php if (userIsSysAdmin()) { ?><option value="2">Admin</option><?php } ?>
							<option value="4">Profesor</option>
							<option value="3" selected>Student</option>
						</select>
					</div>
					<div class="form-group">
						<label>First name</label>
						<input type="text" name="firstName" class="form-control" value=""required>
					</div>
					<div class="form-group">
						<label>Last name</label>
						<input type="text" name="lastName" class="form-control" value=""required>
					</div>
					<div class="form-group">
						<label>Email</label>
						<input type="text" name="email" class="form-control" value="" required>
					</div>
				</div> <!-- End of modal-body -->

				<div class="modal-footer">
					<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
					<input type="submit" class="btn btn-success" name= "submit" value="Add">
				</div> <!-- End of modal-footer -->
			</div> <!-- End of modal-content -->
		</div> <!-- End of modal-dialog -->
	</form> <!-- End of form -->
</div>
<!-- End of addUserModal -->

<!-- Edit Modal HTML -->
<div id="editUserModal" class="modal fade" enctype="multipart/form-data">
	<form action="editUser.php" method="POST" >
	<div class="modal-dialog">
		<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title">Edit User</h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				</div>
				<div class="modal-body">
					<div class="form-group">
						<label>Username</label>
						<input type="text" class="form-control" value="<?php echo $username1 ?>" required>
					</div>
					<div class="form-group">
						<label>Role</label>
						<input type="email" class="form-control" value="" required>
					</div>
					<div class="form-group">
						<label>First name</label>
						<input type="text" class="form-control" required>
					</div>
					<div class="form-group">
						<label>Last name</label>
							<input type="text" class="form-control" required>
					</div>
					<div class="form-group">
						<label>Email</label>
						<input type="text" class="form-control" required>
					</div>
				</div>
				<div class="modal-footer">
					<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
					<input type="submit" class="btn btn-info" name= "submit" value="Save">
				</div>
			</form>
		</div>
	</div>
</div>
<!-- End of editUserModal -->

<!-- Add spacing at bottom of page to make it look better. -->
<div class="mt-5"></div>

<?php require_once 'temp-footer.php'; ?>
