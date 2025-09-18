<?php
session_start();

// If already logged in, go to admin.php
if (isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true) {
    header("Location: admin.php");
    exit;
}

// Hardcoded admin credentials
$adminUsername = "sashik";
$adminPassword = "sashik2005";

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    if ($username === $adminUsername && $password === $adminPassword) {
        $_SESSION['admin_logged_in'] = true;
        $_SESSION['admin_username'] = $adminUsername;
        header("Location: admin.php");
        exit;
    } else {
        $error = "Invalid username or password!";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Admin Login - GamerZone</title>
<link href="css/bootstrap-4.3.1.css" rel="stylesheet" />
<style>
body { background: #111; color: #fff; display:flex; justify-content:center; align-items:center; height:100vh; font-family:'Segoe UI',sans-serif;}
.card { background: rgba(20,20,50,0.9); padding: 30px; border-radius:10px; width: 350px; }
input { margin-bottom: 15px; }
.btn-primary { background-color:#00bfff; border:none; width:100%; }
.btn-primary:hover { background-color:#0080ff; }
</style>
</head>
<body>
<div class="card">
    <h3 class="text-center mb-4">Admin Login</h3>
    <?php if($error): ?>
        <div class="alert alert-danger"><?= $error ?></div>
    <?php endif; ?>
    <form method="POST" action="">
        <input type="text" class="form-control" name="username" placeholder="Username" required>
        <input type="password" class="form-control" name="password" placeholder="Password" required>
        <button type="submit" class="btn btn-primary">Login</button>
    </form>
</div>
</body>
</html>
