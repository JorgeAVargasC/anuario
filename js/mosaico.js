document.addEventListener('DOMContentLoaded', () => {
    const cardViewEmptyPanel = document.querySelector('#card-view-empty-panel');
    const hamburger = document.querySelector('#hamburger');
    const flipContainer = document.querySelector('#flip-container');
    const cardViewLayout = document.querySelector('#card-view-layout');
    const cardView = document.querySelector('#card-view');
    // const miniCardsLayout = document.querySelector('#mini-cards-layout');

    const miniCards = document.querySelectorAll('.glass-hover');
    miniCards.forEach((obj) => {
        obj.addEventListener('click', () => {
            cardViewLayout.style.display = 'flex';
            cardViewEmptyPanel.style.display = 'block';
            cardView.style.display = 'block';
            cardViewEmptyPanel.classList.toggle('open');
            cardViewLayout.classList.toggle('open');
            cardView.classList.toggle('open');
            hamburger.style.zIndex = 15;
            id = obj.parentElement.parentElement.parentElement.dataset.id;
            let loadingImg = `<div class="card-face loading-face-flex" id="card-loading"><img src="/anuario/img/icons/loading.gif" width="30%" alt="loading"></div>`;
            flipContainer.innerHTML = loadingImg;
            fetch(`/anuario/functions/members.php?id=${id}`)
            .then(res => res.json()).then(member => {
                let nombre = member.nombrePreferido == 1 ? `<h1>${member.primerNombre} ${member.primerApellido}</h1>` : `<h1>${member.segundoNombre} ${member.primerApellido}</h1>`;
                let result = `
                    <div class="card-face front-face-flex">
                        <div class="front-content">
                            <div class="front-bg-blue">
                                <img src="${member.urlFoto}" alt="" class="front-img">
                                ${nombre}
                                <span class="big-content-line"></span>
                                <p>${member.correo}</p>
                            </div>
                        </div>
                        <div class="front-insignias">
                            <i id="close-card" class="fas fa-times"></i>
                            <span class="big-content-line"></span>
                            <i class="fab fa-facebook-square fa-2x"></i>
                            <i class="fab fa-instagram fa-2x"></i>
                            <i class="fab fa-linkedin fa-2x"></i>
                            <i class="fas fa-medal fa-2x"></i>
                            <div class="flex-1"></div>
                            <i class="fas fa-arrow-right fa-2x flip-icon"></i>
                        </div>
                    </div>
                    <div class="card-face back-face-flex">
                        <div class="back-blue-side">
                            <i class="fas fa-arrow-left fa-2x flip-icon"></i>
                        </div>
                        <div class="back-content">
                            <div class="back-blue-banner">
                                <h1>${member.nombreEnRama}</h1>
                            </div>
                            <div class="back-content-items">
                                <p><i>"${member.frase}"</i></p>
                                <img src="/anuario/img/icons/logoIEEEBasicBlue.svg" alt="">
                            </div>
                        </div>
                    </div>
                `;
                flipContainer.innerHTML = result;
                const flipIcon = document.querySelectorAll('.flip-icon');
                flipIcon.forEach((obj) => {
                    obj.addEventListener('click', function() {
                        flipContainer.classList.toggle('is-flipped');
                    });
                })
                const closeCard = document.querySelector('#close-card');
                closeCard.addEventListener('click', () => {
                    closingCard();
                })
            })
        })
    });

    // Funcionalidad del panel vacío
    cardViewEmptyPanel.addEventListener('click', () => {
        closingCard();
    })

    function closingCard() {
        hamburger.style.zIndex = 30;
        cardView.classList.toggle('open');
        cardViewEmptyPanel.classList.toggle('open');
        cardViewLayout.classList.toggle('open');
        if (flipContainer.classList.contains('is-flipped')) {
            flipContainer.classList.toggle('is-flipped');
        }
    }
})