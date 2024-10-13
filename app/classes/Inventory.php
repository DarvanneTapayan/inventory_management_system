<?php
require_once 'Database.php';

class Inventory {
    private $conn;
    private $table = 'inventory';

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function addStock($product_id, $quantity) {
        $query = "UPDATE " . $this->table . " SET quantity_in_stock = quantity_in_stock + :quantity WHERE product_id = :product_id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':product_id', $product_id);
        $stmt->bindParam(':quantity', $quantity);
        return $stmt->execute();
    }

    public function removeStock($product_id, $quantity) {
        $query = "UPDATE " . $this->table . " SET quantity_in_stock = quantity_in_stock - :quantity WHERE product_id = :product_id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':product_id', $product_id);
        $stmt->bindParam(':quantity', $quantity);
        return $stmt->execute();
    }

    public function getStock($product_id) {
        $query = "SELECT quantity_in_stock FROM " . $this->table . " WHERE product_id = :product_id LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':product_id', $product_id);
        $stmt->execute();
        return $stmt->fetchColumn();
    }

    // Method to insert stock entry if it doesn't exist
    public function insertStock($product_id) {
        $query = "INSERT INTO " . $this->table . " (product_id, quantity_in_stock) VALUES (:product_id, 0)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':product_id', $product_id);
        return $stmt->execute();
    }
}

?>
