<?php
require_once __DIR__ . '/../config/kp_database.php';

class Wallpaper {
    private $conn;

    public function __construct() {
        $db = new Database();
        $this->conn = $db->getConnection();
    }

    // Get all wallpapers
    public function getAll() {
        $stmt = $this->conn->prepare("SELECT * FROM wallpapers");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
