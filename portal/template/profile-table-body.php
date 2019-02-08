<tbody>
<?php

// Data to send to the backend
$data = array();
$token = $_SESSION["token"];

// Send the request to the backend, and get the result.
$response = getAPI($data, $token, 'experiences');

// Decode the response
$responseData = json_decode($response);

foreach($responseData as &$exp){
    $is_verified_h = "No";
    if($exp->is_verified == 1) {
        $is_verified_h = "Yes";
    }
    $when_obj = $exp->when;
    $when_begin = $when_obj->begin;
    echo "
        <tr>
        <td>$exp->name</td>
        <td>$exp->description</td>
        <td>$exp->hours</td>
        <td>$when_begin</td>
        <td>$is_verified_h</td>
        <td>$exp->organization</td>
        </tr>
    ";
}

?>
</tbody>