<?php

include "model/order.php";
include "db/db.php";

if (isset($_GET['order_id'])) {
    $order = new Order(new Db());
    $orders = [];
    foreach ($order->getSubscriptions() as $resp) {
        if ($resp['order_id'] == $_GET['order_id']) {
            array_push($orders, $resp);
        }
    }
    $orders = json_encode($orders);
    echo $orders;
} else {
    $order = new Order(new Db());
    $orders = [];
    foreach ($order->getSubscriptions() as $resp) {
        array_push($orders, $resp);
    }
    $orders = json_encode($orders);
    echo $orders;
}


