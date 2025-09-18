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

    .form-container {
      background-color: rgba(0, 0, 0, 0.75);
      padding: 30px;
      border-radius: 15px;
      box-shadow: 0 8px 20px rgba(0,0,0,0.5);
      margin: 60px auto;
      max-width: 500px;
    }

    .form-container h2 {
      text-align: center;
      margin-bottom: 25px;
      color: #00ffff;
      text-shadow: 0 0 10px #00ffff;
    }

    .btn-primary {
      background-color: #00bfff;
      border: none;
    }
    .btn-primary:hover {
      background-color: #0080ff;
    }

    footer {
      background-color: #111;
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
      <li class="nav-item"> <a class="nav-link" href="signup.php">SignUp</a> </li>
    </ul>
  </div>
</nav>

<!-- Signup Form Center -->
<div class="container">
  <div class="form-container">
    <h2>SignUp Page</h2>
    <form action="includes/signup.inc.php" method="post">
      <div class="form-group">
        <label>User Name</label>
        <input type="text" class="form-control" name="uid" placeholder="Username">
      </div>
      <div class="form-group">
        <label>Email Address</label>
        <input type="text" class="form-control" name="mail" placeholder="E-mail">
      </div>
      <div class="form-group">
        <label>Password</label>
        <input type="password" class="form-control" name="pwd" placeholder="Password">
      </div>
      <div class="form-group">
        <label>Re-Enter Password</label>
        <input type="password" class="form-control" name="pwd-repeat" placeholder="Repeat Password">
      </div>
      <button type="submit" class="btn btn-primary btn-block" name="signup-submit">Sign Up</button>
    </form>
    <center><br><big><a href="login.php" class="text-info">Login</a></big></center>
  </div>
</div>

<!-- Footer -->
<footer class="text-center text-lg-start text-white mt-5">
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

</div> <!-- END container-fluid -->

<!-- Scripts -->
<script src="js/popper.min.js"></script>
<script src="js/jquery-3.3.1.min.js"></script>
<script src="js/bootstrap-4.3.1.js"></script>

</body>
</html>
