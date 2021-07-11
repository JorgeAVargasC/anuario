document.addEventListener('DOMContentLoaded', ()=>{
    
    // Para desplegar menu lateral
    const sidePanel = document.querySelector('#side-menu');
    const sideMenuEmptyPanel = document.querySelector('#empty-panel');
    const hamburger = document.querySelector('#hamburger');

    // Funcionalidad del boton hamburguesa
    hamburger.addEventListener('click', () => {
        sidePanel.style.display = 'block';
        hamburger.classList.toggle('open');
        sidePanel.classList.toggle('open');
        sideMenuEmptyPanel.style.display = 'flex';
        sideMenuEmptyPanel.classList.toggle('open');
    })

    // Funcionalidad del panel vacío
    sideMenuEmptyPanel.addEventListener('click', () => {
        hamburger.classList.toggle('open');
        sidePanel.classList.toggle('open');
        sideMenuEmptyPanel.classList.toggle('open');
    })

    // Para desplegar subopciones
    document.querySelectorAll('.list-item').forEach(e => {
        e.addEventListener('click', event => {
            event.target.querySelectorAll('.sublist').forEach(o => {
                o.style.display = 'block';
                o.classList.toggle('open');
            })
        })
    })    
})