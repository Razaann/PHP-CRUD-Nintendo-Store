<?php
// F. Menerapkan operasi dasar pengelolaan data pada suatu website (CRUD - Create, Read, Update, Delete)
include('Database.php');
include('Game.php');

require_once 'auth_functions.php';
session_start();
redirect_if_not_logged_in();

$db = new Database();
$gameModel = new Game($db);
$games = $gameModel->getAllGames();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OOP Razaan</title>
    <link rel="stylesheet" href="form.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lexend:wght@100..900&display=swap" rel="stylesheet">
    <script src="form.js" defer></script>
</head>
<body>
    <!-- C. Terdapat formulir isian pada website (bisa dalam bentuk fitur menambah data barang dll) -->
    <h1>Add Nintendo Game</h1>
    <form action="insert.php" method="POST" enctype="multipart/form-data">
        <label for="name">Game Name:</label>
        <input type="text" id="name" name="name" required>
        
        <label for="description">Description:</label>
        <textarea id="description" name="description" rows="4" required></textarea>
        
        <label for="price">Price:</label>
        <input type="number" id="price" name="price" min="0" required>
        
        <label>Image Selection:</label><br><br>
        <div class="image-options">
            <input type="radio" id="upload-option" name="image-choice" value="upload" checked>
            <label for="upload-option">Upload New Image</label>
            
            <input type="radio" id="url-option" name="image-choice" value="url">
            <label for="url-option">Use Image URL</label>
        </div>
        
        <br><br>
        <div id="upload-section">
            <label for="img">Upload Image:</label>
            <input type="file" id="img" name="img" accept="image/*" onchange="previewImage(this, 'upload')">
        </div>
        
        <div id="url-section" style="display:none;">
            <label for="img_url">Image URL:</label>
            <input type="url" id="img_url" name="img_url" placeholder="https://example.com/image.jpg" onchange="previewImage(this, 'url')">
        </div>
        
        <img id="image-preview" class="preview-image" src="#" alt="Image Preview">
        
        <input type="submit" value="Add Game">
    </form>

    <h1>Games List</h1>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Description</th>
                <th>Price</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $games->fetch_assoc()) : ?>
                <tr>
                    <td><?= htmlspecialchars($row['id']); ?></td>
                    <td><?= htmlspecialchars($row['name']); ?></td>
                    <td><?= htmlspecialchars($row['description']); ?></td>
                    <td>Rp <?= number_format($row['price'], 0, ',', '.'); ?></td>
                    <td>
                        <a href="edit.php?id=<?= $row['id'];?>">Edit</a> | 
                        <a href="delete.php?id=<?= $row['id'];?>" onclick="return confirm('Are you sure you want to delete this game?')">Delete</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>

    <div>
    <button id="theme-toggle" onclick="toggleTheme()">
        🌓 Toggle Dark Mode
    </button>
    </div>

    <!-- <footer>
        <p>Copyright &copy; NintendoStore</p>
    </footer> -->

</body>
</html>

<?php $db->closeConnection(); ?>