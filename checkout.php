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
      color: white;
    }
    .navbar { background-color: rgba(10, 10, 30, 0.9); }
    .navbar .navbar-brand, .navbar-nav .nav-link { color: #ffffff !important; }
    .navbar .nav-link:hover { color: #00ffcc !important; }
    .checkout-container {
      background-color: rgba(0,0,0,0.8);
      border-radius: 15px;
      padding: 30px;
      margin: 50px auto;
      box-shadow: 0 10px 30px rgba(0,255,204,0.3);
    }
    .form-control {
      background-color: rgba(255,255,255,0.1);
      border: 1px solid #00ffcc;
      color: white;
    }
    .form-control:focus {
      background-color: rgba(255,255,255,0.2);
      border-color: #00ffcc;
      color: white;
      box-shadow: 0 0 0 0.2rem rgba(0,255,204,0.25);
    }
    .form-control::placeholder {
      color: rgba(255,255,255,0.7);
    }
    .btn-primary {
      background: linear-gradient(45deg, #00ffcc, #0099cc);
      border: none;
      padding: 12px 30px;
      font-weight: bold;
      text-transform: uppercase;
      letter-spacing: 1px;
    }
    .btn-primary:hover {
      background: linear-gradient(45deg, #0099cc, #00ffcc);
      transform: translateY(-2px);
    }
    .order-summary {
      background-color: rgba(0,0,0,0.5);
      border-radius: 10px;
      padding: 20px;
      border: 1px solid #00ffcc;
    }
    .cart-item {
      background-color: rgba(255,255,255,0.1);
      border-radius: 8px;
      padding: 15px;
      margin-bottom: 10px;
      border: 1px solid rgba(0,255,204,0.3);
    }
    .item-image {
      width: 60px;
      height: 60px;
      object-fit: cover;
      border-radius: 5px;
    }
    .price-row {
      border-top: 2px solid #00ffcc;
      padding-top: 15px;
      margin-top: 15px;
    }
    .total-amount {
      font-size: 1.5em;
      font-weight: bold;
      color: #00ffcc;
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

<div class="container">
  <div class="row">
    <div class="col-lg-8">
      <div class="checkout-container">
        <h2 class="mb-4"><i class="fas fa-credit-card mr-2"></i>Checkout</h2>
        
        <form action="process_order.php" method="post">
          <div class="row">
            <div class="col-md-6">
              <h5>Billing Information</h5>
              <div class="form-group">
                <label for="firstName">First Name</label>
                <input type="text" class="form-control" id="firstName" name="firstName" placeholder="Enter your first name" required>
              </div>
              <div class="form-group">
                <label for="lastName">Last Name</label>
                <input type="text" class="form-control" id="lastName" name="lastName" placeholder="Enter your last name" required>
              </div>
              <div class="form-group">
                <label for="email">Email Address</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email" required>
              </div>
              <div class="form-group">
                <label for="phone">Phone Number</label>
                <input type="tel" class="form-control" id="phone" name="phone" placeholder="Enter your phone number" required>
              </div>
            </div>
            
            <div class="col-md-6">
              <h5>Shipping Address</h5>
              <div class="form-group">
                <label for="address">Street Address</label>
                <input type="text" class="form-control" id="address" name="address" placeholder="Enter your address" required>
              </div>
              <div class="form-group">
                <label for="city">City</label>
                <input type="text" class="form-control" id="city" name="city" placeholder="Enter your city" required>
              </div>
              <div class="form-group">
                <label for="postalCode">Postal Code</label>
                <input type="text" class="form-control" id="postalCode" name="postalCode" placeholder="Enter postal code" required>
              </div>
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
          
          <h5>Payment Information</h5>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="cardName">Name on Card</label>
                <input type="text" class="form-control" id="cardName" name="cardName" placeholder="Enter name as on card" required>
              </div>
              <div class="form-group">
                <label for="cardNumber">Card Number</label>
                <input type="text" class="form-control" id="cardNumber" name="cardNumber" placeholder="1234 5678 9012 3456" required>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="expiry">Expiry Date</label>
                <input type="text" class="form-control" id="expiry" name="expiry" placeholder="MM/YY" required>
              </div>
              <div class="form-group">
                <label for="cvv">CVV</label>
                <input type="text" class="form-control" id="cvv" name="cvv" placeholder="123" required>
              </div>
            </div>
          </div>
          
          <div class="form-group">
            <div class="form-check">
              <input class="form-check-input" type="checkbox" id="terms" name="terms" required>
              <label class="form-check-label" for="terms">
                I agree to the <a href="#" style="color: #00ffcc;">Terms and Conditions</a>
              </label>
            </div>
          </div>
          
          <button type="submit" class="btn btn-primary btn-block">
            <i class="fas fa-lock mr-2"></i>Place Order - <?php echo formatPrice($totalAmount); ?> LKR
          </button>
        </form>
      </div>
    </div>
    
    <div class="col-lg-4">
      <div class="order-summary">
        <h5 class="mb-3"><i class="fas fa-shopping-bag mr-2"></i>Order Summary</h5>
        
        <!-- Cart Items -->
        <?php foreach ($cartItems as $item): ?>
        <div class="cart-item">
          <div class="row align-items-center">
            <div class="col-3">
              <img src="<?php echo htmlspecialchars($item['image']); ?>" alt="<?php echo htmlspecialchars($item['name']); ?>" class="item-image">
            </div>
            <div class="col-6">
              <h6 class="mb-1"><?php echo htmlspecialchars($item['name']); ?></h6>
              <small>Qty: <?php echo $item['quantity']; ?></small>
            </div>
            <div class="col-3 text-right">
              <strong><?php echo formatPrice($item['price'] * $item['quantity']); ?> LKR</strong>
            </div>
          </div>
        </div>
        <?php endforeach; ?>
        
        <div class="price-row">
          <div class="d-flex justify-content-between mb-2">
            <span>Subtotal:</span>
            <span><?php echo formatPrice($cartTotal); ?> LKR</span>
          </div>
          <div class="d-flex justify-content-between mb-2">
            <span>Tax (15%):</span>
            <span><?php echo formatPrice($taxAmount); ?> LKR</span>
          </div>
          <div class="d-flex justify-content-between mb-2">
            <span>Shipping:</span>
            <span>Free</span>
          </div>
          <div class="d-flex justify-content-between total-amount">
            <span>Total:</span>
            <span><?php echo formatPrice($totalAmount); ?> LKR</span>
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