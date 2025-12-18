<?php
require_once __DIR__ . '/../config/kp_database.php';

class User {

    private $conn;

    public function __construct() {
        $db = new Database();
        $this->conn = $db->getConnection();
    }

    /**
     * Get user details by ID
     */
    public function getById($id) {
        $stmt = $this->conn->prepare("SELECT id, first_name, last_name, email, username, role, created_at FROM members WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
