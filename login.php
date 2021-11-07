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
            <div class="login-btn" onclick="switchForm('login')">
                Login
            </div>
            <div class="register-btn" onclick="switchForm('register')">
                Register
            </div>
        </div>
        <form class="loginForm activeForm" action="">
            LOGIN FORM
        </form>
        <form class="registerForm" action="">
            REGISTER FORM
        </form>
    </div>

    <script src="scripts/login.js"></script>
</body>

</html>