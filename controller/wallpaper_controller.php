<?php
require_once __DIR__ . '/../models/wallpaper.php';

class WallpaperController {
    private $model;

    public function __construct() {
        $this->model = new Wallpaper();
    }

    // Display all wallpapers
    public function index() {
        $wallpapers = $this->model->getAll();
        require __DIR__ . '/../view/wallpaper_page.php';
    }
}
?>
