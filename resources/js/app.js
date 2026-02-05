import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

let index = 0;
const slider = document.getElementById('slider');

setInterval(() => {
    index = (index + 1) % 3;
    slider.style.transform = `translateX(-${index * 100}%)`;
}, 4000);
