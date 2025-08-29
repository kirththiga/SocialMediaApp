<?php

function csrf_boot()
{
    if (session_status() !== PHP_SESSION_ACTIVE) session_start();
    if (!isset($_SESSION['csrf'])) $_SESSION['csrf'] = [];
}

// single use token creation
function csrf_token(string $form = 'default'): string
{
    csrf_boot();
    $t = bin2hex(random_bytes(32));
    $_SESSION['csrf'][$form] = $t; // store last token for that form
    return $t;
}

// input HTML to put in form
function csrf_input(string $form = 'default'): string
{
    csrf_boot();
    $t = csrf_token($form);
    return '<input type="hidden" name="csrf_token" value="' . htmlspecialchars($t, ENT_QUOTES, 'UTF-8') . '">' .
        '<input type="hidden" name="csrf_form"  value="' . htmlspecialchars($form, ENT_QUOTES, 'UTF-8') . '">';
}

// consume and validate token
function csrf_validate(string $form = 'default'): bool
{
    csrf_boot();
    $sent = $_POST['csrf_token'] ?? ($_SERVER['HTTP_X_CSRF_TOKEN'] ?? null);
    $saved = $_SESSION['csrf'][$form] ?? null;

    unset($_SESSION['csrf'][$form]);
    return is_string($sent) && is_string($saved) && hash_equals($saved, $sent);
}