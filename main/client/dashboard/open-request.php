<?php 

session_start();

require_once "../../includes/config.php";
require_once "../../includes/functions.php";

//check if user is logged in
if(isset($_SESSION['user_id']) && isset($_SESSION['user_role'])) {

  checkCustomer($_SESSION['user_role']);
  $first_name = $_SESSION['first_name'];
  $fee = 0; 
  $convenience_fee = 0; 
  $total = 0;
  //post button
  if (isset($_POST['postButton'])) {
    
    if(isset($_POST['checkbox'])) {
      $query = "SELECT concat(street_address, city, state, zip_code) as address 
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

    $offer_update = "INSERT INTO offers (suggested_fee, status, user_id, request_id) 
    VALUES ('$total', 'pending',  '$_SESSION[user_id]', '$request_id')";

    $query_run = mysqli_query($conn, $offer_update);
    
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
        <!--MAIN-->
        <div class="col p-4 orange-main">
          <!--WELCOME-->
          <?php printWelcomeMessage($first_name, $_SESSION['user_role']); ?>

          <nav class="col-12 mt-3">
            <ul class="nav nav-tabs nav-fill z-1 fs-3">
              <li class="nav-item">
                <a
                  class="nav-link text-start"
                  href="find-laborer.php"
                  >Find Laborer</a
                >
              </li>
              <li class="nav-item">
                <a
                  class="nav-link active text-start"
                  aria-current="page"
                  href="open-request.php"
                  >Open Request</a
                >
              </li>
            </ul>
          </nav>

          <main
            class="col-12 rounded-4 rounded-top-0 oranges orange-font main-envelope g-0 z-0"
          >
            <div class="row p-3 g-1">
              <header class="col-7 mt-2">
                <h2 class="display-4 header text-normal white-font">
                  Create an Open Request
                </h2>
                <p class="fs-4 font-normal text-normal white-font">
                  Let Laborers know your request
                </p>
              </header>

              <div class="col-12 rounded-4 border border-5 p-3 whites">
                <form 
                
                method="POST" 
                class="row">
                  <div class="col-6">
                    <div class="row mb-3">
                      <label
                        for="requestTitle"
                        class="col-2 col-form-label text-end"
                        >Title:
                      </label>
                      <div class="col-10">
                        <input
                          type="text"
                          class="form-control"
                          id="requestTitle"
                          name="requestTitle"
                          required
                        />
                      </div>
                    </div>
                    <div class="row mb-3">
                      <label
                        for="requestCateg"
                        class="col-2 col-form-label text-end"
                        >Category:
                      </label>
                      <div class="col-10">
                        <select
                          id="requestCateg"
                          class="form-select"
                          aria-label="Default select example"
                          name="requestCateg"
                          required
                        >
                          <option selected disabled>Select Category</option>
                          <option value="Plumbing">Plumbing</option>
                          <option value="Electrical">Electrical</option>
                          <option value="Roofing">Roofing</option>
                          <option value="Appliances">Appliances</option>
                          <option value="Welding">Welding</option>
                          <option value="Housekeeping">Housekeeping</option>
                          <option value="Painting">Painting</option>
                          <option value="PestControl">Pest Control</option>
                          <option value="Tutoring">Tutoring</option>
                        </select>
                      </div>
                    </div>
                    <div class="row mb-3">
                      <label
                        for="requestDesc"
                        class="col-2 col-form-label text-end"
                        >Description:
                      </label>
                      <div class="col-10">
                        <textarea
                          class="form-control"
                          id="requestDesc"
                          rows="7"
                          style="resize: none"
                          name="requestDesc"
                          required
                        ></textarea>
                      </div>
                    </div>
                    <div class="row mb-3">
                      <label
                        for="requestAttachment"
                        class="col-2 col-form-label text-end"
                        >Attachment:
                      </label>
                      <div class="col-10">
                        <input
                          type="file"
                          class="form-control"
                          id="requestAttachment"
                          name="requestAttachment"
                          disabled
                        />
                      </div>
                    </div>
                  </div>
                  <div class="col-6">
                    <div class="row mb-3">
                      <script>
                      $('#checkbox').change(function() {
                          $('#requestAdd').prop('disabled',!this.checked)
                      });
                      </script>
                 
                      <label
                        for="requestAdd"
                        class="col-2 col-form-label text-end"
                        >Address:
                      </label>
                      <div class="col-4">
                        <input
                          type="text"
                          class="form-control"
                          id="requestAdd"
                          name="requestAdd"                         
                        />
                      </div>

                      <div class="col mt-2">
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" name="checkbox" value="homeAddress" id="flexCheckDefault">
                          <label class="form-check-label" for="flexCheckDefault">
                            Home address
                          </label>
                        </div>
                      </div>
                    </div>
                    <div class="row mb-3">
                      <label
                        for="requestTime"
                        class="col-2 col-form-label text-end"
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
                      <div class="col-2">
                        <label
                          for="suggestedFee"
                          class="col-form-label text-end"
                          >Suggest Service Fee:
                        </label>
                      </div>
                      <div class="col-4">
                        <div class="form-floating">
                          <input
                            type="text"
                            class="form-control"
                            id="suggestedFee"
                            name="suggestedFee"
                            placeholder="100.00"
                            required
                          />
                          <label
                            class="blue-font font-normal"
                            for="suggestedFee"
                            >Php</label
                          >
                        </div>
                      </div>
                    </div>
                    <div class="row mb-1">
                      <div
                        class="col-10 border border-3 rounded rounded-4 orange-border mx-auto p-2"
                      >
                        <div class="row font-normal">
                          <p class="col-2 fs-5 header">Breakdown:</p>
                          <p class="col-5 text-end">Labor Fee</p>
                          <p id="textFee" class="col-5 text-center"></p>
                          <p class="col-7 text-end">Convenience Fee</p>
                          <p id="textConFee" class="col-5 text-center"></p>
                          <p></p>
                          <hr />
                          <p class="fs-5 col-7 text-end header">Total:</p>
                          <p id="textTotal" class="fs-5 col-5 text-center header"></p>
                        </div>
                      </div>
                      <div class="col-12 mt-4 text-end">
                        <button
                          type="submit"
                          class="btn btn-primary green-btn me-3"
                          name="postButton"
                        >
                          Post
                        </button>
                        <a
                          href="find-laborer.php"
                          class="btn btn-primary red-btn"
                        >
                          Cancel
                        </a>
                      </div>
                    </div>
                  </div>
                </form>
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
