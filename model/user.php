<?php


class User {
    private IDb $db;

    function __construct(IDb $db) {
        $this->db = $db;
    }

    public function getUsers() {
        $stmt = $this->db->connect()->connect()->prepare('SELECT * FROM users');
        if (!$stmt->execute()) {
            echo "error";
        }
        if ($stmt->rowCount() == 0) {
            echo "error";
        }
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function createUser($name, $surname, $phone) {
        $stmt = $this->db->connect()->prepare('INSERT INTO users (name, surname, phone) VALUES (?, ?, ?)');
        if (!$stmt->execute(array($name, $surname, $phone))) {
            echo "error";
        }

    }
}