<?php
  //Initializing the session
  session_start();
      
  if (isset($_POST['submit'])) {   

    //set middle and suffix to empty
    if(!isset($_SESSION['middle_name']) || empty($_SESSION['middle_name'])) {
      $middle_name = "";
    }

    if(!isset($_SESSION['suffix_name']) || empty($_SESSION['suffix_name'])) {
      $suffix_name = "";
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
    
    //set to n/a all unnecessary types 
    //for emptyInputSignup()
    $specialization = "n/a";
    $employment_type = "n/a";
    $employer = "n/a";
    $valid_id = "n/a";
    $valid_id_proof = "n/a";
    $cert = "n/a";
    $cert_proof = "n/a";

    //initialize post data
    $email_add = $_POST['emailAdd'];
    $user_name = $_POST['userName'];
    $phone_number = $_POST['phoneNumber'];
    $pw = $_POST['password'];

    //others
    $user_role = "customer";
    $status = "active";
    //$application_status = "pending";

    require_once "../includes/config.php";
    require_once "../includes/functions.php";

    //error handling found inside functions.php
    if(emptyInputSignup($first_name, $last_name, $dob, $sex, $street_add,
    $state, $city, $zipcode, $specialization, $employment_type, $employer,
    $valid_id, $cert, $email_add, $user_name, $phone_number, $pw) !== false ) {
      header("Location: choose-roles.php?error=missinginputs");
      exit();
    }

    if(invalidUid($user_name) !== false ) {
      header("Location: choose-roles.php?error=invaliduid");
      exit();
    }

    
    $password_confirm = $_POST['passwordConfirm'];
    if(pwdMatch($pw, $password_confirm) !== false ) {
      header("Location: choose-roles.php?error=passwordsdontmatch");
      exit();
    }
    
    //checks existing username first before main queries
    $uidExists = false;
    if(uidExists($conn, $user_name, $email_add) !== true) {
      
      //main queries

      createUser($conn, $user_role, $first_name, $last_name, $middle_name, $suffix_name, $dob, 
      $sex, $street_add, $state, $city, $zipcode, $email_add, $user_name, $phone_number, $pw, $status);    

    } else {
      $uidExists = true;
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
    <title>Customer Registration</title>

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
          <p>Create a customer account with LaborLink</p>
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

            if($uidExists) {
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

            }
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
            <!--BUTTONS-->
            <div class='col-5'>
              <a
                href='../index.php'
                class='btn btn-primary orange-btn'
                type='button'
              >
                Home
              </a>
            </div>
            <div class='col-5 text-end'>
              <a
                href='../login.php'
                class='btn btn-primary orange-btn'
                type='button'
              >
                Login
              </a>
            </div>
            ";           
              //clear post and session data and close connection
              $_POST = array();
              session_destroy();
              
              header("Refresh:10; url= ../index.php?error=none");
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
