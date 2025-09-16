<?php
// laptop.php

// Include cart functions
require_once 'cart_functions.php';

// Initialize cart session
initCartSession();

// Check for cart messages
$cartMessage = getCartMessage();

// Database connection (same as admin_action.php)
$servername = "localhost";   // your DB server
$username = "root";          // your DB username
$password = "";              // your DB password
$dbname = "gamezone";  // replace with your DB name

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch all laptops from database
$sql = "SELECT * FROM laptops";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Laptop Showcase</title>
  <link href="css/bootstrap-4.3.1.css" rel="stylesheet" />
  <!-- Font Awesome for icons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
  <style>
    body { background-image: url('images/background1.jpg'); background-size: cover; background-position: center; background-attachment: fixed; font-family: 'Segoe UI', sans-serif; }
    .navbar { background-color: rgba(10, 10, 30, 0.9); }
    .navbar .navbar-brand, .navbar-nav .nav-link { color: #ffffff !important; }
    .navbar .nav-link:hover { color: #00ffcc !important; }
    .search-bar { background-color: #222; color: white; border: 1px solid #444; padding: 8px 12px; border-radius: 8px; }
    h1 { color: #ffffff; text-align: center; margin: 50px 0 30px; text-shadow: 0 0 10px #00ffff; }
    .card { background-color: rgba(0, 0, 0, 0.6); color: white; border: none; min-height: 550px; box-shadow: 0 8px 20px rgba(0, 0, 0, 0.5); transition: transform 0.3s ease, box-shadow 0.3s ease; }
    .card:hover { transform: translateY(-10px); box-shadow: 0 0 15px red; }
    .card-img-top { height: 250px; object-fit: cover; }
    .carousel-inner img { width: 100%; height: 60%; object-fit: cover; }
    .btn-primary { background-color: #00bfff; border: none; }
    .btn-primary:hover { background-color: #0080ff; }
    .carousel-caption h5, .carousel-caption p { text-shadow: 2px 2px 5px black; }
    .no-gutters { margin-left: 0; margin-right: 0; }
    .row.no-gutters > [class*='col-'] { padding-left: 0; padding-right: 0; }
  </style>
</head>
<body>
<div class="container-fluid px-0">
<nav class="navbar navbar-expand-lg navbar-dark">
  <a class="navbar-brand" href="web1.php">GamingZone</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav">
    <span class="navbar-toggler-icon"></span> 
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item"> <a class="nav-link" href="laptop.php">Laptops</a> </li>
      <li class="nav-item"> <a class="nav-link" href="accesories.php">Accessories</a> </li>
      <li class="nav-item"> <a class="nav-link" href="parts.php">Parts</a> </li>
      <li class="nav-item"> <a class="nav-link" href="console.php">Gaming Consoles</a> </li>
      <li class="nav-item"> <a class="nav-link" href="console_games.php">Console Games</a> </li>
    </ul>

    <!-- Search bar -->
    <form class="form-inline my-2 my-lg-0">
      <input class="search-bar mr-2" type="search" placeholder="Search" />
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


<br>
<style>
  body { 
    background-image: url('images/background1.jpg'); 
    background-size: cover; 
    background-position: center; 
    background-attachment: fixed; 
    font-family: 'Segoe UI', sans-serif; 
  }
  .navbar { background-color: rgba(10, 10, 30, 0.9); }
  .navbar .navbar-brand, .navbar-nav .nav-link { color: #ffffff !important; }
  .navbar .nav-link:hover { color: #00ffcc !important; }
  .search-bar { background-color: #222; color: white; border: 1px solid #444; padding: 8px 12px; border-radius: 8px; }
  h1 { color: #ffffff; text-align: center; margin: 50px 0 30px; text-shadow: 0 0 10px #00ffff; }
  .card { background-color: rgba(0, 0, 0, 0.6); color: white; border: none; min-height: 550px; box-shadow: 0 8px 20px rgba(0, 0, 0, 0.5); transition: transform 0.3s ease, box-shadow 0.3s ease; }
  .card:hover { transform: translateY(-10px); box-shadow: 0 0 15px red; }
  .card-img-top { height: 250px; object-fit: cover; }
  .carousel-inner img { width: 100%; height: 60%; object-fit: cover; }
  .btn-primary { background-color: #00bfff; border: none; }
  .btn-primary:hover { background-color: #0080ff; }
  .carousel-caption h5, .carousel-caption p { text-shadow: 2px 2px 5px black; }
  .no-gutters { margin-left: 0; margin-right: 0; }
  .row.no-gutters > [class*='col-'] { padding-left: 0; padding-right: 0; }

  /* Modern Login Button Styles - Search Button Theme */
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

  /* Remove dropdown arrow to match image style */
  .dropdown-toggle::after {
    display: none;
  }
</style>

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
        <img class="d-block w-100 rounded" src="images/laptopimg10.jpg" alt="Slide 1" height="600" />
        <div class="carousel-caption d-none d-md-block">
          <h5>Design Meets Power</h5>
          <p>Ignite your gameplay with firepower that melts the competition.</p>
        </div>
      </div>
      <div class="carousel-item">
        <img class="d-block w-100 rounded" src="images/laptopimg5.jpg" alt="Slide 2" height="600" />
        <div class="carousel-caption d-none d-md-block">
          <h5>RGB Revolution</h5>
          <p>Unleash performance with the ultimate gaming laptops.</p>
        </div>
      </div>
      <div class="carousel-item">
        <img class="d-block w-100 rounded" src="images/laptopimg6.jpg" alt="Slide 3" height="600" />
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

<!-- Title -->
<h1>Our New Arrivals Are Here</h1>

<?php if($cartMessage): ?>
<div class="alert alert-<?php echo $cartMessage['type']; ?> alert-dismissible fade show" role="alert">
  <?php echo $cartMessage['message']; ?>
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
<?php endif; ?>

<!-- Product Cards -->
<div class="row no-gutters px-3">
<?php
// 1️⃣ Static laptops (always shown first)
$staticProducts = [
    [
        'name'=>'MSI Katana 17 B14WGK Intel',
        'price'=>'685000',
        'image'=>'images/lapcardimgnew1.png',
        'description'=>'MSI Katana 17 HX B14WGK Intel I7 14650HX RTX5070 Intel Core i7-14650HX (30M Cache, up to 5.20 GHz) 16GB DDR5 RAM (8GB x 2) 1TB PCIe® 4.0 NVMe™ M.2 SSD 17.3" QHD (2560x1440), 240Hz NVIDIA® GeForce RTX™ 5070GB 8GB DDR7 115W 4-Zone'
    ],
    [
        'name'=>'MSI Venture 14 AI A1MG Ultra',
        'price'=>'685000',
        'image'=>'images/lapcard2.png',
        'description'=>'Intel® Core™ Ultra 7 155H,16Core up to 4.8GHz, 24MB 16GB DDR5 5600MHZ (8GB x 2) 512GB GEN4 NVME M.2 SSD 14" 2.8K (2880x1800), 120Hz, OLED Intel ARC Graphics Single Backlit Keyboard (White) with Copilot Key 1.7kg, 55.2WHrs Free MSI Sleeve'
    ],
    [
        'name'=>'MSI Katana 15 B14WGK Intel',
        'price'=>'570000',
        'image'=>'images/lapcard3.png',
        'description'=>'Intel®️ Core™️ i5-13420H (12M Cache, up to 4.60 GHz) 16GB DDR5 4800MHZ (8GB x2 ) 512GB M.2 NVME GEN4 SSD 15.6" 1080P 144Hz 45% NTSC IPS Level NVIDIA® GeForce RTX 4050 6GB GDDR6 Blue Backlit keyboard 1.98 kg , 53.5WHrs MSI Essential Backpack'
    ],
    [
        'name'=>'ASUS ROG ZEPHYRUS G16',
        'price'=>'519000',
        'image'=>'images/lapcard4.png',
        'description'=>'Intel® Core™ i7-13620H 10 Core (24M Cache, up to 4.90 GHz) 16GB DDR4 3200Mhz 512 GB PCIe® NVMe™ M.2 SSD 16" FHD+ (1920 x 1200) IPS-level sRGB:100% 165Hz NVIDIA® GeForce RTX™ 4070 120W 8GB GDDR6 Backlit Chiclet Keyboard 1-Zone'
    ],
    [
        'name'=>'ASUS TUF GAMING A15 F',
        'price'=>'685000',
        'image'=>'images/lapcardimg8.png',
        'description'=>'AMD Ryzen™ 7 7435HS (20MB Cache, up to 4.5 GHz, 8 cores, 16 Threads) 16GB DDR5 4800MHz 1TB M.2 NVMe PCIe® 4.0 SSD 15.6" 1080P 144Hz Anti-Glare IPS-level NVIDIA® GeForce RTX 4060 8GB GDDR6 1-Zone RGB Backlit Chiclet Keyboard 2.2kg, 90WHrs Free ASUS TUF BACKPACK'
    ],
    [
        'name'=>'ASUS ROG STRIX G16 2024',
        'price'=>'799000',
        'image'=>'images/lapcardimg9.png',
        'description'=>'Intel Core i9 14900HX (36MB Cache, up to 5.8 GHz, 24 cores, 32 Threads) 16GB DDR5 5600MHZ 1TB M.2 GEN4 NVME SSD 16-inch , QHD+ 16:10 (2560 x 1600, WQXGA) 240HZ G-Sync Supported NVIDIA® GeForce RTX 4070 8GB GDDR6 Backlit Chiclet Keyboard Per-Key RGB 2.5 kg, 90WHrs'
    ],
    [
        'name'=>'ASUS ROG STRIX G16',
        'price'=>'609000',
        'image'=>'images/lapcardimg9.png',
        'description'=>'Intel®️ Core™️ i9-14900HX (24 Cores 32 Threads 36M Cache, up to 5.80 GHz) 16GB DDR5 5600MHZ (8GB x 2) 1TB M.2 GEN4 NVME SSD 16-inch , QHD+ 16:10 (2560 x 1600, WQXGA) 240HZ G-Sync Supported NVIDIA®️ GeForce RTX 4060 8GB GDDR6 ASUS AURA Sync 4-Zone RGB Keyboard 2.5 kg, 90WHrs'
    ],
    [
        'name'=>'HP Victus FB21',
        'price'=>'309000',
        'image'=>'images/LAPCARDIMG13.PNG',
        'description'=>'AMD Ryzen 7 8845HS (up to 5.1 GHz 8 cores, 16 threads) 16 GB DDR5-5600Mhz 1 TB PCIe® NVMe™ M.2 SSD 15.6" FHD (1920 x 1080), 144 Hz, IPS NVIDIA® GeForce RTX 3050 6GB GDDR6 Backlit Keyboard 2.29KG, 70 WHr 2 Years Company warranty Genuine Windows 11 Home 64Bit Pre-installed'
    ],
    [
        'name'=>'HP VICTUS 15-FA2701WM',
        'price'=>'269000',
        'image'=>'images/lapcardimg12.png',
        'description'=>'Intel® Core™ i5-13420H (up to 4.7 GHz, 12MB L3 cache, 12 cores, 12 threads) 16GB DDR4 3200SDRAM (16GBx1) 512GB NVME M.2 SSD GEN4 15.6" FHD IPS LED Display 144HZ Thin Bezel NVIDIA® GeForce RTX 4050 6GB GDDR6 (TDP 75W) Backlit Keyboard 2.29KG, 70 WHr'
    ],
    [
        'name'=>'HP VICTUS 15 FA1427TX Intel',
        'price'=>'339000',
        'image'=>'images/LAPCARDIMG13.PNG',
        'description'=>'Intel® Core™ i7-13700H (up to 5.0 GHz , 24 MB L3 cache, 14 cores) 16 GB DDR4-3200 (2 x 8 GB) 1TB GEN4 NVME M.2 SSD 15.6" FHD IPS LED Display 144HZ Thin Bezel (250 nits) NVIDIA® GeForce RTX 3050 6GB GDDR6 Backlit Keyboard 2.29KG, 70 WHr 2 Years Company Warranty'
    ],
    [
        'name'=>'LENOVO IDEAPAD PRO 5',
        'price'=>'355000',
        'image'=>'images/lapcardimg14.png',
        'description'=>'Intel® Core™ Ultra 7 155H,16Core up to 4.8GHz, 24MB 16GB Soldered LPDDR5x-7467 512GB GEN4 NVME M.2 SSD 16" 2K (2048x1280) OLED 400nits Glossy, 100% DCI-P3, 120Hz Intel Arc Graphics Backlight Keyboard 1.9kg, 84WHrs Lenovo Back pack 2 Years Company Warranty'
    ],
    [
        'name'=>'Lenovo YOGA 7 2 in 1 14A',
        'price'=>'389000',
        'image'=>'images/lapcardimg15.png',
        'description'=>'AMD Ryzen AI 7 350 (8C / 16T, 5.0GHz, 8MB L2 / 16MB L3) 32GB Soldered LPDDR5x-7500 1TB SSD M.2 2242 PCIe® 4.0x4 NVMe 14" WUXGA (1920x1200) OLED 600nits 100% DCI-P3 Touch Integrated AMD Radeon™ 860M Graphics Backlit keyboard, Type-C (With Power Delivery)'
    ],
    [
        'name'=>'Acer Predator Helios Neo',
        'price'=>'465000',
        'image'=>'images/lapcardimg16.png',
        'description'=>'Intel Core i9 14900HX (36MB Cache, up to 5.8 GHz, 24 cores, 32 Threads) 16GB DDR5 5600MHZ 1TB M.2 GEN4 NVME SSD 16-inch IPS 165Hz (2560 x 1600) 100% SRGB NVIDIA GeForce RTX 4060 8GB GDDR6 TGP 140W 4-Zone RGB Keyboard 2.80 kg , 90WHrs Free Acer Backpack (Local Manufactured)'
    ],
    [
        'name'=>'Lenovo IdeaPad 1 15AMN',
        'price'=>'158000',
        'image'=>'images/lapcardimg17.png',
        'description'=>'AMD Ryzen™ 5 7520U (4C / 8T, 2.8 / 4.3GHz, 2MB L2 / 4MB L3) 16GB LPDDR5-5500 RAM 512GB M.2 GEN4 NVME SSD 15.6" FHD (1920x1080) IPS 250nits Anti-glare Integrated AMD Radeon 610M Graphics Non Back-Lit chiclet keyboard 1.58kg, 42WHrs Free Lenovo back pack'
    ],
    [
        'name'=>'ASUS VIVOBOOK S14 S34',
        'price'=>'330000',
        'image'=>'images/lapcardimg18.png',
        'description'=>'Snapdragon® X X1 26 100 (30MB Cache 2.97GHz,NPU up to 45TOPS ) 16GB LPDDR5X 1TB PCIe® 4.0 NVMe™ M.2 SSD 14.0-inch, FHD OLED 0.2ms 300nits, 95% Qualcomm® Adreno™ GPU Backlit Chiclet Keyboard 1.35 kg, 70WHrs Free ASUS Sleeve 2 Years Company Warranty back pack'
    ],
    [
        'name'=>'ASUS Zenbook DUO UX84',
        'price'=>'779000',
        'image'=>'images/lapcardimg20.png',
        'description'=>'Intel Core™ Ultra 9 285H (24MB Cache, up to 5.4 GHz, 16 cores, 16 Threads) 32GB LPDDR5X 1TB PCIe NVMe M.2 SSD 3K (2880 x 1800) OLED 120Hz 500nits HDR peak brightness Intel Arc Graphics Backlit Soft Keyboard 1.65KG, 95WHr 2 Years Company Warranty Genuine Windows 11 Home'
    ],
    
];

// Display static laptops first
foreach ($staticProducts as $index => $product) {
    echo '<div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-4">';
    echo '  <div class="card h-100">';
    echo '    <img class="card-img-top" src="'.$product['image'].'" alt="'.$product['name'].'">';
    echo '    <div class="card-body">';
    echo '      <h5 class="card-title">'.$product['name'].'</h5>';
    echo '      <h5 class="card-title">'.$product['price'].' LKR</h5>';
    echo '      <p class="card-text">'.$product['description'].'</p>';
    echo '      <form action="cart_action.php" method="post">';
    echo '        <input type="hidden" name="product_id" value="static_'.$index.'">';
    echo '        <input type="hidden" name="product_name" value="'.$product['name'].'">';
    echo '        <input type="hidden" name="product_price" value="'.$product['price'].'">';
    echo '        <input type="hidden" name="product_image" value="'.$product['image'].'">';
    echo '        <input type="hidden" name="quantity" value="1">';
    echo '        <button type="submit" name="add_to_cart" class="btn btn-primary btn-block"><i class="fas fa-shopping-cart mr-2"></i> Add to Cart</button>';
    echo '    </div>';
    echo '  </div>';
    echo '</div>';
}

// 2️⃣ Database laptops (admin-added)
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo '<div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-4">';
        echo '  <div class="card h-100">';
        echo '    <img class="card-img-top" src="uploads/'.$row['image'].'" alt="'.$row['name'].'">';
        echo '    <div class="card-body">';
        echo '      <h5 class="card-title">'.$row['name'].'</h5>';
        echo '      <h5 class="card-title">'.$row['price'].' LKR</h5>';
        echo '      <p class="card-text">'.$row['specs'].'</p>'; // from database
        
        // Create Add to Cart form
        echo '      <form action="cart_action.php" method="post">';
        echo '        <input type="hidden" name="product_id" value="'.$row['id'].'">';
        echo '        <input type="hidden" name="product_name" value="'.$row['name'].'">';
        echo '        <input type="hidden" name="product_price" value="'.$row['price'].'">';
        echo '        <input type="hidden" name="product_image" value="uploads/'.$row['image'].'">';
        echo '        <input type="hidden" name="quantity" value="1">';
        echo '        <button type="submit" name="add_to_cart" class="btn btn-primary btn-block"><i class="fas fa-shopping-cart mr-2"></i> Add to Cart</button>';
        echo '      </form>';
        echo '    </div>';
        echo '  </div>';
        echo '</div>';
    }
} else {
    echo '<p class="text-white">No laptops available.</p>';
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
