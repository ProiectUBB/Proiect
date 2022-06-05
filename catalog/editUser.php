<?php
require 'header.php';

$userId = $_GET['idUser'];
$sql1 = "SELECT FROM users WHERE id_user = $userId";
$result1=mysqli_query($conn,$sql1);


// if ($result->num_rows > 0) {
//     while($row = $result->fetch_assoc()) {
//       $id_role1 = $row['id_role'];
//       $username1=$row['username'];
//       $password1=$row['password'];
//       $first_name1=$row['first_name'];
//       $last_name1=$row['last_name'];
//       $email1=$row['email'];
//     }
// } else {
//     echo "0 results";
// }


if ($_SERVER["REQUEST_METHOD"]=="POST") {

  if(isset($_POST['submit'])){
    $id_role=$_POST['id_role'];
    $username=$_POST['username'];
    $password=$_POST['password'];
    $first_name=$_POST['first_name'];
    $last_name=$_POST['last_name'];
    $email=$_POST['email'];

    echo $username;

    $sql="INSERT INTO  users (id_role, username, password, first_name, last_name, email)
    VALUES ('".$id_role."','".$username."','".$password."','".$first_name."','".$last_name."','".$email."')";
    $result=mysqli_query($conn,$sql);

    if($result){
      header("Location: http://localhost/Proiect11/catalog/users3.php"); /* Redirect browser */
      exit();
    }else{
      die(mysqli_error($conn));
    }
    exit();

  }
}
 ?>

 <!-- <div id="editUserModal" class="modal fade" method="POST" action="" target="_self" enctype="multipart/form-data">
 	<div class="modal-dialog">
 		<div class="modal-content">
 				<div class="modal-header">
 					<h4 class="modal-title">Edit User</h4>
 					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
 				</div>
        <div class="modal-body">
					<div class="form-group">
						<label>Username</label>
						<input type="text" name="username" class="form-control" value="<?php echo '$username1' ?>"  required>
					</div>
          <div class="form-group">
            <label>Password</label>
            <input type="password" name="password" class="form-control" value="<?php echo '$password1' ?>"  required>
          </div>
					<div class="form-group">
						<label>Role</label>
						<input type="text" name="id_role" class="form-control" value= "<?php echo '$id_role1' ?>" required>
					</div>
					<div class="form-group">
						<label>First name</label>
						<input type="text" name="first_name" class="form-control" value="<?php echo '$first_name1' ?>" required>
					</div>
					<div class="form-group">
						<label>Last name</label>
					<input type="text" name="last_name" class="form-control" value="<?php echo '$last_name1' ?>" required>
					</div>
					<div class="form-group">
						<label>Email</label>
						<input type="text" name="email" class="form-control" value="<?php echo '$email1' ?>" required>
					</div>
				</div>
 				<div class="modal-footer">
 					<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
 					<input type="submit" class="btn btn-info" name="submit" value="Save">
 				</div>
 		</div>
 	</div>
 </div> -->
