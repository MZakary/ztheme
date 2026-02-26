import '../scss/style.scss';

document.addEventListener('DOMContentLoaded', () => {
    const toggle = document.querySelector('.menu-toggle');
    const menu = document.querySelector('.main-nav .menu');

    if(toggle) {
        toggle.addEventListener('click', () => {
            menu.classList.toggle('active');
        });
    }
});