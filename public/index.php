<!-- public/index.php -->
<?php include '../templates/header.php'; ?>
<?php include '../templates/navbar.php'; ?>

<div class="container">
    <section class="hero">
        <h1>Welcome to Our Cake Bake Shop</h1>
        <p>Discover our delicious selection of cakes and pastries.</p>
    </section>

    <section class="categories">
        <h2>Categories</h2>
        <ul>
            <?php
            require_once '../app/classes/Category.php';
            $category = new Category();
            $categories = $category->getAll();
            foreach ($categories as $cat) {
                echo "<li><a href='product.php?category_id=" . $cat['id'] . "'>" . htmlspecialchars($cat['name']) . "</a></li>";
            }
            ?>
        </ul>
    </section>

    <section class="featured-products">
        <h2>Featured Products</h2>
        <div class="product-grid">
            <?php
            require_once '../app/classes/Product.php';
            require_once '../app/controllers/InventoryController.php'; // Include InventoryController
            $product = new Product();
            $inventoryController = new InventoryController(); // Create an instance of InventoryController
            $products = $product->getAll();
            foreach ($products as $prod) {
                // Fetch stock level
                $stock = $inventoryController->getStock($prod['id']);
                echo "
                <div class='product-card'>
                    <img src='" . htmlspecialchars($prod['image_url'] ?? 'default_image.jpg') . "' alt='" . htmlspecialchars($prod['name'] ?? 'Product Name') . "'>
                    <h3>" . htmlspecialchars($prod['name']) . "</h3>
                    <p>" . htmlspecialchars($prod['description']) . "</p>
                    <p class='price'>$" . number_format($prod['price'], 2) . "</p>
                    <p class='stock'>Quantity in Stock: " . htmlspecialchars($stock) . "</p> <!-- Display stock -->
                    <a href='product.php?id=" . $prod['id'] . "' class='btn-secondary'>View Details</a>
                </div>
                ";
            }
            ?>
        </div>
    </section>
</div>

<?php include '../templates/footer.php'; ?>
