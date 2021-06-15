// Para desplegar menu lateral
const sidePanel = document.querySelector('.side-panel');
const nav = document.querySelector('#hamburger');
nav.addEventListener('click', e =>{
    nav.classList.toggle('open');
    sidePanel.classList.toggle('open');
})
