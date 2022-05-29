<!DOCTYPE html>

<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="css/homepage.css">

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
    <a href="admin_home.php">Admin</a>
    <a href="profesor_home.php">Teacher</a>
    <a href="student_home.php">Student</a>
  </div>

  <button class="dropdown-btn"><i class="fa fa-sticky-note-o"></i> C.R.U.D.
    <i class="fa fa-caret-down"></i>
  </button>
  <div class="dropdown-container">
    <a href="sys_admin_home_admin.php">Admin</a>
    <a href="sys_admin_home_profesor.php">Teacher</a>
    <a href="sys_admin_home_student.php">Student</a>
  </div>

  <a href="logout.php"><i class="fa fa-window-close"></i> Logout</a>
</div>

<div class="main">
<div class="despre rol">
  <h2>Catalog online pentru seminarii și laboaratoare </h2>
  <br>
  <p>Administratorii pot adăuga, vizualiza, modifica și șterge utilizatori de tip profesor, student.</p>
  <p>Administratorii pot realiza toate activitățile realizate de profesori și studenți.</p>

  </div>
<div class="CrReUpDe">
  <button class="CRUD"><a href="sys_admin_home_student_create.php">Create a student</a></button>
<button class="CRUD">Read info about a student</button>
<button class="CRUD">Print all students</button>
<button class="CRUD">Update a student</button>
<button class="CRUD">Delete a student</button>




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
