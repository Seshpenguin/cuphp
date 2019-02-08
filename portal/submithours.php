<?php
    session_start();
    $config = include('../config.php');
    include('../api/api.php');

    // ConnectUS Submit Hours
    if(isset($_REQUEST['hours'])){ // If login data has been submitted
        $exp = ($_REQUEST['exp']);
        $hours = ($_REQUEST['hours']);
        $location = ($_REQUEST['location']);
        $day = ($_REQUEST['day']);
        $org = ($_REQUEST['org']);
        $desc = ($_REQUEST['desc']);


        // User login token
        $token = $_SESSION["token"];
        echo "Token: $token <br />";

        $url =  $config['API_SERVER'];

        $when = array(
            'begin' => "$day",
            'end' => "?"
        );

        $locObj = array( // Location "Address" object
            'street' => '',
            'city' => '',
            'province' => '',
            'country' => '',
            'postal_code' => '',
            'apt_number' => '',
        );

        // Data to send to the backend
        $data = array(
            //'location' => $locObj,
            'name' => $exp,
            'organization' => $org,
            'description' => $desc,
            'when' => $when,
            'hours' => (int)$hours,
            'email_verify' => true
        );


        $response = postAPI($data, $token, 'experiences');

        // Check for errors
        if($response === FALSE){
            var_dump($response);
            echo '<br />';
            var_dump(json_encode($data));
            die('Error whilst submitting hours...');
        }

        // Decode the response
        $responseData = json_decode($response, TRUE);

        if(isset($responseData['code'])){
          ?>
          <h2>Error Submitting Hours.</h2>
          <p>Please try again.</p> <br />
          <?php
          var_dump($responseData);
        } else {
          header("Location: ./index.php"); // redirect
          die();
        }


        echo "<br />Hours submitted! User/Pass used: $exp for $hours hours <br /> Data sent: ";
        var_dump(json_encode($data));
        echo "<br /> <br /> Response data: ";
        var_dump($response);


    } else { // Display hours form 
      include('./template/submit-head.php');
      ?>

      <form  method="post" action="">
      <fieldset>
      <legend><span class="number">1</span>Volunteer form</legend>
      <input type="text" class="" placeholder="Experience Name"   name="exp"/>
      <input type="text" class="" placeholder="Description"       name="desc"/>
      <input type="text" class="" placeholder="Hours"             name="hours"/>
      <input type="text" class="" placeholder="Location"          name="location"/>
      <input type="text" class="" placeholder="DD/MM/YY"          name="day"/>
      <input type="text" class="" placeholder="Verifier Email"    name="org"/>
      <input type="submit" type="button" class="input button btn btn-success"value="Submit for verification" />
      </form>

      <?php
      include('./template/submit-foot.php');
      } 
?>