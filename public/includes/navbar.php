<?php include_once('autoload.php');

?>
<!-- <a href="../views/register.php">regisater btn</a> -->
<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container">
    <a class="navbar-brand mb-0 h1" href="index.php">PHP Test</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
  <li class="nav-item">
    <a class="nav-link" aria-current="page" href="index.php">Home</a>
  </li>
  <?php
  $row = $fetchUserDetails->fetch_user($_SESSION['userid']);
  if (isset($row['username'])) {
    // User is logged in, display dropdown menu
    echo '<li class="nav-item dropdown">';
    echo '<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">';
    echo 'Hii, ' . $row['username'];
    echo '</a>';
    echo '<ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">';
    echo '<li><a class="dropdown-item" href="profile.php">Profile</a></li>';
    echo '<li><a class="dropdown-item" href="logout.php">Logout</a></li>';
    echo '</ul>';
    echo '</li>';
  } else {
    // User is not logged in, display login and register links
    echo '<li class="nav-item">';
    echo '<a class="nav-link" href="login.php">Login</a>';
    echo '</li>';
    echo '<li class="nav-item">';
    echo '<a class="nav-link" href= "register.php" >Register</a>';
    echo '</li>';
  }
  ?>
</ul>


    </div>
  </div>
</nav>

<!-- Include Bootstrap CSS and JavaScript files -->
