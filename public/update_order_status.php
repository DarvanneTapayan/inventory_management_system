<?php
session_start();

// Include required classes
require_once '../app/controllers/OrderController.php';
require_once '../app/controllers/OrderItemController.php';
require_once '../app/controllers/InventoryController.php';

// Instantiate controllers
$orderController = new OrderController();
$orderItemController = new OrderItemController();
$inventoryController = new InventoryController();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the order ID and new status from the form submission
    $orderId = $_POST['order_id'];
    $newStatus = $_POST['status'];

    // Retrieve current order details
    $orderDetails = $orderController->getOrderDetails($orderId);

    if ($orderDetails) {
        if ($newStatus === 'canceled') {
            // Set order to canceled
            $orderController->updateOrderStatus($orderId, 'canceled');

            // Restore stock for each product in the order
            $orderItems = $orderItemController->getOrderItems($orderId);
            foreach ($orderItems as $item) {
                $inventoryController->addStock($item['product_id'], $item['quantity']); // Restore stock
            }
            $_SESSION['success'] = "Order has been canceled and stock updated.";
        } elseif ($newStatus === 'pending') {
            // Get the current order items to adjust stock levels
            $orderItems = $orderItemController->getOrderItems($orderId);
            
            // Set order back to pending
            $orderController->updateOrderStatus($orderId, 'pending');

            // Decrease stock for each product in the order since it's going back to pending
            foreach ($orderItems as $item) {
                $inventoryController->removeStock($item['product_id'], $item['quantity']); // Decrease stock
            }
            $_SESSION['success'] = "Order status updated to pending and stock adjusted.";
        } elseif (in_array($newStatus, ['processing', 'delivering', 'delivered'])) {
            // For these statuses, simply update the order status without changing stock
            $orderController->updateOrderStatus($orderId, $newStatus);
            $_SESSION['success'] = "Order status updated to " . ucfirst($newStatus) . ".";
        }

        // Redirect to manage orders page
        header("Location: manage_orders.php");
        exit();
    } else {
        $_SESSION['error'] = "Order not found.";
        header("Location: manage_orders.php");
        exit();
    }
} else {
    $_SESSION['error'] = "Invalid request method.";
    header("Location: manage_orders.php");
    exit();
}
?>
