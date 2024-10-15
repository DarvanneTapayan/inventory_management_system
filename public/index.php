<?php
include '../templates/header.php';
include '../templates/navbar.php';
// Redirect admin users to the admin dashboard
if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin') {
    header("Location: admin_dashboard.php");
    exit();
}

?>

<div class="container">
    <section class="hero">
        <h1>Welcome to Our Cake Bake Shop</h1>
        <p>Discover our delicious selection of cakes and pastries.</p>
    </section>

    <section class="featured-products">
        <h2>Featured Products</h2>

        <section class="categories">
            <div class="categories-dropdown">
                <select id="categorySelect" onchange="location = this.value;">
                    <option value="">Select a category</option>
                    <?php
                    require_once '../app/classes/Category.php';
                    $category = new Category();
                    $categories = $category->getAll();
                    foreach ($categories as $cat) {
                        echo "<option value='product.php?category_id=" . $cat['id'] . "'>" . htmlspecialchars($cat['name']) . "</option>";
                    }
                    ?>
                    <option value="product.php">All</option>
                </select>
            </div>
        </section>

        <div class="product-grid">
            <?php
            require_once '../app/classes/Product.php';
            require_once '../app/controllers/InventoryController.php'; 
            $product = new Product();
            $inventoryController = new InventoryController(); 
            $products = $product->getAll();
            foreach ($products as $prod) {
                $stock = $inventoryController->getStock($prod['id']);
                echo "
                <div class='product-card'>
                    <img src='" . htmlspecialchars($prod['image_url'] ?? 'default_image.jpg') . "' alt='" . htmlspecialchars($prod['name'] ?? 'Product Name') . "'>
                    <h3>" . htmlspecialchars($prod['name']) . "</h3>
                    <p>" . htmlspecialchars($prod['description']) . "</p>
                    <p class='price'>$" . number_format($prod['price'], 2) . "</p>
                    <p class='stock'>Quantity in Stock: " . htmlspecialchars($stock) . "</p>
                    <form class='add-to-cart-form' onsubmit='event.preventDefault(); ajaxSubmitForm(this);' action='process_add_to_cart.php' method='POST'>
                        <input type='hidden' name='product_id' value='" . $prod['id'] . "'>
                        <div class='form-group'>
                            <label for='quantity'>Quantity:</label>
                            <input type='number' id='quantity' name='quantity' value='1' min='1' max='" . htmlspecialchars($stock) . "' required>
                        </div>";
                
                if ($stock > 0) {
                    echo "<button type='submit' class='btn-secondary'>Add to Cart</button>";
                } else {
                    echo "<p class='out-of-stock'>This product is currently out of stock.</p>";
                }
                echo "</form></div>";
            }
            ?>
        </div>
    </section>

    <section>
        <div class="contact-container">
            <div class="contact-form-container">
                <h2>Contact Us</h2>
                <form action="send_message.php" method="POST">
                    <div class="contact-form-group">
                        <label for="name">Name:</label>
                        <input type="text" id="name" name="name" required>
                    </div>
                    <div class="contact-form-group">
                        <label for="email">Email:</label>
                        <input type="email" id="email" name="email" required>
                    </div>
                    <div class="contact-form-group">
                        <label for="message">Message:</label>
                        <textarea id="message" name="message" rows="5" required></textarea>
                    </div>
                    <button type="submit" class="btn-primary">Send Message</button>
                </form>
            </div>
        </div>
    </section>
</div>

<script src="../public/js/ajax.js"></script>
<script src="../public/js/notifications.js"></script>

<?php include '../templates/footer.php'; ?>
