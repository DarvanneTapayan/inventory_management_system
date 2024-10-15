<?php
session_start();
require_once '../app/classes/User.php'; // Ensure you have the correct path

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $user = new User();
    $loginResult = $user->login($username, $password); // Adjust this method as per your User class
    if ($loginResult) {
        // Set session variables
        $_SESSION['username'] = $username;
        $_SESSION['user_id'] = $loginResult['id'];
        $_SESSION['role'] = $loginResult['role'];

        // Return a success response with user role
        echo json_encode(['success' => true, 'message' => 'Login successful.', 'role' => $_SESSION['role']]);
        exit();
    } else {
        // Set an error message for the login failure
        $_SESSION['error'] = "Invalid username or password.";
        echo json_encode(['success' => false, 'message' => $_SESSION['error']]); // Return error message
        exit();
    }
}
error_log("User role after login: " . $_SESSION['role']);
?>
