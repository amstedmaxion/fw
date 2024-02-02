// The below variable stores the application base url, example: http://192.167.44.252/amsted/example-directory
const BASE_URL = `${window.location.protocol}//${window.location.host}/${window.location.pathname.split('/')[1]}/${window.location.pathname.split('/')[2]}`;



//Global for query params
const urlParams = new URLSearchParams(window.location.search);


function findElement(inputId) {
    let input = document.getElementById(inputId);
    if (input) return input;
    return false;
}


function loaderOn() {
    loader("show");
}

function loader(action) {
    if (action === "show") {
        document.querySelector(".loader-wrapper").classList.add("active");
    } else if (action === "hidden") {
        document.querySelector(".loader-wrapper").classList.remove("active");
    }
}





/**
 * This method aims to set the value of a field through the ID
 * @param {String} id 
 * @param {*} value 
 * @return {true|false}
 */
function setValueById(id, value) {
    if (document.getElementById(id)) {
        document.getElementById(id).value = value;
        return true;
    }
    return false;
}


/**
 * Active tooltips from bootstrap using js vanilla
 */
function enableTooltips() {
    const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]');
    const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl));
}

enableTooltips();