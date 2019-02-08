<?php 
    // ConnectUS Frontend Software (CUFS)
    session_start();
     if(!isset($_SESSION["token"])) { // User not signed in
        header("Location: auth/login.php");
        exit();
    } else {
        header("Location: portal/");
        exit();
    }
?>
