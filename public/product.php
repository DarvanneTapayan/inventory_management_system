<!-- public/product.php -->
<?php include '../templates/header.php'; ?>
<?php include '../templates/navbar.php'; ?>
<?php
require_once '../app/classes/Product.php';
require_once '../app/controllers/InventoryController.php'; // Include InventoryController
require_once '../app/classes/Category.php'; // Include Category class

$product = new Product();
$inventoryController = new InventoryController(); // Create an instance of InventoryController
$category = new Category(); // Create an instance of Category
$categories = $category->getAll(); // Fetch all categories

// Get the category_id from the URL
$categoryId = isset($_GET['category_id']) ? (int)$_GET['category_id'] : null;

// Fetch all products or filter by category
if ($categoryId) {
    $products = $product->getProductsByCategory($categoryId); // Fetch products by category
} else {
    $products = $product->getAll(); // Fetch all products if no category is specified
}

if (!$products) {
    echo "<div class='container'><h2>No products available</h2></div>";
    exit();
}
?>

<div class="container">
    <h2>All Products</h2>
    <?php if ($categoryId): ?>
        <?php foreach ($categories as $cat): ?>
            <?php if ($cat['id'] == $categoryId): ?> <!-- Display only the selected category name -->
                <h3><?php echo htmlspecialchars($cat['name']); ?></h3>
            <?php endif; ?>
        <?php endforeach; ?>
    <?php else: ?>
        <h3>All Products</h3> <!-- When no category is selected -->
    <?php endif; ?>

    <div class="product-grid">
        <?php foreach ($products as $prod): 
            $stock = $inventoryController->getStock($prod['id']); // Fetch stock level
        ?>
            <div class="product-card">
                <img src="<?php echo htmlspecialchars($prod['image_url'] ?? 'default_image.jpg'); ?>" alt="<?php echo htmlspecialchars($prod['name'] ?? 'Product Name'); ?>">
                <h4><?php echo htmlspecialchars($prod['name']); ?></h4>
                <p><?php echo htmlspecialchars($prod['description']); ?></p>
                <p class="price">$<?php echo number_format($prod['price'], 2); ?></p>
                <p class="stock">Quantity in Stock: <?php echo htmlspecialchars($stock); ?></p> <!-- Display stock -->

                <?php if ($stock > 0): ?>
                    <form action="add_to_cart.php" method="POST">
                        <input type="hidden" name="product_id" value="<?php echo $prod['id']; ?>">
                        <div class="form-group">
                            <label for="quantity">Quantity:</label>
                            <input type="number" id="quantity" name="quantity" value="1" min="1" max="<?php echo htmlspecialchars($stock); ?>" required>
                        </div>
                        <button type="submit" class="btn-secondary">Add to Cart</button>
                    </form>
                <?php else: ?>
                    <p class="out-of-stock">This product is currently out of stock.</p>
                <?php endif; ?>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<?php include '../templates/footer.php'; ?>
