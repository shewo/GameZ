<?php
// Get product info from URL parameters
$productName = isset($_GET['product']) ? htmlspecialchars($_GET['product']) : '';
$productPrice = isset($_GET['price']) ? htmlspecialchars($_GET['price']) : '';
$productImage = isset($_GET['image']) ? htmlspecialchars($_GET['image']) : '';

if (!$productName || !$productPrice || !$productImage) {
    // Redirect to product page if info missing
    header("Location: product-page.php");
    exit();
}

// Calculate tax and total
$basePrice = floatval(str_replace(',', '', $productPrice));
$taxAmount = $basePrice * 0.15;
$totalAmount = $basePrice + $taxAmount;

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
    .billing-container {
      background-color: rgba(0,0,0,0.8);
      border-radius: 15px;
      padding: 30px;
      margin: 30px auto;
      max-width: 1000px;
      box-shadow: 0 10px 30px rgba(0,0,0,0.5);
    }
    .product-summary { background-color: rgba(255,255,255,0.1); border-radius: 10px; padding: 20px; margin-bottom: 30px; }
    .product-image { max-width: 200px; border-radius: 10px; box-shadow: 0 5px 15px rgba(0,0,0,0.3); }
    .form-control { background-color: rgba(255,255,255,0.1); border: 1px solid rgba(255,255,255,0.3); color: white; }
    .form-control:focus { background-color: rgba(255,255,255,0.15); border-color: #00bfff; color: white; box-shadow: 0 0 0 0.2rem rgba(0,191,255,0.25); }
    .form-control::placeholder { color: rgba(255,255,255,0.7); }
    .btn-primary { background-color: #00bfff; border: none; padding: 15px 30px; font-size: 18px; font-weight: bold; }
    .btn-primary:hover { background-color: #0080ff; }
    .btn-secondary { background-color: rgba(255,255,255,0.2); border: none; color: white; }
    .btn-secondary:hover { background-color: rgba(255,255,255,0.3); color: white; }
    .price-breakdown { background-color: rgba(0,191,255,0.1); border-radius: 10px; padding: 20px; border: 1px solid rgba(0,191,255,0.3); }
    .total-price { font-size: 24px; font-weight: bold; color: #00ffcc; }
    h1,h2,h3 { color: #ffffff; text-shadow: 0 0 10px rgba(0,255,255,0.5); }
  </style>
</head>
<body>
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
          <li class="nav-item"> <a class="nav-link" href="console.php">&nbsp;Gaming Consoles&nbsp;</a> </li>
      </ul>
    </div>
  </nav>

  <!-- Billing Container -->
  <div class="container-fluid">
    <div class="billing-container">
      <h1 class="text-center mb-4"><i class="fas fa-shopping-cart"></i> Checkout</h1>
      
      <!-- Product Summary -->
      <div class="product-summary">
        <h3><i class="fas fa-laptop"></i> Your Order</h3>
        <div class="row align-items-center">
          <div class="col-md-3 text-center">
            <img src="<?php echo $productImage; ?>" alt="<?php echo $productName; ?>" class="img-fluid product-image">
          </div>
          <div class="col-md-6">
            <h4><?php echo $productName; ?></h4>
            <p class="text-muted">High-performance gaming laptop with premium specifications</p>
          </div>
          <div class="col-md-3 text-right">
            <div class="total-price"><?php echo formatPrice($basePrice); ?></div>
            <small class="text-muted">LKR</small>
          </div>
        </div>
      </div>

      <div class="row">
        <!-- Billing Info -->
        <div class="col-md-8">
          <h3><i class="fas fa-user"></i> Billing Information</h3>
          <form id="billing-form" method="post" action="process_order.php">
            <input type="hidden" name="productName" value="<?php echo $productName; ?>">
            <input type="hidden" name="productPrice" value="<?php echo $basePrice; ?>">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="firstName">First Name *</label>
                  <input type="text" class="form-control" id="firstName" name="firstName" placeholder="Enter your first name" required>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="lastName">Last Name *</label>
                  <input type="text" class="form-control" id="lastName" name="lastName" placeholder="Enter your last name" required>
                </div>
              </div>
            </div>
            <div class="form-group">
              <label for="email">Email Address *</label>
              <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email" required>
            </div>
            <div class="form-group">
              <label for="phone">Phone Number *</label>
              <input type="tel" class="form-control" id="phone" name="phone" placeholder="+94 71 123 4567" required>
            </div>
            <div class="form-group">
              <label for="address">Address *</label>
              <textarea class="form-control" id="address" name="address" rows="3" placeholder="Enter your full address" required></textarea>
            </div>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="city">City *</label>
                  <input type="text" class="form-control" id="city" name="city" placeholder="Enter your city" required>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="postalCode">Postal Code *</label>
                  <input type="text" class="form-control" id="postalCode" name="postalCode" placeholder="Enter postal code" required>
                </div>
              </div>
            </div>
            <h3 class="mt-4"><i class="fas fa-credit-card"></i> Payment Information</h3>
            <div class="form-group">
              <label for="paymentMethod">Payment Method *</label>
              <select class="form-control" id="paymentMethod" name="paymentMethod" required>
                <option value="">Select Payment Method</option>
                <option value="credit-card">Credit Card</option>
                <option value="debit-card">Debit Card</option>
                <option value="bank-transfer">Bank Transfer</option>
                <option value="cash-on-delivery">Cash on Delivery</option>
              </select>
            </div>

            <div id="card-details" style="display: none;">
              <div class="form-group">
                <label for="cardNumber">Card Number *</label>
                <input type="text" class="form-control" id="cardNumber" name="cardNumber" placeholder="1234 5678 9012 3456">
              </div>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="expiryDate">Expiry Date *</label>
                    <input type="text" class="form-control" id="expiryDate" name="expiryDate" placeholder="MM/YY">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="cvv">CVV *</label>
                    <input type="text" class="form-control" id="cvv" name="cvv" placeholder="123">
                  </div>
                </div>
              </div>
            </div>
          </form>
        </div>

        <!-- Order Summary -->
        <div class="col-md-4">
          <div class="price-breakdown">
            <h3><i class="fas fa-calculator"></i> Order Summary</h3>
            <div class="d-flex justify-content-between mb-2">
              <span>Product Price:</span>
              <span><?php echo formatPrice($basePrice); ?> LKR</span>
            </div>
            <div class="d-flex justify-content-between mb-2">
              <span>Shipping:</span>
              <span class="text-success">Free</span>
            </div>
            <div class="d-flex justify-content-between mb-2">
              <span>Tax (15%):</span>
              <span><?php echo formatPrice($taxAmount); ?> LKR</span>
            </div>
            <hr style="border-color: rgba(255,255,255,0.3);">
            <div class="d-flex justify-content-between">
              <strong>Total:</strong>
              <strong class="total-price"><?php echo formatPrice($totalAmount); ?> LKR</strong>
            </div>

            <div class="mt-4">
              <button type="submit" form="billing-form" class="btn btn-primary btn-block mb-2">
                <i class="fas fa-lock"></i> Complete Order
              </button>
              <button type="button" class="btn btn-secondary btn-block" onclick="window.history.back()">
                <i class="fas fa-arrow-left"></i> Back to Products
              </button>
            </div>

            <div class="text-center mt-3">
              <small class="text-muted">
                <i class="fas fa-shield-alt"></i> Secure SSL Encrypted Payment
              </small>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Scripts -->
  <script src="js/popper.min.js"></script>
  <script src="js/jquery-3.3.1.min.js"></script>
  <script src="js/bootstrap-4.3.1.js"></script>
  <script>
    // Show/hide card details
    document.getElementById('paymentMethod').addEventListener('change', function() {
      const cardDetails = document.getElementById('card-details');
      const requiredFields = ['cardNumber','expiryDate','cvv'];
      if(this.value==='credit-card'||this.value==='debit-card'){
        cardDetails.style.display='block';
        requiredFields.forEach(id=>document.getElementById(id).required=true);
      } else {
        cardDetails.style.display='none';
        requiredFields.forEach(id=>document.getElementById(id).required=false);
      }
    });

    // Format card input
    document.getElementById('cardNumber').addEventListener('input',function(e){
      let value=e.target.value.replace(/\s/g,'').replace(/[^0-9]/gi,'');
      this.value = value.match(/.{1,4}/g)?.join(' ') || value;
    });
    document.getElementById('expiryDate').addEventListener('input',function(e){
      let value=e.target.value.replace(/\D/g,'');
      if(value.length>=2)value=value.substring(0,2)+'/'+value.substring(2,4);
      this.value=value;
    });
  </script>
</body>
</html>
