<?php 

session_start();

require_once "../../includes/config.php";
require_once "../../includes/functions.php";

//check if user is logged in
if(isset($_SESSION['user_id']) && isset($_SESSION['user_role'])) {

  checkLaborer($_SESSION['user_role']);
  checkUserStatus($conn, $_SESSION['user_id']); //checks user if blocked
  $specialization = getSpecialization($conn, $_SESSION['user_id']);
  $first_name = $_SESSION['first_name']; // for welcome message

  /*$hasRequests = false; // for showing cancel button 
  $hasInterestedLaborers = false; // for showing interested laborers
  $hasAcceptedRequest = false; // for showing accepted requests and laborers*/
  
  // get available requests for specialization
  if($result = getRequests($conn, $specialization)) {

    if (isset($_POST['submit-search'])) {
      $search = mysqli_real_escape_string($conn, $_POST['search']);
  
      $sql = "SELECT R.progress, R.category, R.title, R.request_id, concat(U.first_name, ' ', U.middle_name, ' ', 
      U.last_name, ' ', U.suffix) AS full_name, R.description,
      R.address, R.date_time, O.suggested_fee
      FROM requests AS R
      INNER JOIN users AS U
      ON R.user_id = U.user_id
      INNER JOIN offers AS O
      ON R.request_id = O.request_id
      WHERE (R.progress = 'pending' AND R.category LIKE '$specialization') AND 
      (concat(U.first_name, ' ', U.middle_name, ' ', 
      U.last_name, ' ', U.suffix) LIKE '%$search%' OR
      R.title LIKE '%$search%' OR
      R.description LIKE '%$search%' OR
      R.address LIKE '%$search%' OR
      R.date_time LIKE '%$search%' OR
      O.suggested_fee LIKE '%$search%')
      ";
  
      $result = mysqli_query($conn, $sql);
      $query_result = mysqli_num_rows($result);
      
      if($query_result == 0){
        header("Location: find-labor.php?error=noresults");
        exit();    
      }
    } 

    foreach($result as $row) {
      $request_title = $row['title'];
      $request_id = $row['request_id'];
      $customer_name = $row['full_name'];
      $request_description = $row['description'];
      $request_address = $row['address'];
      $request_time = $row['date_time'];
      $suggested_fee = $row['suggested_fee'];
      
    }

  }

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
      WHERE AR.status = 'direct req' OR AR.status = 'pending'";
  
      $result = mysqli_query($conn, $sql);
      $query_result = mysqli_num_rows($result);
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
        $sql = "UPDATE approved_requests
        SET status = 'accepted'
        WHERE request_id = '$request_id' 
        AND laborer_id = '$laborer_id'
        AND status = 'pending'
        ";
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
        header("Location: on-going-requests.php");
        exit();
      }

    } 

    // APPROVED REQUESTS
    if((isset($_SESSION['acceptedRequest']) && isset($_SESSION['acceptedLaborer']))
    || $result = hasAcceptedRequest($conn, $_SESSION['user_id'])) {
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
      AND (R.progress = 'pending' OR R.progress = 'partial-cr' OR R.progress = 'partial-lr')
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
          AND (AR.status = 'accepted' OR AR.status = 'rejected')
          AND O.status = 'pending'
          ";
          mysqli_query($conn, $sql);
          header("Location: request-history.php?message=requestcompleted");      
          exit();

        } else if($progress == 'pending') {
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
    <title>Laborer Dashboard</title>

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
              $("#nav-placeholder").load("../../laborer/nav.php");
            });
        </script>
        <!--end of Navigation bar-->

        <?php
          if (isset($_GET["error"])){

            $modal_title = "NOTICE";

          if($_GET["error"] == "comingsoon") {
            $error_message = "Feature unavailable.<br>We're working on it!";
          } else if($_GET["error"] == "noresults") {
            $error_message = "No results!";
          } else if($_GET["error"] == "noavailablerequests") {
            $error_message = "There are no available requests at the moment :(";
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
          <!--WELCOME-->
          <?php printWelcomeMessage($first_name, $_SESSION['user_role']); ?>

          <nav class="col-12 mt-3">
            <ul class="nav nav-tabs nav-fill z-1 fs-3">
              <li class="nav-item">
                <a
                  class="nav-link active text-start"
                  aria-current="page"
                  href="find-labor.php"
                  >Find Labor</a
                >
              </li>
              <li class="nav-item">
                <a
                  class="nav-link text-start"
                  href="find-labor-dr.php"
                  >Direct Request</a
                >
              </li>
            </ul>
          </nav>

          <main
            class="col-12 rounded-4 rounded-top-0 oranges text-white g-0 z-0"
          >
            <div class="row p-3">
              <header class="col-7 mt-2">
                <h2 class="display-4 header text-normal">
                  Looking for the closest labor
                </h2>
                <p class="fs-4 font-normal text-normal">
                  Find the best labor you need!
                </p>
              </header>
              <header class="col-5 mt-4 text-end">
                <form 
                method="POST"
                class="d-flex" 
                role="search">
                  <input
                    class="form-control me-2"
                    type="search"
                    name="search"
                    placeholder="Search"
                    aria-label="Search"
                  />
                  <button class="btn btn-primary blue-btn" type="submit" name="submit-search">
                    Search
                  </button>
                </form>
                <button
                  type="button"
                  class="fs-5 btn btn-link blue-link text-normal font-normal"
                >
                  What do you need help with?
                </button>
              </header>

              <div
                class="col-12 scrollable-x mx-auto rounded-4 p-4 d-flex flex-nowrap whites"
              >
                <!--Clients-->
                <?php
                echo '
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
                          <h4 class="fs-2 header">'.$request_title.'</h4>
                          <p class="lead blue-font">Request ID: '.$request_id.'</p>
                          <p class="blue-font">
                            <i class="fa-solid fa-user me-3"></i>
                            <span id="Client Name">'.$customer_name.'</span>
                            <span class="rating orange-font ms-3">
                              <i class="fa-solid fa-star"></i>
                              <i class="fa-solid fa-star"></i>
                              <i class="fa-solid fa-star"></i>
                              <i class="fa-solid fa-star"></i>
                              <i class="fa-solid fa-star"></i>
                            </span>
                          </p>
                        </div>
                        <div class="col text-end">
                          <button type="submit" name="accept" class="btn btn-primary green-btn mb-3 me-2">
                            Accept
                          </button>
                          <button type="submit" name="reject" class="btn btn-danger red-btn mb-3">Reject</button>
                          <button
                            type="submit"
                            name="offer"
                            class="btn btn-primary yellow-btn"
                          >
                            Make Offer
                          </button>
                        </div>
                      </div>
                    </header>
                    <article
                      class="col-12 mt-1 font-normal text-black overflow-auto"
                    >
                      <div class="client-description">
                        <p>
                          '.$request_description.'
                        </p>
                      </div>
                    </article>
                    <footer class="row align-items-end mt-3">
                      <div class="col-4 blue-font text-center">
                        <i class="fa-solid fa-location-dot me-3"></i>
                        <span id="requestAddress">'.$request_address.'</span>
                      </div>
                      <div class="col-4 blue-font text-center">
                        <i class="fa-solid fa-clock me-3"></i>
                        <span id="requestTime">'.$request_time.'</span>
                      </div>
                      <div class="col-4 blue-font text-center">
                        <i class="fa-solid fa-tag me-3"></i>
                        <span id="suggestedFee">Php '.$suggested_fee.'</span>
                      </div>
                    </footer>
                  </div>
                ';
                ?>
                <!--End of Clients -->
              </div>
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
