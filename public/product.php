<?php include '../templates/header.php'; ?>
<?php include '../templates/navbar.php'; ?>
<?php
require_once '../app/classes/Product.php';
require_once '../app/controllers/InventoryController.php'; 
require_once '../app/classes/Category.php'; 

$product = new Product();
$inventoryController = new InventoryController(); 
$category = new Category(); 
$categories = $category->getAll(); 

$categoryId = isset($_GET['category_id']) ? (int)$_GET['category_id'] : null;

if ($categoryId) {
    $products = $product->getProductsByCategory($categoryId); 
} else {
    $products = $product->getAll(); 
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
            <?php if ($cat['id'] == $categoryId): ?>
                <h3><?php echo htmlspecialchars($cat['name']); ?></h3>
            <?php endif; ?>
        <?php endforeach; ?>
    <?php else: ?>
        <h3>All Products</h3>
    <?php endif; ?>

    <div class="product-grid">
        <?php foreach ($products as $prod): 
            $stock = $inventoryController->getStock($prod['id']); 
        ?>
            <div class="product-card">
                <img src="<?php echo htmlspecialchars($prod['image_url'] ?? 'default_image.jpg'); ?>" alt="<?php echo htmlspecialchars($prod['name'] ?? 'Product Name'); ?>">
                <h4><?php echo htmlspecialchars($prod['name']); ?></h4>
                <p><?php echo htmlspecialchars($prod['description']); ?></p>
                <p class="price">$<?php echo number_format($prod['price'], 2); ?></p>
                <p class="stock">Quantity in Stock: <?php echo htmlspecialchars($stock); ?></p>

                <?php if ($stock > 0): ?>
                    <form class='add-to-cart-form' onsubmit='event.preventDefault(); ajaxSubmitForm(this);' action='process_add_to_cart.php' method='POST'>
                        <input type='hidden' name='product_id' value='<?php echo $prod['id']; ?>'>
                        <div class='form-group'>
                            <label for='quantity'>Quantity:</label>
                            <input type='number' id='quantity' name='quantity' value='1' min='1' max='<?php echo htmlspecialchars($stock); ?>' required>
                        </div>
                        <button type='submit' class='btn-secondary'>Add to Cart</button>
                    </form>
                <?php else: ?>
                    <p class="out-of-stock">This product is currently out of stock.</p>
                <?php endif; ?>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<script src="../public/js/ajax.js"></script>
<script src="../public/js/notifications.js"></script>

<?php include '../templates/footer.php'; ?>
