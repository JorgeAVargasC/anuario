document.addEventListener('DOMContentLoaded', ()=>{ 
    let flipContainer = document.querySelector('.flip-container');
    flipContainer.addEventListener('click', function() {
        flipContainer.classList.toggle('is-flipped');
    });
})