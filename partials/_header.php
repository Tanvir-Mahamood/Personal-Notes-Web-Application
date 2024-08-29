<?php 
session_start();

echo '<nav class="navbar navbar-expand-lg bg-body-tertiary" data-bs-theme="dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="index.php">iNotes</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="index.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" data-bs-toggle="modal" data-bs-target="#aboutModal">About</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" data-bs-toggle="modal" data-bs-target="#contactModal">Contact</a>
        </li>
      </ul>';

      if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
        echo '
        <p class="text-light my-0 mx-2">Welcome '.$_SESSION['user_name'].'</p>
        <a href="partials/_logout.php" class="btn btn-success" data-bs-target="#loginModal">Logout</a>';
      }
      else {
        echo '<div class="mx-2">
        <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#loginModal">Login</button>
        <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#signupModal">Signup</button>';
      }

      echo '</div>
    </div>
  </div>
</nav>';


include 'partials/_loginmodal.php';
include 'partials/_signupmodal.php';
include 'partials/_about.php';
include 'partials/_contact.php';

// for sign up
if(isset($_GET['signupResponse']) && $_GET['signupResponse'] == 1) {
  echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
          <strong>Signup Complete! </strong> You can login now.
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
}
else if(isset($_GET['signupResponse']) && $_GET['signupResponse'] != 1) {
  echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
          <strong>Error! </strong>'.$_GET['signupResponse'].'
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
}

// for login
if(isset($_GET['loginResponse']) && $_GET['loginResponse'] == 1) {
  echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
          <strong>You are logged in! </strong> Enjoy
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
}
else if(isset($_GET['loginResponse']) && $_GET['loginResponse'] != 1) {
  echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
          <strong>Error! </strong>'.$_GET['loginResponse'].'
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
}

?>