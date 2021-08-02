<div class="card-body">
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
		<input type="text" class="form-control" id="segundoApellido" name="segundoApellido" placeholder="Ingresa tu Segundo Apellido">
		<label for="segundoApellido">Segundo Apellido</label>
	</div>

	<label class="mb-1">Nombre preferido</label>
	<div class="form-check">
		<label for="nombrePreferido1" class="form-check-label">1</label>
		<input type="radio" class="form-check-input" id="nombrePreferido1" value=1 name="nombrePreferido" checked>
	</div>
	<div class="form-check mb-2">
		<label for="nombrePreferido2" class="form-check-label">2</label>
		<input type="radio" class="form-check-input" id="nombrePreferido2" value=2 name="nombrePreferido" disabled>
	</div>
	<div class="form-group">

		<input type="text" class="form-control" id="nombreEnRama" name="nombreEnRama" placeholder="Ingresa tu Nombre En Rama" required>
		<label for="nombreEnRama">Nombre En Rama</label>
	</div>
	<div class="form-group">
		<input type="number" class="form-control" id="anioIngresoRama" name="anioIngresoRama" min="1985" max="<?php echo date("Y"); ?>" placeholder="2020" required>
		<label for="anioIngresoRama">Año de Ingreso Rama</label>
	</div>
	<div class="form-group">
		<input type="number" class="form-control" id="anioSalidaRama" name="anioSalidaRama" min="1985" max="<?php echo date("Y") + 2; ?>" placeholder="<?php echo date("Y") + 2; ?>" required>
		<label for="anioSalidaRama">Año de Salida Rama</label>
	</div>
	<div class="form-group">
		<input type="email" class="form-control" id="correo" name="correo" placeholder="Ingresa tu Correo Electronico">
		<label for="correo">Correo Electrónico</label>
	</div>
	<div class="form-group">
		<input type="number" class="form-control" id="celular" name="celular" placeholder="3157003333">
		<label for="celular">Celular</label>
	</div>
	<div class="form-group">
		<textarea type="text" class="form-control" id="frase" name="frase" maxlength="240" placeholder="Escribe aquí tu frase..."></textarea>
		<label for="frase">Qué te aportó la Rama o una frase</label>
	</div>

	<div class="form-group">

		<div class="input-group">
			<!-- <input type="file" id="imagen-miembro" name="imagen-miembro" accept="image/png, image/jpeg, image/jpg" data-target="#modal" data-toggle="modal" required> -->
			<input type="file" id="imagen-miembro" name="imagen-miembro" accept="image/png, image/jpeg, image/jpg" required>
			<label for="imagen-miembro">Imagen <span style="font-weight: lighter;">(maximo 1.5Mb)</span></label>
		</div>
		<div id="cropped-image-container">
			<img id="cropped-image" src="#" width="200vw" alt="Cropped Image">
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

	<div class="form-group">
		<input type="text" class="form-control" id="urlLinkedin" name="urlLinkedin" placeholder="Ingresa la URL Linkedin">
		<label for="urlLinkedin">URL Linkedin</label>
	</div>

	<!-- Check boxes -->
	<br>
	<h4>Comites a los que perteneció</h4>
	<?php
	foreach ($array_comites as $comite) {
		$comite_format = strtolower(quitar_tildes($comite['comite']));
	?>
		<div class="form-check">
			<input type="checkbox" class="form-check-input" id="<?php echo $comite_format; ?>" name="<?php echo $comite_format; ?>" value="<?php echo $comite_format; ?>">
			<label for="<?php echo $comite_format; ?>" class="form-check-label"><?php echo $comite['comite']; ?></label>
		</div>
	<?php
	}
	?>

	<br>
	<h4>Cargos que ocupó</h4>
	<?php
	foreach ($array_cargos as $cargo) {
		if ($cargo['id'] != 10) {
			// Coordinador TET se convierte a coordinadorTET
			$cargo_format = lcfirst(str_replace(' ', '', quitar_tildes($cargo['cargo'])));
	?>
			<div class="form-check">
				<input type="checkbox" class="form-check-input" id="<?php echo $cargo_format; ?>" name="<?php echo $cargo_format; ?>" value="<?php echo $cargo_format; ?>">
				<label for="<?php echo $cargo_format; ?>" class="form-check-label"><?php echo $cargo['cargo'] ?></label>
			</div>
	<?php
		}
	}
	?>

	<br>
	<h4>Comites que Coordinó</h4>
	<?php

	foreach ($array_comites as $comite) {
		$comite_format = strtolower(quitar_tildes($comite['comite']));
	?>
		<div class="form-check">
			<input type="checkbox" class="form-check-input" id="<?php echo 'coord_' . $comite_format; ?>" name="<?php echo 'coord_' . $comite_format; ?>" value="<?php echo 'coord' . $comite_format; ?>" disabled>
			<label for="<?php echo 'coord_' . $comite_format; ?>" class="form-check-label"><?php echo $comite['comite']; ?></label>
		</div>
	<?php
	}
	?>

	<hr class="mt-3">
	<h5 class="mt-3 text-primary">*La siguiente infomacion es opcional y no se mostrara en el anuario</h5>
	<div class="form-group">
		<input class="form-control" type="text" name="ocupacionActual" id="ocupacionActual">
		<label class="mb-1" for="">Ocupación Actual</label>
	</div>

	<div class="form-group">
		<textarea class="form-control" type="text" name="contactos" id="contactos"></textarea>
		<label class="mb-1" for="">Exintegrantes de la rama que conozcas</label>
	</div>

</div>
<!-- /.card-body -->