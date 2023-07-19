<?php
session_start();
$url = $_SESSION['server_url'];
$string = $_SESSION['first_name'];

//gets the first word of the first name
if(str_contains($string, " ")) {
  $first_name = substr($string, 0, strpos($string, " ")+1);
} else {
  $first_name = $string;
}

?>

<nav class="bg-light p-0 text-center">
  

  <a href="<?php echo $url."laborer/dashboard/find-labor.php"; ?>" class="navbar-brand">
  <img src="<?php echo $url."icons/logo-2.png"; ?>" alt="logo" class="img-fluid" />
    <span class="badge bg-secondary d-block mt-4">Laborer</span>
  </a>
  <ul class="nav nav-pills nav-fill flex-column mt-3">
    <li class="nav-item py-2 py-sm-0 text-center">
      <a
        href="<?php echo $url."laborer/dashboard/find-labor.php"; ?>"
        class="nav-link blue-font mt-4"
      >
        <i class="fs-1 fa-solid fa-house"></i>
        <span class="fs-5 d-none d-sm-block">Dashboard</span>
      </a>
    </li>
    <li class="nav-item py-2 py-sm-0 text-center">
      <a
        href="<?php echo $url."laborer/laborer-profile.php"; ?>"
        class="nav-link blue-font mt-4"
      >
        <i class="fs-1 fa-solid fa-user"></i>
        <span class="fs-5 d-none d-sm-block">Profile</span>
      </a>
    </li>
    <li class="nav-item py-2 py-sm-0 text-center">
      <a
        href="<?php echo $url."laborer/services/on-going-services.php"; ?>"
        class="nav-link blue-font mt-4"
      >
        <i class="fs-1 fa-solid fa-screwdriver-wrench"></i>
        <span class="fs-5 d-none d-sm-block">My Services</span>
      </a>
    </li>
    <li class="nav-item py-2 py-sm-0 text-center">
      <a
        href="<?php echo $url."laborer/laborer-inbox.php?error=comingsoon"; ?>"
        class="nav-link blue-font mt-4"
      >
        <i class="fs-1 fa-solid fa-message"></i>
        <span class="fs-5 d-none d-sm-block">Messages</span>
      </a>
    </li>
    <li class="nav-item py-2 py-sm-0 text-center">
      <a href="<?php echo $url."laborer/dashboard/find-labor.php?error=comingsoon"; ?>" class="nav-link blue-font mt-4">
        <i class="fs-1 fa-solid fa-bell"></i>
        <span class="fs-5 d-none d-sm-block">Notifications</span>
      </a>
    </li>
    <li class="nav-item py-2 py-sm-0 text-center">
      <a href="<?php echo $url."laborer/credit-balance.php"; ?>" class="nav-link blue-font mt-4">
        <i class="fs-1 fa-solid fa-credit-card"></i>
        <span class="fs-5 d-none d-sm-block">Credit Balance</span>
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
          <p id="currentUser" class="align-middle d-none d-sm-inline"><?php echo $first_name; ?></p>
        </button>
        <ul class="dropdown-menu">
          <li>
            <a href="<?php echo $url."laborer/dashboard/find-labor.php?error=comingsoon"; ?>" class="dropdown-item blue-font header" type="button"
              >Settings</a
            >
          </li>
          <li>
            <a
              href="<?php echo $url."laborer/laborer-profile.php"; ?>"
              class="dropdown-item blue-font header"
              type="button"
              >Profile</a
            >
          </li>
          <li>
            <a
              href="<?php echo $url."includes/logout-inc.php"; ?>"
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
