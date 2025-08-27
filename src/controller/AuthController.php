<?php

use src\model\User;

require_once __DIR__ . '/../model/User.php';
require __DIR__ . '/../../config/db.php';

class AuthController
{
    public function login()
    {
        $error = null;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $pdo = require __DIR__ . '/../../config/db.php';
            $user = new User($pdo);
            $email = $_POST['email'] ?? '';
            $password = $_POST['password'] ?? '';

            if (empty($email) || empty($password)) {
                $error = 'Email and password are required.';
            } elseif (!$user->login($email, $password)) {
                $error = 'Invalid credentials.';
            } else {
                $_SESSION['user'] = $email;
                header('Location: ' . BASE_URL . '/');
                exit;
            }
        }

        include __DIR__ . '/../view/auth/login.php';
    }

    public function register()
    {
        $error = null;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $pdo = require __DIR__ . '/../../config/db.php';
            $user = new User($pdo);

            $first_name = trim($_POST['first_name'] ?? '');
            $last_name = trim($_POST['last_name'] ?? '');
            $username = trim($_POST['username'] ?? '');
            $email = trim($_POST['email'] ?? '');
            $password = $_POST['password'] ?? '';
            $confirm = $_POST['confirm_password'] ?? '';
            $gender = $_POST['gender'] ?? '';
            $birth_date = $_POST['birth_date'] ?? '';

            if (
                $first_name === '' || $last_name === '' || $username === '' ||
                $email === '' || $password === '' || $confirm === '' ||
                $gender === '' || $birth_date === ''
            ) {
                $error = 'Please fill in all required fields.';
            } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $error = 'Invalid email.';
            } elseif ($password !== $confirm) {
                $error = 'Passwords do not match.';
            } else {
                $ok = $user->register($first_name, $last_name, $username, $email, $password, $gender, $birth_date);

                if ($ok) {
                    if ($user->login($email, $password)) {
                        $_SESSION['user'] = $email;
                        header('Location: ' . BASE_URL . '/index.php?controller=profile&action=index');
                        exit;
                    }
                    $error = 'Registered, but auto-login failed. Please log in.';
                } else {
                    $error = 'Registration failed. Please try again.';
                }
            }
        }

        include __DIR__ . '/../view/auth/register.php';
    }

    public function logout()
    {
        session_destroy();
        header('Location: ' . BASE_URL . '/index.php?controller=auth&action=login');
        exit;
    }
}