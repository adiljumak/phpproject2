<?php
include "model/subscription.php";
include "db/db.php";
if (isset($_POST)) {
    $subscription = new Subscription(new Db());
    $data = json_decode(file_get_contents('php://input'), true);
    if (isset($data['user_id']) && isset($data['expiration']) && isset($data['frequency']) && isset($data['address']) && isset($data['phone']) && isset($data['isActive'])) {
        $subscription->createSubscribtion($data['user_id'], $data['expiration'], $data['frequency'],$data['address'], $data['phone'],$data['isActive']);
    }
}