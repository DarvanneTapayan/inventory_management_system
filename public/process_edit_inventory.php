<!-- public/process_edit_inventory.php -->
<?php
session_start();
require_once '../app/controllers/InventoryController.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $product_id = $_POST['product_id'];
    $quantity = $_POST['quantity'];

    $inventoryController = new InventoryController();
    
    // Check if the quantity is valid
    if ($quantity < 0) {
        echo json_encode(['success' => false, 'message' => 'Quantity cannot be negative.']);
        exit();
    }

    // Update the inventory
    if ($inventoryController->addStock($product_id, $quantity)) {
        echo json_encode(['success' => true, 'message' => 'Stock updated successfully.']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to update stock.']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request method.']);
}
?>
