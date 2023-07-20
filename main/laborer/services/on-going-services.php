<?php 

session_start();

require_once "../../includes/config.php";
require_once "../../includes/functions.php";

//check if user is logged in
if(isset($_SESSION['user_id']) && isset($_SESSION['user_role'])) {

  checkLaborer($_SESSION['user_role']);
  checkUserStatus($conn, $_SESSION['user_id']); //checks user if blocked
  $laborer_details = getLaborerDetails($conn, $_SESSION['user_id']);
  $hasAcceptedRequest = false;

  // CHECK FOR APPROVED REQUEST FOR SERVICE
  if($result = hasAcceptedRequest($conn, $_SESSION['user_id'], $_SESSION['user_role'])) {
    $hasAcceptedRequest = true;
    $isPartiallyComplete = false;
    $isWaitingForApproval = false;
    $isInProgress = false;

    foreach($result as $row) {
      $laborer_id = $row['laborer_id'];
      $request_id = $row['request_id'];
      $progress = $row['progress'];
    }

    //check if progress is pending or in progress
    if($progress == 'pending') {
      $isWaitingForApproval = true;
    } else if ($progress == 'in progress' || $progress == 'partial-lr') {
      $isInProgress = true;
    }
    
    //check if the request is partially completed by laborer
    $progress = getRequestProgress($conn, $request_id);
    if($progress == 'partial-lr') {
      $isPartiallyComplete = true;
    }

    //get all necessary details
    $sql = "SELECT O.offer_id, AR.approval_id, 
    R.title, R.request_id, R.address, R.date_time, O.suggested_fee,
    concat(U.first_name, ' ', U.middle_name, ' ', U.last_name, ' ', 
    U.suffix) AS full_name, R.description
    FROM requests AS R
    INNER JOIN users AS U
    ON R.user_id = U.user_id
    INNER JOIN offers AS O
    ON R.request_id = O.request_id
    INNER JOIN approved_requests AS AR
    ON R.request_id = AR.request_id
    WHERE AR.request_id = '$request_id'
    AND AR.laborer_id = '$laborer_id'
    AND (AR.status = 'accepted' OR AR.status = 'pending')
    AND (R.progress = 'pending' OR R.progress = 'in progress' 
          OR R.progress = 'partial-cr' OR R.progress = 'partial-lr')
    ";

    $query_run = mysqli_query($conn, $sql);
    foreach($query_run as $row) {
      $request_title = $row['title'];
      $request_id = $row['request_id'];
      $request_address = $row['address'];
      $request_time = $row['date_time'];
      $suggested_fee = $row['suggested_fee'];
      $name = $row["full_name"];
      $description = $row["description"];
      $offer_id = $row["offer_id"];
      $approval_id = $row["approval_id"];
    }

    if(isset($_POST['complete'])) {

      //check if partially completed by customer
      if($progress == 'partial-cr') {
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
        AND (AR.status = 'accepted' OR AR.status = 'rejected')
        AND O.status = 'pending'
        ";
        mysqli_query($conn, $sql);
        header("Location: service-history.php?message=servicecompleted");      
        exit();

      } else if($progress == 'in progress') {
        //set to partially complete by customer
        $sql = "UPDATE requests SET progress = 'partial-lr'
        WHERE request_id = '$request_id'
        ";
        mysqli_query($conn, $sql);
        header("Location: on-going-services.php");      
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
    <title>My Services</title>

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
          $(function () {
            $("#nav-placeholder").load("../../laborer/nav.php");
          });
        </script>
        <!--end of Navigation bar-->
        <?php
          if (isset($_GET["error"])){

            $modal_title = "NOTICE";

          if($_GET["error"] == "existingapproval") {
            $error_message = "You already accepted a request! <br> Please wait for the customer's approval.";
          } 
          echo '<script>
              $(document).ready(function(){
                  $("#server-message").modal("show")
              });
              </script>';
          } 
          
          if (isset($_GET["message"])){

            $modal_title = "NOTICE";

          if($_GET["message"] == "requestinprogress") {
            $error_message = "You have a service in progress!";
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
                  href="on-going-services.php"
                  >On-going Services</a
                >
              </li>
              <li class="nav-item">
                <a
                  class="nav-link text-start"
                  href="service-history.php"
                  >Service History</a
                >
              </li>
            </ul>
          </nav>

          <main
            class="col-12 rounded-4 rounded-top-0 oranges orange-font requests-envelope g-0 z-0"
          >
            <div class="row p-3 g-1">
              <header class="col-5 mt-4 text-white">
                <h2 class="display-4 header">On-going Services</h2>
                <p class="fs-4 font-normal text-normal">
                  Check your posted/pending services here
                </p>
              </header>

            <?php

              if($hasAcceptedRequest) {
                echo '
                  <div
                    class="col-12 ms-auto mt-2 rounded rounded-4 border border-4 whites p-3"
                  >
                    <div class="row align-items-center">
                      <div class="col-12 blue-font">
                        <h2 class="display-5 header">
                        '.$request_title.' <span id="laborTitle"></span>
                ';
            
                if($isWaitingForApproval) {

                        echo '                   
                          <span class="badge fs-5 yellow-btn align-top"
                            >Waiting For Approval</span
                          >
                        ';
                } else if($isInProgress) {
                        echo '                   
                          <span class="badge fs-5 green-btn align-top"
                            >In Progress</span
                          >
                        ';
                }

                echo '
                        </h2>
                        <p class="fs-3 font-normal text-normal orange-font">
                          Request ID: <span id="requestID">'.$request_id.'</span>
                        </p>
                      </div>
                      <div class="font-normal text-normal d-flex justify-content-between">
                        <div class="blue-font fs-4">
                          <p>
                            <i class="fa-solid fa-location-dot me-4"></i>
                            <span id="requestAddress">'.$request_address.'</span>
                          </p>
                        </div>
                        <div class="blue-font fs-4">
                          <p>
                            <i class="fa-solid fa-clock me-4"></i>
                            <span id="requestTime">'.$request_time.'</span>
                          </p>
                        </div>
                        <div class="blue-font fs-4 me-4">
                          <p>
                            <i class="fa-solid fa-tag me-4"></i>
                            <span id="suggestedFee">Php '.$suggested_fee.'</span>
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
                            <div class="laborer-rating orange-font">
                              <i class="fa-solid fa-star"></i>
                              <i class="fa-solid fa-star"></i>
                              <i class="fa-solid fa-star"></i>
                              <i class="fa-solid fa-star"></i>
                              <i class="fa-solid fa-star"></i>
                            </div>
                          </div>
                          

                ';

                if($isInProgress) {
                  if($isPartiallyComplete) {
                    echo '
                          <div class="col text-end"> 
                          <h3><span class="badge bg-secondary">Waiting for customer&apos;s response</span></h3>                      
                            <button
                            type="button"
                            class="btn yellow-btn mb-3"
                            data-bs-toggle="modal" 
                            data-bs-target="#rateModal"
                          >
                            Rate
                          </button>
                        </div>

                    ';                 
                  } else {
                    echo '
                        <div class="col text-end">
                        <form class="d-inline" method="POST">
                          <button
                            type="submit"
                            name="complete"
                            class="btn text-white green-btn me-3 mb-3"
                          >
                            Complete
                          </button>
                        </form>
                            <button
                            type="button"
                            class="btn yellow-btn mb-3"
                            data-bs-toggle="modal" 
                            data-bs-target="#rateModal"
                          >
                            Rate
                          </button>
                        </div>

                    ';
                  }
                }
                                                                         
                echo '
                        </div>
                      </header>
                      <article class="fs-5 text-normal font-normal text-black mt-3">
                        <p>
                        '.$description.'
                        </p>
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
                              Rate your Customer!
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
            <?php echo $error_message; ?>
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
