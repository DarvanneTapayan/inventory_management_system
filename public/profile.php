<?php 
include '../templates/header.php'; 
include '../templates/navbar.php'; 

require_once '../app/classes/User.php'; // Include the User class

$userId = $_SESSION['user_id'] ?? null; // Get user ID from session
if (!$userId) {
    echo "<div class='container'><h2>You must be logged in to view your profile.</h2></div>";
    exit();
}

$userModel = new User();
$user = $userModel->getUserById($userId); // Fetch user data from the database

if (!$user) {
    echo "<div class='container'><h2>User not found.</h2></div>";
    exit();
}
?>

<div class="container">
    <h2>User Profile</h2>
    <div class="form-container">
        <div class="form-group">
            <label for="username">Username:</label>
            <input type="text" id="username" value="<?php echo htmlspecialchars($user['username']); ?>" readonly>
        </div>
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" id="email" value="<?php echo htmlspecialchars($user['email'] ?? 'Not provided'); ?>" readonly>
        </div>
        <div class="form-group">
            <label for="phone">Phone:</label>
            <input type="text" id="phone" value="<?php echo htmlspecialchars($user['phone'] ?? 'Not provided'); ?>" readonly>
        </div>
    </div>
</div>

<?php include '../templates/footer.php'; ?>
