<?php
require_once __DIR__ . '/../config/kp_database.php';

class PrayerChain
{
    private $conn;

    public function __construct()
    {
        $db = new Database();
        $this->conn = $db->getConnection();
    }

    /* ==============================
       PRAYER CHAIN (Weekly)
       ============================== */

    public function getCurrentPrayerChain()
    {
        $sql = "
            SELECT prayer_of_the_week, activity_type, activity_description
            FROM prayer_chain
            ORDER BY week_start DESC
            LIMIT 1
        ";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /* ==============================
       PRAYER REQUESTS
       ============================== */

    public function getAllPrayerRequests()
    {
        $sql = "
            SELECT first_name, message, created_at
            FROM prayer_requests
            ORDER BY created_at DESC
        ";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
