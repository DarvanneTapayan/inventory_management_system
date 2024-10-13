<?php
session_start();
include '../templates/header.php';
include '../templates/navbar.php';

require_once '../app/controllers/OrderController.php';
require_once '../app/controllers/OrderItemController.php'; // Include the OrderItemController

$orderController = new OrderController();
$orderItemController = new OrderItemController();

$orderId = $_GET['id'] ?? null; // Get the order ID from the URL

if (!$orderId) {
    echo "<div class='container'><h2>Order ID is missing.</h2></div>";
    exit();
}

// Fetch order details
$orderDetails = $orderController->getOrderDetails($orderId);

if (!$orderDetails) {
    echo "<div class='container'><h2>Order not found.</h2></div>";
    exit();
}

// Fetch order items
$orderItems = $orderItemController->getOrderItemsByOrderId($orderId);
?>

<div class="container">
    <h2>Order Details</h2>
    <p><strong>Order ID:</strong> <?php echo htmlspecialchars($orderDetails['id']); ?></p>
    <p><strong>Status:</strong> <?php echo htmlspecialchars($orderDetails['status']); ?></p>
    <p><strong>Total Amount:</strong> $<?php echo number_format($orderDetails['total_amount'], 2); ?></p>
    <p><strong>Payment Method:</strong> <?php echo htmlspecialchars($orderDetails['payment_method']); ?></p>
    <p><strong>Shipping Address:</strong> <?php echo htmlspecialchars($orderDetails['address']); ?></p>
    <p><strong>Ordered By:</strong> <?php echo htmlspecialchars($orderDetails['username']); ?> (<?php echo htmlspecialchars($orderDetails['email']); ?>)</p>

    <h3>Products in this Order</h3>
    <table>
        <thead>
            <tr>
                <th>Product Name</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($orderItems as $item): ?>
                <tr>
                    <td><?php echo htmlspecialchars($item['product_name']); ?></td>
                    <td><?php echo htmlspecialchars($item['quantity']); ?></td>
                    <td>$<?php echo number_format($item['price'], 2); ?></td>
                    <td>$<?php echo number_format($item['quantity'] * $item['price'], 2); ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php include '../templates/footer.php'; ?>
