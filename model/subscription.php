<?php


class Subscription {
    private IDb $db;

    function __construct(IDb $db) {
        $this->db = $db;
    }

    public function getSubscriptions() {
        $stmt = $this->db->connect()->prepare('SELECT * FROM subscriptions');
        if (!$stmt->execute()) {
            echo "error";
        }
        if ($stmt->rowCount() == 0) {
            echo "error";
        }
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function createSubscribtion($user_id, $expiration, $frequency, $address, $phone, $isActive) {
        $stmt = $this->db->connect()->prepare('INSERT INTO subscriptions (user_id, expiration, frequency, address, phone, is_active) VALUES (?, ?, ?, ?, ?, ?)');
        if (!$stmt->execute(array($user_id,$expiration, $frequency, $address, $phone, $isActive))) {
            echo "error";
        }
    }
    public function addProductsToSubscription($subscription_id, $products) {
        foreach ($products as $product) {
            if($product['product_id'] && $product['pieces_or_weight']) {



                $stmt = $this->db->connect()->prepare('INSERT INTO subscriptions_products (subscribtion_id, product_id, pieces_or_weight) VALUES (?, ?, ?)');
                if (!$stmt->execute(array($subscription_id, $product['product_id'], $product['pieces_or_weight']))) {
                    echo "error";
                }
            }

        }
    }
}