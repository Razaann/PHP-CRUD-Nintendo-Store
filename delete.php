<?php
// F. Menerapkan operasi dasar pengelolaan data pada suatu website (CRUD - Create, Read, Update, Delete)
include('Database.php');
include('Game.php');

require_once 'auth_functions.php';
session_start();
redirect_if_not_logged_in();

$db = new Database();
$gameModel = new Game($db);

if (isset($_GET['id'])) {
    if ($gameModel->deleteGame($_GET['id'])) {
        header("Location: index.php");
    } else {
        echo "Error deleting game.";
    }
}

$db->closeConnection();
?>