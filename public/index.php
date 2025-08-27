<?php
require_once __DIR__ . '/../config/db.php';
require_once __DIR__  . '/../src/controller/ProfileController.php';

use src\controller\ProfileController;

$action= $_GET['action'] ?? 'index';
$controller = new ProfileController();

switch($action){
    case 'create':
        $controller -> create();
        break;

    case 'edit':
        $controller -> edit($_GET['post_id'] ?? null, $_GET['user_id'] ?? null);
        break;

    case 'update':
        $controller -> update();
        break;

    case 'delete':
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['post_id'])) {
            $id = $_POST['post_id'];
            $controller->delete($id);
        }
        break;

    default:
        $controller-> index();
        break;
    }
?>