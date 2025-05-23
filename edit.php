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
    $game = $gameModel->getGameById($_GET['id']);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UTS Razaan</title>
    <link rel="stylesheet" href="form.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lexend:wght@100..900&display=swap" rel="stylesheet">
    <script src="form.js" defer></script>
</head>
<body>
    <h1>Edit Game</h1>
    <form action="update.php" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?php echo $game['id']; ?>">
        
        <label for="name">Game Name:</label>
        <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($game['name']); ?>" required>
        
        <label for="description">Description:</label>
        <textarea id="description" name="description" rows="4" required><?php echo htmlspecialchars($game['description']); ?></textarea>
        
        <label for="price">Price:</label>
        <input type="number" id="price" name="price" value="<?php echo $game['price']; ?>" required>
        
        <label>Image Selection:</label><br><br>
        <div class="image-options">
            <input type="radio" id="keep-current" name="image-choice" value="current" checked>
            <label for="keep-current">Keep Current Image</label>
            
            <input type="radio" id="upload-option" name="image-choice" value="upload">
            <label for="upload-option">Upload New Image</label>
            
            <input type="radio" id="url-option" name="image-choice" value="url">
            <label for="url-option">Use Image URL</label>
        </div>
        
        <br><br>
        <div id="current-section">
            <label>Current Image:</label>
            <img src="<?php echo htmlspecialchars($game['img']); ?>" alt="Current Game Image" class="preview-image">
        </div>
        
        <div id="upload-section" style="display:none;">
            <label for="img">Upload New Image:</label>
            <input type="file" id="img" name="img" accept="image/*" onchange="previewImage(this, 'upload')">
        </div>
        
        <div id="url-section" style="display:none;">
            <label for="img_url">Image URL:</label>
            <input type="url" id="img_url" name="img_url" placeholder="https://example.com/image.jpg" onchange="previewImage(this, 'url')">
        </div>
        
        <img id="image-preview" class="preview-image" src="#" alt="Image Preview" style="display:none;">
        
        <input type="submit" value="Update Game">
    </form>

    <!-- <footer>
        <p>Copyright &copy; NintendoStore</p>
    </footer> -->

</body>
</html>

<?php $db->closeConnection(); ?>