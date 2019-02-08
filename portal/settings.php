<?php 
session_start(); 
if(!isset($_SESSION["token"])) { // User not signed in
    header("Location: ../auth/login.php");
    exit();
}


include('../api/api.php');
?>
<!doctype html>
<html lang="en">

<head>
    <title>Settings - ConnectUS v1.1</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

</head>

<body>
    <div class="container">
        <?php include '../skel/header.php'; // load the header ?>
        <div class="container">
            <?php include("./template/profile-meta-head.php") ?>

            <!-- Content here -->
            <hr />
            <h3 class="text-info">Settings</h3>
            <!-- Setting form -->
            <form>
                <div class="form-group">
                    <label for="interests">Interest</label>
                    <input type="email" class="form-control" id="interests" aria-describedby="interestSub" placeholder="Enter interests" name="interests">
                    <small id="interestSub" class="form-text text-muted">Write down some things that interest you.</small>
                </div>
                <div class="form-group">
                    <label for="biography">Biography</label>
                    <input type="text" class="form-control" id="biography" placeholder="Biography" name="biography">
                </div>
                <div class="form-group">
                    <label for="quote">Quote</label>
                    <input type="text" class="form-control" id="quote" placeholder="Quote" name="biography">
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
            <a href="./index.php" class="btn btn-secondary btn-lg active" role="button" aria-pressed="true">Save</a>
            <br />

            <hr />

            <a href="./index.php" class="btn btn-secondary btn-lg active" role="button" aria-pressed="true">Back</a>
        </div>
        <br />
        <?php include '../skel/footer.php'; // load the header ?>
    </div>
</body>


</html>
