<?php
session_start();
require_once '../app/classes/Order.php';
require_once '../app/classes/OrderItem.php';
require_once '../app/classes/Product.php';
require_once '../app/classes/Inventory.php'; // Include Inventory class

// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Set content type to JSON
header('Content-Type: application/json');

// Check if the user is logged in and the request method is POST
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_SESSION['user_id'])) { 
    $userId = $_SESSION['user_id']; 
    $totalAmount = $_POST['total_amount'];
    $paymentMethod = $_POST['payment_method'];
    $address = $_POST['address'];

    // Validate incoming data
    if (empty($totalAmount) || empty($paymentMethod) || empty($address)) {
        echo json_encode(['success' => false, 'message' => 'All fields are required.']);
        exit();
    }

    // Create a new order
    $order = new Order();
    $orderId = $order->create($userId, 'pending', $totalAmount, $paymentMethod, $address);

    if ($orderId) {
        $orderItem = new OrderItem();
        $inventory = new Inventory(); // Create an instance of Inventory
        foreach ($_SESSION['cart'] as $productId => $quantity) {
            $product = new Product();
            $productData = $product->getProductById($productId);

            if ($productData) {
                if ($orderItem->create($orderId, $productId, $quantity, $productData['price'])) {
                    // Remove stock after successfully adding the order item
                    $inventory->removeStock($productId, $quantity);
                } else {
                    // Log error if order item creation fails
                    error_log("Failed to create order item for product ID: $productId");
                }
            }
        }
        unset($_SESSION['cart']); // Clear the cart after successful order placement
        echo json_encode(['success' => true, 'message' => 'Order placed successfully!']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to create order.']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request method or user not logged in.']);
}
?>
