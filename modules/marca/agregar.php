<?php
	if(!empty($_POST)) {
		extract($_POST);	
		$query = "INSERT INTO marca(nom_marca)
			VALUES	('$nom_marca');";
		$result = pg_query($query);
		if($result) {
			set_alert('Marca agregada correctamente.', 'success');
			header("Location: " . mod_link('marca'));
			die();
		}
	}

	$titulo = 'Agregar Marca';
	include 'includes/header.php';
?>

<form method="post" action="<?php echo mod_link('marca', 'agregar'); ?>" class="needs-validation" novalidate>
	<div class="form-row">
		<div class="col-md-6 mb-3">
		  	<label for="nom_marca">Nombre</label>
		  	<input type="text" name="nom_marca" class="form-control" id="nom_marca" placeholder="Nombre" value="<?php ival('nom_marca'); ?>" required>
		  	<div class="invalid-feedback">
				Ingrese Nombre
			</div>
		</div>
	</div>
	<a href="<?php echo mod_link('marca'); ?>" class="btn btn-secondary">Cancelar</a>  	
  	<button class="btn btn-primary" type="submit"><span data-feather="save"></span> Guardar</button>
</form>

<?php include 'includes/footer.php'; ?>