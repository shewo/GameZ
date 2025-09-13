<?php
session_start();

// Skip login check (direct access)
$_SESSION['admin_logged_in'] = true;

// Database connection
$conn = new mysqli("localhost", "root", "", "gamezone");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Categories
$tables = ['laptops', 'parts', 'accessories', 'gaming_consoles', 'console_games'];

// ===== ADD PRODUCT =====
if(isset($_POST['add_product'])){
    $category = $_POST['category'];
    $name = $conn->real_escape_string($_POST['name']);
    $price = $_POST['price'];
    $specs = $conn->real_escape_string($_POST['specs']);
    $image = $_FILES['image']['name'];
    $tmp_name = $_FILES['image']['tmp_name'];
    $upload_dir = "uploads/";

    if(!is_dir($upload_dir)) mkdir($upload_dir, 0755, true);

    $new_image_name = time().'_'.$image;
    move_uploaded_file($tmp_name, $upload_dir.$new_image_name);

    $conn->query("INSERT INTO $category (name, price, specs, image) VALUES ('$name','$price','$specs','$new_image_name')");
    header("Location: admin.php");
    exit;
}

// ===== DELETE PRODUCT =====
if(isset($_GET['delete_id']) && isset($_GET['category'])){
    $id = $_GET['delete_id'];
    $category = $_GET['category'];

    $result = $conn->query("SELECT image FROM $category WHERE id='$id'");
    if($row = $result->fetch_assoc()){
        $img_path = "uploads/".$row['image'];
        if(file_exists($img_path)) unlink($img_path);
    }

    $conn->query("DELETE FROM $category WHERE id='$id'");
    header("Location: admin.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Admin Panel - GamerZone</title>
<link href="css/bootstrap-4.3.1.css" rel="stylesheet" />
<style>
body {
  background-image: url('images/background1.jpg');
  background-size: cover;
  background-position: center;
  background-attachment: fixed;
  font-family: 'Segoe UI', sans-serif;
  color: white;

  /* Flex layout to push footer */
  display: flex;
  flex-direction: column;
  min-height: 100vh;
}

.container-fluid {
  flex: 1; /* Take all space, push footer down */
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
.card {
  background: rgba(20,20,50,0.9);
  padding: 30px;
  border-radius: 15px;
  margin-bottom: 30px;
  box-shadow: 0 8px 20px rgba(0,0,0,0.5);
}
form .form-group { margin-bottom:15px; }
.btn-primary { background-color:#00bfff; border:none; }
.btn-primary:hover { background-color:#0080ff; }
table { background-color: rgba(0,0,0,0.6); }
table th, table td { color: white; vertical-align: middle; }
img { border-radius:5px; }
footer {
  background-color: #111;
  width: 100%;
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
      <li class="nav-item"> <a class="nav-link" href="signup.php">SignUp</a> </li>
      <li class="nav-item"> <a class="nav-link active" href="admin.php">Admin</a> </li>
    </ul>
  </div>
</nav>

<div class="container my-5">
    <!-- Add Product Form -->
    <div class="card">
        <h3 class="text-center mb-4">Add New Product</h3>
        <form method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label>Category</label>
                <select class="form-control" name="category" required>
                    <option value="">-- Select Category --</option>
                    <option value="laptops">Laptops</option>
                    <option value="accessories">Accessories</option>
                    <option value="parts">Parts</option>
                    <option value="gaming_consoles">Gaming Consoles</option>
                    <option value="console_games">Console Games</option>
                </select>
            </div>
            <div class="form-group">
                <label>Product Name</label>
                <input type="text" class="form-control" name="name" placeholder="Enter product name" required>
            </div>
            <div class="form-group">
                <label>Price</label>
                <input type="number" class="form-control" name="price" placeholder="Enter price" step="0.01" required>
            </div>
            <div class="form-group">
                <label>Specifications</label>
                <textarea class="form-control" name="specs" placeholder="Enter product specifications"></textarea>
            </div>
            <div class="form-group">
                <label>Product Image</label>
                <input type="file" class="form-control" name="image" required>
            </div>
            <button type="submit" name="add_product" class="btn btn-primary btn-block mt-3">Add Product</button>
        </form>
    </div>

    <!-- Show Products Table -->
    <?php foreach($tables as $table): ?>
    <div class="card">
        <h4 class="mb-3"><?php echo ucfirst(str_replace('_',' ',$table)); ?> Products</h4>

        <!-- Scrollable table container -->
        <div style="max-height:400px; overflow-y:auto;">
          <table class="table table-striped table-dark">
              <thead>
                  <tr>
                      <th>ID</th>
                      <th>Name</th>
                      <th>Price</th>
                      <th>Specs</th>
                      <th>Image</th>
                      <th>Action</th>
                  </tr>
              </thead>
              <tbody>
              <?php
              $result = $conn->query("SELECT * FROM $table");
              if($result->num_rows > 0){
                  while($row = $result->fetch_assoc()){
                      echo "<tr>
                          <td>{$row['id']}</td>
                          <td>{$row['name']}</td>
                          <td>{$row['price']}</td>
                          <td>{$row['specs']}</td>
                          <td><img src='uploads/{$row['image']}' width='80'></td>
                          <td><a href='admin.php?delete_id={$row['id']}&category={$table}' class='btn btn-danger btn-sm'>Delete</a></td>
                      </tr>";
                  }
              } else {
                  echo "<tr><td colspan='6' class='text-center'>No products added yet.</td></tr>";
              }
              ?>
              </tbody>
          </table>
        </div>
    </div>
    <?php endforeach; ?>
</div>
</div>

<!-- Footer -->
<footer class="text-center text-lg-start text-white mt-auto">
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

<!-- Scripts -->
<script src="js/popper.min.js"></script>
<script src="js/jquery-3.3.1.min.js"></script>
<script src="js/bootstrap-4.3.1.js"></script>
</body>
</html>
