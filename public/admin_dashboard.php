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
    <p>Welcome to the Admin Dashboard. Here you can manage various aspects of the inventory management system. Select an option below to proceed:</p>

    <div class="dashboard-links">
        <div class="dashboard-card">
            <a href="manage_products.php" class="btn-secondary">Manage Products</a>
            <p>View, add, edit, or delete products in the inventory.</p>
        </div>

        <div class="dashboard-card">
            <a href="manage_categories.php" class="btn-secondary">Manage Categories</a>
            <p>Organize and categorize products for easier navigation.</p>
        </div>

        <div class="dashboard-card">
            <a href="manage_users.php" class="btn-secondary">Manage Users</a>
            <p>View user accounts, adjust roles, and manage user permissions.</p>
        </div>

        <div class="dashboard-card">
            <a href="manage_inventory.php" class="btn-secondary">Manage Inventory</a>
            <p>Keep track of stock levels, add new stock, or remove items from the inventory.</p>
        </div>

        <div class="dashboard-card">
            <a href="manage_orders.php" class="btn-secondary">Manage Orders</a>
            <p>Review and manage customer orders, update their statuses, and handle cancellations.</p>
        </div>

        <div class="dashboard-card">
            <a href="view_reports.php" class="btn-secondary">View Reports</a>
            <p>Access reports and analytics related to sales, inventory, and user activities.</p>
        </div>
    </div>
</div>

<?php include '../templates/footer.php'; ?>
