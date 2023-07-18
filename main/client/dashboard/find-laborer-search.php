<?php 

session_start();

require_once "../../includes/config.php";
require_once "../../includes/functions.php";

//check if user is logged in
if(isset($_SESSION['user_id']) && isset($_SESSION['user_role'])) {

  checkCustomer($_SESSION['user_role']);
  $first_name = $_SESSION['first_name'];

  //search
  if (isset($_POST['submit-search'])) {
    $search = mysqli_real_escape_string($conn, $_POST['search']);

    $sql = "SELECT U.username, U.user_role, A.application_status, concat(U.first_name, ' ', U.middle_name, ' ', 
    U.last_name, ' ', U.suffix) AS full_name, A.specialization, 
    U.email_add, U.phone_number, U.sex, U.city, A.employment_type, 
    A.employer, A.certification
    FROM users AS U
    INNER JOIN applications AS A
    ON U.user_id = A.user_id
    WHERE (U.user_role = 'laborer' AND A.application_status = 'approved') AND 
    (concat(U.first_name, ' ', U.middle_name, ' ', 
    U.last_name, ' ', U.suffix) LIKE '%$search%' OR
    A.specialization LIKE '%$search%' OR
    U.email_add LIKE '%$search%' OR
    U.city LIKE '%$search%' OR
    A.employment_type LIKE '%$search%')";

    $result = mysqli_query($conn, $sql);
    $query_result = mysqli_num_rows($result);
    
    if($query_result == 0){
      header("Location: find-laborer-search.php?error=noresults");
      exit();    
    }

  } 

  if (isset($_GET["q"])) {

    if($_GET["q"]=="plumbing"){
      $result = searchGet($conn, "plumbing");
      
    } else if ($_GET["q"]=="electrical") {
      $result = searchGet($conn, "electrical");

    } else if ($_GET["q"]=="carpentry") {
      $result = searchGet($conn, "carpentry");

    } else if ($_GET["q"]=="roofing") {
      $result = searchGet($conn, "roofing");
      
    } else if ($_GET["q"]=="appliances") {
      $result = searchGet($conn, "appliances");
      
    } else if ($_GET["q"]=="welding") {
      $result = searchGet($conn, "welding");
      
    } else if ($_GET["q"]=="housekeep") {
      $result = searchGet($conn, "housekeep");

    } else if ($_GET["q"]=="paint") {
      $result = searchGet($conn, "paint");

    } else if ($_GET["q"]=="pest-control") {
      $result = searchGet($conn, "pest control");
      
    } else if ($_GET["q"]=="tutoring") {
      $result = searchGet($conn, "tutoring");
      
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

            $modal_title = "Oh, no!";

          if($_GET["error"] == "noresults") {
            $error_message = "No results!";
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
            class="col-12 rounded-4 rounded-top-0 oranges white-font g-0 z-0"
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
                        name="search"
                        placeholder="Search"
                        aria-label="Search"
                      />
                      <button
                        class="btn btn-outline-success blue-outline-btn"
                        name="submit-search"
                        type="submit"
                      >
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
                            <a href="find-laborer-dr.php?laborer='.$row['username'].'" class="btn btn-primary green-btn mb-3">
                              Direct Request
                            </a>
                            <a href="#" class="btn btn-primary blue-btn">
                              <i class="fa-solid fa-message"></i>
                              Message
                            </a>
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
                ?>             
                
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
