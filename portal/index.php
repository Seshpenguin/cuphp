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
    <title>Profile - ConnectUS v1.1</title>
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
            <h3 class="text-info">Experiences - <a href="submithours.php" class="btn btn-secondary btn-lg active" role="button">Add</a></h3>
            <!-- Experience Table -->
            <table class="table">
                <?php include("./template/profile-table-head.php"); ?>
                <?php include("./template/profile-table-body.php"); ?>
            </table>
            <br />
            <br />
            <form  method="post" action="user.php"><div class="form-group"><input type="text" class="form-control" id="username" placeholder="Exact Username" name="username"></div><button type="submit" class="btn btn-primary">Find a user's volunteer experience</button></form>
            <hr />

            <a href="../auth/logout.php" class="btn btn-secondary btn-lg active" role="button" aria-pressed="true">Logout</a> - <a href="./settings.php" class="btn btn-secondary btn-lg active" role="button" aria-pressed="true">Settings</a>
        </div>
        <br />
        <?php include '../skel/footer.php'; // load the header ?>
    </div>
</body>


</html>
