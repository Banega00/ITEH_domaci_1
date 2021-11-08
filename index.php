<?php
require_once('models/ad.php');
require_once('db_connection.php');

session_start();
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit();
}

if (isset($_GET['message'])) {
    $message = $_GET['message'];
    echo "<script>alert($message)</script>";
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/index.css">
    <title>Document</title>
</head>

<body>

    <div class="side-menu">
        <div>PROFILE <?php echo $_SESSION['username']; ?></div>
        <div onclick="addNewAd()">Postavi oglas</div>
        <div onclick="logoutUser()">Log out</div>
    </div>
    <main>
        <div class="ads-container">
            <div class="ad-container">
                <div class="img-container">
                    OVDE IDE SLIKA
                </div>
                <div class="data-container">
                    <div class="ad_title">
                        <div class="value">Prodajem golfa u odlicnom stanju</div>
                    </div>
                    <div class="ad_brand">
                        <div class="name">Marka</div>
                        <div class="value">Volkswagen</div>
                    </div>
                    <div class="ad_model">
                        <div class="name">Model</div>
                        <div class="value">Golf 3</div>
                    </div>
                    <div class="ad_year">
                        <div class="name">Godiste</div>
                        <div class="value">2011</div>
                    </div>
                    <div class="ad_price">
                        <div class="name">Cena</div>
                        <div class="value">1750e</div>
                    </div>
                    <div class="ad_owner">
                        <div class="name">Vlasnik</div>
                        <div class="value">Jeremija</div>
                    </div>
                    <div class="ad_contact">
                        <div class="name">Kontakt</div>
                        <div class="value">+38121523</div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </main>

    <div id="addNewAdModal">
        <div class="addNewAdModalTitle">Popunite polja ispod kako biste kreirali oglas za prodaju vozila</div>
        <form method="POST" action="addNewAd.php">
            <input type="text" name="title" placeholder="Naslov oglasa">
            <input type="text" name="brand" placeholder="Marka vozila">
            <input type="text" name="model" placeholder="Model vozila">
            <input type="number" name="year" placeholder="Godina proizvodnje">
            <input type="number" name="price" placeholder="Cena vozila">
            <input type="text" name="contact" placeholder="Kontakt (npr. broj telefona, email)">
            <input type="number" name="horsePower" placeholder="Broj konjskih snaga">
            <input type="text" name="motor" placeholder="Motor">
            <input type="text" name="fuel" placeholder="Gorivo">
            <textarea name="additional" cols="30" rows="10" placeholder="Dodatne informacije"></textarea>
            <input type="submit" name="addNewAd" value="Postavi oglas" id="">
        </form>

        <div onclick="closeAddNewAdModal()" class="close-modal-btn">X</div>
    </div>
    <div id="background-overlay"></div>
    <script src="scripts/script.js"></script>
</body>

</html>