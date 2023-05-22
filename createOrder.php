<?php
include "model/order.php";
include "db/db.php";
if (isset($_POST)) {
    $order = new Order(new Db());
    $data = json_decode(file_get_contents('php://input'), true);
    if (isset($data['is_delivered']) && isset($data['create_date']) && isset($data['weight'])) {
        $order->createOrder($data['is_delivered'], $data['create_date'], $data['weight']);
    }
}