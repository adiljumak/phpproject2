<?php


class Product {
    private IDb $db;

    function __construct(IDb $db) {
        $this->db = $db;
    }



    function updateProductInStock($product_id, $in_stock) {
        $stmt1 = $this->db->connect()->prepare('UPDATE products SET in_stock = ? WHERE id = ?');
        if(!$stmt1->execute(array($in_stock, $product_id))) {
            echo "error";
        }
    }

    function updateWeightProductWightInStock($product_id, $weight_in_stock) {
        $stmt1 = $this->db->connect()->prepare('UPDATE weight_products SET weight_in_stock = ? WHERE id = ?');
        if(!$stmt1->execute(array($weight_in_stock, $product_id))) {
            echo "error";
        }
    }

    function removeProducts($type_id, $pieces_or_weight) {
        $stmt1 = $this->db->connect()->prepare('SELECT * FROM products WHERE type_id=?');
        if(!$stmt1->execute()) {
            echo "error";
        }
        $stmt2 = $this->db->connect()->prepare('SELECT * FROM weight_products WHERE type_id=?');
        if(!$stmt2->execute()) {
            echo "error";
        }
        if($stmt1->rowCount() != 0) {
            $products = $stmt1->fetchAll(PDO::FETCH_ASSOC);
            if (count($products) < $pieces_or_weight) {
                echo "there is not enough quantity in stock";
                return FALSE;
            }
            foreach ($products as $product) {
                $stmt1 = $this->db->connect()->prepare('UPDATE products SET in_stock = ? WHERE id = ?');
                if(!$stmt1->execute(array(0, $product['id']))) {
                    echo "error";
                }
            }
            return TRUE;
        }

        if($stmt2->rowCount() != 0) {
            $products = $stmt2->fetchAll(PDO::FETCH_ASSOC);
            if (count($products) < $pieces_or_weight) {
                echo "there is not enough quantity in stock";
                return FALSE;
            }
            foreach ($products as $product) {
                $stmt1 = $this->db->connect()->prepare('UPDATE weight_products SET weight_in_stock = ? WHERE id = ?');
                if(!$stmt1->execute(array(0, $product['id']))) {
                    echo "error";
                }
            }
            return TRUE;
        }
    }
}