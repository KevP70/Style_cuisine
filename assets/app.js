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

    function Map() {
        let mymap = L.map('mapy').setView([47.431178979035984, 6.373900869316533], 11);
        let marker = L.marker([47.431178979035984, 6.373900869316533]).addTo(mymap);
        L.tileLayer('//{s}.tile.openstreetmap.fr/osmfr/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
            maxZoom: 18,
        }).addTo(mymap)
    }

    let kitchen_button = document.getElementById("kitchen_button");
    let bathroom_button = document.getElementById("bathroom_button");
    let dressing_button = document.getElementById("dressing_button");
    let kitchen = document.getElementById("kitchen");
    let bathroom = document.getElementById("bathroom");
    let dressing = document.getElementById("dressing");
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

    let ok = document.getElementById("ok");
    setTimeout(function(){
            ok.style.display = "none";}
        , 3000);


    let slide = ["/build/images/slider/beautiful-shot-of-modern-house-kitchen.jpg",
                 "/build/images/slider/beautiful-shot-of-modern-house-kitchen.jpg",
                 "/build/images/slider/bathroom-1336164_640.jpg",
                 "/build/images/slider/closet-4696557_1280.jpg"];
    let i = 0;
    let slider = document.getElementById("slide");
    let last = document.getElementById("last");
    let next = document.getElementById("next");

    function Interval(){
        if (i >= 0)
            i++
        if (i > 3)
            i = 1
        slider.src = slide[i];
    }
    setInterval(Interval, 10000)

    next.onclick = function() {
        i = i + 1;
        if(i > 3)
            i = 1
        slider.src = slide[i];
    };
    last.onclick = function() {
        i = i - 1;
        if(i < 0)
            i = 3
        slider.src = slide[i];
    };

    function start() {
        Map();
        Interval();
    }
    window.onload = start;