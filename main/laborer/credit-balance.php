<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Credit Balance</title>

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
                      Credit Balance: <span class="orange-font">Php</span>
                      <spanc class="orange-font">500</spanc>
                    </h1>
                    <h5 class="header text-normal">
                      Laborer Name,
                      <span class="ms-1 blue-font font-normal"
                        >please settle your credit balance immediately to
                        continue using our services</span
                      >
                    </h5>
                  </div>
                  <div class="col-3 me-4">
                    <button
                      type="button"
                      class="btn btn-primary green-btn btn-lg mb-3"
                      data-bs-toggle="modal"
                      data-bs-target="#settleModal"
                    >
                      <h1 class="header">Settle Credit Balance</h1>
                    </button>
                  </div>
                </header>

                <hr />
                <section class="row mt-5">
                  <header>
                    <h2 class="header orange-font text-normal">
                      Your Past Transactions
                    </h2>
                  </header>

                  <!--Past Transactions-->
                  <article
                    class="row border border-4 rounded rounded-4 mx-auto overflow-auto"
                    style="height: 570px"
                  >
                    <div class="col-12 p-2">
                      <div class="table-responsive">
                        <table
                          class="table table-striped table-hover text-center"
                        >
                          <thead>
                            <tr>
                              <th scope="col">#</th>
                              <th scope="col">Payment ID</th>
                              <th scope="col">Reference No.</th>
                              <th scope="col">Amount</th>
                              <th scope="col">Date</th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr class="font-normal">
                              <th scope="row">01</th>
                              <td>101</td>
                              <td>1000-1000-1000</td>
                              <td>Php 500</td>
                              <td>12 JAN 2023</td>
                            </tr>
                            <tr class="font-normal">
                              <th scope="row">01</th>
                              <td>101</td>
                              <td>1000-1000-1000</td>
                              <td>Php 500</td>
                              <td>12 JAN 2023</td>
                            </tr>
                            <tr class="font-normal">
                              <th scope="row">01</th>
                              <td>101</td>
                              <td>1000-1000-1000</td>
                              <td>Php 500</td>
                              <td>12 JAN 2023</td>
                            </tr>
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </article>
                  <!--End of Past Transactions-->
                  <!-- Rate Modal -->
                  <div
                    class="modal fade"
                    id="settleModal"
                    tabindex="-1"
                    aria-labelledby="exampleModalLabel"
                    aria-hidden="true"
                  >
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h1 class="modal-title fs-5" id="exampleModalLabel">
                            Settle Your Credit Balance
                          </h1>
                          <button
                            type="button"
                            class="btn-close"
                            data-bs-dismiss="modal"
                            aria-label="Close"
                          ></button>
                        </div>
                        <form action="#">
                          <div class="modal-body">
                            <div class="row">
                              <div class="col-7 mx-auto mb-3">
                                <label for="amountToPay" class="form-label"
                                  >Amount to Pay:</label
                                >
                                <input
                                  type="text"
                                  class="form-control"
                                  id="amountToPay"
                                  value="PHP 500"
                                  disabled
                                />
                              </div>
                              <div class="col-7 mx-auto mb-3">
                                <label for="gcashRef" class="form-label"
                                  >GCash Reference No.:</label
                                >
                                <input
                                  type="text"
                                  class="form-control"
                                  id="gcashRef"
                                  value=""
                                />
                              </div>
                              <div class="col-7 mx-auto mb-3">
                                <label for="payProof" class="form-label"
                                  >Screenshot:</label
                                >
                                <input
                                  type="file"
                                  class="form-control"
                                  id="payProof"
                                  disabled
                                />
                              </div>
                            </div>
                          </div>
                          <div class="modal-footer">
                            <button
                              type="submit"
                              class="btn text-white green-btn"
                              data-bs-dismiss="modal"
                            >
                              Pay
                            </button>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>
                  <!-- End of Rate Modal -->
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
