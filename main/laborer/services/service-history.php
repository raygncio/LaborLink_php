<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>My Services</title>

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
              $("#nav-placeholder").load("/main/laborer/nav.html");
            });
        </script>
        <!--end of Navigation bar-->
        
        <!--MAIN-->
        <div class="col p-4 orange-main">
          <nav class="col-12 mt-3">
            <ul class="nav nav-tabs nav-fill z-1 fs-3">
              <li class="nav-item">
                <a
                  class="nav-link text-start"
                  href="/main/laborer/services/on-going-services.html"
                  >On-going Services</a
                >
              </li>
              <li class="nav-item">
                <a
                  class="nav-link text-start active"
                  aria-current="page"
                  href="/main/laborer/services/service-history.html"
                  >Service History</a
                >
              </li>
            </ul>
          </nav>

          <main
            class="col-12 rounded-4 rounded-top-0 oranges orange-font requests-envelope g-0 z-0"
          >
            <div class="row p-3 g-1">
              <header class="col-4 mt-4 text-white">
                <h2 class="display-4 header">Service History</h2>
                <p class="fs-4 font-normal text-normal">
                  Check your previous labors here
                </p>
              </header>

              <div
                class="col-12 ms-auto mt-2 rounded rounded-4 border border-4 whites table-content overflow-auto p-3"
              >
                <div
                  class="alert alert-info alert-dismissible fade show"
                  role="alert"
                >
                  <strong>No records found yet...</strong>
                  <hr />
                  <p class="font-normal">Make your first labor today!</p>
                  <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="alert"
                    aria-label="Close"
                  ></button>
                </div>

                <hr />

                <div class="row">
                  <div class="table-responsive">
                    <table class="table table-striped table-hover text-center">
                      <thead>
                        <tr>
                          <th scope="col">#</th>
                          <th scope="col">Request ID</th>
                          <th scope="col">Date</th>
                          <th scope="col">Description</th>
                          <th scope="col">Customer ID</th>
                          <th scope="col">Customer Name</th>
                          <th scope="col">Amount</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr class="font-normal">
                          <th scope="row">01</th>
                          <td>123456</td>
                          <td>12 JAN 2023</td>
                          <td>Lorem ipsum dolr sit amet</td>
                          <td>0001</td>
                          <td>Rob Shandell</td>
                          <td>Php 150.00</td>
                        </tr>
                        <tr class="font-normal">
                          <th scope="row">02</th>
                          <td>123456</td>
                          <td>12 JAN 2023</td>
                          <td>Lorem ipsum dolr sit amet</td>
                          <td>0001</td>
                          <td>Rob Shandell</td>
                          <td>Php 150.00</td>
                        </tr>
                        <tr class="font-normal">
                          <th scope="row">03</th>
                          <td>123456</td>
                          <td>12 JAN 2023</td>
                          <td>Lorem ipsum dolr sit amet</td>
                          <td>0001</td>
                          <td>Rob Shandell</td>
                          <td>Php 150.00</td>
                        </tr>
                        <tr class="font-normal">
                          <th scope="row">03</th>
                          <td>123456</td>
                          <td>12 JAN 2023</td>
                          <td>Lorem ipsum dolr sit amet</td>
                          <td>0001</td>
                          <td>Rob Shandell</td>
                          <td>Php 150.00</td>
                        </tr>
                        <tr class="font-normal">
                          <th scope="row">03</th>
                          <td>123456</td>
                          <td>12 JAN 2023</td>
                          <td>Lorem ipsum dolr sit amet</td>
                          <td>0001</td>
                          <td>Rob Shandell</td>
                          <td>Php 150.00</td>
                        </tr>
                        <tr class="font-normal">
                          <th scope="row">03</th>
                          <td>123456</td>
                          <td>12 JAN 2023</td>
                          <td>Lorem ipsum dolr sit amet</td>
                          <td>0001</td>
                          <td>Rob Shandell</td>
                          <td>Php 150.00</td>
                        </tr>
                        <tr class="font-normal">
                          <th scope="row">03</th>
                          <td>123456</td>
                          <td>12 JAN 2023</td>
                          <td>Lorem ipsum dolr sit amet</td>
                          <td>0001</td>
                          <td>Rob Shandell</td>
                          <td>Php 150.00</td>
                        </tr>
                        <tr class="font-normal">
                          <th scope="row">03</th>
                          <td>123456</td>
                          <td>12 JAN 2023</td>
                          <td>Lorem ipsum dolr sit amet</td>
                          <td>0001</td>
                          <td>Rob Shandell</td>
                          <td>Php 150.00</td>
                        </tr>
                        <tr class="font-normal">
                          <th scope="row">03</th>
                          <td>123456</td>
                          <td>12 JAN 2023</td>
                          <td>Lorem ipsum dolr sit amet</td>
                          <td>0001</td>
                          <td>Rob Shandell</td>
                          <td>Php 150.00</td>
                        </tr>
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

    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz"
      crossorigin="anonymous"
    ></script>
  </body>
</html>
