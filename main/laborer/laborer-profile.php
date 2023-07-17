<?php
  session_start();

  require_once "../includes/config.php";
  require_once "../includes/functions.php";

  //check if user is logged in
  if(isset($_SESSION['user_id']) && isset($_SESSION['user_role'])) {
  
    checkLaborer($_SESSION['user_role']);

    $userProfile = getProfile($conn, $_SESSION['user_id'], $_SESSION['user_role']);
    if ($userProfile) {
      $fullName = $userProfile["fullName"];
      $username = $userProfile["username"];
      $phone_number = $userProfile["phone_number"];
      $email_add = $userProfile["email_add"];
      $specialization = $userProfile["specialization"];
    }

    
      
  } else {
    header("Location: ../index.php");
    exit();
  }

  
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Profile</title>

    <!--default-->
    <link rel="icon" type="favicon" href="../icons/favicon.ico" />
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

    <link rel="stylesheet" href="../app.css" />

    <!--For navbar-->
    <script src="https://code.jquery.com/jquery-1.10.2.js"></script>
  </head>

  <body>
  <?php
    if (isset($_GET["error"])){

      $modal_title = "Oh, no!";

    if($_GET['error'] == "stmtfailed") {
      $error_message = "Something went wrong (SQL error)";
    } else if ($_GET['error'] == "accountdoesntexist") {
      $error_message = "Something went wrong :(";
    } 

    echo '<script>
        $(document).ready(function(){
            $("#server-message").modal("show")
        });
        </script>';
    } 
    
    ?>
    <div class="container-fluid main-pages">
      <div class="row">
        <!--Navigation bar-->
        <div
          id="nav-placeholder"
          class="bg-light col-1 min-vh-100 d-flex flex-column justify-content-center text-truncate"
        ></div>
        <script>
          $(function () {
            $("#nav-placeholder").load("../laborer/nav.php");
          });
        </script>
        <!--end of Navigation bar-->

        <!--MAIN-->
        <div class="col p-4">
          <main
            class="col-12 rounded-4 oranges orange-font others-envelope g-0 z-0"
          >
            <div class="row p-3 g-1">
              <div
                class="col-12 rounded rounded-4 border border-4 whites profile-container overflow-auto p-3"
              >
                <header class="row align-items-center">
                  <div class="col-1">
                    <img
                      class="img-fluid"
                      src="../icons/blank-profile.png"
                      alt="profpic"
                      style="max-width: 140px"
                    />
                  </div>
                  <div class="col ms-4">
                    <h1 class="display-3 blue-font header">
                     <?php echo $fullName; ?>
                    </h1>
                    <h2 class="header text-normal">
                      @<?php echo $username; ?>
                      <span class="ms-1 blue-font font-normal"
                        >| <?php echo $specialization; ?></span
                      >
                    </h2>
                  </div>
                  <div class="col-3 me-4">
                    <p>
                      <img class="me-2" src="../icons/profile/phone.png" alt="" />
                      <span><?php echo $phone_number; ?></span>
                    </p>
                    <p>
                      <img class="me-2" src="../icons/profile/email.png" alt="" />
                      <span><?php echo $email_add; ?></span>
                    </p>
                  </div>
                </header>

                <hr />
                <section class="row mt-5">
                  <header>
                    <h2 class="header blue-font text-normal">Reviews</h2>
                  </header>

                  <!--Reviews-->
                  <article
                    class="row border border-4 rounded rounded-4 mx-auto"
                  >
                    <div class="col-12 mt-4">
                      <header class="row">
                        <div class="row align-items-start">
                          <div class="col-1">
                            <div class="col-12">
                              <img
                                src="../icons/blank-profile.png"
                                class="img-fluid d-inline"
                                alt="..."
                              />
                            </div>
                          </div>
                          <div class="col-3">
                            <h4 class="fs-2 header blue-font">Client Name</h4>
                            <h4 class="fs-4 orange-font">Labor Needed</h4>
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
                </section>
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
