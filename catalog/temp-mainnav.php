<?php 
require_once 'functions.php'; 
?>

<nav class="navbar navbar-expand-lg bg-dark">
    <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">          
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">                                    
                    <a class="nav-link" aria-current="page" href="index.php"><i class="fa fa-fw fa-home"></i> Home</a>
                </li>
                <?php if (userIsLoggedIn()) { 
                    if ($_SESSION['idRol'] == 1) { ?>
                    <li class="nav-item">
                        <a class="nav-link" href="sys_admin_home.php"><i class="fa fa-fw fa-dashboard"></i> Dashboard</a>
                    </li>
                <?php } elseif ($_SESSION['idRol'] == 2) { ?>
                    <li class="nav-item">
                        <a class="nav-link" href="admin_home.php"><i class="fa fa-fw fa-dashboard"></i> Dashboard</a>
                    </li>
                <?php } elseif ($_SESSION['idRol'] == 4) { ?>
                    <li class="nav-item">
                        <a class="nav-link" href="profesor_home.php"><i class="fa fa-fw fa-dashboard"></i> Dashboard</a>
                    </li>
                <?php } elseif ($_SESSION['idRol'] == 3) { ?>
                    <li class="nav-item">
                        <a class="nav-link" href="student_home.php"><i class="fa fa-fw fa-dashboard"></i> Dashboard</a>
                    </li>
                <?php } } else { ?>
                    <li class="nav-item">
                        <a class="nav-link" href="login.php"><i class="fa fa-fw fa-user"></i> Login</a>
                    </li> 
                    <li class="nav-item">
                        <a class="nav-link" href="inregistrare.php"><i class="fa fa-fw fa-user"></i> Register</a>
                    </li> 
                <?php } ?>
                <li class="nav-item">
                    <a class="nav-link" href="http://www.cs.ubbcluj.ro/invatamant/programe-postuniversitare/pregatire-si-formare-profesionala-in-informatica/structura-anului-academic/"><i class="fa fa-fw fa-calendar"></i>Structura anului academic</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="contact.php"><i class="fa fa-fw fa-envelope"></i> Contact</a>
                </li> 
                <?php if (userIsLoggedIn()) { ?>
                <li class="nav-item">
                    <a class="nav-link" href="logout.php"><i class="fa fa-fw fa-user"></i> Logout</a>
                </li>
                <?php } ?>
            </ul>

            <?php if (userIsLoggedIn()) { ?>
            <span class="navbar-text">
                    logged in as: <b><?php echo $_SESSION["Username"] ?></b>
            </span>   
            <?php } ?> 
        </div>
    </div>
</nav>