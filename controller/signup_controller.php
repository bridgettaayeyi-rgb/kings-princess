<?php
require_once __DIR__ . '/../models/user.php';

class SignUpController {
    private $model;

    // List of emails allowed to become admin
    private $approvedAdmins = [
        "bridgettaayeyi@gmail.com"
        "briellemay@gmail.com"
    ];

    public function __construct() {
        $this->model = new UserModel(); 
    }

    public function handleSignUp() {

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            require __DIR__ . '/../view/signup_popup.php';
            return;
        }

        $first_name = trim($_POST['first_name']);
        $last_name  = trim($_POST['last_name']);
        $username   = trim($_POST['username']);
        $email      = trim($_POST['email']);
        $password   = $_POST['password'];
        $confirm    = $_POST['confirm_password'];

        // Password check
        if ($password !== $confirm) {
            $response = ['status' => 'error', 'message' => 'Passwords do not match.'];
            require __DIR__ . '/../view/signup_popup.php';
            return;
        }

        // STOP if email already exists
        if ($this->model->emailExists($email)) {
            $response = ['status' => 'error', 'message' => 'Email is already registered.'];
            require __DIR__ . '/../view/signup_popup.php';
            return;
        }

        // Hash password once
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Determine role
        $role = in_array($email, $this->approvedAdmins) ? "admin" : "user";

        // Create user (admin or normal user)
        $this->model->createUser(
            $first_name,
            $last_name,
            $username,
            $email,
            $hashedPassword,
            $role
        );

        $_SESSION['success'] = ucfirst($role) . " Account created successfully. Please log in.";
        header("Location: index.php?page=login");
        exit;
    }
}
?>
