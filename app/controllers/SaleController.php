<?php
require_once '../app/classes/Sale.php';

class SaleController {
    private $sale;

    public function __construct() {
        $this->sale = new Sale();
    }

    public function create($order_id, $product_id, $quantity, $sale_amount, $sale_date) {
        return $this->sale->create($order_id, $product_id, $quantity, $sale_amount, $sale_date);
    }

    public function getAllSales() {
        return $this->sale->getAllSales();
    }

    public function getSaleDetails($saleId) {
        return $this->sale->getSaleDetails($saleId);
    }
}
?>
