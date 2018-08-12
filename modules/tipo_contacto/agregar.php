<?php
	if(!empty($_POST)) {
		extract($_POST);	
		$query = "INSERT INTO tipo_contacto(nombre_cargo)
			VALUES	('$nombre_cargo');";
		$result = pg_query($query);
		if($result) {
			set_alert('Cargo agregado correctamente.', 'success');
			header("Location: " . mod_link('tipo_contacto'));
			die();
		}
	}

	$titulo = 'Agregar Cargo';
	include 'includes/header.php';
?>

<form method="post" action="<?php echo mod_link('tipo_contacto', 'agregar'); ?>" class="needs-validation" novalidate>
	<div class="form-row">
		<div class="col-md-6 mb-3">
		  	<label for="nombre_cargo">Nombre</label>
		  	<input type="text" name="nombre_cargo" class="form-control" id="id_cargo" placeholder="Nombre" value="<?php ival('nombre_cargo'); ?>" required>
		  	<div class="invalid-feedback">
				Ingrese Nombre del Cargo
			</div>
		</div>
	</div>  	
  	<button class="btn btn-primary" type="submit">Guardar</button>
</form>

<?php include 'includes/footer.php'; ?>