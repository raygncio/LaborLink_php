<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Welcome</title>

    <link rel="icon" type="favicon" href="icons/favicon.ico" />
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

    <link rel="stylesheet" href="app.css" />
  </head>

  <body>
    <nav
      id="landingNav"
      class="navbar navbar-light navbar-dark-lg navbar-expand-lg p-3 lp"
    >
      <div class="container-fluid">
        <a class="navbar-brand" href="#">
          <img src="icons/LOGO.png" alt="logo" width="200" />
        </a>
        <button
          class="navbar-toggler"
          type="button"
          data-bs-toggle="collapse"
          data-bs-target="#navExpand"
          aria-controls="navExpand"
          aria-expanded="false"
          aria-label="Toggle navigation"
        >
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navExpand">
          <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
            <li class="nav-item me-3 me-xl-5">
              <a class="nav-link lp" aria-current="page" href="#">Home</a>
            </li>
            <li class="nav-item me-3 me-xl-5">
              <a class="nav-link lp" href="#">About Us</a>
            </li>
            <li class="nav-item me-3 me-xl-5">
              <a class="nav-link lp" href="#">Contact Us</a>
            </li>
            <li class="nav-item me-3 me-xl-5">
              <a class="nav-link lp" href="login.html">Log-in</a>
            </li>
          </ul>
          <a
            href="register/choose-roles.php"
            class="btn btn-primary btn-sm blue-btn"
            >&nbspSign Up&nbsp</a
          >
        </div>
      </div>
    </nav>

    <section class="container-fluid p-5">
      <div class="row lp">
        <div class="col ms-0 ms-lg-4">
          <h1 class="header-lp">
            Committed to <span class="blue-span">value,</span>
          </h1>
          <h1 class="header-lp">
            Committed to <span class="blue-span">&nbspyou</span>
          </h1>
          <p class="lead-lp">&nbspWhere quality service matters.</p>
        </div>
      </div>
      <div class="row lp">
        <div class="col ms-0 ms-lg-5">
          <a
            id="getStarted"
            href="register/choose-roles.php"
            class="btn btn-primary btn-lg orange-btn"
            >&nbspGet Started&nbsp</a
          >
        </div>
      </div>
      <div class="row mt-5 align-items-center">
        <div class="col-12">
          <img
            id="main-img"
            class="img-fluid"
            src="icons/landing-page/HOME IMG 1.png"
            alt="home-img"
          />
        </div>
        <div class="col">
          <img
            id="tools-1"
            class="img-fluid"
            src="icons/landing-page/ICON1.png"
            alt="home-img"
          />
        </div>
        <div class="col">
          <img
            id="tools-2"
            class="img-fluid"
            src="icons/landing-page/ICON2.png"
            alt="home-img"
          />
        </div>
      </div>
    </section>

    <div id="white-circle" class="d-none d-xl-block">
      <div id="bc-1" class="blues"></div>
      <div id="bc-2" class="blues"></div>
      <div id="bc-3" class="blues"></div>
    </div>
    <div id="white-bg" class="d-xl-none"></div>

    <div class="background oranges"></div>

    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz"
      crossorigin="anonymous"
    ></script>
  </body>
</html>