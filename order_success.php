<?php
// Include the cart functions
require_once 'cart_functions.php';

// Initialize cart session
initCartSession();

// Get order ID from URL
$orderId = isset($_GET['order_id']) ? htmlspecialchars($_GET['order_id']) : '';

if (empty($orderId)) {
    header("Location: web1.php");
    exit();
}

// Get cart message if any
$cartMessage = getCartMessage();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Order Success - GamingZone</title>

  <!-- Bootstrap -->
  <link href="css/bootstrap-4.3.1.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

  <style>
    body {
      background-image: url('images/background1.jpg');
      background-size: cover;
      background-position: center;
      background-attachment: fixed;
      font-family: 'Segoe UI', sans-serif;
      color: white;
    }
    .navbar { background-color: rgba(10, 10, 30, 0.9); }
    .navbar .navbar-brand, .navbar-nav .nav-link { color: #ffffff !important; }
    .navbar .nav-link:hover { color: #00ffcc !important; }
    .success-container {
      background-color: rgba(0,0,0,0.8);
      border-radius: 15px;
      padding: 50px;
      margin: 100px auto;
      text-align: center;
      box-shadow: 0 10px 30px rgba(0,255,204,0.3);
      max-width: 600px;
    }
    .success-icon {
      font-size: 4em;
      color: #28a745;
      margin-bottom: 20px;
    }
    .order-id {
      background-color: rgba(0,255,204,0.1);
      border: 2px solid #00ffcc;
      border-radius: 10px;
      padding: 15px;
      margin: 20px 0;
      font-family: monospace;
      font-size: 1.2em;
    }
    .btn-primary {
      background: linear-gradient(45deg, #00ffcc, #0099cc);
      border: none;
      padding: 12px 30px;
      font-weight: bold;
      text-transform: uppercase;
      letter-spacing: 1px;
      margin: 10px;
    }
    .btn-primary:hover {
      background: linear-gradient(45deg, #0099cc, #00ffcc);
      transform: translateY(-2px);
    }
    .btn-outline-primary {
      border: 2px solid #00ffcc;
      color: #00ffcc;
      padding: 12px 30px;
      font-weight: bold;
      text-transform: uppercase;
      letter-spacing: 1px;
      margin: 10px;
    }
    .btn-outline-primary:hover {
      background-color: #00ffcc;
      color: #000;
    }
  </style>
</head>

<body>
<!-- Navigation -->
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

    <!-- Account Dropdown -->
    <div class="dropdown ml-3">
      <button class="btn btn-outline-info dropdown-toggle" type="button" id="authDropdown" data-toggle="dropdown">
        <i class="fas fa-user"></i> Account
      </button>
      <div class="dropdown-menu dropdown-menu-right">
        <a class="dropdown-item" href="signup.php">Sign Up</a>
        <a class="dropdown-item" href="login.php">Login</a>
      </div>
    </div>
  </div>
</nav>

<!-- Cart Message Alert -->
<?php if ($cartMessage): ?>
<div class="container mt-3">
  <div class="alert alert-<?php echo $cartMessage['type'] === 'error' ? 'danger' : 'success'; ?> alert-dismissible fade show" role="alert">
    <?php echo htmlspecialchars($cartMessage['message']); ?>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
</div>
<?php endif; ?>

<div class="container">
  <div class="success-container">
    <div class="success-icon">
      <i class="fas fa-check-circle"></i>
    </div>
    
    <h1 class="mb-4">Order Placed Successfully!</h1>
    
    <p class="lead">Thank you for your purchase! Your order has been received and is being processed.</p>
    
    <div class="order-id">
      <strong>Order ID: <?php echo $orderId; ?></strong>
    </div>
    
    <p>You will receive an email confirmation shortly with your order details and tracking information.</p>
    
    <div class="mt-4">
      <a href="web1.php" class="btn btn-primary">
        <i class="fas fa-home mr-2"></i>Continue Shopping
      </a>
      <a href="cart.php" class="btn btn-outline-primary">
        <i class="fas fa-shopping-cart mr-2"></i>View Cart
      </a>
    </div>
    
    <hr class="my-4">
    
    <div class="row text-left">
      <div class="col-md-6">
        <h6><i class="fas fa-info-circle mr-2"></i>What's Next?</h6>
        <ul class="list-unstyled">
          <li>• Order confirmation email</li>
          <li>• Processing within 24 hours</li>
          <li>• Shipping notification</li>
          <li>• Delivery tracking</li>
        </ul>
      </div>
      <div class="col-md-6">
        <h6><i class="fas fa-headset mr-2"></i>Need Help?</h6>
        <ul class="list-unstyled">
          <li>• Email: support@gamerzone.com</li>
          <li>• Phone: +94 71 123 4567</li>
          <li>• Live Chat available</li>
          <li>• FAQ section</li>
        </ul>
      </div>
    </div>
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

<script src="js/jquery-3.3.1.min.js"></script>
<script src="js/popper.min.js"></script>
<script src="js/bootstrap-4.3.1.js"></script>
</body>
</html>