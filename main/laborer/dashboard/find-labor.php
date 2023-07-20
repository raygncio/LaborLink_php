<?php 

session_start();

require_once "../../includes/config.php";
require_once "../../includes/functions.php";

//check if user is logged in
if(isset($_SESSION['user_id']) && isset($_SESSION['user_role'])) {

  checkLaborer($_SESSION['user_role']);
  $first_name = $_SESSION['first_name'];
    
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
                <form class="d-flex" role="search">
                  <input
                    class="form-control me-2"
                    type="search"
                    placeholder="Search"
                    aria-label="Search"
                  />
                  <button class="btn btn-primary blue-btn" type="submit">
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
                        <h4 class="fs-2 header">Labor Needed</h4>
                        <p class="lead blue-font">Request ID: 123</p>
                        <p class="blue-font">
                          <i class="fa-solid fa-user me-3"></i>
                          <span id="Client Name">Nina Escueta</span>
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
                        <a href="#" class="btn btn-primary green-btn mb-3 me-2">
                          Accept
                        </a>
                        <button type="button" class="btn btn-danger red-btn mb-3">Reject</button>
                        <a
                          href="find-labor-mo.php"
                          class="btn btn-primary yellow-btn"
                        >
                          Make Offer
                        </a>
                      </div>
                    </div>
                  </header>
                  <article
                    class="col-12 mt-1 font-normal text-black overflow-auto"
                  >
                    <div class="client-description">
                      <p>
                        Lorem ipsum dolor sit amet consectetur adipisicing elit.
                        Consequuntur pariatur blanditiis excepturi facilis
                        assumenda maiores ipsum, atque, cupiditate veritatis
                        velit, accusantium provident. Omnis esse optio sunt ut
                        modi, nemo temporibus.
                      </p>
                      <p>
                        Lorem ipsum dolor sit amet consectetur adipisicing elit.
                        Consequuntur pariatur blanditiis excepturi facilis
                        assumenda maiores ipsum, atque, cupiditate veritatis
                        velit, accusantium provident. Omnis esse optio sunt ut
                        modi, nemo temporibus.
                      </p>
                      <p>
                        Lorem ipsum dolor sit amet consectetur adipisicing elit.
                        Consequuntur pariatur blanditiis excepturi facilis
                        assumenda maiores ipsum, atque, cupiditate veritatis
                        velit, accusantium provident. Omnis esse optio sunt ut
                        modi, nemo temporibus.
                      </p>
                    </div>
                  </article>
                  <footer class="row align-items-end mt-3">
                    <div class="col-4 blue-font text-center">
                      <i class="fa-solid fa-location-dot me-3"></i>
                      <span id="requestAddress">516 Juan Luna Ave.</span>
                    </div>
                    <div class="col-4 blue-font text-center">
                      <i class="fa-solid fa-clock me-3"></i>
                      <span id="requestTime">12:00 PM</span>
                    </div>
                    <div class="col-4 blue-font text-center">
                      <i class="fa-solid fa-tag me-3"></i>
                      <span id="suggestedFee">Php 550</span>
                    </div>
                  </footer>
                </div>
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
