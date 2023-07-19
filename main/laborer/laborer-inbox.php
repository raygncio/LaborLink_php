<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Messages</title>

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
    <!--Ajax-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
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
            $("#nav-placeholder").load("../laborer/nav.php");
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
          <main
            class="col-12 rounded-4 oranges orange-font others-envelope g-0 z-0"
          >
            <div class="row p-3 g-1">
              <header class="col-1 mt-4">
                <img class="img-fluid" src="../icons/messages/inbox.png" alt="" />
              </header>
              <header class="col-3 text-white">
                <h2 class="display-1 header">Inbox</h2>
              </header>

              <div
                class="col-12 rounded rounded-4 border border-4 whites chat overflow-auto p-3"
              >
                <div class="row">
                  <!--CHAT HEAD-->
                  <div
                    class="col-3 d-flex flex-column border border-2 rounded-4 inbox overflow-auto"
                  >
                    <ul class="nav nav-pills flex-column">
                      <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">
                          <div class="row chat-head">
                            <div class="col-3 d-flex flex-column mt-1">
                              <img
                                class="img-fluid"
                                src="../icons/blank-profile.png"
                                alt=""
                              />
                            </div>
                            <div class="col lead text-normal text-truncate">
                              <p class="fs-4 header orange-font">
                                Client Name
                              </p>
                              Lorem ipsum dolor sit amet consectetur adipisicing
                              elit. Omnis doloremque ratione laudantium placeat
                              obcaecati aliquid voluptas dolor vitae rem, sequi
                              voluptate quam, totam repudiandae vero quas. Ut
                              minima quam temporibus.
                            </div>
                          </div>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">
                          <div class="row chat-head">
                            <div class="col-3 d-flex flex-column mt-1">
                              <img
                                class="img-fluid"
                                src="../icons/blank-profile.png"
                                alt=""
                              />
                            </div>
                            <div class="col lead text-normal text-truncate">
                              <p class="fs-4 header orange-font">
                                Client Name
                              </p>
                              Lorem ipsum dolor sit amet consectetur adipisicing
                              elit. Omnis doloremque ratione laudantium placeat
                              obcaecati aliquid voluptas dolor vitae rem, sequi
                              voluptate quam, totam repudiandae vero quas. Ut
                              minima quam temporibus.
                            </div>
                          </div>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">
                          <div class="row chat-head">
                            <div class="col-3 d-flex flex-column mt-1">
                              <img
                                class="img-fluid"
                                src="../icons/blank-profile.png"
                                alt=""
                              />
                            </div>
                            <div class="col lead text-normal text-truncate">
                              <p class="fs-4 header orange-font">
                                Client Name
                              </p>
                              Lorem ipsum dolor sit amet consectetur adipisicing
                              elit. Omnis doloremque ratione laudantium placeat
                              obcaecati aliquid voluptas dolor vitae rem, sequi
                              voluptate quam, totam repudiandae vero quas. Ut
                              minima quam temporibus.
                            </div>
                          </div>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">
                          <div class="row chat-head">
                            <div class="col-3 d-flex flex-column mt-1">
                              <img
                                class="img-fluid"
                                src="../icons/blank-profile.png"
                                alt=""
                              />
                            </div>
                            <div class="col lead text-normal text-truncate">
                              <p class="fs-4 header orange-font">
                                Client Name
                              </p>
                              Lorem ipsum dolor sit amet consectetur adipisicing
                              elit. Omnis doloremque ratione laudantium placeat
                              obcaecati aliquid voluptas dolor vitae rem, sequi
                              voluptate quam, totam repudiandae vero quas. Ut
                              minima quam temporibus.
                            </div>
                          </div>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">
                          <div class="row chat-head">
                            <div class="col-3 d-flex flex-column mt-1">
                              <img
                                class="img-fluid"
                                src="../icons/blank-profile.png"
                                alt=""
                              />
                            </div>
                            <div class="col lead text-normal text-truncate">
                              <p class="fs-4 header orange-font">
                                Client Name
                              </p>
                              Lorem ipsum dolor sit amet consectetur adipisicing
                              elit. Omnis doloremque ratione laudantium placeat
                              obcaecati aliquid voluptas dolor vitae rem, sequi
                              voluptate quam, totam repudiandae vero quas. Ut
                              minima quam temporibus.
                            </div>
                          </div>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">
                          <div class="row chat-head">
                            <div class="col-3 d-flex flex-column mt-1">
                              <img
                                class="img-fluid"
                                src="../icons/blank-profile.png"
                                alt=""
                              />
                            </div>
                            <div class="col lead text-normal text-truncate">
                              <p class="fs-4 header orange-font">
                                Client Name
                              </p>
                              Lorem ipsum dolor sit amet consectetur adipisicing
                              elit. Omnis doloremque ratione laudantium placeat
                              obcaecati aliquid voluptas dolor vitae rem, sequi
                              voluptate quam, totam repudiandae vero quas. Ut
                              minima quam temporibus.
                            </div>
                          </div>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">
                          <div class="row chat-head">
                            <div class="col-3 d-flex flex-column mt-1">
                              <img
                                class="img-fluid"
                                src="../icons/blank-profile.png"
                                alt=""
                              />
                            </div>
                            <div class="col lead text-normal text-truncate">
                              <p class="fs-4 header orange-font">
                                Client Name
                              </p>
                              Lorem ipsum dolor sit amet consectetur adipisicing
                              elit. Omnis doloremque ratione laudantium placeat
                              obcaecati aliquid voluptas dolor vitae rem, sequi
                              voluptate quam, totam repudiandae vero quas. Ut
                              minima quam temporibus.
                            </div>
                          </div>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">
                          <div class="row chat-head">
                            <div class="col-3 d-flex flex-column mt-1">
                              <img
                                class="img-fluid"
                                src="../icons/blank-profile.png"
                                alt=""
                              />
                            </div>
                            <div class="col lead text-normal text-truncate">
                              <p class="fs-4 header orange-font">
                                Client Name
                              </p>
                              Lorem ipsum dolor sit amet consectetur adipisicing
                              elit. Omnis doloremque ratione laudantium placeat
                              obcaecati aliquid voluptas dolor vitae rem, sequi
                              voluptate quam, totam repudiandae vero quas. Ut
                              minima quam temporibus.
                            </div>
                          </div>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">
                          <div class="row chat-head">
                            <div class="col-3 d-flex flex-column mt-1">
                              <img
                                class="img-fluid"
                                src="../icons/blank-profile.png"
                                alt=""
                              />
                            </div>
                            <div class="col lead text-normal text-truncate">
                              <p class="fs-4 header orange-font">
                                Client Name
                              </p>
                              Lorem ipsum dolor sit amet consectetur adipisicing
                              elit. Omnis doloremque ratione laudantium placeat
                              obcaecati aliquid voluptas dolor vitae rem, sequi
                              voluptate quam, totam repudiandae vero quas. Ut
                              minima quam temporibus.
                            </div>
                          </div>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">
                          <div class="row chat-head">
                            <div class="col-3 d-flex flex-column mt-1">
                              <img
                                class="img-fluid"
                                src="../icons/blank-profile.png"
                                alt=""
                              />
                            </div>
                            <div class="col lead text-normal text-truncate">
                              <p class="fs-4 header orange-font">
                                Client Name
                              </p>
                              Lorem ipsum dolor sit amet consectetur adipisicing
                              elit. Omnis doloremque ratione laudantium placeat
                              obcaecati aliquid voluptas dolor vitae rem, sequi
                              voluptate quam, totam repudiandae vero quas. Ut
                              minima quam temporibus.
                            </div>
                          </div>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">
                          <div class="row chat-head">
                            <div class="col-3 d-flex flex-column mt-1">
                              <img
                                class="img-fluid"
                                src="../icons/blank-profile.png"
                                alt=""
                              />
                            </div>
                            <div class="col lead text-normal text-truncate">
                              <p class="fs-4 header orange-font">
                                Client Name
                              </p>
                              Lorem ipsum dolor sit amet consectetur adipisicing
                              elit. Omnis doloremque ratione laudantium placeat
                              obcaecati aliquid voluptas dolor vitae rem, sequi
                              voluptate quam, totam repudiandae vero quas. Ut
                              minima quam temporibus.
                            </div>
                          </div>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">
                          <div class="row chat-head">
                            <div class="col-3 d-flex flex-column mt-1">
                              <img
                                class="img-fluid"
                                src="../icons/blank-profile.png"
                                alt=""
                              />
                            </div>
                            <div class="col lead text-normal text-truncate">
                              <p class="fs-4 header orange-font">
                                Client Name
                              </p>
                              Lorem ipsum dolor sit amet consectetur adipisicing
                              elit. Omnis doloremque ratione laudantium placeat
                              obcaecati aliquid voluptas dolor vitae rem, sequi
                              voluptate quam, totam repudiandae vero quas. Ut
                              minima quam temporibus.
                            </div>
                          </div>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">
                          <div class="row chat-head">
                            <div class="col-3 d-flex flex-column mt-1">
                              <img
                                class="img-fluid"
                                src="../icons/blank-profile.png"
                                alt=""
                              />
                            </div>
                            <div class="col lead text-normal text-truncate">
                              <p class="fs-4 header orange-font">
                                Client Name
                              </p>
                              Lorem ipsum dolor sit amet consectetur adipisicing
                              elit. Omnis doloremque ratione laudantium placeat
                              obcaecati aliquid voluptas dolor vitae rem, sequi
                              voluptate quam, totam repudiandae vero quas. Ut
                              minima quam temporibus.
                            </div>
                          </div>
                        </a>
                      </li>
                    </ul>
                  </div>
                  <!---->
                  <div
                    class="col mx-3"
                  >
                    <div class="card mx-auto">
                      <div class="card-body p-4 chat-box overflow-auto">
                        <div class="d-flex align-items-baseline mt-3 mb-4">
                          <div class="position-relative avatar">
                            <img
                              class="img-fluid"
                              src="../icons/blank-profile.png"
                              alt=""
                            />
                            <span
                              class="position-absolute bottom-0 start-100 translate-middle p-1 bg-success border border-light rounded"
                            >
                              <span class="visually-hidden">New alerts</span>
                            </span>
                          </div>
                          <div class="pe-2">
                            <div
                              class="card d-inline-block p-2 px-3 m-2 text-normal font-normal"
                            >
                              Hi! Are you available to chat?
                            </div>
                          </div>
                        </div>
                        <div
                          class="d-flex align-items-baseline mt-3 mb-4 flex-row-reverse"
                        >
                          <div class="position-relative avatar">
                            <img
                              class="img-fluid"
                              src="../icons/blank-profile.png"
                              alt=""
                            />
                            <span
                              class="position-absolute bottom-0 start-100 translate-middle p-1 bg-success border border-light rounded"
                            >
                              <span class="visually-hidden">New alerts</span>
                            </span>
                          </div>
                          <div class="pe-2">
                            <div
                              class="card d-inline-block p-2 px-3 m-1 text-normal font-normal"
                            >
                              Yes! Lorem ipsum dolor, sit amet consectetur
                            </div>
                          </div>
                        </div>
                        <div class="d-flex align-items-baseline mt-3 mb-4">
                          <div class="position-relative avatar">
                            <img
                              class="img-fluid"
                              src="../icons/blank-profile.png"
                              alt=""
                            />
                            <span
                              class="position-absolute bottom-0 start-100 translate-middle p-1 bg-success border border-light rounded"
                            >
                              <span class="visually-hidden">New alerts</span>
                            </span>
                          </div>
                          <div class="pe-2">
                            <div
                              class="card d-inline-block p-2 px-3 m-2 text-normal font-normal"
                            >
                              Yes! Lorem ipsum dolor, sit amet consectetur
                            </div>
                          </div>
                        </div>
                        <div
                          class="d-flex align-items-baseline mt-3 mb-4 flex-row-reverse"
                        >
                          <div class="position-relative avatar">
                            <img
                              class="img-fluid"
                              src="../icons/blank-profile.png"
                              alt=""
                            />
                            <span
                              class="position-absolute bottom-0 start-100 translate-middle p-1 bg-success border border-light rounded"
                            >
                              <span class="visually-hidden">New alerts</span>
                            </span>
                          </div>
                          <div class="pe-2">
                            <div
                              class="card d-inline-block p-2 px-3 m-1 text-normal font-normal"
                            >
                              Yes! Lorem ipsum dolor, sit amet consectetur
                            </div>
                          </div>
                        </div>
                        <div class="d-flex align-items-baseline mt-3 mb-4">
                          <div class="position-relative avatar">
                            <img
                              class="img-fluid"
                              src="../icons/blank-profile.png"
                              alt=""
                            />
                            <span
                              class="position-absolute bottom-0 start-100 translate-middle p-1 bg-success border border-light rounded"
                            >
                              <span class="visually-hidden">New alerts</span>
                            </span>
                          </div>
                          <div class="pe-2">
                            <div
                              class="card d-inline-block p-2 px-3 m-2 text-normal font-normal"
                            >
                              Yes! Lorem ipsum dolor, sit amet consectetur
                            </div>
                          </div>
                        </div>
                        <div
                          class="d-flex align-items-baseline mt-3 mb-4 flex-row-reverse"
                        >
                          <div class="position-relative avatar">
                            <img
                              class="img-fluid"
                              src="../icons/blank-profile.png"
                              alt=""
                            />
                            <span
                              class="position-absolute bottom-0 start-100 translate-middle p-1 bg-success border border-light rounded"
                            >
                              <span class="visually-hidden">New alerts</span>
                            </span>
                          </div>
                          <div class="pe-2">
                            <div
                              class="card d-inline-block p-2 px-3 m-1 text-normal font-normal"
                            >
                              Yes! Lorem ipsum dolor, sit amet consectetur
                            </div>
                          </div>
                        </div>
                        <div class="d-flex align-items-baseline mt-3 mb-4">
                          <div class="position-relative avatar">
                            <img
                              class="img-fluid"
                              src="../icons/blank-profile.png"
                              alt=""
                            />
                            <span
                              class="position-absolute bottom-0 start-100 translate-middle p-1 bg-success border border-light rounded"
                            >
                              <span class="visually-hidden">New alerts</span>
                            </span>
                          </div>
                          <div class="pe-2">
                            <div
                              class="card d-inline-block p-2 px-3 m-2 text-normal font-normal"
                            >
                              Yes! Lorem ipsum dolor, sit amet consectetur
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="card-footer bg-transparent">
                      <div class="input-group">
                        <div class="input-group-text bg-transparent border-0">
                          <button class="btn btn-light">
                            <i class="fa-solid fa-paperclip"></i>
                          </button>
                        </div>
                        <input type="text" class="form-control border-0" placeholder="Write a message...">
                        <div class="input-group-text bg-transparent border-0">
                          <button class="btn btn-light">
                            <i class="fa-solid fa-smile"></i>
                          </button>
                        </div>
                        <div class="input-group-text bg-transparent border-0">
                          <button class="btn btn-light">
                            <i class="fa-solid fa-microphone"></i>
                          </button>
                        </div>
                      </div>
                    </div>
                    <!--END OF CHAT-->
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
