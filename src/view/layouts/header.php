<?php
$BASE = defined('BASE_URL') ? BASE_URL : (rtrim(dirname($_SERVER['SCRIPT_NAME']), '/\\') ?: '.');
?>

<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Social Media App</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
          integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- <link rel="stylesheet" href="/assets/profile.css"> -->
    <style>
        .profile-pic {
            width: 150px;
            height: 150px;
            object-fit: cover;
            border-radius: 50%;
            border: 3px solid #ddd;
        }
    </style>
</head>
<body>
<?php
if (isset($_SESSION['user'])) { ?>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow-sm">
        <div class="container">
            <a class="navbar-brand fw-bold" href="#">FakeBook</a>
            <div class="d-flex ms-auto gap-2">
                <a href="<?= $BASE ?>/index.php?controller=profile&action=index" class="btn btn-outline-light btn-sm">Home</a>
                <a href="<?= $BASE ?>/index.php?controller=auth&action=logout" class="btn btn-light btn-sm">Logout</a>
            </div>
        </div>
    </nav>
<?php } else { ?>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow-sm">
        <div class="container">
            <a class="navbar-brand fw-bold" href="#">FakeBook</a>
            <div class="d-flex ms-auto gap-2">
                <a href="<?= $BASE ?>/index.php?controller=auth&action=login"
                   class="btn btn-outline-light btn-sm">Login</a>
                <a href="<?= $BASE ?>/index.php?controller=auth&action=register"
                   class="btn btn-light btn-sm">Register</a>
            </div>
        </div>
    </nav>
<?php } ?>
<div class="container mt-5">
