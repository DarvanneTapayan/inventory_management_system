<?php
session_start();
require_once '../app/classes/Product.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $productId = $_POST['product_id'];
    $quantity = $_POST['quantity'];

    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }

    // Check if the product exists and the quantity is valid
    if ($quantity <= 0) {
        echo json_encode(['success' => false, 'message' => 'Quantity must be greater than zero.']);
        exit();
    }

    if (isset($_SESSION['cart'][$productId])) {
        $_SESSION['cart'][$productId] += $quantity; // Increase quantity if already in cart
    } else {
        $_SESSION['cart'][$productId] = $quantity; // Add new product to cart
    }

    // Return a JSON response
    echo json_encode(['success' => true, 'message' => 'Product added to cart.']);
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request method.']);
}
?>
