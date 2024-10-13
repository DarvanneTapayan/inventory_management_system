<?php
// public/process_add_product.php
session_start();
require_once '../app/controllers/ProductController.php';
require_once '../app/controllers/InventoryController.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['product_name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $category_id = $_POST['category_id'];
    $image_url = $_POST['image_url'];

    $productController = new ProductController();
    $inventoryController = new InventoryController();
    
    // Create the product and get the new product ID
    $productId = $productController->create($name, $description, $price, $category_id, $image_url);

    if ($productId) {
        // Check if inventory entry exists; if not, create one
        if (!$inventoryController->getStock($productId)) {
            $inventoryController->insertStock($productId); // Initialize stock with zero
        }
        echo json_encode(['success' => true, 'message' => 'Product and stock added successfully.']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to add product.']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request method.']);
}

?>
