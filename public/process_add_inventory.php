<?php
session_start();
require_once '../app/controllers/InventoryController.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $product_id = $_POST['product_id'];
    $quantity = $_POST['quantity'];

    $inventoryController = new InventoryController();
    if ($inventoryController->addStock($product_id, $quantity)) {
        echo json_encode(['success' => true, 'message' => 'Stock added successfully.']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to add stock.']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request method.']);
}
?>
