<?php

namespace src\model;

use PDO;

class User
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function getAll()
    {
        $stmt = $this->pdo->query("SELECT * FROM users");
        return $stmt->fetchAll();
    }

    public function addUser($first_name, $last_name, $username, $email, $password, $gender, $birth_date, $location, $bio, $profile_pic)
    {
        $stmt = $this->pdo->prepare("INSERT INTO users(first_name, last_name, username, email, password, gender, birth_date, location, bio, profile_pic) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->execute([$first_name, $last_name, $username, $email, $password, $gender, $birth_date, $location, $bio, $profile_pic]);
    }

    public function updateUser($id, $first_name, $last_name, $username, $email, $password, $gender, $birth_date, $location, $bio, $profile_pic)
    {
        $stmt = $this->pdo->prepare("UPDATE users set first_name=?, last_name=?, username=?, email=?, password=?, gender=?, birth_date=?, location=?, bio=?, profile_pic=? where id=?");
        $stmt->execute([$first_name, $last_name, $username, $email, $password, $gender, $birth_date, $location, $bio, $profile_pic, $id]);
    }

    public function deleteUser($id)
    {
        $stmt = $this->pdo->prepare("DELETE FROM users where id=?");
        $stmt->execute([$id]);
    }

    public function getUserById($id)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM users where id=?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public function getUserByEmail($email)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM users where email=?");
        $stmt->execute([$email]);
        return $stmt->fetch();
    }

    public function login(string $email, string $password): bool
    {
        $stmt = $this->pdo->prepare("SELECT id, email, password FROM users WHERE email = ? LIMIT 1");
        $stmt->execute([$email]);
        $row = $stmt->fetch();
        if (!$row) return false;
        return password_verify($password, $row['password']);
    }

    public function register($first_name, $last_name, $username, $email, $password, $gender, $birth_date): bool
    {
        $hash = password_hash($password, PASSWORD_DEFAULT);

        $sql = "INSERT INTO users
                (first_name, last_name, username, email, password, gender, birth_date)
                VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->pdo->prepare($sql);
        try {
            return $stmt->execute([$first_name, $last_name, $username, $email, $hash, $gender, $birth_date]);
        } catch (\PDOException $e) {
            return false;
        }
    }
}

?>