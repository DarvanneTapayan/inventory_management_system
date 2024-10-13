<?php
require_once '../app/classes/Category.php';
session_start();

// Admin-only access check
if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin' && isset($_GET['id'])) {
    $categoryId = $_GET['id'];
    $category = new Category();

    if ($category->delete($categoryId)) {
        $_SESSION['success'] = "Category deleted successfully.";
    } else {
        $_SESSION['error'] = "Failed to delete category.";
    }
    header("Location: manage_categories.php");
    exit();
} else {
    header("Location: index.php");
    exit();
}
?>
