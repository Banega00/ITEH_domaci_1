<?php
require('user.php');
require('db_connection.php');

if (isset($_POST['login']) && isset($_POST['username']) && isset($_POST['password'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $user = new User($username, $password);

    if ($user->login($conn)) {
        session_start();
        $_SESSION['username'] = $user->username;
        $_SESSION['user_id'] = $user->id;
        header('Location: index.php');
        exit();
    }
} elseif (isset($_POST['register'])) {
    echo "ZAHTEV ZA REGISTER";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/login.css">
    <title>Document</title>
</head>

<body>
    <div class="form-container">
        <div class="form-buttons">
            <div class="login-btn activeFormBtn" onclick="switchForm('login')">
                Login
            </div>
            <div class="register-btn" onclick="switchForm('register')">
                Register
            </div>
        </div>
        <form method="POST" class="loginForm activeForm">
            <input type="text" name="username" id="username" placeholder="Username">
            <input type="text" name="password" id="password" placeholder="Password">
            <input type="submit" value="Submit" name="login">
        </form>
        <form method="POST" class="registerForm">
            <input type="text" name="username" id="username" placeholder="Username">
            <input type="text" name="password" id="password" placeholder="Password">
            <input type="submit" value="Submit" name="register">
        </form>
    </div>

    <script src="scripts/login.js"></script>
</body>

</html>