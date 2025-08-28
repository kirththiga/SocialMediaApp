<?php

//store session locally instead of XAMPP folder
$sessionDir = __DIR__ . '/../tmp';
if (!is_dir($sessionDir)) mkdir($sessionDir, 0777, true);
session_save_path($sessionDir);
if (session_status() !== PHP_SESSION_ACTIVE) session_start();

if (!defined('BASE_URL')) {
    $base = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/\\');
    define('BASE_URL', $base ?: '.');
}

$pdo = require_once __DIR__ . '/../config/db.php';

require_once __DIR__ . '/../src/middleware/AuthMiddleware.php';
require_once __DIR__ . '/../src/controller/AuthController.php';
require_once __DIR__ . '/../src/controller/ProfileController.php';

$controller = strtolower($_GET['controller'] ?? 'profile');
$action = $_GET['action'] ?? 'index';

switch ($controller) {
    case 'auth':
    {
        $ctrl = new AuthController();
        switch ($action) {
            case 'login':
                $ctrl->login();
                break;
            case 'logout':
                $ctrl->logout();
                break;
            case 'register':
                $ctrl->register();
                break;
            default:
                http_response_code(404);
                echo 'Auth action not found';
        }
        break;
    }

    case 'profile':
    {
        $auth = new AuthMiddleware();
        $auth->handle();

        $ctrl = new \src\controller\ProfileController();
        switch ($action) {
            case 'index':
                $ctrl->index();
                break;
            case 'create':
                $ctrl->create();
                break;
            case 'edit':
                $ctrl->edit($_GET['post_id'] ?? null, $_GET['user_id'] ?? null);
                break;
            case 'update':
                if ($_SERVER['REQUEST_METHOD'] === 'POST') $ctrl->update();
                else {
                    http_response_code(405);
                    echo 'Method Not Allowed';
                }
                break;
            case 'delete':
                if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['post_id'])) {
                    $ctrl->delete($_POST['post_id']);
                } else {
                    http_response_code(400);
                    echo 'Bad Request';
                }
                break;
            case 'edit_profile':
                $ctrl->editProfile();
                break;
            case 'update_profile':
                if ($_SERVER['REQUEST_METHOD'] === 'POST') $ctrl->updateProfile();
                else {
                    http_response_code(405);
                    echo 'Method Not Allowed';
                }
                break;
            case 'feed':
                $ctrl->feed();
                break;
            default:
                http_response_code(404);
                echo 'Profile action not found';
        }
        break;
    }

    default:
        http_response_code(404);
        echo 'Unknown controller';
}