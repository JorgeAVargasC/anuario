/* Popups Miembro */

$(document).ready(function () {

	$("#crear-miembro-publico").on("submit", function (e) {
		e.preventDefault();

		var datos = new FormData(this);

		$.ajax({
			type: $(this).attr("method"),
			data: datos,
			url: $(this).attr("action"),
			dataType: "json",
			contentType: false,
			processData: false,
			async: true,
			cache: false,
			success: function (data) {
				console.log(data);
				var resultado = data;

				if (resultado.respuesta == "exito") {
					Swal.fire({
						title: "CORRECTO",
						text: "Registro Exitoso",
						icon: "success",
					}).then((result) => {
						window.location.href = "formulario-publico.php";
					});
				} else if (resultado.respuesta == "error_img") {
					Swal.fire({
						icon: "error",
						title: "Image error",
						text: "Las caracteristicas de la imagen no son validas",
					});
				} else if (resultado.respuesta == "error_vol_comite") {
					Swal.fire({
						icon: "error",
						title: "Oops",
						text: "El voluntario debe pertenecer a un comite",
					});
				} else if (resultado.respuesta == "error_coord_comite") {
					Swal.fire({
						icon: "error",
						title: "Oops",
						text: "Debe seleccionar el comite que coordino",
					});
				} else {
					Swal.fire({
						icon: "error",
						title: "ERROR",
						text: "El miembro no se ha registrado",
					});
				}
			},
		});
	});

});