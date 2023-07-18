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
              $("#nav-placeholder").load("/main/client/nav.html");
            });
        </script>
        <!--end of Navigation bar-->
        <!--MAIN-->
        <div class="col p-4 orange-main">
          <nav class="col-12 mt-3">
            <ul class="nav nav-tabs nav-fill z-1 fs-3">
              <li class="nav-item">
                <a
                  class="nav-link text-start active"
                  aria-current="page"
                  href="/main/client/requests/on-going-requests.html"
                  >On-going Request</a
                >
              </li>
              <li class="nav-item">
                <a
                  class="nav-link text-start"
                  href="/main/client/requests/request-history.html"
                  >Request History</a
                >
              </li>
            </ul>
          </nav>

          <main
            class="col-12 rounded-4 rounded-top-0 oranges orange-font requests-envelope g-0 z-0"
          >
            <div class="row p-3 g-1">
              <header class="col-5 mt-4 text-white">
                <h2 class="display-4 header">On-going Requests</h2>
                <p class="fs-4 font-normal text-normal">
                  Check your posted/pending requests here
                </p>
              </header>
              <header
                class="col-6 ms-auto mt-2 rounded rounded-4 border border-4 whites p-3"
              >
                <div class="row justify-content-center">
                  <div class="col-7">
                    <h2 class="display-5 header">
                      <span id="laborTitle">Labor Title</span>
                    </h2>
                    <p class="fs-5 font-normal text-normal d-inline">
                      Request ID: <span id="requestID">0128</span>
                    </p>
                    <button class="btn btn-danger red-btn btn-sm ms-2">Cancel booking</button>
                  </div>
                  <div class="col-4 blue-font">
                    <p>
                      <i class="fa-solid fa-location-dot me-3"></i>
                      <span id="requestAddress">516 Juan Luna Ave.</span>
                    </p>
                    <p>
                      <i class="fa-solid fa-clock me-3"></i>
                      <span id="requestTime">12:00 PM</span>
                    </p>
                    <p>
                      <i class="fa-solid fa-tag me-3"></i>
                      <span id="requestTime">Php 550</span>
                    </p>
                  </div>
                </div>
              </header>

              <div
                class="col-12 scrollable-x mt-5 mx-auto rounded-4 p-4 whites d-flex flex-nowrap"
              >
                <!--Laborers-->
                <div
                  class="col-6 rounded-4 border border-5 whites orange-font p-3 my-1 me-2"
                >
                  <header class="col-12">
                    <div class="row align-items-start g-0">
                      <div class="col-2">
                        <div class="col-11">
                          <img
                            src="icons/blank-profile.png"
                            class="img-fluid d-inline"
                            alt="..."
                          />
                        </div>
                      </div>
                      <div class="col-6">
                        <h4 class="fs-2 header">Laborer Name</h4>
                        <p class="lead blue-font">Specialization</p>
                        <div class="rating">
                          <i class="fa-solid fa-star"></i>
                          <i class="fa-solid fa-star"></i>
                          <i class="fa-solid fa-star"></i>
                          <i class="fa-solid fa-star"></i>
                          <i class="fa-solid fa-star"></i>
                        </div>
                      </div>
                      <div class="col text-end">
                        <button type="submit" class="btn btn-link yesno mb-3">
                          <img
                            class="img-fluid"
                            src="icons/yesno/accept.png"
                            alt=""
                          />
                        </button>
                        <button type="submit" class="btn btn-link yesno mb-3">
                          <img
                            class="img-fluid"
                            src="icons/yesno/decline.png"
                            alt=""
                          />
                        </button>
                      </div>
                    </div>
                  </header>
                  <article
                    class="col-12 mt-4 font-normal text-black overflow-auto"
                  >
                    <div class="description">
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
                </div>
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
