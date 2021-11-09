const adsContainerElement = document.querySelector('.ads-container')

//get user data from query params
// const urlSearchParams = new URLSearchParams(window.location.search);
// const params = Object.fromEntries(urlSearchParams.entries());

// const username = params.username;
// const email = params.email;

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


function setEditUserDataModal(active) {
    const modal = document.querySelector('#editUserDataModal');
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

function editUserData() {
    setOverlay(true);
    setEditUserDataModal(true);
}

function closeEditUserDataModal() {
    setOverlay(false);
    setEditUserDataModal(false);
}

function closeModals() {
    setOverlay(false);
    setAddNewAdModal(false);
    setEditUserDataModal(false);
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
    const elementTemplate = '<div>AAA</div>'

    adsContainerElement.insertAdjacentHTML('afterend', elementTemplate)
}
getAds();
