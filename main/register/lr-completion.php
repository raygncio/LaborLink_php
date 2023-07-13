<?php
  //Initializing the session
  session_start();
      
  include "../config.php";
  include "../register/verify-acc.php";

  // prevent resubmission upon refresh
  if (empty($_SESSION['first_name']) ||
      empty($_SESSION['last_name']) ||
      empty($_SESSION['dob']) ||
      empty($_SESSION['sex']) ||
      empty($_SESSION['street_add']) ||
      empty($_SESSION['state']) ||
      empty($_SESSION['city']) ||
      empty($_SESSION['zipcode']) ||
      empty($_SESSION['specialization']) ||
      empty($_SESSION['employment_type']) ||
      empty($_SESSION['valid_ID']) ||
      empty($_SESSION['proof'])) {
      
        header("Location: ../index.html");

        //clear post and session data
        $_POST = array();
        session_destroy();
        
        $conn->close();
        exit;

  }

  if (!accDetailsTaken()) {

  //writing MySQL Query to insert the details
  $insert_query = "INSERT INTO users (
                  user_role,
                  first_name,
                  last_name,
                  middle_name,
                  suffix,
                  dob,
                  sex,
                  street_address,
                  state,
                  city,
                  zip_code,
                  email_add,
                  username,
                  phone_number,
                  password,
                  status
                  ) VALUES (
                  'client',
                  '$_SESSION[first_name]',
                  '$_SESSION[last_name]',
                  '$_SESSION[middle_name]',
                  '$_SESSION[suffix_name]',
                  '$_SESSION[dob]',
                  '$_SESSION[sex]',
                  '$_SESSION[street_add]',
                  '$_SESSION[state]',
                  '$_SESSION[city]',
                  '$_SESSION[zipcode]',
                  '$_POST[emailAdd]',
                  '$_POST[userName]',
                  '$_POST[phoneNumber]',
                  '$_POST[password]',
                  'active'
                  )";

  $result = $conn->query($insert_query);

  //set file inputs to empty 
  if(!isset($_SESSION['valid_ID_File']) && !isset($_SESSION['proof_file'])) {
    $_SESSION['valid_ID_File'] = "";
    $_SESSION['proof_file'] = "";
  }

  //get user id
  $get_user_details = "SELECT username, user_id FROM users";
  $get_user_result = $conn->query($get_user_details);
  if ($get_user_result->num_rows > 0) {
    while ($row = $get_user_result->fetch_assoc()) {
      if ($row['username'] == $_POST['userName']) {
        $user_id = $row['user_id'];
      } 
    }
  }
    

  $insert_query_2 = "INSERT INTO applications (
    application_status,
    specialization,
    employment_type,
    employer,
    valid_id,
    valid_id_proof,
    certification,
    certification_proof,
    user_id
    ) VALUES (
    'pending',
    '$_SESSION[specialization]',
    '$_SESSION[employment_type]',
    '$_SESSION[employer]',
    '$_SESSION[valid_ID]',
    '$_SESSION[valid_ID_File]',
    '$_SESSION[proof]',
    '$_SESSION[proof_file]',
    '$user_id'
    )";

  $result_2 = $conn->query($insert_query_2);
  
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

            if (accDetailsTaken()) {
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
            } else {

              if ($result == TRUE && $result_2 == TRUE) {
                
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
                            
                } else {

                  echo "
                  <div class='col-3'>
                    <img
                      src='../icons/login/oh-no.png'
                      class='img-fluid mx-auto d-block'
                      alt='...'
                    />
                  </div>
                  <div class='col-12 mt-3'>
                    <h3 class='display-4 header text-center'>Oh no!</h3>
                  </div>
                  <div class='col-12 mb-5'>
                    <p class='header text-center'>
                      SQL ERROR. Please try again!
                    </p>
                  </div>
                  ";
                                          
                }
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
              
              $conn->close();
              exit;
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
