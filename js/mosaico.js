document.addEventListener('DOMContentLoaded', () => {
    const emptyPanel = document.querySelector('#empty-panel');
    const hamburger = document.querySelector('#hamburger');
    const flipContainer = document.querySelector('#flip-container');
    const miniCards = document.querySelectorAll('.glass-hover');
    miniCards.forEach((obj) => {
        obj.addEventListener('click', (event) => {
            // let cardView = event.target.parentElement.parentElement.parentElement.parentElement.nextElementSibling;
            // cardView.style.display = 'block';
            flipContainer.style.display = 'block';
            emptyPanel.classList.toggle('open');
            hamburger.style.zIndex = 15;
        })
    });
    const flipIcon = document.querySelectorAll('.flip-icon');
    flipIcon.forEach((obj)=>{
        obj.addEventListener('click', function() {
            flipContainer.classList.toggle('is-flipped');
        });
    })
    
    const closeCard = document.querySelector('#close-card');
    closeCard.addEventListener('click', ()=>{
        hamburger.style.zIndex = 30;
        flipContainer.style.display = 'none';
        emptyPanel.classList.toggle('open');
    })
})