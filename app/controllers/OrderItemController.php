<?php
require_once '../app/classes/OrderItem.php';

class OrderItemController {
    private $orderItem;

    public function __construct() {
        $this->orderItem = new OrderItem();
    }

    public function create($order_id, $product_id, $quantity, $price) {
        return $this->orderItem->create($order_id, $product_id, $quantity, $price);
    }

    public function getOrderItems($order_id) {
        return $this->orderItem->getOrderItems($order_id);
    }

    public function deleteOrderItem($order_item_id) {
        return $this->orderItem->deleteOrderItem($order_item_id);
    }

    public function getOrderItemsByOrderId($orderId) {
        return $this->orderItem->getItemsByOrderId($orderId);
    }
}
?>
