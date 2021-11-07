const forms = document.querySelectorAll('.form-container > form')
const formsBtns = document.querySelectorAll('.form-buttons > div')

const switchForm = (formType) => {
    if (formType === "login") {
        if (forms[0].classList.contains("activeForm")) return;
        forms[0].classList.add("activeForm")
        forms[1].classList.remove("activeForm")

        formsBtns[0].classList.add('activeFormBtn')
        formsBtns[1].classList.remove('activeFormBtn')
    } else {
        if (forms[1].classList.contains("activeForm")) return;
        forms[1].classList.add("activeForm")
        forms[0].classList.remove("activeForm")

        formsBtns[1].classList.add('activeFormBtn')
        formsBtns[0].classList.remove('activeFormBtn')
    }
}