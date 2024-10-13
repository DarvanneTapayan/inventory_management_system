<?php
require_once '../app/classes/Order.php';

class OrderService {
    private $order;

    public function __construct() {
        $this->order = new Order();
    }

    public function createOrder($user_id, $status, $total_amount, $payment_method, $address) {
        return $this->order->create($user_id, $status, $total_amount, $payment_method, $address);
    }

    public function getOrderDetails($order_id) {
        return $this->order->getOrderDetails($order_id);
    }

    public function getUserOrders($user_id) {
        return $this->order->getUserOrders($user_id);
    }

    public function updateOrderStatus($order_id, $status) {
        return $this->order->updateOrderStatus($order_id, $status);
    }

    public function getAllOrders() {
        return $this->order->getAllOrders();
    }

    public function getOrdersByStatus($status) {
        return $this->order->getOrdersByStatus($status);
    }
}
?>
