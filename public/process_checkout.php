<!-- public/process_checkout.php -->
<?php
require_once '../app/classes/Order.php';
require_once '../app/classes/OrderItem.php';
session_start();

// Set content type to JSON
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_SESSION['username'])) {
    $userId = $_SESSION['username'];
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
        foreach ($_SESSION['cart'] as $productId => $quantity) {
            $product = new Product();
            $productData = $product->getProductById($productId); // Fetch product details for order items

            if ($productData) {
                $orderItem = new OrderItem();
                $orderItem->addOrderItem($orderId, $productId, $quantity, $productData['price']);
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
