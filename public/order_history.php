<?php
include '../templates/header.php'; 
include '../templates/navbar.php'; 

require_once '../app/controllers/OrderController.php';

$orderController = new OrderController();

// Ensure the user is logged in
if (!isset($_SESSION['user_id'])) {
    echo "<div class='container'><h2>You must be logged in to view your order history.</h2></div>";
    exit();
}

// Get the user's orders
$userId = $_SESSION['user_id'];
$userOrders = $orderController->getUserOrders($userId);
?>

<div class="container">
    <h2>Your Order History</h2>
    <?php if (!empty($userOrders)): ?>
        <table>
            <thead>
                <tr>
                    <th>Order ID</th>
                    <th>Status</th>
                    <th>Total Amount</th>
                    <th>Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($userOrders as $order): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($order['id']); ?></td>
                        <td><?php echo htmlspecialchars($order['status']); ?></td>
                        <td>$<?php echo number_format($order['total_amount'], 2); ?></td>
                        <td><?php echo date('F j, Y, g:i a', strtotime($order['created_at'])); ?></td> <!-- Format date -->
                        <td>
                            <a class="btn-primary" href="order_details.php?id=<?php echo htmlspecialchars($order['id']); ?>">View Details</a>
                            <?php if ($order['status'] === 'pending'): // Check if the order can be canceled ?>
                                | <a class="btn-primary" href="cancel_order.php?id=<?php echo htmlspecialchars($order['id']); ?> ">Cancel Order</a>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>You have no orders in your history.</p>
    <?php endif; ?>
</div>

<?php include '../templates/footer.php'; ?>
