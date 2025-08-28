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
        // Collect errors and sticky form data
        $errors = [];
        $form = [
            'first_name' => '',
            'last_name' => '',
            'username' => '',
            'email' => '',
            'gender' => '',
            'birth_date' => '',
            'location' => '',
            'bio' => ''
        ];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $pdo = require __DIR__ . '/../../config/db.php';
            $user = new User($pdo);

            // Grab inputs (trim strings)
            $form['first_name'] = trim($_POST['first_name'] ?? '');
            $form['last_name'] = trim($_POST['last_name'] ?? '');
            $form['username'] = trim($_POST['username'] ?? '');
            $form['email'] = trim($_POST['email'] ?? '');
            $password = $_POST['password'] ?? '';
            $confirm = $_POST['confirm_password'] ?? '';
            $form['gender'] = $_POST['gender'] ?? '';
            $form['birth_date'] = $_POST['birth_date'] ?? '';
            $form['location'] = trim($_POST['location'] ?? '');
            $form['bio'] = trim($_POST['bio'] ?? '');

            // Required fields
            if (
                $form['first_name'] === '' || $form['last_name'] === '' ||
                $form['username'] === '' || $form['email'] === '' ||
                $password === '' || $confirm === '' ||
                $form['gender'] === '' || $form['birth_date'] === ''
            ) {
                $errors[] = 'Please fill in all required fields.';
            }

            // password length
            if (strlen($password) < 8) {
                $errors[] = 'Password must be at least 8 characters long.';
            }

            // Email format
            if ($form['email'] !== '' && !filter_var($form['email'], FILTER_VALIDATE_EMAIL)) {
                $errors[] = 'Invalid email.';
            }

            // Password match
            if ($password !== $confirm) {
                $errors[] = 'Passwords do not match.';
            }

            if ($form['email'] !== '' && $user->getUserByEmail($form['email'])) {
                $errors[] = 'Email already exists.';
            }
            if ($form['username'] !== '' && $user->getUserByUsername($form['username'])) {
                $errors[] = 'Username already exists.';
            }

            if (empty($errors)) {
                // Perform registration
                $ok = $user->register(
                    $form['first_name'],
                    $form['last_name'],
                    $form['username'],
                    $form['email'],
                    $password,
                    $form['gender'],
                    $form['birth_date']
                );

                if ($ok) {
                    if (session_status() !== PHP_SESSION_ACTIVE) session_start();

                    $loggedIn = $user->login($form['email'], $password); // now array|false
                    if ($loggedIn) {
                        $_SESSION['user_id'] = $loggedIn['id'];
                        $_SESSION['user']    = $loggedIn['email'];
                        header('Location: ' . BASE_URL . '/index.php?controller=profile&action=index');
                        exit;
                    }

                    $errors[] = 'Registered, but auto-login failed. Please log in.';
                } else {
                    $errors[] = 'Registration failed. Please try again.';
                }
            }
        }

        $error = null;
        include __DIR__ . '/../view/auth/register.php';
    }

    public function logout()
    {
        session_destroy();
        header('Location: ' . BASE_URL . '/index.php?controller=auth&action=login');
        exit;
    }
}