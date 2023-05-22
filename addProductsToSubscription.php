<?php
include "model/subscription.php";
include "db/db.php";


if (isset($_POST)) {
    $subscription = new Subscription(new Db());
    $data = json_decode(file_get_contents('php://input'), true);
    if (isset($data['subscription_id']) && isset($data['products']) ) {
        $subscription->addProductsToSubscription($data['subscription_id'], $data['products']);
    }
}



