<!--NAV-->

<nav class="bg-light p-0 text-center">
    <a href="laborer-approval.php" class="navbar-brand">
      <img src="../icons/logo-2.png" alt="logo" class="img-fluid" />
      <span class="badge bg-secondary d-block mt-4">ADMIN</span>
    </a>
    <ul class="nav nav-pills nav-fill flex-column mt-5 mb-5 d-flex gap-4">
      <li class="nav-item py-2 py-sm-0 text-center">
        <a
          href="user-management.php"
          class="nav-link blue-font mt-4"
        >
          <i class="fs-1 fa-solid fa-users"></i>
          <span class="fs-5 d-none d-sm-block">User</span>
          <span class="fs-5 d-none d-sm-block">Management</span>
        </a>
      </li>
      <li class="nav-item py-2 py-sm-0 text-center">
        <a
          href="laborer-approval.php"
          class="nav-link blue-font mt-4"
        >
          <i class="fs-1 fa-solid fa-person-circle-check"></i>
          <span class="fs-5 d-none d-sm-block">Laborer</span>
          <span class="fs-5 d-none d-sm-block">Approval</span>
        </a>
      </li>
      <li class="nav-item py-2 py-sm-0 text-center">
        <a
          href="#"
          class="nav-link blue-font mt-4"
        >
          <i class="fs-1 fa-solid fa-chart-simple"></i>
          <span class="fs-5 d-none d-sm-block">Reports</span>
        </a>
      </li>

      <li class="nav-item text-center mt-5">
        <div class="dropdown">
          <button
            class="btn btn-primary btn-sm orange-btn dropdown-toggle"
            type="button"
            data-bs-toggle="dropdown"
            aria-expanded="false"
          >
            <i class="fs-5 fa-solid fa-user"></i>
            <p id="currentUser" class="align-middle d-none d-sm-inline">Nina</p>
          </button>
          <ul class="dropdown-menu">
            <li>
              <a href="#" class="dropdown-item blue-font header" type="button"
                >Settings</a
              >
            </li>
            <li>
              <a
                href="../index.php"
                class="dropdown-item blue-font header"
                type="button"
              >
                <i class="fs-5 fa-solid fa-right-from-bracket me-3"></i>
                <span class="fs-5 d-none d-sm-inline">Logout</span>
              </a>
            </li>
          </ul>
        </div>
      </li>
    </ul>
  </nav>
  