<?php include '../templates/header.php'; ?>
<?php include '../templates/navbar.php'; ?>
<?php
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: index.php");
    exit();
}
?>

<div class="container">
    <h2>Admin Dashboard</h2>
    <div class="dashboard-links">
        <a href="manage_products.php" class="btn-secondary">Manage Products</a>
        <a href="manage_categories.php" class="btn-secondary">Manage Categories</a>
        <a href="manage_users.php" class="btn-secondary">Manage Users</a>
        <a href="manage_inventory.php" class="btn-secondary">Manage Inventory</a>
        <a href="manage_orders.php" class="btn-secondary">Manage Orders</a>
        <a href="view_reports.php" class="btn-secondary">View Reports</a>
    </div>
</div>

<?php include '../templates/footer.php'; ?>
