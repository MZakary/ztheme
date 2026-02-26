import '../scss/style.scss';
import AOS from 'aos';

AOS.init({
    duration: 800,
    once: true,
});

document.addEventListener('DOMContentLoaded', () => {
    const toggle = document.querySelector('.menu-toggle');
    const menu = document.querySelector('.main-nav .menu');

    if(toggle) {
        toggle.addEventListener('click', () => {
            menu.classList.toggle('active');
        });
    }
});