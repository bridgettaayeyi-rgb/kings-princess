<?php
require_once __DIR__ . '/../models/prayer_request.php';

class PrayerRequestController {
    private $prayerModel;

    public function __construct() {
        $this->prayerModel = new PrayerRequest();
    }

    public function showForm() {
        // Just include the view
        require __DIR__ . '/../view/prayer_modal.php';
    }

    public function handleSubmission() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $first_name = trim($_POST['first_name'] ?? '');
            $last_name = trim($_POST['last_name'] ?? '');
            $email = trim($_POST['email'] ?? '');
            $message = trim($_POST['message'] ?? '');

            $errors = [];

            if ($first_name === '') $errors[] = "First Name is required.";
            if ($last_name === '') $errors[] = "Last Name is required.";
            if ($message === '') $errors[] = "Prayer message is required.";

            if (!empty($errors)) {
                $status = 'error';
                $msg = implode('<br>', $errors);
            } else {
                $success = $this->prayerModel->addRequest($first_name, $last_name, $email, $message);
                if ($success) {
                    $status = 'success';
                    $msg = "Your prayer request has been submitted. 🙏";
                } else {
                    $status = 'error';
                    $msg = "Failed to submit. Please try again.";
                }
            }

            // Send feedback to view
            $response = ['status' => $status, 'message' => $msg];
            require __DIR__ . '/../view/prayer_modal.php';
        }
    }
}
?>
