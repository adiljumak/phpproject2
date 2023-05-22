<?php
include "model/order.php";
include "db/db.php";


if (isset($_POST)) {
    $order = new Order(new Db());
    $data = json_decode(file_get_contents('php://input'), true);
    if (isset($data['order_id']) && isset($data['products']) ) {
        $order->addProductsToOrder($data['order_id'], $data['products']);
    }
}



