<?php
// login.php
session_start();

// Check login submission
if(isset($_POST['login-submit'])){
    $username = $_POST['mail'];
    $password = $_POST['pwd'];

    // Hardcoded credentials
    $adminUser = "sashik";
    $adminPass = "sashik2005";

    if($username === $adminUser && $password === $adminPass){
        // Correct admin credentials
        $_SESSION['admin_logged_in'] = true;
        header("Location: admin.php");
        exit();
    } else {
        // Wrong credentials, redirect to homepage
        $_SESSION['admin_logged_in'] = false;
        header("Location: web1.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Login - GamerZone</title>

  <link href="css/bootstrap-4.3.1.css" rel="stylesheet" />

  <style>
    body {
      background-image: url('images/background1.jpg');
      background-size: cover;
      background-position: center;
      background-attachment: fixed;
      font-family: 'Segoe UI', sans-serif;
      color: white;
 .navbar {
      background-color: rgba(10, 10, 30, 0.9);
    }

    .navbar .navbar-brand,
    .navbar-nav .nav-link {
      color: #ffffff !important;
    }

    .navbar .nav-link:hover {
      color: #00ffcc !important;
    }

    h1 {
      color: #ffffff;
      text-align: center;
      margin: 50px 0 30px;
      text-shadow: 0 0 10px #00ffff;
    }

    .search-bar {
      background-color: #222;
      color: white;
      border: 1px solid #444;
      padding: 8px 12px;
      border-radius: 8px;
    }
   .account-btn {
  border: none;
  background: none;        /* remove background color */
  padding: 0;              /* remove padding */
  width: auto;             /* adjust to image width */
  height: auto;            /* adjust to image height */
}

.account-img {
  width: 50px;             /* image width */
  height: 50px;            /* image height */
  object-fit: cover;
}
/* Dropdown menu dark theme */
.dropdown-menu {
  background-color: rgba(10, 10, 30, 0.95); /* dark background */
  border: none;
  min-width: 150px;
}

/* Dropdown links */
.dropdown-item {
  color: #00ffff;       /* neon cyan text */
  background-color: transparent;
  transition: background 0.3s, color 0.3s;
}

/* Hover effect for dropdown links */
.dropdown-item:hover {
  background-color: #00bfff;  /* bright blue background on hover */
  color: #ffffff;             /* white text on hover */
}

/* Optional: remove arrow on toggle to match image style */
.dropdown-toggle::after {
  display: none;
}



    .form-container {
      background-color: rgba(0, 0, 0, 0.75);
      padding: 40px;
      border-radius: 15px;
      box-shadow: 0 8px 25px rgba(0,0,0,0.6);
      margin: 80px auto;
      max-width: 400px;
      text-align: center;
    }
    .form-container h2 { color: #00ffff; margin-bottom: 30px; text-shadow: 0 0 10px #00ffff; }
    .form-control { background-color: rgba(30,30,30,0.9); border: 1px solid #444; color: white; margin-bottom: 20px; }
    .form-control::placeholder { color: #bbb; }
    .btn-primary { background-color: #00bfff; border: none; width: 100%; margin-top: 10px; }
    .btn-primary:hover { background-color: #0080ff; }
    a.text-info { color: #00ffff; display: block; margin-top: 15px; }
    a.text-info:hover { color: #0080ff; text-decoration: none; }

    footer { background-color: #111; color: white; }
  </style>
</head>

<body>
<div class="container-fluid px-0">
<!-- Updated Navbar Section in parts.php -->
<nav class="navbar navbar-expand-lg navbar-dark">
  <a class="navbar-brand" href="web1.php">GamingZone</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item"> <a class="nav-link" href="laptop.php">Laptops</a> </li>
      <li class="nav-item"> <a class="nav-link active" href="parts.php">Accessories</a> </li>
      <li class="nav-item"> <a class="nav-link" href="accesories.php">Parts</a> </li>
      <li class="nav-item"> <a class="nav-link" href="console.php">Gaming Consoles</a> </li>
      <li class="nav-item"> <a class="nav-link" href="console_games.php">Console Games</a> </li>
    </ul>
    <form class="form-inline">
      <input class="search-bar" type="search" placeholder="Search" />
      <button class="btn btn-outline-info my-2 my-sm-0" type="submit">Search</button>
    </form>

    <!-- Dropdown Button (copied from web1.php) -->
    <div class="dropdown ml-3">
      <button class="btn account-btn dropdown-toggle" type="button" id="authDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <img src="images/login.png" alt="User" class="account-img">
      </button>
      <div class="dropdown-menu dropdown-menu-right" aria-labelledby="authDropdown">
        <a class="dropdown-item" href="signup.php">Sign Up</a>
        <a class="dropdown-item" href="login.php">Login</a>
      </div>
    </div>

  </div>
</nav>

  <!-- Login Form -->
  <div class="container">
    <div class="form-container">
      <h2>Login</h2>
      <form action="" method="post">
        <input type="text" class="form-control" name="mail" placeholder="Username" required>
        <input type="password" class="form-control" name="pwd" placeholder="Password" required>
        <button type="submit" class="btn btn-primary" name="login-submit">Login</button>
      </form>
      <a href="forgot_password.php" class="text-info">Forgot Password?</a>
    </div>
  </div>

  <!-- Footer -->
  <footer class="text-center text-lg-start mt-5">
    <div class="container p-4">
      <div class="row">
        <div class="col-md-4 mb-4">
          <h6 class="text-uppercase fw-bold">GamerZone</h6>
          <p>Powering your play with the latest in gaming laptops, accessories, and VR tech.</p>
        </div>
        <div class="col-md-4 mb-4">
          <h6 class="text-uppercase fw-bold">Quick Links</h6>
          <ul class="list-unstyled">
            <li><a href="web1.php" class="text-white">Home</a></li>
            <li><a href="contact.php" class="text-white">Contact Us</a></li>
            <li><a href="contact.php" class="text-white">Feedback</a></li>
          </ul>
        </div>
        <div class="col-md-4 mb-4">
          <h6 class="text-uppercase fw-bold">Contact</h6>
          <p>Email: support@gamerzone.com</p>
          <p>Phone: +94 71 123 4567</p>
        </div>
      </div>
    </div>
    <div class="text-center p-3" style="background-color: rgba(255,255,255,0.05);">
      © 2025 GamerZone. All rights reserved.
    </div>
  </footer>
</div>

<script src="js/popper.min.js"></script>
<script src="js/jquery-3.3.1.min.js"></script>
<script src="js/bootstrap-4.3.1.js"></script>

</body>
</html>
