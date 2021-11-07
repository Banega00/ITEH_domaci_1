<?php
require_once('user.php');
require_once('db_connection.php');
$login_message = NULL;
$register_message = NULL;
if (isset($_POST['login']) && isset($_POST['username']) && isset($_POST['password'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $user = new User($username, $password);

    if ($user->login($conn)) {
        //successful login
        session_start();
        $_SESSION['username'] = $user->username;
        header('Location: index.php');
        exit();
    } else {
        $login_message = "Invalid username or password";
    }
} elseif (isset($_POST['register']) && isset($_POST['username']) && isset($_POST['password'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $user = new User($username, $password);
    $result = $user->register($conn);
    if ($result != true) {
        //failed registration
        $register_message = "Failed to register";
    } else {
        //successful registration
        session_start();
        $_SESSION['username'] = $user->username;
        $user->login($conn); //login to set user_id
        header('location: index.php');
    }
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
            <div class="message"><?php echo isset($login_message) ? $login_message : '' ?></div>
            <input type="text" name="username" id="username" placeholder="Username">
            <input type="text" name="password" id="password" placeholder="Password">
            <input type="submit" value="Submit" name="login">
        </form>
        <form method="POST" class="registerForm">
            <div class="message"><?php echo isset($register_message) ? $register_message : '' ?></div>
            <input type="text" name="username" id="username" placeholder="Username">
            <input type="text" name="password" id="password" placeholder="Password">
            <input type="submit" value="Submit" name="register">
        </form>
    </div>

    <script src="scripts/login.js"></script>
</body>

</html>