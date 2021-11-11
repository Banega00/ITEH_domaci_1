<?php
require_once('db_connection.php');
require_once('models/ad.php');

if (isset($_GET['getAll'])) {
    echo json_encode(Ad::getAds($conn));
}



if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    $data = file_get_contents("php://input");
    $adId = json_decode($data);
    $adId = $adId->id;
    $result = Ad::deleteAd($conn, $adId);
    if ($result) {
        echo "Success";
    } else {
        echo "Greška: " . $result;
    };
}

if (isset($_POST['title'])) {
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
    $image = $_FILES['image'];

    $image_extension = pathinfo($image['name'], PATHINFO_EXTENSION);
    $image['name'] = guidv4() . '.' . $image_extension;
    move_uploaded_file($image['tmp_name'], './resources/images/ad_images/' . $image['name']);

    $imageName = $image['name'];
    if (
        isset($title) && isset($brand) && isset($model) && isset($year) && isset($price) && isset($contact) && isset($horsePower) &&
        isset($motor) && isset($fuel) && isset($additional) && isset($ownerId) && isset($image) && isset($imageName)
    ) {
        $ad = new Ad($title, $brand, $model, $year, $price, $contact, $horsePower, $motor, $fuel, $additional, $imageName, $ownerId);
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

if (isset($_GET['filter'])) {
    echo json_encode(Ad::filterAds(
        $conn,
        $_POST['brand'],
        $_POST['priceFrom'],
        $_POST['priceTo'],
        $_POST['yearFrom'],
        $_POST['yearTo'],
    ));
}


function guidv4($data = null)
{
    $data = $data ?? random_bytes(16);
    assert(strlen($data) == 16);

    $data[6] = chr(ord($data[6]) & 0x0f | 0x40);
    $data[8] = chr(ord($data[8]) & 0x3f | 0x80);

    return vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex($data), 4));
}
