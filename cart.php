<?php
// Include the cart functions
require_once 'cart_functions.php';

// Initialize cart session
initCartSession();

// Get cart items
$cartItems = getCartItems();

// Get cart total
$cartTotal = getCartTotal();

// Check for flash messages
$cartMessage = getCartMessage();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Your Shopping Cart - GamingZone</title>

  <!-- Bootstrap -->
  <link href="css/bootstrap-4.3.1.css" rel="stylesheet" />
  <!-- Font Awesome for icons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />

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

    h1 {
      color: #ffffff;
      text-align: center;
      margin: 0;
      text-shadow: 0 0 10px #00ffff;
      font-weight: 600;
      letter-spacing: 1px;
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
    
    /* Dropdown menu dark theme */
    .dropdown-menu {
      background-color: rgba(10, 10, 30, 0.95);
      border: none;
      min-width: 150px;
    }
    
    /* Dropdown links */
    .dropdown-item {
      color: #00ffff;
      background-color: transparent;
      transition: background 0.3s, color 0.3s;
    }
    
    /* Hover effect for dropdown links */
    .dropdown-item:hover {
      background-color: #00bfff;
      color: #ffffff;
    }
    
    /* Optional: remove arrow on toggle to match image style */
    .dropdown-toggle::after {
      display: none;
    }
    
    .cart-icon {
      font-size: 24px;
      color: #00ffff;
      position: relative;
    }
    
    .cart-badge {
      position: absolute;
      top: -10px;
      right: -10px;
      background-color: #ff3860;
      color: white;
      border-radius: 50%;
      width: 20px;
      height: 20px;
      font-size: 12px;
      display: flex;
      align-items: center;
      justify-content: center;
    }
    
    /* Hero section styling similar to contact page */
    .hero-section {
      padding: 60px 0 30px 0;
      position: relative;
      color: white;
      text-align: center;
    }
    
    .hero-content {
      position: relative;
      z-index: 2;
    }
    
    /* Cart container styling */
    .cart-container {
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
    }
    
    /* Cart table styling */
    .cart-table {
      color: white;
      margin-bottom: 2rem;
    }
    
    .cart-table th {
      background-color: rgba(0, 191, 255, 0.2);
      color: white;
      border-color: rgba(255, 255, 255, 0.1);
      padding: 15px;
      font-weight: 500;
    }
    
    .cart-table td {
      vertical-align: middle;
      border-color: rgba(255, 255, 255, 0.1);
      padding: 15px;
    }
    
    .product-image {
      max-width: 80px;
      max-height: 80px;
      border-radius: 8px;
      box-shadow: 0 5px 10px rgba(0,0,0,0.2);
    }
    
    .quantity-input {
      width: 60px;
      background: rgba(255,255,255,0.1);
      border: 2px solid rgba(255,255,255,0.2);
      border-radius: 8px;
      padding: 12px 15px;
      margin-bottom: 15px;
      transition: all 0.3s ease;
      color: #ffffff;
      min-height: 48px;
      text-align: center;
    }
    
    .quantity-input:focus {
      background: rgba(255,255,255,0.15);
      border-color: #00bfff;
      box-shadow: 0 0 0 0.2rem rgba(0,191,255,0.25);
      color: #ffffff;
      outline: none;
    }
    
    /* Button styling */
    .btn-remove {
      background-color: rgba(255, 56, 96, 0.8);
      color: white;
      border: none;
      border-radius: 8px;
      transition: all 0.3s ease;
      padding: 10px 15px;
      font-weight: 500;
      letter-spacing: 0.5px;
    }
    
    .btn-remove:hover {
      background-color: rgba(255, 56, 96, 1);
      transform: translateY(-2px);
      box-shadow: 0 4px 8px rgba(255, 56, 96, 0.3);
    }
    
    .btn-update {
      background-color: rgba(0, 191, 255, 0.8);
      color: white;
      border: none;
      border-radius: 8px;
      transition: all 0.3s ease;
      padding: 10px 15px;
      font-weight: 500;
      letter-spacing: 0.5px;
    }
    
    .btn-update:hover {
      background-color: rgba(0, 191, 255, 1);
      transform: translateY(-2px);
      box-shadow: 0 4px 8px rgba(0, 191, 255, 0.3);
    }
    
    .btn-outline-info {
      border: 2px solid #00bfff;
      color: #00bfff;
      background: transparent;
      border-radius: 8px;
      padding: 10px 20px;
      transition: all 0.3s ease;
      font-weight: 500;
      letter-spacing: 0.5px;
    }
    
    .btn-outline-info:hover {
      background-color: #00bfff;
      color: white;
      transform: translateY(-2px);
      box-shadow: 0 5px 15px rgba(0, 191, 255, 0.3);
    }
    
    .btn-outline-danger {
      border: 2px solid #ff3860;
      color: #ff3860;
      background: transparent;
      border-radius: 8px;
      padding: 10px 20px;
      transition: all 0.3s ease;
      font-weight: 500;
      letter-spacing: 0.5px;
    }
    
    .btn-outline-danger:hover {
      background-color: #ff3860;
      color: white;
      transform: translateY(-2px);
      box-shadow: 0 5px 15px rgba(255, 56, 96, 0.3);
    }
    
    /* Cart summary styling */
    .cart-summary {
      background: rgba(0, 0, 0, 0.4);
      border: 1px solid rgba(255,255,255,0.1);
      border-radius: 15px;
      padding: 25px;
      box-shadow: 
        0 10px 20px rgba(0,0,0,0.2),
        inset 0 1px 0 rgba(255,255,255,0.05);
    }
    
    .cart-summary h4 {
      color: #00bfff;
      margin-bottom: 20px;
      font-weight: 600;
      letter-spacing: 0.5px;
    }
    
    /* Checkout button styling */
    .btn-checkout {
      background: linear-gradient(to right, #00bfff, #00ffcc);
      color: #000;
      font-weight: 600;
      padding: 15px 30px;
      border: none;
      border-radius: 8px;
      margin-top: 20px;
      transition: all 0.3s ease;
      letter-spacing: 0.5px;
      text-transform: uppercase;
      font-size: 16px;
    }
    
    .btn-checkout:hover {
      transform: translateY(-3px);
      box-shadow: 0 10px 20px rgba(0, 255, 204, 0.3);
      color: #000;
    }
    
    .btn-checkout:focus {
      outline: none;
      box-shadow: 0 0 0 0.2rem rgba(0, 191, 255, 0.25);
    }
    
    /* Empty cart styling */
    .empty-cart {
      text-align: center;
      padding: 50px 0;
    }
    
    .empty-cart i {
      color: rgba(255, 255, 255, 0.2);
      margin-bottom: 20px;
    }
    
    .empty-cart h3 {
      color: #00bfff;
      margin-bottom: 15px;
    }
    
    /* Continue shopping button styling */
    .continue-shopping {
      margin-top: 20px;
    }
    
    .btn-outline-info {
      border: 2px solid #00bfff;
      color: #00bfff;
      background: transparent;
      transition: all 0.3s ease;
    }
    
    .btn-outline-info:hover {
      background-color: #00bfff;
      color: white;
      transform: translateY(-2px);
      box-shadow: 0 5px 15px rgba(0, 191, 255, 0.3);
    }
    
    .btn-outline-danger {
      border: 2px solid #ff3860;
      color: #ff3860;
      background: transparent;
      transition: all 0.3s ease;
    }
    
    .btn-outline-danger:hover {
      background-color: #ff3860;
      color: white;
      transform: translateY(-2px);
      box-shadow: 0 5px 15px rgba(255, 56, 96, 0.3);
    }
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

    <!-- Hero Section -->
    <div class="hero-section">
      <div class="container">
        <div class="hero-content text-center">
          <h1><i class="fas fa-shopping-cart mr-3"></i>Your Shopping Cart</h1>
          <p class="lead mt-3" style="color: rgba(255, 255, 255, 0.8);">
            Review your items and proceed to checkout
          </p>
        </div>
      </div>
    </div>

    <div class="container my-4">
      <?php if($cartMessage): ?>
      <div class="alert alert-<?php echo $cartMessage['type']; ?> alert-dismissible fade show" role="alert" style="background: rgba(<?php echo $cartMessage['type'] == 'success' ? '0, 200, 81, 0.9' : '255, 56, 96, 0.9'; ?>); border: none; color: white; border-radius: 10px;">
        <i class="fas fa-<?php echo $cartMessage['type'] == 'success' ? 'check-circle' : 'exclamation-circle'; ?> mr-2"></i>
        <?php echo $cartMessage['message']; ?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <?php endif; ?>
      
      <div class="cart-container">
        <?php if(count($cartItems) > 0): ?>
          <form action="cart_action.php" method="post">
            <div class="table-responsive">
              <table class="table cart-table">
                <thead>
                  <tr>
                    <th>Product</th>
                    <th>Image</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Subtotal</th>
                    <th>Actions</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach($cartItems as $id => $item): ?>
                  <tr>
                    <td class="font-weight-medium"><?php echo $item['name']; ?></td>
                    <td><img src="<?php echo $item['image']; ?>" class="product-image" alt="<?php echo $item['name']; ?>"></td>
                    <td>$<?php echo number_format($item['price'], 2); ?></td>
                    <td>
                      <input type="number" name="quantity[<?php echo $id; ?>]" value="<?php echo $item['quantity']; ?>" min="1" class="quantity-input">
                    </td>
                    <td class="font-weight-bold">$<?php echo number_format($item['price'] * $item['quantity'], 2); ?></td>
                    <td>
                      <button type="submit" name="update" value="<?php echo $id; ?>" class="btn btn-update btn-sm mb-2"><i class="fas fa-sync-alt"></i> Update</button>
                      <button type="submit" name="remove" value="<?php echo $id; ?>" class="btn btn-remove btn-sm"><i class="fas fa-trash"></i> Remove</button>
                    </td>
                  </tr>
                  <?php endforeach; ?>
                </tbody>
              </table>
            </div>
            
            <div class="row mt-4">
              <div class="col-md-6">
                <div class="continue-shopping">
                  <a href="web1.php" class="btn btn-outline-info mr-2"><i class="fas fa-arrow-left mr-2"></i>Continue Shopping</a>
                  <button type="submit" name="clear_cart" value="1" class="btn btn-outline-danger">
                    <i class="fas fa-trash-alt mr-2"></i>Clear Cart
                  </button>
                </div>
              </div>
              <div class="col-md-6">
                <div class="cart-summary text-right">
                  <h4><i class="fas fa-receipt mr-2"></i>Cart Summary</h4>
                  <hr style="border-color: rgba(0, 191, 255, 0.3); margin: 15px 0;">
                  
                  <div class="d-flex justify-content-between my-3">
                    <span>Subtotal:</span>
                    <span>$<?php echo number_format($cartTotal, 2); ?></span>
                  </div>
                  <div class="d-flex justify-content-between mb-3">
                    <span>Shipping:</span>
                    <span>$<?php echo number_format($cartTotal > 0 ? 10.00 : 0, 2); ?></span>
                  </div>
                  <hr style="border-color: rgba(255, 255, 255, 0.1); margin: 15px 0;">
                  <div class="d-flex justify-content-between mb-3">
                    <span class="h5">Total:</span>
                    <span class="h5">$<?php echo number_format($cartTotal + ($cartTotal > 0 ? 10.00 : 0), 2); ?></span>
                  </div>
                  <a href="checkout.php" class="btn btn-checkout btn-block"><i class="fas fa-credit-card mr-2"></i>Proceed to Checkout</a>
                </div>
              </div>
            </div>
          </form>
        <?php else: ?>
          <div class="empty-cart">
            <i class="fas fa-shopping-cart fa-5x mb-4"></i>
            <h3>Your cart is empty</h3>
            <p style="color: rgba(255, 255, 255, 0.7);">Looks like you haven't added any products to your cart yet.</p>
            <a href="web1.php" class="btn btn-outline-info mt-4"><i class="fas fa-arrow-left mr-2"></i>Return to Shopping</a>
          </div>
        <?php endif; ?>
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