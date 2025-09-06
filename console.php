<?php
// Define products as an array
$products = [
    [
        'name' => 'PlayStation 5 (PS5)',
        'price' => '189000',
        'image' => 'images/pngtree-top-quality-playstation-5-console-isolated-png-image_15514648-removebg-preview-removebg-preview.png',
        'description' => 'Play PS5 games with the most impressive visuals ever possible on a PlayStation console. Experience advanced ray tracing, super sharp image clarity on your 4K TV and higher frame rates in PS5 enhanced games. Fast 825GB SSD storage.'
    ],
    [
        'name' => 'PlayStation 5 Pro (PS5 Pro)',
        'price' => '269000',
        'image' => 'images/pngtree-top-quality-playstation-5-console-isolated-png-image_15514648-removebg-preview.png',
        'description' => 'Play PS5 games with the most impressive visuals ever possible on a PlayStation console. Experience advanced ray tracing, super sharp image clarity on your 4K TV and higher frame rates in PS5 Pro enhanced games. Enhanced GPU performance and 2TB storage.'
    ],
    [
        'name' => 'PlayStation 4 (PS4)',
        'price' => '89000',
        'image' => 'images/ps4.png',
        'description' => 'Store your games, apps, screenshots and videos with up to 1TB storage inside the PS4 console – slimmer and lighter than the original PS4 model and available in Jet WHITE and more colours. Great value gaming console.'
    ],
    [
        'name' => 'Xbox Series X',
        'price' => '199000',
        'image' => 'images/images__1_-removebg-preview.png',
        'description' => 'Experience next-gen gaming with the fastest, most powerful Xbox ever. Featuring 4K gaming, lightning-fast load times, 1TB SSD storage, and backward compatibility across thousands of titles. Jump into immersive worlds with stunning graphics and seamless performance.'
    ],
    [
        'name' => 'Xbox Series S',
        'price' => '129000',
        'image' => 'images/xbox serise s.png',
        'description' => 'Play next-gen games in a sleek, all-digital console. With lightning-fast load times, stunning 1440p resolution up to 120 FPS, and a 512GB SSD, the Xbox Series S is the best value in gaming. Compact, powerful, and Game Pass ready!'
    ],
    [
        'name' => 'Meta Quest 3',
        'price' => '159000',
        'image' => 'images/Meta-Quest-3-PNG-removebg-preview.png',
        'description' => 'Step into the future with the Meta Quest 3 — the most powerful standalone VR headset yet. Featuring stunning 4K+ visuals, full-color mixed reality, advanced hand tracking, and a lightning-fast Snapdragon XR2 Gen 2 chip. Play wirelessly or connect to your PC for high-end VR experiences.'
    ],
    [
        'name' => 'PICO 4 VR Headset',
        'price' => '119000',
        'image' => 'images/vr2.png',
        'description' => 'Discover next-gen VR with the ultra-lightweight PICO 4 headset. Enjoy crisp 4K+ visuals, wide 105° field of view, and smooth 90Hz refresh rate — all without needing a PC. Whether you\'re gaming, working out, or watching VR content, the PICO 4 delivers immersive experiences with comfort and style.'
    ],
    [
        'name' => 'Valve Index VR (Full Kit)',
        'price' => '349000',
        'image' => 'images/vr4.png',
        'description' => 'Unlock premium virtual reality with the Valve Index Full Kit. Designed for serious gamers, it offers ultra-smooth 144Hz refresh rate, crystal-clear visuals, and industry-leading finger-tracking controllers. With precise base station tracking and wide field of view. Perfect for VRChat, sim racing, and high-end PC gaming.'
    ]
];
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Gaming Consoles - GamingZone</title>
  <link href="css/bootstrap-4.3.1.css" rel="stylesheet" />
  <style>
    body {
      background-image: url('images/background1.jpg');
      background-size: cover;
      background-position: center;
      background-attachment: fixed;
      font-family: 'Segoe UI', sans-serif;
    }
    .search-bar {
      background-color: #222;     
      color: white;               
      border: 1px solid #444;     
      padding: 8px 12px;          
      border-radius: 8px;         
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
      box-shadow: 0 0 15px green;	  
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
    .carousel-caption h5,
    .carousel-caption p {
      text-shadow: 2px 2px 5px black;
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

  <!-- Carousel (same as before) -->
  <div class="px-3 px-md-5">
    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
      <ol class="carousel-indicators">
        <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
      </ol>
      <div class="carousel-inner">
        <div class="carousel-item active">
          <img class="d-block w-100 rounded" src="images/console1.jpg" alt="Slide 1" height="600" />
          <div class="carousel-caption d-none d-md-block">
            <h5>Design Meets Power</h5>
            <p>Ignite your gameplay with firepower that melts the competition.</p>
          </div>
        </div>
        <div class="carousel-item">
          <img class="d-block w-100 rounded" src="images/web1img17.jpg" alt="Slide 2" height="600" />
          <div class="carousel-caption d-none d-md-block">
            <h5>RGB Revolution</h5>
            <p>Unleash performance with the ultimate gaming laptops.</p>
          </div>
        </div>
        <div class="carousel-item">
          <img class="d-block w-100 rounded" src="images/ps5.jpg" alt="Slide 3" height="600" />
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

  <!-- Products -->
  <h1>Our Latest Gaming Consoles</h1>
  <div class="row">
    <?php foreach($products as $product): ?>
    <div class="col-xl-3 mb-4">
      <div class="card col-md-4 col-xl-12">
        <img class="card-img-top" src="<?= $product['image'] ?>" alt="<?= $product['name'] ?>">
        <div class="card-body">
          <h5 class="card-title"><?= $product['name'] ?></h5>
          <h5 class="card-title"><?= number_format($product['price'], 0) ?> LKR</h5>
          <p class="card-text"><?= $product['description'] ?></p>
          <button class="btn btn-primary" onclick="buyProduct('<?= $product['name'] ?>', '<?= $product['price'] ?>', '<?= $product['image'] ?>')">Buy Now</button>
        </div>
      </div>
    </div>
    <?php endforeach; ?>
  </div>

  <!-- Footer (same as before) -->
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
