
<?php
session_start();
// Destroying All Sessions
if(session_destroy())
{
// Redirecting To Home Page
    header("Location: ./login.php");
    die();

} else {
    ?>
    <p>An unexpected error has occured (unable to session_destory).</p>
    <?php
}
?>