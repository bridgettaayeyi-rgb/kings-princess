<?php
require_once __DIR__ . '/../models/admin.php';
session_start();

class AdminController {
    private $model;

    public function __construct() {
        $this->model = new Admin();
        // Force admin login
        if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
            header("Location: index.php?page=login");
            exit;
        }
    }

    public function index() {
        // Fetch devotions
        $devotions  = $this->model->getAllDevotions();
        // Fetch resources, wallpapers, prayer chains if you need them too
        $resources  = $this->model->getAllResources();
        $wallpapers = $this->model->getAllWallpapers();
        $prayers    = $this->model->getAllPrayerChains();
    
        // Include the view with variables defined
        require __DIR__ . '/../view/admin_page.php';
    }
    

    public function createDevotion() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->model->createDevotion(
                $_POST['title'],
                $_POST['scripture'],
                $_POST['message'],
                $_POST['application'],
                $_POST['prayer'],
                $_POST['devotion_date']
            );
            header("Location: index.php?page=admin");
            exit;
        }
    }

    public function deleteDevotion() {
        if (isset($_GET['id'])) {
            $this->model->deleteDevotion($_GET['id']);
            header("Location: index.php?page=admin");
            exit;
        }
    }

    public function editDevotion() {
        if (!isset($_GET['id'])) {
            header("Location: index.php?page=admin");
            exit;
        }
    
        $id = $_GET['id'];
        $devotion = $this->model->getDevotionById($id); // You need this method in your Admin model
    
        require __DIR__ . '/../view/edit_devotion.php';
    }

    public function updateDevotion() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->model->updateDevotion(
                $_POST['id'],
                $_POST['title'],
                $_POST['scripture'],
                $_POST['message'],
                $_POST['application'],
                $_POST['prayer'],
                $_POST['devotion_date']
            );
            header("Location: index.php?page=admin");
            exit;
        }
    }
    

    public function createResource() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->model->createResource(
                $_POST['title'],
                $_POST['description'],
                $_POST['type'],
                $_POST['topic'],
                $_POST['platform'],
                $_POST['link'],
                $_POST['thumbnail'] ?? null
            );
            header("Location: index.php?page=admin");
            exit;
        }
    }

    public function editResource() {
        if (!isset($_GET['id'])) {
            header("Location: index.php?page=admin");
            exit;
        }
    
        $id = $_GET['id'];
        $resource = $this->model->getResourceById($id); // You need this method in your Admin model
    
        require __DIR__ . '/../view/edit_resource.php';
    }

    public function deleteResource() {
        if (isset($_GET['id'])) {
            $this->model->deleteResource($_GET['id']);
            header("Location: index.php?page=admin");
            exit;
        }
    }

    public function updateResource() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->model->updateResource(
                $_POST['id'],
                $_POST['title'],
                $_POST['description'],
                $_POST['type'],
                $_POST['topic'],
                $_POST['platform'],
                $_POST['link'],
                $_POST['thumbnail']
            );
            header("Location: index.php?page=admin");
            exit;
        }
    }
    

    public function setPrayerChain() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->model->setPrayerChain(
                $_POST['week_start'],
                $_POST['prayer_of_the_week'],
                $_POST['activity_type'],
                $_POST['activity_description'] ?? null
            );
            header("Location: index.php?page=admin");
            exit;
        }
    }

    public function addWallpaper() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $title = trim($_POST['title']);

            if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
                $fileTmpPath = $_FILES['image']['tmp_name'];
                $fileName = basename($_FILES['image']['name']);
                $fileName = preg_replace("/[^a-zA-Z0-9\.\-_]/", "", $fileName);

                $uploadDir = __DIR__ . '/../uploads/';
                if (!is_dir($uploadDir)) mkdir($uploadDir, 0755, true);

                $destPath = $uploadDir . $fileName;

                if (move_uploaded_file($fileTmpPath, $destPath)) {
                    $imageUrl = 'uploads/' . $fileName;
                    $this->model->addWallpaper($title, $imageUrl);
                    $_SESSION['success'] = "Wallpaper uploaded successfully!";
                } else {
                    $_SESSION['error'] = "Failed to move uploaded file.";
                }
            } else {
                $_SESSION['error'] = "No file uploaded or upload error.";
            }

            header("Location: index.php?page=admin");
            exit;
        }
    }
    

    public function deleteWallpaper() {
        if (isset($_GET['id'])) {
            $this->model->deleteWallpaper($_GET['id']);
            header("Location: index.php?page=admin");
            exit;
        }
    }

    
}
