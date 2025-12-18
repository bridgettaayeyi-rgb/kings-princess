<?php
require_once __DIR__ . '/../config/kp_database.php';

class Admin {
    private $conn;

    public function __construct() {
        $db = new Database();
        $this->conn = $db->getConnection();
    }

    /* ================= DEVOTIONS ================= */
    public function createDevotion($title, $scripture, $message, $application, $prayer, $date) {
        $stmt = $this->conn->prepare(
            "INSERT INTO devotions (title, scripture, message, application, prayer, devotion_date)
             VALUES (?, ?, ?, ?, ?, ?)"
        );
        return $stmt->execute([$title, $scripture, $message, $application, $prayer, $date]);
    }

    public function getDevotionById($id) {
        $stmt = $this->conn->prepare("SELECT * FROM devotions WHERE devotions_id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    

    public function updateDevotion($id, $title, $scripture, $message, $application, $prayer, $date) {
        $stmt = $this->conn->prepare(
            "UPDATE devotions SET title=?, scripture=?, message=?, application=?, prayer=?, devotion_date=?
             WHERE devotions_id=?"
        );
        return $stmt->execute([$title, $scripture, $message, $application, $prayer, $date, $id]);
    }

    public function deleteDevotion($id) {
        $stmt = $this->conn->prepare("DELETE FROM devotions WHERE devotions_id=?");
        return $stmt->execute([$id]);
    }

    /* ================= RESOURCES ================= */
    public function createResource($title, $description, $type, $topic, $platform, $link, $thumbnail=null) {
        $stmt = $this->conn->prepare(
            "INSERT INTO resources (title, description, type, topic, platform, link, thumbnail)
             VALUES (?, ?, ?, ?, ?, ?, ?)"
        );
        return $stmt->execute([$title, $description, $type, $topic, $platform, $link, $thumbnail]);
    }

    public function getResourceById($id) {
        $stmt = $this->conn->prepare("SELECT * FROM resources WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function updateResource($id, $title, $description, $type, $topic, $platform, $link, $thumbnail=null) {
        $stmt = $this->conn->prepare(
            "UPDATE resources SET title=?, description=?, type=?, topic=?, platform=?, link=?, thumbnail=?
             WHERE id=?"
        );
        return $stmt->execute([$title, $description, $type, $topic, $platform, $link, $thumbnail, $id]);
    }

    public function deleteResource($id) {
        $stmt = $this->conn->prepare("DELETE FROM resources WHERE id=?");
        return $stmt->execute([$id]);
    }

    /* ================= PRAYER CHAIN ================= */
    public function setPrayerChain($week_start, $prayer, $activity_type, $activity_description=null) {
        $stmt = $this->conn->prepare(
            "INSERT INTO prayer_chain (week_start, prayer_of_the_week, activity_type, activity_description)
             VALUES (?, ?, ?, ?)
             ON DUPLICATE KEY UPDATE prayer_of_the_week=?, activity_type=?, activity_description=?"
        );
        return $stmt->execute([$week_start, $prayer, $activity_type, $activity_description,
                               $prayer, $activity_type, $activity_description]);
    }

    /* ================= WALLPAPERS ================= */
    public function addWallpaper($title, $imageUrl) {
        $stmt = $this->conn->prepare("INSERT INTO wallpapers (title, image_url) VALUES (?, ?)");
        return $stmt->execute([$title, $imageUrl]);
    }

    public function deleteWallpaper($id) {
        $stmt = $this->conn->prepare("DELETE FROM wallpapers WHERE id=?");
        return $stmt->execute([$id]);
    }

    public function getAllDevotions() {
        return $this->conn->query("SELECT * FROM devotions ORDER BY devotion_date DESC")
                          ->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function getAllResources() {
        return $this->conn->query("SELECT * FROM resources ORDER BY created_at DESC")
                          ->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function getAllWallpapers() {
        return $this->conn->query("SELECT * FROM wallpapers ORDER BY id DESC")
                          ->fetchAll(PDO::FETCH_ASSOC);
    }
        /* ================= PRAYER CHAINS ================= 
    public function setPrayerChain($week_start, $prayer, $activity_type, $activity_description=null) {
        $stmt = $this->conn->prepare(
            "INSERT INTO prayer_chain (week_start, prayer_of_the_week, activity_type, activity_description)
             VALUES (?, ?, ?, ?)
             ON DUPLICATE KEY UPDATE 
                prayer_of_the_week = VALUES(prayer_of_the_week), 
                activity_type = VALUES(activity_type), 
                activity_description = VALUES(activity_description)"
        );
        return $stmt->execute([$week_start, $prayer, $activity_type, $activity_description]);
    }*/
    
    public function getAllPrayerChains() {
        return $this->conn->query("SELECT * FROM prayer_chain ORDER BY week_start DESC")
                          ->fetchAll(PDO::FETCH_ASSOC);
    }
    
}
