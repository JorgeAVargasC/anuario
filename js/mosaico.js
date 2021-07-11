document.addEventListener('DOMContentLoaded', () => {
    const cardViewEmptyPanel = document.querySelector('#card-view-empty-panel');
    const hamburger = document.querySelector('#hamburger');
    const flipContainer = document.querySelector('#flip-container');
    const cardViewLayout = document.querySelector('#card-view-layout');
    const cardView = document.querySelector('#card-view');
    const miniCardsLayout = document.querySelector('#mini-cards-layout');

    fetch('/anuario/php/consultarUsuarios.php')
    .then(res => res.json()).then(data => {
        for (let user of data) {
            let newMiniCard = document.createElement('div');
            newMiniCard.className = 'mini-card';
            newMiniCard.dataset.id = user.id;
            newMiniCard.innerHTML = `
                <div class="bg-blue">
                    <div class="img-container">
                        <img class="member-img" src="${user.primerNombre}">
                        <div class="glass-hover">
                            <i class="fas fa-arrow-circle-right fa-3x"></i>
                            <p>Ver Más</p>
                        </div>
                    </div>
                    <p class="member-name">${user.primerNombre} ${user.primerApellido}</p>
                </div>
                <div class="insignias">
                    <i class="fab fa-facebook-square"></i>
                    <i class="fab fa-instagram"></i>
                    <i class="fab fa-linkedin"></i>
                    <i class="fas fa-medal"></i>
                    <i class="fas fa-medal"></i>
                </div>
            `;
            miniCardsLayout.appendChild(newMiniCard);
        }
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
                fetch(`https://dummyapi.io/data/api/user/${id}`, {
                    method: 'GET',
                    headers: {
                        'app-id': '60e72af47ebffc797f73b482'
                    }
                }).then(res => res.json()).then(data => {
                    let result = `
                            <div class="card-face front-face-flex">
                                <div class="front-content">
                                    <div class="front-bg-blue">
                                        <img src="${data.picture}" alt="" class="front-img">
                                        <h1>${data.firstName} ${data.lastName}</h1>
                                        <span class="big-content-line"></span>
                                        <p>${data.email}</p>
                                    </div>
                                </div>
                                <div class="front-insignias">
                                    <!-- Recordar quitar la etiqueta a innecesaria sin afectar la vista -->
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
                                        <h1>Gigi</h1>
                                    </div>
                                    <div class="back-content-items">
                                        <p>${data.location.street}</p>
                                        <img src="img/icons/logoIEEEBasicBlue.svg" alt="">
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
    })

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