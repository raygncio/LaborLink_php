<?php 

session_start();

require_once "../../includes/config.php";
require_once "../../includes/functions.php";

//check if user is logged in
if(isset($_SESSION['user_id']) && isset($_SESSION['user_role'])) {

  checkCustomer($_SESSION['user_role']);
  checkUserStatus($conn, $_SESSION['user_id']); //checks user if blocked
  $first_name = $_SESSION['first_name'];
  $hasRequests = false; // for showing cancel button 
  $hasInterestedLaborers = false; // for showing interested laborers
  $hasAcceptedRequest = false; // for showing accepted requests and laborers
  

    $result = hasPendingRequest($conn, $_SESSION['user_id']);
    if($result) {
      $hasRequests = true; // for showing cancel button 
      
      //get on-going request details
      foreach($result as $row){
        $labor_title = $row['title'];
        $request_id = $row['request_id'];
        $request_address = $row['address'];
        $request_time = $row['date_time'];
  
      }
  
      $result = getSuggestedFee($conn, $request_id);
      foreach($result as $row){
        $suggested_fee = $row['suggested_fee'];
      }
         
      //get interested laborers for approval
      $sql = "SELECT L.laborer_id, AR.status, concat(U.first_name, ' ', U.middle_name, ' ', 
      U.last_name, ' ', U.suffix) AS full_name, A.specialization, 
      U.email_add, U.phone_number, U.sex, U.city, A.employment_type, 
      A.employer, A.certification
      FROM users AS U
      INNER JOIN applications AS A
      ON U.user_id = A.user_id
      INNER JOIN laborers AS L
      ON L.applicant_id =  A.applicant_id
      INNER JOIN approved_requests AS AR
      ON L.laborer_id = AR.laborer_id
      INNER JOIN requests AS R
      ON AR.request_id = R.request_id
      WHERE (AR.status = 'direct req' OR AR.status = 'pending')
      AND R.user_id = '$_SESSION[user_id]'
      ";
  
      $interested_laborers = mysqli_query($conn, $sql);
      $query_result = mysqli_num_rows($interested_laborers);
      if ($query_result == 0) {
        $hasInterestedLaborers = false;
      } else {
        $hasInterestedLaborers = true;
      }
  
      if(isset($_POST['cancel-button'])){
        $sql = "UPDATE requests AS R 
        INNER JOIN offers AS O
        ON R.request_id = O.request_id
        INNER JOIN users AS U
        ON O.user_id = U.user_id
        SET R.progress = 'cancelled', 
        O.status = 'cancelled'
        WHERE O.request_id = '$request_id' AND
        O.user_id = '$_SESSION[user_id]'
        "; 

        $query_run = mysqli_query($conn, $sql);
  
        $sql = "SELECT L.laborer_id 
        FROM approved_requests AS AR
        INNER JOIN laborers AS L
        ON AR.laborer_id = L.laborer_id
        WHERE AR.request_id = '$request_id'";
        $query_run = mysqli_query($conn, $sql);
        $query_result = mysqli_num_rows($query_run);
        
        if($query_result > 0) {
          foreach($query_run as $row) {
            $laborer_id = $row['laborer_id'];
          }         
          $sql = "UPDATE approved_requests
          SET status = 'cancelled'
          WHERE request_id = '$request_id' AND
          laborer_id = '$laborer_id'
          ";
          $query_run = mysqli_query($conn, $sql);
          header("Location: on-going-requests.php?message=cancelsuccessful");
          exit();
        }  
      }

      // accept laborer for the on-going request
      if(isset($_POST['accept'])){
        $laborer_id = $_POST['accept'];
        $sql = "UPDATE approved_requests AS AR
        INNER JOIN requests AS R
        ON AR.request_id = R.request_id
        SET AR.status = 'accepted', R.progress = 'in progress'
        WHERE AR.request_id = '$request_id' 
        AND AR.laborer_id = '$laborer_id'
        AND AR.status = 'pending'
        AND R.progress = 'pending'
        ";
        mysqli_query($conn, $sql);

        //rejects all other approved requests of the same request id
        $sql = "UPDATE approved_requests AS AR
        INNER JOIN requests AS R
        ON AR.request_id = R.request_id
        SET AR.status = 'rejected'
        WHERE AR.request_id = '$request_id' 
        AND AR.status = 'pending'
        AND R.progress = 'pending'
        ";
        mysqli_query($conn, $sql);
        

        $_SESSION['acceptedRequest'] = $request_id;
        $_SESSION['acceptedLaborer'] = $laborer_id;

        header("Location: on-going-requests.php");
        exit();
      }
      
      if(isset($_POST['reject'])){
        $laborer_id = $_POST['reject'];
        $sql = "UPDATE approved_requests
        SET status = 'rejected'
        WHERE request_id = '$request_id' 
        AND laborer_id = '$laborer_id'
        AND status = 'pending'
        ";
        mysqli_query($conn, $sql);
        
        header("Location: on-going-requests.php");
        exit();
      }

    } 

    // APPROVED REQUESTS
    if((isset($_SESSION['acceptedRequest']) && isset($_SESSION['acceptedLaborer']))
    || $result = hasAcceptedRequest($conn, $_SESSION['user_id'], $_SESSION['user_role'])) {
      $hasAcceptedRequest = true;
      $isPartiallyComplete = false;

      if(isset($_SESSION['acceptedRequest']) && isset($_SESSION['acceptedLaborer'])) {
        $request_id = $_SESSION['acceptedRequest'];
        $laborer_id = $_SESSION['acceptedLaborer'];
      } else {
        foreach($result as $row) {
          $request_id = $row['request_id'];
          $laborer_id = $row['laborer_id'];
        }
      }

      //check if the request is partially completed by customer
      $progress = getRequestProgress($conn, $request_id);
      if($progress == 'partial-cr') {
        $isPartiallyComplete = true;
      }

      //get all necessary details
      $sql = "SELECT O.offer_id, AR.approval_id, 
      R.title, R.request_id, R.address, R.date_time, O.suggested_fee,
      concat(U.first_name, ' ', U.middle_name, ' ', U.last_name, ' ', U.suffix) AS full_name,
      A.specialization, A.employment_type, A.employer, A.certification, U.email_add,
      U.sex, U.phone_number, U.city
      FROM requests AS R
      INNER JOIN offers AS O
      ON R.request_id = O.request_id
      INNER JOIN approved_requests AS AR
      ON R.request_id = AR.request_id
      INNER JOIN laborers AS L
      ON AR.laborer_id = L.laborer_id
      INNER JOIN applications AS A
      ON L.applicant_id = A.applicant_id
      INNER JOIN users AS U
      ON A.user_id = U.user_id
      WHERE AR.request_id = '$request_id'
      AND AR.laborer_id = '$laborer_id'
      AND AR.status = 'accepted'
      AND (R.progress = 'in progress' OR R.progress = 'partial-cr' OR R.progress = 'partial-lr')
      ";
      $query_run = mysqli_query($conn, $sql);
      foreach($query_run as $row) {
        $request_title = $row['title'];
        $request_id = $row['request_id'];
        $request_address = $row['address'];
        $request_time = $row['date_time'];
        $suggested_fee = $row['suggested_fee'];
        $name = $row["full_name"];
        $specialization = $row["specialization"];
        $type = $row["employment_type"];
        $employer = $row["employer"];
        $certification = $row["certification"];
        $email_add = $row["email_add"];
        $gender = $row["sex"];
        $phone_number = $row["phone_number"];
        $city = $row["city"];
        $offer_id = $row["offer_id"];
        $approval_id = $row["approval_id"];
      }

      if(isset($_POST['complete'])) {

        //check if partially completed by laborer
        if($progress == 'partial-lr') {
          //set to fully complete         
          $sql = "UPDATE requests AS R
          INNER JOIN offers AS O
          ON R.request_id = O.request_id
          INNER JOIN approved_requests AS AR
          ON R.request_id = AR.request_id
          SET R.progress = 'completed',
          AR.status = 'completed',
          O.status = 'completed'
          WHERE R.request_id = '$request_id'
          AND AR.status = 'accepted'
          AND O.status = 'pending'
          ";
          mysqli_query($conn, $sql);

          addCreditBalance($conn, $_SESSION['user_id'], $suggested_fee, $_SESSION['user_role'], $request_id);

          header("Location: request-history.php?message=requestcompleted");      
          exit();

        } else if($progress == 'pending' || $progress == 'in progress') {
          //set to partially complete by customer
          $sql = "UPDATE requests SET progress = 'partial-cr'
          WHERE request_id = '$request_id'
          ";
          mysqli_query($conn, $sql);
          header("Location: on-going-requests.php");      
          exit();
        }
        
        
      }

    }
  
} else {
  header("Location: ../../index.php");
  exit();
}

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>My Requests</title>

    <!--default-->
    <link rel="icon" type="favicon" href="../../icons/favicon.ico" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;800&display=swap"
      rel="stylesheet"
    />
    <script
      src="https://kit.fontawesome.com/6dac587466.js"
      crossorigin="anonymous"
    ></script>

    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM"
      crossorigin="anonymous"
    />

    <link rel="stylesheet" href="../../app.css" />

    <!--For navbar-->
    <script src="https://code.jquery.com/jquery-1.10.2.js"></script>
    <!--Ajax-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
  </head>

  <body>
    <div class="container-fluid main-pages">
      <div class="row flex-nowrap">
        <!--Navigation bar-->
        <div
          id="nav-placeholder"
          class="bg-light col-1 min-vh-100 d-flex flex-column justify-content-center text-truncate"
        ></div>
        <script>
            $(function(){
              $("#nav-placeholder").load("../../client/nav.php");
            });
        </script>
        <!--end of Navigation bar-->
        <?php
          if (isset($_GET["message"])){

            $modal_title = "NOTICE";

          if($_GET["message"] == "requestsuccessful") {
            $modal_title = "Congratulations!";
            $modal_message = "Your request has been posted successfully!";
          } else if ($_GET["message"] == "haspendingrequest") {
            $modal_message = "You can only make 1 request at a time!";
          } else if ($_GET["message"] == "noresults") {
            $modal_message = "No interested handyman yet.";
          } else if ($_GET["message"] == "cancelsuccessful") {
            $modal_message = "Your request has been cancelled successfully";
          } else if ($_GET["message"] == "norequests") {
            $hasRequests = false;
            $modal_message = "You have no requests!";
          } 

          echo '<script>
              $(document).ready(function(){
                  $("#server-message").modal("show")
              });
              </script>';
          }  
        ?>
        <!--MAIN-->
        <div class="col p-4 orange-main">
          <nav class="col-12 mt-3">
            <ul class="nav nav-tabs nav-fill z-1 fs-3">
              <li class="nav-item">
                <a
                  class="nav-link text-start active"
                  aria-current="page"
                  href="on-going-requests.php"
                  >On-going Request</a
                >
              </li>
              <li class="nav-item">
                <a
                  class="nav-link text-start"
                  href="request-history.php"
                  >Request History</a
                >
              </li>
            </ul>
          </nav>

          <main
            class="col-12 rounded-4 rounded-top-0 oranges orange-font requests-envelope g-0 z-0"
          >
            <div class="row p-3 g-1">
              <header class="col-5 mt-4 text-white">
                <h2 class="display-4 header">On-going Requests</h2>
                <p class="fs-4 font-normal text-normal">
                  Check your posted/pending requests here
                </p>
              </header>
              <?php 
              if($hasRequests) {

                // ----------- ONGOING REQUEST DETAILS
                echo '
                  <header
                    class="col-6 ms-auto mt-2 rounded rounded-4 border border-4 whites p-3"
                  >
                    <div class="row justify-content-center">                
                        <div class="col-6">
                          <h2 class="display-5 header">
                            <span id="laborTitle" class="d-inline-block text-truncate" style="max-width: 400px;">'.$labor_title.'</span>
                          </h2>
                          <p class="fs-5 font-normal text-normal d-inline">
                            Request ID: <span id="requestID">'.$request_id.'</span>
                          </p>
                            <form
                            class="d-inline"
                            method="POST">
                            <button type="submit" name="cancel-button" class="btn btn-danger red-btn btn-sm ms-2">Cancel Booking</button>
                            </form>         
                        </div>
                        <div class="col-5 blue-font">
                          <p>
                            <i class="fa-solid fa-location-dot me-3"></i>
                            <span id="requestAddress" style="max-height: 50px;">'.$request_address.'</span>
                          </p>
                          <p>
                              <i class="fa-solid fa-tag me-3"></i>
                              <span id="requestTime">Php '.$suggested_fee.'</span>
                            </p> 
                            <p>
                              <i class="fa-solid fa-clock me-3"></i>
                              <span id="requestTime">'.$request_time.'</span>
                            </p>             
                        </div>                            
                    </div>
                  </header>
                ';
                // --------- END OF ONGOING REQUEST DETAILS

                 
                // ------- interested laborers
                echo '
                  <div
                      class="col-12 scrollable-x mt-5 mx-auto rounded-4 p-4 whites d-flex flex-nowrap"
                    >
                ';
                    if($hasInterestedLaborers) {
                      foreach ($interested_laborers as $row) {
                        $name = $row["full_name"];
                        $specialization = $row["specialization"];
                        $type = $row["employment_type"];
                        $employer = $row["employer"];
                        $certification = $row["certification"];
                        $email_add = $row["email_add"];
                        $gender = $row["sex"];
                        $phone_number = $row["phone_number"];
                        $city = $row["city"];
                        $for_approval_status = $row["status"];
                        $laborer_id = $row["laborer_id"];
    
                        echo '  
                                   
                          <!--Laborers-->
                          <div
                            class="col-6 rounded-4 border border-5 orange-font p-3 my-1 me-2"
                          >
                            <header class="col-12">
                              <div class="row align-items-start g-0">
                                <div class="col-2">
                                  <div class="col-11">
                                    <img
                                      src="../../icons/blank-profile.png"
                                      class="img-fluid d-inline"
                                      alt="..."
                                    />
                                  </div>
                                </div>
                                <div class="col-6">
                                  <h4 class="fs-2 header">' . $name .'</h4>
                                  <p class="lead blue-font">' . $specialization .'</p>
                                  <div class="laborer-rating">
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                  </div>
                                </div>
                        ';

                        // ACCEPT AND REJECT APPROVAL
                        if($for_approval_status == 'direct req') {
                          echo '
                            <div class="col text-end">
                              <h5><span class="badge text-bg-warning">Direct Request</span></h5>
                              <p class="text-normal">Waiting for laborer...</p>
                            </div>
                          ';

                        } else {
                          echo '
                                  <div class="col text-end">
                                  <form                                
                                  method="POST"
                                  >
                                    <button type="submit" value="'.$laborer_id.'" name="accept" class="btn btn-link yesno mb-3">
                                      <img
                                        class="img-fluid"
                                        src="../../icons/yesno/accept.png"
                                        alt=""
                                      />
                                    </button>
                                    <button type="submit" value="'.$laborer_id.'" name="reject" class="btn btn-link yesno mb-3">
                                      <img
                                        class="img-fluid"
                                        src="../../icons/yesno/decline.png"
                                        alt=""
                                      />
                                    </button>
                                  </form>
                                  </div>
                          ';
                        }
                        
                        // for the rest
                        echo '
                              </div>
                            </header>
                            <article
                              class="col-12 mt-4 font-normal text-normal text-black overflow-auto"
                            >
                              <div class="row description">
                                <div class="col-6">
                                <p>
                                  Email add: ' . $email_add .'
                                </p>
                                <p>
                                  Phone Number: ' .$phone_number .'
                                </p>
                                <p>
                                  Gender: ' . $gender .'
                                </p>
                                <p>
                                  City: ' . $city .'
                                </p>
                                </div>
                                <div class="col-6">
                                <p>
                                  Employment Type: ' . $type .'
                                </p>
                                <p>
                                  Employer: ' . $employer .'
                                </p>
                                <p>
                                  Certification: ' . $certification .'
                                </p>
                                </div>    
                                <!--Reviews-->
                                <!--Filler 1-->
                                <article
                                  class="row border border-2 rounded rounded-4 mx-auto"
                                >
                                  <div class="col-12 mt-4">
                                    <header class="row">
                                      <div class="row align-items-start">
                                        <div class="col-2">
                                          <div class="col-12">
                                            <img
                                              src="../../icons/blank-profile.png"
                                              class="img-fluid d-inline"
                                              alt="..."
                                            />
                                          </div>
                                        </div>
                                        <div class="col">
                                          <h4 class="fs-4 header blue-font">Sebastian Wilder</h4>
                                          <h4 class="fs-5 orange-font">Pest Control</h4>
                                          <div class="laborer-rating orange-font">
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                          </div>
                                        </div>
                                        <div class="col-3">
                                          <div class="laborer-rating blue-font fs-5 text-end">
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                          </div>
                                        </div>
                                      </div>
                                    </header>
                                    <section
                                      class="fs-5 text-normal font-normal text-black mt-3"
                                    >
                                      <p>
                                        Very kind and accommodating!! :))
                                      </p>
                                    </section>
                                    <hr class="orange-font" />
                                  </div>
                                </article>
                                <!--Filler 2-->
                                <article
                                  class="row border border-2 rounded rounded-4 mx-auto"
                                >
                                  <div class="col-12 mt-4">
                                    <header class="row">
                                      <div class="row align-items-start">
                                        <div class="col-2">
                                          <div class="col-12">
                                            <img
                                              src="../../icons/blank-profile.png"
                                              class="img-fluid d-inline"
                                              alt="..."
                                            />
                                          </div>
                                        </div>
                                        <div class="col">
                                          <h4 class="fs-4 header blue-font">Mia Dolan</h4>
                                          <h4 class="fs-5 orange-font">Tutoring</h4>
                                          <div class="laborer-rating orange-font">
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                          </div>
                                        </div>
                                        <div class="col-3">
                                          <div class="laborer-rating blue-font fs-5 text-end">
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                          </div>
                                        </div>
                                      </div>
                                    </header>
                                    <section
                                      class="fs-5 text-normal font-normal text-black mt-3"
                                    >
                                      <p>
                                        Super smooth transaction!! What a pleasure to have you!
                                      </p>
                                    </section>
                                    <hr class="orange-font" />
                                  </div>
                                </article>
                                <!--End of Reviews-->                        
                              </div>                     
                                                            
                            </article>
                          </div>    
                          <!--End of Laborers--> 
                        '; 
                        }                             
                      }
                  echo '                        
                  </div> 
                  '; 
                // -------- end of interested laborers                
              }
              
              // ACCEPTED / APPROVED REQUESTS ONGOING
              if($hasAcceptedRequest) {
                echo'
                  <div
                  class="col-12 ms-auto mt-2 rounded rounded-4 border border-4 whites p-3"
                >
                    <div class="row align-items-center">
                      <div class="col-12 blue-font">
                        <h2 class="display-5 header">
                          '.$request_title.' 
                          <span class="badge fs-5 green-btn align-top">
                            In Progress
                          </span>
                        </h2>
                        <p class="fs-3 font-normal text-normal orange-font">
                          Request ID: '.$request_id.'
                        </p>
                      </div>
                      <div class="font-normal d-flex justify-content-between">
                        <div class="blue-font fs-4">
                          <p>
                            <i class="fa-solid fa-location-dot me-3"></i>
                            <span id="requestAddress">'.$request_address.'</span>
                          </p>
                        </div>
                        <div class="blue-font fs-4">
                          <p>
                            <i class="fa-solid fa-clock me-3"></i>
                            '.$request_time.'
                          </p>
                        </div>
                        <div class="blue-font fs-4 me-4">
                          <p>
                            <i class="fa-solid fa-tag me-3"></i>
                            '.$suggested_fee.'
                          </p>
                        </div>
                      </div>                   

                    </div>
                    <hr />

                    <article class="col-12 mt-4">
                      <header class="row">
                        <div class="row align-items-start">
                          <div class="col-1">
                            <div class="col-12">
                              <img
                                src="../../icons/blank-profile.png"
                                class="img-fluid d-inline"
                                alt="..."
                              />
                            </div>
                          </div>
                          <div class="col-3">
                            <h4 class="fs-2 header blue-font">'.$name.'</h4>
                            <h5>'.$specialization.'</h5>
                            <div class="laborer-rating orange-font">
                              <i class="fa-solid fa-star"></i>
                              <i class="fa-solid fa-star"></i>
                              <i class="fa-solid fa-star"></i>
                              <i class="fa-solid fa-star"></i>
                              <i class="fa-solid fa-star"></i>
                            </div>
                          </div>

                        ';

                        if($isPartiallyComplete){
                          
                          echo '
                            
                            <div class="col text-end">
                              <form
                              class="d-inline"
                              method="POST"
                              >
                                <h3><span class="badge bg-secondary">Waiting for laborer&apos;s response</span></h3>
                                <button
                                type="button"
                                class="btn yellow-btn mb-3"
                                data-bs-toggle="modal"
                                data-bs-target="#rateModal"
                              >
                                Rate
                              </button>
                              </form>
                            </div>
                            
                          ';
                          
                        } else {

                          echo '                         
                            <div class="col text-end">
                            <form
                            class="d-inline"
                            method="POST"
                            >
                              <button
                                type="submit"
                                name="complete"
                                class="btn text-white green-btn me-3 mb-3"
                              >
                                Complete
                              </button>
                              <button
                              type="button"
                              class="btn yellow-btn mb-3"
                              data-bs-toggle="modal"
                              data-bs-target="#rateModal"
                            >
                              Rate
                            </button>
                            </form>
                            </div>                        
                          ';

                        }                      
                        
                        echo '                  
                        </div>
                      </header>
                      <article class="row fs-5 text-normal font-normal text-black mt-3">
                        <div class="col-6">
                          <p>
                            Email add: ' . $email_add .'
                          </p>
                          <p>
                            Phone Number: ' .$phone_number .'
                          </p>
                          <p>
                            Gender: ' . $gender .'
                          </p>
                          <p>
                            City: ' . $city .'
                          </p>
                        </div>
                        <div class="col-6">
                          <p>
                            Employment Type: ' . $type .'
                          </p>
                          <p>
                            Employer: ' . $employer .'
                          </p>
                          <p>
                            Certification: ' . $certification .'
                          </p>
                        </div>
                      </article>
                      <hr class="orange-font" />
                    </article>

                    <!-- Rate Modal -->
                    <div
                      class="modal fade"
                      id="rateModal"
                      tabindex="-1"
                      aria-labelledby="exampleModalLabel"
                      aria-hidden="true"
                    >
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">
                              Rate your Laborer!
                            </h1>
                            <button
                              type="button"
                              class="btn-close"
                              data-bs-dismiss="modal"
                              aria-label="Close"
                            ></button>
                          </div>
                          <div class="modal-body">
                            <form action="#" class="row">
                              <div class="col-5 mx-auto">
                                <img
                                  class="img-fluid"
                                  src="../../icons/blank-profile.png"
                                  alt="profpic"
                                />
                              </div>
                              <div class="col-12 text-center mt-4">
                                <p class="fs-4 blue-font">
                                  How was the labor service?
                                </p>
                              </div>
                              <div class="col-12 text-center">
                                <div class="fs-3 laborer-rating orange-font">
                                  <button
                                    type="submit"
                                    id="1star"
                                    name="1star"
                                    value="1"
                                    class="btn btn-link orange-link"
                                  >
                                    <i class="fa-solid fa-star"></i>
                                  </button>
                                  <button
                                    type="submit"
                                    id="2star"
                                    name="2star"
                                    value="2"
                                    class="btn btn-link orange-link"
                                  >
                                    <i class="fa-solid fa-star"></i>
                                  </button>
                                  <button
                                    type="submit"
                                    id="3star"
                                    name="3star"
                                    value="3"
                                    class="btn btn-link orange-link"
                                  >
                                    <i class="fa-solid fa-star"></i>
                                  </button>
                                  <button
                                    type="submit"
                                    id="4star"
                                    name="4star"
                                    value="4"
                                    class="btn btn-link orange-link"
                                  >
                                    <i class="fa-solid fa-star"></i>
                                  </button>
                                  <button
                                    type="submit"
                                    id="5star"
                                    name="5star"
                                    value="5"
                                    class="btn btn-link orange-link"
                                  >
                                    <i class="fa-solid fa-star"></i>
                                  </button>
                                </div>
                              </div>
                              <div class="col-8 mt-4 mx-auto">
                                <textarea
                                  class="form-control"
                                  id="rateComment"
                                  rows="5"
                                  style="resize: none"
                                  placeholder="Comment"
                                ></textarea>
                              </div>
                            </form>
                          </div>
                          <div class="modal-footer">
                            <button
                              type="button"
                              class="btn text-white red-btn"
                              data-bs-dismiss="modal"
                            >
                              Close
                            </button>
                          </div>
                        </div>
                      </div>
                    </div>
                    <!-- End of Rate Modal -->
                  </div>
                ';
              }
              

              ?>   
              <!---->
            </div>
          </main>
        </div>
      </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="server-message" tabindex="-1" aria-labelledby="serverMessage" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5 header" id="serverMessage"><?php echo $modal_title; ?></h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body font-normal text-normal">
            <?php echo $modal_message; ?>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-primary blue-btn" data-bs-dismiss="modal">Got it</button>
          </div>
        </div>
      </div>
    </div>


    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz"
      crossorigin="anonymous"
    ></script>
  </body>
</html>
