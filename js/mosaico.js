document.addEventListener('DOMContentLoaded', () => {
    const cardViewEmptyPanel = document.querySelector('#card-view-empty-panel');
    const hamburger = document.querySelector('#hamburger');
    const flipContainer = document.querySelector('#flip-container');
    const cardViewLayout = document.querySelector('#card-view-layout');
    const cardView = document.querySelector('#card-view');

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
            .then(res => res.json()).then(data => {
                let member = data[0];
                let cargos = data[1];
                // Para seleccionar el nombre
                let nombre = member.nombrePreferido == 1 ? `${member.primerNombre} ${member.primerApellido}` : `${member.segundoNombre} ${member.primerApellido}`;
                // Para añadir aportes
                let aportes = ''; 
                let volComites = [];
                let coorComites = [];
                let medallas ='';
                let banderaCoor = false;
                let banderaVol = false;
                for (let cargo of cargos) {
                    if (cargo.cargo == 'Coordinador'){
                        coorComites.push(' ' + cargo.comite);
                        if(!banderaCoor){
                            medallas += `<div class="medalla"><img src="${cargo.urlLogo}" title="${cargo.cargo}"></img></div>`;
                            banderaCoor = true;        
                        }
                    }else if(cargo.cargo == 'Voluntario'){
                        volComites.push(' ' + cargo.comite);
                        if(!banderaVol){
                            medallas += `<div class="medalla"><img src="${cargo.urlLogo}" title="${cargo.cargo}"></img></div>`;
                            banderaVol = true;        
                        }
                    }else{
                        aportes += `<li><p>${cargo.cargo}</p></li>`;
                        medallas += `<div class="medalla"><img src="${cargo.urlLogo}" title="${cargo.cargo}"></img></div>`;
                    }
                }
                banderaCoor = false;
                banderaVol = false;
                if(coorComites.length > 0){
                    if (coorComites.length > 1) {
                        last_coorComites = coorComites.pop();
                        aportes += `<li><p>Coordinador de comites de ${coorComites} y ${last_coorComites}.</p></li>`;
                    }else{
                        aportes +=`<li><p>Coordinador de comite de ${coorComites}.</p></li>`;
                    }
                }
                if (volComites.length > 1) {
                    last_volComites = volComites.pop();
                    aportes +=`<li><p>Voluntario de comites de ${volComites} y ${last_volComites}.</p></li>`;
                }else{
                    aportes +=`<li><p>Voluntario de comite de ${volComites}.</p></li>`;
                }
                // Para añadir TETs organizados
                let aniosMember = [];
                let aniosTet = [2000, 2003, 2006, 2009, 2012, 2015, 2018, 2022]; // Lista de TETs organizados
                let anioIngresoRama = parseInt(member.anioIngresoRama,10);
                let anioSalidaRama = member.anioSalidaRama;
                let TeTOrganizados = [];
                for (let i = anioIngresoRama; i <= anioSalidaRama; i++) {
                    aniosMember.push(i);
                }
                for (let anio of aniosMember) {
                    if (aniosTet.includes(anio)) {
                        TeTOrganizados.push(' ' + anio);
                    }
                }
                if(TeTOrganizados.length > 0){
                    if (TeTOrganizados.length > 1) {
                        last_TetOrganizados = TeTOrganizados.pop();
                        aportes +=`<li><p>Organización de los TeT ${TeTOrganizados} y ${last_TetOrganizados}.</p></li>`;
                    }else {
                        aportes += `<li><p>Organización del TeT ${TeTOrganizados}.</p></li>`;
                    }    
                }
                
                let result = `
                    <div class="card-face front-face-flex">
                        <div class="front-content">
                            <div class="front-bg-blue">
                                <img src="${member.urlFoto}" alt="" class="front-img">
                                <h1>${nombre}</h1>
                                <span class="big-content-line"></span>
                                <p>Voluntario ${member.anioIngresoRama}-${member.anioSalidaRama}</p>
                            </div>
                            <h4>Aportes</h4>
                            <ul>
                                ${aportes}
                            </ul>       
                        </div>
                        <div class="front-insignias">
                            <i id="close-card" class="fas fa-times"></i>
                            <span class="big-content-line"></span>
                            ${medallas}
                            <a href="${member.urlLinkedin}" target="_blank"><i class="fab fa-linkedin fa-3x"></i></a>
                            <div class="flex-1"></div>
                            <i class="fas fa-arrow-right fa-2x flip-icon flip-icon-right"></i>
                        </div>
                    </div>
                    <div class="card-face back-face-flex">
                        <div class="back-blue-side">
                            <i class="fas fa-arrow-left fa-2x flip-icon flip-icon-left"></i>
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