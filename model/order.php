<?php


class Order {
    private IDb $db;

    function __construct(IDb $db) {
        $this->db = $db;
    }

    public function getOrders() {
        $stmt = $this->db->connect()->prepare('SELECT * FROM orders');
        if (!$stmt->execute()) {
            echo "error";
        }
        if ($stmt->rowCount() == 0) {
            echo "error";
        }
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function createOrder($is_delivered, $create_date, $weight) {
        $stmt = $this->db->connect()->prepare('INSERT INTO orders (is_delivered, create_date, weight) VALUES (?, ?, ?)');
        if (!$stmt->execute(array($is_delivered, $create_date, $weight))) {
            echo "error";
        }
    }

    public function addProductsToOrder($order_id, $products) {
        foreach ($products as $product) {
            if($product['product_id'] && $product['pieces_or_weight']) {
                $stmt = $this->db->connect()->prepare('INSERT INTO orders_products (order_id, product_id, pieces_or_weight) VALUES (?, ?, ?)');
                if (!$stmt->execute(array($order_id, $product['product_id'], $product['pieces_or_weight']))) {
                    echo "error";
                }
            }
        }
    }
}