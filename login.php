<?php
// login.php
// H. Memiliki halaman login
require_once 'auth_functions.php';
session_start();

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $conn = db_connect();
    
    $username = $conn->real_escape_string($_POST['username']);
    $password = $_POST['password'];
    
    // Fetch user
    $result = $conn->query("SELECT * FROM users WHERE username='$username'");
    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();
        
        if (verify_password($password, $user['password_hash'])) {
            // Successful login
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['is_admin'] = ($user['username'] === 'Admin1');
            header("Location: index.php");
            exit();
        }
    }
    
    $error = "Invalid username or password!";
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" href="form.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lexend:wght@100..900&display=swap" rel="stylesheet">
    <script src="form.js" defer></script>
</head>
<body>
    <h1>Login</h1>
    <?php if ($error) echo "<p style='color:#EEFF00'>$error</p>"; ?>
    
    <form method="POST">
        <input type="hidden" name="csrf_token" value="<?= csrf_token() ?>">
        
        <label>Username:</label>
        <input type="text" name="username" required>
        
        <label>Password:</label>
        <input type="password" name="password" required>
        
        <input type="submit" value="Login">
    </form>
    
    <p style='color:#FFFFFF'>Don't have an account? <a href="register.php">Register here</a></p>
</body>
</html>