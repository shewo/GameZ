<?php
// signup.php
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>SignUp - GamerZone</title>

  <!-- Bootstrap -->
  <link href="css/bootstrap-4.3.1.css" rel="stylesheet" />

  <style>
    body {
      background-image: url('images/background1.jpg');
      background-size: cover;
      background-position: center;
      background-attachment: fixed;
      font-family: 'Segoe UI', sans-serif;
      color: white;
    }

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

    /* Dropdown dark theme */
    .dropdown-menu {
      background-color: rgba(10, 10, 30, 0.95);
      border: none;
      min-width: 150px;
    }
    .dropdown-item {
      color: #00ffff;
      background-color: transparent;
      transition: background 0.3s, color 0.3s;
    }
    .dropdown-item:hover {
      background-color: #00bfff;
      color: #ffffff;
    }
    .dropdown-toggle::after {
      display: none;
    }

    .account-btn {
      border: none;
      background: none;
      padding: 0;
    }
    .account-img {
      width: 50px;
      height: 50px;
      object-fit: cover;
    }

    /* Form card */
    .form-container {
      background-color: rgba(0, 0, 0, 0.75);
      padding: 40px;
      border-radius: 15px;
      box-shadow: 0 8px 25px rgba(0,0,0,0.6);
      margin: 80px auto;
      max-width: 400px;
      text-align: center;
    }

    .form-container h2 {
      color: #00ffff;
      text-shadow: 0 0 10px #00ffff;
      margin-bottom: 30px;
    }

    .form-control {
      background-color: rgba(30,30,30,0.9);
      border: 1px solid #444;
      color: white;
      margin-bottom: 20px;
    }
    .form-control::placeholder {
      color: #bbb;
    }

    .btn-primary {
      background-color: #00bfff;
      border: none;
      width: 100%;
      margin-top: 10px;
    }
    .btn-primary:hover {
      background-color: #0080ff;
    }

    a.text-info {
      color: #00ffff;
      display: block;
      margin-top: 15px;
    }
    a.text-info:hover {
      color: #0080ff;
      text-decoration: none;
    }

    footer {
      background-color: #111;
      color: white;
    }
  </style>
</head>

<body>
<div class="container-fluid px-0">
  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg navbar-dark">
    <a class="navbar-brand" href="web1.php">GamingZone</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav">
      <span class="navbar-toggler-icon"></span> 
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item"> <a class="nav-link" href="laptop.php">Laptops</a> </li>
        <li class="nav-item"> <a class="nav-link" href="parts.php">Accessories</a> </li>
        <li class="nav-item"> <a class="nav-link" href="accesories.php">Parts</a> </li>
        <li class="nav-item"> <a class="nav-link" href="console.php">Gaming Consoles</a> </li>
        <li class="nav-item"> <a class="nav-link" href="console_games.php">Console Games</a> </li>
      </ul>
      <!-- Dropdown -->
      <div class="dropdown ml-3">
        <button class="btn account-btn dropdown-toggle" type="button" id="authDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <img src="images/login.png" alt="User" class="account-img">
        </button>
        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="authDropdown">
          <a class="dropdown-item" href="signup.php">Sign Up</a>
          <a class="dropdown-item" href="index.php">Login</a>
        </div>
      </div>
    </div>
  </nav>

  <!-- SignUp Form -->
  <div class="container">
    <div class="form-container">
      <h2>Sign Up</h2>
      <form action="includes/signup.inc.php" method="post">
        <input type="text" class="form-control" name="mail" placeholder="Email Address" required>
        <input type="password" class="form-control" name="pwd" placeholder="Password" required>
        <button type="submit" class="btn btn-primary" name="signup-submit">Sign Up</button>
      </form>
      <a href="index.php" class="text-info">Login</a>
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

<!-- Scripts -->
<script src="js/popper.min.js"></script>
<script src="js/jquery-3.3.1.min.js"></script>
<script src="js/bootstrap-4.3.1.js"></script>

</body>
</html>
