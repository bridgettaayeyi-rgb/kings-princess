<?php

require_once __DIR__ . '/../models/resource.php';

class ResourcesController {

    private Resource $model;

    public function __construct() {
        $this->model = new Resource();
    }

    public function index(): void {

        // These variable names MUST match the view
        $audios   = $this->model->getAudios();
        $videos   = $this->model->getVideos();
        $readings = $this->model->getReadings();

        require __DIR__ . '/../view/resources_page.php';
    }
}
