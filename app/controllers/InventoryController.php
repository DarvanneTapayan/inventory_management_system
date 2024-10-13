<?php
require_once '../app/classes/Inventory.php';

class InventoryController {
    private $inventory;

    public function __construct() {
        $this->inventory = new Inventory();
    }

    public function addStock($product_id, $quantity) {
        return $this->inventory->addStock($product_id, $quantity);
    }

    public function removeStock($product_id, $quantity) {
        return $this->inventory->removeStock($product_id, $quantity);
    }

    public function getStock($product_id) {
        return $this->inventory->getStock($product_id);
    }

    public function insertStock($product_id) {
        return $this->inventory->insertStock($product_id);
    }
}

?>
