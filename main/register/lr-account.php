<?php
   // Initialize the session
  session_start();
        
  // Store the submitted data sent
  // via POST method, stored 
    
  // Temporarily in $_POST structure

  $_SESSION['specialization'] = $_POST['specialization'];

  $_SESSION['employment_type'] = $_POST['employmentType'];

  $_SESSION['employer'] = $_POST['employer'];

  $_SESSION['valid_ID'] = $_POST['validID'];

  //$_SESSION['valid_ID_File'] = $_POST['validIDFile'];

  $_SESSION['proof'] = $_POST['proof'];

  //$_SESSION['proof_file'] = $_POST['proofFile'];

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
              <a class="nav-link disabled" href="#">Address</a>
            </li>
            <li class="nav-item mt-2">
              <a class="nav-link disabled" href="#">Employment Info</a>
            </li>
            <li class="nav-item mt-2">
              <a class="nav-link active" aria-current="page" href="#"
                >Account Info</a
              >
            </li>
            <li class="nav-item mt-2">
              <a class="nav-link disabled" href="#">COMPLETION</a>
            </li>
          </ul>
        </div>
        <div class="col-7 border whites p-4 orange-font regForms">
          <div class="row">
            <h3 class="header">Account Information</h3>
            <hr />
          </div>

          <form
            action="lr-completion.php"
            class="row g-3 needs-validation"
            method="POST"
            novalidate
          >
            <div class="col-md-12">
              <label for="emailAdd" class="form-label">Email Address</label>
              <input type="email" class="form-control" id="emailAdd" name="emailAdd" required />
              <div class="invalid-feedback">
                Please enter a valid email address
              </div>
            </div>
            <div class="col-md-6">
              <label for="username" class="form-label">Username</label>
              <input type="text" class="form-control" id="username" name="userName" required />
              <div class="valid-feedback">Looks good!</div>
            </div>
            <div class="col-md-6">
              <label for="phoneNumber" class="form-label">Phone number</label>
              <input type="text" class="form-control" id="phoneNumber" name="phoneNumber" required />
              <div class="valid-feedback">Looks good!</div>
            </div>
            <div class="col-md-6">
              <label for="password" class="form-label">Password</label>
              <input
                type="password"
                class="form-control"
                id="password"
                name="password"
                required
              />
              <div id="passwordHelpBlock" class="form-text">
                Your password must be 8-20 characters long, contain letters and
                numbers, and must not contain spaces, special characters, or
                emoji.
              </div>
              <div class="valid-feedback">Looks good!</div>
            </div>
            <div class="col-md-6">
              <label for="passwordConfirm" class="form-label"
                >Confirm Password</label
              >
              <input
                type="password"
                class="form-control"
                id="password"
                name="passwordConfirm"
                required
              />
              <div class="invalid-feedback">Password doesn't match</div>
            </div>

            <div class="col-12">
              <div class="form-check">
                <input
                  class="form-check-input"
                  type="checkbox"
                  value=""
                  id="terms"
                  required
                />
                <label class="form-check-label" for="terms">
                  Agree to terms and conditions
                </label>
                <div class="invalid-feedback">
                  You must agree before submitting.
                </div>
              </div>
            </div>

            <div class="col-12 text-end">
              <button class="btn btn-primary orange-btn" name="submit" type="submit">
                Submit
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

    <!--
    <script type="text/javascript">
      function validate_password() {
    
        var pass = document.getElementById('password').value;
        var confirm_pass = document.getElementById('passwordConfirm').value;
        if (pass != confirm_pass) {
          alert("Passwords don't match!");
          event.preventDefault(); 
          returnToPreviousPage();
          return false;
        }
        return true;
                
      }
    </script>
    -->


    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz"
      crossorigin="anonymous"
    ></script>
  </body>
</html>
