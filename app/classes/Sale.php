<?php
require_once 'Database.php';

class Sale {
    private $conn;
    private $table = 'sales';

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function create($order_id, $product_id, $quantity, $sale_amount, $sale_date) {
        $query = "INSERT INTO " . $this->table . " (order_id, product_id, quantity, sale_amount, sale_date) 
                  VALUES (:order_id, :product_id, :quantity, :sale_amount, :sale_date)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':order_id', $order_id);
        $stmt->bindParam(':product_id', $product_id);
        $stmt->bindParam(':quantity', $quantity);
        $stmt->bindParam(':sale_amount', $sale_amount);
        $stmt->bindParam(':sale_date', $sale_date);
        return $stmt->execute();
    }

    public function getAllSales() {
        $query = "SELECT s.*, p.name AS product_name, u.username AS user_name 
                  FROM " . $this->table . " s
                  JOIN products p ON s.product_id = p.id
                  JOIN orders o ON s.order_id = o.id
                  JOIN users u ON o.user_id = u.id"; // Joining with orders and users
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getSaleDetails($saleId) {
        $query = "SELECT * FROM " . $this->table . " WHERE id = :sale_id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':sale_id', $saleId);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
?>
