<?php
require_once __DIR__ . '/../config/kp_database.php';

class Challenge {
    private $conn;

    public function __construct() {
        $db = new Database();
        $this->conn = $db->getConnection();
    }

    public function getDay($day_number) {
        $query = "SELECT day_number, title, chapter, reflection 
        FROM challenge_days 
        WHERE day_number = :day";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':day', $day_number);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getReadStatus($userId, $day) {
        $stmt = $this->conn->prepare("SELECT is_read FROM challenge_progress WHERE user_id = ? AND day = ?");
        $stmt->execute([$userId, $day]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row ? $row['is_read'] : 0;
    }
    
    public function markAsRead($userId, $day) {
        $stmt = $this->conn->prepare("
            INSERT INTO challenge_progress (user_id, day, is_read, read_at)
            VALUES (?, ?, 1, NOW())
            ON DUPLICATE KEY UPDATE is_read = 1, read_at = NOW()
        ");
        return $stmt->execute([$userId, $day]);
    }
    
    public function countRead($userId) {
        $stmt = $this->conn->prepare(
            "SELECT COUNT(*) FROM challenge_progress WHERE user_id = ?"
        );
        $stmt->execute([$userId]);
        return (int) $stmt->fetchColumn();
    }
}
?>
