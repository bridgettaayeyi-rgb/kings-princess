<?php
require_once __DIR__ . '/../config/kp_database.php';

class UserModel {
    private $conn;

    public function __construct() {
        $db = new Database();
        $this->conn = $db->getConnection();
    }

    // ======= NORMAL USER FUNCTIONS =======

    public function emailExists($email) {
        $stmt = $this->conn->prepare("SELECT * FROM members WHERE email = ? LIMIT 1");
        $stmt->execute([$email]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function createUser($first_name, $last_name, $username, $email, $hashedPassword, $role = 'user') {
        $stmt = $this->conn->prepare(
            "INSERT INTO members (first_name, last_name, username, email, password, role)
             VALUES (?, ?, ?, ?, ?, ?)"
        );

        if ($stmt->execute([$first_name, $last_name, $username, $email, $hashedPassword, $role])) {
            return $this->conn->lastInsertId(); // return user ID
        }

        return false;
    }

     
}
?>
