<?php
session_start();

/**
 * Vérifie si l'utilisateur est connecté.
 */
function is_logged_in() {
    return isset($_SESSION['user_id']);
}

/**
 * Vérifie si l'utilisateur est un administrateur.
 */
function is_admin() {
    return isset($_SESSION['role']) && $_SESSION['role'] === 'admin';
}

/**
 * Redirige vers la page de connexion si non connecté.
 */
function require_login() {
    if (!is_logged_in()) {
        header("Location: login.php");
        exit();
    }
}

/**
 * Redirige si l'utilisateur n'est pas admin.
 */
function require_admin() {
    require_login();
    if (!is_admin()) {
        header("Location: index.php");
        exit();
    }
}

/**
 * Retourne les infos de l'utilisateur connecté.
 */
function get_user() {
    return [
        'id' => $_SESSION['user_id'] ?? null,
        'username' => $_SESSION['username'] ?? null,
        'role' => $_SESSION['role'] ?? null
    ];
}
?>
