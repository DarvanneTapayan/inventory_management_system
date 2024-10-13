<?php include '../templates/header.php'; ?>
<?php include '../templates/navbar.php'; ?>
<?php
// Admin-only access check
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: index.php");
    exit();
}

require_once '../app/classes/Category.php';
$category = new Category();
$categoryId = $_GET['id'];
$categoryDetails = $category->getCategoryById($categoryId);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $updatedName = $_POST['category_name'];
    $updatedDescription = $_POST['description'];

    if ($category->update($categoryId, $updatedName, $updatedDescription)) {
        $_SESSION['success'] = "Category updated successfully.";
        header("Location: manage_categories.php");
        exit();
    } else {
        $_SESSION['error'] = "Failed to update category.";
    }
}
?>

<div class="container">
    <h2>Edit Category</h2>
    <form action="" method="POST">
        <div class="form-group">
            <label for="category_name">Category Name:</label>
            <input type="text" id="category_name" name="category_name" value="<?php echo htmlspecialchars($categoryDetails['name']); ?>" required>
        </div>
        <div class="form-group">
            <label for="description">Description:</label>
            <textarea id="description" name="description" rows="3" required><?php echo htmlspecialchars($categoryDetails['description']); ?></textarea>
        </div>
        <button type="submit" class="btn-primary">Update Category</button>
    </form>
</div>

<?php include '../templates/footer.php'; ?>
