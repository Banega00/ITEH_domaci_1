const adsContainerElement = document.querySelector('.ads-container')
const sortSelect = document.querySelector('#sort-select')
let ads = [];

//filter elements
const filters = {
    brand: document.querySelector("#filter-brand"),
    priceFrom: document.querySelector("#filter-priceFrom"),
    priceTo: document.querySelector("#filter-priceTo"),
    yearFrom: document.querySelector("#filter-yearFrom"),
    yearTo: document.querySelector("#filter-yearTo"),
}

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
    xhr.open("GET", "ads.php?getAll", true);
    xhr.onload = function () {
        if (xhr.status == 200) {
            let response = xhr.responseText;
            try {
                response = JSON.parse(response);
            } catch (error) {
                console.log(`Error parsing response from server: ${error}`);
                return;
            }
            ads = response;
            response.forEach(ad => {
                createNewAddElement(ad)
            });
        }
    }
    xhr.send()
}

function createNewAddElement(ad) {
    const elementTemplate = `
    <div class="ad-div">
                <div class="img-div">
                    <img src="resources/images/car1.jfif" alt="">
                </div>
                <div class="vr-div"></div>
                <div class="ad-info-div">
                    <div class="ad-title">${ad.title}</div>
                    <div class="ad-basic-info-div">
                        <button type="button" class="btn">${ad.brand}</button>
                        <button type="button" class="btn">${ad.model}</button>
                        <button type="button" class="btn">${ad.year}</button>
                    </div>
                    <div class="ad-detailed-info-div">
                        <div>Konjske snage: ${ad.horsePower}</div>
                        <div>Motor: ${ad.motor}</div>
                        <div>Gorivo: ${ad.fuel}</div>
                        <div class="owner-div">Owner: ${ad.motor}</div>
                        <div class="contact-div">Kontakt: ${ad.motor}</div>
                        <button type="button" class="btn btn-danger price-div">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-tag-fill" viewBox="0 0 16 16">
                                <path d="M2 1a1 1 0 0 0-1 1v4.586a1 1 0 0 0 .293.707l7 7a1 1 0 0 0 1.414 0l4.586-4.586a1 1 0 0 0 0-1.414l-7-7A1 1 0 0 0 6.586 1H2zm4 3.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z" />
                            </svg>
                            <div>
                                ${ad.price}€
                            </div>
                        </button>
                        <div class="additional-info-div">Dodatne informacije: ${ad.additional}</div>
                        <button type="button" class="date-div btn btn-success">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-calendar-week-fill" viewBox="0 0 16 16">
                                <path d="M4 .5a.5.5 0 0 0-1 0V1H2a2 2 0 0 0-2 2v1h16V3a2 2 0 0 0-2-2h-1V.5a.5.5 0 0 0-1 0V1H4V.5zM16 14V5H0v9a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2zM9.5 7h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1a.5.5 0 0 1 .5-.5zm3 0h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1a.5.5 0 0 1 .5-.5zM2 10.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1zm3.5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1a.5.5 0 0 1 .5-.5z"></path>
                            </svg>
                            <div>
                                ${ad.date_created}
                            </div>
                        </button>
                    </div>
                </div>
            </div>`

    adsContainerElement.insertAdjacentHTML('beforeend', elementTemplate)
}
getAds();

function sortAds() {
    const sortingParametar = sortSelect.value;

    const sortOrder = document.querySelector('input[name="sortOrderRadio"]:checked').value;

    ads.sort((a, b) => {
        aValue = parseInt(a[sortingParametar])
        bValue = parseInt(b[sortingParametar])
        if (sortOrder == 'asc') {
            return aValue < bValue ? -1 : 1;
        } else if (sortOrder == 'desc') {
            return aValue > bValue ? -1 : 1;
        } else {
            return 0;
        }
    })

    rerenderAds();
}

function rerenderAds() {
    adsContainerElement.innerHTML = "";
    ads.forEach(ad => createNewAddElement(ad));
}

function filterAds() {
    let xhr = new XMLHttpRequest();
    xhr.open("POST", 'ads.php?filter', true)

    //TODO: implement query params
    xhr.onload = function () {
        if (xhr.status == 200) {
            let response = xhr.responseText;
            try {
                response = JSON.parse(response);
                if (response) {
                    ads = response;
                } else {
                    ads = [];
                }
                sortAds();
            } catch (error) {
                console.log(error);
            }
        } else {
            console.log(`Error with xml http request: ${xhr}`)
        }
    }

    var formData = new FormData();
    formData.append("brand", filters.brand.value);
    formData.append("priceFrom", filters.priceFrom.value);
    formData.append("priceTo", filters.priceTo.value);
    formData.append("yearFrom", filters.yearFrom.value);
    formData.append("yearTo", filters.yearTo.value);
    xhr.send(formData);
}
