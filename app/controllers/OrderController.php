<?php
require_once '../app/classes/Order.php';

class OrderController {
    private $order;

    public function __construct() {
        $this->order = new Order();
    }

    public function create($user_id, $status, $total_amount, $payment_method, $address, $reservation_date, $order_type) {
        return $this->order->create($user_id, $status, $total_amount, $payment_method, $address, $reservation_date, $order_type);
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
