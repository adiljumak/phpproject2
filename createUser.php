<?php
include "model/user.php";
include "db/db.php";
if (isset($_POST)) {
    $user = new User(new Db());
    $data = json_decode(file_get_contents('php://input'), true);
    if (isset($data['name']) && isset($data['surname']) && isset($data['phone'])) {
        $user->createUser($data['name'], $data['surname'], $data['phone']);
    }
}



