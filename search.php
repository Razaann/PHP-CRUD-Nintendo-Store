<?php
require_once 'Database.php';
require_once 'Game.php';

$db = new Database();
$gameModel = new Game($db);

if (isset($_GET['term'])) {
    $results = $gameModel->searchGamesByName($_GET['term']);
    
    if (empty($results)) {
        echo "<p>No games found</p>";
    } else {
        echo "<div class='search-results'>";
        foreach ($results as $game) {
            echo "<div class='search-item' data-id='" . $game['id'] . "'>";
            echo "<img src='" . htmlspecialchars($game['img']) . "' alt='" . htmlspecialchars($game['name']) . "' class='search-thumbnail'>";
            echo "<div class='search-info'>";
            echo "<p class='search-name'>" . htmlspecialchars($game['name']) . "</p>";
            echo "<p class='search-price'>Rp " . number_format($game['price'], 0, ',', '.') . "</p>";
            echo "</div>";
            echo "</div>";
        }
        echo "</div>";
    }
}
?>