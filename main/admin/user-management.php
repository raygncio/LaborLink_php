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
                            <tr class="text-normal font-normal">
                              <th scope="row">01</th>
                              <td>001</td>
                              <td>user@gmail.com</td>
                              <td>@username</td>
                              <td>Thalia Anne Escueta</td>
                              <td>Male</td>
                              <td>04/29/2018</td>
                              <td>22 Dreamland Subd. Mandaluyong</td>
                              <td>04/29/2020</td>
                              <td>
                                <span class="badge bg-success fs-5">Active</span>
                            </td>
                              <td>
                                <div class="btn-group">
                                    <button class="btn btn-primary orange-btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                      Actions
                                    </button>
                                    <ul class="dropdown-menu">
                                      <li><a class="dropdown-item" href="#">Activate</a></li>
                                      <li><a class="dropdown-item" href="#">Deactivate</a></li>
                                      <li><a class="dropdown-item" href="#">More details</a></li>
                                    </ul>
                                  </div>
                              </td>
                            </tr>
                            <tr class="text-normal font-normal">
                              <th scope="row">01</th>
                              <td>001</td>
                              <td>user@gmail.com</td>
                              <td>@username</td>
                              <td>Thalia Anne Escueta</td>
                              <td>Male</td>
                              <td>04/29/2018</td>
                              <td>22 Dreamland Subd. Mandaluyong</td>
                              <td>04/29/2020</td>
                              <td>
                                <span class="badge bg-success fs-5">Active</span>
                            </td>
                              <td>
                                <div class="btn-group">
                                    <button class="btn btn-primary orange-btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                      Actions
                                    </button>
                                    <ul class="dropdown-menu">
                                      <li><a class="dropdown-item" href="#">Activate</a></li>
                                      <li><a class="dropdown-item" href="#">Deactivate</a></li>
                                      <li><a class="dropdown-item" href="#">More details</a></li>
                                    </ul>
                                  </div>
                              </td>
                            </tr>
                            <tr class="text-normal font-normal">
                              <th scope="row">01</th>
                              <td>001</td>
                              <td>user@gmail.com</td>
                              <td>@username</td>
                              <td>Thalia Anne Escueta</td>
                              <td>Male</td>
                              <td>04/29/2018</td>
                              <td>22 Dreamland Subd. Mandaluyong</td>
                              <td>04/29/2020</td>
                              <td>
                                <span class="badge bg-success fs-5">Active</span>
                            </td>
                              <td>
                                <div class="btn-group">
                                    <button class="btn btn-primary orange-btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                      Actions
                                    </button>
                                    <ul class="dropdown-menu">
                                      <li><a class="dropdown-item" href="#">Activate</a></li>
                                      <li><a class="dropdown-item" href="#">Deactivate</a></li>
                                      <li><a class="dropdown-item" href="#">More details</a></li>
                                    </ul>
                                  </div>
                              </td>
                            </tr>
                            <tr class="text-normal font-normal">
                              <th scope="row">01</th>
                              <td>001</td>
                              <td>user@gmail.com</td>
                              <td>@username</td>
                              <td>Thalia Anne Escueta</td>
                              <td>Male</td>
                              <td>04/29/2018</td>
                              <td>22 Dreamland Subd. Mandaluyong</td>
                              <td>04/29/2020</td>
                              <td>
                                <span class="badge bg-success fs-5">Active</span>
                            </td>
                              <td>
                                <div class="btn-group">
                                    <button class="btn btn-primary orange-btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                      Actions
                                    </button>
                                    <ul class="dropdown-menu">
                                      <li><a class="dropdown-item" href="#">Activate</a></li>
                                      <li><a class="dropdown-item" href="#">Deactivate</a></li>
                                      <li><a class="dropdown-item" href="#">More details</a></li>
                                    </ul>
                                  </div>
                              </td>
                            </tr>
                            <tr class="text-normal font-normal">
                              <th scope="row">01</th>
                              <td>001</td>
                              <td>user@gmail.com</td>
                              <td>@username</td>
                              <td>Thalia Anne Escueta</td>
                              <td>Male</td>
                              <td>04/29/2018</td>
                              <td>22 Dreamland Subd. Mandaluyong</td>
                              <td>04/29/2020</td>
                              <td>
                                <span class="badge bg-success fs-5">Active</span>
                            </td>
                              <td>
                                <div class="btn-group">
                                    <button class="btn btn-primary orange-btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                      Actions
                                    </button>
                                    <ul class="dropdown-menu">
                                      <li><a class="dropdown-item" href="#">Activate</a></li>
                                      <li><a class="dropdown-item" href="#">Deactivate</a></li>
                                      <li><a class="dropdown-item" href="#">More details</a></li>
                                    </ul>
                                  </div>
                              </td>
                            </tr>
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
                            <tr class="text-normal font-normal">
                              <th scope="row">01</th>
                              <td>001</td>
                              <td>Plumbing</td>
                              <td>user@gmail.com</td>
                              <td>@username</td>
                              <td>Thalia Anne Escueta</td>
                              <td>Male</td>
                              <td>04/29/2018</td>
                              <td>22 Dreamland Subd. Mandaluyong</td>
                              <td>04/29/2020</td>
                              <td>Php 500</td>
                              <td>
                                <span class="badge bg-success fs-5">Active</span>
                            </td>
                              <td>
                                <div class="btn-group">
                                    <button class="btn btn-primary orange-btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                      Actions
                                    </button>
                                    <ul class="dropdown-menu">
                                      <li><a class="dropdown-item" href="#">Activate</a></li>
                                      <li><a class="dropdown-item" href="#">Deactivate</a></li>
                                      <li><a class="dropdown-item" href="#">More details</a></li>
                                    </ul>
                                  </div>
                              </td>
                            </tr>

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
