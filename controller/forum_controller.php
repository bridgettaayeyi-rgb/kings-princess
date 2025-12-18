<?php
require_once __DIR__ . '/../models/forum.php';
session_start();

class ForumController {

    private $forum;

    public function __construct() {
        $this->forum = new Forum();
    }

    // Display forum page, handle post & reply submissions
    public function index() {

        // Require login for posting/replying
        $userId = $_SESSION['user_id'] ?? null;

        // Handle creating a new post
        if ($userId && isset($_POST['post'])) {
            $title = trim($_POST['title']);
            $content = trim($_POST['content']);
            if ($title && $content) {
                $this->forum->createPost($userId, $title, $content);
                header("Location: index.php?page=forum");
                exit;
            }
        }

        // Handle adding a reply
        if ($userId && isset($_POST['reply'])) {
            $postId = $_POST['post_id'];
            $content = trim($_POST['content']);
            if ($postId && $content) {
                $this->forum->addReply($postId, $userId, $content);
                header("Location: index.php?page=forum");
                exit;
            }
        }

        // Get all posts and their replies
        $posts = $this->forum->getAllPosts();
        foreach ($posts as &$post) {
            $post['replies'] = $this->forum->getRepliesByPost($post['id']);
        }

        require __DIR__ . '/../view/forum_page.php';
    }
}
?>
