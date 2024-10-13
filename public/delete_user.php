<?php
require_once '../app/classes/User.php';
session_start();

// Admin-only access check
if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin' && isset($_GET['id'])) {
    $userId = $_GET['id'];
    $user = new User();

    if ($user->delete($userId)) {
        $_SESSION['success'] = "User deleted successfully.";
    } else {
        $_SESSION['error'] = "Failed to delete user.";
    }
    header("Location: manage_users.php");
    exit();
} else {
    header("Location: index.php");
    exit();
}
?>
