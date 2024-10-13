<?php
require_once 'Database.php';

class Order {
    private $conn;
    private $table = 'orders';

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function getConnection() {
        return $this->conn; // Allow access to the connection for logging
    }

    public function create($user_id, $status, $total_amount, $payment_method, $address, $reservation_date, $order_type) {
        try {
            $query = "INSERT INTO orders (user_id, status, total_amount, payment_method, address, created_at, reservation_date, order_type)
                      VALUES (:user_id, :status, :total_amount, :payment_method, :address, NOW(), :reservation_date, :order_type)";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':user_id', $user_id);
            $stmt->bindParam(':status', $status);
            $stmt->bindParam(':total_amount', $total_amount);
            $stmt->bindParam(':payment_method', $payment_method);
            $stmt->bindParam(':address', $address);
            $stmt->bindParam(':reservation_date', $reservation_date);
            $stmt->bindParam(':order_type', $order_type);
    
            if ($stmt->execute()) {
                return $this->conn->lastInsertId(); // Return the order ID
            } else {
                error_log("Failed to insert order. SQL Error: " . implode(", ", $stmt->errorInfo()));
                return false; // Return false if the order creation fails
            }
        } catch (Exception $e) {
            error_log("Error creating order: " . $e->getMessage());
            return false;
        }
    }
    
    public function getOrderDetails($order_id) {
        try {
            $query = "SELECT o.*, u.username, u.email FROM " . $this->table . " o 
                      LEFT JOIN users u ON o.user_id = u.id 
                      WHERE o.id = :order_id";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':order_id', $order_id);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            error_log("Error retrieving order details: " . $e->getMessage());
            return false;
        }
    }

    public function getUserOrders($user_id) {
        try {
            $query = "SELECT * FROM " . $this->table . " WHERE user_id = :user_id ORDER BY created_at DESC";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':user_id', $user_id);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            error_log("Error retrieving user orders: " . $e->getMessage());
            return [];
        }
    }

    public function updateOrderStatus($order_id, $status) {
        try {
            $query = "UPDATE " . $this->table . " SET status = :status WHERE id = :order_id";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':status', $status);
            $stmt->bindParam(':order_id', $order_id);
            return $stmt->execute();
        } catch (Exception $e) {
            error_log("Error updating order status: " . $e->getMessage());
            return false;
        }
    }

    public function getOrdersByStatus($status) {
        try {
            $query = "SELECT * FROM " . $this->table . " WHERE status = :status ORDER BY created_at DESC";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':status', $status);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            error_log("Error retrieving orders by status: " . $e->getMessage());
            return [];
        }
    }

    public function getAllOrders() {
        try {
            $query = "SELECT o.*, u.username FROM " . $this->table . " o
                      LEFT JOIN users u ON o.user_id = u.id
                      ORDER BY o.created_at DESC";
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            error_log("Error retrieving all orders: " . $e->getMessage());
            return [];
        }
    }
}
?>
