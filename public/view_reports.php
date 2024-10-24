<?php include '../templates/header.php'; ?>
<?php include '../templates/navbar.php'; ?>

<?php
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: index.php");
    exit();
}

// Include necessary classes
require_once '../app/classes/Sale.php'; 
require_once '../app/classes/Order.php'; // Include Order class for user information
$sale = new Sale(); 

// Fetch sales data
$salesData = $sale->getAllSales(); 

?>

<div class="container">
    <h2>Sales Reports</h2>
    <p>Here you can view sales reports and analytics.</p>

    <?php if ($salesData): ?>
        <table>
            <thead>
                <tr>
                    <th>Order ID</th>
                    <th>Product Name</th>
                    <th>Quantity Sold</th>
                    <th>Sale Amount</th>
                    <th>Sale Date</th>
                    <th>User</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($salesData as $sale): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($sale['order_id']); ?></td>
                        <td><?php echo htmlspecialchars($sale['product_name']); ?></td>
                        <td><?php echo htmlspecialchars($sale['quantity']); ?></td>
                        <td>$<?php echo number_format($sale['sale_amount'], 2); ?></td>
                        <td><?php echo date("F j, Y, g:i A", strtotime($sale['sale_date'])); ?></td> <!-- Format sale date -->
                        <td><?php echo htmlspecialchars($sale['user_name'] ?? 'Unknown'); ?></td> <!-- Display user name -->
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>No sales data available.</p>
    <?php endif; ?>
</div>

<?php include '../templates/footer.php'; ?>
