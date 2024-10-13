<?php
require_once '../app/classes/Product.php';
session_start();

// Admin-only access check
if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin' && isset($_GET['id'])) {
    $productId = $_GET['id'];
    $product = new Product();

    if ($product->delete($productId)) {
        $_SESSION['success'] = "Product deleted successfully.";
    } else {
        $_SESSION['error'] = "Failed to delete product.";
    }
    header("Location: manage_products.php");
    exit();
} else {
    header("Location: index.php");
    exit();
}
?>
