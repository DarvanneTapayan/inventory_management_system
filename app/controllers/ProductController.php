<?php
// app/controllers/ProductController.php
require_once '../app/classes/Product.php';

class ProductController {
    private $product;

    public function __construct() {
        $this->product = new Product();
    }

    public function create($name, $description, $price, $category_id, $image_url) {
        return $this->product->create($name, $description, $price, $category_id, $image_url);
    }

    public function getAllProducts() {
        return $this->product->getAll();
    }

    public function getProductById($id) {
        return $this->product->getProductById($id);
    }

    public function update($id, $name, $description, $price, $category_id, $image_url) {
        return $this->product->update($id, $name, $description, $price, $category_id, $image_url);
    }

    public function delete($id) {
        return $this->product->delete($id);
    }

    public function getLastInsertedId() {
        return $this->product->getLastInsertedId(); // Call the method from the Product class
    }

    public function getProductByName($name) {
        return $this->product->getProductByName($name);
    }
    
}

?>
