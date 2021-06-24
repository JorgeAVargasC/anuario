document.addEventListener('DOMContentLoaded', ()=>{
    // Para desplegar menu lateral
    const sidePanel = document.querySelector('#side-menu');
    const emptyPanel = document.querySelector('#empty-panel');
    const hamburger = document.querySelector('#hamburger');


    hamburger.addEventListener('click', () => {
        hamburger.classList.toggle('open');
        sidePanel.classList.toggle('open');
        emptyPanel.classList.toggle('open');
    })

    emptyPanel.addEventListener('click', () => {
        hamburger.classList.toggle('open');
        sidePanel.classList.toggle('open');
        emptyPanel.classList.toggle('open');
    })


    // Para desplegar subopciones
    document.querySelectorAll('.list-item').forEach(e => {
        e.addEventListener('click', event => {
            event.target.querySelectorAll('.sublist-item').forEach(o => {
                o.classList.toggle('open');
            })
        })
    })

    // Para movimiento lateral del timeline
    function repeatWhileMouseOver(element, action, time) {
        var interval = null;
        element.addEventListener('mouseover', function() {
            interval = setInterval(action, time);
        });
    
        element.addEventListener('mouseout', function() {
            clearInterval(interval);
        });
    }

    const leftArrow = document.querySelector('#left-arrow');
    repeatWhileMouseOver(leftArrow, ()=>{
        document.querySelector('#timeline').scrollLeft -= 2;
    }, 10);

    const rightArrow = document.querySelector('#right-arrow');
    repeatWhileMouseOver(rightArrow, ()=>{
        document.querySelector('#timeline').scrollLeft += 2;
    }, 10);   
    
})