<?php 

session_start();

require_once "../../includes/config.php";
require_once "../../includes/functions.php";

//check if user is logged in
if(isset($_SESSION['user_id']) && isset($_SESSION['user_role'])) {

  checkCustomer($_SESSION['user_role']);
  $first_name = $_SESSION['first_name'];

  //search
  $laborer_username = mysqli_real_escape_string($conn, $_GET['laborer']);

  $sql = "SELECT U.user_role, A.application_status, concat(U.first_name, ' ', U.middle_name, ' ', 
  U.last_name, ' ', U.suffix) AS full_name, A.specialization, 
  U.email_add, U.phone_number, U.sex, U.city, A.employment_type, 
  A.employer, A.certification
  FROM users AS U
  INNER JOIN applications AS A
  ON U.user_id = A.user_id
  WHERE U.username = '$laborer_username'";

  $result = mysqli_query($conn, $sql);
  $query_result = mysqli_num_rows($result);
    
  if($query_result == 0){
    header("Location: find-laborer-search.php?error=noresults");
    exit();    
  }

  $fee = 0; 
  $convenience_fee = 0; 
  $total = 0;
  //post button
  if (isset($_POST['dr-submit'])) {
    
    if(isset($_POST['checkbox'])) {
      $query = "SELECT concat(street_address, ', ', city, ' ', state, ' ', zip_code) as address 
      FROM users WHERE user_id = '$_SESSION[user_id]'";
      $query_run = mysqli_query($conn, $query);
      foreach($query_run as $row) {
        $add = $row['address'];
      }
    } else {
      $add = $_POST['requestAdd'];
    }
    
    $title = $_POST['requestTitle'];
    $category = $_POST['requestCateg'];
    $desc = $_POST['requestDesc'];
    $time = $_POST['requestTime'];
    $fee = $_POST['suggestedFee'];

    $breakdown_array = getBreakdown($fee);
    $convenience_fee = $breakdown_array[0];
    $total = $breakdown_array[1];

    $request_update = "INSERT INTO requests (title, category, description, address, date_time, progress, user_id) VALUES ('$title', '$category',  '$desc', '$add', '$time', 'pending', '$_SESSION[user_id]')";
    $query_run = mysqli_query($conn, $request_update);

    $get_request_id= "SELECT LAST_INSERT_ID() AS request_id FROM requests";
    $query_run = mysqli_query($conn, $get_request_id);

    foreach($query_run as $row){
      $request_id = $row['request_id'];
    }

    //first offer
    $offer_update = "INSERT INTO offers (suggested_fee, status, user_id, request_id) 
    VALUES ('$total', 'pending',  '$_SESSION[user_id]', '$request_id')";

    $query_run = mysqli_query($conn, $offer_update);

    //first request for approval (direct request)
    $for_approval = "INSERT INTO approved_requests (status, laborer_id, request_id) 
    VALUES ('pending',
    (SELECT L.laborer_id FROM laborers AS L
    INNER JOIN applications AS A ON A.applicant_id = L.applicant_id
    INNER JOIN users AS U ON U.user_id = A.user_id
    WHERE U.username = '$laborer_username'),
    '$request_id')";
    $query_run = mysqli_query($conn, $for_approval);

    if(mysqli_affected_rows($conn)>0) {
      header("Location: ../../client/requests/on-going-requests.php?message=requestsuccessful");
      exit();
    } else {
      header("Location: ../../client/dashboard/find-laborer.php?message=requestfailed");
      exit();
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
    <title>Client Dashboard</title>

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
            $("#nav-placeholder").load("../../client/nav.php");
          });
        </script>
        <!--end of Navigation bar-->
        <!--MAIN-->
        <div class="col p-4 orange-main">
          <!--WELCOME-->
          <?php printWelcomeMessage($first_name, "orange"); ?>

          <nav class="col-12 mt-3">
            <ul class="nav nav-tabs nav-fill z-1 fs-3">
              <li class="nav-item">
                <a
                  class="nav-link active text-start"
                  aria-current="page"
                  href="find-laborer.php"
                  >Find Laborer</a
                >
              </li>
              <li class="nav-item">
                <a
                  class="nav-link text-start"
                  href="open-request.php"
                  >Open Request</a
                >
              </li>
            </ul>
          </nav>

          <main
            class="col-12 rounded-4 rounded-top-0 whites white-font oranges main-envelope g-0 z-0"
          >
            <div class="row p-3 g-1">
              <header class="col-6 mt-4">
                <form 
                action="find-laborer-search.php"
                method="POST"
                class="d-flex" role="search">
                  <input                 
                    class="form-control me-2"
                    type="search"
                    name="search"
                    placeholder="Search"
                    aria-label="Search"
                  />
                  <button class="btn btn-primary blue-btn"
                  name="submit-search"
                  type="submit">
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

              <div class="col-12 rounded-4 border border-5 p-3 whites">
                <div class="row">
                  <!--Laborer-->
                  <?php
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
                  }
                  echo '
                  <div class="col-4">
                    <div class="row orange-font p-3 mb-2">
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
                          <div class="col-7">
                            <h4 class="fs-2 header">'.$name.'</h4>
                            <p class="lead blue-font">'.$specialization.'</p>
                            <div class="laborer-rating">
                              <i class="fa-solid fa-star"></i>
                              <i class="fa-solid fa-star"></i>
                              <i class="fa-solid fa-star"></i>
                              <i class="fa-solid fa-star"></i>
                              <i class="fa-solid fa-star"></i>
                            </div>
                          </div>
                        </div>
                      </header>
                      <article
                        class="col-12 mt-4 font-normal text-normal text-black description overflow-auto"
                      >
                      <div class="row">
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
                    </div>
                  </div>
                  ';
                  ?>
                  <!--End ofLaborer-->
                  <div class="col">
                    <form 
                   
                    method="POST"
                    class="row align-items-center">
                      <div class="col-8 orange-font">
                        <div class="row mb-3">
                          <label for="requestTitle" class="col-1 col-form-label"
                            >Title:
                          </label>
                          <div class="col-5 me-5">
                            <input
                              type="text"
                              class="form-control"
                              id="requestTitle"
                              name="requestTitle"
                              required
                            />
                          </div>
                          <label
                            for="requestCateg"
                            class="col-2 col-form-label text-end"
                            >Category:
                          </label>
                          <div class="col-3">
                            <input
                              type="text"
                              class="form-control"
                              id="requestCateg"
                              name="requestCateg"
                              value="<?php echo "$specialization"; ?>"
                              readonly
                            />
                          </div>
                        </div>
                        <div class="row mb-3">
                          <label
                            for="requestDesc"
                            class="col-2 col-form-label me-5"
                            >Description:
                          </label>
                          <div class="col-9">
                            <textarea
                              class="form-control"
                              id="requestDesc"
                              name="requestDesc"
                              rows="5"
                              style="resize: none"
                              required
                            ></textarea>
                          </div>
                        </div>
                        <div class="row mb-3">
                          <label
                            for="requestStreet"
                            class="col-2 col-form-label"
                            >Address:
                          </label>
                          <div class="col-6">
                            <input
                              type="text"
                              class="form-control"
                              id="requestAdd"
                              name="requestAdd"
                              
                            />
                          </div>
                          <div class="col mt-2">
                            <div class="form-check">
                              <input
                                class="form-check-input"
                                type="checkbox"
                                name="checkbox"
                                value=""
                                id="flexCheckDefault"
                              />
                              <label
                                class="form-check-label"
                                for="flexCheckDefault"
                              >
                                Home address
                              </label>
                            </div>
                          </div>
                        </div>
                        <div class="row mb-3">
                          <label
                            for="requestAttachment"
                            class="col-2 col-form-label text-end me-3"
                            >Attachment:
                          </label>
                          <div class="col-4">
                            <input
                              type="file"
                              class="form-control"
                              id="requestAttachment"
                              disabled
                            />
                          </div>
                          <label
                            for="requestTime"
                            class="col-1 col-form-label ms-4"
                            >Time:
                          </label>
                          <div class="col-4">
                            <input
                              type="datetime-local"
                              class="form-control"
                              id="requestTime"
                              name="requestTime"
                              required
                            />
                          </div>
                        </div>
                      </div>
                      <div class="col-4">
                        <div class="row g-3">
                          <div class="col-auto orange-font">
                            <label
                              for="suggestServiceFee"
                              class="col-form-label mt-2"
                              >Suggest Service Fee</label
                            >
                          </div>
                          <div class="col-5">
                            <div class="form-floating">
                              <input
                                type="text"
                                class="form-control"
                                id="suggestedFee"
                                name="suggestedFee"
                                placeholder="100.00"
                              />
                              <label
                                class="blue-font font-normal"
                                for="suggestServiceFee"
                                >Php</label
                              >
                            </div>
                          </div>
                          <div
                            class="col border border-3 rounded rounded-4 orange-border mx-auto orange-font"
                          >
                            <p class="fs-4 text-center">Breakdown:</p>
                            <div class="row font-normal">
                              <p class="col-5 text-end">Labor Fee</p>
                              <p id="textFee" class="col-6 text-center">Php </p>
                              <p class="col-5 text-end">Convenience Fee</p>
                              <p id="textConFee" class="col-6 text-center">Php </p>
                              <p></p>
                              <hr />
                              <p class="fs-5 col-5 text-end header">Total:</p>
                              <p id="textTotal" class="fs-5 col-6 text-center header">
                                Php 
                              </p>
                            </div>
                          </div>
                          <div class="text-center">
                            <button
                              type="button"
                              class="btn btn-primary green-btn me-3"
                              data-bs-toggle="modal"
                              data-bs-target="#staticBackdropComplete"
                            >
                              Proceed
                            </button>
                            <a
                              href="/main/client/dashboard/find-laborer-search.html"
                              class="btn btn-primary red-btn"
                            >
                              Cancel
                            </a>
                          </div>
                        </div>
                      </div>

                      <!-- Modal -->
                      <div
                        class="modal fade"
                        id="staticBackdropComplete"
                        data-bs-backdrop="static"
                        data-bs-keyboard="false"
                        tabindex="-1"
                        aria-labelledby="staticBackdropLabel"
                        aria-hidden="true"
                      >
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h1
                                class="modal-title fs-5"
                                id="staticBackdropLabel"
                              >
                                Last step!
                              </h1>
                              <button
                                type="button"
                                class="btn-close"
                                data-bs-dismiss="modal"
                                aria-label="Close"
                              ></button>
                            </div>
                            <div class="modal-body text-center mb-5">
                              <p class="fs-1 blue-font text-center">
                                How do you want to pay?
                              </p>
                              <div class="d-grid gap-2">
                                <button
                                  id="directp-submit"
                                  type="submit"
                                  name="submit"
                                  class="btn btn-primary orange-btn mt-3"
                                  value="Direct Payment"
                                  disabled
                                >
                                  <div
                                    class="row justify-content-center align-items-center"
                                  >
                                    <div class="col-2">
                                      <img
                                        class="img-fluid"
                                        src="../../icons/payment/direct.png"
                                        alt=""
                                      />
                                    </div>
                                    <div class="col-6">
                                      <p>Direct Payment</p>
                                    </div>
                                  </div>
                                </button>
                                <button
                                  id="cashp-submit"
                                  type="submit"
                                  name="dr-submit"
                                  class="btn btn-primary orange-btn mt-3"
                                  value="cash"
                                >
                                  <div
                                    class="row justify-content-center align-items-center"
                                  >
                                    <div class="col-2">
                                      <img
                                        class="img-fluid"
                                        src="../../icons/payment/cash.png"
                                        alt=""
                                      />
                                    </div>
                                    <div class="col-6">
                                      <p>Cash Payment</p>
                                    </div>
                                  </div>
                                </button>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </main>
        </div>
      </div>
    </div>

    <script>
      var suggestedFee = document.getElementById('suggestedFee');
      var laborFee = document.getElementById('textFee');
      var convenienceFee = document.getElementById('textConFee');
      var totalFee = document.getElementById('textTotal');

      function getBreakdown() {
        laborFee.innerHTML = parseInt(suggestedFee.value);
        convenienceFee.innerHTML = parseInt(suggestedFee.value*0.10);
        totalFee.innerHTML = parseInt(suggestedFee.value) + parseInt(suggestedFee.value*0.10);
      }
      
      suggestedFee.addEventListener('keyup', getBreakdown);

    </script>

    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz"
      crossorigin="anonymous"
    ></script>
  </body>
</html>
