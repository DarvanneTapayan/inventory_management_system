<?php
include '../templates/header.php';
include '../templates/navbar.php';

require_once '../app/classes/Sale.php';
require_once '../app/classes/Product.php'; 
require_once '../app/classes/Order.php'; 

$saleId = $_GET['id'] ?? null; 

if (!$saleId) {
    echo "<div class='container'><h2>Sale ID is missing.</h2></div>";
    exit();
}

$sale = new Sale();
$product = new Product();
$order = new Order();

// Fetch sale details
$saleDetails = $sale->getSaleDetails($saleId); 

if (!$saleDetails) {
    echo "<div class='container'><h2>Sale not found.</h2></div>";
    exit();
}

// Fetch product details for the associated product
$productData = $product->getProductById($saleDetails['product_id']); 

// Fetch order details if necessary (e.g., for more user info)
$orderData = $order->getOrderDetails($saleDetails['order_id']);

?>

<div class="container">
    <h2>Sale Details</h2>
    <p><strong>Order ID:</strong> <?php echo htmlspecialchars($saleDetails['order_id']); ?></p>
    <p><strong>Product Name:</strong> <?php echo htmlspecialchars($productData['name']); ?></p>
    <p><strong>Quantity Sold:</strong> <?php echo htmlspecialchars($saleDetails['quantity']); ?></p>
    <p><strong>Sale Amount:</strong> $<?php echo number_format($saleDetails['sale_amount'], 2); ?></p>
    <p><strong>Sale Date:</strong> <?php echo htmlspecialchars($saleDetails['sale_date']); ?></p>
    <p><strong>User:</strong> <?php echo htmlspecialchars($orderData['username'] ?? 'Unknown'); ?></p> 
    <p><strong>Product Image:</strong></p>
    <img src="<?php echo htmlspecialchars($productData['image_url'] ?? 'default_image.jpg'); ?>" alt="<?php echo htmlspecialchars($productData['name']); ?>" width="150" />
</div>

<?php include '../templates/footer.php'; ?>
