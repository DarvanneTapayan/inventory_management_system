<?php 
session_start(); 
require_once '../app/controllers/OrderController.php'; 

if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}

$orderId = isset($_GET['id']) ? intval($_GET['id']) : 0;
$orderController = new OrderController();
$orderDetails = $orderController->getOrderDetails($orderId);

if (!$orderDetails) {
    echo "<div class='container'><h2>Order not found.</h2></div>";
    exit();
}

require_once '../app/controllers/OrderItemController.php';
$orderItemController = new OrderItemController();
$orderItems = $orderItemController->getOrderItems($orderId);

$totalAmount = 0;
?>

<?php include '../templates/header.php'; ?>
<?php include '../templates/navbar.php'; ?>

<div class="container">
    <h2>Order Confirmation</h2>
    <h3>Order ID: <?php echo htmlspecialchars($orderId); ?></h3>
    <p>Status: <?php echo htmlspecialchars($orderDetails['status']); ?></p>
    <p>Total Amount: $<?php echo number_format($orderDetails['total_amount'], 2); ?></p>
    <p>Payment Method: <?php echo htmlspecialchars($orderDetails['payment_method']); ?></p>
    <p>Shipping Address: <?php echo htmlspecialchars($orderDetails['address']); ?></p>

    <h3>Items Ordered</h3>
    <ul>
        <?php foreach ($orderItems as $item): 
            $itemTotal = $item['quantity'] * $item['price'];
            $totalAmount += $itemTotal; ?>
            <li><?php echo htmlspecialchars($item['product_name']) . " x " . $item['quantity'] . " - $" . number_format($itemTotal, 2); ?></li>
        <?php endforeach; ?>
    </ul>

    <p>Thank you for your order!</p>
    <a href="index.php" class="btn-primary">Return to Home</a>
</div>

<?php include '../templates/footer.php'; ?>
