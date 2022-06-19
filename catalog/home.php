<?php
require_once 'functions.php';

/* If the user is not logged in, it redirects to the index page. */
if (!userIsLoggedIn()) { header("Location:index.php"); }


require_once 'temp-header.php';
require_once 'temp-sidenav.php';
require_once 'temp-dashboard-header.php';

require_once 'config.php';
?>

<div class="container">
  <div class="row">
    <div class="col">
        <h1>Dashboard</h1>

        <h2>Catalog online pentru seminarii și laboaratoare </h2>
        
        <br>
        
        <?php if (userIsSysAdmin()) { /* If user is logged in as SYSADMIN */ ?> 
          <p>System Administratorii pot adăuga, vizualiza, modifica și șterge utilizatori de tip admin, profesor, student.</p>
          <p>System Administratorii pot realiza toate activitățile realizate de admin, profesori și studenți.</p>
        <?php } elseif (userIsAdmin()) { /* If user is logged in as ADMIN */ ?> 
          <p>Administratorii pot adăuga, vizualiza, modifica și șterge utilizatori de tip profesor, student.</p>
          <p>Administratorii pot realiza toate activitățile realizate de profesori și studenți.</p>            
        <?php } elseif (userIsTeacher()) { /* If user is logged in as TEACHER */ ?> 
          <p>Profesorii au posibilitatea de a vizualiza atât prezențele, cât și notele oferite la seminarii și laboratoare.</p>
          <p>Profesorii pot adăuga, modifica, șterge prezențe și note ale studențiilor care frecventează seminariile și laboratoarele coordonate de ei.</p>
          <p>Profesorii pot vizualiza diferite rapoarte generate pentru seminariile și laboratoarele coordonate de ei (numărul de studenți care au predat o anumită temă, numărul de studenți care nu au predat o anumită temă, procentul de predare pentru o anumită temă, etc.)</p>
        <?php } elseif (userIsStudent()) { /* If user is logged in as STUDENT */ ?> 
          <p>Studenții au posibilitatea de a vizualiza atât prezențele, cât și notele primite la seminarii și laboratoare.</p>
          <p>Studenții au îndatorirea de a urmări numărul de prezențe pentru a se asigura că împlinesc numărul minim necesar pentru a intra în examen.</p>
        <?php } else { header("Location:index.php"); } ?>
    </div> <!-- End of col -->
  </div> <!-- End of row -->
</div> <!-- End of container -->

<!-- Add spacing at bottom of page to make it look better. -->
<div class="mt-5"></div> 

<?php require_once 'temp-footer.php'; ?>