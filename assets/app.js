/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.scss in this case)
import './styles/app.scss';

// start the Stimulus application
import './bootstrap';

window.onload = () => {
    let mymap = L.map('mapy').setView([47.431178979035984, 6.373900869316533], 11);
    let marker = L.marker([47.431178979035984, 6.373900869316533]).addTo(mymap);
    L.tileLayer('//{s}.tile.openstreetmap.fr/osmfr/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
        maxZoom: 18,
    }).addTo(mymap)
};

var kitchen_button = document.getElementById("kitchen_button");
var bathroom_button = document.getElementById("bathroom_button");
var dressing_button = document.getElementById("dressing_button");
var kitchen = document.getElementById("kitchen");
var bathroom = document.getElementById("bathroom");
var dressing = document.getElementById("dressing");
kitchen_button.onclick = function() {
    kitchen.style.display = "block";
    bathroom.style.display = "none";
    dressing.style.display = "none";
}
bathroom_button.onclick = function() {
    kitchen.style.display = "none";
    bathroom.style.display = "block";
    dressing.style.display = "none";
}
dressing_button.onclick = function() {
    kitchen.style.display = "none";
    bathroom.style.display = "none";
    dressing.style.display = "block";
}