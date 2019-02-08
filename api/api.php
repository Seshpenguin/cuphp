<?php
// ConnectUS PHP API Abstractions
// for API v1

//TODO make a unified function with the connection code,
//      then each function is just a call changing POST, GET, etc

function callAPI($data, $token, $endpoint, $callType) {
    $config = include('../config.php');
    $url = $config['API_SERVER'] . $endpoint;

    // Create the context for the request
    $context = stream_context_create(array(
        'http' => array(
            'method' => $callType,
            'header' => "x-access-token: $token\r\n". // dot concats the strings.
                        "Content-Type: application/json\r\n",
            'content' => json_encode($data),
            'ignore_errors' => true // Do not treat error 401 etc as real PHP error
        )
    ));

    // Send the request to the backend, and get the result. 
    if(!$response = file_get_contents($url, FALSE, $context)) {
        // The response failed for whatever reason.
        return false;
    }

    // Check for errors
    if($response === FALSE){
        var_dump($response); // For debug only! Remove in production
        die('ConnectUS has run into an unexpected error, please try again...');
    }

    return $response;
}

function postAPI($data, $token, $endpoint) {
    callAPI($data, $token, $endpoint, 'POST');
}

function getAPI($data, $token, $endpoint) {
    $config = include('../config.php');
    $url = $config['API_SERVER'] . $endpoint;

    // Create the context for the request
    $context = stream_context_create(array(
        'http' => array(
            'method' => 'GET',
            'header' => "x-access-token: $token\r\n". // dot concats the strings.
                        "Content-Type: application/json\r\n",
            'content' => json_encode($data)
        )
    ));

    // Send the request to the backend, and get the result.
    $response = file_get_contents($url, FALSE, $context);


    // Check for errors
    if($response === FALSE){
        var_dump($response); // For debug only! Remove in production
        die('Error');
    }

    return $response;
}

function patchAPI($data, $token, $endpoint) {
    $config = include('../config.php');
    $url = $config['API_SERVER'] . $endpoint;

    // Create the context for the request
    $context = stream_context_create(array(
        'http' => array(
            'method' => 'PATCH',
            'header' => "x-access-token: $token\r\n". // dot concats the strings.
                        "Content-Type: application/json\r\n",
            'content' => json_encode($data)
        )
    ));

    // Send the request to the backend, and get the result.
    $response = file_get_contents($url, FALSE, $context);

    // Check for errors
    if($response === FALSE){
        var_dump($response); // For debug only! Remove in production
        die('Error');
    }

    return $response;
}
