<?php
session_start();
include('Database.php');
include('Game.php');

$db = new Database();
$gameModel = new Game($db);

$sort = $_GET['sort'] ?? 'id_desc';
$games = $gameModel->getAllGames($sort);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UAS Razaan</title>
    <link rel="stylesheet" href="style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lexend:wght@100..900&display=swap" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="form.js" defer></script>
    <script>
        // Improved Livesearch
        $(document).ready(function(){
            // Function to filter the games container based on search results
            function liveSearch(keyword) {
                if(keyword.length) {
                    $.get("search.php", {term: keyword}).done(function(data){
                        $('.result').html(data).show();
                    });
                } else {
                    $('.result').empty().hide();
                }
            }

            // Keyup event for search input
            $('.search-box input[type="text"]').on("keyup", function(){
                var inputVal = $(this).val();
                liveSearch(inputVal);
            });
            
            // Click event for search results
            $(document).on("click", ".search-item", function(){
                var gameName = $(this).find('.search-name').text();
                $('.search-box input[type="text"]').val(gameName);
                $('.result').hide();
                
                // Scroll to the card with the same game name
                $('html, body').animate({
                    scrollTop: $(".card h2:contains('" + gameName + "')").closest('.card').offset().top - 100
                }, 500);
                
                // Highlight the card
                $(".card h2:contains('" + gameName + "')").closest('.card').addClass('highlight');
                setTimeout(function() {
                    $('.card').removeClass('highlight');
                }, 2000);
            });
            
            // Close search results when clicking outside
            $(document).on("click", function(event) {
                if (!$(event.target).closest('.search-box').length) {
                    $('.result').hide();
                }
            });
        });
    </script>
</head>
<body>
    <img src="Nintendo1.svg" alt="Nintendo Logo">
    
    <div class="header-actions">
        <?php if (!isset($_SESSION['user_id'])): ?>
            <!-- Guest: Show Login -->
            <button class="add-btn" onclick="window.location.href='login.php'">Login</button>
        <?php else: ?>
            <!-- Logged-in User: Show Logout + Admin Button -->
            <?php if ($_SESSION['is_admin']): ?>
                <button class="add-btn" onclick="window.location.href='logout.php'">Logout</button>
                <button class="add-btn" onclick="window.location.href='create.php'">Product</button>
            <?php else: ?>
                <button class="add-btn" onclick="window.location.href='logout.php'">Logout</button>
            <?php endif; ?>
        <?php endif; ?>
        
        <div>
            <button id="theme-toggle" onclick="toggleTheme()">
                🌓 Toggle Mode
            </button>
            
            <form method="GET" action="index.php" class="sort-form">
                <select name="sort" onchange="this.form.submit()" class="sort-dropdown">
                    <option value="id_desc" <?= ($sort === 'id_desc') ? 'selected' : '' ?>>Default</option>
                    <option value="name_asc" <?= ($sort === 'name_asc') ? 'selected' : '' ?>>Name (A-Z)</option>
                    <option value="name_desc" <?= ($sort === 'name_desc') ? 'selected' : '' ?>>Name (Z-A)</option>
                    <option value="price_asc" <?= ($sort === 'price_asc') ? 'selected' : '' ?>>Price (Low to High)</option>
                    <option value="price_desc" <?= ($sort === 'price_desc') ? 'selected' : '' ?>>Price (High to Low)</option>
                </select>
            </form>
        </div>
    </div>

    <div class="search-box">
        <input type="text" id="search" placeholder="Search games..." autocomplete="off">
        <div class="result"></div>
    </div>

    <!-- A. Menerapkan penggunaan struktur perulangan (while atau for atau do while) -->
    <div class="container">
        <?php while ($row = $games->fetch_assoc()) : ?>
            <div class="card">
                <img src="<?= htmlspecialchars($row['img']) ?>" alt="<?= htmlspecialchars($row['name']) ?>">
                <h2><?= htmlspecialchars($row['name']) ?></h2>
                <p><?= htmlspecialchars($row['description']) ?></p>
                <div class="price">Rp <?= number_format($row['price'], 0, ',', '.') ?></div>
                <?php if (isset($_SESSION['user_id'])): ?>
                    <div class="button-container">
                        <button class="buy-btn">Buy Now</button>
                    </div>
                <?php endif; ?>
            </div>
        <?php endwhile; ?>
    </div>

    <?php $db->closeConnection(); ?>
    
    <footer>
        <p>Copyright &copy; NintendoStore</p>
    </footer>
</body>
</html>