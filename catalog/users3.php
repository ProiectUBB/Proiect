<?php
require_once 'functions.php';

if (!userIsLoggedIn()) { header("Location:index.php"); }
if ($_SESSION['idRol'] != 1) { header("Location:index.php"); }

require_once 'temp-header.php';
require_once 'temp-sidenav.php';

require_once 'config.php';

$sql = "SELECT u.*, r.role_name FROM users u JOIN roles r ON u.id_role = r.id_role";
$result = $conn->query($sql);
?>

<script>
$(document).ready(function(){
	// Activate tooltip
	$('[data-toggle="tooltip"]').tooltip();

	// Select/Deselect checkboxes
	var checkbox = $('table tbody input[type="checkbox"]');
	$("#selectAll").click(function(){
		if(this.checked){
			checkbox.each(function(){
				this.checked = true;
			});
		} else{
			checkbox.each(function(){
				this.checked = false;
			});
		}
	});
	checkbox.click(function(){
		if(!this.checked){
			$("#selectAll").prop("checked", false);
		}
	});
});
</script>
  <div class="container-xxl">
		<div class="table-responsive">
			<div class="table-wrapper">
				<div class="table-title">
					<div class="row">
						<div class="col-sm-6">
							<h2>Manage <b>Users</b></h2>
						</div>
						<div class="col-sm-6">
							<a href="#addUserModal" class="btn btn-success" data-toggle="modal"><i class="material-icons">&#xE147;</i> <span>Add New User</span></a>
							<a href="#deleteUserModal" class="btn btn-danger" data-toggle="modal" name="delete"><i class="material-icons">&#xE15C;</i> <span>Delete</span></a>
              <a href="sortUsername.php" class="btn btn-primary" data-toggle="modal"><i class="material-icons">&#xE164;</i> <span>Sort </span></a>
            </div>
					</div>
				</div>
				<table class="table table-striped table-hover">
					<thead>
						<tr bgcolor="#B6B6B6">
							<th>
								<span class="custom-checkbox">
									<input type="checkbox" id="selectAll">
									<label for="selectAll"></label>
								</span>
							</th>
							<th>Username</th>
							<th>Role</th>
							<th>First name</th>
							<th>Last name</th>
							<th>Email</th>
              				<th>Operations</th>
						</tr>
					</thead>
					<tbody>
	          <?php
	          if ($result->num_rows > 0) {
	              while($row = $result->fetch_assoc()) {
	          ?>
	          <tr>
	            <td>
	              <span class="custom-checkbox">
	                <input type="checkbox" id="checkbox1" name="selected" value="0">
	                <label for="checkbox1"></label>
	              </span>
	            </td>
	            <td><?php echo $row['username'] ?></td>
	                    <td><?php echo $row['role_name'] ?></td>
	            <td><?php echo $row['first_name'] ?></td>
	            <td><?php echo $row['last_name'] ?></td>
	            <td><?php echo $row['email'] ?></td>
	            <td>
	              <a href="#editUserModal" class="edit" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" title="Edit">&#xE254;</i>
	                <a href="editUser.php?idUser=<?php echo $row['id_user'] ?>" class="edit" ></a>
	              </a>
	              <a href="deleteUser.php?idUser=<?php echo $row['id_user'] ?>" class="delete" ><i class="material-icons" title="Delete">&#xE872;</i></a>
	          </tr>
	          <?php
	              }
	          } else {
	              echo "0 results";
	          }
	          ?>


					</tbody>
				</table>
				<div class="clearfix">
					<div class="hint-text">Total: <b><?php echo $nrRows ?></b> entries</div>
					<ul class="pagination">
						<li class="page-item disabled"><a href="#">Previous</a></li>
						<li class="page-item active"><a href="#" class="page-link">1</a></li>
						<li class="page-item"><a href="#" class="page-link">2</a></li>
						<li class="page-item"><a href="#" class="page-link">3</a></li>
						<li class="page-item"><a href="#" class="page-link">Next</a></li>
					</ul>
				</div>
			</div>
		</div>
	</div>

	<!-- Add Modal HTML -->
	<div id="addUserModal" class="modal fade" enctype="multipart/form-data">
	  <form action="addUser.php" method="POST" >
		<div class="modal-dialog">
			<div class="modal-content">
					<div class="modal-header">
						<h4 class="modal-title">Add User</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					</div>
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
								<option value="2">Admin</option>
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
					</div>
					<div class="modal-footer">
						<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
						<input type="submit" class="btn btn-success" name= "submit" value="Add">
					</div>
				</form>
			</div>
		</div>
	</div>
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
<!-- Delete Modal HTML -->
	<div id="deleteUserModal" class="modal fade">
	  <form action="deleteUser.php" method="POST" >
		<div class="modal-dialog">
			<div class="modal-content">
				<form>
					<div class="modal-header">
						<h4 class="modal-title">Delete User</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					</div>
					<div class="modal-body">
						<p>Are you sure you want to delete these Records?</p>
						<p class="text-warning"><small>This action cannot be undone.</small></p>
					</div>
					<div class="modal-footer">
						<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
						<input type="submit" class="btn btn-danger" name="submit" value="Delete">
					</div>
				</form>
			</div>
		</div>
	</div>

<?php require_once 'temp-footer.php'; ?>