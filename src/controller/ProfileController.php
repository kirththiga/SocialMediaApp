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
        $error = null;
        $user_id = htmlspecialchars(trim($_GET["user_id"] ?? ''));
        $content = htmlspecialchars(trim($_POST["content"] ?? ''));

        if($user_id === '' || $content === '') {
            $error = 'Please fill in content';
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
        $error = null;
        $id = htmlspecialchars(trim($_POST["post_id"] ?? ''));
        $user_id = htmlspecialchars(trim($_POST["user_id"] ?? ''));
        $content = htmlspecialchars(trim($_POST["content"] ?? ''));

        if($id <=0 || $user_id === '' || $content === '') {
            $error = 'Please fill in content.';
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

    public function editProfile(){
        // retreive profile to edit and display the information on the form
        $email = $_SESSION['user'];
        $user = $this->user->getUserByEmail($email);
        include __DIR__.'/../view/profile/edit.php';
    }

    public function updateProfile(){
        $error = null;
        $first_name = htmlspecialchars(trim($_POST['first_name'] ?? ''));
        $last_name = htmlspecialchars(trim($_POST['last_name'] ?? ''));
        $gender = htmlspecialchars($_POST['gender'] ?? '');
        $birth_date = htmlspecialchars($_POST['birth_date'] ?? '');
        $location = htmlspecialchars($_POST['location'] ?? '');
        $bio = htmlspecialchars($_POST['bio'] ?? '');

        $email = $_SESSION['user'];
        $user = $this->user->getUserByEmail($email);
        $username = $user['username'];
        $id = $user['id'];
        $password = $user['password'];
        $profile_pic = $user['profile_pic'];

        if (isset($_POST['remove_photo'])) {
            $profile_pic = null;
        }
        elseif ($_FILES['profile_pic']['name'] != null) {
            $file = $_FILES['profile_pic'];
            $target_dir = '../uploads/';
            $profile_pic = $target_dir . basename($file['name']);
            move_uploaded_file($file['tmp_name'], $profile_pic);
        }
        
        if (
            $first_name === '' || $last_name === '' || $username === '' ||
            $email === '' || $gender === '' || $birth_date === ''
        ) 
        {
            $error = 'Please fill in all required fields.';
        }

        // saves the updated information in the database
        $this->user->updateUser($id, $first_name, $last_name, $username, $email, $password, $gender, $birth_date, $location, $bio, $profile_pic);

        header("Location: index.php?controller=profile&action=index");
        exit;
    }

    public function feed(){
        $email = $_SESSION['user'];
        $user = $this->user->getUserByEmail($email);
        
        //shows all posts from database with username
        $posts = $this->post->getAllRecentPosts();
    
        include __DIR__.'/../view/posts/feed.php';
    }
}

?>