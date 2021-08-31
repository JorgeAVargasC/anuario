<div class="card-body"></div>
<div class="form-group">
		<input type="text" class="form-control" id="primerNombre" name="primerNombre" placeholder="Ingresa tu Primer Nombre" required>
		<label for="primerNombre">Primer Nombre</label>
	</div>
	<div class="form-group">
		<input type="text" class="form-control" id="segundoNombre" name="segundoNombre" placeholder="Ingresa tu Segundo Nombre">
		<label for="segundoNombre">Segundo Nombre</label>
	</div>
  <div class="form-group">
		<input type="text" class="form-control" id="primerApellido" name="primerApellido" placeholder="Ingresa tu Primer Apellido" required>
		<label for="primerApellido">Primer Apellido</label>
	</div>



	<div class="form-group">
		<div class="input-group">
			<input type="file" id="imagen-miembro" name="imagen-miembro" accept="image/png, image/jpeg, image/jpg" required>
			<label for="imagen-miembro">Imagen</label>
		</div>
	</div>
	<div class="form-group">
		<div id="cropped-image-container">
			<img id="cropped-image" src="#"S alt="Cropped Image">
		</div>	
	</div>
	<!-- Modal -->
	<div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title" id="modalLabel">Personaliza tu imagen</h4>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<div class="image-preview">
						<div id="image-container">
							<img id="image" src="#" alt="Picture">
						</div>
						<div id="result">
							<h5>Previsualización:</h5>
							<br>
							<div id="image-result">
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" id="crop-button" class="btn btn-primary">Crop</button>
					<button type="button" class="btn btn-danger" data-dismiss="modal">Exit</button>
				</div>
			</div>
		</div>
	</div>



	<!-- Check boxes -->
	

	<br>
	<h4>Cargos que ocupó</h4>
	<?php
	foreach ($array_cargos as $cargo) {
		if ($cargo['id'] != 10) {
			// Coordinador TET se convierte a coordinadorTET
			$cargo_format = lcfirst(str_replace(' ', '', quitar_tildes($cargo['cargo'])));
	?>
			<div class="form-check">
				<input type="checkbox" class="form-check-input checkbox-cargos" id="<?php echo $cargo_format; ?>" name="<?php echo $cargo_format; ?>" value="<?php echo $cargo_format; ?>">
				<label for="<?php echo $cargo_format; ?>" class="form-check-label"><?php echo $cargo['cargo'] ?></label>
			</div>
	<?php
		}
	}
	?>


</div>
<!-- /.card-body -->