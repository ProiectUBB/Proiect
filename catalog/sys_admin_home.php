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
?>

<div class="container">
  <div class="row">
    <div class="col">
      <h2>Catalog online pentru seminarii și laboaratoare </h2>
      <br>
      <p>Administratorii pot adăuga, vizualiza, modifica și șterge utilizatori de tip profesor, student.</p>
      <p>Administratorii pot realiza toate activitățile realizate de profesori și studenți.</p>
    </div>
  </div>  
</div>

<?php require_once 'temp-footer.php'; ?>