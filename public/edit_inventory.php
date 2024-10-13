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

// Get the product ID from the URL
$productId = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$product = $productController->getProductById($productId);
$currentStock = $inventoryController->getStock($productId);

if (!$product) {
    echo "<div class='container'><h2>Product not found.</h2></div>";
    exit();
}
?>

<div class="container">
    <h2>Edit Inventory for <?php echo htmlspecialchars($product['name']); ?></h2>
    <form id="editInventoryForm" action="process_edit_inventory.php" method="POST">
        <input type="hidden" name="product_id" value="<?php echo $productId; ?>">
        <div class="form-group">
            <label for="quantity">Current Quantity in Stock:</label>
            <input type="number" id="quantity" name="quantity" value="<?php echo htmlspecialchars($currentStock); ?>" required min="0">
        </div>
        <button type="submit" class="btn-primary">Update Stock</button>
    </form>
</div>

<?php include '../templates/footer.php'; ?>
