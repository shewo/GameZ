<?php
/**
 * Cart Session Management Functions
 * This file contains helper functions for cart management
 */

// Function to initialize the cart session
function initCartSession() {
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = array();
    }
}

// Function to get the total number of items in cart
function getCartItemCount() {
    initCartSession();
    
    $count = 0;
    if (isset($_SESSION['cart']) && is_array($_SESSION['cart'])) {
        foreach ($_SESSION['cart'] as $item) {
            $count += $item['quantity'];
        }
    }
    return $count;
}

// Function to get the total price of items in cart
function getCartTotal() {
    initCartSession();
    
    $total = 0;
    if (isset($_SESSION['cart']) && is_array($_SESSION['cart'])) {
        foreach ($_SESSION['cart'] as $item) {
            $total += $item['price'] * $item['quantity'];
        }
    }
    return $total;
}

// Function to add an item to the cart
function addToCart($id, $name, $price, $image = '', $quantity = 1) {
    initCartSession();
    
    // Check if the product is already in the cart
    if (isset($_SESSION['cart'][$id])) {
        // If so, just increase the quantity
        $_SESSION['cart'][$id]['quantity'] += $quantity;
    } else {
        // Otherwise, add it as a new item
        $_SESSION['cart'][$id] = [
            'id' => $id,
            'name' => $name,
            'price' => $price,
            'image' => $image,
            'quantity' => $quantity
        ];
    }
    
    return true;
}

// Function to update cart item quantity
function updateCartItem($id, $quantity) {
    initCartSession();
    
    if (isset($_SESSION['cart'][$id])) {
        if ($quantity > 0) {
            $_SESSION['cart'][$id]['quantity'] = $quantity;
            return true;
        } else {
            // If quantity is less than 1, remove the item
            return removeCartItem($id);
        }
    }
    
    return false;
}

// Function to remove an item from the cart
function removeCartItem($id) {
    initCartSession();
    
    if (isset($_SESSION['cart'][$id])) {
        unset($_SESSION['cart'][$id]);
        return true;
    }
    
    return false;
}

// Function to clear the entire cart
function clearCart() {
    initCartSession();
    
    $_SESSION['cart'] = array();
    return true;
}

// Function to get all cart items
function getCartItems() {
    initCartSession();
    
    return isset($_SESSION['cart']) ? $_SESSION['cart'] : array();
}

// Function to check if an item exists in the cart
function isInCart($id) {
    initCartSession();
    
    return isset($_SESSION['cart'][$id]);
}

// Function to set a flash message for cart operations
function setCartMessage($type, $message) {
    initCartSession();
    
    $_SESSION['cart_message'] = [
        'type' => $type,
        'message' => $message
    ];
}

// Function to get and clear flash message
function getCartMessage() {
    initCartSession();
    
    if (isset($_SESSION['cart_message'])) {
        $message = $_SESSION['cart_message'];
        unset($_SESSION['cart_message']);
        return $message;
    }
    
    return null;
}
?>