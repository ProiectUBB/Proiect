<?php 
require_once 'temp-header.php'; 
require_once 'functions.php';

if ($_SERVER["REQUEST_METHOD"]=="POST" && isset($_POST["submit"])) {
    $firstname = sanitizare($_POST["firstname"]);
    $lastname = sanitizare($_POST["lastname"]);
    $lastname = sanitizare($_POST["email"]);
    $lastname = sanitizare($_POST["subject"]);

    $success = "Message succesfully sent!";
}
?>

<header>
    <div class="container-fluid">
        <?php require_once 'temp-subheader.php'; ?>

        <?php require_once 'temp-mainnav.php'; ?>
    </div>
</header>

<div class="container-fluid">
    <div class="row p-5">
        <div class="col">
            <h4>Contact Form</h4>

            <?php if ($success) { ?>
                <div class="alert alert-success" role="alert">
                    <?php echo $success; ?>
                </div>
            <?php } ?>

            <form class="m-1 bg-light p-5" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post">
                <div class="mb-3">
                    <label for="firstname" class="form-label">First Name</label>
                    <input type="text" class="form-control" id="firstname" name="firstname" placeholder="Your name..." required >
                </div>

                <div class="mb-3">
                    <label for="lastname" class="form-label">Last Name</label>
                    <input type="text" class="form-control" id="lastname" name="lastname" placeholder="Your last name..." required >
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email address</label>
                    <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp" placeholder="Your email..." required >
                    <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                </div>

                <div class="mb-3">
                    <label for="subject" class="form-label">Subject</label>
                    <textarea class="form-control" id="subject" name="subject" rows="3" placeholder="Write something..." required ></textarea>
                </div>

                <button type="submit" name="submit" class="btn btn-lg btn-success">Submit</button>
            </form>
        </div>
    </div>   
</div>

<!-- Add spacing at bottom of page to make it look better. -->
<div class="mt-5"></div>

<?php require_once 'temp-footer.php'; ?>