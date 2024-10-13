<?php include '../templates/header.php'; ?>
<?php include '../templates/navbar.php'; ?>
<div class="container">
    <h2>Add Stock to Inventory</h2>
    <form id="addInventoryForm" action="process_add_inventory.php" method="POST">
        <div class="form-group">
            <label for="product_id">Product:</label>
            <select id="product_id" name="product_id" required>
                <option value="">Select a product</option>
                <?php
                require_once '../app/controllers/ProductController.php';
                $productController = new ProductController();
                $products = $productController->getAllProducts();
                foreach ($products as $prod) {
                    echo "<option value='" . $prod['id'] . "'>" . htmlspecialchars($prod['name']) . "</option>";
                }
                ?>
            </select>
        </div>
        <div class="form-group">
            <label for="quantity">Quantity to Add:</label>
            <input type="number" id="quantity" name="quantity" required min="1">
        </div>
        <button type="submit" class="btn-primary">Add Stock</button>
    </form>
</div>

<?php include '../templates/footer.php'; ?>
