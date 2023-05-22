<?php


interface IDb {
    public function connect();
}

class Db implements IDb
{
    public function connect() {
        try {
            $host = "localhost";
            $dbname = "arbuz1";
            $username = "root";
            $password = "root";
            $db = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
            return $db;
        } catch (PDOException $e) {
            print "Error " . $e->getMessage();
            die();
        }
    }
}