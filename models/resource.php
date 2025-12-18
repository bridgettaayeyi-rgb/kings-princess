<?php

require_once __DIR__ . '/../config/kp_database.php';

class Resource {

    private PDO $conn;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    /**
     * Fetch resources by single type
     */
    private function getByType(string $type): array {
        $sql = "SELECT * FROM resources WHERE type = :type ORDER BY created_at DESC";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':type', $type, PDO::PARAM_STR);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Fetch audio resources
     */
    public function getAudios(): array {
        return $this->getByType('audio');
    }

    /**
     * Fetch video resources
     */
    public function getVideos(): array {
        return $this->getByType('video');
    }

    /**
     * Fetch books and articles together
     */
    public function getReadings(): array {
        $sql = "
            SELECT * FROM resources
            WHERE type IN ('book', 'article')
            ORDER BY created_at DESC
        ";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Admin: create new resource
     */
    public function create(array $data): bool {
        $sql = "
            INSERT INTO resources
            (title, description, type, topic, platform, link, thumbnail)
            VALUES
            (:title, :description, :type, :topic, :platform, :link, :thumbnail)
        ";

        $stmt = $this->conn->prepare($sql);

        return $stmt->execute([
            ':title'       => $data['title'],
            ':description' => $data['description'],
            ':type'        => $data['type'],
            ':topic'       => $data['topic'],
            ':platform'    => $data['platform'],
            ':link'        => $data['link'],
            ':thumbnail'   => $data['thumbnail'] ?? null
        ]);
    }
}
