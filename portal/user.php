<?php 
session_start(); 
include('../api/api.php');
?>
<!doctype html>
<html lang="en">

<head>
    <title>ConnectUS Alpha - User Profile</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    
</head>

<body>
    <div class="container">
        <?php include '../skel/header.php'; // load the header ?>
        <div class="container">
            <h2>Lookup User: <?php
                // Query the user's name from the token
                $username = $_REQUEST["username"];
                echo "$username";
            ?></h2>

            <h4><?php 
                // Query the user's meta data (ex. school)
                //echo 'Foobar SS.';
            ?></h4>
            <!-- Content here -->
            <hr />
            <h3 class="text-info">Experiences</h3> 
            <!-- Experience Table -->
            <table class="table">
                <?php include("./template/profile-table-head.php"); ?>
                <?php include("./template/profile-table-body.php"); ?>
            </table>
            <a href="../" class="btn btn-secondary btn-lg active" role="button" aria-pressed="true">Back</a>
        </div>
        <br />
        <?php include '../skel/footer.php'; // load the header ?>
    </div>
</body>


</html>