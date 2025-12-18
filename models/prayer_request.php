<?php
require_once __DIR__ . '/../config/kp_database.php';

class PrayerRequest {
    private $conn;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function addRequest($first_name, $last_name, $email, $message) {
        $query = "INSERT INTO prayer_requests (first_name, last_name, email, message) 
                  VALUES (:first_name, :last_name, :email, :message)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':first_name', $first_name);
        $stmt->bindParam(':last_name', $last_name);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':message', $message);

        return $stmt->execute();
    }
}
?>
