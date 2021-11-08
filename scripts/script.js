const adsContainerElement = document.querySelector('.ads-container')
function sendRequest(method, url, callback, body, queryParams) {
    let xhr = new XMLHttpRequest();
    xhr.open(method, url, true)

    //TODO: implement query params
    xhr.onload = function () {
        if (xhr.status == 200) {
            console.log(xhr.responseText == "Ok")
            console.log("Successful request");
        } else {
            console.log(`Error with xml http request: ${xhr}`)
        }
    }

    if (method == "POST") xhr.send(body);
    else xhr.send();
}

const logoutUser = () => {
    location.href = "logout.php";
}

const addNewAd = () => {
    setOverlay(true);
    setAddNewAdModal(true);
}

function setAddNewAdModal(active) {
    const modal = document.querySelector('#addNewAdModal');
    if (active) {
        modal.classList.add('active');
    } else {
        modal.classList.remove('active')
    }
}

function closeAddNewAdModal() {
    setOverlay(false);
    setAddNewAdModal(false);
}

function setOverlay(active) {
    const overlay = document.querySelector('#background-overlay');
    if (active) {
        overlay.classList.add('active');
    } else {
        overlay.classList.remove('active')
    }
}

function getAds() {
    let xhr = new XMLHttpRequest();
    xhr.open("GET", "ads.php", true);
    xhr.onload = function () {
        if (xhr.status == 200) {
            let response = xhr.responseText;
            try {
                response = JSON.parse(response);
            } catch (error) {
                console.log(`Error parsing response from server: ${error}`);
                return;
            }
            response.forEach(ad => {
                createNewAddElement(ad)
            });
        }
    }
    xhr.send()
}

function createNewAddElement(adData) {
    const elementTemplate = `
    <div class="ad-container">
                <div class="img-container">
                    OVDE IDE SLIKA
                </div>
                <div class="data-container">
                    <div class="ad_title">
                        <div class="value">${adData.title}</div>
                    </div>
                    <div class="ad_brand">
                        <div class="name">Marka</div>
                        <div class="value">${adData.marka}</div>
                    </div>
                    <div class="ad_model">
                        <div class="name">Model</div>
                        <div class="value">${adData.model}</div>
                    </div>
                    <div class="ad_year">
                        <div class="name">Godiste</div>
                        <div class="value">${adData.year}</div>
                    </div>
                    <div class="ad_price">
                        <div class="name">Cena</div>
                        <div class="value">${adData.price}</div>
                    </div>
                    <div class="ad_owner">
                        <div class="name">Vlasnik</div>
                        <div class="value">${adData.username}</div>
                    </div>
                    <div class="ad_contact">
                        <div class="name">Kontakt</div>
                        <div class="value">${adData.contact}</div>
                    </div>
                </div>
            </div>
    `;

    adsContainerElement.insertAdjacentHTML('afterend', elementTemplate)
}
getAds();
