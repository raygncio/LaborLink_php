<?php 

  // Initialize the session
  session_start();
        
  // Store the submitted data sent
  // via POST method, stored 
    
  // Temporarily in $_POST structure

  $_SESSION['first_name'] = $_POST['firstName'];

  $_SESSION['last_name'] = $_POST['lastName'];

  $_SESSION['middle_name'] = $_POST['middleName'];

  $_SESSION['suffix_name'] = $_POST['suffixName'];

  $_SESSION['dob'] = $_POST['birthMonth'];

  $_SESSION['sex'] = $_POST['sex'];

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Worker Registration</title>

    <!--default-->
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
    <nav id="landingNav" class="navbar bg-light p-3">
      <div class="container-fluid">
        <a class="navbar-brand" href="#">
          <img src="../icons/LOGO.png" alt="logo" width="200" />
        </a>
      </div>
    </nav>

    <section class="container-fluid mt-5 reg">
      <div class="row white-font ms-0 ms-lg-5">
        <div class="col-6">
          <h1 class="display-1 header">Registration Form</h1>
        </div>
        <div class="col-12 font-normal">
          <p>Create a worker account with LaborLink</p>
        </div>
      </div>
      <div class="row mt-2 justify-content-center">
        <div class="col-2 pe-5">
          <ul class="nav nav-underline flex-column">
            <li class="nav-item">
              <a class="nav-link disabled" href="#">User Profile</a>
            </li>
            <li class="nav-item mt-2">
              <a class="nav-link active" aria-current="page" href="#"
                >Address</a
              >
            </li>
            <li class="nav-item mt-2">
              <a class="nav-link disabled" href="#">Employment Info</a>
            </li>
            <li class="nav-item mt-2">
              <a class="nav-link disabled" href="#">Account Info</a>
            </li>
            <li class="nav-item mt-2">
              <a class="nav-link disabled" href="#">COMPLETION</a>
            </li>
          </ul>
        </div>
        <div class="col-7 border whites p-4 orange-font regForms">
          <div class="row">
            <h3 class="header">Residential Address</h3>
            <hr />
          </div>

          <form
            action="lr-employment.php"
            class="row g-3 needs-validation"
            method="POST"
            novalidate
          >
            <div class="col-md-12">
              <label for="streetAdd" class="form-label">Street Address</label>
              <input type="text" class="form-control" id="streetAdd" name="streetAdd" required />
              <div class="valid-feedback">Looks good!</div>
            </div>
            <div class="col-md-6">
              <label for="state" class="form-label">State/Province</label>
              <input type="text" class="form-control" id="state" name="state" required />
              <div class="valid-feedback">Looks good!</div>
            </div>
            <div class="col-md-6">
              <label for="city" class="form-label">City</label>
              <input type="text" class="form-control" id="city" name="city" required />
              <div class="valid-feedback">Looks good!</div>
            </div>
            <div class="col-md-3">
              <label for="zip" class="form-label">Zip COde</label>
              <input type="text" class="form-control" id="zip" name="zip" required />
              <div class="valid-feedback">Looks good!</div>
            </div>
            <div class="col-md-3">
              <label for="country" class="form-label">Country</label>
              <input
                type="text"
                class="form-control"
                id="country"
                name="co
                value="Philippines"
                required
              />
              <div class="valid-feedback">Yeah</div>
            </div>

            <div class="col-12 text-end">
              <button class="btn btn-primary orange-btn" type="submit">
                Next
              </button>
            </div>
          </form>
        </div>
      </div>
    </section>

    <script>
      (() => {
        "use strict";

        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        const forms = document.querySelectorAll(".needs-validation");

        // Loop over them and prevent submission
        Array.from(forms).forEach((form) => {
          form.addEventListener(
            "submit",
            (event) => {
              if (!form.checkValidity()) {
                event.preventDefault();
                event.stopPropagation();
              }

              form.classList.add("was-validated");
            },
            false
          );
        });
      })();
    </script>

    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz"
      crossorigin="anonymous"
    ></script>
  </body>
</html>
