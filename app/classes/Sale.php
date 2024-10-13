<?php
require_once 'Database.php';

class Sale {
    private $conn;
    private $table = 'sales';

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function create($order_id, $total_amount, $sale_date) {
        $query = "INSERT INTO " . $this->table . " (order_id, total_amount, sale_date) VALUES (:order_id, :total_amount, :sale_date)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':order_id', $order_id);
        $stmt->bindParam(':total_amount', $total_amount);
        $stmt->bindParam(':sale_date', $sale_date);
        return $stmt->execute();
    }

    public function getAllSales() {
        $query = "SELECT * FROM " . $this->table;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
