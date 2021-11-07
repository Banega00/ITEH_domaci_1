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

