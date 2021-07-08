document.addEventListener('DOMContentLoaded', () => {
    const cardViewEmptyPanel = document.querySelector('#card-view-empty-panel');
    const hamburger = document.querySelector('#hamburger');
    const flipContainer = document.querySelector('#flip-container');
    const flipIcon = document.querySelectorAll('.flip-icon');
    const cardViewLayout = document.querySelector('#card-view-layout');
    const cardView = document.querySelector('#card-view');
    const closeCard = document.querySelector('#close-card');
    const miniCards = document.querySelectorAll('.glass-hover');

    miniCards.forEach((obj) => {
        obj.addEventListener('click', () => {
            // let cardView = event.target.parentElement.parentElement.parentElement.parentElement.nextElementSibling;
            cardViewLayout.style.display = 'flex';
            cardViewEmptyPanel.style.display = 'block';
            cardView.style.display = 'block';
            cardViewEmptyPanel.classList.toggle('open');
            cardViewLayout.classList.toggle('open');
            cardView.classList.toggle('open');
            hamburger.style.zIndex = 15;
            id = obj.parentElement.parentElement.parentElement.dataset.id;
            fetch(`https://dummyapi.io/data/api/user/${id}`, {
                method: 'GET',
                headers: {
                    'app-id': '60e7087c66d25e6ae07f1998'
                }
            }).then(res => res.json()).then(data => {
                cardView.querySelector('.front-bg-blue h1').innerHTML = `${data.firstName} ${data.lastName}`;
                cardView.querySelector('.front-bg-blue p').innerHTML = `${data.email}`;
            })
        })
    });

    // Funcionalidad del panel vacío
    cardViewEmptyPanel.addEventListener('click', () => {
        closingCard();
    })

    flipIcon.forEach((obj)=>{
        obj.addEventListener('click', function() {
            flipContainer.classList.toggle('is-flipped');
        });
    })
    
    closeCard.addEventListener('click', ()=>{
        closingCard();
    })

    function closingCard(){
        hamburger.style.zIndex = 30;
        cardView.classList.toggle('open');
        cardViewEmptyPanel.classList.toggle('open');
        cardViewLayout.classList.toggle('open');
        if(flipContainer.classList.contains('is-flipped')){
            flipContainer.classList.toggle('is-flipped');
        }
    }
})