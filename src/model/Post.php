<?php
namespace src\model;

    class Post{
        private $pdo;

        public function __construct($pdo){
            $this->pdo = $pdo;
        }

        public function getAll(){
            $stmt = $this->pdo->query("SELECT * FROM posts");
            return $stmt->fetchAll();
        }

        public function addPost($user_id, $content){
            $stmt = $this->pdo->prepare("INSERT INTO posts(user_id, content) VALUES (?, ?)");
            $stmt->execute([$user_id, $content]);
        }

        public function updatePost($id, $user_id, $content){
            $stmt = $this->pdo->prepare("UPDATE posts set content=?, updated_at = NOW() where id=? and user_id=?");
            $stmt-> execute([$content, $id, $user_id]);
        }

        public function deletePost($id){
            $stmt = $this->pdo->prepare("DELETE FROM posts where id=?");
            $stmt-> execute([$id]);
        }

        public function getPostById($id){
            $stmt = $this->pdo->prepare("SELECT * FROM posts where id=?");
            $stmt-> execute([$id]);
            return $stmt->fetch();
        }

        public function getPostsByUserId($user_id){
            $stmt = $this->pdo->prepare("SELECT * FROM posts where user_id=? ORDER BY created_at DESC");
            $stmt-> execute([$user_id]);
            return $stmt->fetchAll();
        }

        // Retrieves all posts and includes the usernames.
        public function getAllRecentPosts(){
            $stmt = $this->pdo->query("SELECT p.*, u.username FROM posts p JOIN users u ON p.user_id = u.id ORDER BY created_at DESC LIMIT 15");
            return $stmt->fetchAll();
        }
    }
?>