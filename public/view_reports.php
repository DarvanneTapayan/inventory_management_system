<?php include '../templates/header.php'; ?>
<?php include '../templates/navbar.php'; ?>
<?php
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: index.php");
    exit();
}
?>

<div class="container">
    <h2>Sales Reports</h2>
    <p>Here you can view sales reports and analytics.</p>
</div>

<?php include '../templates/footer.php'; ?>
