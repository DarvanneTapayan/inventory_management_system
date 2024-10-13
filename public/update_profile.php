<?php
require_once '../app/classes/User.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
    $newEmail = $_POST['email'];
    $newPhone = $_POST['phone'];

    $user = new User();
    if ($user->updateProfile($username, $newEmail, $newPhone)) {
        $_SESSION['success'] = "Profile updated successfully.";
    } else {
        $_SESSION['error'] = "Profile update failed. Please try again.";
    }
    header("Location: profile.php");
    exit();
}
?>
