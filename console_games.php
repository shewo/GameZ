<?php
// console_games.php

// Include cart functions
require_once 'cart_functions.php';

// Initialize cart session
initCartSession();

// Check for cart messages
$cartMessage = getCartMessage();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Console Games - GamerZone</title>

  <!-- Bootstrap -->
  <link href="css/bootstrap-4.3.1.css" rel="stylesheet" />
  <!-- Font Awesome for icons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />

  <style>
    body {
      background-image: url('images/background1.jpg');
      background-size: cover;
      background-position: center;
      background-attachment: fixed;
      font-family: 'Segoe UI', sans-serif;
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
    .account-btn {
      background: transparent;
      border: 2px solid #17a2b8;
      border-radius: 25px;
      padding: 8px 16px;
      color: #17a2b8;
      font-weight: 500;
      text-transform: uppercase;
      letter-spacing: 1px;
      transition: all 0.3s ease;
    }
    .account-btn:hover {
      background-color: #17a2b8;
      border-color: #17a2b8;
      color: #fff;
      transform: translateY(-1px);
      box-shadow: 0 4px 8px rgba(23, 162, 184, 0.3);
    }
    .account-btn:focus {
      outline: none;
      box-shadow: 0 0 0 3px rgba(23, 162, 184, 0.25);
      background-color: #17a2b8;
      border-color: #17a2b8;
      color: #fff;
    }
    .account-btn-icon {
      margin-right: 6px;
      font-size: 1em;
    }
    .account-img {
      width: 50px;
      height: 50px;
      object-fit: cover;
    }
.account-img {
  width: 50px;
  height: 50px;
  object-fit: cover;
}
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

    h1 {
      color: #ffffff;
      text-align: center;
      margin: 50px 0 30px;
      text-shadow: 0 0 10px #00ffff;
    }
    .card {
      background-color: rgba(0, 0, 0, 0.6);
      color: white;
      border: none;
      min-height: 500px;
      box-shadow: 0 8px 20px rgba(0, 0, 0, 0.5);
      transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    .card:hover {
      transform: translateY(-10px);
      box-shadow: 0 0 15px purple;
    }
    .carousel-inner img {
      width: 100%;
      height: 60%;
      object-fit: cover;
    }
    .btn-primary {
      background-color: #00bfff;
      border: none;
    }
    .btn-primary:hover {
      background-color: #0080ff;
    }
    .search-bar {
      background-color: #222;
      color: white;
      border: 1px solid #444;
      padding: 8px 12px;
      border-radius: 8px;
    }
    .carousel-caption h5,
    .carousel-caption p {
      text-shadow: 2px 2px 5px black;
    }
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

    <!-- Cart Icon -->
    <a href="cart.php" class="ml-3 mr-3 position-relative">
      <span class="cart-icon">
        <i class="fas fa-shopping-cart" style="color: #00ffff; font-size: 24px;"></i>
        <?php 
        $cartCount = getCartItemCount();
        if($cartCount > 0): 
        ?>
        <span style="position: absolute; top: -10px; right: -10px; background-color: #ff3860; color: white; border-radius: 50%; width: 20px; height: 20px; font-size: 12px; display: flex; align-items: center; justify-content: center;">
          <?php echo $cartCount; ?>
        </span>
        <?php endif; ?>
      </span>
    </a>

    <!-- Modern Login Button -->
    <div class="dropdown ml-3">
      <button class="btn account-btn dropdown-toggle" type="button" id="authDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <i class="fas fa-user account-btn-icon"></i>Account
      </button>
      <div class="dropdown-menu dropdown-menu-right" aria-labelledby="authDropdown">
        <a class="dropdown-item" href="signup.php"><i class="fas fa-user-plus mr-2"></i>Sign Up</a>
        <a class="dropdown-item" href="login.php"><i class="fas fa-sign-in-alt mr-2"></i>Login</a>
      </div>
    </div>

  </div>
</nav>

<!-- Cart Message Section -->
<div class="container mt-3">
  <?php if ($cartMessage): ?>
    <div class="alert <?php echo strpos($cartMessage, 'Added') !== false ? 'alert-success' : 'alert-info'; ?> alert-dismissible fade show" role="alert">
      <?php echo $cartMessage; ?>
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
  <?php endif; ?>
</div>

<br>

  <!-- Carousel -->
  <div class="px-3 px-md-5">
    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
      <ol class="carousel-indicators">
        <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
      </ol>
      <div class="carousel-inner">
        <div class="carousel-item active">
          <img class="d-block w-100 rounded" src="images/spiderman21.jpeg" alt="Slide 1" height="600" />
          <div class="carousel-caption d-none d-md-block">
            <h5>Design Meets Power</h5>
            <p>Ignite your gameplay with firepower that melts the competition.</p>
          </div>
        </div>
        <div class="carousel-item">
          <img class="d-block w-100 rounded" src="images/plaugetale.jpeg" alt="Slide 2" height="600" />
          <div class="carousel-caption d-none d-md-block">
            <h5>RGB Revolution</h5>
            <p>Unleash performance with the ultimate gaming laptops.</p>
          </div>
        </div>
        <div class="carousel-item">
          <img class="d-block w-100 rounded" src="images/Senuas-Saga-Hellblade-II-Enhanced-Edition-scaled.png" alt="Slide 3" height="600" />
          <div class="carousel-caption d-none d-md-block">
            <h5>Power in Your Hands</h5>
            <p>Experience 360° action with stunning clarity.</p>
          </div>
        </div>
      </div>
      <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev"> 
        <span class="carousel-control-prev-icon" aria-hidden="true"></span> 
        <span class="sr-only">Previous</span> 
      </a>
      <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next"> 
        <span class="carousel-control-next-icon" aria-hidden="true"></span> 
        <span class="sr-only">Next</span> 
      </a>
    </div>
  </div>


<h1>Our Latest Console Games</h1>
<div class="row">
<?php
// Static products
$products = [
  ["name"=>"Assassin's Creed Shadows Video game","price"=>"17250","image"=>"images/ac_shados.png"],
  ["name"=>"Avatar: Frontiers of Pandora Video game","price"=>"15000","image"=>"images/KENA.PNG"],
  ["name"=>"Star Wars Outlaws","price"=>"10000","image"=>"images/starwars1.png"],
  ["name"=>"Far Cry 6 Video game","price"=>"7500","image"=>"images/farcry6.png"],
  ["name"=>"f1.25","price"=>"17250","image"=>"images/f1.png"],
  ["name"=>"Kena: Bridge of Spirits","price"=>"4700","image"=>"images/kena21.PNG"],
  ["name"=>"Need for Speed Unbound Video game","price"=>"7200","image"=>"images/nfs_unbound1.png"],
  ["name"=>"Alan Wake 2 Survival game","price"=>"10000","image"=>"images/alanwake2.png"],
  ["name"=>"Jurassic World Evolution 3","price"=>"5400","image"=>"images/jurassicworld2.png"],
  ["name"=>"Black Myth: Wukong Video game","price"=>"12300","image"=>"images/black_myth.png"],
  ["name"=>"Horizon Zero Dawn Video game","price"=>"4500","image"=>"images/horizen_zerodown.png"],
  ["name"=>"Call of Duty: Black Ops 6 Video game","price"=>"4500","image"=>"images/cod1.png"]
];

// Display static products
foreach ($products as $product) {
    echo '
    <div class="col-xl-3 mb-4">
      <div class="card col-md-4 col-xl-12">
        <img class="card-img-top" src="'.$product["image"].'" alt="'.$product["name"].'">
        <div class="card-body">
          <h5 class="card-title">'.$product["name"].'</h5>
          <h5 class="card-title">'.number_format($product["price"]).' LKR</h5>
          <form action="cart_action.php" method="post">
            <input type="hidden" name="product_id" value="console_game_'.md5($product["name"]).'">
            <input type="hidden" name="product_name" value="'.$product["name"].'">
            <input type="hidden" name="product_price" value="'.$product["price"].'">
            <input type="hidden" name="product_image" value="'.$product["image"].'">
            <input type="hidden" name="action" value="add">
            <button type="submit" class="btn btn-primary">
              <i class="fas fa-cart-plus"></i> Add to Cart
            </button>
          </form>
        </div>
      </div>
    </div>';
}

// Connect to DB and display admin-added console games
$conn = new mysqli("localhost","root","","gamezone");
if($conn->connect_error){
    die("Connection failed: ".$conn->connect_error);
}

$result = $conn->query("SELECT * FROM console_games ORDER BY id DESC"); // table for cadmin.php
if($result && $result->num_rows > 0){
    while($row = $result->fetch_assoc()){
        echo '
        <div class="col-xl-3 mb-4">
          <div class="card col-md-4 col-xl-12">
            <img class="card-img-top" src="uploads/'.$row["image"].'" alt="'.$row["name"].'">
            <div class="card-body">
              <h5 class="card-title">'.$row["name"].'</h5>
              <h5 class="card-title">'.number_format($row["price"]).' LKR</h5>
              <p class="card-text">'.$row["specs"].'</p>
              <form action="cart_action.php" method="post">
                <input type="hidden" name="product_id" value="db_console_game_'.$row["id"].'">
                <input type="hidden" name="product_name" value="'.$row["name"].'">
                <input type="hidden" name="product_price" value="'.$row["price"].'">
                <input type="hidden" name="product_image" value="uploads/'.$row["image"].'">
                <input type="hidden" name="action" value="add">
                <button type="submit" class="btn btn-primary">
                  <i class="fas fa-cart-plus"></i> Add to Cart
                </button>
              </form>
            </div>
          </div>
        </div>';
    }
}
$conn->close();
?>
</div>

<!-- Footer -->
<footer class="text-center text-lg-start text-white mt-5" style="background-color: #111;">
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
        <div>
          <a href="#" class="text-white me-3"><i class="fab fa-facebook"></i></a>
          <a href="#" class="text-white me-3"><i class="fab fa-instagram"></i></a>
          <a href="#" class="text-white me-3"><i class="fab fa-discord"></i></a>
        </div>
      </div>
    </div>
  </div>
  <div class="text-center p-3" style="background-color: rgba(255,255,255,0.05);">
    © 2025 GamerZone. All rights reserved.
  </div>
</footer>

<script src="js/popper.min.js"></script>
<script src="js/jquery-3.3.1.min.js"></script>
<script src="js/bootstrap-4.3.1.js"></script>
</body>
</html>
