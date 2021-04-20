/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.scss in this case)
import './styles/admin.scss';

// start the Stimulus application
import './bootstrap';

var modal = document.getElementById("myModal");
var modal2 = document.getElementById("myModal2");
var btn = document.getElementById("myBtn");
var btn2 = document.getElementById("myBtn2");
var span = document.getElementsByClassName("close")[0];
var span2 = document.getElementsByClassName("close2")[0];
btn.onclick = function() {
    modal.style.display = "block";
}
btn2.onclick = function() {
    modal2.style.display = "block";
}
span.onclick = function() {
    modal.style.display = "none";
}
span2.onclick = function() {
    modal2.style.display = "none";
}

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

document.getElementById("submit").onclick = function() {
    document.getElementById("formBefore").submit();
    document.getElementById("formAfter").submit();
}
