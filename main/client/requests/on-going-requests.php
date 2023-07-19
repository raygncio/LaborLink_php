<?php 

session_start();

require_once "../../includes/config.php";
require_once "../../includes/functions.php";

//check if user is logged in
if(isset($_SESSION['user_id']) && isset($_SESSION['user_role'])) {

  checkCustomer($_SESSION['user_role']);
  $first_name = $_SESSION['first_name'];
  $hasRequests = false; // for showing cancel button 
  $hasInterestedLaborers = false; // for showing interested laborers
  

  //get on-going request details
    $result = hasPendingRequest($conn, $_SESSION['user_id']);
    if($result) {
      $hasRequests = true; // for showing cancel button 
      
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
         
      $sql = "SELECT concat(U.first_name, ' ', U.middle_name, ' ', 
      U.last_name, ' ', U.suffix) AS full_name, A.specialization, 
      U.email_add, U.phone_number, U.sex, U.city, A.employment_type, 
      A.employer, A.certification
      FROM users AS U
      INNER JOIN applications AS A
      ON U.user_id = A.user_id
      INNER JOIN laborers AS L
      ON L.applicant_id =  A.applicant_id
      INNER JOIN approved_requests AS R
      ON L.laborer_id = R.laborer_id
      WHERE R.status = 'direct req' OR R.status = 'pending'";
  
      $result = mysqli_query($conn, $sql);
      $query_result = mysqli_num_rows($result);
      if ($query_result == 0) {
        $hasInterestedLaborers = false;
      } else {
        $hasInterestedLaborers = true;
        foreach ($result as $row) {
          $name = $row["full_name"];
          $specialization = $row["specialization"];
          $email_add = $row["email_add"];
          $phone_number = $row["phone_number"];
          $sex = $row["sex"];
          $city = $row["city"];
          $employment_type = $row["employment_type"];
          $employer = $row["employer"];
          $certification = $row["certification"];
        }
      }
  
      if(isset($_POST['cancel-button'])){
        $sql = "UPDATE requests AS R 
        INNER JOIN offers AS O
        ON R.request_id = O.request_id
        SET R.progress = 'cancelled', 
        O.status = 'cancelled'
        WHERE R.request_id = '$request_id'";
        $query_run = mysqli_query($conn, $sql);
  
        $sql = "SELECT COUNT(*) AS count FROM approved_requests
        WHERE request_id = '$request_id'";
        $query_run = mysqli_query($conn, $sql);
        foreach($query_run as $row) {
          $count = $row['count'];
        }
        if($count > 0) {
          $sql = "UPDATE approved_requests AS A
          SET status = 'cancelled'
          WHERE request_id = '$request_id'";
          $query_run = mysqli_query($conn, $sql);
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

            $modal_title = "Congratulations!";

          if($_GET["message"] == "requestsuccessful") {
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
                  href="/main/client/requests/on-going-requests.html"
                  >On-going Request</a
                >
              </li>
              <li class="nav-item">
                <a
                  class="nav-link text-start"
                  href="/main/client/requests/request-history.html"
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
              <header
                class="col-6 ms-auto mt-2 rounded rounded-4 border border-4 whites p-3"
              >
                <div class="row justify-content-center">
                  <?php 
                  if($hasRequests) {
                    echo '
                    <div class="col-6">
                      <h2 class="display-5 header">
                        <span id="laborTitle" class="d-inline-block text-truncate" style="max-width: 400px;">'.$labor_title.'</span>
                      </h2>
                      <p class="fs-5 font-normal text-normal d-inline">
                        Request ID: <span id="requestID">'.$request_id.'</span>
                      </p>
                        <form
                        class="d-inline"
                        action="on-going-requests.php?message=cancelsuccessful"
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
                    ';
                  }                   
                  ?>
                  
                </div>
              </header>

              <div
                class="col-12 scrollable-x mt-5 mx-auto rounded-4 p-4 whites d-flex flex-nowrap"
              >
              <?php
                  if($hasRequests) {
                    if($hasInterestedLaborers) {
                      foreach ($result as $row) {
                        $name = $row["full_name"];
                        $specialization = $row["specialization"];
                        $type = $row["employment_type"];
                        $employer = $row["employer"];
                        $certification = $row["certification"];
                        $email_add = $row["email_add"];
                        $gender = $row["sex"];
                        $phone_number = $row["phone_number"];
                        $city = $row["city"];

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
                          <div class="col text-end">
                          <form
                          action=""
                          method="POST"
                          >
                            <button type="submit" name="accept" class="btn btn-link yesno mb-3">
                              <img
                                class="img-fluid"
                                src="../../icons/yesno/accept.png"
                                alt=""
                              />
                            </button>
                            <button type="submit" name="reject" class="btn btn-link yesno mb-3">
                              <img
                                class="img-fluid"
                                src="../../icons/yesno/decline.png"
                                alt=""
                              />
                            </button>
                          </form>
                          </div>
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
                                <div class="col-3">
                                  <h4 class="fs-4 header blue-font">Client Name</h4>
                                  <h4 class="fs-5 orange-font">Labor Needed</h4>
                                  <div class="laborer-rating orange-font">
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                  </div>
                                </div>
                                <div class="col">
                                  <div class="laborer-rating blue-font fs-1 text-end">
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
                                Lorem ipsum dolor sit amet consectetur adipisicing
                                elit. Repellendus dolor provident rem cum. Corporis
                                illo minima voluptatibus alias corrupti culpa aliquam
                                laudantium. Rerum a fuga non, accusamus dolores soluta
                                exercitationem?
                              </p>
                              <p>
                                Lorem ipsum dolor sit amet consectetur adipisicing
                                elit. Repellendus dolor provident rem cum. Corporis
                                illo minima voluptatibus alias corrupti culpa aliquam
                                laudantium. Rerum a fuga non, accusamus dolores soluta
                                exercitationem?
                              </p>
                            </section>
                            <hr class="orange-font" />
                          </div>
                        </article>
                        <!--End of Reviews-->                         
                        </div>                     
                        
                        
                      </article>
                    </div>    
                    <!--End of Laborers-->'; 

                      }
                      
                    }
                    
                  }
                ?>   
                <!--Laborers-->
                
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
