<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Rental Mobil</title>
    
    <link rel="stylesheet" href="css/login-style.css">
    <style>
        
        .error-message {
            color: red;
            background-color: #ffebee;
            border: 1px solid red;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 15px;
        }
    </style>
</head>
<body>

    <div class="login-container">
        <h1>Login</h1>
        <p>Selamat datang kembali!</p>
        
        <?php 
            
            if(isset($_SESSION['error_message'])) {
                echo '<p class="error-message">' . htmlspecialchars($_SESSION['error_message']) . '</p>';
                
                unset($_SESSION['error_message']); 
            }
        ?>

        <form method="POST" action="index.php?action=loginProcess">
            
            <label for="username">Username</label>
            <input type="text" id="username" name="username" placeholder="Masukkan username" required>
            
            <label for="password">Password</label>
            <input type="password" id="password" name="password" placeholder="Masukkan password" required>
            
            <button type="submit">Login</button>
            
        </form>
        </div>

</body>
</html>