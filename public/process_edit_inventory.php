<?php
session_start();
require_once '../app/controllers/InventoryController.php';

// Ensure user is an admin
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: index.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $product_id = $_POST['product_id'];
    $quantity = $_POST['quantity'];

    $inventoryController = new InventoryController();

    // Update the stock quantity
    if ($inventoryController->setStock($product_id, $quantity)) {
        $_SESSION['success'] = 'Stock updated successfully.';
    } else {
        $_SESSION['error'] = 'Failed to update stock.';
    }

    // Redirect back to the edit inventory page
    header("Location: edit_inventory.php?id=" . urlencode($product_id));
    exit();
} else {
    // If the request method is not POST, redirect to edit inventory
    header("Location: edit_inventory.php?id=" . urlencode($_GET['id']));
    exit();
}
?>
