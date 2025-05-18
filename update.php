<?php
// F. Menerapkan operasi dasar pengelolaan data pada suatu website (CRUD - Create, Read, Update, Delete)
include('Database.php');
include('Game.php');

require_once 'auth_functions.php';
session_start();
redirect_if_not_logged_in();

$db = new Database();
$game = new Game($db);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $image_choice = $_POST['image-choice'] ?? 'current';
    
    $img_path = '';
    if ($image_choice === 'current') {
        $current_game = $game->getGameById($_POST['id']);
        $img_path = $current_game['img'];
    } else {
        $img_path = $game->handleImageUpload($image_choice);
    }
    
    if ($game->updateGame($_POST['id'], $_POST['name'], $_POST['description'], $_POST['price'], $img_path)) {
        header("Location: index.php");
        exit();
    }
}
?>