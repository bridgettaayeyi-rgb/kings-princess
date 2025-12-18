<?php
require_once __DIR__ . '/../config/kp_database.php';

class Devotion {
    private $conn;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    // Get today's devotion securely using prepared statements
    public function getTodaysDevotion() {
        $today = date("Y-m-d");
        $query = "SELECT * FROM devotions WHERE devotion_date = :today LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':today', $today);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    //  get previous devotions
    public function getPreviousDevotions() {
        $today = date("Y-m-d");
        $query = "SELECT devotions_id, title, devotion_date FROM devotions WHERE devotion_date < :today ORDER BY devotion_date DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':today', $today);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getDevotionById($id) {
        $query = "SELECT * FROM devotions WHERE devotions_id = :id LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
?>
