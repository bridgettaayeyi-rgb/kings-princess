<?php
require_once __DIR__ . '/../config/kp_database.php';

class Login {
    private $conn;

    public function __construct() {
        $db = new Database();
        $this->conn = $db->getConnection();

        // Enable PDO exceptions for easier debugging
        $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    /**
     * Authenticate user by username and password
     */
    public function authenticate($username, $password) {
        $stmt = $this->conn->prepare("SELECT * FROM members WHERE username = :username LIMIT 1");
        $stmt->bindParam(':username', $username);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        // Verify password
        if ($user && password_verify($password, $user['password'])) {
            return $user;
        }

        return false;
    }

    /**
     * Store a hashed remember token for "remember me" functionality
     */
    public function storeRememberToken($user_id, $tokenHash) {
        $stmt = $this->conn->prepare("UPDATE members SET remember_token = :token WHERE id = :id");
        $stmt->bindParam(':token', $tokenHash);
        $stmt->bindParam(':id', $user_id);
        $stmt->execute();
    }

    /**
     * Find a user by a hashed remember token
     */
    public function findByRememberToken($tokenHash) {
        $stmt = $this->conn->prepare("SELECT * FROM members WHERE remember_token = :token LIMIT 1");
        $stmt->bindParam(':token', $tokenHash);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
?>
