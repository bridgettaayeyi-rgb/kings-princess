<?php
require_once __DIR__ . "/../config/kp_database.php";

class Testimony {

    private $conn;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function getAll() {
        $sql = "SELECT * FROM testimonies ORDER BY created_at DESC";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById($id) {
        $sql = "SELECT * FROM testimonies WHERE testimonies_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function save($testimony, $user_id) {
        $sql = "INSERT INTO testimonies (testimony, user_id) VALUES (?, ?)";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$testimony, $user_id]);
    }

    public function update($id, $testimony, $user_id) {
        $sql = "UPDATE testimonies SET testimony = ? WHERE testimonies_id = ? AND user_id = ?";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$testimony, $id, $user_id]);
    }

    public function delete($id, $user_id) {
        $sql = "DELETE FROM testimonies WHERE testimonies_id = ? AND user_id = ?";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$id, $user_id]);
    }
}
