<?php
// parts.php

$products = [
  [
    "name" => "ASUS ROG Strix Scope II",
    "price" => "52000",
    "image" => "images/keyboard1.png"
  ],
  [
    "name" => "Asus TUF Gaming K3 RGB GEN II",
    "price" => "25000",
    "image" => "images/KEYBOARD3.png"
  ],
  [
    "name" => "ASUS ROG Gladius II Core Gaming Mouse",
    "price" => "14000",
    "image" => "images/mouse1.png"
  ],
  [
    "name" => "ASUS TUF Gaming M4 Air Lightweight",
    "price" => "14500",
    "image" => "images/mouse2.png"
  ],
  [
    "name" => "ASUS ROG Delta II Wireless Gaming Headset",
    "price" => "75000",
    "image" => "images/HEADSET1.PNG"
  ],
  [
    "name" => "SteelSeries Arctis NOVA 5 Gaming Headset",
    "price" => "50000",
    "image" => "images/HEADSET2.PNG"
  ],
  [
    "name" => "Razer Huntsman V3 Pro Gaming Keyboard",
    "price" => "68500",
    "image" => "images/12345.png"
  ],

  [
    "name" => "Logitech G502 HERO High-Performance Mouse",
    "price" => "22000",
    "image" => "images/mouse1234 (2).png"
  ],

];
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Parts - GamerZone</title>

  <!-- Bootstrap -->
  <link href="css/bootstrap-4.3.1.css" rel="stylesheet" />

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
    <form class="form-inline">
      <input class="search-bar" type="search" placeholder="Search" />
      <button class="btn btn-outline-info my-2 my-sm-0" type="submit">Search</button>
    </form>
  </div>
</nav>

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
          <img class="d-block w-100 rounded" src="images/fwebp.jpg" alt="Slide 1" height="500" />
          <div class="carousel-caption d-none d-md-block">
            <h5>Design Meets Power</h5>
            <p>Ignite your gameplay with firepower that melts the competition.</p>
          </div>
        </div>
        <div class="carousel-item">
          <img class="d-block w-100 rounded" src="images/accessories10 (1).jpg" alt="Slide 2" height="500" />
          <div class="carousel-caption d-none d-md-block">
            <h5>RGB Revolution</h5>
            <p>Unleash performance with the ultimate gaming laptops.</p>
          </div>
        </div>
        <div class="carousel-item">
          <img class="d-block w-100 rounded" src="images/accessories10 (2).jpg" alt="Slide 3" height="500" />
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

  <h1>Gaming Accessories</h1>
  <div class="row">
    <?php foreach ($products as $product): ?>
      <div class="col-xl-3">
        <div class="card col-md-4 col-xl-12">
          <img class="card-img-top" src="<?= $product['image'] ?>" alt="<?= $product['name'] ?>">
          <div class="card-body">
            <h5 class="card-title"><?= $product['name'] ?></h5>
            <h5 class="card-title"><?= number_format($product['price']) ?> LKR</h5>
            <button class="btn btn-primary" onclick="buyProduct('<?= $product['name'] ?>', '<?= $product['price'] ?>', '<?= $product['image'] ?>')">Buy Now</button>
          </div>
        </div>
        <br>
      </div>
    <?php endforeach; ?>
  </div>
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
  </div>


<!-- Scripts -->
<script src="js/popper.min.js"></script>
<script src="js/jquery-3.3.1.min.js"></script>
<script src="js/bootstrap-4.3.1.js"></script>
<script>
function buyProduct(productName, price, imagePath) {
  const encodedName = encodeURIComponent(productName);
  const encodedPrice = encodeURIComponent(price);
  const encodedImage = encodeURIComponent(imagePath);
  window.location.href = `billing-page.php?product=${encodedName}&price=${encodedPrice}&image=${encodedImage}`;
}
</script>
</body>
</html>
