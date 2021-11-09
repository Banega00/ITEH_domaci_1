<?php
require_once('db_connection.php');
require_once('models/user.php');

if (isset($_POST['username']) || isset($_POST['email'])) {
    session_start();
    $user = new User($_SESSION['username']);

    header("location: index.php?message='Uspesno promenjeni podaci'");
    exit();
}

if (isset($_POST['old-password']) && isset($_POST['new-password'])) {
    $oldPassword = $_POST['old-password'];
    $newPassword = $_POST['new-password'];


    session_start();
    $userId = $_SESSION['user_id'];
    $result = User::changePassword($conn, $userId, $oldPassword, $newPassword);
    if (empty($result)) {
        header("location: index.php?message='Uspesno promenjena šifra'");
    } else {
        header("location: index.php?message='$result'");
    };
    exit();
}
