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
    emptyPanel.addEventListener('click', () => {
        hamburger.classList.toggle('open');
        sidePanel.classList.toggle('open');
        emptyPanel.classList.toggle('open');
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

    document.querySelectorAll('.sublist-item.open').forEach(e =>{
        console.log(e);
        e.addEventListener("webkitAnimationEnd", (event)=>{
            event.target.style.display = 'none';
        });
    });

    // Para movimiento lateral del timeline

    // Esta funcion se repite *action* mientras el cursor permanece *time* milisegundos sobre *element*
    function repeatWhileMouseOver(element, action, time) {
        var interval = null;
        element.addEventListener('mouseover', function() {
            interval = setInterval(action, time);
        });
    
        element.addEventListener('mouseout', function() {
            clearInterval(interval);
        });
    }

    // Se define la action que sucede cuando se hace hover sobre la flecha izquierda
    // En este caso hacer scroll hacia la izquierda
    const leftArrow = document.querySelector('#left-arrow');
    repeatWhileMouseOver(leftArrow, ()=>{
        document.querySelector('#timeline').scrollLeft -= 4;
    }, 10);

    // Se define la action que sucede cuando se hace hover sobre la flecha derecha
    // En este caso hacer scroll hacia la derecha
    const rightArrow = document.querySelector('#right-arrow');
    repeatWhileMouseOver(rightArrow, ()=>{
        document.querySelector('#timeline').scrollLeft += 4;
    }, 10);   
    
})