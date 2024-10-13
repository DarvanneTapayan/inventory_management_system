<!-- public/manage_products.php -->
<?php include '../templates/header.php'; ?>
<?php include '../templates/navbar.php'; ?>
<?php
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: index.php");
    exit();
}

require_once '../app/controllers/ProductController.php';
require_once '../app/controllers/InventoryController.php'; // Include InventoryController
$productController = new ProductController();
$inventoryController = new InventoryController(); // Create an instance of InventoryController
$products = $productController->getAllProducts(); // Fetch all products
?>

<div class="container">
    <h2>Manage Products</h2>
    <form id="addProductForm" action="process_add_product.php" method="POST">
        <h3>Add New Product</h3>
        <div class="form-group">
            <label for="product_name">Product Name:</label>
            <input type="text" id="product_name" name="product_name" required>
        </div>
        <div class="form-group">
            <label for="description">Description:</label>
            <textarea id="description" name="description" rows="3" required></textarea>
        </div>
        <div class="form-group">
            <label for="price">Price:</label>
            <input type="number" id="price" name="price" step="0.01" required>
        </div>
        <div class="form-group">
            <label for="category_id">Category:</label>
            <select id="category_id" name="category_id" required>
                <option value="">Select a category</option>
                <?php
                require_once '../app/classes/Category.php';
                $category = new Category();
                $categories = $category->getAll();
                foreach ($categories as $cat) {
                    echo "<option value='" . $cat['id'] . "'>" . htmlspecialchars($cat['name']) . "</option>";
                }
                ?>
            </select>
        </div>
        <div class="form-group">
            <label for="image_url">Image URL:</label>
            <input type="text" id="image_url" name="image_url" required>
        </div>
        <button type="submit" class="btn-primary">Add Product</button>
    </form>

    <h3>Existing Products</h3>
    <table>
        <thead>
            <tr>
                <th>Product Name</th>
                <th>Description</th> <!-- Added description column -->
                <th>Price</th> <!-- Added price column -->
                <th>Quantity in Stock</th> <!-- New column for stock -->
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($products as $prod): ?>
                <tr>
                    <td><?php echo htmlspecialchars($prod['name']); ?></td>
                    <td><?php echo htmlspecialchars($prod['description']); ?></td> <!-- Display product description -->
                    <td>$<?php echo number_format($prod['price'], 2); ?></td> <!-- Display product price -->
                    <td>
                        <?php 
                        // Fetching stock dynamically
                        $stock = $inventoryController->getStock($prod['id']); 
                        echo htmlspecialchars($stock);
                        ?>
                    </td>
                    <td>
                        <a href="edit_product.php?id=<?php echo $prod['id']; ?>" class="btn-secondary">Edit</a>
                        <a href="delete_product.php?id=<?php echo $prod['id']; ?>" class="btn-secondary" onclick='return confirm("Are you sure you want to delete this product?");'>Delete</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php include '../templates/footer.php'; ?>
