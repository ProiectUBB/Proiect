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
  <a href="https://calendar.google.com/calendar/u/0/r"><i class="fa fa-calendar-minus-o"></i> Calendar</a>
  <button class="dropdown-btn"><i class="fa fa-sticky-note-o"></i> Seminars
    <i class="fa fa-caret-down"></i>
  </button>
  <div class="dropdown-container">
    <a href="#">Attendances</a>
  </div>
  <button class="dropdown-btn"><i class="fa fa-cogs"></i> Labs
    <i class="fa fa-caret-down"></i>
  </button>
  <div class="dropdown-container">
    <a href="#">Attednances</a>
    <a href="#">Grades</a>
  </div>
  <a href="logout.php"><i class="fa fa-window-close"></i> Logout</a>
</div>

<div class="main">
  <h2>Catalog online pentru seminarii și laboaratoare </h2>
  <br>
  <p>Profesorii au posibilitatea de a vizualiza atât prezențele, cât și notele oferite la seminarii și laboratoare.</p>
  <p>Profesorii pot adăuga, modifica, șterge prezențe și note ale studențiilor care frecventează seminariile și laboratoarele coordonate de ei.</p>
  <p>Profesorii pot vizualiza diferite rapoarte generate pentru seminariile și laboratoarele coordonate de ei (numărul de studenți care au predat o anumită temă, numărul de studenți care nu au predat o anumită temă, procentul de predare pentru o anumită temă, etc.)</p>

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
