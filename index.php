<?php


if (empty($_SESSION['user_id']) && !empty($_COOKIE['remember_me'])) {
    require_once 'models/user.php';
    $userModel = new User();

    $token = $_COOKIE['remember_me'];
    $tokenHash = hash('sha256', $token);

    $user = $userModel->findByRememberToken($tokenHash);

    if ($user) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
    }
}

// Enable error reporting for debugging (remove in production)
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Determine requested page
$page = $_GET['page'] ?? 'home';

// Simple routing
switch($page) {

    // ===== HOME PAGE =====
    case 'home':
        include 'view/home.php';
        break;

    case 'login':
        require_once 'controller/login_controller.php';
        $controller = new LoginController();
        $controller->login();
        break;

    case 'signup':
        require_once 'controller/signup_controller.php';
        $controller = new SignUpController();
        $controller->handleSignUp();
        break;

    // ===== DEVOTIONS PAGE =====
    case 'devotions':
        require_once 'controller/devotion_controller.php';
        $controller = new DevotionController();
        $controller->showTodaysDevotion();
        break;

    // ===== PRAYER REQUEST PAGE =====
    case 'prayerrequest':
        require_once 'controller/prayer_request_controller.php';
        $controller = new PrayerRequestController();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $controller->handleSubmission(); // Store data & show message
        } else {
            $controller->showForm(); // Show empty form
        }
        break;

    // ===== 30 DAY CHALLENGE PAGE =====
    case '30daychallenge':
        require_once 'controller/challenge_controller.php';
        $controller = new ChallengeController();
        $controller->showChallenge();
        break;

 // ===== Mark challenge as read =====
    case 'markread':
        require_once 'controller/challenge_controller.php';
        $controller = new ChallengeController();
        $controller->markAsRead();
        break;    

    // ===== PREVIOUS DEVOTIONS PAGE =====
    case 'previousdevotions':
        require_once 'controller/devotion_controller.php';
        $controller = new DevotionController();
        $controller->showPreviousDevotions();
        break;

    case 'showDevotion':
        require_once 'controller/devotion_controller.php';
        $id = $_GET['id'] ?? null;
        (new DevotionController())->show($id);
        break;


    case 'prayerwall':
        require_once 'controller/prayer_wall_controller.php';
        $controller = new PrayerWallController();
        $controller->showWall();
        break;

    
    case 'testimonies':
        require_once "controller/testimony_controller.php";
        $c = new TestimonyController();
        $c->index();
        break;
        
    case 'savetestimony':
        require_once "controller/testimony_controller.php";
        $c = new TestimonyController();
        $c->save();
        break;
        
    case 'editTestimony':
        require_once "controller/testimony_controller.php";
        $c = new TestimonyController();
        $c->edit();
        break;
        
    case 'updateTestimony':
        require_once "controller/testimony_controller.php";
        $c = new TestimonyController();
        $c->update();
        break;
        
    case 'deleteTestimony':
        require_once "controller/testimony_controller.php";
        $c = new TestimonyController();
        $c->delete();
        break;

    // ===== RESOURCES PAGE =====
    case 'resources':
        require_once 'controller/resources_controller.php';
        (new ResourcesController())->index();
        break;

    case 'forum':
        require_once 'controller/forum_controller.php';
        (new ForumController())->index();
        break;
    
    case 'wallpapers':
        require_once 'controller/wallpaper_controller.php';
        (new WallpaperController())->index();
        break;

    // ===== ABOUT PAGE =====
    case 'about':
        include 'view/about.php';
        break;

    // ===== PROFILE PAGE =====
    case 'profile':
        require_once 'controller/profile_controller.php';
        (new ProfileController())->index();
        break;

    case 'logout':
        require_once 'controller/profile_controller.php';
        (new ProfileController())->logout();
        break;

// ===== ADMIN DASHBOARD =====
    case 'admin':
        require_once 'controller/admin_controller.php';
        (new AdminController())->index();
        break;

    // ===== ADMIN ACTIONS =====
    case 'createDevotion':
        require_once 'controller/admin_controller.php';
        (new AdminController())->createDevotion();
        break;

    case 'editDevotion':
        require_once 'controller/admin_controller.php';
        (new AdminController())->editDevotion();
        break;
    
    case 'updateDevotion':
        require_once 'controller/admin_controller.php';
        (new AdminController())->updateDevotion();
        break;
    
    case 'deleteDevotion':
        require_once 'controller/admin_controller.php';
        (new AdminController())->deleteDevotion();
        break;

    case 'createResource':
        require_once 'controller/admin_controller.php';
        (new AdminController())->createResource();
        break;

        case 'editResource':
            require_once 'controller/admin_controller.php';
            (new AdminController())->editResource();
            break;

            case 'deleteResource':
                require_once 'controller/admin_controller.php';
                (new AdminController())->deleteResource();
                break;

                case 'updateResource':
                    require_once 'controller/admin_controller.php';
                    (new AdminController())->updateResource();
                    break;

    case 'setPrayerChain':
        require_once 'controller/admin_controller.php';
        (new AdminController())->setPrayerChain();
        break;

    case 'addWallpaper':
        require_once 'controller/admin_controller.php';
        (new AdminController())->addWallpaper();
        break;

    // ===== DEFAULT =====
    default:
        include 'view/home.php';
        break;
}
?>

