<!-- public/cart.php -->
<?php include '../templates/header.php'; ?>
<?php include '../templates/navbar.php'; ?>
<?php

// Check if the cart exists in the session
$cartItems = isset($_SESSION['cart']) ? $_SESSION['cart'] : [];
$totalAmount = 0;
?>

<div class="container">
    <h2>Your Shopping Cart</h2>
    <?php if (!empty($cartItems)): ?>
        <div class="cart-table">
            <table>
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Total</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Loop through cart items to display them
                    foreach ($cartItems as $productId => $quantity) {
                        require_once '../app/classes/Product.php';
                        $product = new Product();
                        $productData = $product->getProductById($productId);

                        if ($productData) {
                            $itemTotal = $quantity * $productData['price'];
                            $totalAmount += $itemTotal;
                            ?>
                            <tr data-product-id="<?php echo $productData['id']; ?>">
                                <td><?php echo htmlspecialchars($productData['name']); ?></td>
                                <td>
                                    <input type="number" class="quantity" value="<?php echo $quantity; ?>" min="1">
                                </td>
                                <td>$<?php echo number_format($productData['price'], 2); ?></td>
                                <td class="item-total">$<?php echo number_format($itemTotal, 2); ?></td>
                                <td>
                                    <button class="btn-secondary remove-item" data-product-id="<?php echo $productData['id']; ?>">Remove</button>
                                </td>
                            </tr>
                            <?php
                        }
                    }
                    ?>
                </tbody>
            </table>
            <p>Total Amount: $<span id="totalAmount"><?php echo number_format($totalAmount, 2); ?></span></p>
            <a href="checkout.php" class="btn-primary">Proceed to Checkout</a>
        </div>
    <?php else: ?>
        <p>Your cart is empty.</p>
    <?php endif; ?>
</div>

<script src="../public/js/cart.js"></script>

<?php include '../templates/footer.php'; ?>
