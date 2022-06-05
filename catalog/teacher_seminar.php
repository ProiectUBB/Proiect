<!DOCTYPE html>
<style>
body {
	color: #566787;
	background: #f5f5f5;
	font-family: 'Varela Round', sans-serif;
	font-size: 13px;
	margin-right:0px;
}
.dam_note{
	margin-right:0px;
	width:30%;
}
.container{
	margin-left: 250px !important;
	margin-right: 100px;
	width: 200px;
	

}
.edit_delete{
	margin-left: 400px;
	margin-right:0px;
	width: 190%;
	align: centered;
}
.student-list-container {
	margin-left: 0px;
}
div#deleteEmployeeModal{
	margin-left: 450px;
	position: center;
}
div#editEmployeeModal{
	margin-left: 450px;
	position: center;
}
div#addEmployeeModal{
	margin-left: 450px;
	position: center;
}
.table-responsive {
    margin-left: 300px ;
}
.table-wrapper {
	background: #fff;
	padding: 20px 25px;
	border-radius: 3px;
	min-width: 200px;
	box-shadow: 0 1px 1px rgba(0,0,0,.05);
}
.table-title {
	padding-bottom: 15px;
	background-color: #555;
	color: #fff;
	padding: 16px 30px;
	min-width: 50%;
	height: 100px;
	margin: -20px -25px 10px;
	border-radius: 3px 3px 0 0;
}
.table-title h2 {
	margin-left: 5px;
	margin-right: 300px;
	margin-bottom: 0px;
	font-size: 24px;
	background-color: #555;
}
.table-title .btn-group {
	float: right;
}
.table-title .btn {
	color: #fff;
	float: right;
	font-size: 13px;
	border: none;
	min-width: 50px;
	border-radius: 2px;
	border: none;
	outline: none !important;
	margin-left: 10px;
}
.table-title .btn i {
	float: left;
	font-size: 21px;
	margin-right: 5px;
}
.table-title .btn span {
	float: left;
	margin-top: 2px;
}
table.table tr th, table.table tr td {
	border-color: #e9e9e9;
	padding: 12px 15px;
	vertical-align: middle;
}
table.table tr th:first-child {
	width: 60px;
}
table.table tr th:last-child {
	width: 100px;
}
table.table-striped tbody tr:nth-of-type(odd) {
	background-color: #fcfcfc;
}
table.table-striped.table-hover tbody tr:hover {
	background: #f5f5f5;
}
table.table th i {
	font-size: 13px;
	margin: 0 5px;
	cursor: pointer;
}
table.table td:last-child i {
	opacity: 0.9;
	font-size: 22px;
	margin: 0 5px;
}
table.table td a {
	font-weight: bold;
	color: #566787;
	display: inline-block;
	text-decoration: none;
	outline: none !important;
}
table.table td a:hover {
	color: #2196F3;
}
table.table td a.edit {
	color: #FFC107;
}
table.table td a.delete {
	color: #F44336;
}
table.table td i {
	font-size: 19px;
}
table.table .avatar {
	border-radius: 50%;
	vertical-align: middle;
	margin-right: 10px;
}
.pagination {
	float: right;
	margin: 0 0 5px;
}
.pagination li a {
	border: none;
	font-size: 13px;
	min-width: 30px;
	min-height: 30px;
	color: #999;
	margin: 0 2px;
	line-height: 30px;
	border-radius: 2px !important;
	text-align: center;
	padding: 0 6px;
}
.pagination li a:hover {
	color: #666;
}
.pagination li.active a, .pagination li.active a.page-link {
	background: #03A9F4;
}
.pagination li.active a:hover {
	background: #0397d6;
}
.pagination li.disabled i {
	color: #ccc;
}
.pagination li i {
	font-size: 16px;
	padding-top: 6px
}
.hint-text {
	float: left;
	margin-top: 10px;
	font-size: 13px;
}
/* Custom checkbox */
.custom-checkbox {
	position: relative;
}
.custom-checkbox input[type="checkbox"] {
	opacity: 0;
	position: absolute;
	margin: 5px 0 0 3px;
	z-index: 9;
}
.custom-checkbox label:before{
	width: 18px;
	height: 18px;
}
.custom-checkbox label:before {
	content: '';
	margin-right: 10px;
	display: inline-block;
	vertical-align: text-top;
	background: white;
	border: 1px solid #bbb;
	border-radius: 2px;
	box-sizing: border-box;
	z-index: 2;
}
.custom-checkbox input[type="checkbox"]:checked + label:after {
	content: '';
	position: absolute;
	left: 6px;
	top: 3px;
	width: 6px;
	height: 11px;
	border: solid #000;
	border-width: 0 3px 3px 0;
	transform: inherit;
	z-index: 3;
	transform: rotateZ(45deg);
}
.custom-checkbox input[type="checkbox"]:checked + label:before {
	border-color: #03A9F4;
	background: #03A9F4;
}
.custom-checkbox input[type="checkbox"]:checked + label:after {
	border-color: #fff;
}
.custom-checkbox input[type="checkbox"]:disabled + label:before {
	color: #b8b8b8;
	cursor: auto;
	box-shadow: none;
	background: #ddd;
}
/* Modal styles */
.modal .modal-dialog {
	max-width: 400px;
}
.modal .modal-header, .modal .modal-body, .modal .modal-footer {
	padding: 20px 30px;
}
.modal .modal-content {
	border-radius: 3px;
	font-size: 14px;
}
.modal .modal-footer {
	background: #ecf0f1;
	border-radius: 0 0 3px 3px;
}
.modal .modal-title {
	display: inline-block;
}
.modal .form-control {
	border-radius: 2px;
	box-shadow: none;
	border-color: #dddddd;
}
.modal textarea.form-control {
	resize: vertical;
}
.modal .btn {
	border-radius: 2px;
	min-width: 100px;
}
.modal form label {
	font-weight: normal;
}
</style>
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
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="css/homepage.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
    <link rel="stylesheet" href="includes/style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
    <script src="includes/script.js"></script>
    <meta name="viewport" content="initial-scale=1, user-scalable=no">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
<div class="sidenav">
  <a href="cont.php"><i class="fa fa-address-card"></i>  Cont</a>
  <a href="users.php"><i class="fa fa-users"></i>  Users</a>
  <a href="https://calendar.google.com/calendar/u/0/r"><i class="fa fa-calendar-minus-o"></i> Calendar</a>
  <button class="dropdown-btn"><i class="fa fa-sticky-note-o"></i> Log as
    <i class="fa fa-caret-down"></i>
  </button>
  <div class="dropdown-container">
  <a href="sys_admin_home_as_sys_admin_CRUD.php">Sys Admin</a>
    <a href="sys_admin_home_as_admin_CRUD.php">Admin</a>
    <a href="sys_admin_home_as_profesor_CRUD.php">Teacher</a>
    <a href="sys_admin_home_as_student_CRUD.php">Student</a>
  </div>
  <a href="logout.php"><i class="fa fa-window-close"></i> Logout</a>
</div>
<div class="dam_note">
 <div class="container">
    <div>
        <!-- only show this element when the isnt on mobile -->
        <h1 class="hidden-xs hidden-sm">Student Attendance at Seminar Table
        </h1>
        <!-- only show this element when the user gets to a mobile version -->   
    </div>
    <hr />
    <div class="student-add-form pull-right col-sm-3">
        <h4>Add Student</h4>
        <div class="input-group" id="firstDiv" style = "margin-bottom: 10px">
            <span class="input-group-addon">
                <span class="glyphicon glyphicon-user"></span>
            </span>
            <input type="text" class="form-control" name="studentName" id="studentName" placeholder="Student First Name" value="">
        </div>
        <div class="alert alert-warning hidden" id="name-alert" role="alert" style="padding: 5px 15px">
            <span class="glyphicon glyphicon-exclamation-sign"></span>
            Must contain at least 3 letters
        </div>
		<div class="input-group" id="firstDiv" style = "margin-bottom: 10px">
            <span class="input-group-addon">
                <span class="glyphicon glyphicon-user"></span>
            </span>
            <input type="text" class="form-control" name="studentName" id="studentName" placeholder="Student Last Name" value="">
        </div>
        <div class="alert alert-warning hidden" id="name-alert" role="alert" style="padding: 5px 15px">
            <span class="glyphicon glyphicon-exclamation-sign"></span>
            Must contain at least 3 letters
        </div>
        <div class="input-group" id="secondDiv" style = "margin-bottom: 10px">
            <span class="input-group-addon">
                <span class="glyphicon glyphicon-list-alt"></span>
            </span>
            <input type="text" class="form-control" name="course" id="course" value=""
                   placeholder="Student Course">
        </div>
        <div class="alert alert-warning hidden" id="course-alert" role="alert" style="padding: 5px 15px">
            <span class="glyphicon glyphicon-exclamation-sign"></span>
            Course name required
        </div>
		<div class="input-group" id="secondDiv" style = "margin-bottom: 10px">
            <span class="input-group-addon">
                <span class="glyphicon glyphicon-list-alt"></span>
            </span>
            <input type="radio" class="form-control" name="attendance" id="present" value="present">
			<label for="attendance">present</label>  
					<input type="radio" class="form-control" name="attendance" id="absent" value="absent">
					<label for="attendance">absent</label>
        </div>
        <div class="alert alert-warning hidden" id="attendance" role="alert" style="padding: 5px 15px">
            <span class="glyphicon glyphicon-exclamation-sign"></span>
            Attendance required
        </div>
		<div class="input-group" id="thirdDiv" style = "margin-bottom: 10px">
            <span class="input-group-addon">
                <span class="glyphicon glyphicon-calendar"></span>
            </span>
            <input type="date" class="form-control" name="dataGrade" id="dataGrade" value=""
                   placeholder="Data Grade">
        </div>
        <div class="alert alert-warning hidden" id="grade-alert" role="alert" style="padding: 5px 15px">
            <span class="glyphicon glyphicon-exclamation-sign"></span>
            Must be between 0-100
        </div>
        <button type="button" class="btn-success btn-outline-light btn-sm addBtn" style = "margin-bottom: 10px" onclick=""><span class="glyphicon glyphicon-plus"></span> Add</button>
        <button type="button" class="btn-default btn-sm" style = "margin-bottom: 10px" onclick="">Cancel</button>
        <div class="displayError">
        </div>
    </div>
    <div class="student-list-container pull-left col-sm-6">
        <table class="student-list table table-hover">
            <thead class="thead">
            <tr>
                <th>Student First Name</th>
				<th>Student Last Name</th>
                <th>Student Course</th>
				<th>Attendance</th>
				<th>Data</th>
                <th class="hidden-xs ">Operations</th>
                <th class="visible-xs hidden-sm hidden-md hidden-lg">Ops</th>
            </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
</div>
<div class="edit_delete">
		<div id="updateModal" class="updateModal" role="dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h3 class="modal-title bg-warning">Edit Student</h3>
				</div>
				<div class="modal-body">
					<h5>Enter the new info:</h5>
					<div class="input-group" id="firstDiv" style = "margin-bottom: 10px">
            <span class="input-group-addon">
                <span class="glyphicon glyphicon-user"></span>
            </span>
            <input type="text" class="form-control" name="studentName" id="studentName" placeholder="Student First Name" value="">
        </div>
        <div class="alert alert-warning hidden" id="name-alert" role="alert" style="padding: 5px 15px">
            <span class="glyphicon glyphicon-exclamation-sign"></span>
            Must contain at least 3 letters
        </div>
		<div class="input-group" id="firstDiv" style = "margin-bottom: 10px">
            <span class="input-group-addon">
                <span class="glyphicon glyphicon-user"></span>
            </span>
            <input type="text" class="form-control" name="studentName" id="studentName" placeholder="Student Last Name" value="">
        </div>
        <div class="alert alert-warning hidden" id="name-alert" role="alert" style="padding: 5px 15px">
            <span class="glyphicon glyphicon-exclamation-sign"></span>
            Must contain at least 3 letters
        </div>
        <div class="input-group" id="secondDiv" style = "margin-bottom: 10px">
            <span class="input-group-addon">
                <span class="glyphicon glyphicon-list-alt"></span>
            </span>
            <input type="text" class="form-control" name="course" id="course" value=""
                   placeholder="Student Course">
        </div>
        <div class="alert alert-warning hidden" id="course-alert" role="alert" style="padding: 5px 15px">
            <span class="glyphicon glyphicon-exclamation-sign"></span>
            Course name required
        </div>
		<div class="input-group" id="secondDiv" style = "margin-bottom: 10px">
            <span class="input-group-addon">
                <span class="glyphicon glyphicon-list-alt"></span>
            </span>
            <input type="radio" class="form-control" name="attendance" id="present" value="present">
			<label for="attendance">present</label>  
					<input type="radio" class="form-control" name="attendance" id="absent" value="absent">
					<label for="attendance">absent</label>
        </div>
        <div class="alert alert-warning hidden" id="attendance" role="alert" style="padding: 5px 15px">
            <span class="glyphicon glyphicon-exclamation-sign"></span>
            Attendance required
        </div>
		<div class="input-group" id="thirdDiv" style = "margin-bottom: 10px">
            <span class="input-group-addon">
                <span class="glyphicon glyphicon-calendar"></span>
            </span>
            <input type="date" class="form-control" name="dataGrade" id="dataGrade" value=""
                   placeholder="Data Grade">
        </div>
        <div class="alert alert-warning hidden" id="grade-alert" role="alert" style="padding: 5px 15px">
            <span class="glyphicon glyphicon-exclamation-sign"></span>
            Must be between 0-100
        </div>
			<div class="error"></div>
			     	</div>
				<div class="modal-footer">
					<button class="btn btn-secondary cancelEditBtn">Cancel</button>
					<button class="btn btn-success saveBtn">Save</button>
				</div>
			</div>
		</div>
		<div id="delModal" class="delModal" role="dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h3 class="modal-title bg-danger">Delete Student</h3>
					<h5>Do you wish to delete this student?</h5>
				</div>
				<div class="modal-body del-modal-body">
				</div>
				<div class="modal-footer del-footer" id="del-modal-footer">
					<button class="btn btn-secondary cancelDelBtn">Cancel</button>
					<button class="btn btn-danger delBtn">Delete</button>
				</div>

			</div>  
		</div>
	</div>
<!-- Edit Modal HTML -->
<div id="addEmployeeModal" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<form>
				<div class="modal-header">
					<h4 class="modal-title">Add User</h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				</div>
				<div class="modal-body">
				<div class="form-group">
						<label>Id Role</label><br>
						<input type="radio" class="form-control" id="2" name="id_role" value="admin">
						<label for="sys_admin">admin</label><br>
						<input type="radio" class="form-control" id="4" name="id_role" value="teacher">
						<label for="teacher">sys-admin</label><br>
						<input type="radio" class="form-control" id="3" name="id_role" value="student">
						<label for="student">sys-admin</label><br>
					</div>
				    <div class="form-group">
						<label>Username</label>
						<input type="text" class="form-control" required>
					</div>
					<div class="form-group">
						<label>Password</label>
						<input type="text" class="form-control" required>
					</div>
					<div class="form-group">
						<label>First Name</label>
						<input type="text" class="form-control" required>
					</div>
					<div class="form-group">
						<label>Last Name</label>
						<input type="text" class="form-control" required>
					</div>
					<div class="form-group">
						<label>Email</label>
						<input type="email" class="form-control" required>
					</div>
				</div>
				<div class="modal-footer">
					<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
					<input type="submit" class="btn btn-success" value="Add">
				</div>
			</form>
		</div>
	</div>
</div>
</div>
<!-- Edit Modal HTML -->
<div id="editEmployeeModal" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<form>
				<div class="modal-header">
					<h4 class="modal-title">Edit User</h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				</div>
				<div class="modal-body">
				    <div class="form-group">
						<label>Username</label>
						<input type="text" class="form-control" required>
					</div>
					<div class="form-group">
						<label>Password</label>
						<input type="text" class="form-control" required>
					</div>
					<div class="form-group">
						<label>First Name</label>
						<input type="text" class="form-control" required>
					</div>
					<div class="form-group">
						<label>Last Name</label>
						<input type="text" class="form-control" required>
					</div>
					<div class="form-group">
						<label>Email</label>
						<input type="email" class="form-control" required>
					</div>
				</div>
				<div class="modal-footer">
					<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
					<input type="submit" class="btn btn-info" value="Save">
				</div>
			</form>
		</div>
	</div>
</div>
<!-- Delete Modal HTML -->
<div id="deleteEmployeeModal" class="modal fade">
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
					<input type="submit" class="btn btn-danger" value="Delete">
				</div>
			</form>
		</div>
	</div>
</div>
</div>
<script>
/* Loop through all dropdown buttons to toggle between hiding and showing its dropdown content - This allows the user to have multiple dropdowns without any conflict */
var dropdown = document.getElementsByClassName("dropdown-btn");
var i;
for (i = 0; i < dropdown.length; i++) {
  dropdown[i].addEventListener("click", function() {
    this.classList.toggle("active");
    var dropdownContent = this.nextElementSibling;
    if (dropdownContent.style.display === "block") {
      dropdownContent.style.display = "none";
    } else {
      dropdownContent.style.display = "block";
    }
  });
}
</script>
</body>
</html>
