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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="styles/index.css">
    <title>Document</title>
</head>

<body>
    <div class="d-flex flex-column flex-shrink-0 p-3 text-white bg-dark side-menu" style="width: 240px;">
        <a class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
            <div class="username-div">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
                    <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z" />
                    <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z" />
                </svg>
                <div> <?php echo $_SESSION['username']; ?></div>
            </div>
        </a>
        <hr>
        <ul class="nav nav-pills flex-column mb-auto">
            <li class="nav-item">
                <div class="newAd-div">
                    <button type="button" class="btn btn-success" onclick="addNewAd()">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-file-earmark-plus-fill" viewBox="0 0 16 16">
                            <path d="M9.293 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V4.707A1 1 0 0 0 13.707 4L10 .293A1 1 0 0 0 9.293 0zM9.5 3.5v-2l3 3h-2a1 1 0 0 1-1-1zM8.5 7v1.5H10a.5.5 0 0 1 0 1H8.5V11a.5.5 0 0 1-1 0V9.5H6a.5.5 0 0 1 0-1h1.5V7a.5.5 0 0 1 1 0z" />
                        </svg>
                        Novi oglas
                    </button>
                </div>
            </li>
            <li>
                <div class="edit-profile-div">
                    <button type="button" class="btn btn-success">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-fill" viewBox="0 0 16 16">
                            <path d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z"></path>
                        </svg>
                        Izmeni profil
                    </button>
                </div>
            </li>
            <li>
                <div class="delete-profile-div">
                    <button type="button" class="btn btn-danger">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
                            <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z"></path>
                        </svg>
                        Obriši profil
                    </button>
                </div>
            </li>
            <li>
                <div class="logout-div">
                    <button type="button" class="btn btn-danger" onclick="logoutUser()">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box-arrow-right" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M10 12.5a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v2a.5.5 0 0 0 1 0v-2A1.5 1.5 0 0 0 9.5 2h-8A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-2a.5.5 0 0 0-1 0v2z" />
                            <path fill-rule="evenodd" d="M15.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 0 0-.708.708L14.293 7.5H5.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3z" />
                        </svg>
                        Odjavi se
                    </button>
                </div>
            </li>
        </ul>
        <hr>
    </div>
    <main>
        <div class="filter-div">OVDE IDE FILTER</div>
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
    </main>

    <div id="addNewAdModal">
        <div class="addNewAdModalTitle">Popunite polja ispod kako biste kreirali oglas za prodaju vozila</div>
        <form method="POST" action="ads.php">
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