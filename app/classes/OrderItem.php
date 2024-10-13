<?php
require_once 'Database.php';

class OrderItem {
    private $conn;
    private $table = 'order_items';

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function addOrderItem($order_id, $product_id, $quantity, $price) {
        try {
            $query = "INSERT INTO " . $this->table . " (order_id, product_id, quantity, price)
                      VALUES (:order_id, :product_id, :quantity, :price)";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':order_id', $order_id);
            $stmt->bindParam(':product_id', $product_id);
            $stmt->bindParam(':quantity', $quantity);
            $stmt->bindParam(':price', $price);
            return $stmt->execute();
        } catch (Exception $e) {
            error_log("Error adding order item: " . $e->getMessage());
            return false;
        }
    }

    public function getOrderItems($order_id) {
        try {
            $query = "SELECT oi.*, p.name as product_name FROM " . $this->table . " oi
                      LEFT JOIN products p ON oi.product_id = p.id
                      WHERE oi.order_id = :order_id";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':order_id', $order_id);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            error_log("Error retrieving order items: " . $e->getMessage());
            return [];
        }
    }
}
?>
