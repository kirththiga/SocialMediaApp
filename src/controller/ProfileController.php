<?php
namespace src\controller;

require_once __DIR__ . '/../model/User.php';
require_once __DIR__ . '/../model/Post.php';
use src\model\User;
use src\model\Post;

class ProfileController{
    
    private $user;
    private $post;

    public function __construct() {
        $pdo = require __DIR__ . '/../../config/db.php';
        $this->user = new User($pdo);
        $this->post = new Post($pdo);
    }

    public function index(){
        //show a list of posts for the user
        $email = $_SESSION['user'];
        $user = $this->user->getUserByEmail($email);
        
        $id = $user['id'];
        $posts = $this->post->getPostsByUserId($id);
        include __DIR__.'/../view/posts/index.php';
    }

    public function create(){
        $user_id = htmlspecialchars(trim($_GET["user_id"] ?? ''));
        $content = htmlspecialchars(trim($_POST["content"] ?? ''));

        if($user_id === '' || $content === '') {
            die("Invalid input");
        }

        // saves the user's input in the database
        $this->post->addPost($user_id, $content);

        header("Location: index.php?controller=profile&action=index");
        exit;
    }

    public function edit($post_id, $user_id){
        // retreive post to edit and display the information on the form
        $user = $this->user->getUserById($user_id);
        $post = $this->post->getPostById($post_id);
        include __DIR__.'/../view/posts/edit.php';
    }

    public function update(){
        $id = htmlspecialchars(trim($_POST["post_id"] ?? ''));
        $user_id = htmlspecialchars(trim($_POST["user_id"] ?? ''));
        $content = htmlspecialchars(trim($_POST["content"] ?? ''));

        if($id <=0 || $user_id === '' || $content === '') {
            die("Invalid input");
        }

        // saves the updated information in the database
        $this->post->updatePost($id, $user_id, $content);

        header("Location: index.php?controller=profile&action=index");
        exit;
    }

    public function delete($id){
        $this->post->deletePost($id);
        header("Location: index.php?controller=profile&action=index");
    }
}

?>