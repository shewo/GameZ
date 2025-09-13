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
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />

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

    h1 {
      color: #ffffff;
      text-align: center;
      margin: 50px 0 30px;
      text-shadow: 0 0 10px #00ffff;
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
    
    .cart-container {
      background-color: rgba(0, 0, 0, 0.7);
      border-radius: 10px;
      padding: 30px;
      margin-bottom: 50px;
    }
    
    .cart-table {
      color: white;
    }
    
    .cart-table th {
      background-color: rgba(0, 150, 150, 0.5);
      color: white;
    }
    
    .cart-table td {
      vertical-align: middle;
    }
    
    .product-image {
      max-width: 80px;
      max-height: 80px;
    }
    
    .quantity-input {
      width: 60px;
      background-color: rgba(20, 20, 40, 0.8);
      color: white;
      border: 1px solid #00ffff;
      text-align: center;
    }
    
    .btn-remove {
      background-color: #ff3860;
      color: white;
      border: none;
    }
    
    .btn-update {
      background-color: #00bfff;
      color: white;
      border: none;
    }
    
    .cart-summary {
      background-color: rgba(20, 20, 40, 0.8);
      padding: 20px;
      border-radius: 10px;
      margin-top: 30px;
    }
    
    .btn-checkout {
      background: linear-gradient(to right, #00bfff, #00ffcc);
      color: #000;
      font-weight: bold;
      padding: 12px 30px;
      border: none;
      border-radius: 30px;
      margin-top: 20px;
      transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    
    .btn-checkout:hover {
      transform: translateY(-3px);
      box-shadow: 0 10px 20px rgba(0, 255, 204, 0.3);
      color: #000;
    }
    
    .empty-cart {
      text-align: center;
      padding: 50px 0;
    }
    
    .continue-shopping {
      margin-top: 20px;
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
      <li class="nav-item"> <a class="nav-link" href="accesories.php">Accessories</a> </li>
      <li class="nav-item"> <a class="nav-link" href="parts.php">Parts</a> </li>
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
        <i class="fas fa-shopping-cart"></i>
        <?php if(isset($_SESSION['cart']) && count($_SESSION['cart']) > 0): ?>
        <span class="cart-badge"><?php echo count($_SESSION['cart']); ?></span>
        <?php endif; ?>
      </span>
    </a>

    <!-- Dropdown Button -->
    <div class="dropdown ml-2">
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

    <div class="container my-5">
      <h1><i class="fas fa-shopping-cart mr-3"></i>Your Shopping Cart</h1>
      
      <?php if($cartMessage): ?>
      <div class="alert alert-<?php echo $cartMessage['type']; ?> alert-dismissible fade show" role="alert">
        <?php echo $cartMessage['message']; ?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <?php endif; ?>
      
      <div class="cart-container">
        <?php if(count($cartItems) > 0): ?>
          <form action="cart_action.php" method="post">
            <table class="table cart-table">
              <thead>
                <tr>
                  <th>Product</th>
                  <th>Image</th>
                  <th>Price</th>
                  <th>Quantity</th>
                  <th>Subtotal</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach($cartItems as $id => $item): ?>
                <tr>
                  <td><?php echo $item['name']; ?></td>
                  <td><img src="<?php echo $item['image']; ?>" class="product-image" alt="<?php echo $item['name']; ?>"></td>
                  <td>$<?php echo number_format($item['price'], 2); ?></td>
                  <td>
                    <input type="number" name="quantity[<?php echo $id; ?>]" value="<?php echo $item['quantity']; ?>" min="1" class="quantity-input">
                  </td>
                  <td>$<?php echo number_format($item['price'] * $item['quantity'], 2); ?></td>
                  <td>
                    <button type="submit" name="update" value="<?php echo $id; ?>" class="btn btn-update btn-sm"><i class="fas fa-sync-alt"></i> Update</button>
                    <button type="submit" name="remove" value="<?php echo $id; ?>" class="btn btn-remove btn-sm mt-2"><i class="fas fa-trash"></i> Remove</button>
                  </td>
                </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
            
            <div class="row">
              <div class="col-md-6">
                <div class="continue-shopping">
                  <a href="web1.php" class="btn btn-outline-info"><i class="fas fa-arrow-left mr-2"></i>Continue Shopping</a>
                  <button type="submit" name="clear_cart" value="1" class="btn btn-outline-danger ml-2">
                    <i class="fas fa-trash-alt mr-2"></i>Clear Cart
                  </button>
                </div>
              </div>
              <div class="col-md-6">
                <div class="cart-summary text-right">
                  <h4>Cart Summary</h4>
                  <hr class="bg-info">
                  <div class="d-flex justify-content-between my-3">
                    <span>Subtotal:</span>
                    <span>$<?php echo number_format($cartTotal, 2); ?></span>
                  </div>
                  <div class="d-flex justify-content-between mb-3">
                    <span>Shipping:</span>
                    <span>$<?php echo number_format($cartTotal > 0 ? 10.00 : 0, 2); ?></span>
                  </div>
                  <div class="d-flex justify-content-between mb-3">
                    <span><strong>Total:</strong></span>
                    <span><strong>$<?php echo number_format($cartTotal + ($cartTotal > 0 ? 10.00 : 0), 2); ?></strong></span>
                  </div>
                  <a href="checkout.php" class="btn btn-checkout btn-block"><i class="fas fa-credit-card mr-2"></i>Proceed to Checkout</a>
                </div>
              </div>
            </div>
          </form>
        <?php else: ?>
          <div class="empty-cart">
            <i class="fas fa-shopping-cart fa-5x mb-4 text-muted"></i>
            <h3>Your cart is empty</h3>
            <p class="text-muted">Looks like you haven't added any products to your cart yet.</p>
            <a href="web1.php" class="btn btn-outline-info mt-4"><i class="fas fa-arrow-left mr-2"></i>Return to Shopping</a>
          </div>
        <?php endif; ?>
      </div>
    </div>
    
    <!-- Footer -->
    <footer class="text-center py-4 text-white" style="background-color: rgba(10, 10, 30, 0.9);">
      <div class="container">
        <div class="row">
          <div class="col-md-4">
            <h5>Contact Us</h5>
            <p><i class="fas fa-envelope mr-2"></i> info@gamingzone.com</p>
            <p><i class="fas fa-phone mr-2"></i> (123) 456-7890</p>
          </div>
          <div class="col-md-4">
            <h5>Quick Links</h5>
            <ul class="list-unstyled">
              <li><a href="#" class="text-info">About Us</a></li>
              <li><a href="contact.php" class="text-info">Contact</a></li>
              <li><a href="#" class="text-info">Terms of Service</a></li>
            </ul>
          </div>
          <div class="col-md-4">
            <h5>Follow Us</h5>
            <a href="#" class="text-info mx-2"><i class="fab fa-facebook fa-lg"></i></a>
            <a href="#" class="text-info mx-2"><i class="fab fa-twitter fa-lg"></i></a>
            <a href="#" class="text-info mx-2"><i class="fab fa-instagram fa-lg"></i></a>
          </div>
        </div>
        <hr class="bg-info">
        <p class="mb-0">&copy; 2023 GamingZone. All rights reserved.</p>
      </div>
    </footer>
  </div>

  <!-- jQuery and Bootstrap JS -->
  <script src="js/jquery-3.3.1.min.js"></script>
  <script src="js/bootstrap-4.3.1.js"></script>
</body>
</html>