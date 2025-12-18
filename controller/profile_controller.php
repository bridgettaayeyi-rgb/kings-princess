<?php
require_once __DIR__ . '/../models/profile.php';

class ProfileController {

    private User $model;

    public function __construct() {

        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        // Force authentication
        if (!isset($_SESSION['user_id'])) {
            header("Location: index.php?page=login");
            exit;
        }

        $this->model = new User();
    }

    /**
     * Show profile page
     */
    public function index(): void {

        $userId = $_SESSION['user_id'];
        $user = $this->model->getById($userId);

        if (!$user) {
            die("User not found.");
        }

        require __DIR__ . '/../view/profile_page.php';
    }

    /**
     * Logout user
     */
    public function logout(): void {

        session_destroy();

        header("Location: index.php?page=home");
        exit;
    }
}
