<?php 

session_start();

require_once "../../includes/config.php";
require_once "../../includes/functions.php";

//check if user is logged in
if(isset($_SESSION['user_id']) && isset($_SESSION['user_role'])) {

  checkCustomer($_SESSION['user_role']);
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
        <div class="col p-4">
          <!--WELCOME-->
          <?php printWelcomeMessage($first_name, $_SESSION['user_role']); ?>

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
                <a class="nav-link text-start" href="open-request.php">Open Request</a>
              </li>
            </ul>
          </nav>

          <main
            class="col-12 rounded-4 rounded-top-0 whites orange-font orange-content g-0 z-0"
          >
            <div class="row p-3">   
                <header class="col-7 mt-2">
                  <h2 class="display-4 header text-normal">
                    Looking for a Labor Worker?
                  </h2>
                  <p class="fs-4 font-normal text-normal">
                    Find the best laborer you need!
                  </p>
                </header>
                <header class="col-5 mt-4 text-end">
                  <form 
                  action="find-laborer-search.php"
                  method="POST"
                  class="d-flex" role="search">
                    <input
                      class="form-control me-2"
                      type="search"
                      placeholder="Search"
                      aria-label="Search"
                    />
                    <button
                      class="btn btn-outline-success blue-outline-btn"
                      name="search-submit"
                      type="submit"
                    >
                      Search
                    </button>
                  </form>
                  <button
                    type="button"
                    class="fs-5 btn btn-link orange-link text-normal font-normal"
                  >
                    What do you need help with?
                  </button>
                </header>
                
                <div
                  class="row blue-font text-center justify-content-center align-items-end p-3 my-4"
                >
                  <a
                    href="find-laborer-search.php?q=plumbing"
                    class="col-2 text-decoration-none blue-link labor-icons"
                  >
                    <img
                      src="../../icons/labors/plumbing 1.png"
                      class="img-fluid d-inline mb-3"
                      alt="plumbing"
                    />
                    <p>Plumbing</p>
                  </a>
                  <a
                    href="find-laborer-search.php?q=electrical"
                    class="col-2 text-decoration-none blue-link labor-icons"
                  >
                    <img
                      src="../../icons/labors/electric 1.png"
                      class="img-fluid d-inline mb-3"
                      alt="electrical"
                    />
                    <p>Electrical</p>
                  </a>
                  <a
                    href="find-laborer-search.php?q=carpentry"
                    class="col-2 text-decoration-none blue-link labor-icons"
                  >
                    <img
                      src="../../icons/labors/carp 1.png"
                      class="img-fluid d-inline mb-3"
                      alt="carpentry"
                    />
                    <p>Carpentry</p>
                  </a>
                  <a
                    href="find-laborer-search.php?q=roofing"
                    class="col-2 text-decoration-none blue-link labor-icons"
                  >
                    <img
                      src="../../icons/labors/roofer 1.png"
                      class="img-fluid d-inline mb-3"
                      alt="roofing"
                    />
                    <p>Roofing</p>
                  </a>
                  <a
                    href="find-laborer-search.php?q=appliances"
                    class="col-2 text-decoration-none blue-link labor-icons"
                  >
                    <img
                      src="../../icons/labors/maint 1.png"
                      class="img-fluid d-inline mb-3"
                      alt="appliances"
                    />
                    <p>Appliances</p>
                  </a>
                  <a
                    href="find-laborer-search.php?q=welding"
                    class="col-2 text-decoration-none blue-link labor-icons"
                  >
                    <img
                      src="../../icons/labors/weld 1.png"
                      class="img-fluid d-inline mb-3"
                      alt="welding"
                    />
                    <p>Welding</p>
                  </a>
                  <a
                    href="find-laborer-search.php?q=housekeeping"
                    class="col-2 text-decoration-none blue-link labor-icons"
                  >
                    <img
                      src="../../icons/labors/housekeep 1.png"
                      class="img-fluid d-inline mb-3"
                      alt="housekeep"
                    />
                    <p>Housekeeping</p>
                  </a>
                  <a
                    href="find-laborer-search.php?q=painting"
                    class="col-2 text-decoration-none blue-link labor-icons"
                  >
                    <img
                      src="../../icons/labors/paint 1.png"
                      class="img-fluid d-inline mb-3"
                      alt="paint"
                    />
                    <p>Painting</p>
                  </a>
                  <a
                    href="find-laborer-search.php?q=pest-control"
                    class="col-2 text-decoration-none blue-link labor-icons"
                  >
                    <img
                      src="../../icons/labors/pest 1.png"
                      class="img-fluid d-inline mb-3"
                      alt="pest"
                    />
                    <p>Pest Control</p>
                  </a>
                  <a
                    href="find-laborer-search.php?q=tutoring"
                    class="col-2 text-decoration-none blue-link labor-icons"
                  >
                    <img
                      src="../../icons/labors/tutor 1.png"
                      class="img-fluid d-inline mb-3"
                      alt="tutoring"
                    />
                    <p>Tutoring</p>
                  </a>
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
