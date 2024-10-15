<?php
session_start();
require_once '../app/classes/Product.php';
require_once '../app/controllers/InventoryController.php';

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: index.php"); // Redirect to homepage if not admin
    exit();
}

// Get the product ID from the URL
$product_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if ($product_id === 0) {
    echo "<div class='container'><h2>Invalid product ID.</h2></div>";
    exit();
}

$product = new Product();
$inventoryController = new InventoryController();
$productData = $product->getProductById($product_id);

if (!$productData) {
    echo "<div class='container'><h2>Product not found.</h2></div>";
    exit();
}

// Get the current stock level
$currentStock = $inventoryController->getStock($product_id);
?>

<?php include '../templates/header.php'; ?>
<?php include '../templates/navbar.php'; ?>

<div class="container">
    <h2>Edit Stock for <?php echo htmlspecialchars($productData['name']); ?></h2>
    <form action="process_edit_stock.php" method="POST">
        <div class="form-group">
            <label for="product_name">Product Name:</label>
            <input type="text" id="product_name" name="product_name" value="<?php echo htmlspecialchars($productData['name']); ?>" readonly>
        </div>
        <div class="form-group">
            <label for="current_stock">Current Stock:</label>
            <input type="number" id="current_stock" name="current_stock" value="<?php echo htmlspecialchars($currentStock); ?>" readonly>
        </div>
        <div class="form-group">
            <label for="new_stock">New Stock Quantity:</label>
            <input type="number" id="new_stock" name="new_stock" required>
        </div>
        <input type="hidden" name="product_id" value="<?php echo $product_id; ?>">
        <button type="submit" class="btn-primary">Update Stock</button>
    </form>
</div>

<?php include '../templates/footer.php'; ?>
