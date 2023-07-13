<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Get Started</title>

    <link rel="icon" type="favicon" href="../icons/favicon.ico" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;800&display=swap"
      rel="stylesheet"
    />

    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM"
      crossorigin="anonymous"
    />

    <link rel="stylesheet" href="../app.css" />
  </head>

  <body>
    <section
      id="chooseForm"
      class="container-xs position-absolute top-50 start-50 translate-middle choose"
    >
      <img
        src="../icons/LOGO.png"
        class="img-fluid mx-auto d-block pt-4"
        alt="..."
      />
      <div class="row text-center mt-4">
        <div class="col-12">
          <h1 class="display-1 header blue-font">Join us</h1>
        </div>
        <div class="col-12">
          <p class="font-normal">Connect with credible labor workers conveniently</p>
        </div>
      </div>

      <div class="row justify-content-center mt-5 ms-2">
        <div class="col-5">
            <div class="card text-center" style="width: 18rem;">
                <img src="../icons/user.jpg" class="card-img-top" alt="user">
                <div class="card-body">
                  <h3 class="card-title header blue-font">As a Customer</h3>
                  <a href="cr-userprof.php" class="btn btn-primary blue-btn">Register</a>
                </div>
            </div>
        </div>
        <div class="col-5">
            <div class="card text-center" style="width: 18rem;">
                <img src="../icons/worker.jpg" class="card-img-top" alt="worker">
                <div class="card-body">
                  <h3 class="card-title header orange-font">As a Laborer</h3>
                  <a href="lr-userprof.php" class="btn btn-primary orange-btn">Register</a>
                </div>
            </div>
        </div>
      </div>

      <div class="row align-items-center mt-5 mb-5">
        <div class="col text-center">
          <p class="d-inline">
            Already have an account?
            <a type="button" href="../login.html" class="btn btn-link btn-sm"
              >Login</a
            >
          </p>
        </div>
      </div>
    </section>

    <div class="signup-graphics">
      <div id="signup-orange" class="oranges"></div>
    </div>

    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz"
      crossorigin="anonymous"
    ></script>
  </body>
</html>
