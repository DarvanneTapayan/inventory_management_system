<?php
require_once '../app/classes/Category.php';

class CategoryController {
    private $category;

    public function __construct() {
        $this->category = new Category();
    }

    public function create($name, $description) {
        return $this->category->create($name, $description);
    }

    public function getAllCategories() {
        return $this->category->getAll();
    }

    public function getCategoryById($id) {
        return $this->category->getCategoryById($id);
    }

    public function update($id, $name, $description) {
        return $this->category->update($id, $name, $description);
    }

    public function delete($id) {
        return $this->category->delete($id);
    }
}
?>
