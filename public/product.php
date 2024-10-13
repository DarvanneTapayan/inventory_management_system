<!-- public/product.php -->
<?php include '../templates/header.php'; ?>
<?php include '../templates/navbar.php'; ?>
<?php
require_once '../app/classes/Product.php';
require_once '../app/controllers/InventoryController.php'; // Include InventoryController

$product = new Product();
$inventoryController = new InventoryController(); // Create an instance of InventoryController
$products = $product->getAll(); // Fetch all products

if (!$products) {
    echo "<div class='container'><h2>No products available</h2></div>";
    exit();
}
?>

<div class="container">
    <h2>All Products</h2>
    <div class="product-grid">
        <?php foreach ($products as $prod): ?>
            <div class="product-card">
                <img src="<?php echo htmlspecialchars($prod['image_url'] ?? 'default_image.jpg'); ?>" alt="<?php echo htmlspecialchars($prod['name'] ?? 'Product Name'); ?>">
                <h3><?php echo htmlspecialchars($prod['name']); ?></h3>
                <p><?php echo htmlspecialchars($prod['description']); ?></p>
                <p class="price">$<?php echo number_format($prod['price'], 2); ?></p>

                <!-- Fetch the stock level dynamically -->
                <p class="stock">Quantity in Stock: <?php echo htmlspecialchars($inventoryController->getStock($prod['id'])); ?></p> <!-- Display stock -->

                <form action="add_to_cart.php" method="POST">
                    <input type="hidden" name="product_id" value="<?php echo $prod['id']; ?>">
                    <div class="form-group">
                        <label for="quantity">Quantity:</label>
                        <input type="number" id="quantity" name="quantity" value="1" min="1" required>
                    </div>
                    <button type="submit" class="btn-secondary">Add to Cart</button>
                </form>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<?php include '../templates/footer.php'; ?>
