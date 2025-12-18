<?php
require_once __DIR__ . '/../models/devotional_page.php';

class DevotionController {
    private $devotionModel;

    public function __construct() {
        $this->devotionModel = new Devotion();
    }

    public function showTodaysDevotion() {
        $devotion = $this->devotionModel->getTodaysDevotion();
        require __DIR__ . '/../view/devotions_page.php';
    }

    public function showPreviousDevotions() {
        $devotions = $this->devotionModel->getPreviousDevotions();
        require __DIR__ . '/../view/previous_devotions.php';
    }

    public function show($id) {
        if (!$id) {
            header("Location: index.php?page=previousDevotions");
            exit;
        }

        $devotion = $this->devotionModel->getDevotionById($id);

        if (!$devotion) {
            header("Location: index.php?page=previousDevotions");
            exit;
        }

        require __DIR__ . '/../view/devotions_page.php';
    }
}
?>
