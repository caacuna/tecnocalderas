<?php
	if(!empty($_POST)) {
		extract($_POST);	
		$query = "INSERT INTO comuna(nombre_comuna)
			VALUES	('$nombre_comuna');";
		$result = pg_query($query);
		if($result) {
			set_alert('Comuna agregada correctamente.', 'success');
			header("Location: " . mod_link('comuna'));
			die();
		}
	}

	$titulo = 'Agregar Comuna';
	include 'includes/header.php';
?>

<form method="post" action="<?php echo mod_link('comuna', 'agregar'); ?>" class="needs-validation" novalidate>
	<div class="form-row">
		<div class="col-md-6 mb-3">
		  	<label for="nombre_comuna">Nombre</label>
		  	<input type="text" name="nombre_comuna" class="form-control" id="nombre_comuna" placeholder="Nombre" value="<?php ival('nombre_comuna'); ?>" required>
		  	<div class="invalid-feedback">
				Ingrese Nombre de la Comuna
			</div>
		</div>
	</div>
	<a href="<?php echo mod_link('comuna'); ?>" class="btn btn-secondary">Cancelar</a>  	
  	<button class="btn btn-primary" type="submit"><span data-feather="save"></span> Guardar</button>
</form>

<?php include 'includes/footer.php'; ?>