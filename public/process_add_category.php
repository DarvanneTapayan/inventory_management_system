<?php
require_once '../app/classes/Category.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_SESSION['role']) && $_SESSION['role'] === 'admin') {
    $categoryName = $_POST['category_name'];
    $description = $_POST['description'];

    $category = new Category();
    if ($category->create($categoryName, $description)) {
        echo json_encode(['success' => true, 'message' => 'Category added successfully.']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to add category.']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Unauthorized request.']);
}
?>
