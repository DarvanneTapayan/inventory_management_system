<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];

    echo json_encode(['success' => true, 'message' => "Thank you, $name. Your message has been received."]);
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request method.']);
}
?>
