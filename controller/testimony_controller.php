<?php
session_start();
require_once __DIR__ . '/../models/testimony.php';

class TestimonyController {

    private $model;

    public function __construct() {
        $this->model = new Testimony();
    }

    public function index() {
        $testimonies = $this->model->getAll();
        require __DIR__ . '/../view/testimonies.php';
    }

    public function save() {
        if (!isset($_SESSION['user_id'])) {
            $_SESSION['redirect_after_login'] = 'testimonies';
            header("Location: index.php?page=login");
            exit;
        }
    
        $testimony = $_POST['testimony'];
        $user_id = $_SESSION['user_id'];
    
        $this->model->save($testimony, $user_id);
        header("Location: index.php?page=testimonies");
        exit;
    }

    public function edit(){ 
    if (!isset($_SESSION['user_id'])) {
        header("Location: index.php?page=login");
        exit;
    }
    
        $id = $_GET['testimonies_id'] ?? null;
        $testimony = $this->model->getById($id);

        if ($testimony['user_id'] != $_SESSION['user_id']) {
            die("Unauthorized");
        }

        require __DIR__ . '/../view/edit_testimony.php';
    }

    public function update() {
        if (!isset($_SESSION['user_id'])) {
            header("Location: index.php?page=login");
            exit;
        }
        $id = $_POST['testimonies_id'];
        $testimony = $_POST['testimony'];
        $user_id = $_SESSION['user_id'];

        $this->model->update($id, $testimony, $user_id);
        header("Location: index.php?page=testimonies");
        exit;
    }

    public function delete() {
        if (!isset($_SESSION['user_id'])) {
            header("Location: index.php?page=login");
            exit;
        }
        $id = $_GET['testimonies_id'] ?? null;
        $user_id = $_SESSION['user_id'];

        $this->model->delete($id, $user_id);
        header("Location: index.php?page=testimonies");
        exit;
    }
}
