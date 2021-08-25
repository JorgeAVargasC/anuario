<?php
include_once("../admin/templates/header.php");
include_once("../functions/quitar_tildes.php");
include_once("../connection/db_connection.php");

$conn = mysqli_connect($host, $user, $pw, $db);

$sql = "SELECT * FROM comites";
$array_comites = $conn->query($sql);

$sql = "SELECT * FROM cargos";
$array_cargos = $conn->query($sql);
?>

<link rel="stylesheet" href="/anuario/css/reset-tarjeta.css">

<body>
  <div class="card">
    <div class="card-header">
      <h4 class="card-title">Formulario Público Anuario</h4>
    </div>
    <div class="card-body">
      <form role="form" enctype="multipart/form-data" name="crear-miembro-publico" id="crear-miembro-publico" method="post" action="../functions/modelo-publico.php">

        <?php include("../templates/datos-miembro.php"); ?>

        <div class="card-footer">
          <input type="hidden" name="registro" value="nuevo">
          <button type="submit" class="btn btn-primary">Añadir</button>
        </div>
      </form>
      <div class="btn-previsualizar-hover">
        <button class="btn-previsualizar btn btn-primary">
          <script src="https://cdn.lordicon.com/libs/frhvbuzj/lord-icon-2.0.2.js"></script>
          <lord-icon src="https://cdn.lordicon.com/tyounuzx.json" trigger="loop" colors="primary:#FFFFFF,secondary:#FFFFFF" stroke="100"></lord-icon>
          <div class="texto">
            <h1>Previsualizar</h1>
          </div>
        </button>
      </div>

      <div class="card-view-layout" id="card-view-layout">
        <div class="empty-panel" id="card-view-empty-panel"></div>
        <div class="card-view" id="card-view">
          <div class="reset-rems">
            <div class="flip-container" id="flip-container"></div>
          </div>
        </div>
      </div>

    </div>

  </div>
  <!-- /.card-body -->
  </div>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.js" integrity="sha512-ooSWpxJsiXe6t4+PPjCgYmVfr1NS5QXJACcR/FPpsdm6kqG1FmQ2SVyg2RXeVuCRBLr0lWHnWJP6Zs1Efvxzww==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.js" integrity="sha512-ZK6m9vADamSl5fxBPtXw6ho6A4TuX89HUbcfvxa2v2NYNT/7l8yFGJ3JlXyMN4hlNbz0il4k6DvqbIW5CCwqkw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

  <script src="../admin/js/admin.js"></script>
  <script src="../js/miembro-ajax.js"></script>
  <script type="text/javascript">
    $(document).ready(function() {
      Swal.fire({
        title: 'Política De Datos',
        text: "De acuerdo con la Ley Estatutaria 1581 de 2012 de Protección de Datos y con el Decreto 1377 de 2013, el usuario acepta que los datos consignados en el presente formulario sean incorporados en una base de datos responsabilidad de La Asociación Rama Estudiantil IEEE de la Universidad del Cauca. ",
        icon: 'question',
        showCancelButton: true,
        cancelButtonColor: '#d33',
        cancelButtonText: 'No acepto',
        confirmButtonColor: '#3085d6',
        confirmButtonText: 'Acepto',

      }).then((result) => {
        if (!(result.isConfirmed)) {
          window.location.href = "../index.php";
        } else {
          Swal.fire({
            title: "Confirmado",
            text: "Gracias por aceptar las  políticas",
            icon: "success"
          })
        }
      })
		const cardViewEmptyPanel = document.querySelector("#card-view-empty-panel");
		const flipContainer = document.querySelector("#flip-container");
		const cardViewLayout = document.querySelector("#card-view-layout");
		const cardView = document.querySelector("#card-view");
		$('.btn-previsualizar').click(() => {
			cardViewLayout.style.display = "flex";
			cardViewEmptyPanel.style.display = "block";
			cardView.style.display = "block";
			cardViewEmptyPanel.classList.toggle("open");
			cardViewLayout.classList.toggle("open");
			cardView.classList.toggle("open");
			let loadingImg = `<div class="card-face loading-face-flex" id="card-loading"><img src="/anuario/img/icons/loading.gif" width="30%" alt="loading"></div>`;
			flipContainer.innerHTML = loadingImg;
			// Creo el miembro
			let member = {
				"primerNombre": $('input[name="primerNombre"]').val(),
				"segundoNombre": $('input[name="segundoNombre"]').val(),
				"primerApellido": $('input[name="primerApellido"]').val(),
				"nombrePreferido": $('input[name="nombrePreferido"]:checked').val(),
				"urlFoto": (document.querySelector('input[name="imagen-miembro"]').files.length > 0) ? URL.createObjectURL(document.querySelector('input[name="imagen-miembro"]').files[0]) : "#",
				"anioIngresoRama": $('input[name="anioIngresoRama"]').val(),
				"anioSalidaRama": $('input[name="anioSalidaRama"]').val(),
				"urlLinkedin": $('input[name="urlLinkedin"]').val(),
				"correo": $('input[name="correo"]').val(),
				"nombreEnRama": $('input[name="nombreEnRama"]').val(),
				"frase": $('textarea[name="frase"]').val()
			};
			// Creo sus cargos como voluntario
			let cargos = []
			let comitesVoluntario = $('.checkbox-comite:checkbox:checked');
			for (let comite of comitesVoluntario) {
				cargos.push({
				"cargo": "Voluntario",
				"comite": comite.nextElementSibling.innerHTML,
				"urlLogo": "/anuario/img/medallas/medallaVoluntario.svg"
				});
			}
			let listaCargos = $('.checkbox-cargos:checkbox:checked');
			for (let cargo of listaCargos) {
				if (cargo.value != "coordinador") {
					cargos.push({
						"cargo": cargo.nextElementSibling.innerHTML,
						"comite": "",
						"urlLogo": "/anuario/img/medallas/medallaVoluntario.svg"
					});
				} else {
					let comitesCoordinador = $('.checkbox-coordinador:checkbox:checked');
					for (let comite of comitesCoordinador) {
						cargos.push({
						"cargo": "Coordinador",
						"comite": comite.nextElementSibling.innerHTML,
						"urlLogo": "/anuario/img/medallas/medallaVoluntario.svg"
						});
					}
				}
			}
			// Para seleccionar el nombre
			let nombre =
			member.nombrePreferido == 1 ?
			`${member.primerNombre} ${member.primerApellido}` :
			`${member.segundoNombre} ${member.primerApellido}`;
			// Para añadir aportes
			let aportes = "";
			let volComites = [];
			let coorComites = [];
			let medallas = "";
			let banderaCoor = false;
			let banderaVol = false;
			for (let cargo of cargos) {
			if (cargo.cargo == "Coordinador") {
				coorComites.push(" " + cargo.comite);
				if (!banderaCoor) {
				medallas += `<div class="medalla"><img src="${cargo.urlLogo}" title="${cargo.cargo}"></img></div>`;
				banderaCoor = true;
				}
			} else if (cargo.cargo == "Voluntario") {
				volComites.push(" " + cargo.comite);
				if (!banderaVol) {
				medallas += `<div class="medalla"><img src="${cargo.urlLogo}" title="${cargo.cargo}"></img></div>`;
				banderaVol = true;
				}
			} else {
				aportes += `<li><p>${cargo.cargo}</p></li>`;
				medallas += `<div class="medalla"><img src="${cargo.urlLogo}" title="${cargo.cargo}"></img></div>`;
			}
			}
			banderaCoor = false;
			banderaVol = false;
			if (coorComites.length > 0) {
			if (coorComites.length > 1) {
				last_coorComites = coorComites.pop();
				aportes += `<li><p>Coordinador de comites de ${coorComites} y ${last_coorComites}.</p></li>`;
			} else {
				aportes += `<li><p>Coordinador de comite de ${coorComites}.</p></li>`;
			}
			}
			if (volComites.length > 1) {
			last_volComites = volComites.pop();
			aportes += `<li><p>Voluntario de comites de ${volComites} y ${last_volComites}.</p></li>`;
			} else {
			aportes += `<li><p>Voluntario de comite de ${volComites}.</p></li>`;
			}
			// Para añadir TETs organizados
			let aniosMember = [];
			let aniosTet = [2000, 2003, 2006, 2009, 2012, 2015, 2018, 2022]; // Lista de TETs organizados
			let anioIngresoRama = parseInt(member.anioIngresoRama, 10);
			let anioSalidaRama = member.anioSalidaRama;
			let TeTOrganizados = [];
			for (let i = anioIngresoRama; i <= anioSalidaRama; i++) {
			aniosMember.push(i);
			}
			for (let anio of aniosMember) {
			if (aniosTet.includes(anio)) {
				TeTOrganizados.push(" " + anio);
			}
			}
			if (TeTOrganizados.length > 0) {
			if (TeTOrganizados.length > 1) {
				last_TetOrganizados = TeTOrganizados.pop();
				aportes += `<li><p>Organización de los TeT ${TeTOrganizados} y ${last_TetOrganizados}.</p></li>`;
			} else {
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
							<a href="${member.urlLinkedin}" target="_blank"><i class="fab fa-linkedin fa-2x"></i></a>
							<a href="mailto:${member.correo}"><i class="fas fa-envelope fa-2x"></i></i></a>
							<div class="flex-1"></div>
							<div class="flip-icon-container flip-icon-container-right">
								<i class="fas fa-arrow-right fa-2x flip-icon flip-icon-right"></i>
							</div>
						</div>
					</div>
					<div class="card-face back-face-flex">
						<div class="back-blue-side">
							<div class="flip-icon-container flip-icon-container-left">
								<i class="fas fa-arrow-left fa-2x flip-icon flip-icon-left"></i>
							</div>
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
			const flipIcon = document.querySelectorAll(".flip-icon-container");
			flipIcon.forEach((obj) => {
			obj.addEventListener("click", function() {
				flipContainer.classList.toggle("is-flipped");
			});
			});
			const closeCard = document.querySelector("#close-card");
			closeCard.addEventListener("click", () => {
			closingCard();
			});
		});
		// Funcionalidad del panel vacío
		cardViewEmptyPanel.addEventListener("click", () => {
			closingCard();
		});
		function closingCard() {
			cardView.classList.toggle("open");
			cardViewEmptyPanel.classList.toggle("open");
			cardViewLayout.classList.toggle("open");
			if (flipContainer.classList.contains("is-flipped")) {
			flipContainer.classList.toggle("is-flipped");
			}
		}
    });
  </script>
  <script>

  </script>


  <div class="form-publico">
    <?php include("../admin/templates/footer.php"); ?>
  </div>