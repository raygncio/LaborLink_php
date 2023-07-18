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
          $(function () {
            $("#nav-placeholder").load("/main/client/nav.html");
          });
        </script>
        <!--end of Navigation bar-->
        <!--MAIN-->
        <div class="col p-4 orange-main">
          <header class="col-12 rounded-4 p-3 whites orange-font">
            <h2><span>June 4, 2023</span>&nbsp;&nbsp;<span>Sunday</span></h2>
            <h1 class="display-1 header text-normal">
              Good <span>morning</span>, <span>Nina!</span>
            </h1>
          </header>

          <nav class="col-12 mt-3">
            <ul class="nav nav-tabs nav-fill z-1 fs-3">
              <li class="nav-item">
                <a
                  class="nav-link active text-start"
                  aria-current="page"
                  href="/main/client/dashboard/find-laborer.html"
                  >Find Laborer</a
                >
              </li>
              <li class="nav-item">
                <a
                  class="nav-link text-start"
                  href="/main/client/dashboard/open-request.html"
                  >Open Request</a
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
                  <button class="btn btn-primary blue-btn" type="submit">
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
                  <div class="col-4">
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
                          <div class="col-7">
                            <h4 class="fs-2 header">Laborer Name</h4>
                            <p class="lead blue-font">Specialization</p>
                            <div class="laborer-rating">
                              <i class="fa-solid fa-star"></i>
                              <i class="fa-solid fa-star"></i>
                              <i class="fa-solid fa-star"></i>
                              <i class="fa-solid fa-star"></i>
                              <i class="fa-solid fa-star"></i>
                            </div>
                          </div>
                        </div>
                      </header>
                      <article
                        class="col-12 mt-4 font-normal text-black description overflow-auto"
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
                    </div>
                  </div>
                  <div class="col">
                    <form action="#" class="row align-items-center">
                      <div class="col-8 orange-font">
                        <div class="row mb-3">
                          <label for="requestTitle" class="col-1 col-form-label"
                            >Title:
                          </label>
                          <div class="col-5 me-5">
                            <input
                              type="text"
                              class="form-control"
                              id="requestTitle"
                              required
                            />
                          </div>
                          <label
                            for="requestCateg"
                            class="col-2 col-form-label text-end"
                            >Category:
                          </label>
                          <div class="col-3">
                            <input
                              type="text"
                              class="form-control"
                              id="requestCateg"
                              readonly
                            />
                          </div>
                        </div>
                        <div class="row mb-3">
                          <label
                            for="requestDesc"
                            class="col-2 col-form-label me-5"
                            >Description:
                          </label>
                          <div class="col-9">
                            <textarea
                              class="form-control"
                              id="requestDesc"
                              rows="5"
                              style="resize: none"
                              required
                            ></textarea>
                          </div>
                        </div>
                        <div class="row mb-3">
                          <label
                            for="requestStreet"
                            class="col-2 col-form-label"
                            >Address:
                          </label>
                          <div class="col-6">
                            <input
                              type="text"
                              class="form-control"
                              id="requestStreet"
                              required
                            />
                          </div>
                          <div class="col mt-2">
                            <div class="form-check">
                              <input
                                class="form-check-input"
                                type="checkbox"
                                value=""
                                id="flexCheckDefault"
                              />
                              <label
                                class="form-check-label"
                                for="flexCheckDefault"
                              >
                                Home address
                              </label>
                            </div>
                          </div>
                        </div>
                        <div class="row mb-3">
                          <label
                            for="requestAttachment"
                            class="col-2 col-form-label text-end me-3"
                            >Attachment:
                          </label>
                          <div class="col-5">
                            <input
                              type="file"
                              class="form-control"
                              id="requestAttachment"
                              disabled
                            />
                          </div>
                          <label
                            for="requestTime"
                            class="col-1 col-form-label ms-4"
                            >Time:
                          </label>
                          <div class="col-3">
                            <input
                              type="time"
                              class="form-control"
                              id="requestTime"
                              required
                            />
                          </div>
                        </div>
                      </div>
                      <div class="col-4">
                        <div class="row g-3">
                          <div class="col-auto orange-font">
                            <label
                              for="suggestServiceFee"
                              class="col-form-label mt-2"
                              >Suggest Service Fee</label
                            >
                          </div>
                          <div class="col-5">
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
                            class="col border border-3 rounded rounded-4 orange-border mx-auto orange-font"
                          >
                            <p class="fs-4 text-center">Breakdown:</p>
                            <div class="row font-normal">
                              <p class="col-5 text-end">Labor Fee</p>
                              <p class="col-6 text-center">Php 500</p>
                              <p class="col-5 text-end">Convenience Fee</p>
                              <p class="col-6 text-center">Php 50</p>
                              <p></p>
                              <hr />
                              <p class="fs-5 col-5 text-end header">Total:</p>
                              <p class="fs-5 col-6 text-center header">
                                Php 550
                              </p>
                            </div>
                          </div>
                          <div class="text-center">
                            <button
                              type="button"
                              class="btn btn-primary green-btn me-3"
                              data-bs-toggle="modal"
                              data-bs-target="#staticBackdropComplete"
                            >
                              Proceed
                            </button>
                            <a
                              href="/main/client/dashboard/find-laborer-search.html"
                              class="btn btn-primary red-btn"
                            >
                              Cancel
                            </a>
                          </div>
                        </div>
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
                            <div class="modal-header">
                              <h1
                                class="modal-title fs-5"
                                id="staticBackdropLabel"
                              >
                                Last step!
                              </h1>
                              <button
                                type="button"
                                class="btn-close"
                                data-bs-dismiss="modal"
                                aria-label="Close"
                              ></button>
                            </div>
                            <div class="modal-body text-center mb-5">
                              <p class="fs-1 blue-font text-center">
                                How do you want to pay?
                              </p>
                              <div class="d-grid gap-2">
                                <button
                                  id="directp-submit"
                                  type="submit"
                                  name="submit"
                                  class="btn btn-primary orange-btn mt-3"
                                  value="Direct Payment"
                                  disabled
                                >
                                  <div
                                    class="row justify-content-center align-items-center"
                                  >
                                    <div class="col-2">
                                      <img
                                        class="img-fluid"
                                        src="icons/payment/direct.png"
                                        alt=""
                                      />
                                    </div>
                                    <div class="col-6">
                                      <p>Direct Payment</p>
                                    </div>
                                  </div>
                                </button>
                                <button
                                  id="cashp-submit"
                                  type="submit"
                                  name="submit"
                                  class="btn btn-primary orange-btn mt-3"
                                  value="cash"
                                >
                                  <div
                                    class="row justify-content-center align-items-center"
                                  >
                                    <div class="col-2">
                                      <img
                                        class="img-fluid"
                                        src="icons/payment/cash.png"
                                        alt=""
                                      />
                                    </div>
                                    <div class="col-6">
                                      <p>Cash Payment</p>
                                    </div>
                                  </div>
                                </button>
                              </div>
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
