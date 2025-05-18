<?php
// auth_functions.php

function db_connect() {
    static $conn;
    if (!$conn) {
        $conn = new mysqli('localhost', 'root', '', 'nintendo1');
        if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);
    }
    return $conn;
}

function hash_password($password) {
    return password_hash($password, PASSWORD_DEFAULT);
}

function verify_password($password, $hashed_password) {
    return password_verify($password, $hashed_password);
}

function redirect_if_not_logged_in() {
    if (!isset($_SESSION['user_id'])) {
        header("Location: login.php");
        exit();
    }
}

function csrf_token() {
    if (empty($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf_token'];
}
?>