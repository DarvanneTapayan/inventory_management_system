<!-- public/manage_inventory.php -->
<?php include '../templates/header.php'; ?>
<?php include '../templates/navbar.php'; ?>
<?php
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: index.php");
    exit();
}

require_once '../app/controllers/ProductController.php';
require_once '../app/controllers/InventoryController.php';

$productController = new ProductController();
$inventoryController = new InventoryController();
$products = $productController->getAllProducts(); // Fetch all products
?>

<div class="container">
    <h2>Manage Inventory</h2>
    <h3>Current Inventory</h3>
    <table>
        <thead>
            <tr>
                <th>Product Name</th>
                <th>Quantity in Stock</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($products as $prod): ?>
                <tr>
                    <td><?php echo htmlspecialchars($prod['name']); ?></td>
                    <td><?php echo htmlspecialchars($inventoryController->getStock($prod['id'])); ?></td> <!-- Dynamically fetching stock -->
                    <td>
                        <a href="edit_inventory.php?id=<?php echo $prod['id']; ?>" class="btn-secondary">Edit Stock</a>
                        <a href="delete_inventory.php?id=<?php echo $prod['id']; ?>" class="btn-secondary" onclick='return confirm("Are you sure you want to delete this item?");'>Delete</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <a href="add_inventory.php" class="btn-primary">Add New Item</a>
</div>

<?php include '../templates/footer.php'; ?>
