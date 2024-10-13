<?php
require_once '../app/classes/Order.php';
require_once '../app/classes/OrderItem.php'; // Include OrderItem class
require_once '../app/controllers/InventoryController.php';
require_once '../app/controllers/OrderItemController.php';

class OrderController {
    private $order;
    private $inventoryController;

    public function __construct() {
        $this->order = new Order();
        $this->inventoryController = new InventoryController(); // Initialize InventoryController
    }

    public function cancelOrder($order_id) {
        // Get the order details to know the products and quantities
        $orderDetails = $this->order->getOrderDetails($order_id);
        if (!$orderDetails) {
            return false; // Order not found
        }

        // Cancel the order
        if ($this->order->cancelOrder($order_id)) {
            // If order is successfully canceled, update stock for each order item
            $orderItemController = new OrderItemController();
            $orderItems = $orderItemController->getOrderItems($order_id); // Get order items associated with the order

            foreach ($orderItems as $item) {
                // Add stock back for each item in the order
                $this->inventoryController->addStock($item['product_id'], $item['quantity']); // Reference the inventory controller correctly
            }

            return true; // Order canceled and stock updated
        }

        return false; // Failed to cancel order
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
