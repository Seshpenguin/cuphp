<?php
  // ConnectUS Login
  include('../api/api.php');
  //$config = include('../config.php');

  session_start();
  if(isset($_REQUEST['username'])){ // If login data has been submitted
    // UPDATE 2019: username is now "id" on backend (email). 
      $username = ($_REQUEST['username']);
      $password = ($_REQUEST['password']);
      //echo ("URL is " . $config['API_SERVER']);

      // Data to send to the backend
      $data = array(
          'id' => $username,
          'password' => $password
      );

      // Send request to backend.
      $response = postAPI($data, 'none', 'auth/login');

      // Decode the response
      $responseData = json_decode($response, TRUE);
      //var_dump($responseData);

      if($responseData['code'] == 3101){
        include('./error/generic-error-head.php');
        ?>
        <h2>Error Logging In</h2>
        <p>Is the email/password correct?</p>
        <?php
        include('./error/generic-error-foot.php');
      } else if ($responseData['code'] == 3102) {
        include('./error/generic-error-head.php');
        ?>
        <h2>Error Logging In</h2>
        <p>Did you verify your account? (Check your email, and spam folder!)</p>
        <?php
        include('./error/generic-error-foot.php');
      } else if(isset($responseData['code'])){
        include('./error/generic-error-head.php');
        ?>
        <h2>Error Logging In</h2>
        <p>Please try again.</p>
        <?php
        include('./error/generic-error-foot.php');
      } else {
          $_SESSION["token"] = $responseData['token']; // Login user, set token
          $_SESSION["username"] = $username;

          header("Location: ../portal");
          die();

          // Print the date from the response for debug
          echo $responseData['token'];
          echo "<br />Debug: Logged in! Email/Pass used: $username and $password";
      }

  } else { // Display login form
    include('./template/generic-head.php');
    ?>

    <h1 class="h1-box">Login to get verified</h1>
  
    <input type="text" class="email" placeholder="Email" name="username"/>

    <input type="password"  class="email" placeholder="Password" name="password"/>

    <center><button type="submit" id="btn2">Login</button></center> <!-- End Btn -->

    <a href="./register.php" style="color: #fff;" class=".p-box">Dont have an account? <u style="color:#f1c40f;">Register!</u></a>

    <?php 
    include('./template/generic-foot.php');
  } // Login block 
?>
