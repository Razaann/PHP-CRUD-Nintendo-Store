<?php
// register.php
require_once 'auth_functions.php';
session_start();

$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $conn = db_connect();
    
    // Validate inputs
    $username = $conn->real_escape_string($_POST['username']);
    $email = $conn->real_escape_string($_POST['email']);
    $password = $_POST['password'];
    
    // Check if user exists
    $result = $conn->query("SELECT id FROM users WHERE username='$username' OR email='$email'");
    if ($result->num_rows > 0) {
        $error = "Username or email already exists!";
    } else {
        // Insert new user
        $hashed_password = hash_password($password);
        $conn->query("INSERT INTO users (username, email, password_hash) 
                     VALUES ('$username', '$email', '$hashed_password')");
        
        $success = "Registration successful! <a href='login.php'>Login now</a>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
    <link rel="stylesheet" href="form.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lexend:wght@100..900&display=swap" rel="stylesheet">
    <script src="form.js" defer></script>
</head>
<body>
    <h1>Register</h1>
    <?php if ($error) echo "<p style='color:#EEFF00'>$error</p>"; ?>
    <?php if ($success) echo "<p style='color:#6AFF74'>$success</p>"; ?>
    
    <form method="POST">
        <input type="hidden" name="csrf_token" value="<?= csrf_token() ?>">
        
        <label>Username:</label>
        <input type="text" name="username" required>
        
        <label>Email:</label>
        <input type="email" name="email" required>
        
        <label>Password:</label>
        <input type="password" name="password" required>
        
        <input type="submit" value="Register">
    </form>
    
    <p style='color:#FFFFFF'>Already have an account? <a href="login.php">Login here</a></p>
</body>
</html>