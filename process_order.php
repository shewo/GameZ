<?php
// Include the cart functions
require_once 'cart_functions.php';

// Initialize cart session
initCartSession();

// Check if form was submitted
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: cart.php");
    exit();
}

// Get cart items
$cartItems = getCartItems();
$cartTotal = getCartTotal();

// Check if cart is empty
if (empty($cartItems)) {
    header("Location: cart.php");
    exit();
}

// Get form data
$firstName = htmlspecialchars($_POST['firstName'] ?? '');
$lastName = htmlspecialchars($_POST['lastName'] ?? '');
$email = htmlspecialchars($_POST['email'] ?? '');
$phone = htmlspecialchars($_POST['phone'] ?? '');
$address = htmlspecialchars($_POST['address'] ?? '');
$city = htmlspecialchars($_POST['city'] ?? '');
$postalCode = htmlspecialchars($_POST['postalCode'] ?? '');
$country = htmlspecialchars($_POST['country'] ?? '');
$cardName = htmlspecialchars($_POST['cardName'] ?? '');
$cardNumber = htmlspecialchars($_POST['cardNumber'] ?? '');
$expiry = htmlspecialchars($_POST['expiry'] ?? '');
$cvv = htmlspecialchars($_POST['cvv'] ?? '');

// Basic validation
if (empty($firstName) || empty($lastName) || empty($email) || empty($phone) || 
    empty($address) || empty($city) || empty($postalCode) || empty($country) ||
    empty($cardName) || empty($cardNumber) || empty($expiry) || empty($cvv)) {
    
    setCartMessage("Please fill in all required fields.", "error");
    header("Location: checkout.php");
    exit();
}

// Calculate totals
$taxAmount = $cartTotal * 0.15;
$totalAmount = $cartTotal + $taxAmount;

// Generate order ID
$orderId = 'GZ' . date('Ymd') . rand(1000, 9999);

// In a real application, you would:
// 1. Process the payment with a payment gateway
// 2. Save the order to database
// 3. Send confirmation emails
// 4. Update inventory

// For now, we'll just simulate a successful order
try {
    // Connect to database
    $conn = new mysqli("localhost", "root", "", "gamezone");
    
    if ($conn->connect_error) {
        throw new Exception("Database connection failed: " . $conn->connect_error);
    }
    
    // Create orders table if it doesn't exist
    $createTable = "CREATE TABLE IF NOT EXISTS orders (
        id INT AUTO_INCREMENT PRIMARY KEY,
        order_id VARCHAR(50) UNIQUE NOT NULL,
        customer_name VARCHAR(255) NOT NULL,
        email VARCHAR(255) NOT NULL,
        phone VARCHAR(50) NOT NULL,
        address TEXT NOT NULL,
        city VARCHAR(100) NOT NULL,
        postal_code VARCHAR(20) NOT NULL,
        country VARCHAR(100) NOT NULL,
        subtotal DECIMAL(10,2) NOT NULL,
        tax_amount DECIMAL(10,2) NOT NULL,
        total_amount DECIMAL(10,2) NOT NULL,
        order_status VARCHAR(50) DEFAULT 'pending',
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )";
    
    if (!$conn->query($createTable)) {
        throw new Exception("Error creating orders table: " . $conn->error);
    }
    
    // Insert order
    $stmt = $conn->prepare("INSERT INTO orders (order_id, customer_name, email, phone, address, city, postal_code, country, subtotal, tax_amount, total_amount) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    
    if (!$stmt) {
        throw new Exception("Prepare failed: " . $conn->error);
    }
    
    $customerName = $firstName . ' ' . $lastName;
    $fullAddress = $address . ', ' . $city . ', ' . $postalCode;
    
    $stmt->bind_param("ssssssssddd", $orderId, $customerName, $email, $phone, $fullAddress, $city, $postalCode, $country, $cartTotal, $taxAmount, $totalAmount);
    
    if (!$stmt->execute()) {
        throw new Exception("Execute failed: " . $stmt->error);
    }
    
    // Create order_items table if it doesn't exist
    $createItemsTable = "CREATE TABLE IF NOT EXISTS order_items (
        id INT AUTO_INCREMENT PRIMARY KEY,
        order_id VARCHAR(50) NOT NULL,
        product_name VARCHAR(255) NOT NULL,
        product_price DECIMAL(10,2) NOT NULL,
        quantity INT NOT NULL,
        product_image VARCHAR(255),
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        FOREIGN KEY (order_id) REFERENCES orders(order_id)
    )";
    
    if (!$conn->query($createItemsTable)) {
        throw new Exception("Error creating order_items table: " . $conn->error);
    }
    
    // Insert order items
    $itemStmt = $conn->prepare("INSERT INTO order_items (order_id, product_name, product_price, quantity, product_image) VALUES (?, ?, ?, ?, ?)");
    
    if (!$itemStmt) {
        throw new Exception("Prepare failed for items: " . $conn->error);
    }
    
    foreach ($cartItems as $item) {
        $itemStmt->bind_param("ssdis", $orderId, $item['name'], $item['price'], $item['quantity'], $item['image']);
        if (!$itemStmt->execute()) {
            throw new Exception("Execute failed for item: " . $itemStmt->error);
        }
    }
    
    $stmt->close();
    $itemStmt->close();
    $conn->close();
    
    // Clear the cart
    clearCart();
    
    // Set success message
    setCartMessage("Order placed successfully! Your order ID is: " . $orderId, "success");
    
    // Redirect to success page
    header("Location: order_success.php?order_id=" . $orderId);
    exit();
    
} catch (Exception $e) {
    // Log error and redirect with error message
    error_log("Order processing error: " . $e->getMessage());
    setCartMessage("There was an error processing your order. Please try again.", "error");
    header("Location: checkout.php");
    exit();
}
?>