<?php
require_once __DIR__ . '/../models/login.php';

class LoginController {

    private $model;

    public function __construct() {
        $this->model = new Login();
    }

    public function login() {
        session_start();

        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $username = trim($_POST["username"]);
            $password = trim($_POST["password"]);

            // Authenticate user
            $user = $this->model->authenticate($username, $password);

            if ($user) {
                // Set session variables
                $_SESSION["user_id"] = $user["id"];
                $_SESSION["username"] = $user["username"];
                $_SESSION["role"] = $user["role"];

                // Remember me functionality
                if (!empty($_POST['remember_me'])) {
                    $token = bin2hex(random_bytes(32));
                    $tokenHash = hash('sha256', $token);

                    // Store hashed token in database
                    $this->model->storeRememberToken($user['id'], $tokenHash);

                    // Set secure cookie for 30 days
                    setcookie(
                        "remember_me",
                        $token,
                        time() + (86400 * 30), // 30 days
                        "/",                     // valid site-wide
                        "",                      // domain (optional)
                        false,                   // set true if HTTPS
                        true                     // HttpOnly
                    );
                }

                // Redirect to homepage or dashboard
                if ($user['role'] === 'admin') {
                    header("Location: index.php?page=admin"); // Admin dashboard page
                } else {
                    $redirect = $_SESSION['redirect_after_login'] ?? 'home';
                    unset($_SESSION['redirect_after_login']);
                    header("Location: index.php?page=" . $redirect);
                }
                exit;
            } else {
                // Authentication failed
                $error = "Invalid username or password.";
                require __DIR__ . '/../view/login_popup.php';
            }
        } else {
            // Show login popup/form if GET request
            require __DIR__ . '/../view/login_popup.php';
        }
    }

    /**
     * Auto-login using remember-me cookie
     */
    public function autoLogin() {
        if (empty($_SESSION['user_id']) && !empty($_COOKIE['remember_me'])) {
            $token = $_COOKIE['remember_me'];
            $tokenHash = hash('sha256', $token);
            $user = $this->model->findByRememberToken($tokenHash);

            if ($user) {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['role'] = $user['role'];
            }
        }
    }
}
?>
