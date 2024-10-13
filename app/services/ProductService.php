<?php
require_once '../app/classes/Product.php';

class ProductService {
    private $product;

    public function __construct() {
        $this->product = new Product();
    }

    public function createProduct($name, $description, $price, $category_id, $image_url) {
        return $this->product->create($name, $description, $price, $category_id, $image_url);
    }

    public function updateProduct($id, $name, $description, $price, $category_id, $image_url) {
        return $this->product->update($id, $name, $description, $price, $category_id, $image_url);
    }

    public function deleteProduct($id) {
        return $this->product->delete($id);
    }

    public function getAllProducts() {
        return $this->product->getAll();
    }

    public function getProductById($id) {
        return $this->product->getProductById($id);
    }
}
?>
