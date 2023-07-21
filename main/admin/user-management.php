<?php 
  session_start();

  require_once "../includes/config.php";
  require_once "../includes/functions.php";

  //check if user is logged in
  if(isset($_SESSION['user_id']) && isset($_SESSION['user_role'])) {
  
    checkAdmin($_SESSION['user_role']);
      
  } else {
    header("Location: ../index.php");
    exit();
  }

  if (isset($_POST['clientsAction'])) {
    $selectedAction = $_POST['clientsAction']; 
    $userId = $_POST['userId'];
    if ($selectedAction == 'activate') {
      $updateQuery = "UPDATE users SET status = 'active' WHERE user_id = '$userId'";
    } else if ($selectedAction == 'blocked') {
      $updateQuery = "UPDATE users SET status = 'blocked' WHERE user_id = '$userId'";
    } 
    $updateResult = mysqli_query($conn, $updateQuery);
  }

  if (isset($_POST['laborersAction'])) {
    $selectedAction = $_POST['laborersAction']; 
    $userId = $_POST['lr_userId'];
    if ($selectedAction == 'activate') {
      $updateQuery = "UPDATE users SET status = 'active' WHERE user_id = '$userId'";
    } else if ($selectedAction == 'deactivate') {
      $updateQuery = "UPDATE users SET status = 'blocked' WHERE user_id = '$userId'";
    } else if ($selectedAction == 'onhold') {
      $updateQuery = "UPDATE users SET status = 'onhold' WHERE user_id = '$userId'";
    } 
    $updateResult = mysqli_query($conn, $updateQuery);
  }
  
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>User Management</title>

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
    <div class="container-fluid main-pages">
      <div class="row">
        <!--Navigation bar-->
        <div
          id="nav-placeholder"
          class="bg-light col-1 min-vh-100 d-flex flex-column justify-content-center text-truncate"
        ></div>
        <script>
          $(function () {
            $("#nav-placeholder").load("nav.php");
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
                class="col-12 rounded rounded-4 border border-4 whites profile-container p-3"
              >
                <header class="row align-items-center">
                  <div class="col ms-4">
                    <h1 class="display-1 blue-font header">
                      User Management
                    </h1>
                    </h5>
                  </div>
                </header>
                <hr />

                <section class="row mt-5">
                  <header>
                    <h2 class="header orange-font text-normal">
                      Clients
                    </h2>
                  </header>

                  <article
                    class="row border border-4 rounded rounded-4 mx-auto overflow-auto"
                    style="height: 250px"
                  >
                    <div class="col-12 p-2">
                      <div class="table-responsive">
                        <table
                          class="table table-striped table-hover text-center"
                        >
                          <thead>
                            <tr>
                              <th scope="col">#</th>
                              <th scope="col">User ID</th>
                              <th scope="col">Email Address</th>
                              <th scope="col">Username</th>
                              <th scope="col">Full Name</th>
                              <th scope="col">Sex</th>
                              <th scope="col">Birthdate</th>
                              <th scope="col">Address</th>
                              <th scope="col">Date Created</th>
                              <th scope="col">Status</th>
                              <th scope="col">Actions</th>
                            </tr>
                          </thead>
                          <tbody>
                            <form method="POST">
                            <?php 
                            $num = 0; 
                            $query = "SELECT user_id, email_add, username, concat(first_name, ' ' , middle_name, ' ' , last_name, ' ', suffix) AS fullName, sex, dob, street_address, created_at, status FROM users WHERE user_role = 'customer'";
                            $query_run = mysqli_query($conn, $query);
                            foreach ($query_run as $row) {
                              ++$num;
                              $userId = $row["user_id"];
                              $email = $row["email_add"];
                              $username = $row["username"];
                              $fullName = $row["fullName"];
                              $sex = $row["sex"];
                              $dob = $row["dob"];
                              $street_address = $row["street_address"];
                              $created_at = $row["created_at"];
                              $status = $row["status"];

                              echo "
                              <tr class='text-normal font-normal'>
                                <th scope='row'>$num</th>
                                <td>$userId</td>
                                <td>$email</td>
                                <td>$username</td>
                                <td>$fullName</td>
                                <td>$sex</td>
                                <td>$dob</td>
                                <td>$street_address</td>
                                <td>$created_at</td>
                                <td>";

                                if($status === "active") {
                                  echo "<span class='badge bg-success fs-6'>$status</span>";
                                } else if ($status === "pending") {
                                  echo "<span class='badge bg-secondary fs-6'>$status</span>";
                                } else if ($status === "blocked") {
                                  echo "<span class='badge bg-danger fs-6'>$status</span>";
                                }
                                
                                echo "
                                </td>
                                <td>
                                <input type='hidden' name='userId' value='$userId'>
                                <div class='btn-group'>
                                    <button class='btn btn-primary orange-btn dropdown-toggle' type='button' data-bs-toggle='dropdown' aria-expanded='false'>
                                      Actions
                                    </button>
                                    <ul class='dropdown-menu'>
                                      <li><button class='dropdown-item' type='submit' name='clientsAction' value='activate'>Activate</button></li>
                                      <li><button class='dropdown-item' type='submit' name='clientsAction' value='blocked'>Block</button></li>
                                    </ul>
                                  </div>
                              </td>
                              </tr>
                              ";
                            }

                            ?>
                            </form>

                            <!--BLANK-->
                            <tr>
                                <td>&nbsp</td>
                                <td>&nbsp</td>
                                <td>&nbsp</td>
                                <td>&nbsp</td>
                                <td>&nbsp</td>
                                <td>&nbsp</td>
                                <td>&nbsp</td>
                                <td>&nbsp</td>
                                <td>&nbsp</td>
                                <td>&nbsp</td>
                                <td>&nbsp</td>
                            </tr>

                            <tr>
                                <td>&nbsp</td>
                                <td>&nbsp</td>
                                <td>&nbsp</td>
                                <td>&nbsp</td>
                                <td>&nbsp</td>
                                <td>&nbsp</td>
                                <td>&nbsp</td>
                                <td>&nbsp</td>
                                <td>&nbsp</td>
                                <td>&nbsp</td>
                                <td>&nbsp</td>
                            </tr>

                            <tr>
                                <td>&nbsp</td>
                                <td>&nbsp</td>
                                <td>&nbsp</td>
                                <td>&nbsp</td>
                                <td>&nbsp</td>
                                <td>&nbsp</td>
                                <td>&nbsp</td>
                                <td>&nbsp</td>
                                <td>&nbsp</td>
                                <td>&nbsp</td>
                                <td>&nbsp</td>
                            </tr>

                            <!----->
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </article>
                  <header>
                    <h2 class="header orange-font text-normal mt-3">
                      Laborers
                    </h2>
                  </header>

                  <article
                    class="row border border-4 rounded rounded-4 mx-auto overflow-auto"
                    style="height: 250px"
                  >
                    <div class="col-12 p-2">
                      <div class="table-responsive">
                        <table
                          class="table table-striped table-hover text-center"
                        >
                          <thead>
                            <tr>
                              <th scope="col">#</th>
                              <th scope="col">User ID</th>
                              <th scope="col">Specialization</th>
                              <th scope="col">Email Address</th>
                              <th scope="col">Username</th>
                              <th scope="col">Full Name</th>
                              <th scope="col">Sex</th>
                              <th scope="col">Birthdate</th>
                              <th scope="col">Address</th>
                              <th scope="col">Date Created</th>
                              <th scope="col">Credit Balance</th>
                              <th scope="col">Status</th>
                              <th scope="col">Actions</th>
                            </tr>
                          </thead>
                          <tbody>
                            <form method="POST">
                              <?php 
                              $num = 0; 
                              $lr_query = "SELECT U.user_id, A.specialization, U.email_add, U.username,
                              concat(U.first_name, ' ', U.middle_name, ' ', U.last_name, ' ', U.suffix) 
                              AS fullName, U.sex, U.dob, concat(U.street_address, ' ', 
                              U.state, ' ', U.city, ' ', U.zip_code) AS fullAddress, A.created_at, 
                              L.credit_balance, U.status 
                              FROM users AS U INNER JOIN applications AS A ON U.user_id = A.user_id 
                              INNER JOIN laborers AS L ON A.applicant_id = L.applicant_id 
                              WHERE U.user_role = 'laborer';";

                              $lr_query_run = mysqli_query($conn, $lr_query);                           
                              foreach ($lr_query_run as $row) {
                                ++$num;
                                $lr_user_id = $row["user_id"];
                                $lr_specialization = $row["specialization"];
                                $lr_email_add = $row["email_add"];
                                $lr_username = $row["username"];
                                $lr_full_name = $row["fullName"];
                                $lr_sex = $row["sex"];
                                $lr_dob = $row["dob"];
                                $lr_address = $row["fullAddress"];
                                $lr_datecreated = $row["created_at"];
                                $lr_credit_bal = $row["credit_balance"];
                                $lr_status = $row["status"];
                                
                                echo "
                                <tr class='text-normal font-normal'>
                                  <th scope='row'>$num</th>
                                  <td>$lr_user_id</td>
                                  <td>$lr_specialization</td>
                                  <td>$lr_email_add</td>
                                  <td>$lr_username</td>
                                  <td>$lr_full_name</td>
                                  <td>$lr_sex</td>
                                  <td>$lr_dob</td>
                                  <td>$lr_address</td>
                                  <td>$lr_datecreated</td>
                                  <td>₱ $lr_credit_bal</td>
                                  <td>";

                                  if($lr_status === "active") {
                                    echo "<span class='badge bg-success fs-6'>$lr_status</span>";
                                  } else if ($lr_status === "pending") {
                                    echo "<span class='badge bg-secondary fs-6'>$lr_status</span>";
                                  } else if ($lr_status === "blocked") {
                                    echo "<span class='badge bg-danger fs-6'>$lr_status</span>";
                                  } else if ($lr_status === "onhold") {
                                    echo "<span class='badge bg-warning fs-6'>$lr_status</span>";
                                  }

                                  echo "
                                  </td>
                                  <td>
                                    <input type='hidden' name='lr_userId' value='$lr_user_id'>
                                    <div class='btn-group'>
                                    <button class='btn btn-primary orange-btn dropdown-toggle' type='button' data-bs-toggle='dropdown' aria-expanded='false'>
                                      Actions
                                    </button>
                                    <ul class='dropdown-menu'>
                                    <li><button class='dropdown-item' type='submit' name='laborersAction' value='activate'>Activate</button></li>
                                    <li><button class='dropdown-item' type='submit' name='laborersAction' value='deactivate'>Block</button></li>
                                    <li><button class='dropdown-item' type='submit' name='laborersAction' value='onhold'>On hold</button></li>                                  
                                    </ul>
                                  </div>
                                  </td>
                                </tr>
                                ";
                              }

                              ?>
                              </form>

                            <!--BLANK-->
                            <tr>
                                <td>&nbsp</td>
                                <td>&nbsp</td>
                                <td>&nbsp</td>
                                <td>&nbsp</td>
                                <td>&nbsp</td>
                                <td>&nbsp</td>
                                <td>&nbsp</td>
                                <td>&nbsp</td>
                                <td>&nbsp</td>
                                <td>&nbsp</td>
                                <td>&nbsp</td>
                                <td>&nbsp</td>
                                <td>&nbsp</td>
                            </tr>
                            <tr>
                                <td>&nbsp</td>
                                <td>&nbsp</td>
                                <td>&nbsp</td>
                                <td>&nbsp</td>
                                <td>&nbsp</td>
                                <td>&nbsp</td>
                                <td>&nbsp</td>
                                <td>&nbsp</td>
                                <td>&nbsp</td>
                                <td>&nbsp</td>
                                <td>&nbsp</td>
                                <td>&nbsp</td>
                                <td>&nbsp</td>
                            </tr>
                            <tr>
                                <td>&nbsp</td> 
                                <td>&nbsp</td>
                                <td>&nbsp</td>
                                <td>&nbsp</td>
                                <td>&nbsp</td>
                                <td>&nbsp</td>
                                <td>&nbsp</td>
                                <td>&nbsp</td>
                                <td>&nbsp</td>
                                <td>&nbsp</td>
                                <td>&nbsp</td>
                                <td>&nbsp</td>
                                <td>&nbsp</td>
                            </tr>
                            <!----->
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </article>

                </section>
              </div>
            </div>
          </main>
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
