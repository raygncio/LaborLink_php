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
              <a class="nav-link active" aria-current="page" href="#"
                >User Profile</a
              >
            </li>
            <li class="nav-item mt-2">
              <a class="nav-link disabled" href="#">Address</a>
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
            <h3 class="header">User Profile</h3>
            <hr />
          </div>

          <form
            action="lr-address.php"
            class="row g-3 needs-validation"
            method="POST"
            novalidate
          >
            <div class="col-md-6">
              <label for="firstName" class="form-label">First name</label>
              <input type="text" class="form-control" id="firstName" name="firstName" required />
              <div class="valid-feedback">Looks good!</div>
            </div>
            <div class="col-md-6">
              <label for="lastName" class="form-label">Last name</label>
              <input type="text" class="form-control" id="lastName" name="lastName" required />
              <div class="valid-feedback">Looks good!</div>
            </div>
            <div class="col-md-6">
              <label for="middleName" class="form-label">Middle name</label>
              <input
                type="text"
                class="form-control"
                id="middleName"
                name="middleName"
              />
              <div class="valid-feedback">This is optional :)</div>
            </div>
            <div class="col-md-6">
              <label for="suffixName" class="form-label">Suffix name</label>
              <input type="text" class="form-control" id="suffixName" name="suffixName" />
              <div class="valid-feedback">This is optional :)</div>
            </div>
            <div class="col-md-3">
              <label for="birthMonth" class="form-label">Date of Birth</label>
              <input
                type="date"
                class="form-control"
                id="birthMonth"
                name="birthMonth"
                required
              />
              <div class="invalid-feedback">Please select a valid date.</div>
            </div>
            <div class="col-md-3">
              <label for="sex" class="form-label">Biological Sex</label>
              <select class="form-select" id="sex" name="sex" required>
                <option selected disabled value="">Sex</option>
                <option value="Male">Male</option>
                <option value="Female">Female</option>
              </select>
              <div class="invalid-feedback">
                Please select a biological sex.
              </div>
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
