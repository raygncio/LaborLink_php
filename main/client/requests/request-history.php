<?php 
  session_start();

  require_once "../../includes/config.php";
  require_once "../../includes/functions.php";

  //check if user is logged in
  if(isset($_SESSION['user_id']) && isset($_SESSION['user_role'])) {
  
    checkCustomer($_SESSION['user_role']);
    checkUserStatus($conn, $_SESSION['user_id']); //checks user if blocked

    $query_run = getHistory($conn, $_SESSION['user_id'], $_SESSION['user_role']);
    $query_result = mysqli_num_rows($query_run);
    $num = 0; // for table numbers
    
      
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

          if($_GET["message"] == "requestcompleted") {
            $modal_message = "Request done! <br> You can see your completed requests here.";
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
                  class="nav-link text-start"
                  href="on-going-requests.php"
                  >On-going Request</a
                >
              </li>
              <li class="nav-item">
                <a
                  class="nav-link text-start active"
                  aria-current="page"
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
              <header class="col-4 mt-4 text-white">
                <h2 class="display-4 header">Request History</h2>
                <p class="fs-4 font-normal text-normal">
                  Check your previous requests here
                </p>
              </header>

              <div
                class="col-12 ms-auto mt-2 rounded rounded-4 border border-4 whites table-content overflow-auto p-3"
              >
                <?php
                if($query_result == 0) {
                  echo '
                    <div class="alert alert-info alert-dismissible fade show" role="alert">
                      <strong>No records found yet...</strong> <hr> <p class="font-normal">Make your first request today!</p>
                      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                ';
                }
                ?>

                <hr />

                <div class="row">
                  <div class="table-responsive">
                    <table class="table table-striped table-hover text-center">
                      <thead>
                        <tr>
                          <th scope="col">#</th>
                          <th scope="col">Request ID</th>
                          <th scope="col">Category</th>
                          <th scope="col">Date Created</th>
                          <th scope="col">Title</th>
                          <th scope="col">Laborer Name</th>
                          <th scope="col">Fee</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php                                                  
                            foreach ($query_run as $row) {
                              ++$num;
                              $request_id = $row["request_id"];
                              $category = $row["category"];
                              $date = $row["created_at"];
                              $title = $row["title"];
                              $fullName = $row["fullName"];
                              $suggested_fee = $row["suggested_fee"];

                              echo "
                              <tr class='text-normal font-normal'>
                                <th scope='row'>$num</th>
                                <td>$request_id</td>
                                <td>$category</td>
                                <td>$date</td>
                                <td>$title</td>
                                <td>$fullName</td>
                                <td>$suggested_fee</td>
                              </tr>
                              ";
                            }

                            ?>
                      </tbody>
                    </table>
                  </div>
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
