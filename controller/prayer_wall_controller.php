<?php

require_once __DIR__ . '/../models/prayer_chain.php';

class PrayerWallController
{
    private PrayerChain $model;

    public function __construct()
    {
        $this->model = new PrayerChain();
    }

    public function showWall()
    {
        // Fetch prayer chain data
        $prayerChain = $this->model->getCurrentPrayerChain();
        $allRequests = $this->model->getAllPrayerRequests();

        // Load the view
        require __DIR__ . '/../view/prayer_wall.php';
    }
}
