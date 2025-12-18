<?php
require_once __DIR__ . '/../config/kp_database.php';

class Forum {
    private $conn;

    public function __construct() {
        $db = new Database();
        $this->conn = $db->getConnection();
    }

    // Get all posts
    public function getAllPosts() {
        $stmt = $this->conn->prepare("
            SELECT fp.id, fp.title, fp.content, fp.created_at, m.username AS name
            FROM forum_posts fp
            JOIN members m ON fp.user_id = m.id
            ORDER BY fp.created_at DESC
        ");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Get replies for a post
    public function getRepliesByPost($postId) {
        $stmt = $this->conn->prepare("
            SELECT fr.id, fr.content, fr.created_at, m.username AS name
            FROM forum_replies fr
            JOIN members m ON fr.user_id = m.id
            WHERE fr.post_id = ?
            ORDER BY fr.created_at ASC
        ");
        $stmt->execute([$postId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Create new post
    public function createPost($userId, $title, $content) {
        $stmt = $this->conn->prepare("
            INSERT INTO forum_posts (user_id, title, content)
            VALUES (?, ?, ?)
        ");
        return $stmt->execute([$userId, $title, $content]);
    }

    // Add reply
    public function addReply($postId, $userId, $content) {
        $stmt = $this->conn->prepare("
            INSERT INTO forum_replies (post_id, user_id, content)
            VALUES (?, ?, ?)
        ");
        return $stmt->execute([$postId, $userId, $content]);
    }
}
?>
