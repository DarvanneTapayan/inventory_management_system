<?php include '../templates/header.php'; ?>
<?php include '../templates/navbar.php'; ?>
<?php
$user = [
    'username' => 'john_doe',
    'email' => 'john@example.com',
    'phone' => '123-456-7890'
];
?>

<div class="container">
    <div class="form-container">
        <h2>Profile</h2>
        <form action="update_profile.php" method="POST">
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" value="<?php echo htmlspecialchars($user['username']); ?>" required>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" required>
            </div>
            <div class="form-group">
                <label for="phone">Phone:</label>
                <input type="text" id="phone" name="phone" value="<?php echo htmlspecialchars($user['phone']); ?>">
            </div>
            <button type="submit" class="btn-primary">Update Profile</button>
        </form>
    </div>
</div>

<?php include '../templates/footer.php'; ?>