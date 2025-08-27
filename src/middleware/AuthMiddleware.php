<?php

class AuthMiddleware
{
    public function handle()
    {
        if (!isset($_SESSION['user'])) {
            $basePath = rtrim(dirname($_SERVER['PHP_SELF']), '/');
            header("Location: $basePath/index.php?controller=auth&action=login");
            exit;
        }
    }
}

?>
