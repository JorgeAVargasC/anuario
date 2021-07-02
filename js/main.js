document.addEventListener('DOMContentLoaded', ()=>{
    
    // Para desplegar menu lateral
    const sidePanel = document.querySelector('#side-menu');
    const emptyPanel = document.querySelector('#empty-panel');
    const hamburger = document.querySelector('#hamburger');

    // Funcionalidad del boton hamburguesa
    hamburger.addEventListener('click', () => {
        sidePanel.style.display = 'block';
        hamburger.classList.toggle('open');
        sidePanel.classList.toggle('open');
        emptyPanel.classList.toggle('open');
    })

    // Funcionalidad del panel vacío
    emptyPanel.addEventListener('click', (event) => {
        if(sidePanel.classList.contains('open')){
            hamburger.classList.toggle('open');
            sidePanel.classList.toggle('open');
        }else{
            hamburger.style.zIndex = 30;
            document.querySelector('#card-view').classList.toggle('open');
        }
        event.target.classList.toggle('open');
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