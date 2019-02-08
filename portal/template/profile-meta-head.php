<?php
// GET the user's profile

// Data to send to the backend
$data = array();

$token = $_SESSION["token"];
$username = $_SESSION["username"];

// Send the request to the backend, and get the result.
$response = getAPI($data, $token, "profile");

// Decode the response
$responseData = json_decode($response);

//var_dump($responseData);
// object(stdClass)#1 (7) { ["interests"]=> array(0) { } ["biography"]=> string(0) "" ["education"]=> string(0) "" ["quote"]=> string(0) "" ["current_residence"]=> string(0) "" ["certifications"]=> string(0) "" ["type"]=> string(4) "User" } 

echo "<h2>$username</h2>";
echo "<p>$responseData->biography</p>";


?>