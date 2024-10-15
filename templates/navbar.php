<?php
// Start the session if it hasn't been started yet
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>

<nav>
    <ul>
        <?php if (isset($_SESSION['username'])): ?>
            <?php if ($_SESSION['role'] !== 'admin'): ?>
                <li><a href="index.php">Home</a></li> <!-- Show Home only for regular users -->
            <?php endif; ?>
            <li><a href="product.php">Products</a></li>
            <li><a href="cart.php">Cart</a></li>
            <?php if ($_SESSION['role'] !== 'admin'): ?>
                <li><a href="contact.php">Contact Us</a></li> <!-- Show Contact Us only for regular users -->
            <?php endif; ?>
            <?php if ($_SESSION['role'] !== 'admin'): ?>
                <li><a href="order_history.php">Order History</a></li>
            <?php endif; ?>
            <li><a href="profile.php">Profile</a></li>
            <?php if ($_SESSION['role'] === 'admin'): ?>
                <li><a href="admin_dashboard.php">Admin Dashboard</a></li>
            <?php endif; ?>
            <li><a href="logout.php">Logout</a></li>
        <?php else: ?>
            <li><a href="index.php">Home</a></li> <!-- Show Home for guests -->
            <li><a href="product.php">Products</a></li>
            <li><a href="cart.php">Cart</a></li>
            <li><a href="contact.php">Contact Us</a></li>
            <li><a href="login.php">Login</a></li>
            <li><a href="register.php">Register</a></li>
        <?php endif; ?>
    </ul>
</nav>
