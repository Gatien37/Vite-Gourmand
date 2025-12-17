
console.log('main.js chargé');


// ===== MENU BURGER =====

const burger = document.getElementById('burger');
const nav = document.getElementById('main-nav');

burger.addEventListener('click', () => {
  nav.classList.toggle('nav-open');
});


