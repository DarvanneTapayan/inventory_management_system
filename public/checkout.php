<?php include '../templates/header.php'; ?>
<?php include '../templates/navbar.php'; ?>

<?php
$cartItems = isset($_SESSION['cart']) ? $_SESSION['cart'] : [];
$totalAmount = 0;

if (empty($cartItems)) {
    echo "<div class='container'><h2>Your cart is empty. Please add products to your cart before checking out.</h2></div>";
    exit();
}

require_once '../app/classes/Product.php';
?>

<div class="container">
    <h2>Checkout</h2>
    <form id="checkoutForm" action="process_checkout.php" method="POST">
        <h3>Shipping Information</h3>
        <div class="form-group">
            <label for="address">Address:</label>
            <input type="text" id="address" name="address" required>
        </div>
        <div class="form-group">
            <label for="payment_method">Payment Method:</label>
            <select id="payment_method" name="payment_method" required>
                <option value="credit_card">Credit Card</option>
                <option value="paypal">PayPal</option>
            </select>
        </div>
        <div class="form-group">
            <label for="order_type">Order Type:</label>
            <select id="order_type" name="order_type" required>
                <option value="pickup">Pickup</option>
                <option value="delivery">Delivery</option>
            </select>
        </div>
        <div class="form-group">
            <label for="reservation_date">Reservation Date:</label>
            <input type="date" id="reservation_date" name="reservation_date" required>
        </div>
        <h3>Order Summary</h3>
        <ul>
            <?php foreach ($cartItems as $productId => $quantity): 
                $product = new Product();
                $productData = $product->getProductById($productId);
                if ($productData) {
                    $itemTotal = $quantity * $productData['price'];
                    $totalAmount += $itemTotal; ?>
                    <li><?php echo htmlspecialchars($productData['name']) . " x " . $quantity; ?></li>
            <?php 
                }
            endforeach; ?>
        </ul>
        <p>Total Amount: $<?php echo number_format($totalAmount, 2); ?></p>
        <input type="hidden" name="total_amount" value="<?php echo $totalAmount; ?>">
        <button type="submit" class="btn-primary">Place Order</button>
    </form>
</div>

<script src="../public/js/ajax.js"></script>
<script src="../public/js/notifications.js"></script>
<script>
    document.getElementById('checkoutForm').addEventListener('submit', function(event) {
        event.preventDefault(); // Prevent default form submission
        ajaxSubmitForm(this); // Call the defined AJAX submit function
    });
</script>

<?php include '../templates/footer.php'; ?>
