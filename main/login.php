<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Login</title>

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
    <nav id="landingNav" class="navbar navbar-dark navbar-expand-lg p-3">
      <div class="container-fluid">
        <a class="navbar-brand" href="index.php">
          <img src="icons/LOGO.png" alt="logo" width="200" />
        </a>
      </div>
    </nav>

    <section id="loginForm" class="container-md pt-4 ps-5 login">
      <div class="row">
        <div class="col-8">
          <h1 id="loginHeader" class="display-1">Welcome Back!</h1>
        </div>
        <div class="col-7 text-center">
          <p>Connect with credible labor workers conveniently</p>
        </div>
      </div>
      <form action="#nowhere">
        <div class="row align-items-center justify-content-start pt-3">
          <div class="col-7">
            <label for="loginEmailInput" class="form-label"
              >Email address:</label
            >
            <input
              type="email"
              class="form-control"
              id="loginEmailInput"
              placeholder="name@example.com"
            />
          </div>
        </div>
        <div class="row align-items-center justify-content-start pt-3">
          <div class="col-7">
            <label for="loginPWInput" class="form-label">Password:</label>
            <input
              type="password"
              class="form-control"
              id="loginPWInput"
              placeholder=""
            />
          </div>
        </div>
        <div class="row pt-5">
          <div class="col-7">
            <div class="d-grid gap-2 col-4 mx-auto">
              <button class="btn btn-primary orange-btn" type="button">
                Login
              </button>
            </div>
          </div>
        </div>
      </form>

      <div class="row mt-md-5 align-items-center">
        <div class="col-12">
          <img
            id="login-main-img"
            class="img-fluid"
            src="icons/login/LOG-IN IMG 2 1.png"
            alt="home-img"
          />
        </div>
      </div>
    </section>

    <div class="login-graphics">
      <div class="background whites"></div>
      <div id="login-orange-1" class="oranges"></div>
      <div id="login-orange-2" class="oranges"></div>
    </div>

    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz"
      crossorigin="anonymous"
    ></script>
  </body>
</html>
