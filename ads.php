<?php
require_once('db_connection.php');
require_once('models/ad.php');

if (isset($_GET)) {
    echo json_encode(Ad::getAds($conn));
}

if (isset($_POST['addNewAd'])) {
    session_start();

    $title = $_POST['title'];
    $brand = $_POST['brand'];
    $model = $_POST['model'];
    $year = $_POST['year'];
    $price = $_POST['price'];
    $contact = $_POST['contact'];
    $horsePower = $_POST['horsePower'];
    $motor = $_POST['motor'];
    $fuel = $_POST['fuel'];
    $additional = $_POST['additional'];
    $ownerId = $_SESSION['user_id'];

    if (
        isset($title) && isset($brand) && isset($model) && isset($year) && isset($price) && isset($contact) && isset($horsePower) &&
        isset($motor) && isset($fuel) && isset($additional) && isset($ownerId)
    ) {
        $ad = new Ad($title, $brand, $model, $year, $price, $contact, $horsePower, $motor, $fuel, $additional, $ownerId);
        if ($ad->insert($conn)) {
            header("location: index.php?message='Successfully added new advertisement for viechle'");
            exit();
        } else {
            header("location: index.php?message='Error adding new advertisement'");
            exit();
        };
    } else {
        header("location: index.php?message='Invalid request format'");
    }
}
