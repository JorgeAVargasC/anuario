document.addEventListener('DOMContentLoaded', ()=>{
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