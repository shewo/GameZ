<?php
// Start the session to access cart data
session_start();

// Initialize the cart array if it doesn't exist
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = array();
}

// Add product to cart
if (isset($_POST['add_to_cart'])) {
    $product_id = isset($_POST['product_id']) ? $_POST['product_id'] : '';
    $product_name = isset($_POST['product_name']) ? $_POST['product_name'] : '';
    $product_price = isset($_POST['product_price']) ? (float)$_POST['product_price'] : 0;
    $product_image = isset($_POST['product_image']) ? $_POST['product_image'] : '';
    $product_quantity = isset($_POST['quantity']) ? (int)$_POST['quantity'] : 1;
    
    // Validate required data
    if (empty($product_id) || empty($product_name) || empty($product_price)) {
        // Set error message in session
        $_SESSION['cart_message'] = [
            'type' => 'danger',
            'message' => 'Failed to add product to cart. Missing required product information.'
        ];
        // Redirect back to previous page
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit;
    }
    
    // Check if the product is already in the cart
    if (isset($_SESSION['cart'][$product_id])) {
        // If so, just increase the quantity
        $_SESSION['cart'][$product_id]['quantity'] += $product_quantity;
    } else {
        // Otherwise, add it as a new item
        $_SESSION['cart'][$product_id] = [
            'id' => $product_id,
            'name' => $product_name,
            'price' => $product_price,
            'image' => $product_image,
            'quantity' => $product_quantity
        ];
    }
    
    // Set success message
    $_SESSION['cart_message'] = [
        'type' => 'success',
        'message' => 'Product successfully added to cart!'
    ];
    
    // Redirect back to previous page
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit;
}

// Update product quantity in cart
if (isset($_POST['update'])) {
    $product_id = $_POST['update'];
    
    if (isset($_POST['quantity'][$product_id]) && isset($_SESSION['cart'][$product_id])) {
        $new_quantity = (int)$_POST['quantity'][$product_id];
        
        if ($new_quantity > 0) {
            $_SESSION['cart'][$product_id]['quantity'] = $new_quantity;
            $_SESSION['cart_message'] = [
                'type' => 'success',
                'message' => 'Cart updated successfully!'
            ];
        } else {
            // If quantity is less than 1, remove the item
            unset($_SESSION['cart'][$product_id]);
            $_SESSION['cart_message'] = [
                'type' => 'info',
                'message' => 'Item removed from cart.'
            ];
        }
    }
    
    // Redirect back to cart page
    header('Location: cart.php');
    exit;
}

// Remove product from cart
if (isset($_POST['remove'])) {
    $product_id = $_POST['remove'];
    
    if (isset($_SESSION['cart'][$product_id])) {
        unset($_SESSION['cart'][$product_id]);
        $_SESSION['cart_message'] = [
            'type' => 'info',
            'message' => 'Item removed from cart.'
        ];
    }
    
    // Redirect back to cart page
    header('Location: cart.php');
    exit;
}

// Clear entire cart
if (isset($_POST['clear_cart'])) {
    $_SESSION['cart'] = array();
    $_SESSION['cart_message'] = [
        'type' => 'info',
        'message' => 'Your cart has been cleared.'
    ];
    
    // Redirect back to cart page
    header('Location: cart.php');
    exit;
}

// If no action was recognized, redirect to cart page
header('Location: cart.php');
exit;
?>