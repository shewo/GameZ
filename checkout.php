<?php
// Include the cart functions
require_once 'cart_functions.php';

// Initialize cart session
initCartSession();

// Get cart items
$cartItems = getCartItems();

// Get cart total
$cartTotal = getCartTotal();

// Check if cart is empty
if (empty($cartItems)) {
    header("Location: cart.php");
    exit();
}

// Calculate tax and total
$taxAmount = $cartTotal * 0.15;
$totalAmount = $cartTotal + $taxAmount;

// Format numbers with commas
function formatPrice($price) {
    return number_format(round($price));
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Checkout - GamingZone</title>

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
      color: #ffffff;
      min-height: 100vh;
    }
    
    /* Overlay to ensure text readability */
    body::before {
      content: '';
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: rgba(0, 0, 0, 0.3);
      z-index: -1;
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
    
    .search-bar { 
      background-color: #222; 
      color: white; 
      border: 1px solid #444; 
      padding: 8px 12px; 
      border-radius: 8px; 
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
    
    .account-btn-icon {
      margin-right: 6px;
      font-size: 1em;
    }
    
    /* Hero section styling like contact page */
    .hero-section {
      padding: 80px 0 40px 0;
      position: relative;
      color: white;
      background: rgba(0, 0, 0, 0.3);
    }
    
    .hero-content {
      position: relative;
      z-index: 2;
      text-align: center;
    }
    
    h1 {
      color: #ffffff;
      text-align: center;
      margin: 0;
      text-shadow: 0 0 10px #00ffff;
      font-weight: 600;
      letter-spacing: 1px;
    }
    
    .checkout-container {
      background: rgba(0, 0, 0, 0.8);
      border: 1px solid rgba(255,255,255,0.2);
      border-radius: 15px;
      box-shadow: 
        0 10px 30px rgba(0,0,0,0.5),
        inset 0 1px 0 rgba(255,255,255,0.1);
      padding: 40px;
      position: relative;
      z-index: 3;
      backdrop-filter: blur(15px);
      margin-bottom: 50px;
    }
    
    .form-control {
      background: rgba(255,255,255,0.1);
      border: 2px solid rgba(255,255,255,0.2);
      border-radius: 8px;
      padding: 12px 15px;
      margin-bottom: 15px;
      transition: all 0.3s ease;
      color: #ffffff;
      min-height: 48px;
    }
    
    .form-control::placeholder {
      color: rgba(255,255,255,0.5);
    }
    
    .form-control:focus {
      background: rgba(255,255,255,0.15);
      border-color: #00bfff;
      box-shadow: 0 0 0 0.2rem rgba(0,191,255,0.25);
      color: #ffffff;
    }
    
    /* Improved select dropdown styling */
    select.form-control {
      background: rgba(255,255,255,0.1) !important;
      border: 2px solid rgba(255,255,255,0.2);
      color: #ffffff !important;
      padding: 12px 40px 12px 15px;
      min-height: 48px;
      appearance: none;
      -webkit-appearance: none;
      -moz-appearance: none;
      background-image: url("data:image/svg+xml;charset=UTF-8,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='white' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3e%3cpolyline points='6,9 12,15 18,9'%3e%3c/polyline%3e%3c/svg%3e");
      background-repeat: no-repeat;
      background-position: right 12px center;
      background-size: 16px;
    }
    
    select.form-control:focus {
      background: rgba(255,255,255,0.15) !important;
      border-color: #00bfff;
      box-shadow: 0 0 0 0.2rem rgba(0,191,255,0.25);
      color: #ffffff !important;
      outline: none;
    }
    
    select.form-control option {
      background: #2a2a2a !important;
      color: #ffffff !important;
      padding: 8px;
      border: none;
    }
    
    .btn-primary {
      background: linear-gradient(to right, #00bfff, #00ffcc);
      color: #000;
      font-weight: 600;
      padding: 15px 30px;
      border: none;
      border-radius: 8px;
      transition: all 0.3s ease;
      letter-spacing: 0.5px;
      text-transform: uppercase;
      font-size: 16px;
    }
    
    .btn-primary:hover {
      transform: translateY(-3px);
      box-shadow: 0 10px 20px rgba(0, 255, 204, 0.3);
      background: linear-gradient(45deg, #0099cc, #00ffcc);
    }
    
    .btn-primary:focus {
      outline: none;
      box-shadow: 0 0 0 0.2rem rgba(0, 191, 255, 0.25);
    }
    
    .order-summary {
      background: rgba(0, 0, 0, 0.8);
      border: 1px solid rgba(255,255,255,0.2);
      border-radius: 15px;
      box-shadow: 
        0 10px 30px rgba(0,0,0,0.5),
        inset 0 1px 0 rgba(255,255,255,0.1);
      padding: 30px;
      backdrop-filter: blur(15px);
    }
    
    .cart-item {
      background: rgba(255,255,255,0.1);
      border-radius: 8px;
      padding: 15px;
      margin-bottom: 15px;
      border: 1px solid rgba(255,255,255,0.1);
      transition: all 0.3s ease;
    }
    
    .cart-item:hover {
      transform: translateY(-2px);
      box-shadow: 0 5px 15px rgba(0, 191, 255, 0.1);
    }
    
    .item-image {
      width: 60px;
      height: 60px;
      object-fit: cover;
      border-radius: 8px;
      box-shadow: 0 4px 8px rgba(0,0,0,0.2);
    }
    
    .price-row {
      border-top: 1px solid rgba(255,255,255,0.2);
      padding-top: 20px;
      margin-top: 20px;
    }
    
    .total-amount {
      font-size: 1.5em;
      font-weight: bold;
      color: #00bfff;
    }
    
    h5 {
      color: #00bfff;
      margin-bottom: 20px;
      font-weight: 600;
      letter-spacing: 0.5px;
    }
    
    label {
      color: rgba(255,255,255,0.8);
      font-weight: 500;
      margin-bottom: 8px;
    }
    
    .form-check-label {
      color: rgba(255,255,255,0.8);
    }
    
    hr {
      border-color: rgba(255,255,255,0.2);
    }
    
    a {
      color: #00bfff;
      transition: all 0.3s ease;
    }
    
    a:hover {
      color: #00ffcc;
      text-decoration: none;
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
        <a class="dropdown-item" href="signup.php">Sign Up</a>
        <a class="dropdown-item" href="login.php">Login</a>
      </div>
    </div>
  </div>
</nav>

<!-- Hero Section -->
<div class="hero-section">
  <div class="container">
    <div class="hero-content">
      <h1><i class="fas fa-credit-card mr-3"></i>Checkout</h1>
      <p class="lead mt-3" style="color: rgba(255, 255, 255, 0.8);">
        Complete your order information
      </p>
    </div>
  </div>
</div>

<div class="container my-4">
  <div class="row">
    <div class="col-lg-8">
      <div class="checkout-container">
        
        <form action="process_order.php" method="post">
          <h5><i class="fas fa-user-circle mr-2"></i>Billing Information</h5>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="firstName">First Name</label>
                <input type="text" class="form-control" id="firstName" name="firstName" placeholder="Enter your first name" required>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="lastName">Last Name</label>
                <input type="text" class="form-control" id="lastName" name="lastName" placeholder="Enter your last name" required>
              </div>
            </div>
          </div>
          
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="email">Email Address</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email" required>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="phone">Phone Number</label>
                <input type="tel" class="form-control" id="phone" name="phone" placeholder="Enter your phone number" required>
              </div>
            </div>
          </div>
          
          <hr class="my-4">
          
          <h5><i class="fas fa-shipping-fast mr-2"></i>Shipping Address</h5>
          <div class="form-group">
            <label for="address">Street Address</label>
            <input type="text" class="form-control" id="address" name="address" placeholder="Enter your address" required>
          </div>
          
          <div class="row">
            <div class="col-md-4">
              <div class="form-group">
                <label for="city">City</label>
                <input type="text" class="form-control" id="city" name="city" placeholder="Enter your city" required>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label for="postalCode">Postal Code</label>
                <input type="text" class="form-control" id="postalCode" name="postalCode" placeholder="Enter postal code" required>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label for="country">Country</label>
                <select class="form-control" id="country" name="country" required>
                  <option value="">Select Country</option>
                  <option value="Sri Lanka">Sri Lanka</option>
                  <option value="India">India</option>
                  <option value="Other">Other</option>
                </select>
              </div>
            </div>
          </div>
          
          <hr class="my-4">
          
          <h5><i class="fas fa-credit-card mr-2"></i>Payment Information</h5>
          <div class="form-group">
            <label for="cardName">Name on Card</label>
            <input type="text" class="form-control" id="cardName" name="cardName" placeholder="Enter name as on card" required>
          </div>
          
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="cardNumber">Card Number</label>
                <input type="text" class="form-control" id="cardNumber" name="cardNumber" placeholder="1234 5678 9012 3456" required>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label for="expiry">Expiry Date</label>
                <input type="text" class="form-control" id="expiry" name="expiry" placeholder="MM/YY" required>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label for="cvv">CVV</label>
                <input type="text" class="form-control" id="cvv" name="cvv" placeholder="123" required>
              </div>
            </div>
          </div>
          
          <div class="form-group mt-4">
            <div class="form-check">
              <input class="form-check-input" type="checkbox" id="terms" name="terms" required>
              <label class="form-check-label" for="terms">
                I agree to the <a href="#">Terms and Conditions</a>
              </label>
            </div>
          </div>
          
          <div class="mt-5">
            <button type="submit" class="btn btn-primary btn-block">
              <i class="fas fa-lock mr-2"></i>Place Order - <?php echo formatPrice($totalAmount); ?> LKR
            </button>
          </div>
        </form>
      </div>
    </div>
    
    <div class="col-lg-4">
      <div class="order-summary">
        <h5 class="text-center mb-4"><i class="fas fa-shopping-bag mr-2"></i>Order Summary</h5>
        
        <!-- Cart Items -->
        <?php foreach ($cartItems as $item): ?>
        <div class="cart-item">
          <div class="row align-items-center">
            <div class="col-3">
              <img src="<?php echo htmlspecialchars($item['image']); ?>" alt="<?php echo htmlspecialchars($item['name']); ?>" class="item-image">
            </div>
            <div class="col-6">
              <h6 class="mb-1"><?php echo htmlspecialchars($item['name']); ?></h6>
              <small style="color: rgba(255, 255, 255, 0.7);">Qty: <?php echo $item['quantity']; ?></small>
            </div>
            <div class="col-3 text-right">
              <strong style="color: #00bfff;"><?php echo formatPrice($item['price'] * $item['quantity']); ?> LKR</strong>
            </div>
          </div>
        </div>
        <?php endforeach; ?>
        
        <div class="price-row">
          <div class="d-flex justify-content-between mb-3">
            <span style="color: rgba(255, 255, 255, 0.8);">Subtotal:</span>
            <span><?php echo formatPrice($cartTotal); ?> LKR</span>
          </div>
          <div class="d-flex justify-content-between mb-3">
            <span style="color: rgba(255, 255, 255, 0.8);">Tax (15%):</span>
            <span><?php echo formatPrice($taxAmount); ?> LKR</span>
          </div>
          <div class="d-flex justify-content-between mb-3">
            <span style="color: rgba(255, 255, 255, 0.8);">Shipping:</span>
            <span>Free</span>
          </div>
          
          <hr style="border-color: rgba(255, 255, 255, 0.2); margin: 15px 0;">
          
          <div class="d-flex justify-content-between total-amount">
            <span>Total:</span>
            <span><?php echo formatPrice($totalAmount); ?> LKR</span>
          </div>
          
          <div class="mt-4 text-center">
            <small style="color: rgba(255, 255, 255, 0.6);">
              <i class="fas fa-lock mr-1"></i> Your payment is secure and encrypted
            </small>
          </div>
        </div>
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