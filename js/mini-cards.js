document.addEventListener('DOMContentLoaded', () => {
    let miniCards = document.querySelectorAll('.glass-hover');
    miniCards.forEach((obj) => {
        obj.addEventListener('click', (event) => {
            let cardView = event.target.parentElement.parentElement.parentElement.parentElement.parentElement.querySelector('#card-view');
            // cardView.style.display = 'block';
        })
    });

    let flipContainer = document.querySelector('.flip-container');
    flipContainer.addEventListener('click', function() {
        flipContainer.classList.toggle('is-flipped');
    });
})