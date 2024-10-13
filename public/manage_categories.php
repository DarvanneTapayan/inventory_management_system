<?php include '../templates/header.php'; ?>
<?php include '../templates/navbar.php'; ?>
<?php
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: index.php");
    exit();
}
?>

<div class="container">
    <h2>Manage Categories</h2>
    <form id="addCategoryForm" action="process_add_category.php" method="POST">
        <h3>Add New Category</h3>
        <div class="form-group">
            <label for="category_name">Category Name:</label>
            <input type="text" id="category_name" name="category_name" required>
        </div>
        <div class="form-group">
            <label for="description">Description:</label>
            <textarea id="description" name="description" rows="3" required></textarea>
        </div>
        <button type="submit" class="btn-primary">Add Category</button>
    </form>

    <h3>Existing Categories</h3>
    <table>
        <thead>
            <tr>
                <th>Category Name</th>
                <th>Description</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            require_once '../app/classes/Category.php';
            $category = new Category();
            $categories = $category->getAll();

            foreach ($categories as $cat) {
                echo "<tr>
                        <td>" . htmlspecialchars($cat['name']) . "</td>
                        <td>" . htmlspecialchars($cat['description']) . "</td>
                        <td>
                            <a href='edit_category.php?id=" . $cat['id'] . "' class='btn-secondary'>Edit</a>
                            <a href='delete_category.php?id=" . $cat['id'] . "' class='btn-secondary' onclick='return confirm(\"Are you sure you want to delete this category?\");'>Delete</a>
                        </td>
                    </tr>";
            }
            ?>
        </tbody>
    </table>
</div>

<script src="../public/js/notifications.js"></script>

<?php include '../templates/footer.php'; ?>
