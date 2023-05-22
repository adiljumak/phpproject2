<?php

include "model/subscription.php";
include "db/db.php";

if (isset($_GET['user_id'])) {
    $subscription = new Subscription(new Db());
    $subscriptions = [];
    foreach ($subscription->getSubscriptions() as $resp) {
        if ($resp['user_id'] == $_GET['user_id']) {
            array_push($subscriptions, $resp);
        }
    }
    $subscriptions = json_encode($subscriptions);
    echo $subscriptions;
} else {
    $subscription = new Subscription(new Db());
    $subscriptions = [];
    foreach ($subscription->getSubscriptions() as $resp) {
        array_push($subscriptions, $resp);
    }
    $subscriptions = json_encode($subscriptions);
    echo $subscriptions;
}


