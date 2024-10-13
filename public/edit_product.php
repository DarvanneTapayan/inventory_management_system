<?php include '../templates/header.php'; ?>
<?php include '../templates/navbar.php'; ?>
<?php
// Admin-only access check
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: index.php");
    exit();
}

require_once '../app/classes/Product.php';
$product = new Product();
$productId = $_GET['id'];
$productDetails = $product->getProductById($productId);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $updatedName = $_POST['product_name'];
    $updatedDescription = $_POST['description'];
    $updatedPrice = $_POST['price'];
    $updatedCategoryId = $_POST['category_id'];
    $updatedImageUrl = $_POST['image_url'];

    if ($product->update($productId, $updatedName, $updatedDescription, $updatedPrice, $updatedCategoryId, $updatedImageUrl)) {
        $_SESSION['success'] = "Product updated successfully.";
        header("Location: manage_products.php");
        exit();
    } else {
        $_SESSION['error'] = "Failed to update product.";
    }
}
?>

<div class="container">
    <h2>Edit Product</h2>
    <form action="" method="POST">
        <div class="form-group">
            <label for="product_name">Product Name:</label>
            <input type="text" id="product_name" name="product_name" value="<?php echo htmlspecialchars($productDetails['name']); ?>" required>
        </div>
        <div class="form-group">
            <label for="description">Description:</label>
            <textarea id="description" name="description" rows="3" required><?php echo htmlspecialchars($productDetails['description']); ?></textarea>
        </div>
        <div class="form-group">
            <label for="price">Price:</label>
            <input type="number" id="price" name="price" value="<?php echo $productDetails['price']; ?>" step="0.01" required>
        </div>
        <div class="form-group">
            <label for="category_id">Category:</label>
            <select id="category_id" name="category_id" required>
                <option value="1">Cakes</option>
                <option value="2">Pastries</option>
                <!-- Categories can be fetched dynamically from the database -->
            </select>
        </div>
        <button type="submit" class="btn-primary">Update Product</button>
    </form>
</div>

<?php include '../templates/footer.php'; ?>
