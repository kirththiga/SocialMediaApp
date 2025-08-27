<?php
namespace src\model;

    class User{
        private $pdo;

        public function __construct($pdo){
            $this->pdo = $pdo;
        }

        public function getAll(){
            $stmt = $this->pdo->query("SELECT * FROM users");
            return $stmt->fetchAll();
        }

        public function addUser($first_name, $last_name, $username, $email, $password, $gender, $birth_date, $location, $bio, $profile_pic){
            $stmt = $this->pdo->prepare("INSERT INTO users(first_name, last_name, username, email, password, gender, birth_date, location, bio, profile_pic) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt->execute([$first_name, $last_name, $username, $email, $password, $gender, $birth_date, $location, $bio, $profile_pic]);
        }

        public function updateUser($id, $first_name, $last_name, $username, $email, $password, $gender, $birth_date, $location, $bio, $profile_pic){
            $stmt = $this->pdo->prepare("UPDATE users set first_name=?, last_name=?, username=?, email=?, password=?, gender=?, birth_date=?, location=?, bio=?, profile_pic=? where id=?");
            $stmt-> execute([$first_name, $last_name, $username, $email, $password, $gender, $birth_date, $location, $bio, $profile_pic, $id]);
        }

        public function deleteUser($id){
            $stmt = $this->pdo->prepare("DELETE FROM users where id=?");
            $stmt-> execute([$id]);
        }

        public function getUserById($id){
            $stmt = $this->pdo->prepare("SELECT * FROM users where id=?");
            $stmt-> execute([$id]);
            return $stmt->fetch();
        }
    }
?>