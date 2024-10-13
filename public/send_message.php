<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validate and sanitize input
    $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
    $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
    $message = filter_input(INPUT_POST, 'message', FILTER_SANITIZE_STRING);

    // Check for required fields
    if (empty($name) || empty($email) || empty($message)) {
        echo json_encode(['success' => false, 'message' => 'All fields are required.']);
        exit();
    }

    // Optionally, you can send the message via email here
    // mail($to, $subject, $message, $headers);

    echo json_encode(['success' => true, 'message' => "Thank you, $name. Your message has been received."]);
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request method.']);
}
?>
