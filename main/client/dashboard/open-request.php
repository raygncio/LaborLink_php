<?php 

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
          <!--WELCOME-->
          <?php printWelcomeMessage($first_name, $_SESSION['user_role']); ?>

          <nav class="col-12 mt-3">
            <ul class="nav nav-tabs nav-fill z-1 fs-3">
              <li class="nav-item">
                <a
                  class="nav-link text-start"
                  href="find-laborer.php"
                  >Find Laborer</a
                >
              </li>
              <li class="nav-item">
                <a
                  class="nav-link active text-start"
                  aria-current="page"
                  href="open-request.php"
                  >Open Request</a
                >
              </li>
            </ul>
          </nav>

          <main
            class="col-12 rounded-4 rounded-top-0 oranges orange-font main-envelope g-0 z-0"
          >
            <div class="row p-3 g-1">
              <header class="col-7 mt-2">
                <h2 class="display-4 header text-normal white-font">
                  Create an Open Request
                </h2>
                <p class="fs-4 font-normal text-normal white-font">
                  Let Laborers know your request
                </p>
              </header>

              <div class="col-12 rounded-4 border border-5 p-3 whites">
                <form action="#" class="row">
                  <div class="col-6">
                    <div class="row mb-3">
                      <label
                        for="requestTitle"
                        class="col-2 col-form-label text-end"
                        >Title:
                      </label>
                      <div class="col-10">
                        <input
                          type="text"
                          class="form-control"
                          id="requestTitle"
                          required
                        />
                      </div>
                    </div>
                    <div class="row mb-3">
                      <label
                        for="requestCateg"
                        class="col-2 col-form-label text-end"
                        >Category:
                      </label>
                      <div class="col-10">
                        <select
                          id="requestCateg"
                          class="form-select"
                          aria-label="Default select example"
                          required
                        >
                          <option selected disabled>Select Category</option>
                          <option value="Plumbing">Plumbing</option>
                          <option value="Electrical">Electrical</option>
                          <option value="Roofing">Roofing</option>
                          <option value="Appliances">Appliances</option>
                          <option value="Welding">Welding</option>
                          <option value="Housekeeping">Housekeeping</option>
                          <option value="Painting">Painting</option>
                          <option value="PestControl">Pest Control</option>
                          <option value="Tutoring">Tutoring</option>
                        </select>
                      </div>
                    </div>
                    <div class="row mb-3">
                      <label
                        for="requestDesc"
                        class="col-2 col-form-label text-end"
                        >Description:
                      </label>
                      <div class="col-10">
                        <textarea
                          class="form-control"
                          id="requestDesc"
                          rows="7"
                          style="resize: none"
                          required
                        ></textarea>
                      </div>
                    </div>
                    <div class="row mb-3">
                      <label
                        for="requestAttachment"
                        class="col-2 col-form-label text-end"
                        >Attachment:
                      </label>
                      <div class="col-10">
                        <input
                          type="file"
                          class="form-control"
                          id="requestAttachment"
                          disabled
                        />
                      </div>
                    </div>
                  </div>
                  <div class="col-6">
                    <div class="row mb-3">
                      <label
                        for="requestStreet"
                        class="col-2 col-form-label text-end"
                        >Address:
                      </label>
                      <div class="col-4">
                        <input
                          type="text"
                          class="form-control"
                          id="requestStreet"
                          required
                        />
                      </div>
                      <div class="col mt-2">
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                          <label class="form-check-label" for="flexCheckDefault">
                            Home address
                          </label>
                        </div>
                      </div>
                    </div>
                    <div class="row mb-3">
                      <label
                        for="requestTime"
                        class="col-2 col-form-label text-end"
                        >Time:
                      </label>
                      <div class="col-4">
                        <input
                          type="time"
                          class="form-control"
                          id="requestTime"
                          required
                        />
                      </div>
                      <div class="col-2">
                        <label
                          for="suggestServiceFee"
                          class="col-form-label text-end"
                          >Suggest Service Fee:
                        </label>
                      </div>
                      <div class="col-4">
                        <div class="form-floating">
                          <input
                            type="text"
                            class="form-control"
                            id="suggestServiceFee"
                            placeholder="100.00"
                            required
                          />
                          <label
                            class="blue-font font-normal"
                            for="suggestServiceFee"
                            >Php</label
                          >
                        </div>
                      </div>
                    </div>
                    <div class="row mb-1">
                      <div
                        class="col-10 border border-3 rounded rounded-4 orange-border mx-auto p-2"
                      >
                        <div class="row font-normal">
                          <p class="col-2 fs-5 header">Breakdown:</p>
                          <p class="col-5 text-end">Labor Fee</p>
                          <p class="col-5 text-center">Php 500</p>
                          <p class="col-7 text-end">Convenience Fee</p>
                          <p class="col-5 text-center">Php 50</p>
                          <p></p>
                          <hr />
                          <p class="fs-5 col-7 text-end header">Total:</p>
                          <p class="fs-5 col-5 text-center header">Php 550</p>
                        </div>
                      </div>
                      <div class="col-12 mt-4 text-end">
                        <button
                          type="submit"
                          class="btn btn-primary green-btn me-3"
                        >
                          Post
                        </button>
                        <a
                          href="/main/client/dashboard/open-request.html"
                          class="btn btn-primary red-btn"
                        >
                          Cancel
                        </a>
                      </div>
                    </div>
                  </div>
                </form>
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
