<?php include '../templates/header.php'; ?>
<?php include '../templates/navbar.php'; ?>
<?php
// Admin-only access check
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: index.php");
    exit();
}

require_once '../app/classes/User.php';
$user = new User();
$userId = $_GET['id'];
$userDetails = $user->getUserById($userId);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $updatedEmail = $_POST['email'];
    $updatedRole = $_POST['role'];

    if ($user->updateUser($userId, $updatedEmail, $updatedRole)) {
        $_SESSION['success'] = "User updated successfully.";
        header("Location: manage_users.php");
        exit();
    } else {
        $_SESSION['error'] = "Failed to update user.";
    }
}
?>

<div class="container">
    <h2>Edit User</h2>
    <form action="" method="POST">
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($userDetails['email']); ?>" required>
        </div>
        <div class="form-group">
            <label for="role">Role:</label>
            <select id="role" name="role">
                <option value="user" <?php echo $userDetails['role'] === 'user' ? 'selected' : ''; ?>>User</option>
                <option value="admin" <?php echo $userDetails['role'] === 'admin' ? 'selected' : ''; ?>>Admin</option>
            </select>
        </div>
        <button type="submit" class="btn-primary">Update User</button>
    </form>
</div>

<?php include '../templates/footer.php'; ?>
