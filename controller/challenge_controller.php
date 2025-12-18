<?php
require_once __DIR__ . '/../models/challenges.php';


class ChallengeController {
    private $model;
    private $userId;

    public function __construct() {
        // Start session if not already started
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        // Force login
        if (!isset($_SESSION['user_id'])) {
            header("Location: index.php?page=login");
            exit;
        }

        $this->userId = $_SESSION['user_id'];

        // Initialize model
        $this->model = new Challenge();
    }

    /**
     * Show challenge for a given day
     */
    public function showChallenge() {
        // Default day = 1 if not set
        $day = isset($_GET['day']) ? (int)$_GET['day'] : 1;

        // Fetch challenge data for this day
        $challenge = $this->model->getDay($day);

        // Fetch progress info
        $progress = $this->model->getReadStatus($this->userId, $day);  // true/false
        $completed = $this->model->countRead($this->userId);            // total days read
        $percent = ($completed / 30) * 100;                              // progress %

        // Load the view
        require __DIR__ . '/../view/challenge_page.php';
    }

    /**
     * Mark a day as read for the logged-in user
     */
    public function markAsRead() {
        // Force login check
        if (!isset($_SESSION['user_id'])) {
            header("Location: index.php?page=login");
            exit;
        }

        $userId = $_SESSION['user_id'];
        $day = isset($_POST['day']) ? (int)$_POST['day'] : 1;

        // Update database
        $this->model->markAsRead($userId, $day);

        // Redirect back to same day
        header("Location: index.php?page=30daychallenge&day=" . $day);
        exit;
    }
}
?>
