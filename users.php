<?php
    include "model/user.php";
    include "db/db.php";

    $user = new User(new Db());
    $users = [];
    foreach ($user->getUsers() as $resp) {
        array_push($users, $resp);
    }
    $users = json_encode($users);
    echo $users;
