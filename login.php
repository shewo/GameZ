<?php
// login.php
session_start();
require 'db.php'; // MySQL connection

$error = '';

if(isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if(empty($username) || empty($password)) {
        $error = "Please fill all fields!";
    } else {
        $stmt = $conn->prepare("SELECT * FROM users WHERE username = ? LIMIT 1");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if($result->num_rows == 1) {
            $user = $result->fetch_assoc();
            if(password_verify($password, $user['password'])) {
                $_SESSION['username'] = $user['username'];
                $_SESSION['user_id'] = $user['id'];
                header("Location: web1.php"); // Redirect to homepage
                exit;
            } else {
                $error = "Invalid username or password!";
            }
        } else {
            $error = "Invalid username or password!";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login - GamingZone</title>
  <link href="css/bootstrap-4.3.1.css" rel="stylesheet">
  <style>
    body {
      background-image: url('images/background1.jpg');
      background-size: cover;
      background-position: center;
      background-attachment: fixed;
      font-family: 'Segoe UI', sans-serif;
    }
    .login-container {
      max-width: 400px;
      margin: 100px auto;
      padding: 30px;
      background-color: rgba(10, 10, 30, 0.9); /* same as navbar */
      border-radius: 15px;
      color: #ffffff;
      box-shadow: 0 8px 20px rgba(0,0,0,0.7);
    }
    .login-container h2 {
      text-align: center;
      margin-bottom: 30px;
      color: #00ffff;
      text-shadow: 0 0 10px #00ffff;
    }
    .form-control {
      background-color: rgba(34,34,34,0.9); /* same as search bar */
      border: 1px solid #444;
      color: #fff;
    }
    .form-control:focus {
      background-color: rgba(34,34,34,1);
      color: #fff;
      box-shadow: none;
    }
    .btn-primary {
      width: 100%;
      background-color: #00bfff;
      border: none;
    }
    .btn-primary:hover {
      background-color: #0080ff;
    }
    .error {
      color: #ff6b6b;
      margin-bottom: 15px;
      text-align: center;
    }
    a {
      color: #00ffff;
    }
    a:hover {
      color: #00bfff;
    }
  </style>
</head>
<body>

<div class="login-container">
  <h2>Login to GamerZone</h2>
  <?php if($error != '') { echo '<div class="error">'.$error.'</div>'; } ?>
  <form action="" method="POST">
    <div class="form-group">
      <label>Username</label>
      <input type="text" name="username" class="form-control" placeholder="Enter username" required>
    </div>
    <div class="form-group">
      <label>Password</label>
      <input type="password" name="password" class="form-control" placeholder="Enter password" required>
    </div>
    <button type="submit" name="login" class="btn btn-primary">Login</button>
    <p class="mt-3 text-center">Don't have an account? <a href="register.php">Register</a></p>
  </form>
</div>

<script src="js/jquery-3.3.1.min.js"></script>
<script src="js/popper.min.js"></script>
<script src="js/bootstrap-4.3.1.js"></script>
</body>
</html>
