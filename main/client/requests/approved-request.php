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
              $("#nav-placeholder").load("../../client/nav.php");
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

              <div
                class="col-12 ms-auto mt-2 rounded rounded-4 border border-4 whites p-3"
              >
                <div class="row align-items-center">
                  <div class="col-12 blue-font">
                    <h2 class="display-5 header">
                      Labor Needed <span id="laborTitle"></span>
                    </h2>
                    <p class="fs-3 font-normal text-normal">
                      Request ID: <span id="requestID">0128</span>
                    </p>
                  </div>
                  <div class="col-4 blue-font fs-4">
                    <p>
                      <i class="fa-solid fa-location-dot me-3"></i>
                      <span id="requestAddress">516 Juan Luna Ave.</span>
                    </p>
                  </div>
                  <div class="col-4 blue-font fs-4">
                    <p>
                      <i class="fa-solid fa-clock me-3"></i>
                      <span id="requestTime">12:00 PM</span>
                    </p>
                  </div>
                  <div class="col-4 blue-font fs-4">
                    <p>
                      <i class="fa-solid fa-tag me-3"></i>
                      <span id="suggestedFee">Php 550</span>
                    </p>
                  </div>
                </div>
                <hr />

                <article class="col-12 mt-4">
                  <header class="row">
                    <div class="row align-items-start">
                      <div class="col-1">
                        <div class="col-12">
                          <img
                            src="icons/blank-profile.png"
                            class="img-fluid d-inline"
                            alt="..."
                          />
                        </div>
                      </div>
                      <div class="col-3">
                        <h4 class="fs-2 header blue-font">Laborer Name</h4>
                        <h5>Specialization</h5>
                        <div class="laborer-rating orange-font">
                          <i class="fa-solid fa-star"></i>
                          <i class="fa-solid fa-star"></i>
                          <i class="fa-solid fa-star"></i>
                          <i class="fa-solid fa-star"></i>
                          <i class="fa-solid fa-star"></i>
                        </div>
                      </div>
                      <div class="col text-end">
                        <button
                          type="button"
                          class="btn text-white green-btn me-3 mb-3"
                        >
                          Complete
                        </button>
                        <button
                        type="button"
                        class="btn yellow-btn mb-3"
                        data-bs-toggle="modal"
                        data-bs-target="#rateModal"
                      >
                        Rate
                      </button>
                      </div>
                      
                    </div>
                  </header>
                  <article class="fs-5 text-normal font-normal text-black mt-3">
                    <p>
                      Lorem ipsum dolor sit amet consectetur adipisicing elit.
                      Repellendus dolor provident rem cum. Corporis illo minima
                      voluptatibus alias corrupti culpa aliquam laudantium.
                      Rerum a fuga non, accusamus dolores soluta exercitationem?
                    </p>
                    <p>
                      Lorem ipsum dolor sit amet consectetur adipisicing elit.
                      Repellendus dolor provident rem cum. Corporis illo minima
                      voluptatibus alias corrupti culpa aliquam laudantium.
                      Rerum a fuga non, accusamus dolores soluta exercitationem?
                    </p>
                  </article>
                  <hr class="orange-font" />
                </article>

                <!-- Rate Modal -->
                <div
                  class="modal fade"
                  id="rateModal"
                  tabindex="-1"
                  aria-labelledby="exampleModalLabel"
                  aria-hidden="true"
                >
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">
                          Rate your Laborer!
                        </h1>
                        <button
                          type="button"
                          class="btn-close"
                          data-bs-dismiss="modal"
                          aria-label="Close"
                        ></button>
                      </div>
                      <div class="modal-body">
                        <form action="#" class="row">
                          <div class="col-5 mx-auto">
                            <img
                              class="img-fluid"
                              src="icons/blank-profile.png"
                              alt="profpic"
                            />
                          </div>
                          <div class="col-12 text-center mt-4">
                            <p class="fs-4 blue-font">
                              How was the labor service?
                            </p>
                          </div>
                          <div class="col-12 text-center">
                            <div class="fs-3 laborer-rating orange-font">
                              <button
                                type="submit"
                                id="1star"
                                name="1star"
                                value="1"
                                class="btn btn-link orange-link"
                              >
                                <i class="fa-solid fa-star"></i>
                              </button>
                              <button
                                type="submit"
                                id="2star"
                                name="2star"
                                value="2"
                                class="btn btn-link orange-link"
                              >
                                <i class="fa-solid fa-star"></i>
                              </button>
                              <button
                                type="submit"
                                id="3star"
                                name="3star"
                                value="3"
                                class="btn btn-link orange-link"
                              >
                                <i class="fa-solid fa-star"></i>
                              </button>
                              <button
                                type="submit"
                                id="4star"
                                name="4star"
                                value="4"
                                class="btn btn-link orange-link"
                              >
                                <i class="fa-solid fa-star"></i>
                              </button>
                              <button
                                type="submit"
                                id="5star"
                                name="5star"
                                value="5"
                                class="btn btn-link orange-link"
                              >
                                <i class="fa-solid fa-star"></i>
                              </button>
                            </div>
                          </div>
                          <div class="col-8 mt-4 mx-auto">
                            <textarea
                              class="form-control"
                              id="rateComment"
                              rows="5"
                              style="resize: none"
                              placeholder="Comment"
                            ></textarea>
                          </div>
                        </form>
                      </div>
                      <div class="modal-footer">
                        <button
                          type="button"
                          class="btn text-white red-btn"
                          data-bs-dismiss="modal"
                        >
                          Close
                        </button>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- End of Rate Modal -->
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
