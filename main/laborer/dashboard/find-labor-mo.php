<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Laborer Dashboard</title>

    <!--default-->
    <link rel="icon" type="favicon" href="icons/favicon.ico" />
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

    <link rel="stylesheet" href="/main/app.css" />

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
              $("#nav-placeholder").load("/main/laborer/nav.html");
            });
        </script>
        <!--end of Navigation bar-->
        <!--MAIN-->
        <div class="col p-4 orange-main">
          <header class="col-12 rounded-4 p-3 whites orange-font">
            <h2><span>June 4, 2023</span>&nbsp;&nbsp;<span>Sunday</span></h2>
            <h1 class="display-1 header text-normal">
              Good <span>morning</span>, <span>Marcus!</span>
            </h1>
          </header>

          <nav class="col-12 mt-3">
            <ul class="nav nav-tabs nav-fill z-1 fs-3">
              <li class="nav-item">
                <a
                  class="nav-link active text-start"
                  aria-current="page"
                  href="/main/laborer/dashboard/find-labor.html"
                  >Find Labor</a
                >
              </li>
              <li class="nav-item">
                <a
                  class="nav-link text-start"
                  href="/main/laborer/dashboard/find-labor-dr.html"
                  >Direct Request</a
                >
              </li>
            </ul>
          </nav>

          <main
            class="col-12 rounded-4 rounded-top-0 whites white-font oranges main-envelope g-0 z-0"
          >
            <div class="row p-3 g-1">
              <header class="col-6 mt-4">
                <form class="d-flex" role="search">
                  <input
                    class="form-control me-2"
                    type="search"
                    placeholder="Search"
                    aria-label="Search"
                  />
                  <button
                    class="btn btn-primary blue-btn"
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

              <div class="col-12 rounded-4 border border-5 p-3 whites">
                <div class="row">
                  <div class="col-6">
                    <div class="row orange-font p-3 mb-2">
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
                          <div class="col-8">
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
                        </div>
                      </header>
                      <article
                        class="col-12 mt-4 font-normal text-black client-description overflow-auto"
                      >
                        <p>
                          Lorem ipsum dolor sit amet consectetur adipisicing
                          elit. Error vitae ut doloremque quis eos tempora
                          libero maiores sed, voluptas quidem natus perspiciatis
                          deserunt expedita aspernatur facere voluptatum quasi
                          obcaecati corrupti?
                        </p>
                        <p>
                          Lorem ipsum dolor sit amet consectetur adipisicing
                          elit. Error vitae ut doloremque quis eos tempora
                          libero maiores sed, voluptas quidem natus perspiciatis
                          deserunt expedita aspernatur facere voluptatum quasi
                          obcaecati corrupti?
                        </p>
                        <p>
                          Lorem ipsum dolor sit amet consectetur adipisicing
                          elit. Error vitae ut doloremque quis eos tempora
                          libero maiores sed, voluptas quidem natus perspiciatis
                          deserunt expedita aspernatur facere voluptatum quasi
                          obcaecati corrupti?
                        </p>
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
                  <div class="col-6">
                    <form action="#" class="row align-items-center g-3 mt-1">
                      <div class="col-auto blue-font">
                        <label for="suggestServiceFee" class="col-form-label"
                          >Suggest Service Fee</label
                        >
                      </div>
                      <div class="col-auto">
                        <div class="form-floating">
                          <input
                            type="text"
                            class="form-control"
                            id="suggestServiceFee"
                            placeholder="100.00"
                          />
                          <label
                            class="blue-font font-normal"
                            for="suggestServiceFee"
                            >Php</label
                          >
                        </div>
                      </div>
                      <div
                        class="col-10 border border-3 rounded rounded-4 orange-border mx-auto orange-font"
                      >
                        <p class="fs-4">Breakdown:</p>
                        <div class="row font-normal">
                          <p class="col-5 text-end">Labor Fee</p>
                          <p class="col-6 text-center">Php 500</p>
                          <p class="col-5 text-end">Convenience Fee</p>
                          <p class="col-6 text-center">Php 50</p>
                          <p></p>
                          <hr />
                          <p class="fs-5 col-5 text-end header">Total:</p>
                          <p class="fs-5 col-6 text-center header">Php 550</p>
                        </div>
                      </div>
                      <div class="col-11 text-end">
                        <button
                          type="button"
                          class="btn btn-primary green-btn me-3"
                          data-bs-toggle="modal"
                          data-bs-target="#staticBackdropComplete"
                        >
                          Proceed
                        </button>
                        <a
                          href="/main/laborer/dashboard/find-labor.html"
                          class="btn btn-primary red-btn"
                        >
                          Cancel
                        </a>
                      </div>

                      <!-- Modal -->
                      <div
                        class="modal fade"
                        id="staticBackdropComplete"
                        data-bs-backdrop="static"
                        data-bs-keyboard="false"
                        tabindex="-1"
                        aria-labelledby="staticBackdropLabel"
                        aria-hidden="true"
                      >
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-body text-center mb-2">
                              <img class="img-fluid" src="icons/on-going/done.png" alt="done">
                              <p class="fs-1 blue-font text-center">
                                Offer sent to client!
                              </p>
                              <p class="fs-5 blue-font text-center font-normal">
                                Please wait for approval
                              </p>
                              
                                <button type="button" class="btn btn-secondary green-btn" data-bs-dismiss="modal">Close</button>                            
                            </div>
                          </div>
                        </div>
                      </div>
                    </form>
                  </div>
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
