<?php

  if (isset($_POST['submit'])) {

    //Initializing the session
    session_start();

    //set middle and suffix to empty
    if(!isset($_SESSION['middle_name']) || empty($_SESSION['middle_name'])) {
      $middle_name = "";
    }

    if(!isset($_SESSION['suffix_name']) || empty($_SESSION['suffix_name'])) {
      $suffix_name = "";
    }

    //set file inputs to empty 
    if(!isset($_SESSION['valid_ID_File']) && !isset($_SESSION['proof_file'])) {
      $valid_id_proof = "";
      $cert_proof = "";
    }

    //initialize session data
    $first_name = $_SESSION['first_name'];
    $last_name = $_SESSION['last_name'];
    $middle_name = $_SESSION['middle_name']; //optional
    $suffix_name = $_SESSION['suffix_name']; //optional
    $dob = $_SESSION['dob'];
    $sex = $_SESSION['sex'];
    $street_add = $_SESSION['street_add'];
    $state = $_SESSION['state'];
    $city = $_SESSION['city'];
    $zipcode = $_SESSION['zipcode'];
    $specialization = $_SESSION['specialization'];
    $employment_type = $_SESSION['employment_type'];
    $employer = $_SESSION['employer'];
    $valid_id = $_SESSION['valid_ID'];
    $valid_id_proof = $_SESSION['valid_ID_File']; //optional
    $cert = $_SESSION['proof'];
    $cert_proof = $_SESSION['proof_file']; //optional

    //initialize post data
    $email_add = $_POST['emailAdd'];
    $username = $_POST['userName'];
    $phone_number = $_POST['phoneNumber'];
    $password = $_POST['password'];

    //others
    $user_role = "laborer";
    $status = "pending";
    $application_status = "pending";


    require_once "../includes/config.php";
    require_once "../includes/functions.php";

    //error handling found inside functions.php
    if(emptyInputSignup($first_name, $last_name, $dob, $sex, $street_add,
    $state, $city, $zipcode, $specialization, $employment_type, $employer,
    $valid_id, $cert, $email_add, $username, $phone_number, $password) !== false ) {
      header("Location: choose-roles.php?error=missinginputs");
      exit();
    }

    if(invalidUid($username) !== false ) {
      header("Location: choose-roles.php?error=invaliduid");
      exit();
    }

    
    $password_confirm = $_POST['passwordConfirm'];
    if(pwdMatch($password, $password_confirm) !== false ) {
      header("Location: choose-roles.php?error=passwordsdontmatch");
      exit();
    }
    
    //checks existing username first before main queries
    if(uidExists($conn, $username, $email_add) !== true) {
      
      //main queries

      createUser($conn, $user_role, $first_name, $last_name, $middle_name, $suffix_name, $dob, 
      $sex, $street_add, $state, $city, $zipcode, $email_add, $username, $phone_number, $password, $status);

      //get user id of newly created user
      $user_id = getUserId($conn, $username);

      createLaborer($conn, $application_status, $specialization, $employment_type,
      $employer, $valid_id, $valid_id_proof, $cert, $cert_proof, $user_id);

    }

  } else {
    header("Location: choose-roles.php");
    exit();
  }

?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Worker Registration</title>

    <!--default-->
    <link rel="icon" type="favicon" href="../icons/favicon.ico" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;800&display=swap"
      rel="stylesheet"
    />

    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM"
      crossorigin="anonymous"
    />

    <link rel="stylesheet" href="../app.css" />
  </head>

  <body>
    <nav id="landingNav" class="navbar bg-light p-3">
      <div class="container-fluid">
        <a class="navbar-brand" href="#">
          <img src="../icons/LOGO.png" alt="logo" width="200" />
        </a>
      </div>
    </nav>

    <section class="container-fluid mt-5 reg">
      <div class="row white-font ms-0 ms-lg-5">
        <div class="col-6">
          <h1 class="display-1 header">Registration Form</h1>
        </div>
        <div class="col-12 font-normal">
          <p>Create a worker account with LaborLink</p>
        </div>
      </div>
      <div class="row mt-2 justify-content-center">
        <div class="col-2 pe-5">
          <ul class="nav nav-underline flex-column">
            <li class="nav-item">
              <a class="nav-link disabled" href="#">User Profile</a>
            </li>
            <li class="nav-item mt-2">
              <a class="nav-link disabled" href="#">Address</a>
            </li>
            <li class="nav-item mt-2">
              <a class="nav-link disabled" href="#">Employment Info</a>
            </li>
            <li class="nav-item mt-2">
              <a class="nav-link disabled" href="#">Account Info</a>
            </li>
            <li class="nav-item mt-2">
              <a class="nav-link active" aria-current="page" href="#"
                >COMPLETION</a
              >
            </li>
          </ul>
        </div>
        <div class="col-7 border whites p-4 orange-font regForms">
          <div class="row justify-content-center py-4">
            <!--MESSAGE-->
            <?php 

            if(uidExists($conn, $username, $email_add) !== false) {
              echo "
              <div class='col-3'>
                <img
                  src='../icons/login/oh-no.png'
                  class='img-fluid mx-auto d-block'
                  style='wdith: 50px;'
                  alt='...'
                />
              </div>
              <div class='col-12 mt-3'>
                <h3 class='display-4 header text-center'>Oh no!</h3>
              </div>
              <div class='col-12 mb-5'>
                <p class='header text-center'>
                  Your email add or username is already taken. <br> Kindly register again.
                </p>
              </div>
              ";

              header("Refresh:5; url= choose-roles.php?error=usernameoremailtaken");
              exit();

            } else {
                echo "
                <div class='col-12'>
                  <img
                    src='../icons/login/done.png'
                    class='img-fluid mx-auto d-block'
                    alt='...'
                  />
                </div>
                <div class='col-12 mt-3'>
                  <h3 class='display-4 header text-center'>One step closer!</h3>
                </div>
                <div class='col-12 mb-5'>
                  <p class='header text-center'>
                    Your laborer application is being reviewed! 
                  </p>
                </div>
                ";                                                            
            } 
            
            ?>

            <!--BUTTONS-->
            <div class="col-5">
              <a
                href="../index.html"
                class="btn btn-primary orange-btn"
                type="button"
              >
                Home
              </a>
            </div>
            <div class="col-5 text-end">
              <a
                href="../login.html"
                class="btn btn-primary orange-btn"
                type="button"
              >
                Login
              </a>
            </div>
            <?php 
              //clear post and session data and close connection
              $_POST = array();
              session_destroy();
              
              header("Refresh:5; url=../index.php?error=none");
              exit();
            ?>
            <!--END OF BUTTONS-->
          </div>
        </div>
      </div>
    </section>

    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz"
      crossorigin="anonymous"
    ></script>
  </body>
</html>
