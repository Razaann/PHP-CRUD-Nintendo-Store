<?php
// F. Menerapkan operasi dasar pengelolaan data pada suatu website (CRUD - Create, Read, Update, Delete)
include('Database.php');
include('Game.php');

require_once 'auth_functions.php';
session_start();
redirect_if_not_logged_in();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $db = new Database();
    $gameModel = new Game($db);
    
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $image_choice = $_POST['image-choice'];
    
    $file = ($image_choice === 'upload') ? $_FILES['img'] : null;
    $img_url = ($image_choice === 'url') ? $_POST['img_url'] : null;
    
    $img_path = $gameModel->handleImageUpload($image_choice, $file, $img_url);
    
    if ($gameModel->createGame($name, $description, $price, $img_path)) {
        header("Location: index.php");
        exit();
    } else {
        echo "Error creating game.";
    }
    
    $db->closeConnection();
}
?>