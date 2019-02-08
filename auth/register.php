<?php
    // ConnectUS Login
    include('../api/api.php');

    session_start();
    if(isset($_REQUEST['username'])){ // If login data has been submitted
        $username = ($_REQUEST['username']);
        $password = ($_REQUEST['password']);

        $email = ($_REQUEST['email']);
        $firstname = ($_REQUEST['firstname']);
        $birthday = ($_REQUEST['birthday']);

        // Data to send to the backend
        $data = array(
            'username' => $username,
            'email' => $email,
            'password' => $password,
            'type' => 'user',

            // User specific
            'first_name' => $firstname,
            'birthday' => $birthday
        );

        // Send request to backend.
        $response = postAPI($data, 'none', 'auth/register');

        // Decode the response
        $responseData = json_decode($response, TRUE);

        if($responseData['code'] == 3101){
            include('./error/generic-error-head.php');
            ?>
            <h2>Error Registering</h2>
            <p>This username already exists!</p>
            <?php
            include('./error/generic-error-foot.php');
        } else if(isset($responseData['code'])) {
            include('./error/generic-error-head.php');
            ?>
            <h2>Error Registering</h2>
            <p>Please try again.</p>
            <?php
            include('./error/generic-error-foot.php');
        } else {
            header("Location: ./login.php"); // redirect
            die();
        }

        //echo $responseData;
        //echo "<br />Registered! User/Pass used: $username and $password. Please login now!";

    } else { // Display regiser form 
        include('./template/generic-head.php');
        ?>
        <h1 class="h1-box">Register to verify hours</h1>

        <input name="username" type="text" class="email" placeholder="Username" />
        <input name="email" type="email"  class="email" placeholder="Email" />
        <input name="password" type="Password" class="email" placeholder="Password" />
        <input name="firstname" type="text" class="email" placeholder="Name" />
        <input name="birthday" type="date" class="email" placeholder="Birthday" />

        <center><button type="submit" id="btn2">Register</button></center> <!-- End Btn2 -->
        <a href="./login.php" style="color: #fff;" class=".p-box">Already have an account? <u style="color:#f1c40f;">Sign In!</u></a>

        <?php 
        include('./template/generic-foot.php');
    } // Login block 
?>